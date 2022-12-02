<?php

class Rewrite_Url
{

    function __construct($options = array())
    {
        add_action('init', array($this, 'add_rule_rewrite'));
        // add_action('init', array($this, 'add_tags_rule'));
        add_filter('query_vars', array($this, 'insert_query_vars'));
    }

    // CAC DOI TUONG XEM THONG TIN CUA WP_REWRITE, WP_QUERY, WP KHAI BAO URL
    public function add_rule_rewrite()
    {
        // CAC REWRITE CUNG PHAI THEO THU TU NEU SAI THU TU CO THE KHONG HIEN THI DUOC

        // $regex1 = '([^/]*)/activitie/?([^/]*)/?';
        // $redirect1 = 'index.php?pagename=$matches[1]&activitie=$matches[2]';
        // add_rewrite_rule($regex1, $redirect1, 'top');

        ////            http://localhost/maythoikhi/?article=auto-draft-6&paged=3
        $regex2 = '([^/]*)/sp/?([^/]*)/?';
        $redirect2 = 'index.php?pagename=$matches[1]&sp=$matches[2]';
        add_rewrite_rule($regex2, $redirect2, 'top');


        $regex3 = '([^/]*)/cate/?([^/]*)/tag/?([^/]*)/?';
        $redirect3 = 'index.php?pagename=$matches[1]&cate=$matches[2]&tag=$matches[3]';
        add_rewrite_rule($regex3, $redirect3, 'top');

        $regex4 = '([^/]*)/industry/([^/]*)/?';
        $redirect4 = 'index.php?pagename=$matches[1]&industry=$matches[2]';
        add_rewrite_rule($regex4, $redirect4, 'top');

        flush_rewrite_rules(true);
    }

    // PHAN CHUYEN CHU active THANH CHU activities
    public function add_tags_rule()
    {
        add_rewrite_tag('%active%', '([^&])+');
        add_permastruct('active', 'activities/%active%');
        //add_permastruct('active', 'active/%active%');
        flush_rewrite_rules(false);
    }

    // KHAI BAO THAM SO MOI TREN URL, KHI WORDPRESS KHONG CO PARAM NAY
    public function insert_query_vars($vars)
    {
        $vars[] = 'sp';
        $vars[] = 'cate';
        $vars[] = 'cat';
        $vars[] = 'ts';
        $vars[] = 'active';
        $vars[] = 'industry';
        return $vars;
    }
}