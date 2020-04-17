<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$userid=Format::input($_POST['userid']);
?>

<div class="row es1"></div>
<div class="ui stackable grid container">
  
  <div class="wide ten column">


<h2><?php echo __('Forgot My Password'); ?></h2>
<p><?php echo __(
'Enter your username or email address in the form below and press the <strong>Send Email</strong> button to have a password reset link sent to your email account on file.');
?>

<form class="ui form" action="pwreset.php" method="post" id="">
    <div style="width:50%;display:inline-block">
    <?php csrf_token(); ?>
    <input type="hidden" name="do" value="sendmail"/>
    <strong><?php echo Format::htmlchars($banner); ?></strong>
    <br>
    <div class="field">
        <label for="username"><?php echo __('Username'); ?>:</label>
        <input id="username" type="text" name="userid" size="30" value="<?php echo $userid; ?>">
    </div>
    
        <input class="ui button fluid  enviar centered btn" type="submit" value="<?php echo __('Send Email'); ?>">
   
    </div>
</form>

</div>
</div><div class="row es"></div>