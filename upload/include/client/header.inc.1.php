<?php
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: '.__('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8");
header("Content-Security-Policy: frame-ancestors ".$cfg->getAllowIframes().";");

if (($lang = Internationalization::getCurrentLanguage())) {
    $langs = array_unique(array($lang, $cfg->getPrimaryLanguage()));
    $langs = Internationalization::rfc1766($langs);
    header("Content-Language: ".implode(', ', $langs));
}
?>
<!DOCTYPE html>
<html<?php
if ($lang
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo ' dir="rtl" class="rtl"';
if ($lang) {
    echo ' lang="' . $lang . '"';
}
?>>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo Format::htmlchars($title); ?></title>
        <meta name="description" content="customer support platform">
        <meta name="keywords" content="osTicket, Customer support system, support ticket system">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?f1e9e88" media="screen" />
        <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?f1e9e88" media="screen" />
        <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?f1e9e88" media="print" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?f1e9e88" media="screen" />
        <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?f1e9e88"
            rel="stylesheet" media="screen" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH ?>css/jquery-ui-timepicker-addon.css?f1e9e88" media="all" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?f1e9e88" media="screen" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?f1e9e88" media="screen" />
        <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?f1e9e88" />
        <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?f1e9e88" />
        <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?f1e9e88" />
        <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/select2.min.css?f1e9e88" />
        <!-- Favicons -->
        <link rel="icon" type="image/png" href="<?php echo ROOT_PATH ?>images/oscar-favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo ROOT_PATH ?>images/oscar-favicon-16x16.png" sizes="16x16" />
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-3.4.0.min.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.12.1.custom.min.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-timepicker-addon.js?f1e9e88"></script>
        <script src="<?php echo ROOT_PATH; ?>js/osticket.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?f1e9e88"></script>
        <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-plugins.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?f1e9e88"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/select2.min.js?f1e9e88"></script>



        <link rel="stylesheet" type="text/css" href="css/semanticui/semantic.css">
        <link rel="stylesheet" type="text/css" href="css/base.css">

        <script src="css/semanticui/jquery.min.js"></script>
        <script src="css/semanticui/components/visibility.js"></script>
        <script src="css/semanticui/components/sidebar.js"></script>
        <script src="css/semanticui/components/transition.js"></script>
        <script src="css/semanticui/semanticui.js"></script>
        <script src="css/semanticui/semantic.js"></script>
        <script src="css/semanticui/semantic.js"></script>
        <script src="js/base.js"></script>




        <script>
        $(document)
            .ready(function() {

                // fix menu when passed
                $('.masthead')
                    .visibility({
                        once: false,
                        onBottomPassed: function() {
                            $('.fixed.menu').transition('fade in');
                        },
                        onBottomPassedReverse: function() {
                            $('.fixed.menu').transition('fade out');
                        }
                    });

                // create sidebar and attach to menu open
                $('.ui.sidebar')
                    .sidebar('attach events', '.toc.item');

            });
        </script>





        <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }

    // Offer alternate links for search engines
    // @see https://support.google.com/webmasters/answer/189077?hl=en
    if (($all_langs = Internationalization::getConfiguredSystemLanguages())
        && (count($all_langs) > 1)
    ) {
        $langs = Internationalization::rfc1766(array_keys($all_langs));
        $qs = array();
        parse_str($_SERVER['QUERY_STRING'], $qs);
        foreach ($langs as $L) {
            $qs['lang'] = $L; ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>?<?php
            echo http_build_query($qs); ?>" hreflang="<?php echo $L; ?>" />
        <?php
        } ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
            hreflang="x-default" />
        <?php
    }
    ?>
    </head>

    <body>



    


        <!-- Following Menu -->

    
        <div class="ui  hidden menu">
           
        </div>

        <!-- Sidebar Menu -->
        <div class="ui vertical inverted sidebar menu">
               
                <a class="toc item">
                Menu <i class="sidebar icon"></i>
                </a>
                <a class="item " href="<?php  echo ROOT_PATH; ?>index.php"> <?php echo __('Home'); ?></a>

                <a class="item " href="<?php  echo ROOT_PATH; ?>open.php"> <?php echo __('Open a New Ticket'); ?></a>
                <a class="item " href="<?php  echo ROOT_PATH; ?>view.php"> <?php echo __('Check Ticket Status'); ?></a>

                <?php
                if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                    <a class="item " href="<?php  echo ROOT_PATH; ?>tickets.php"> <?php echo __('Check Ticket Status'); ?></a>

                   
                    <a class="ui right item " href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                    <?php
                    }
                
                    elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                                 
                    <!-- <a class=" item" href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></a> -->

                    <?php }?>

                    <?php
                                    if ($thisclient && is_object($thisclient) && $thisclient->isValid()
                                        && !$thisclient->isGuest()) {
                                //echo Format::htmlchars($thisclient->getName()).'&nbsp;|';
                                    ?>
                                   <!-- <div class="right item"> -->
                                        <!-- <a class="item" href="#"><?php echo Format::htmlchars($thisclient->getName()).'&nbsp;';?></a> -->
                                        <a class="item" href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a> 
                                        <a class="item" href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a> 
                                        <a class="item" href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                                   <!-- </div> -->
                                <?php
                                } elseif($nav) {
                                    if ($cfg->getClientRegistrationMode() == 'public') { ?>
                                         <!-- <a class="item" href="#"> <?php echo __('Guest User'); ?> </a>--><?php 
                                    }
                                    if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                                    
                                        <a class="item" href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a><?php
                                    }
                                    elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                                        <a class="item" href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></a>
                                 <?php
                                    }
                                 } ?>


                    
                        <!-- </div> -->
                 </div>   
        </div>


            <!-- Page Contents -->
            <div class="pusher">
            <div class="card"style="text-align:center" >
                <h2 class="ui center aligned image header" >
                <img  src="<?php echo ROOT_PATH; ?>logo.php"  style="width: 15em">
                <!-- <img src="img/logosite.png" src="<?php echo ROOT_PATH; ?>logo.php"  style="width: 5em"> -->
                                               <!-- <img class="logo1"  src="img/logosite.png" src="<?php echo ROOT_PATH; ?>logo.php" width="100%" > -->

                    Chamados TI
                </h2>
                    <div class="ui container">
                        <div class="ui large secondary  pointing menu center">
                            <a class="toc item">
                                <i class="sidebar icon">  </i> Menu
                            </a>
                           <a class="item logo" id="logo" href="<?php echo ROOT_PATH; ?>index.php">
                           <img class="logo1" src="img/logo.png"  width="100%" >
                           <!-- <img class="logo1" src="img/logo.png"  src="<?php echo ROOT_PATH; ?>logo.php" width="100%" > -->
                           <!-- <img class="logo1"  src="img/logosite.png" src="<?php echo ROOT_PATH; ?>logo.php" width="100%" > -->
                                <!-- <img class="logo1"   src="<?php //echo ROOT_PATH; ?>logo.php" width="100%" > -->
                            </a>
                            
                            <a class="item active" href="<?php  echo ROOT_PATH; ?>open.php"> <?php echo __('Open a New Ticket'); ?></a>
                            <a class="item " href="<?php  echo ROOT_PATH; ?>view.php"> <?php echo __('Check Ticket Status'); ?></a>

                            <?php
                            if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                                <a class="item " href="<?php  echo ROOT_PATH; ?>tickets.php"> <?php echo __('Check Ticket Status'); ?></a>

                                <div class="right item">
                                <a class="ui right item " href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                                                        </div> 
                                <?php
                                }
                            
                                elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                                                <!-- <div class="right item">
                                <a class=" item" href="<?php // echo $signin_url; ?>"><?php // echo __('Sign In'); ?></a>
                                                </div> -->

                                <?php }?>


                                <?php
                                    if ($thisclient && is_object($thisclient) && $thisclient->isValid()
                                        && !$thisclient->isGuest()) {
                                //echo Format::htmlchars($thisclient->getName()).'&nbsp;|';
                                    ?>
                                   <div class="right item">
                                        <a class="item" href="#"><?php echo Format::htmlchars($thisclient->getName()).'&nbsp;';?></a>
                                        <a class="item" href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a> 
                                        <a class="item" href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a> 
                                        <a class="item" href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                                   </div>
                                <?php
                                } elseif($nav) {
                                    if ($cfg->getClientRegistrationMode() == 'public') { ?>
                                         <!-- <a class="item" href="#"> <?php echo __('Guest User'); ?> </a>--><?php 
                                    }
                                    if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                                    
                                        <a class="item" href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a><?php
                                    }
                                    elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                                        <div class="right item">
                                            <a class="item" href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></a>
                                            </div>
                                 <?php
                                    }
                                 } ?>

                        </div>
                    </div>
