<?php
$BUTTONS = isset($BUTTONS) ? $BUTTONS : true;
?>
<?php if ($BUTTONS) { ?>


<?php
    if ($cfg->getClientRegistrationMode() != 'disabled'
        || !$cfg->isClientLoginRequired()) { ?>
<!-- <a href="open.php" style="display:block" class="blue button"> -->
<!-- <div class="ui huge primary button">Get Started <i class="right arrow icon"></i></div> -->
<div class="ui huge inverted primary button"><a href="open.php"> <?php
                echo __('Open a New Ticket');?></a>
    <!-- </p> -->
    <?php } ?> </div>



<!-- <a href="view.php" style="display:block" class="green button"> -->
<?php //  ?>
    <div class="ui huge inverted primary button">
        <a href="view.php"><?php  echo ('Check Ticket Status');?></a> 
    </p>
    </div>
<?php } ?>