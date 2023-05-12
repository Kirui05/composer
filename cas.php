<?php
/**
 * @package composer
 */

/*
    Plugin Name: Composer-cas
    Plugin URI: http://.........
    Description: This is a plugin built by nicholas
    Version: 1.0.0
    Author: Nicholas
    Author URI: http://cohort13...............
    Licence: GPLv2 or later
    Text Domain: composer-cas
*/

// security check
defined('ABSPATH') or die('Security breaches identified');


// Checking if composer exists
if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once(dirname(__FILE__).'/vendor/autoload.php');
}
function activate_c13plugin(){
    Inc\Base\Activate::activate();
}

function deactivate_c13plugin(){
    Inc\Base\Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_c13plugin');

register_deactivation_hook(__FILE__, 'deactivate_c13plugin');

if(class_exists('Inc\\Init')){
    Inc\Init::register_services(); //considers all classes as services
}

// <?php

class WordPressCohortMenu {
    public function register_menu() {
        add_menu_page(
            'WordPress Cohort',
            'WordPress Cohort',
            'manage_options',
            'wordpress-cohort-plugin',
            array($this, 'cohort_menu_page'),
            'dashicons-groups'
        );
    }

    public function cohort_menu_page() {
        if (isset($_POST['submit'])) {
            // Process and save the form data here
            $name = sanitize_text_field($_POST['name']);
            $phone = sanitize_text_field($_POST['phone']);
            $email = sanitize_email($_POST['email']);

            // Example: Saving the data to WordPress options
            $members = get_option('wordpress_cohort_members', array());
            $members[] = array(
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
            );
            update_option('wordpress_cohort_members', $members);

            echo '<div class="notice notice-success"><p>Member added successfully!</p></div>';
        }
        ?>
        <div class="wrap">
            <h1>Add Cohort Member</h1>
            <form method="post" action="">
                <table class="form-table">
                    <tr>
                        <th><label for="name">Name</label></th>
                        <td><input type="text" name="name" id="name" required></td>
                    </tr>
                    <tr>
                        <th><label for="phone">Phone</label></th>
                        <td><input type="text" name="phone" id="phone" required></td>
                    </tr>
                    <tr>
                        <th><label for="email">Email</label></th>
                        <td><input type="email" name="email" id="email" required></td>
                    </tr>
                </table>
                <?php submit_button('Add Member', 'primary', 'submit', false); ?>
            </form>
        </div>
        <?php
    }
}
?>