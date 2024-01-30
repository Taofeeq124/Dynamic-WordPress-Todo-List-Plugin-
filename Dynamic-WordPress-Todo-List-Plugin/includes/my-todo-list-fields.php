<?php

// Add metabox for 'todo' post type
function mtl_add_fields_metabox(){
    add_meta_box( 
        'mtl_todo_fields',                  // Metabox ID
        __('Todo Fields'),                  // Metabox title
        'mtl_todo_fields_callback',         // Callback function to display metabox content
        'todo',                             // Post type to which the metabox is added
        'normal',                           // Metabox position
        'default'                           // Metabox priority
    );
}

add_action('add_meta_boxes', 'mtl_add_fields_metabox');

// Display fields metabox content
function mtl_todo_fields_callback($post){
    
    // Add nonce field for security
    wp_nonce_field(basename(__FILE__), 'wp_todos_nonce');
    
    // Get stored todo meta data
    $mtl_stored_todo_meta = get_post_meta($post->ID);
    ?>

    <div class="wrap todo-form" style=" padding:10px 0;">

        <div class="form-group" style=" padding:10px 0;">
            <label for="priority"> <?php esc_html_e( 'Priority', 'mtl_domain' ); ?></label>
            
            <!-- Dropdown for priority selection -->
            <select id="priority" name="priority" class="form-control">
                <?php  
                $option_values = array('low', 'Normal', 'High');
                foreach($option_values as $key => $value){
                    if($value == $mtl_stored_todo_meta['priority'][0]){
                        // Selected option
                        ?>
                        <option selected> <?php echo $value; ?> </option>
                        <?php
                    }else{ 
                        // Unselected options
                        ?>
                        <option> <?php echo $value; ?> </option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>

        <!-- Text editor for todo details -->
        <div class="form-group" style=" padding:10px 0;">
            <label for="details" style=" padding:15px 0;"> <?php esc_html_e( 'Details:', 'mtl_domain' ); ?></label>
            <?php 
                $content  = get_post_meta($post->ID, 'details', true);
                $editor   = 'details';
                $settings = array(
                    'textarea_rows'   => 5,
                    'media_buttons'   => true
                );
                wp_editor($content, $editor, $settings);
            ?>
        </div>

        <!-- Input field for due date -->
        <div class="form-group" style=" padding:10px 0;">
            <label for="due-date"> <?php esc_html_e( 'Due Date:', 'mtl_domain' ); ?></label>
            <input type="date" class="form-control" name="due_date" id="due_date" 
            value =" <?php if(!empty($mtl_stored_todo_meta['due_date'])) echo esc_attr($mtl_stored_todo_meta['due_date'][0]) ?>"/>
        </div>

    </div>

    <?php
}

// Save the form data
function mtl_todos_save($post_id){
    // Check if autosave, revision, or nonce is invalid
    $is_autosave    = wp_is_post_autosave($post_id );
    $is_revision    = wp_is_post_revision($post_id);
    $is_valid_nonce = isset($_POST['wp_todos_nonce']) && wp_verify_nonce($_POST['wp_todos_nonce'], basename(__FILE__))? 'true':'false';
    
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }

    // Update priority, details, and due date meta fields
    if(isset($_POST['priority'])){
        update_post_meta($post_id, 'priority', sanitize_text_field($_POST['priority']));
    }

    if(isset($_POST['details'])){
        update_post_meta($post_id, 'details', sanitize_text_field($_POST['details']));
    }

    if(isset($_POST['due_date'])){
        update_post_meta($post_id, 'due_date', sanitize_text_field($_POST['due_date']));
    }
}

// Hook save_post action to the function that saves form data
add_action('save_post', 'mtl_todos_save');

?>
