<?php
ob_start();
// WP_List_Table is not loaded automatically so we need to load it in our application
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}


/**
 * Create a new table class that will extend the WP_List_Table
 */
class EncoderITCustomForm extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->process_bulk_action();
       

        $data = $this->table_data();
        usort($data, array(&$this, 'sort_data'));

        $perPage = 10;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ));

        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }
    // public function get_bulk_actions() {
	// 	return array(
	// 		'trash' => __( 'Move to Trash', 'admin-table-tut' ),
	// 	);
	// }

	/**
	 * Get bulk actions.
	 *
	 * @return void
	 */
	// public function process_bulk_action() {
	// 	if ( 'trash' === $this->current_action() ) {
	// 		$post_ids = filter_input( INPUT_GET, 'draft_id', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
	// 		var_dump($post_ids );
	// 		global $wpdb;
	// 		$table_name = $wpdb->prefix . 'contacts';
	// 		$wpdb->query("DELETE from $table_name  WHERE id > 0");

	// 	}
	// }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            "SL." => "SL.",
            "Customer Name" => "Customer Name",
           // "Last Message" =>"Last Message",
            "Action"  => "Action",
        );

        return $columns;
    }


  

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array(
                    'SL.'=>array('SL.',true),
                    );
    }

    /**
     * Get the table data
     *
     * @return Array
     */
   
    private function table_data()
    {
        // echo '<script>
        // if(jQuery(".wp-list-table .case_no_cancel_check").hasClass("encoder_it_cancled_row"))
        //     {
        //     console.log("aa");
        //     }                    
        // </script>';
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_form';
        if (isset($_POST['s']) && !empty($_POST['s'])) {
            
            $search_data = $_POST['s'];
            $users = $wpdb->prefix . 'users';
            $encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';
            $user_id=wp_get_current_user()->ID;

          //  $sql="SELECT *from $users where ID in ( SELECT sender_id AS user_id FROM $encoderit_fenix_people_chats UNION SELECT receiver_id AS user_id FROM $encoderit_fenix_people_chats";

          //  $result = $wpdb->get_results($sql);
            $sql="SELECT *from $users where ID = '%" . $search_data . "%' OR user_login LIKE '%" . $search_data . "%' OR  user_email LIKE '%" . $search_data . "%' OR  display_name LIKE '%" . $search_data . "%' and ID <> $user_id ";

            $result = $wpdb->get_results($sql);

        } else {
              $user_id=wp_get_current_user()->ID;
            $users = $wpdb->prefix . 'users';
            $encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';

           // $sql="SELECT *from $users where ID in ( SELECT sender_id AS user_id FROM $encoderit_fenix_people_chats UNION SELECT receiver_id AS user_id FROM $encoderit_fenix_people_chats)";

            $sql="SELECT *from $users where ID <> $user_id";

            $result = $wpdb->get_results($sql);
            
        }
        if (count($result) != 0) {
            $sl = 1;
            foreach ($result as $singledata) {
                
               
                $data[] = array(
                    'SL.'       => $singledata->ID,
                    'Customer Name'                => $singledata->display_name,
                    //'Last Message'=>enc_get_the_last_message(),
                     'Action'                    => '<a  href="' .admin_url() .'admin.php'. '?page=fenix-people-messages-admin-details-view&id=' . $singledata->ID . '" class="button"  style="background-color: #009B00;color: black">Details</a>'
                );
                $sl++;
            }
        } else {
            $data = [];
        }

        return $data;
    }
    
    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case "SL.":
            case "Customer Name":
            //case "Last Message":    
            case "Action":
           // case 'Cancel': 
                return $item[$column_name];

            default:
                return print_r($item, true);
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data($a, $b)
    {
        // Set defaults
        $orderby = 'SL.';
        $order = 'desc';

        // If orderby is set, use this as the sort column
        if (!empty($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if (!empty($_GET['order'])) {
            $order = $_GET['order'];
        }


        $result = strnatcmp($a[$orderby], $b[$orderby]);

        if ($order === 'asc') {
            return $result;
        }

        return -$result;
    }
 
    // public function single_row( $item ) {
    //     $cssClass = ($item['is_cancelled'] == 1) ? 'encoder_it_cancled_row' : '';
    //     echo '<tr class="'.$cssClass.'">';
    //     $this->single_row_columns( $item );
    //     echo '</tr>';
    // }

}
$pbwp_products = new EncoderITCustomForm();
$pbwp_products->prepare_items();

?>
<div class="wrap pbwp">
    <div>
        <h1 class="pbwp-headingtag pbwp-mb-4 pbwp-p-1">All Messages</h1>
    </div>
    <div class="pbwp-mt-3">
        <form method="post" class="pbwp-d-inline" style="">
            <input type="hidden" name="page" value="pbwp_product_table" />
            <?php $pbwp_products->search_box('search', 'search_id'); ?>
        </form>
    </div>
    <?php $pbwp_products->display(); ?>
    <script>
        if(jQuery('.wp-list-table .case_no_cancel_check').hasClass('encoder_it_cancled_row'))
            {
                jQuery('.encoder_it_cancled_row').closest('tr').css('background-color', 'lightcoral');
            }
    </script>
</div>