<?php
/*
Plugin Name: To do List
Plugin URI: http://samplewp.com/
Description: A simple wordpress plugin
Version: 1.0
Author: Ben
Author URI: http://yourdomain.com
License: GPL
*/
/*
* This calls to_do_list() function when wordpress initializes.
 Note that the to_do_list doesnt have brackets.*/


function custom_post_type(){
  $labels = array(
    'name'=>'Lists',
    'singular_name'=>'Lists',
    'add_new'=>'Add Item',
    'all_items'=>'All Items',
    'add_new_item'=>'Add Item',
    'edit_item'=>'Edit Item',
    'new_item'=>'New Item',
    'view_item'=>'View Item',
    'search_item'=>'Search Portfolio',
    'not_found'=>'No items found',
    'not_found_in_trash'=>'No items found in trash',
    'parent_item_colon'=>'Parent Item'
    );
  $args = array(
    'labels'=> $labels,
    'public'=> true,
    'has_archive'=> true,
    'publicly_queryable'=>true,
    'query_var'=>true,
    'rwerite'=>true,
    'capability_type'=>'post',
    'hierarchical'=>false,
    'support'=> array(
      'title',
      'editor',
      'excerpt',
      'thumbnail',
      'revisions',
      ),    
    'menu_position'=> 5,
    'exclude_from_search'=> false,
    'menu_icon'   => 'dashicons-clipboard'
    );
  register_post_type('lists',$args);
}

add_action('init','custom_post_type');

add_action( 'init', function() {
    remove_post_type_support( 'lists', 'editor' );
    remove_post_type_support( 'lists', 'category' );
  });

add_filter( 'get_sample_permalink_html', 'wpse_125800_sample_permalink' );
function wpse_125800_sample_permalink( $return ) {
    $return = '';

    return $return;
}

add_filter( 'page_row_actions', 'wpse_125800_row_actions', 10, 2 );
add_filter( 'post_row_actions', 'wpse_125800_row_actions', 10, 2 );
function wpse_125800_row_actions( $actions, $post ) {
    unset( $actions['inline hide-if-no-js'] );
    unset( $actions['view'] );

    return $actions;
}

global $pagenow;
if ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) {
    add_action( 'admin_head', 'wpse_125800_custom_publish_box' );
    function wpse_125800_custom_publish_box() {
        if( !is_admin() )
            return;

        $style = '';
        $style .= '<style type="text/css">';
        $style .= '#edit-slug-box, #minor-publishing-actions, #visibility, .num-revisions, .curtime';
        $style .= '{display: none; }';
        $style .= '</style>';

        echo $style;
    }


    /* Contact meta boxes */

    function task_add_meta_box()
    {
      add_meta_box('list_task','Task','list_task_callback','lists');
    }

    function list_task_callback($post){
       wp_nonce_field('save_task_data','task_meta_box_nonce');

       $value=get_post_meta($post->ID,'_task_value_key',true);

       ?>
       <!DOCTYPE html>
        <html>
        <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/add_remove_tasks.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <script type="text/javascript">
              $(document).ready(function(){

                  var maxField = 12; //Input fields increment limitation
                  var addButton = $('.add_button'); //Add button selector
                  var wrapper = $('.field_wrapper'); //Input field wrapper
                  var fieldHTML = '<div align="center" style="margin-top: 1%"><input type="text" name="tasks[]" value="<?= $value[1]?>"/><input style="margin-left: 2%; background:#e14d43; border-color:#e14d43" type="button" class="remove_button btn btn-primary" value="Remove"></div>'; //New input field html 
                  var x = 1; //Initial field counter is 1
                  $(addButton).click(function(){ //Once add button is clicked
                      if(x < maxField){ //Check maximum number of input fields
                          x++; //Increment field counter
                          $(wrapper).append(fieldHTML); // Add field html
                      }
                  });   
                  $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                      e.preventDefault();
                      $(this).parent('div').remove(); //Remove field html
                      x--; //Decrement field counter
                  });
            }); 
          </script>
          <title></title>
        </head>
        <body>
        <div>
        <div class="field_wrapper">
            <div align="center">                  
                <input type="text" name="tasks[]" value='<?=esc_attr($value[0])?>'>                
                <input style="margin-left: 5%" type="button" class="add_button btn btn-primary" value="Add">
            </div>        
            </div>    
        </div> 
        </body>        
        </html>

        <?php
    }  
      add_action('add_meta_boxes','task_add_meta_box');

    function save_task_data($post_id)
    {

      /* Security */
      if ( !isset($_POST['task_meta_box_nonce']) )
      {
        return;
      }

      if ( !wp_verify_nonce($_POST['task_meta_box_nonce'],'save_task_data') ) {
        return;
      }

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      {
        return;
      }

      if ( !current_user_can('edit_post',$post_id))
      {
        return;
      }

      if (! isset($_POST['tasks']))
      {
        return;
      }
      $num = count($_POST['tasks']);
      $i=0;
      $data = array();
      while ( $i <= $num) {        
        $data[] .= sanitize_text_field($_POST['tasks'][$i]);                 
        $i++;
      }
      
      update_post_meta($post_id,'_task_value_key',$data);

    }
    add_action('save_post','save_task_data');
}


/* Custom column fields */

    function set_lists_columns($columns)
    {        
        $newColumns = array();
        $newColumns['title']='List Name';
        $newColumns['date']='Date';
        return $newColumns; 
    }




add_filter('manage_lists_posts_columns','set_lists_columns');
  
   

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');







