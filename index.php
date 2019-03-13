<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright	Copyright (c) 2019 - 2022, MsaterkinG32 Team, Inc. (https://masterking32.com)
 * @link	https://masterking32.com
 * @Description : It's not masterking32 framework !
 **/

require_once './application/loader.php';
user::logout_check();
user::not_loggined_redirect();
user::login();
require_once base_path.'template/tpl/login.php';