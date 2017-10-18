<?php
/*
* Plugin Name: Custom Music Reviews
* Plugin URI: https://www.elegantthemes.com/
* Description: A custom music review plugin built for example.
* Version: 1.0
* Author: Andy Leverenz
* Author URI: http://justalever.com/
*/

// Register the Custom Music Review Post Type
function register_cpt_to_do_list() {
 
    $labels = array(
        'name' => _x( 'ToDoList', 'to_do_list' ),
        'singular_name' => _x( 'To Do List', 'to_do_list' ),
        'add_new' => _x( 'Add New List', 'to_do_list' ),
        'add_new_item' => _x( 'Add New List', 'to_do_list' ),
        'edit_item' => _x( 'Edit List', 'to_do_list' ),
        'new_item' => _x( 'New List', 'to_do_list' ),
        'view_item' => _x( 'View List', 'to_do_list' ),
        'search_items' => _x( 'Search List', 'to_do_list' ),
        'not_found' => _x( 'No Lists found', 'to_do_list' ),
        'not_found_in_trash' => _x( 'No lists found in Trash', 'to_do_list' ),
        'parent_item_colon' => _x( 'Parent To Do List:', 'to_do_list' ),
        'menu_name' => _x( 'ToDoList', 'to_do_list' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Make your custom lists',
        'supports' => array( 'title','revisions'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-list-view',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'to_do_list', $args );
}
 
add_action( 'init', 'register_cpt_to_do_list' );

function add_your_fields_meta_box() {
    add_meta_box(
        'your_fields_meta_box', // $id
        'Things to do', // $title
        'show_your_fields_meta_box', // $callback
        'to_do_list', // $screen
        'normal', // $context
        'high' // $priority
    );
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
    global $post;  
        $meta = get_post_meta( $post->ID, 'your_fields', true ); ?>
    <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
    <div class="field_wrapper">
        <div>
            <input style="height: 20px; width: 20px" type="checkbox" name="checked" checked>     
            <input type="text" name="field_name[]" value=""/>      
            <input type="button" class="add_button button" value="Add">
        </div>        
    </div>
    <?php }

    function save_your_fields_meta( $post_id ) {   
    // verify nonce
    if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id; 
    }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // check permissions
    if ( 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }  
    }
    
    $old = get_post_meta( $post_id, 'your_fields', true );
    $new = $_POST['your_fields'];

    if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'your_fields', $new );
    } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'your_fields', $old );
    }
}
add_action( 'save_post', 'save_your_fields_meta' );

function my_plugin_enqueue_scripts() {
       wp_enqueue_script( 'custom-plugin-script', get_stylesheet_directory_uri().'/js/add_remove_tasks.js', array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue_scripts' );




