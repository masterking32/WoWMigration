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
if(!empty($_GET["id"]))
{
    if(is_numeric($_GET["id"]))
    {
        $this_request = migration::get_requests_by_id($_GET["id"]);
        if(!empty($this_request["id"]))
        {
            require_once base_path.'template/tpl/manage_request.php';
            exit();
        }
    }
}
header("location: ../migration_manage.php");
exit();
