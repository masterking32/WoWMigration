<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright	Copyright (c) 2019 - 2022, MsaterkinG32 Team, Inc. (https://masterking32.com)
 * @link	https://masterking32.com
 * @Description : It's not masterking32 framework !
 **/
use Gregwar\Captcha\CaptchaBuilder;
use Medoo\Medoo;

class user{
    public static $captcha;
    public static function check_session()
    {
        if(!empty($_SESSION["loginid"]))
        {
            if(preg_match("/^[0-9]+$/",$_SESSION["loginid"]))
            {
                return true;
            }
        }
        return false;
    }
    public static function login_required_redirect()
    {
        if(!self::check_session())
        {
            header("location: ".get_config("baseurl"));
            exit();
        }
    }

    public static function not_loggined_redirect()
    {
        if(self::check_session())
        {
            header("location: ".get_config("baseurl")."/panel.php");
            exit();
        }
    }
    public static function login()
    {
        if(!empty($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["captcha"]) && !empty($_SESSION['captcha']))
        {
            if(strtolower($_SESSION['captcha']) == strtolower($_POST["captcha"]))
            {
                unset($_SESSION['captcha']);
                if(preg_match("/^[0-9A-Z-_]+$/",strtoupper($_POST["username"])))
                {
                    $user = self::get_user(strtoupper($_POST["username"]));
                    if(!empty($user["sha_pass_hash"]) && !empty($user["id"]))
                    {
                        $hashed_pass = strtoupper(sha1(strtoupper($_POST["username"].":".$_POST["password"])));
                        if(strtoupper($user["sha_pass_hash"]) == $hashed_pass)
                        {
                            $_SESSION["loginid"] = $user["id"];
                            self::not_loggined_redirect();
                        }else{
                            error_msg("Account information is not valid.");
                        }
                    }else{
                        error_msg("Account information is not valid.");
                    }
                }else{
                    error_msg("Use valid characters for username.");
                }
            }else{
                error_msg("Captcha is not valid.");
            }
        }
        unset($_SESSION['captcha']);
        self::$captcha = new CaptchaBuilder;
        self::$captcha->build();
        $_SESSION['captcha'] = self::$captcha->getPhrase();
    }
    public static function get_user($username)
    {
        if(!empty($username))
        {
            $datas = database::$auth->select("account", ["id","username","sha_pass_hash","email"], ["username" => Medoo::raw('UPPER(:username)', [':username' => $username])]);
            if(!empty($datas[0]))
            {
                return $datas[0];
            }
        }
        return false;
    }
    public static function get_user_by_id($userid)
    {
        if(!empty($userid))
        {
            if(is_numeric($userid))
            {
                $datas = database::$auth->select("account", ["id","username","sha_pass_hash","email"], ["id[=]" => $userid]);
                if(!empty($datas[0]))
                {
                    return $datas[0];
                }
            }
        }
        return false;
    }
    public static function get_user_gmlevel($userid)
    {
        if(!empty($userid))
        {
            if(is_numeric($userid))
            {
                $datas = database::$auth->select("account_access", ["id","gmlevel"], ["id[=]" => $userid]);
                if(!empty($datas[0]["gmlevel"]))
                {
                    return $datas[0]["gmlevel"];
                }
            }
        }
        return 0;
    }
    public static function logout()
    {
        if(isset($_SESSION["loginid"]))
        {
            unset($_SESSION["loginid"]);
        }
    }
    public static function logout_check()
    {
        if(isset($_GET["logout"]))
        {
            self::logout();
        }
    }
    public static function charname_exists($name,$realmid)
    {
        if(!empty($name))
        {
            $datas = database::$chars[$realmid]->select("characters", ["guid"], ["name[=]" => $name]);
            if(!empty($datas[0]['guid']))
            {
                return true;
            }
        }
        return false;
    }
    public static function get_new_guid($realmid)
    {
        $max = database::$chars[$realmid]->max("characters", "guid");
        if(empty($max))
        {
            return 1;
        }
        return $max + 1;
    }
}