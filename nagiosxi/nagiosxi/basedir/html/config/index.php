<?php
//
// Copyright (c) 2008-2015 Nagios Enterprises, LLC. All rights reserved.
//
// $Id$

require_once(dirname(__FILE__) . '/../includes/common.inc.php');

// Initialization stuff
pre_init();
init_session();

// Grab GET or POST variables and check pre-reqs
grab_request_vars();
check_prereqs();
check_authentication();

draw_page();

function draw_page()
{

    if (is_authorized_to_configure_objects() == false)
        header("Location: " . get_base_url());

    do_page_start(array("page_title" => _("Configuration")), false);
    ?>
    <div id="leftnav">
        <?php print_menu(MENU_CONFIGURE); ?>
    </div>

    <div id="maincontent">
        <div id="maincontentspacer">
            <iframe src="<?php echo get_window_frame_url("main.php"); ?>" width="100%" frameborder="0"
                    id="maincontentframe" name="maincontentframe">
                [Your user agent does not support frames or is currently configured not to display frames. ]
            </iframe>
        </div>
    </div>

    <?php
    do_page_end(false);
}