<?php
define('THEME_NAME', 'revoke');
define('THEME_PRETTY_NAME', 'Revoke');
//Theme support
add_theme_support('post-thumbnails');

//Load Textdomain
load_theme_textdomain(THEME_NAME, TEMPLATEPATH . '/languages');

//content width
if (!isset($content_width))
    $content_width = 960;

//add feed support
add_theme_support('automatic-feed-links');