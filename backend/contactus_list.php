<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Contactus_List extends WP_List_Table{
    
    public function __construct() {
        parent::__construct(array(
            'singular' => __('Contact us',''), //singular name of the listed records
            'plural' => __('Contact us',''), //plural name of the listed records
            
        ));
     }
   
    
    public function get_columns() {
        $columns = array(
            'name' => __('User Name'),
            'email' => __('Email'),
            'message' => __('Message'),
            
        );
        return $columns;
    }
    
    
   
    public function no_items() {
        _e('No record found.');
    }

    public function column_default($item, $column_name) {
         switch ($column_name) {
            case 'name':
            return $item[$column_name];
            case 'email':
            return $item[$column_name];
            case 'message':
            return $item[$column_name];
           
        }
    }
    public function prepare_items() {
        global $wpdb;      
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $query = "select * from ".$wpdb->base_prefix."contactus";	
	$total_items = $wpdb->query($query);
        $per_page = 10;
        $current_page = $this->get_pagenum();
        $totalpages = ceil($total_items / $per_page);
        $offset = ($current_page - 1) * $per_page;
        $query.=' LIMIT ' . (int) $offset . ',' . (int) $per_page;

        $this->set_pagination_args(array(
            "total_items" => $total_items,
            "total_pages" => $totalpages,
            "per_page" => $per_page,
        ));
        $this->items = $wpdb->get_results($query, ARRAY_A);
        
    }
    
}

