<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright	Copyright (c) 2019 - 2022, MsaterkinG32 Team, Inc. (https://masterking32.com)
 * @link	https://masterking32.com
 * @Description : It's not masterking32 framework !
 **/
use Gregwar\Captcha\CaptchaBuilder;
use Medoo\Medoo;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class migration{
    public static $captcha;
    public static function get_all_requests()
    {
        $datas = database::$auth->select("masterking_account_transfer", "*",["ORDER" => ["id" => "DESC"]]);
        if(!empty($datas[0]["id"]))
        {
            return $datas;
        }
        return false;
    }
    public static function get_requests_by_userid($userid)
    {
        if(!empty($userid))
        {
            if(is_numeric($userid))
            {
                $datas = database::$auth->select("masterking_account_transfer", "*", ["accountid[=]" => $userid]);
                if(!empty($datas[0]["id"]))
                {
                    return $datas;
                }
            }
        }
        return false;
    }
    public static function get_requests_by_id($request_id)
    {
        if(!empty($request_id))
        {
            if(is_numeric($request_id))
            {
                $datas = database::$auth->select("masterking_account_transfer", "*", ["id[=]" => $request_id]);
                if(!empty($datas[0]["id"]))
                {
                    return $datas[0];
                }
            }
        }
        return false;
    }
    public static function new_migration_request($userid)
    {
        global $antiXss;
        if(!empty($_POST["server_url"]) && !empty($_POST["realmid"]) && !empty($_POST["old_realm"]) && !empty($_POST["acc_user"]) && !empty($_POST["acc_pass"]) && !empty($_FILES["chardump"]["tmp_name"]))
        {
            if(is_numeric($_POST["realmid"]))
            {
                @$char_data = parse_chardump($_FILES["chardump"]["tmp_name"]);
                if(!empty($char_data) && count($char_data) > 1)
                {
                    database::$auth->insert("masterking_account_transfer", [
                        "accountid" => $antiXss->xss_clean($userid),
                        "realmid" => $antiXss->xss_clean($_POST["realmid"]),
                        "old_realm" => $antiXss->xss_clean($_POST["old_realm"]),
                        "acc_user" => $antiXss->xss_clean($_POST["acc_user"]),
                        "server_url" => $antiXss->xss_clean($_POST["server_url"]),
                        "acc_pass" => base64_encode($_POST["acc_pass"]),
                        "data" => base64_encode(json_encode($char_data))
                    ]);
                    success_msg("Your request has been saved. wait for administrator check, You will get mail.");
					include("./application/include/telegram.php");
					$telegram->newmigration();
                }else{
                    error_msg("Chardump is not valid, Use our addons.");
                }
            }else{
                error_msg("Input data is not valid.");
            }
        }
        return false;
    }
    public static function deny_request($reqId,$email,$comment)
    {
        global $antiXss;
        if(!empty($reqId))
        {
            if(is_numeric($reqId))
            {
                database::$auth->update("masterking_account_transfer", [
                    "status" => 2,
                    "comment" => $antiXss->xss_clean($comment)
                ], ["id[=]" => $antiXss->xss_clean($reqId)]);
                success_msg("Request has been denied.");

                if(!empty($email))
                {
                    $mail = new PHPMailer;
                    $mail->isSendmail();
                    $mail->setFrom(get_config('system_email'), 'Migration Mail System');
                    $mail->addReplyTo(get_config('admin_email'), 'Server Owner');
                    $mail->addAddress($email);
                    $mail->Subject = get_config('mail_title')." - Deny";
                    $mail->msgHTML("Hi,<br>Your migration request has been denied for (".$antiXss->xss_clean($comment).").");
                    $mail->send();
                }
            }else{
                error_msg("Input data is not valid.");
            }
        }
        return false;
    }
    public static function accept_request($reqId,$email,$comment)
    {
        global $antiXss;
        if(!empty($reqId))
        {
            if(is_numeric($reqId))
            {
                $this_request = migration::get_requests_by_id($_POST["request_id"]);
                if(!empty($this_request["id"]))
                {
                    if($this_request['status'] == 0 || $this_request['status'] == 2)
                    {
                        $i = 1;
                        while($i == 1)
                        {
                            $Char_name = RandomNameGenerator(12);
                            if(!user::charname_exists($Char_name,$this_request['realmid']))
                            {
                                $i = 100;
                            }
                        }

                        $char_data = json_decode(base64_decode($this_request["data"]),true);

                        $guid = user::get_new_guid($this_request['realmid']);
                        database::$chars[$this_request['realmid']]->insert("characters", [
                            "guid" => $antiXss->xss_clean($guid),
                            "name" => $antiXss->xss_clean($Char_name),
                            "account" => $antiXss->xss_clean($this_request['accountid']),
                            "level" => get_config('trans_conf_level'),
                            "gender" => $char_data['gender'] == 1 ? 1 : 0,
                            "totalHonorPoints" => (!empty($_POST["honor"]) && is_numeric($_POST['honor']) ? $antiXss->xss_clean($_POST['honor']) : '0'),
                            "totalKills" => (!empty($_POST["kills"]) && is_numeric($_POST['kills']) ? $antiXss->xss_clean($_POST['kills']) : '0'),
                            "money" => (!empty($_POST["money"]) && is_numeric($_POST['money']) ? $antiXss->xss_clean($_POST['money']) + get_config('trans_conf_calcmoney') : get_config('trans_conf_calcmoney')),
                            "class" => $char_data['classid'],
                            "race" => $char_data['raceid'],
                            "at_login" => 29,
                            "position_x"    => "5741.36",
                            "position_y"    => "626.982",
                            "position_z"    => "648.354",
                            "map"    => "571",
                            "health"    => "100",
                            "zone"    => "4395",
                            "cinematic"    => "1",
                            "taximask"    => "",
                            "online"    => "0"
                        ]);
                        RemoteCommandWithSOAP($this_request['realmid'],trim("reset spells ".$Char_name));
                        RemoteCommandWithSOAP($this_request['realmid'],trim("reset stats ".$Char_name));
                        RemoteCommandWithSOAP($this_request['realmid'],trim("reset talents ".$Char_name));
                        if(!empty($_POST["items"]))
                        {
                            foreach($_POST["items"] as $key => $value)
                            {
                                if(!empty($_POST["items"][$key]) && !empty($_POST["counts"][$key]))
                                {
                                    $command = trim("send items ". $Char_name ." \"Migration Items\" \"Migration Items\" ". $_POST["items"][$key].":".$_POST["counts"][$key]);
                                    RemoteCommandWithSOAP($this_request['realmid'],$command);
                                }
                            }
                        }
                        database::$auth->update("masterking_account_transfer", [
                            "status" => 1,
                            "char_guid" => $guid,
                            "comment" => $antiXss->xss_clean($comment)
                        ], ["id[=]" => $antiXss->xss_clean($reqId)]);

                        success_msg("Request has been accepted.");
                        if(!empty($email))
                        {
                            $mail = new PHPMailer;
                            $mail->isSendmail();
                            $mail->setFrom(get_config('system_email'), 'Migration Mail System');
                            $mail->addReplyTo(get_config('admin_email'), 'Server Owner');
                            $mail->addAddress($email);
                            $mail->Subject = get_config('mail_title')." - Accept";
                            $mail->msgHTML("Hi,<br>Your migration request has been accepted.<br>(".$antiXss->xss_clean($comment).").");
                            $mail->send();
                        }
                    }else{
                        error_msg("Request is not valid.");
                    }
                }else{
                    error_msg("Request is not valid.");
                }
            }else{
                error_msg("Input data is not valid.");
            }
        }
        return false;
    }

}