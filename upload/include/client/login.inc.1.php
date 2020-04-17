<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['luser']?:$_GET['e']);
$passwd=Format::input($_POST['lpasswd']?:$_GET['t']);

$content = Page::lookupByType('banner-client');

if ($content) {
    list($title, $body) = $ost->replaceTemplateVariables(
        array($content->getLocalName(), $content->getLocalBody()));
} else {
    $title = __('Sign In');
    $body = __('To better serve you, we encourage our clients to register for an account and verify the email address we have on record.');
}



?> <div class="row es1"></div>

<div class="ui stackable grid container">
  
  <div class="wide ten column">
  <!-- <h1><?php echo Format::display($title); ?></h1>
<p><?php echo Format::display($body); ?></p> -->
  </div>
</div>

<div class="ui stackable grid container">
  
  <div class="wide ten column">
  


<div class="ui two column  stackable grid">
    <div class="column">
      <h2 style="text-align: center"> Login</h2>
      <!-- clientLogin -->
      <form class="ui form" action="login.php" method="post" id="">
      <?php csrf_token(); ?>
        <div class="field">
          <label>Email</label>
          <div class="ui left icon input">
            <!-- <input type="text" placeholder="Email"> -->
            <!-- <div class="login-box"> -->
            <strong>
            <?php echo Format::htmlchars($errors['login']); ?></strong>
            
            <input id="username" placeholder="<?php echo __('Email or Username'); ?>" type="text" name="luser" size="30" value="<?php echo $email; ?>" class="nowarn">
            <!-- </div> -->
           
            <i class="user icon"></i>
          </div>
        </div>
        <div class="field">
          <label>Senha</label>
          <div class="ui left icon input">
            <!-- <input type="password" placeholder="********"> -->
           
             <input id="passwd" placeholder="<?php echo __('Password'); ?>" type="password" name="lpasswd" size="30" value="<?php echo $passwd; ?>" class="nowarn"></td>
   
            <i class="tag icon"></i>
          </div>
        </div>
        <!-- <div class="ui red submit button">Login</div> -->
        <div class="field">
        <button class="ui button big fluid center enviar red" type="submit">  <?php echo __('Sign In'); ?> </button>
        </div>
        
    </form>
    </div>
    <div class="middle aligned column">
    <div class="ui buttons vertical stackable">

<?php if ($suggest_pwreset) { ?>
        <a style="padding-top:4px;display:inline-block;" href="pwreset.php"> <button class="ui button fluid enviar"> <?php echo __('Forgot My Password'); ?></button> </a>
<?php } ?>

<?php
$ext_bks = array();
foreach (UserAuthenticationBackend::allRegistered() as $bk)
    if ($bk instanceof ExternalAuthentication)
        $ext_bks[] = $bk;
if (count($ext_bks)) {
    foreach ($ext_bks as $bk) { ?>
<?php $bk->renderExternalLink(); ?>
<?php
    }
}
if ($cfg && $cfg->isClientRegistrationEnabled()) {
    if (count($ext_bks)) echo '<hr style="width:70%"/>'; ?>
    <?php echo __('Not yet registered?'); ?> 
    
    <a href="account.php?do=create">
      <!-- <button class="" -->
        <!-- <button class="" -->
      <buton class="ui button fluid enviar2">
       <?php echo __('Create an account'); ?>
      </buton>
</a>
<?php } ?>


                    <div class="ui horizontal divider">
                       OU
                     </div>

<!-- </div> -->

  <!-- <p> -->
    <!-- <b><?php echo __("I'm an agent"); ?></b>  -->
    <a href="<?php echo ROOT_PATH; ?>scp/"><buton class="ui button fluid enviar1"> 
    <?php //echo __('sign in here'); ?>
    <?php  echo __("I'm an agent"); ?>
      </buton>
    </a>
  <!-- </p> -->
<?php
if ($cfg->getClientRegistrationMode() != 'disabled'
    || !$cfg->isClientLoginRequired()) {
   // echo sprintf(__('If this is your first time contacting us or you\'ve lost the ticket number, please %s open a new ticket %s'),
 //       '<a href="open.php">', '</a>');
} ?>
</div>

    </div>
</div>


    <div class="ui vertical divider">
        OU
    </div>
   </div>
</div>

</div>

<div class="row es"></div>