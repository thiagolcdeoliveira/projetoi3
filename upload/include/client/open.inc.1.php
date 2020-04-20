<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$form = null;
if (!$info['topicId']) {
    if (array_key_exists('topicId',$_GET) && preg_match('/^\d+$/',$_GET['topicId']) && Topic::lookup($_GET['topicId']))
        $info['topicId'] = intval($_GET['topicId']);
    else
        $info['topicId'] = $cfg->getDefaultTopicId();
}

$forms = array();
if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    foreach ($topic->getForms() as $F) {
        if (!$F->hasAnyVisibleFields())
            continue;
        if ($_POST) {
            $F = $F->instanciate();
            $F->isValidForClient();
        }
        $forms[] = $F->getForm();
    }
}

?> <div class="row es1"></div>
<div class="ui content grid">
    <div class="ui row centered">

        <h2><?php echo __('Open a New Ticket');?></h2>
    </div>
    <div class="ui row centered">
        <?php echo __('Please fill in the form below to open a new ticket.');?>
    </div>

    <div class="ui row">
        <div class="three wide column"></div>
        <div class="ten wide column">
        <!-- <form class="ui form grid" id="ticketForm" method="post" action="open.php" enctype="multipart/form-data"> -->
        <form class="ui form " id="ticketForm" method="post" action="open.php" enctype="multipart/form-data">
                <?php csrf_token(); ?>
                <input type="hidden" name="a" value="open">
                <table class="ui table">
                    <tbody>
                        <?php
                if (!$thisclient) {
                    $uform = UserForm::getUserForm()->getForm($_POST);
                    if ($_POST) $uform->isValid();
                    $uform->render(array('staff' => false, 'mode' => 'create'));
                }
            else { ?>
                        <!-- <div class="two fields">
                            <div class="field">
                                <label><?php// echo __('Email'); ?></label>
                                <?php //echo $thisclient->getEmail(); ?>

                            </div>
                            <div class="field">
                                <label><?php //echo __('Client'); ?></label>
                                <!-- <input placeholder="Last Name" type="text"> -->
                                <!-- <?php// echo Format::htmlchars($thisclient->getName()); ?> -->
                            <!-- </div> -->
                        <!-- </div>  -->
                        <tr>
                       <td colspan="2">
                           <h3>Dados Pessoais</h>
                       </td>
                    </tr>
                        <tr>
                            <td colspan="2">
                            <strong> <?php  echo __('Email'); ?>:</strong>  <?php echo $thisclient->getEmail(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <strong> <?php echo __('Client'); ?>:</strong> <?php echo Format::htmlchars($thisclient->getName()); ?></div>
                                              
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <!-- <hr /> -->
                                <div class="form-header" style="margin-bottom:0.5em">
                                    <b><?php echo __('Help Topic'); ?></b>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <select id="topicId" name="topicId" onchange="javascript:
                    var data = $(':input[name]', '#dynamic-form').serialize();
                    $.ajax(
                      'ajax.php/form/help-topic/' + this.value,
                      {
                        data: data,
                        dataType: 'json',
                        success: function(json) {
                          $('#dynamic-form').empty().append(json.html);
                          $(document.head).append(json.media);
                        }
                      });">
                                    <option value="" selected="selected">&mdash; <?php echo __('Select a Help Topic');?>
                                        &mdash;
                                    </option>
                                    <?php
                if($topics=Topic::getPublicHelpTopics()) {
                    foreach($topics as $id =>$name) {
                        echo sprintf('<option value="%d" %s>%s</option>',
                                $id, ($info['topicId']==$id)?'selected="selected"':'', $name);
                    }
                } else { ?>
                                    <option value="0"><?php echo __('General Inquiry');?></option>
                                    <?php
                } ?>
                                </select>
                                <font class="error">*&nbsp;<?php echo $errors['topicId']; ?></font>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="dynamic-form">
                        <?php
        $options = array('mode' => 'create');
        foreach ($forms as $form) {
            include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
        } ?>
                    </tbody>
                    <tbody>
                        <?php
    if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
        if($_POST && $errors && !$errors['captcha'])
            $errors['captcha']=__('Please re-enter the text again');
        ?>
                        <tr class="captchaRow">
                            <td class="required"><?php echo __('CAPTCHA Text');?>:</td>
                            <td>
                                <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
                                &nbsp;&nbsp;
                                <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
                                <em><?php echo __('Enter the text shown on the image.');?></em>
                                <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
                            </td>
                        </tr>
                        <?php
    } ?>
                    
                    
                </table>
                <div class="ui tree buttons grid stackable centered">
                <button class="ui button  fluid red " type="button" name="cancel" value="<?php echo __('Cancel'); ?>"
                        onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.draft.deleteDraft();
            });
            window.location.href='index.php';"><?php echo __('Cancel'); ?></button>
                
                    <button class="ui button fluid black " type="reset" name="reset" value="<?php echo __('Reset');?>"><?php echo __('Reset');?></button>
                   
                <button class="ui button fluid  " type="submit" value="<?php echo __('Create Ticket');?>"><?php echo __('Create Ticket');?></button>

            </div>
                
                
            </form>
  
        </div>
        
        <!-- <div class="three wide column"></div> -->


    </div>
</div>        <div class="row es"></div>