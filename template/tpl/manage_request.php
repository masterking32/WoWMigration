<?php
/**
 * Created by Amin.MasterkinG
 * Website : MasterkinG32.CoM
 * Email : lichwow_masterking@yahoo.com
 * Date: 11/26/2018 - 8:36 PM
 */
require_once 'header.php'; ?>
<script type="text/javascript" src="https://wotlk.evowow.com/static/widgets/power.js"></script>
<script>var aowow_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
<link rel="stylesheet" type="text/css" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/datatables/datatables.min.css"/>
<script type="text/javascript" src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/datatables/datatables.min.js"></script>
<div class="box-form">
    <p>Welcome <b><?php echo ucfirst(strtolower($antiXss->xss_clean($current_user["username"]))); ?></b>&nbsp;-&nbsp;
        <?php echo "<a href=\"".get_config('baseurl')."/panel.php\" class=\"btn btn-sm btn-success\">Back to panel</a>&nbsp;"; ?>
        <a href="<?php echo get_config('baseurl'); ?>/index.php?logout" class="btn btn-sm btn-danger">Logout</a></p>
    <?php error_msg(); success_msg(); //Display message. ?>
    <hr>
    <?php
    echo (!empty($this_request["id"]) ? '<p>Request ID : <b>'.$antiXss->xss_clean($this_request["id"]).'</b></p>' : '');
    echo (!empty($this_request["accountid"]) ? '<p>Account ID : <b>'.$antiXss->xss_clean($this_request["accountid"]).'</b></p>' : '');
    echo (!empty($this_request["create_time"]) ? '<p>Create Time : <b>'.$antiXss->xss_clean($this_request["create_time"]).'</b></p>' : '');
    echo (!empty($this_request["old_realm"]) ? '<p>From : <b>'.$antiXss->xss_clean($this_request["old_realm"]).(!empty($this_request["server_url"]) ? ' - '.$antiXss->xss_clean($this_request["server_url"]) : '').'</b></p>' : '');
    echo (!empty($this_request["acc_user"]) ? '<p>Username : <b>'.$antiXss->xss_clean($this_request["acc_user"])."</b>".(!empty($this_request["acc_pass"]) ? ' - Password : <B>'.$antiXss->xss_clean(base64_decode($this_request["acc_pass"])) : '').'</b>' : '')."</p>";
    echo (!empty($this_request["realmid"]) ? (!empty(get_config("realmlists")[$this_request["realmid"]]["realmname"]) ? '<p>To Realm : <b>'.get_config("realmlists")[$this_request["realmid"]]["realmname"].'</b></p>' : '') : '');
    echo (!empty($this_request["char_guid"]) ? '<p>Your Server character guid : <b>'.$antiXss->xss_clean($this_request["char_guid"]).'</b></p>' : '');
    echo "<hr>";
    $data_array = json_decode(base64_decode($this_request["data"]),true);

    ?>
    <form action="<?php echo get_config('baseurl'); ?>/migration_manage.php" method="post">
        Name : <b><?php echo (!empty($data_array["name"]) ? $antiXss->xss_clean($data_array["name"]) : 'NONE'); ?></b>
        - Class : <b><?php echo (!empty($data_array["class"]) ? $antiXss->xss_clean($data_array["class"]) : 'NONE'); ?></b>
        - Race : <b><?php echo (!empty($data_array["race"]) ? $antiXss->xss_clean($data_array["race"]) : 'NONE'); ?></b>
        - Gender : <b><?php echo (!empty($data_array["gender"]) ? ($data_array["gender"] == 1 ? 'Female' : 'male') : 'NONE'); ?></b>
        - Create Time : <b><?php echo (!empty($data_array["createtime"]) ? date("Y/m/d H:i:s", $data_array["createtime"]) : 'NONE'); ?></b>
        <BR>Locale : <b><?php echo (!empty($data_array["locale"]) ? $antiXss->xss_clean($data_array["locale"]) : 'NONE'); ?></b>
        - Realmlist : <b><?php echo (!empty($data_array["realmlist"]) ? $antiXss->xss_clean($data_array["realmlist"]) : 'NONE'); ?></b>
        - Client Build : <b><?php echo (!empty($data_array["clientbuild"]) ? $antiXss->xss_clean($data_array["clientbuild"]) : 'NONE'); ?></b>
        - Realm : <b><?php echo (!empty($data_array["realm"]) ? $antiXss->xss_clean($data_array["realm"]) : 'NONE'); ?></b>
        <div class="form-group">
            <label for="money">Money :</label>
            <input type="number" name="money" id="money" class="form-control" value="<?php echo (!empty($data_array["money"]) ? $antiXss->xss_clean($data_array["money"]) : '0'); ?>">
        </div>
        <div class="form-group">
            <label for="honor">Honor Point :</label>
            <input type="number" name="honor" id="honor" class="form-control" value="<?php echo (!empty($data_array["honor"]) ? $antiXss->xss_clean($data_array["honor"]) : '0'); ?>">
        </div>
        <div class="form-group">
            <label for="kills">Kills :</label>
            <input type="number" name="kills" id="kills" class="form-control" value="<?php echo (!empty($data_array["kills"]) ? $antiXss->xss_clean($data_array["kills"]) : '0'); ?>">
        </div>
        <div class="form-group">
            <label for="comment">Comment :</label>
            <input type="text" name="comment" id="comment" class="form-control" placeholder="Comment for user">
        </div>

        <div class="text-center">
            <input type="hidden" name="request_id" value="<?php echo $this_request["id"];?>" >
            <?php echo ($this_request["status"] == 0 ? '&nbsp;&nbsp;<input type="submit" name="deny" class="btn btn-danger btn-lg" value="Deny Request">' : '');?>
            <?php echo ($this_request["status"] == 0 || $this_request["status"] == 2 ? '<input type="submit" name="accept" class="btn btn-success btn-lg" value="Accept Request">' : '');?>

        </div>
        <hr>
        <h4>Mounts - Spells (Click to remove):</h4>
        <?php
        foreach ($data_array["mounts"] as $one_mount)
        {
            echo "<div style='float: left; margin:5px;'>
                        <input type='hidden' name='spells[]' value='".$antiXss->xss_clean($one_mount)."'>
                        <span style='background-color: #533f03;padding: 5px;border-radius: 4px;color: #fff;'><a href=\"javascript:void(0);\" onclick='$(this).parent().remove();".'$WH.Tooltip.hide();'."' data-wowhead=\"spell=".$antiXss->xss_clean($one_mount)."\">".$antiXss->xss_clean($one_mount)."</a></span>
                    </div>";
        }
        ?>
        <div style="clear: both;"></div>
        <hr>
        <h4>Titles (Click to remove):</h4>
        <?php
        foreach ($data_array["title"] as $title)
        {
            echo "<div style='float: left; margin:5px;'>
                        <input type='hidden' name='titles[]' value='".$antiXss->xss_clean($title)."'>
                        <span style='background-color: #533f03;padding: 5px;border-radius: 4px;color: #fff;'><a href=\"javascript:void(0);\" onclick='$(this).parent().remove();".'$WH.Tooltip.hide();'."' data-wowhead=\"title=".$antiXss->xss_clean($title)."\">".$antiXss->xss_clean($title)."</a></span>
                    </div>";
        }
        ?>
        <div style="clear: both;"></div>
        <hr>
        <h4>Items (Click to remove):</h4>
        <div id="items_list">
            <?php
            $items = array_merge($data_array["inventory"],$data_array["bag"],$data_array["currency"],$data_array["bank_items"]);
            $i = 1;
            foreach ($items as $item)
            {
                echo "<div style='float: left; margin:5px;'>
                            <input type='hidden' name='items[$i]' value='".$antiXss->xss_clean($item["id"])."'>
                            <input type='hidden' name='counts[$i]' value='".$antiXss->xss_clean($item["count"])."'>
                            <span style='background-color: #533f03;padding: 5px;border-radius: 4px;color: #fff;'>[ <a href=\"javascript:void(0);\" onclick='$(this).parent().remove();".'$WH.Tooltip.hide();'."' data-wowhead=\"item=".$antiXss->xss_clean($item["id"])."\">".$antiXss->xss_clean($item["id"])."</a> x".$antiXss->xss_clean($item["count"])." ]</span>
                        </div>";
                $i++;
            }
            ?>

        </div>
        <div style="clear: both;"></div>
        <div>
            <hr>
            <h3>Add Item</h3>

            <div class="form-group">
                <label for="itemid">ItemID :</label>
                <input type="number" id="itemid" class="form-control" placeholder="ItemID for Add">
            </div>
            <div class="form-group">
                <label for="ItemCount">Item Count :</label>
                <input type="number" id="ItemCount" value="1" class="form-control" placeholder="Item Count">
            </div>
            <div class="text-center">
                <input type="button" id="additem" class="btn btn-success btn-sm" value="Add Item">
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        var i = <?php echo ++$i;?>;
        $("#additem").click(function(){
            var itemid = $('#itemid').val();
            var itemcount = $('#ItemCount').val();
            if(itemid != '' && itemcount != '')
            {
                if(itemcount > 0)
                {
                    $('#itemid').val("");
                    $('#ItemCount').val("1");
                    var div = document.getElementById('items_list');
                    div.innerHTML += '<div style=\'float: left; margin:5px;\'>' +
                        '<input type=\'hidden\' name=\'items['+ i +']\' value=\''+ itemid +'\'>' +
                        '<input type=\'hidden\' name=\'counts['+ i +']\' value=\'\'+ itemcount +\'\'>' +
                        '<span style=\'background-color: #533f03;padding: 5px;border-radius: 4px;color: #fff;\'>[ <a href="javascript:void(0);" onclick=\'$(this).parent().remove(); \' data-wowhead="item='+ itemid +'">'+ itemid +'</a> x'+ itemcount +' ]</span>\n' +
                        '</div>';
                    i++;
                    $WowheadPower.refreshLinks();
                }
            }
        });
    });
</script>
<?php require_once 'footer.php'; ?>
