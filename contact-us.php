<?php
/*
Plugin Name: Contact us
Plugin URI: http://wordpress.org/plugins/contact-us/
Description: This plugin is used to create contact us form
Author: Vikash lohiya
Version: 1.0
Author URI: vikash.com
*/



class ContactUs{
    
    public function __construct() {
         add_action('admin_menu', array($this, 'create_contactus_link'));
    }
    
    public function create_contactus_link() {
         add_menu_page('Contact us List', 'Contact us List', 'manage_options', 'contact_us_list', array($this, 'contact_us_list'), 'dashicons-visibility');
    }
    
    public function contact_us_list() {     
        require_once('backend/contactus_list.php');
        $obj = new Contactus_List();
        echo '<div class="wrap col-sm-3"><h2>Contactus List</h2>';
        $obj->prepare_items();       
        $obj->display();
        echo '</div>';
    }
    
    public static function create_table() {
     global $wpdb;
    
    // Set the charset and collate
    $charset_collate = $wpdb->get_charset_collate();

    // Define the table name, including the WordPress table prefix
    $table_name = $wpdb->prefix . 'contactus';
    
    // SQL statement to create the table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email varchar(20) NOT NULL,
        message  text NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Include the file to enable dbDelta function
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // Execute the query to create the table
    dbDelta($sql);
    }
}


register_activation_hook(__FILE__, array('ContactUs', 'create_table'));
$obj=new ContactUs();