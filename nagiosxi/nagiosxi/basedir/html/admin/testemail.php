<?php
//
// Test email script - passed here by the test email link in mail settings.
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


route_request();


function route_request()
{
    global $request;

    if (isset($request['update'])) {
        do_test();
    } else {
        show_test();
    }
}


function show_test($error = false, $msg = "")
{
    $email = get_user_attr(0, "email");

    do_page_start(array("page_title" => _('Test Email Settings')), true);
?>

    <h1><?php echo _('Test Email Settings'); ?></h1>

    <?php display_message($error, false, $msg); ?>

    <p><?php echo _('Use this to send a test email to your current logged in user address to verify you can recieve alerts from Nagios XI.'); ?></p>

    <form method="post" action="">
        <input type="hidden" name="update" value="1">
        <p><?php echo _("An email will be sent to"); ?>: <b><?php echo $email; ?></b></p>
        <p><a href="<?php echo get_base_url() . "account/?xiwindow=main.php"; ?>" target="_top"><b><?php echo _("Change your email address"); ?></b></a></p>
        <div style="margin-top: 20px;">
            <a href="mailsettings.php" class="btn btn-sm btn-default"><i class="fa fa-chevron-left"></i> <?php echo _('Back'); ?></a>
            <button type="submit" class="btn btn-sm btn-primary" name="sendbutton"><i class="fa fa-paper-plane"></i> <?php echo _('Send Test Email'); ?></button>
        </div>
    </form>

    <?php

    do_page_end(true);
    exit();
}


function do_test()
{

    // Check if demo mode
    if (in_demo_mode() == true) {
        show_test(true, _("Changes are disabled while in demo mode."));
    }

    $email = grab_request_var("email", "");
    $test_email = true;
    $output = array();
    // Use this for debug output in PHPmailer log
    $debugmsg = "";

    // Get the admin email
    $admin_email = get_option("admin_email");

    // Get the user's email address
    if ($email == "") {
        $email = get_user_attr(0, "email");
    }

    // Send a test email notification
    if ($test_email == true) {

        // Get the email subject and message
        $subject = "Nagios XI Email Test";
        $message = _("This is a test email from Nagios XI");

        // Set where email is coming from for PHPmailer log
        $send_mail_referer = "admin/testemail.php";

        $opts = array(
            "from" => "Nagios XI <" . $admin_email . ">",
            "to" => $email,
            "subject" => $subject,
        );
        $opts["message"] = $message;
        $result = send_email($opts, $debugmsg, $send_mail_referer);

        $opts["debug"] = true;

        $output[] = _("A test email was sent to ") . "<b>" . $email . "</b>";
        $output[] = "----";

        $output[] = _("Mailer said") . ": <b>" . $debugmsg . "</b>";

        // Check for errors
        if ($result == false) {
            $output[] = _("An error occurred sending a test email!");
            show_test(true, $output);
        }
    }

    show_test(false, $output);
    return $output;
}