<?php

// Register custom post type 'todo'
function mtl_register_todo() {
    // Define singular and plural names for the custom post type
    $singular_name = apply_filters('mtl_label_single', 'Todo');
    $plural_name = apply_filters('mtl_label_plural', 'Todos');

    // Define labels for the custom post type
    $labels = array(
        'name'                  => $plural_name,
        'singular_name'         => $singular_name,
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New ' . $singular_name,
        'edit'                  => 'Edit',
        'edit_item'             => 'Edit ' . $singular_name,
        'new_item'              => 'New ' . $singular_name,
        'view'                  => 'View',
        'view_item'             => 'View ' . $singular_name,
        'search_items'          => 'Search ' . $plural_name,
        'not_found'             => 'No ' . $plural_name . ' Found',
        'not_found_in_trash'    => 'No ' . $plural_name . ' Found in Trash',
        'menu_name'             => $singular_name
    );

    // Define arguments for registering the custom post type
    $args = array(
        'labels'                => $labels,
        'description'           => 'Todos by category',
        'taxonomies'            => array('category'),  // Enable category taxonomy for 'todo' post type
        'supports'              => array( 'title','thumbnail' ),  // Specify supported features (title and thumbnail)
        'public'                => true,  // Post type is publicly queryable
        'publicly_queryable'    => true,  // Enable querying the post type publicly
        'show_in_menu'          => true,  // Show post type in admin menu
        'show_ui'               => true,  // Generate a default UI for managing this post type
        'menu_position'         => 5,     // Position in the menu order where the post type should appear
        'menu_icon'             => 'dashicons-edit',  // Menu icon
        'show_in_nav_menus'     => true,  // Whether post type is available for selection in navigation menus
        'query_var'             => true,  // Enable queries for this post type
        'can_export'            => true,  // Post type can be exported
        'rewrite'               => array('slug' => 'todo'),  // URL slug for the post type archive
        'capability_type'       => 'post'  // Capability type
    );

    // Register the custom post type
    register_post_type('todo', $args);
}

// Hook into the 'init' action to register the custom post type
add_action('init', 'mtl_register_todo');

?>



// This code below does not work due to some errors 


// create custom post type

// function mtl_register_todo(){
//     $singular_name = apply_filters('mtl_label_single', 'Todo');
//     $plural_name = apply_filters('mtl_label_plural', 'Todos');

//     $labels = array(
//         'name'                   => $plural_name,
//         'singular_name'          => $singular_name,
//         'add_new'                => 'Add New',
//         'add_new_item'           => 'Add New' .$singular_name,
//         'edit'                   => 'Edit',
//         'edit_item'              => 'Edit' .$singular_name,
//         'new_item'               => 'New' .$singular_name,
//         'view'                   => 'View',
//         'view_item'              => 'View' .$singular_name,
//         'search_items'           => 'Search' .$plural_name,
//         'not_found'              => 'No' .$plural_name. 'Found',
//         'not_found_in_trash'     => 'No' .$plural_name. 'Found',
//         'menu_name'              => $singular_name
//     );

//     $args = apply_filters('mtl_todo_args', array(
//         'labels'             =>  $labels,
//         'description'        => 'Todos by category',
//         'taxonomies'         => array('category'),
//         'public'             => true,
//         'publicly_queryable' => true,
//         'show_in_menu'       => true,
//         'show_ui'            => true,
//         'menu_position'      => 5,
//         'menu_icon'          => 'dashicons-edit',
//         'show_in_nav_menus'  => true,
//         'query_var'          => true,
//         'can_export'         => true,
//         'rewrite'            => array('slug' => 'todo'),
//         'capability_type'    => array(
//             'title'
//         )
//     ));

//     // register post type

//     register_post_type('todo', $args);
// }

// add_action('init', 'mtl_register_todo');