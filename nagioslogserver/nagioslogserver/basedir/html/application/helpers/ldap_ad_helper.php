<?php

// =====================================
//  LDAP / AD Connection(s)
// =====================================

function open_server_conn($server_id)
{
    $ci =& get_instance();

    // Start by determining what to connect to
    $raw_servers = $ci->config_option->get('auth_servers', true);
    if (!empty($raw_servers)) {
        $servers = unserialize(base64_decode($raw_servers));
    } else {
        $servers = array();
    }

    foreach ($servers as $s) {
        if ($s['id'] == $server_id) {
            $server = $s;
            break;
        }
    }

    if (empty($server)) {
        return false;
    }

    // Connect to the server...
    if ($server['type'] == "ldap") {

        $ci->load->library('basicLDAP');

        $use_ssl = false;
        $use_tls = false;

        if ($server['encryption'] == "ssl") {
            $use_ssl = true;
        } else if ($server['encryption'] == "tls") {
            $use_tls = true;
        }

        $ldap = new basicLDAP($server['host'], $server['port'], $server['basedn'], $server['encryption']);
        return $ldap;

    } else if ($server['type'] == "ad") {

        $ci->load->library('adLDAP/adLDAP');

        $use_ssl = false;
        $use_tls = false;

        if ($server['encryption'] == "ssl") {
            $use_ssl = true;
        } else if ($server['encryption'] == "tls") {
            $use_tls = true;
        }

        $controllers = explode(',', $server['controllers']);

        // Create the adLDAP object...
        $options = array('account_suffix' => $server['suffix'],
                         'base_dn' => $server['basedn'],
                         'domain_controllers' => $controllers,
                         'use_ssl' => $use_ssl,
                         'use_tls' => $use_tls);

        try {
            $ad = new adLDAP($options);
            return $ad;
        } catch (adLDAPException $e) {
            return false;
        }

    }

    return false;
}

function create_auth_connection()
{
    $ci =& get_instance();
    $username = $ci->session->userdata('auth_import_username');
    $password = $ci->session->userdata('auth_import_password');
    $server_id = $ci->session->userdata('auth_import_server_id');
    $conn = open_server_conn($server_id);

    // Try to check authentication when creating a new object
    try {
        $x = $conn->authenticate($username, $password);
        if (!$x) {
            ldap_get_option($conn->getLdapConnection(), LDAP_OPT_ERROR_STRING, $out);
            if (empty($out)) {
                $ad_error = _("Could not connect to the LDAP server selected.");
            } else {
                $ad_error = $out;
            }
            return false;
        }
        return $conn;
    } catch (Exception $ex) {
        $ad_error = $ex->getMessage();
        return false;
    }
}

// ====================================
//  API Helper Functions
// ====================================

function grab_ad_folders($folder="", $type="container")
{
    $conn = create_auth_connection();
    
    if ($type == "organizationalUnit") {
        if ($conn->type == "ad") {
            $list_array = $conn->folder()->listing($folder, adLDAP::ADLDAP_FOLDER, false);
        } else {
            $list_array = $conn->folder_listing($folder, basicLDAP::LDAP_FOLDER);
        }
        return check_validity($list_array);
    } else if ($type == "container") {
        if ($conn->type == "ad") {
            $list_array = $conn->folder()->listing($folder, adLDAP::ADLDAP_CONTAINER, false);
        } else {
            $list_array = $conn->folder_listing($folder, basicLDAP::LDAP_CONTAINER);
        }
        return check_validity($list_array);
    } else if ($type == "group") {
        $folder = grab_array_var($folder, "0");
        $ad_array = $conn->group()->members($folder);
        return $ad_array;
    }

    return false;
}

// ====================================
//  HTML Generating Functions
// ====================================

function display_nav_window($array_to_enum, $new_list=0)
{
    // Hide some folders that shouldn't be shown because they are very VERY unlikely to have users in them
    // unless someone likes putting their users in strange places...
    $dont_show = array("System", "Program Data", "ForeignSecurityPrincipals", "Managed Service Accounts");

    if ($new_list) {
        echo '<ul class="ad-list folder-list">';
    } else {
        echo '<ul class="ad-list sub-list">';
    }

    if (!($array_to_enum == false)) {
        foreach ($array_to_enum as $obj) {
            if (is_array($obj)) {
                $path = json_encode(grab_path($obj));
                $dn = grab_dn($obj);
                $type = grab_type($obj);

                if ($type == "organizationalUnit" || $type == "container" || $type == "group") {
                    
                    // Skip if the object is something we don't need to display
                    if (in_array($dn, $dont_show)) {
                        continue;
                    }

                    if ($type == "group") { $image = "group.png"; }
                    if ($type == "container") { $image = "folder.png"; }
                    if ($type == "organizationalUnit") { $image = "folder_page.png"; }
                    ?>
                    <li>
                        <span class="ad-folder" data-path='<?php echo $path; ?>' data-type="<?php echo $type; ?>">
                            <img class="table-icon" src="<?php echo base_url('media/icons/'.$image);?>">
                            <?php echo $dn; ?>
                        </span>
                    </li>
                    <?php
                }
            }
        }
    }
    echo '</ul>';
}

