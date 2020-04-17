<div class="row es1"></div>

<div class="ui stackable grid container">
  
  <div class="wide ten column">


<h2><?php echo __('Forgot My Password'); ?></h2>
<p><?php echo __(
'Enter your username or email address in the form below and press the <strong>Send Email</strong> button to have a password reset link sent to your email account on file.');
?>

<form class="ui form" action="pwreset.php" method="post" id="clientLogin">
<div style="width:50%;display:inline-block"><?php echo __(
    'We have sent you a reset email to the email address you have on file for your account. If you do not receive the email or cannot reset your password, please submit a ticket to have your account unlocked.'
); ?>
    </div>
</form>
<div class="row es"></div>