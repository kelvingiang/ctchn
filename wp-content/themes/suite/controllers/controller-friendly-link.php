<?php 

class Admin_Controller_Friendly_Link{
    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post'));
        add_action('manage_edit-friendly-link_columns', array($this, 'manage_columns'));
        add_action('manage_friendly-link_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-friendly-link_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));

    }

    public function register_custom_post()
    {
        $labels = array(
            'name' => __('友誼連接', 'dp'),
            'singular_name' => __('友誼連接', 'dp'),
            'add_new' => __('Add Item', 'dp'),
            'add_new_item' => __('Add Item', 'dp'),
            'edit_item' => __('Edit', 'dp'),
            'new_item' => __('Add Item', 'dp'),
            'all_items' => __('All Item', 'dp'),
            'view_item' => __('View Item', 'dp'),
            'search_items' => __('Search', 'dp'),
            'not_found' => __('No slides found.', 'dp'),
            'not_found_in_trash' => __('No found in Trash.', 'dp'),
            'parent_item_colon' => '',
            'menu_name' => __('友誼連接', 'dp') 
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => TRUE,
            'menu_icon' => PART_ICON . 'link-icon.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array('title','editor', 'thumbnail'),
        );
        register_post_type('friendly-link', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns)
    {
        unset($columns['date']); // an cot ngay mac dinh
        unset($columns['modified']); // an cot ngay mac dinh
        unset($columns['postdate']); // an cot ngay mac dinh
        unset($columns['home']);
        unset($columns['author']);
        //unset($columns['language']);
        //==== THEM COT VA BANG
        $columns['img'] = __('Image', 'suite');
        //$columns['content] = __('Content);
        $columns['website'] = __('Website');
        return $columns;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($columns)
    {
        global $post;
        // if ($columns == 'content') {
        //     the_content();
        // }

        if ($columns == 'img') {
            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('post-thumbnail', array('style' => 'width: 80px; height: 50px'));
            } else {
                echo '<img width="300" height="314" style="width: 80px; height: 50px" class="attachment-post-thumbnail wp-post-image" src="' . get_image('no-image.jpg') . '">';
            }
            echo '</a>';
        }

        if ($columns == 'website') {
            echo get_post_meta($post->ID,'_meta_box_website',true);
        }
    }

    //====== SAP SEP THEO TRINH TU
    public function sortable_views_column($newcolumn)
    {
        $newcolumn['setorder'] = 'setorder';
        return $newcolumn;
    }

    public function sort_views_column($vars)
    {
        if (isset($vars['orderby']) && 'setorder' == $vars['orderby']) {
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => '_meta_box_order', //Custom field key
                    'orderby' => '_meta_box_order' //Custom field value (number)
                )
            );
        };
        return $vars;
    }
}