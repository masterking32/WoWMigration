<?php
/**
 * Created by Amin.MasterkinG
 * Website : MasterkinG32.CoM
 * Email : lichwow_masterking@yahoo.com
 * Date: 11/26/2018 - 8:36 PM
 */
require_once 'header.php'; ?>
<div class="box-form" style="padding: 0px;margin-top: 40px;">
    <form action="../panel.php" method="post" enctype="multipart/form-data">
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">Terms<br /><small>Migration TERMS</small></a></li>
                <li><a href="#step-2">Step 1<br /><small>Old Server Details</small></a></li>
                <li><a href="#step-3">Step 2<br /><small>Select Realm</small></a></li>
            </ul>

            <div>
                <div id="step-1" class="">
                    <?php require_once 'rules.php'; ?>
                </div>
                <div id="step-2" class="">
                    <div class="form-group">
                        <label for="server_url">Website :</label>
                        <input type="url" class="form-control" name="server_url" id="server_url" placeholder="Enter Old Server Website, ex : https://masterwow.ir">
                    </div>
                    <div class="form-group">
                        <label for="old_realm">Realmlist :</label>
                        <input type="text" class="form-control" name="old_realm"  id="old_realm" placeholder="Enter Old Server Realmlist, ex : logon.masterwow.ir">
                    </div>
                    <div class="form-group">
                        <label for="acc_user">Old Server Username :</label>
                        <input type="text" class="form-control" name="acc_user"  id="acc_user" placeholder="Your Account Username in OLD Server, ex: test">
                    </div>
                    <div class="form-group">
                        <label for="acc_pass">Old Server Password :</label>
                        <input type="text" class="form-control" name="acc_pass"  id="acc_pass" placeholder="Your Account Password in OLD Server, ex : 1234">
                    </div>
                    <p>Your character dump file :</p>
                    <div class="custom-file">
                        <input id="chardump" name="chardump" type="file" class="custom-file-input">
                        <label for="chardump" class="custom-file-label text-truncate">Choose file...</label>
                    </div>
                    <script>
                        $('.custom-file-input').on('change', function() {
                            let fileName = $(this).val().split('\\').pop();
                            $(this).next('.custom-file-label').addClass("selected").html(fileName);
                        });
                    </script>
                </div>
                <div id="step-3" class="">
                    <div class="form-group">
                        <label for="SelectRealm">Select one of our realms :</label>
                        <select name="realmid" class="form-control" id="SelectRealm">
                            <?php
                            foreach (get_config("realmlists") as $a_realm)
                            {
                                echo "<option value='".$antiXss->xss_clean($a_realm["realmid"])."'>".$antiXss->xss_clean($a_realm["realmname"])."</option>";
                            }
                            ?>
                        </select>
                        <p class="text-center">
                            <input type="submit" class="btn btn-lg btn-success" value="Send Migration Request">
                        </p>
                    </div>
                </div>
            </div>
            <p class="text-center" style="padding-bottom: 10px;">
                <a href="../index.php" class="btn btn-sm btn-info">Back</a>
            </p>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#smartwizard').smartWizard();
        });
    </script>
</div>
<?php require_once 'footer.php'; ?>