function display_users($array_to_enum, $location, $type, $selected)
{
    // List of usernames not to show...
    $dont_show = array("krbtgt");

    $location = grab_array_var($location, "0");
    $conn = create_auth_connection();
    $person_exists = false;
    $all_checked = true;
    $printed = false;

    if (!empty($array_to_enum)) {
        echo '<ul class="ad-list user-list">';
        if ($type == "group") {
            foreach ($array_to_enum as $username)
            {
                $person_exists = true;
                $userinfo = $conn->user()->info($username, array("displayname"));
                $displayname = $userinfo[0]["displayname"][0];
                $dn = $userinfo[0]["dn"];

                ?>
                <li>
                    <label class="checkbox">
                        <input type="checkbox" class="ad-checkbox" value="<?php if ($conn->type == "ad") { echo $username; } else { echo $dn; } ?>" <?php if (in_array($username, $selected)) { echo "checked"; } else { $all_checked = false; } ?>>
                        <img class="table-icon" src="<?php echo base_url("media/icons/user.png"); ?>" border="0" alt="<?php echo _('Add user'); ?>" title="<?php echo _('Add user'); ?>" style="">
                        <?php echo $displayname; ?> (<?php echo $username; ?>)
                    </label>
                    <i class="fa fa-plus-square-o user-toggle-show-dn" title="<?php echo _("Show full DN (distinguished name)"); ?>"></i>
                    <div class="user-dn hide">DN: <?php echo $dn; ?></div>
                </li>
                <?php
            }
        } else {
            foreach ($array_to_enum as $obj)
            {
                if (is_array($obj)) {

                    $type = grab_type($obj);
                    if ($type == "person" || $type == "inetOrgPerson") {
                        $username = grab_user_name($type, $obj);
                        $dn = grab_full_dn($obj);

                        if (in_array($username, $dont_show)) {
                            continue;
                        }

                        $image = grab_image_for_type($obj);
                        $person_exists = true;
                        ?>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" class="ad-checkbox" value="<?php if ($conn->type == "ad") { echo $username; } else { echo $dn; } ?>" <?php if (is_computer($obj)) { echo "disabled"; } ?> <?php if (in_array($username, $selected)) { echo "checked"; } else { $all_checked = false; } ?>>
                                <img class="table-icon" src="<?php echo base_url('media/icons/'.$image); ?>" border="0" alt="<?php echo _("Add user"); ?>" title="<?php echo _("Add user"); ?>" style="">
                                <?php echo grab_dn($obj); ?> (<?php echo $username; ?>)
                            </label>
                            <i class="fa fa-plus-square-o user-toggle-show-dn" title="<?php echo _("Show full DN (distinguished name)"); ?>"></i>
                            <div class="user-dn hide">DN: <?php echo $dn; ?></div>
                        </li>
                        <?php
                    }
                }
            }
        }
        if ($person_exists) {
        ?>
            <li style="margin-top: 10px;">
                <label class="checkbox">
                    <input type="checkbox" class="toggle-users" <?php if ($all_checked) { echo "checked"; } ?>>
                    <span><?php if ($all_checked) { echo _("Select None"); } else { echo _("Select All"); } ?></span>
                </label>
            </li>
        <?php
        } else {
            echo '<li>'._("No users or computers found in this object.").'</li>';
            $printed = true;
        }
        echo '<ul>';
    }

    if (!$person_exists && !$printed) {
        echo '<ul class="ad-list user-list">';
        echo '<li>'._("No users or computers found in this object.").'</li>';
        echo "</ul>";
    }
}

// ==============================
//  Random Helper Functions
// ==============================

function check_validity($ad_array) {
    $count = grab_array_var($ad_array, "count", 0);
    if (!($count == 0)) {
        return $ad_array;
    } else {
        return false;
    }
}

function grab_type($obj) {
    $item = grab_array_var($obj, "objectclass", "");
    if (!empty($item)) {
        $type = grab_array_var($item, "1", "");
        if (empty($type)) {
            $type = grab_array_var($item, "0", "");
        }
        return $type;
    }
}

function grab_user_name($type, $obj) {
    if ($type == "person") {
        $item = grab_array_var($obj, "samaccountname");
        if (!empty($item)) {
            return grab_array_var($item, "0", "");
        }
    } else if ($type == "inetOrgPerson") {
        $item = grab_array_var($obj, "uid");
        if (!empty($item)) {
            return grab_array_var($item, "0", "");
        }
    }
}

function grab_dn($obj) {
    $item = grab_array_var($obj, "dn");
    if (!($item == "")) {
        $dn = explode(",", $item);
        $value = explode("=", grab_array_var($dn, "0"));
        return grab_array_var($value, "1");
    }
}

function grab_full_dn($obj) {
    return grab_array_var($obj, "dn", grab_dn($obj));
}

function grab_path($obj) {
    $item = grab_array_var($obj, "dn", "");
    $path = array();
    
    if (!($item == "")) {
        $fully_qualified = explode(",", $item);
        foreach ($fully_qualified as $branch) {
            $value = explode("=", $branch);
            $id = grab_array_var($value, "0");
            if (strtoupper($id) == "OU" || strtoupper($id) == "CN") {
                $ou_location = grab_array_var($value, "1");
                if (!($ou_location == "")){
                    array_push($path, $ou_location);
                }
            }
        }
    }
    return $path;
}

function grab_image_for_type($obj)
{
    if (is_user($obj)) {
        $image = "user.png";
    }
    if (is_computer($obj)) {
        $image = "monitor.png";
    }
    return $image;
}

function is_computer($ad_array) {
    $comp = grab_array_var($ad_array["objectclass"], "4", "");
    if ($comp == "computer") {
        return true;
    }
    return false;
}

function is_user($ad_obj) {
    $ci =& get_instance();
    $type = $ci->session->userdata('auth_import_server_type');

    if ($type == "ad") {
        $comp = grab_array_var($ad_obj["objectclass"], "4", "");
        $person = grab_array_var($ad_obj["objectclass"], "1", "");
        if (empty($comp) && $person == "person") {
            return true;
        }
    } else if ($type == "ldap") {
        $person = grab_array_var($ad_obj["objectclass"], "0", "");
        if ($person == "inetOrgPerson") {
            return true;
        }
    }
    return false;
}
