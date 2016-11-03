<?php
//
//  Nagios Core Config Manager
//  Copyright (c) 2010-2016 Nagios Enterprises, LLC
//
//  File: xi-index.php
//  Desc: Page that Nagios XI uses to integrate the CCM into the page. This creates a window with
//        the actual CCM index.php inside of it. This page has forceful Nagios XI authentication
//        (i.e. it will send you back to the main page) because it is a part of the Nagios XI GUI,
//        whereas the normal CCM index.php does not require XI authentication to view.
//

require_once(dirname(__FILE__).'/../componenthelper.inc.php');

// Initialization stuff
pre_init();
init_session();

// Grab GET or POST variables and check pre-reqs
grab_request_vars();
check_prereqs();
check_authentication();

draw_page();

function draw_page() {
    
    if (is_authorized_to_configure_objects() == false) {
        header("Location: ".get_base_url());
    }
    
    // Pass some variables if we want to redirect people
    $type = grab_request_var('type', '');
    $cmd = grab_request_var('cmd', '');
    $id = grab_request_var('id', '');

    $url = 'index.php?menu=invisible';

    if (!empty($cmd)) { $url .= '&cmd='.$cmd; }
    if (!empty($type)) { $url .= '&type='.$type; }
    if (!empty($id)) { $url .= '&id='.$id; }

    $pageopt = grab_request_var("pageopt", "");
    do_page_start(array("page_title" => _("CCM")), false);
?>

<div id="leftnav">
    <?php print_menu(MENU_CCM); ?>
</div>

<div id="maincontent">
    <div id="maincontentspacer">
        <iframe src="<?php echo $url; ?>" width="100%" frameborder="0" id="maincontentframe" name="maincontentframe">
        [Your user agent does not support frames or is currently configured not to display frames. ]
        </iframe>
    </div>
</div>

<?php   
    do_page_end(false);
}