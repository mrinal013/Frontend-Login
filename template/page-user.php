<?php
/**
* Template Name: User Page Template
*/
get_header();
?>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Login</a></li>
    <li><a href="#tabs-2">Registration</a></li>
    <li><a href="#tabs-3">Password recovery</a></li>
    <li><a href="#tabs-4">Reset password</a></li>
  </ul>
  <div id="tabs-1">
    <?php wp_login_form(); ?>
  </div>
  <div id="tabs-2">
    <form name="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
        <p>
            <label for="user_login">Username</label>
            <input type="text" name="user_login" value="">
        </p>
        <p>
            <label for="user_email">E-mail</label>
            <input type="text" name="user_email" id="user_email" value="">
        </p>
        <p style="display:none">
            <label for="confirm_email">Please leave this field empty</label>
            <input type="text" name="confirm_email" id="confirm_email" value="">
        </p>

        <p id="reg_passmail">A password will be e-mailed to you.</p>

        <input type="hidden" name="redirect_to" value="/login/?action=register&success=1" />
        <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" value="Register" /></p>
    </form>
  </div>
  <div id="tabs-3">
    <form name="lostpasswordform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post">
        <p>
            <label for="user_login">Username or E-mail:</label>
            <input type="text" name="user_login" id="user_login" value="">
        </p>

        <input type="hidden" name="redirect_to" value="/login/?action=forgot&success=1">
        <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" value="Get New Password" /></p>
    </form>
  </div>

  <div id="tabs-4">
    <form name="resetpasswordform" action="<?php echo site_url('wp-login.php?action=resetpass', 'login_post') ?>" method="post">
    <p class="form-password">
        <label for="pass1">New Password</label>
        <input class="text-input" name="pass1" type="password" id="pass1">
    </p>
    <p class="form-password">
        <label for="pass2">Confirm Password</label>
        <input class="text-input" name="pass2" type="password" id="pass2">
    </p>

    <input type="hidden" name="redirect_to" value="/login/?action=resetpass&success=1">
    <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" value="Get New Password" /></p>
</form>

  </div>
</div>

<?php
get_footer();