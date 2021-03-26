<?php
/*
Plugin Name: Book Records System
Plugin URI:  https://exampmple.com/
Description: This plugin is made for book data storage.
Version:     1.0
Author:      Husnain
Author URI:  https://exampmple.com/
License:     GPL2 etc
License URI: https://link to your plugin license
 */
if (!defined("ABSPATH")) {
    exit;
}

if (!defined("MY_BOOK_PLUGIN_DIR_PATH")) {
    define("MY_BOOK_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
}

if (!defined("MY_BOOK_PLUGIN_DIR_URL")) {
    define("MY_BOOK_PLUGIN_DIR_URL", plugins_url() . '/my-books');
}

function my_book_include_assets()
{
    //styles
    wp_enqueue_style("bootstrap", MY_BOOK_PLUGIN_DIR_URL . '/assets/css/bootstrap.min.css', '');
    wp_enqueue_style("datatable", MY_BOOK_PLUGIN_DIR_URL . '/assets/css/datatable.css', '');
    wp_enqueue_style("notifybar", MY_BOOK_PLUGIN_DIR_URL . '/assets/css/notifybar.css', '');
    wp_enqueue_style("style", MY_BOOK_PLUGIN_DIR_URL . '/assets/css/style.css', '');

//scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script("bootstrap.min.js", MY_BOOK_PLUGIN_DIR_URL . '/assets/js/bootstrap.min.js', '', true);
    wp_enqueue_script("datatables.js", MY_BOOK_PLUGIN_DIR_URL . '/assets/js/datatables.js', '', true);
    wp_enqueue_script("notifybar.js", MY_BOOK_PLUGIN_DIR_URL . '/assets/js/notifybar.js', '', true);
    wp_enqueue_script("validation.js", MY_BOOK_PLUGIN_DIR_URL . '/assets/js/validation.js', '', true);
    wp_enqueue_script("script", MY_BOOK_PLUGIN_DIR_URL . '/assets/js/script.js', '', true);
    wp_localize_script('script', 'mybookajaxurl', array(admin_url('admin-ajax.php')));
}
add_action('init', "my_book_include_assets");

function my_book_plugin_menus()
{
    add_menu_page("My Book", "My Book", "manage_options", "book-list", "my_book_list", "dashicons-book", 30);
    add_submenu_page("book-list", "Book List", "Book List", "manage_options", "book-list", "my_book_list");
    add_submenu_page("book-list", "Add Book", "Add Book", "manage_options", "add-new", "my_book_add");
    add_submenu_page("book-list", "", "", "manage_options", "book-edit", "my_book_edit");
}
function my_book_list()
{
    include_once MY_BOOK_PLUGIN_DIR_PATH . 'views/book-list.php';
}
function my_book_add()
{
    include_once MY_BOOK_PLUGIN_DIR_PATH . 'views/book-add.php';
}
function my_book_edit()
{
    include_once MY_BOOK_PLUGIN_DIR_PATH . 'views/book-edit.php';
}
add_action("admin_menu", "my_book_plugin_menus");

function my_book_table()
{
    global $wpdb;
    return $wpdb->prefix . "my_books";
}
function my_book_generate_table()
{
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $sql = "CREATE TABLE `" . my_book_table() . "` ( `id` INT NOT NULL AUTO_INCREMENT ,
 `name` VARCHAR(250) NOT NULL ,
 `author` VARCHAR(250) NOT NULL ,
  `about` TEXT NOT NULL , `book_image` TEXT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
   PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    dbDelta($sql);
}

register_activation_hook(__FILE__, "my_book_generate_table");
function drop_table_my_book()
{
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS wp_my_books");
}

register_deactivation_hook(__FILE__, "drop_table_my_book");
add_action("wp_ajax_mybooklibrary", "my_book_ajax_handler");
function my_book_ajax_handler()
{
    global $wpdb;
    if ($_REQUEST['param'] == "save_book") {
//save to database
        $wpdb->insert(my_book_table(), array(
            "name"       => $_REQUEST['name'],
            "author"     => $_REQUEST['author'],
            "about"      => $_REQUEST['about'],
            "book_image" => $_REQUEST['image-name'],
        ));
        echo json_encode(array("status" => 1, "message" => "data inserted"));
    } elseif ($_REQUEST['param'] == "edit_book") {
        $wpdb->update("wp_my_books", array(
            "name"       => $_REQUEST['name'],
            "author"     => $_REQUEST['author'],
            "about"      => $_REQUEST['about'],
            "book_image" => $_REQUEST['image-name'],
        ), array(
            "id" => $_REQUEST['book_id'],
        ));
        echo json_encode(array("status" => 1, "message" => "data updated successfuly"));
    } elseif ($_REQUEST['param'] == "delete_book") {
        $wpdb->delete("wp_my_books", array(
            "id" => $_REQUEST['id'],
        ));
        echo json_encode(array("status" => 1, "message" => "data deleted successfuly"));
    }
    wp_die();
}
