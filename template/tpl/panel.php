<?php
/**
 * Created by Amin.MasterkinG
 * Website : MasterkinG32.CoM
 * Email : lichwow_masterking@yahoo.com
 * Date: 11/26/2018 - 8:36 PM
 */
require_once 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/datatables/datatables.min.js"></script>
<div class="box-form">
    <p>Welcome <b><?php echo ucfirst(strtolower($antiXss->xss_clean($current_user["username"]))); ?></b>&nbsp;-&nbsp;
        <?php
            if(in_array(user::get_user_gmlevel($current_user["id"]),get_config('gm_ranks')))
            {
                echo "<a href=\"".get_config('baseurl')."/migration_manage.php\" class=\"btn btn-sm btn-success\">Admin Panel</a>&nbsp;";
            }
        ?>
        <a href="<?php echo get_config('baseurl'); ?>/index.php?logout" class="btn btn-sm btn-danger">Logout</a></p>

    <?php error_msg(); success_msg(); //Display message. ?>

    <p>
        How to use migration :
    </p>
    <ol>
        <li>First <a href="<?php echo get_config('baseurl'); ?>/files/chardumps.zip">download game addons</a>.</li>
        <li>Unzip file inside "YourGameDirecotry/Interface/AddOns".</li>
        <li>Login with your character and enter <b>/chardumps show</b>, Check all checkboxes and click on Dump button.</li>
        <li>Go to <a href="<?php echo get_config('baseurl'); ?>/new_migration.php" class="btn btn-primary btn-sm">New Migration</a> and send migration request.</li>
        <li>Select character dump from <b style="font-size: 10px;">"YourGameDirecotry/WTF/Account/YourUsername/REALMNAME/CharName/SavedVariables/chardumps.lua"</b></li>
        <li>Wait for game master accept your request, You will receive a mail.</li>
    </ol>
    <hr>
    <table id="datatable" class="display cell-border" style="width:100%">
        <thead>
        <tr>
            <th class='text-center'>Character Name</th>
            <th class='text-center'>Server</th>
            <th class='text-center'>Date</th>
            <th class='text-center'>Status</th>
            <th class='text-center'>Comment</th>
        </tr>
        </thead>
        <tbody>
        <?php
            if(!empty($user_requests))
            {
                if(is_array($user_requests)){
                    foreach($user_requests as $request)
                    {
                        $char_data = json_decode(base64_decode($request["data"]),true);

                        echo "<tr class='text-center'>";
                        echo "<td class='text-center'><img src='".get_config("baseurl")."/template/images/race/".$antiXss->xss_clean($char_data["raceid"])."-".$antiXss->xss_clean($char_data["gender"]).".gif'>&nbsp;<img src='".get_config("baseurl")."/template/images/class/".$antiXss->xss_clean($char_data["classid"]).".gif'>&nbsp;&nbsp;".$antiXss->xss_clean($char_data["name"])."</td>";
                        echo "<td class='text-center'>".$antiXss->xss_clean($request["server_url"])."</td>";
                        echo "<td class='text-center'>".date("Y/m/d",strtotime($antiXss->xss_clean($request["create_time"])))."</td>";
                        if(empty($request["status"]))
                        {
                            echo "<td class='text-center'><span class='alert alert-info' style='padding: 0px 5px 0px 5px;'>Waiting for Check</span></td>";
                        }elseif($request["status"] == 1)
                        {
                            echo "<td class='text-center'><span class='alert alert-success' style='padding: 0px 5px 0px 5px;'>Accepted</span></td>";
                        }elseif($request["status"] == 2)
                        {
                            echo "<td class='text-center'><span class='alert alert-danger' style='padding: 0px 5px 0px 5px;'>Denied</span></td>";
                        }else{
                            echo "<td class='text-center'>-</td>";
                        }
                        if(!empty($request["comment"]))
                        {
                            echo "<td class='text-center'>".$antiXss->xss_clean($request["comment"])."</td>";
                        }else{
                            echo "<td class='text-center'>-</td>";
                        }
                        echo "</tr>";
                    }
                }
            }
        ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
</div>
<?php require_once 'footer.php'; ?>
