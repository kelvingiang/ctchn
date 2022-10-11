<?php 

class Admin_Controller_Activity{
    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post'));
        add_action('manage_edit-activity_columns', array($this, 'manage_columns'));
        add_action('manage_activity_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-activity_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));

        add_action('init', array($this, 'create_taxonomies'));
    }

    public function register_custom_post()
    {
        $labels = array(
            'name' => __('商會活動', 'dp'),
            'singular_name' => __('商會活動', 'dp'),
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
            'menu_name' => __('商會活動', 'dp') 
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => TRUE,
            'menu_icon' => PART_ICON . 'web-icon.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 7,
            'supports' => array('title','editor', 'thumbnail'),
        );
        register_post_type('activity', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns)
    {
        unset($columns['date']); // an cot ngay mac dinh
        unset($columns['modified']); // an cot ngay mac dinh
        unset($columns['postdate']); // an cot ngay mac dinh
        unset($columns['home']);
        unset($columns['author']);
        //==== THEM COT VA BANG
        $columns['img'] = __('Image', 'suite');
        //$columns['content'] = __('Content');
        $columns['category'] = __('Category');
        $columns['special'] = __('Special');
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

        if ($columns == 'category') {
            global $post;
            $terms = wp_get_post_terms($post->ID, 'activity_category');

            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
        }

        if ($columns == 'special') {
            get_post_meta($post->ID,'_meta_box_special',true);
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

    //===== TAO TAXONOMIES
    public function create_taxonomies()
    {
        $labels = array(
            'name' => __('Category'),
            'singular_name' => __('Category'),
            'search_items' => __('Search Categories'),
            'all_items' => __('Category'),
            'parent_item' => __('Parent'),
            'parent_item_colon' => __('Parent'),
            'edit_item' => __('Edit'),
            'update_item' => __('Update'),
            'add_new_item' => __('Add New'),
            'new_item_name' => __('Add New'),
            'menu_name' => __('Category')
        );
        register_taxonomy('activity_category', 'activity', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'activity-category',
                'hierarchical' => true,
            )
        ));
    }
}