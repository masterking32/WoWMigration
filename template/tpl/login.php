<?php
/**
 * Created by Amin.MasterkinG
 * Website : MasterkinG32.CoM
 * Email : lichwow_masterking@yahoo.com
 * Date: 11/26/2018 - 8:36 PM
 */
require_once 'header.php'; ?>
<div class="login-form">
    <form action="" method="post">
        <img src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/images/wow-logo.png">
        <?php error_msg(); success_msg(); //Display message. ?>
        <p class="alert alert-info">Login with your game account.</p>
        <div class="input-group">
            <span class="input-group" >Username</span>
            <input type="text" class="form-control" placeholder="Username" name="username">
        </div>
        <div class="input-group">
            <span class="input-group">Password</span>
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="input-group">
            <span class="input-group" >Captcha</span>
            <input type="text" class="form-control" placeholder="Captcha" name="captcha">
        </div>
        <p style="text-align: center;margin-top: 10px;">
            <img src="<?php echo user::$captcha->inline(); ?>" style="border-radius: 5px;"/>
        </p>
        <div class="text-center" style="margin-top: 10px;"><input type="submit" class="btn btn-success" value="Login"></div>
        <div class="text-center" style="margin-top: 10px;">
			<a href='https://www.aparat.com/v/vYj45' target='_blank'>
				<img src='<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/images/13864129-9134__9833.jpg'>
				<br>
				<p style='font-family:tahoma'>ویدیو آموزش انتقال کاراکتر</p>
			</a>
		</div>
    </form>
</div>
<?php require_once 'footer.php'; ?>
