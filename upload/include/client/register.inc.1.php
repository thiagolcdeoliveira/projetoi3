<?php
$info = $_POST;
if (!isset($info['timezone']))
    $info += array(
        'backend' => null,
    );
if (isset($user) && $user instanceof ClientCreateRequest) {
    $bk = $user->getBackend();
    $info = array_merge($info, array(
        'backend' => $bk::$id,
        'username' => $user->getUsername(),
    ));
}
$info = Format::htmlchars(($errors && $_POST)?$_POST:$info);

?>



<div class="ui stackable grid container ">
<!-- <div class=" two wide column"> teste </div> -->
  <div class=" eight wide column centered">
  <div class="row es1"></div>

<h2><?php echo __('Account Registration'); ?></h2>
<p><?php echo __(
'Use the forms below to create or update the information we have on file for your account'
); ?>
</p>
<form class="ui form" action="account.php" method="post">
  <?php csrf_token(); ?>
  <input type="hidden" name="do" value="<?php echo Format::htmlchars($_REQUEST['do']
    ?: ($info['backend'] ? 'import' :'create')); ?>" />
    <?php
        $cf = $user_form ?: UserForm::getInstance();
        $cf->render(array('staff' => false, 'mode' => 'create'));
    ?>
        
        
       <h3> <?php echo __('Access Credentials'); ?> </h3>


        <?php if ($info['backend']) { ?>

        <?php echo __('Login With'); ?>:
    
    <input type="hidden" name="backend" value="<?php echo $info['backend']; ?>"/>
    <input type="hidden" name="username" value="<?php echo $info['username']; ?>"/>
        <?php foreach (UserAuthenticationBackend::allRegistered() as $bk) {
            if ($bk::$id == $info['backend']) {
                echo $bk->getName();
                break;
            }
} ?>
   
<?php } else { ?>

        <?php echo __('Create a Password'); ?>:
    
        <input type="password" size="18" name="passwd1" value="<?php echo $info['passwd1']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
 
        <?php echo __('Confirm New Password'); ?>:
   
        <input type="password" size="18" name="passwd2" value="<?php echo $info['passwd2']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>

<?php } ?>


    <div class="ui two buttons">
    <input class="ui button fluid blue enviar" type="submit" value="<?php echo __('Register'); ?>"/>
    <input class="ui button fluid red enviar" type="button" value="<?php echo __('Cancel'); ?>" onclick="javascript:
        window.location.href='index.php';"/>
    </div>

</form>
<div class="row es"></div>
</div>
</div>

