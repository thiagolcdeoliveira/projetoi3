<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$ticketid=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);

if ($cfg->isClientEmailVerificationRequired())
    $button = __("Email Access Link");
else
    $button = __("View Ticket");
?>
<div class="row es1"></div>
<div class="ui stackable grid container">
  
  <div class="wide ten column">
        <h2><?php echo __('Check Ticket Status'); ?></h2>
        <p><?php
        echo __('Please provide your email address and a ticket number.');
        if ($cfg->isClientEmailVerificationRequired())
            echo ' '.__('An access link will be emailed to you.');
        else
            echo ' '.__('This will sign you in to view your ticket.');
        ?></p>
     </div>
</div>

<div class="ui stackable grid container">
  
  <div class="wide ten column">
<div class="ui two column  stackable grid">
    <div class="column">
<form class="ui form"  action="login.php" method="post" id="">
    <?php csrf_token(); ?>
        <div class="field">
          <label><?php echo __('Email Address'); ?></label>
            <div class="ui left icon input">
                <strong><?php echo Format::htmlchars($errors['login']); ?></strong>
                <!-- <label for="email"><?php // echo __('Email Address'); ?>: -->
                <input id="email" placeholder="<?php echo __('e.g. john.doe@osticket.com'); ?>" type="text"
                    name="lemail" size="30" value="<?php echo $email; ?>" class="nowarn"></label>
                    <i class="user icon"></i>
             </div>
       </div>
       <div class="field">
          <label><?php echo __('Ticket Number'); ?> </label>
          <div class="ui left icon input">
          <!-- <input id="ticketno" type="text" name="lticket" placeholder="<?php //echo __('e.g. 051243'); ?>" -->
            <!-- size="30" value="<?php //echo $ticketid; ?>" class="nowarn">  -->
          <!-- <label for="ticketno"><?php // echo __('Ticket Number'); ?>:
            <input id="ticketno" type="text" name="lticket" placeholder="<?php // echo __('e.g. 051243'); ?>"
            size="30" value="<?php //echo $ticketid; ?>" class="nowarn"></label> -->
            <input id="ticketno" type="text" name="lticket" placeholder="<?php echo __('e.g. 051243'); ?>"
            size="30" value="<?php echo $ticketid; ?>" class="nowarn">
            <i class="tag icon"></i>
            <!-- <input class="btn" type="submit" value="<?php echo $button; ?>"> -->
            <!-- <i class="tag icon"></i> -->
          </div>
        </div>

        <div class="field">
            <button class="ui button big fluid center enviar red" type="submit" > <?php echo $button; ?> </button>
            <!-- <input class="btn" type="submit" value="<?php //echo $button; ?>"> -->
        </div>

</form>
</div>
    <div class="middle aligned column">
    <div class="ui buttons vertical stackable">

            <!-- <buton class="ui button fluid enviar"> -->
    <!-- <p> -->
                <?php if ($cfg && $cfg->getClientRegistrationMode() !== 'disabled') { ?>
                        <?php echo __('Have an account with us?'); ?>
                        <a href="login.php">  
                        <buton class="ui button fluid enviar2">
                        <?php echo __('Sign In'); ?>
                        </buton>
                    </a>
                        
                    <div class="ui horizontal divider">
                       OU
                     </div>
                            
                    <?php
                        if ($cfg->isClientRegistrationEnabled()) { ?>
                         <a href="account.php?do=create"> <buton class="ui button fluid enviar1"> 
                        <?php  echo (__('Create account')); ?> </buton></a>
                        <?php //echo sprintf(__('or %s register for an account %s to access all your tickets.'),
                           // '<a href="account.php?do=create"><buton class="ui button fluid enviar">','</buton></a>');
                            }
                        }?>
                
    <!-- </p> -->
    
            <?php
            if ($cfg->getClientRegistrationMode() != 'disabled'
                || !$cfg->isClientLoginRequired()) {
                echo sprintf(
                __("If this is your first time contacting us or you've lost the ticket number, please %s open a new ticket %s"),
                '<a href="open.php">','</a>');
            } ?>
    </div>
    </div>
</div>

    <div class="ui vertical divider">
        OU
    </div>



</div>
</div></div>
<div class="row es"></div>