<div class="row es1"></div>
<div class="ui stackable grid container">
  
  <div class=" ten wide column centered ">


<h2><?php echo __('Manage Your Profile Information'); ?></h2>
<p><?php echo __(
'Use the forms below to update the information we have on file for your account'
); ?>
</p>
<form class="ui form centered" action="profile.php" method="post">
  <?php csrf_token(); ?>
<?php
foreach ($user->getForms() as $f) {
    $f->render(['staff' => false]);
}
if ($acct = $thisclient->getAccount()) {
    $info=$acct->getInfo();
    $info=Format::htmlchars(($errors && $_POST)?$_POST:$info);
?>

    <!-- <tr>
        <td width="180">
            <?php //echo __('Time Zone');?>:
        </td>
        <td>
            <?php
            // $TZ_NAME = 'timezone';
            // $TZ_TIMEZONE = $info['timezone'];
            // include INCLUDE_DIR.'staff/templates/timezone.tmpl.php'; ?>
            <!-- <div class="error"><?php //echo $errors['timezone']; ?></div> 
        </td>
    </tr> -->
<?php if ($cfg->getSecondaryLanguages()) { ?>
  
    <h3> <?php echo __('Preferred Language'); ?></h3>
      
    <?php
    $langs = Internationalization::getConfiguredSystemLanguages(); ?>
            <select name="lang">
                <option value="">&mdash; <?php echo __('Use Browser Preference'); ?> &mdash;</option>
<?php foreach($langs as $l) {
$selected = ($info['lang'] == $l['code']) ? 'selected="selected"' : ''; ?>
                <option value="<?php echo $l['code']; ?>" <?php echo $selected;
                    ?>><?php echo Internationalization::getLanguageDescription($l['code']); ?></option>
<?php } ?>
            </select>
            <span class="error">&nbsp;<?php echo $errors['lang']; ?></span>
       
<?php }
      if ($acct->isPasswdResetEnabled()) { ?>
<h3><?php echo __('Access Credentials'); ?></h3>
    
<?php if (!isset($_SESSION['_client']['reset-token'])) { ?>
         <div class="field"> 
        <label><?php echo __('Current Password'); ?></label>
   
        <input type="password" size="18" name="cpasswd" value="<?php echo $info['cpasswd']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['cpasswd']; ?></span>
         </div>
<?php } ?>
<div class="field"> 
        <label><?php echo __('New Password'); ?></label>
   
        <input type="password" size="18" name="passwd1" value="<?php echo $info['passwd1']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
        </div>
        <div class="field"> 
        <label> <?php echo __('Confirm New Password'); ?></label>
   
        <input type="password" size="18" name="passwd2" value="<?php echo $info['passwd2']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>
        </div>
<?php } ?>
<?php } ?>

<div class="ui grid stackable buttons  " style="text-align: center;">
    <input class="ui button red fluid enviar2"type="button" value="Cancel" onclick="javascript:
            window.location.href='index.php';"/>
            <!-- <input class="ui button "type="submit" value="Update"/> -->
    <input class="ui button fluid enviar2"type="reset" value="Reset"/>  
    <input class="ui button black fluid enviar2"type="submit" value="Update"/>
</div>
</form>
<div class="row es"></div>