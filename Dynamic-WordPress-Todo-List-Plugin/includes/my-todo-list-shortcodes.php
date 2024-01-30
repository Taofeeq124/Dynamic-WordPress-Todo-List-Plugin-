<?php

// List todos
function mtl_list_todos ($atts, $content = null){
    global $post; // Access the global $post variable to retrieve post data

    // Set default shortcode attributes
    $atts = shortcode_atts( array(
        'title'     =>  'My Todos',
        'count'     =>   10,
        'category'  =>  'all'
    ), $atts);

    // Check category attributes to filter todos
    if($atts['category'] == 'all'){
        $terms = ''; // Empty terms if category is set to 'all'
    }else{
        $terms = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $atts['category'] // Set terms based on category attribute
            )
        );
    }

    // Query arguments for fetching todos
    $args = array(
        'post_type'      => 'todo',            // Custom post type
        'post_status'    => 'publish',         // Published posts
        'orderby'        => 'due_date',        // Order by due date
        'order'          =>  'ASC',            // Ascending order
        'posts_per_page' =>  $atts['count'],   // Number of todos to display
        'tax_query'      =>  $terms             // Taxonomy query for category filtering
    );

    // Fetch Todos using WP_Query
    $todos = new WP_Query($args);

    // Check if there are todos
    if($todos->have_posts()){
        // Initialize output variable
        $output = '';

        // Build HTML output for todos
        $output .= '<div class="todo-list">';
        while($todos->have_posts()) {
            $todos->the_post(); // Set up global post data

            // Get todo meta fields
            $priority = get_post_meta($post->ID, 'priority', true);
            $details  = get_post_meta($post->ID, 'details', true);
            $due_date = get_post_meta($post->ID, 'due_date', true);

            // Build HTML for individual todo item
            $output .= '<div class="todo">';
            $output .= '<h4>'.get_the_title().'</h4>'; // Todo title
            $output .= '<div>'.$details.'</div>'; // Todo details
            $output .= '<div class="priority-'.strtolower($priority).'"> Priority: '.$priority.' </div>'; // Todo priority
            $output .= '<div class="due_date"> Due Date: '.$due_date.' </div>'; // Todo due date
            $output .= '</div>'; // Close todo div
        } 

        $output .= '</div>' ; // Close todo-list div

        // Reset post data to restore global post variables
        wp_reset_postdata();
        return $output; // Return HTML output for todos
    } else {
        return '<p> No Todos </p>'; // Return message if no todos found
    }
}

// Add 'todos' shortcode to display list of todos
add_shortcode( 'todos', 'mtl_list_todos');

?>
