<?php
/*
Plugin Name: Todo List Plugin 
Plugin URI: https://homeandedibles.com/taofeeq-masud-portfolio/
Description: A todo list plugin to an handle all your daily schedule in one place .
Version: 1.0
Author: Taofeeq Mas'ud
Author URI: https://homeandedibles.com/taofeeq-masud-portfolio/
Text Domain: todo-list-plugin
Domain Path: /languages
*/

// Exit if accessed directly

if (!defined('ABSPATH')){
    exit;
}


// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/my-todo-list-scripts.php');

// Load Shortcodes
require_once(plugin_dir_path(__FILE__).'/includes/my-todo-list-shortcodes.php');

if(is_admin()){
  // Load Custom Post Type
  require_once(plugin_dir_path(__FILE__).'/includes/my-todo-list-cpt.php');

   // Custom Fields 
   require_once(plugin_dir_path(__FILE__).'/includes/my-todo-list-fields.php');
}
