<?php

class SeCpt
{
    function __construct()
    {
        add_action('init', [$this, 'custom_post_type']);
    }

    function custom_post_type()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'               => _x('Questions', 'se-mcq'),
            'singular_name'      => _x('Question', 'se-mcq'),
            'menu_name'          => __('Questions', 'se-mcq'),
            'parent_item_colon'  => __('Parent Question', 'se-mcq'),
            'all_items'          => __('All Questions', 'se-mcq'),
            'view_item'          => __('View Question', 'se-mcq'),
            'add_new_item'       => __('Add New Question', 'se-mcq'),
            'add_new'            => __('Add New Question', 'se-mcq'),
            'edit_item'          => __('Edit Question', 'se-mcq'),
            'update_item'        => __('Update Question', 'se-mcq'),
            'search_items'       => __('Search Question', 'se-mcq'),
            'not_found'          => __('Not Found', 'se-mcq'),
            'not_found_in_trash' => __('Not found in Trash', 'se-mcq'),
        );

        // Set other options for Custom Post Type

        $args = array(
            'label'               => __('question', 'se-mcq'),
            'description'         => __('Questions', 'se-mcq'),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array('title', 'editor'),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
            'show_in_rest'        => true,

        );

        // Registering your Custom Post Type
        register_post_type('questions', $args);

        // Set UI labels for Custom Post Type
        $labels = array(
            'name'               => _x('Answers', 'se-mcq'),
            'singular_name'      => _x('Answer', 'se-mcq'),
            'menu_name'          => __('Answers', 'se-mcq'),
            'parent_item_colon'  => __('Parent Answer', 'se-mcq'),
            'all_items'          => __('All Answers', 'se-mcq'),
            'view_item'          => __('View Answer', 'se-mcq'),
            'add_new_item'       => __('Add New Answer', 'se-mcq'),
            'add_new'            => __('Add New Answer', 'se-mcq'),
            'edit_item'          => __('Edit Answer', 'se-mcq'),
            'update_item'        => __('Update Answer', 'se-mcq'),
            'search_items'       => __('Search Answer', 'se-mcq'),
            'not_found'          => __('Not Found', 'se-mcq'),
            'not_found_in_trash' => __('Not found in Trash', 'se-mcq'),
        );

        // Set other options for Custom Post Type

        $args = array(
            'label'               => __('answer', 'se-mcq'),
            'description'         => __('Answers', 'se-mcq'),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array('title'),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
            'show_in_rest'        => true,

        );

        // Registering your Custom Post Type
        register_post_type('answers', $args);
    }
}

new SeCpt();