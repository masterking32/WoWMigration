<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright	Copyright (c) 2019 - 2022, MsaterkinG32 Team, Inc. (https://masterking32.com)
 * @link	https://masterking32.com
 * @Description : It's not masterking32 framework !
 **/

require_once './application/loader.php';
user::login_required_redirect();
$current_user = user::get_user_by_id($_SESSION["loginid"]);
if(!in_array(user::get_user_gmlevel($current_user["id"]),get_config('gm_ranks')))
{
    header("location: ../index.php");
    exit();
}
if(!empty($_POST["request_id"]))
{
    if(is_numeric($_POST["request_id"]))
    {
        $this_request = migration::get_requests_by_id($_POST["request_id"]);
        if(!empty($this_request["id"]))
        {
            $comment = '';
            $email = "";
            $user_req_data = user::get_user_by_id($this_request['accountid']);
            if(!empty($user_req_data['email']))
            {
                $email = $user_req_data['email'];
            }
            if(!empty($_POST['comment']))
            {
                $comment = $_POST['comment'];
            }
            if(!empty($_POST['deny']))
            {
                migration::deny_request($this_request["id"],$email,$comment);
            }elseif(!empty($_POST['accept']))
            {
                migration::accept_request($this_request["id"],$email,$comment);
            }
        }
    }
}
$user_requests = migration::get_all_requests($_SESSION["loginid"]);
require_once base_path.'template/tpl/migration_manage.php';