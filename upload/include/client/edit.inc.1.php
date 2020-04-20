<?php

if(!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) die('Access Denied!');

?>
<div class="row es1"></div>

<div class="ui stackable grid container centered">
  
  <div class=" ten wide column">
<h2>
    <?php echo sprintf(__('Editing Ticket #%s'), $ticket->getNumber()); ?>
</h2>

<form class="ui form" action="tickets.php" method="post">
    <?php echo csrf_token(); ?>
    <div class="ui field">
    <input type="hidden" name="a" value="edit"/>
    </div>
    <div class="ui field">
    <input type="hidden" name="id" value="<?php echo Format::htmlchars($_REQUEST['id']); ?>"/>
    </div>
    <div class="ui field">
   
        <?php if ($forms)
            foreach ($forms as $form) {
            //   echo '  <div class="ui field">';
                $form->render(['staff' => false]);
            //   echo"  </div>";
        } ?>
    

    </div>
    <div class="ui buttons grid stackable field">
        <input class="ui button fluid red" type="button" value="Cancel" onclick="javascript:
        window.location.href='index.php';"/>
        <input  class="ui button fluid black" type="reset" value="Reset"/>
        <input class="ui button fluid " type="submit" value="Update"/>

<!-- </p> -->
</div>
</form>
<div class="row es"></div>


