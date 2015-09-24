<?php

/*============================== TESLA FRAMEWORK ======================================================================================================================*/

require_once(get_template_directory() . '/tesla_framework/tesla.php');


TT_ENQUEUE::$enabled = false;

/*============================== THEME FEATURES ======================================================================================================================*/

function revoke_theme_features() {

    register_nav_menus(array(
        'revoke_menu' => 'Revoke Header Menu'
    ));

    if (!isset($content_width))
        $content_width = 960;

    if (function_exists('register_sidebar')){
        register_sidebar(array(
            'name' => 'Blog Sidebar',
            'id' => 'blog-sidebar',
            'description' => 'This sidebar is located on the left side of the content on the blog page.',
            'class' => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s font2">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widgetTitle font1 widgettitle">',
            'after_title' => '</div>'
        ));
        register_sidebar(array(
            'name' => 'Footer Sidebar',
            'id' => 'footer-sidebar',
            'description' => 'This sidebar is located in the footer area of the blog page.',
            'class' => '',
            'before_widget' => '<div class="footerColumn"><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="titleContainer titleFooter font1 widgettitle"><div class="title">',
            'after_title' => '</div></div>'
        ));
        register_sidebar(array(
            'name' => 'Page Sidebar',
            'id' => 'page-sidebar',
            'description' => 'This sidebar is located on the left side of the content on user created pages. This is the default sidebar for pages.',
            'class' => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s font2">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widgetTitle font1 widgettitle">',
            'after_title' => '</div>'
        ));

        for($i=1;$i<=10;$i++)
            register_sidebar(array(
                'name' => 'Alternative Sidebar #'.$i,
                'id' => 'alt-sidebar-'.$i,
                'description' => 'This sidebar is can be chosen as an alternative for Page Sidebar.',
                'class' => '',
                'before_widget' => '<div id="%1$s" class="widget %2$s font2">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widgetTitle font1 widgettitle">',
                'after_title' => '</div>'
            ));
    }

    add_theme_support('post-thumbnails');

    add_theme_support( 'automatic-feed-links' );
}

revoke_theme_features();



/*============================== LANGUAGE SETUP ======================================================================================================================*/

function my_theme_setup(){
    load_theme_textdomain('revoke', get_template_directory() . '/language');
}
add_action('after_setup_theme', 'my_theme_setup');



/*============================== SCRIPTS & STYLES ======================================================================================================================*/

function revoke_scripts() {

    wp_enqueue_style('revoke-style', get_template_directory_uri() . '/css/style.css',false,null);
    wp_enqueue_style('revoke-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',array('revoke-style'),null);
    wp_enqueue_style('revoke-style-wp', get_stylesheet_uri(),false,null);

    //wp_enqueue_script('revoke-gmap', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places',array('jquery'),null,false);

    wp_enqueue_script('jquery');

    wp_enqueue_script('revoke-plugins', get_template_directory_uri() . '/js/plugins.js',array('jquery'),null);
    wp_enqueue_script('revoke-main-script', get_template_directory_uri() . '/js/script.js',array('jquery','revoke-plugins'),null);

    $list_view_mobile = _go('list_view_mobile');
    $list_view_mobile = isset($list_view_mobile);
    $list_view_desktop = _go('list_view_desktop');
    $list_view_desktop = isset($list_view_desktop);

    wp_localize_script( "revoke-main-script", "revoke_main", array( "ajaxurl" => admin_url( "admin-ajax.php" ), "listviewmobile" => $list_view_mobile, "listviewdesktop" => $list_view_desktop ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( "comment-reply", array('jquery') );

    $protocol = is_ssl() ? 'https' : 'http';

    if(_go('logo_text_font')){
        $font = str_replace(' ', '+', _go('logo_text_font'));
        wp_enqueue_style( 'tesla-custom-font', "$protocol://fonts.googleapis.com/css?family=$font");
    }

}

function revoke_admin_scripts($hook_suffix) {
    if ('widgets.php' == $hook_suffix) {
        wp_enqueue_media();
        wp_enqueue_script('revoke-widget-script', get_template_directory_uri() . '/js/revoke_admin_widgets.js', array('media-upload', 'media-views'),null);
    }
    if ($hook_suffix == 'post-new.php' || $hook_suffix == 'post.php') {
        wp_enqueue_script('revoke-post-script', get_template_directory_uri() . '/js/revoke_admin_post.js',array('jquery'),null);
    }
}

if(!is_admin())
    add_action('wp_enqueue_scripts', 'revoke_scripts');
else
    add_action('admin_enqueue_scripts', 'revoke_admin_scripts');

function revoke_header(){
    $background_image = _go('bg_image');
    $background_position = _go('bg_image_position');
    $background_repeat = _go('bg_image_repeat');
    $background_attachment = _go('bg_image_attachment');
    $background_color = _go('bg_color');
    echo '<style type="text/css">';
    echo '.revoke_custom_background{';
    if(!empty($background_image))
        echo 'background-image: url('.$background_image.');';
    if(!empty($background_position)){
        echo 'background-position: ';
        switch($background_position){
            case 'Left':
                echo 'top left';
                break;
            case 'Center':
                echo 'top center';
                break;
            case 'Right':
                echo 'top right';
                break;
            default:
                break;
        }
        echo ';';
    }
    if(!empty($background_repeat)){
        echo 'background-repeat: ';
        switch($background_repeat){
            case 'No Repeat':
                echo 'no-repeat';
                break;
            case 'Tile':
                echo 'repeat';
                break;
            case 'Tile Horizontally':
                echo 'repeat-x';
                break;
            case 'Tile Vertically':
                echo 'repeat-y';
                break;
            default:
                break;
        }
        echo ';';
    }
    if(!empty($background_attachment)){
        echo 'background-attachment: ';
        switch($background_attachment){
            case 'Scroll':
                echo 'scroll';
                break;
            case 'Fixed':
                echo 'fixed';
                break;
            default:
                break;
        }
        echo ';';
    }
    if(!empty($background_color))
        echo 'background-color: '.$background_color.';';
    echo '}';
    $default = _go('site_color');
    if(empty($default))
        $default = '#fe5113';
    ?>
    .textcolor{
        color: <?php echo $default; ?>;
    }
    .textcolor_hover:hover{
        color: <?php echo $default; ?>;
    }
    .bgcolor{
        background-color: <?php echo $default; ?>;
    }
    .bgcolor_hover:hover{
        background-color: <?php echo $default; ?>;
    }
    .bordercolor{
        border-color: <?php echo $default; ?>;
    }
    .social a:hover img{
        background-color: <?php echo $default; ?>;
    }
    .menuContainer>ul.menu>li.menuactive>a,
    .menuContainer>ul.menu>li>a:hover{
        background-color: <?php echo $default; ?>;
    }
    .menuContainer div.menuLevel>ul.menuDrop>li:hover>a{
        background-color: <?php echo $default; ?>;
    }
    .menuContainer div.menuLevel>ul.menuDrop>li>div.menuDropArrow{
        background-color: <?php echo $default; ?>;
    }
    .titleContainer{
        border-bottom-color: <?php echo $default; ?>;
    }
    .titleContainer .title{
        border-bottom-color: <?php echo $default; ?>;
    }
    .titleContainer .clientsNav .clientsNavPrev{
        background-color: <?php echo $default; ?>;
    }
    .titleContainer .clientsNav .clientsNavNext{
        background-color: <?php echo $default; ?>;
    }
    .widgetFlickr .widgetFlickrImg:hover{
        border-color: <?php echo $default; ?>;
    }
    .contact .contactForm fieldset.contactFormButtons input[type="submit"]:hover,
    .contactForm fieldset.contactFormButtons input[type="submit"]:hover,
    .contact .contactForm fieldset.contactFormButtons input[type="reset"]:hover,
    .contactForm fieldset.contactFormButtons input[type="reset"]:hover{
        background-color: <?php echo $default; ?>;
    }
    .pageSlider ul.pageSliderNav li.active,
    .pageSlider ul.pageSliderNav li:hover{
        background-color: <?php echo $default; ?>;
    }
    .widgetCategories ul li a span{
        background-color: <?php echo $default; ?>;
    }
    .widgetCategories ul li a:hover{
        color: <?php echo $default; ?>;
    }
    .widgetGallery .widgetGalleryImg a:hover img{
        border-color: <?php echo $default; ?>;
    }
    .widgetWorks .widgetWorksEntry .widgetWorksEntryImg a span{
        background-color: <?php echo $default; ?>;
    }
    .widgetWorks .widgetWorksEntry .widgetWorksEntryImg a:hover img{
        border-color: <?php echo $default; ?>;
    }
    .works .worksFilter ul.worksFilterCategories li.worksFilterCategoriesActive div,
    .works .worksFilter ul.worksFilterCategories li:hover div{
        background-color: <?php echo $default; ?>;
    }
    .works .worksViews .worksViewsOption.worksViewsOptionActive,
    .works .worksViews .worksViewsOption:hover{
        border-color: <?php echo $default; ?>;
    }
    .works .worksContainer.worksContainerView1 .worksEntry .worksEntryContainer .worksEntryInfo .worksEntryInfoMore:hover{
        background-color: <?php echo $default; ?>;
    }
    .works .worksContainer.worksContainerView2 .worksEntry .worksEntryContainer .worksEntryInfo .worksEntryInfoTitle a:hover{
        color: <?php echo $default; ?>;
    }
    .blog .blogEntry .blogEntryTitle a:hover{
        color: <?php echo $default; ?>;
    }
    .blog .blogEntry .blogEntryFooter .blogEntryFooterComments a{
        color: <?php echo $default; ?>;
        border-color: <?php echo $default; ?>;
    }
    .blogNav a.blogNavActive,
    .blogNav a:hover{
        color: <?php echo $default; ?>;
    }
    .post .postForm .postFormButtons input:hover{
        background-color: <?php echo $default; ?>;
    }
    .project .projectInfo .projectInfoDetails .projectInfoDetailsEntry .projectInfoDetailsEntryBody a{
        color: <?php echo $default; ?>;
    }
    .footer .footerColumn .widget .widgetBody a:hover{
        color: <?php echo $default; ?>;
    }
    .sidebar .widget_revoke_categories ul li a span{
        background-color: <?php echo $default; ?>;
    }
    ul.page-numbers a:hover,
    ul.page-numbers span.current{
        color: <?php echo $default; ?>;
    }
    #postForm p.form-submit #submit:hover{
        background-color: <?php echo $default; ?>;
    }
    #reply-title a:hover{
        color: <?php echo $default; ?>;
    }
    .sidebar .widget table tfoot tr td a:hover{
        color: <?php echo $default; ?>;
    }
    .sidebar .widget table tbody tr td a:hover{
        background-color: <?php echo $default; ?>;
    }
    .sidebar .widget .tagcloud a:hover,
    .sidebar .widget .textwidget a:hover{
        color: <?php echo $default; ?>;
    }
    .sidebar .widget .widgetTitle a:hover{
        color: <?php echo $default; ?>;
    }
    .sidebar .widget #searchform #searchsubmit:hover{
        background-color: <?php echo $default; ?>;
    }
    .sidebar .widgetWorks .widgetWorksEntry .widgetWorksEntryImg a:hover{
        border-color: <?php echo $default; ?>;
    }
    .searchNoResults form input#searchsubmit:hover{
        background-color: <?php echo $default; ?>;
    }
    .footerColumn a:hover{
        color: <?php echo $default; ?>;
    }
    .footerColumn .widget_search #searchsubmit:hover{
        background-color: <?php echo $default; ?>;
    }
    .menuContainer > ul.menu > li.current_page_item > a,
    .menuContainer > ul.menu > li.current-menu-item > a,
    .menuContainer > ul.menu > li.current-menu-ancestor > a,
    .menuContainer > ul.menu > li.current_page_ancestor > a{
        background-color: <?php echo $default; ?>;
    }
    .post-numbers{
        color: <?php echo $default; ?>;
    }
    .post-numbers a:hover,
    .postFooter a:hover,
    .pingback a:hover,
    .postCommentsEntryBodyMessage a:hover,
    .post .postBody a:hover,
    .pageContents a:hover,
    .postCommentsEntryBodyUser a:hover,
    .trackback a:hover{
        color: <?php echo $default; ?>;
    }
    .pageContents input[type="submit"]:hover,
    .pageContents input[type="reset"]:hover{
        background-color: <?php echo $default; ?>;
    }
    .sidebar .widget ul li a:hover, .sidebar .widget_revoke_categories ul li a:hover{
        color: <?php echo $default; ?>;
    }
    .contactResult{
        color: <?php echo $default; ?>;
    }
    .revoke-read-more{
        color: <?php echo $default; ?>;
    }
    <?php
    echo _go('custom_css');
    echo '</style>';
}
add_action('wp_head','revoke_header',1000);

function revoke_footer(){
    echo _go('tracking_code');
}
add_action('wp_footer','revoke_footer',1000);



/*============================== WIDGETS ======================================================================================================================*/

class Revoke_contact_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_contact',
                'Айляк контакти',
                array(
            'description' => __('Контакти', 'revoke'),
            'classname' => 'widget_revoke_contact',
                ),
                array('width' => 400, 'height' => 350)
        );
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Контакт','revoke') : $instance['title'], $instance, $this->id_base );
        $company = empty( $instance['company'] ) ? 'Име' : $instance['company'];
        $text = empty( $instance['text'] ) ? "Адрес\nГрад, Код\n+123 456 7890\n+123 456 7890\nbepabg@gmail.com" : $instance['text'];
        echo $before_widget;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
            <div class="widgetBody">
                <div class="widgetAddress">
                    <div class="widgetAddressCompany"><?php echo $company; ?></div>
                    <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
                </div>
            </div>
        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['company'] = strip_tags($new_instance['company']);
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
        $instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Контакти', 'text' => "Адрес\nГрад, Код\n+123 456 7890\n+123 456 7890\nbepabg@gmail.com", 'company' => 'Име', 'filter' => 1 ) );
        $title = strip_tags($instance['title']);
        $text = esc_textarea($instance['text']);
        $company = strip_tags($instance['company']);
        $filter = $instance['filter'];
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Заглавие:','revoke'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('company'); ?>"><?php _e('Група:','revoke'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('company'); ?>" name="<?php echo $this->get_field_name('company'); ?>" type="text" value="<?php echo esc_attr($company); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Контакти:','revoke'); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
        </p>

        <p>
            <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked($filter); ?> />&nbsp;
            <label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Автоматично добавяй нов ред','revoke'); ?></label>
        </p>
<?php
    }

}

class Revoke_categories_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_categories',
                'АЙляк Категории',
                array(
            'description' => __('Списък категории', 'revoke'),
            'classname' => 'widget_revoke_categories',
                )
        );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Категории','revoke') : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;
        ?>
        <ul>
            <?php
            $cat_args['title_li'] = '';
            wp_list_categories(apply_filters('widget_revoke_categories_args', $cat_args));
            ?>
        </ul>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => ''));
        $title = esc_attr($instance['title']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','revoke'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

}

class Revoke_twitter_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_twitter',
                'Revoke - Twitter',
                array(
            'description' => __('A list of latest tweets', 'revoke'),
            'classname' => 'widget_revoke_twitter',
                )
        );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Twitter','revoke') : $instance['title'], $instance, $this->id_base);
        $user = empty($instance['user']) ? 'teslathemes' : $instance['user'];
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 3;

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;

        // echo twitter_generate_output($user, $number);
        echo twitter_generate_output($user, $number, '', array($this, 'tweet_output'),'','');

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['number'] = (int)strip_tags($new_instance['number']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => ''));
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $user = isset($instance['user']) ? esc_attr($instance['user']) : 'TeslaThemes';
        $number = isset($instance['number']) ? absint($instance['number']) : 3;
        ?>
        <p>
            <label><?php _e('Title:','revoke'); ?><input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label> 
            <label><?php _e('Twitter user:','revoke'); ?><input class="widefat" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" /></label> 
            <label for="<?php echo $this->get_field_id('number'); ?>">
                <?php _e('Number of posts to show:','revoke'); ?>
                <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
            </label>
        </p>
        <?php
    }

    public function tweet_output($i, $text, $date){
        if($i)
            $output = '<div class="widgetPostsEntryDelimiter widgetPostsEntryDelimiterSmall"></div>';
        else
            $output = '';
        $output .= '<div class="widgetTwitterPost"><div class="widgetTwitterPostText">'.$text.'</div><div class="widgetTwitterPostDate textcolor8">'.$date.'</div></div>';
        return $output;
    }
}

class Revoke_flickr_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_flickr',
                'Revoke - Flickr',
                array(
            'description' => __('A list of Flickr images', 'revoke'),
            'classname' => 'widget_revoke_flickr',
                )
        );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Flickr widget','revoke') : $instance['title'], $instance, $this->id_base);
        $user = empty($instance['user']) ? '97073871@N04' : $instance['user'];
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 12;

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;
        ?>
        <div class="widgetBody widgetFlickr" data-user="<?php echo $user; ?>" data-images="<?php echo $number; ?>"></div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['number'] = (int)strip_tags($new_instance['number']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => ''));
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $user = isset($instance['user']) ? esc_attr($instance['user']) : '97073871@N04';
        $number = isset($instance['number']) ? absint($instance['number']) : 12;
        ?>
        <p>
            <label><?php _e('Заглавие:','revoke'); ?><input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label> 
            <label><?php _e('Flickr user id:','revoke'); ?><input class="widefat" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" /></label> 
            <label for="<?php echo $this->get_field_id('number'); ?>">
                <?php _e('Брой за показване:','revoke'); ?>
                <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
            </label>
        </p>
        <?php
    }

}

class Revoke_latest_posts_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_latest_posts',
                'Revoke - Latest Posts',
                array(
            'description' => __('Списък с последни публикации', 'revoke'),
            'classname' => 'widget_revoke_latest_posts',
                )
        );
        $this->alt_option_name = 'widget_revoke_latest_posts_entries';

        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_revoke_latest_posts_cache', 'widget');

        if (!is_array($cache))
            $cache = array();

        if (!isset($args['widget_id']))
            $args['widget_id'] = $this->id;

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Последни публикации','revoke') : $instance['title'], $instance, $this->id_base);
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 10;

        $r = new WP_Query(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)));
        if ($r->have_posts()) :
            ?>
            <?php echo $before_widget; ?>
            <?php if ($title) echo $before_title . $title . $after_title; ?>
            <?php if($args['id']==='footer-sidebar'): ?>
                <div class="widgetBody widgetPosts">
                    <?php 
                    while ($r->have_posts()) : $r->the_post(); ?>
                        <div class="widgetPostsEntry">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="widgetPostsEntryAvatar">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="widgetPostsEntryBody">
                                <div class="widgetPostsEntryBodyTitle">
                                    <a class="textcolor7" href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                                <div class="widgetPostsEntryBodyText">
                                    <?php echo get_the_excerpt().'&nbsp;<a class="widgetPostsEntryBodyTextMore bgcolor" href="'.get_permalink().'"></a>'; ?>
                                </div>
                            </div>
                        </div>
                        <?php if($r->have_posts()): ?>
                            <div class="widgetPostsEntryDelimiter"></div>
                        <?php else: break; endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
            <ul>
                <?php while ($r->have_posts()) : $r->the_post(); ?>
                    <li>
                        <span class="post-date"><?php echo get_the_date('d M'); ?></span>
                        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php
                            if (get_the_title())
                                the_title();
                            else
                                the_ID();
                            ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
            <?php echo $after_widget; ?>
            <?php
            wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_revoke_latest_posts_cache', $cache, 'widget');
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['widget_revoke_latest_posts_entries']))
            delete_option('widget_revoke_latest_posts_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_revoke_latest_posts_cache', 'widget');
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Заглавие:','revoke'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Брой постове за показване:','revoke'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
        <?php
    }

}

class Revoke_sidebar_gallery_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_sidebar_gallery',
                'Айляк - Sidebar Галерия',
                array(
            'description' => __('Галерия от снимки', 'revoke'),
            'classname' => 'widget_revoke_sidebar_gallery',
                )
        );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Sidebar Галерия','revoke') : $instance['title'], $instance, $this->id_base);
        $category = $instance['category'];

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;
        ?>
        <div class="widgetGallery">
            <?php
            if(isset($instance['category'])&&$instance['category']!==''){
                $args = array(
                    'numberposts' => $instance['number'],
                    'category' => $instance['category'],
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'meta_key' => '_thumbnail_id',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $query = get_posts($args);
                foreach($query as $q){
                    echo '<div class="widgetGalleryImg">';
                    echo '<a href="'.get_permalink($q->ID).'">';
                    echo get_the_post_thumbnail($q->ID);
                    echo '</a>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = $new_instance['category']===''?NULL:(int)strip_tags($new_instance['category']);
        $instance['number'] = (int)strip_tags($new_instance['number']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'category' => ''));
        $title = esc_attr($instance['title']);
        $category = esc_attr($instance['category']);
        $number = isset($instance['number']) ? absint($instance['number']) : 9;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Заглавие:','revoke'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Брой снимки за показване:','revoke'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
        <p>
            <select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                <?php
                $term = term_exists($instance['category'], 'category');
                if ($instance['category'] === '' || $term === 0 || $term === null)
                    echo '<option value=""> - Избери категория - </option>';
                $cats = get_categories();
                foreach ($cats as $c) {
                    $option = '<option value="' . $c->cat_ID . '"' . selected($instance['category'], $c->cat_ID, false) . '>';
                    $option .= $c->cat_name;
                    $option .= '</option>';
                    echo $option;
                }
                ?>
            </select>
        </p>
        <?php
    }

}

class Revoke_recent_works_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'revoke_recent_works',
                'Айляк последно',
                array(
            'description' => __('Списък с последни действия', 'revoke'),
            'classname' => 'widget_revoke_recent_works',
                )
        );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Последно:','revoke') : $instance['title'], $instance, $this->id_base);
        $category = $instance['category'];

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;
        ?>
        <div class="widgetWorks">
            <?php
            if(isset($instance['category'])&&$instance['category']!==''){
                $cat_args['title_li'] = '';
                $args = array(
                    'numberposts' => $instance['number'],
                    'category' => $instance['category'],
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'meta_key' => '_thumbnail_id',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $query = get_posts($args);
                foreach($query as $q){
                    echo '<div class="widgetWorksEntry">';
                    echo '<div class="widgetWorksEntryImg">';
                    echo '<a href="'.get_permalink($q->ID).'">';
                    echo '<span></span>';
                    echo get_the_post_thumbnail($q->ID);
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="widgetWorksEntryInfo">';
                    echo $q->post_excerpt;
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = $new_instance['category']===''?NULL:(int)strip_tags($new_instance['category']);
        $instance['number'] = (int)strip_tags($new_instance['number']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'category' => ''));
        $title = esc_attr($instance['title']);
        $category = esc_attr($instance['category']);
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Заглавие:','revoke'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Брой за показване:','revoke'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
        <p>
            <select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                <?php
                $term = term_exists($instance['category'], 'category');
                if ($instance['category'] === '' || $term === 0 || $term === null)
                    echo '<option value=""> - Избери категория - </option>';
                $cats = get_categories();
                foreach ($cats as $c) {
                    $option = '<option value="' . $c->cat_ID . '"' . selected($instance['category'], $c->cat_ID, false) . '>';
                    $option .= $c->cat_name;
                    $option .= '</option>';
                    echo $option;
                }
                ?>
            </select>
        </p>
        <?php
    }

}

function revoke_register_widgets() {
    register_widget('Revoke_categories_widget');
    register_widget('Revoke_latest_posts_widget');
    register_widget('Revoke_sidebar_gallery_widget');
    register_widget('Revoke_recent_works_widget');
    register_widget('Revoke_twitter_widget');
    register_widget('Revoke_flickr_widget');
    register_widget('Revoke_contact_widget');
}

add_action('widgets_init', 'revoke_register_widgets');

class Walker_Category_revoke extends Walker_Category {

    function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
        extract($args);

        $cat_name = esc_attr($category->name);
        $cat_name = apply_filters('list_cats', $cat_name, $category);
        $link = '<a href="' . esc_url(get_term_link($category)) . '" ';
        if ($use_desc_for_title == 0 || empty($category->description))
            $link .= 'title="' . esc_attr(sprintf(__('Виж всички постове под %s'), $cat_name)) . '"';
        else
            $link .= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
        $link .= '><span></span>';
        $link .= $cat_name . '</a>';

        if (!empty($feed_image) || !empty($feed)) {
            $link .= ' ';

            if (empty($feed_image))
                $link .= '(';

            $link .= '<a href="' . esc_url(get_term_feed_link($category->term_id, $category->taxonomy, $feed_type)) . '"';

            if (empty($feed)) {
                $alt = ' alt="' . sprintf(__('Feed за всички постове под %s'), $cat_name) . '"';
            } else {
                $title = ' title="' . $feed . '"';
                $alt = ' alt="' . $feed . '"';
                $tax = $feed;
                $link .= $title;
            }

            $link .= '>';

            if (empty($feed_image))
                $link .= $tax;
            else
                $link .= "<img src='$feed_image'$alt$title" . ' />';

            $link .= '</a>';

            if (empty($feed_image))
                $link .= ')';
        }

        if (!empty($show_count))
            $link .= ' (' . intval($category->count) . ')';

        if ('list' == $args['style']) {
            $output .= "\t<li";
            $class = 'cat-item cat-item-' . $category->term_id;
            if (!empty($current_category)) {
                $_current_category = get_term($current_category, $category->taxonomy);
                if ($category->term_id == $current_category)
                    $class .= ' current-cat';
                elseif ($category->term_id == $_current_category->parent)
                    $class .= ' current-cat-parent';
            }
            $output .= ' class="' . $class . '"';
            $output .= ">$link\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }

}



/*============================== FILTERS ======================================================================================================================*/

function widget_revoke_categories_args_filter() {
    $args = func_get_args();
    $args[0]['walker'] = new Walker_Category_revoke;
    return $args[0];
}

function revoke_read_more_filter() {
    return '';
}

add_filter('widget_revoke_categories_args', 'widget_revoke_categories_args_filter');
add_filter('excerpt_more', 'revoke_read_more_filter');

function revoke_excerpt_filter($excerpt) {
    $revoke_read_more = _go('read_more');
    if($revoke_read_more){
        global $revoke_blog_page;
        if($revoke_blog_page){
            global $post;
            $link = '<a class="revoke-read-more" href="'.get_permalink($post).'">'.$revoke_read_more.'</a>';
            $excerpt_after = ' '.$link;
        }else{
            $excerpt_after = '';
        }
    }else{
        $excerpt_after = '';
    }
    
    return $excerpt.$excerpt_after;;
}

add_filter('get_the_excerpt','revoke_excerpt_filter');



/*============================== COMMENTS ======================================================================================================================*/

function revoke_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
            ?>
            <div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e('Pingback:', 'revoke'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Редактирай)', 'revoke'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
            default :
                global $post;
                ?>

                <div <?php comment_class(array('postCommentsEntry')); ?>>

                <div class="postCommentsEntryAvatar">
                    <?php echo get_avatar($comment, 50); ?>
                </div>

                <div class="postCommentsEntryBody">

                <div class="postCommentsEntryBodyUser">
                    <?php echo get_comment_author_link(); ?>
                </div>
                <div class="postCommentsEntryBodyDate">
                    <?php comment_date('F jS, Y'); ?> <?php _e('на','revoke'); ?> <?php comment_time('g:i a'); ?>
                </div>
                <div class="postCommentsEntryBodyMessage">
                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php _e('Вашият коментар чака одобрение.', 'revoke'); ?></p>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>
                <div class="postCommentsEntryBodyButton" id="comment-<?php comment_ID(); ?>">
                    <?php comment_reply_link(array_merge($args, array('reply_text' => __('Отговори', 'revoke'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    <?php edit_comment_link(__('Редактирай', 'revoke')); ?>
                </div>
                <div class="postCommentsEntryBodyReplies">

            <?php
            break;
    endswitch;
}

function revoke_comment_end($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
            ?>
                </div>
            <?php
            break;
        default :
            ?>
                </div></div></div>
            <?php
            break;
    endswitch;
}



/*============================== META BOXES ======================================================================================================================*/

function revoke_featured_video($post) {
    wp_nonce_field(-1, 'revoke_featured_video_nonce');
    $value = get_post_meta($post->ID, 'revoke_featured_video_id', true);
    $enabled = get_post_meta($post->ID, 'revoke_featured_video_enabled', true);
    ?>
    <label><input <?php if ($enabled === '1') echo 'checked="checked" '; ?>value="" type="checkbox" name="revoke_featured_video_input_check_name" id="revoke_featured_video_input_check_id"> <?php _e('Enable featured video', 'revoke'); ?></label>
    <br/>
    <?php
    echo '<input ' . ($enabled === '0' || $enabled === '' ? 'style="display:none;" ' : '') . 'type="text" id="revoke_featured_video_input_id" name="revoke_featured_video_input_name" value="' . esc_attr($value) . '" size="25" />';
}

function revoke_featured_video_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!isset($_POST['revoke_featured_video_nonce']) || !wp_verify_nonce($_POST['revoke_featured_video_nonce']))
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    if (wp_is_post_revision($post_id) === false) {

        $video = $_POST['revoke_featured_video_input_name'];
        $enabled = $_POST['revoke_featured_video_input_check_name'] === NULL ? '0' : '1';

        add_post_meta($post_id, 'revoke_featured_video_id', $video, true) or
                update_post_meta($post_id, 'revoke_featured_video_id', $video);
        add_post_meta($post_id, 'revoke_featured_video_enabled', $enabled, true) or
                update_post_meta($post_id, 'revoke_featured_video_enabled', $enabled);
    }
}

function revoke_disable_title($post) {
    wp_nonce_field(-1, 'revoke_disable_title_nonce');
    $enabled = get_post_meta($post->ID, 'revoke_disable_title_check', true);
    ?>
    <label>
        <input <?php checked($enabled); ?> type="checkbox" name="revoke_disable_title_input_check">
        <?php _e('Disable Page Title', 'revoke'); ?>
    </label>
    <?php
}

function revoke_disable_sidebar($post) {
    wp_nonce_field(-1, 'revoke_disable_sidebar_nonce');
    $enabled = get_post_meta($post->ID, 'revoke_disable_sidebar_check', true);
    ?>
    <label>
        <input <?php checked($enabled); ?> type="checkbox" name="revoke_disable_sidebar_input_check">
        <?php _e('Disable Page Sidebar', 'revoke'); ?>
    </label>
    <?php
}

function revoke_alternative_sidebar($post) {

    global $wp_registered_sidebars;  
      
    $custom = get_post_custom($post->ID);
      
    if(isset($custom['custom_sidebar']))  
        $val = $custom['custom_sidebar'][0];  
    else  
        $val = "default";  
  
    wp_nonce_field(-1,'custom_sidebar_nonce' );  
  
    $output = '<p>'.__("Choose a sidebar to be displayed", 'revoke' ).'</p>';  
    $output .= "<select name='custom_sidebar'>";  
  
    $output .= "<option";  
    if($val == "default")  
        $output .= " selected='selected'";  
    $output .= " value='default'>".__('default', 'revoke')."</option>";  
      
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
    {  
        $output .= "<option";  
        if($sidebar_id == $val)  
            $output .= " selected='selected'";  
        $output .= " value='".$sidebar_id."'>".$sidebar['name']."</option>";  
    }  
    
    $output .= "</select>";  
      
    echo $output;
}

function revoke_disable_padding($post) {
    wp_nonce_field(-1, 'revoke_disable_padding_nonce');
    $enabled = get_post_meta($post->ID, 'revoke_disable_padding_check', true);
    ?>
    <label>
        <input <?php checked($enabled); ?> type="checkbox" name="revoke_disable_padding_input_check">
        <?php _e('Revome the spacing at the bottom of the page', 'revoke'); ?>
    </label>
    <?php
}

function revoke_disable_title_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!isset($_POST['revoke_disable_title_nonce']) || !wp_verify_nonce($_POST['revoke_disable_title_nonce']))
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    if (wp_is_post_revision($post_id) === false) {

        $enabled = $_POST['revoke_disable_title_input_check'] === NULL ? false : true;

        add_post_meta($post_id, 'revoke_disable_title_check', $enabled, true) or
                update_post_meta($post_id, 'revoke_disable_title_check', $enabled);
    }
}

function revoke_disable_sidebar_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!isset($_POST['revoke_disable_sidebar_nonce']) || !wp_verify_nonce($_POST['revoke_disable_sidebar_nonce']))
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    if (wp_is_post_revision($post_id) === false) {

        $enabled = $_POST['revoke_disable_sidebar_input_check'] === NULL ? false : true;

        add_post_meta($post_id, 'revoke_disable_sidebar_check', $enabled, true) or
                update_post_meta($post_id, 'revoke_disable_sidebar_check', $enabled);
    }
}

function revoke_alternative_sidebar_save($post_id) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
      return;  

    if (!isset($_POST['custom_sidebar_nonce']) || !wp_verify_nonce($_POST['custom_sidebar_nonce']))
        return;
  
    if ( !current_user_can( 'edit_page', $post_id ) )  
        return;  
  
    if (wp_is_post_revision($post_id) === false) {
        $data = $_POST['custom_sidebar'];

        add_post_meta($post_id, "custom_sidebar", $data,true) or
            update_post_meta($post_id, "custom_sidebar", $data); 
    }
}

function revoke_disable_padding_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!isset($_POST['revoke_disable_padding_nonce']) || !wp_verify_nonce($_POST['revoke_disable_padding_nonce']))
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    if (wp_is_post_revision($post_id) === false) {

        $enabled = $_POST['revoke_disable_padding_input_check'] === NULL ? false : true;

        add_post_meta($post_id, 'revoke_disable_padding_check', $enabled, true) or
                update_post_meta($post_id, 'revoke_disable_padding_check', $enabled);
    }
}

function revoke_meta_boxes() {
    add_meta_box('revoke_featured_video_id', 'Featured Video', 'revoke_featured_video', 'post', 'side', 'low');
    add_meta_box('revoke_featured_video_id', 'Featured Video', 'revoke_featured_video', 'page', 'side', 'low');
    add_meta_box('revoke_disable_title_id', 'Disable Title', 'revoke_disable_title', 'page', 'side', 'low');
    add_meta_box('revoke_disable_sidebar', 'Disable Sidebar', 'revoke_disable_sidebar', 'page', 'side', 'low');
    add_meta_box('revoke_alternative_sidebar', 'Alternative Sidebar', 'revoke_alternative_sidebar', 'page', 'side', 'low');
    add_meta_box('revoke_disable_padding', 'Disable Page Bottom Padding', 'revoke_disable_padding', 'page', 'side', 'low');
}

add_action('add_meta_boxes', 'revoke_meta_boxes');
add_action('save_post', 'revoke_featured_video_save');
add_action('save_post', 'revoke_disable_title_save');
add_action('save_post', 'revoke_disable_sidebar_save');
add_action('save_post', 'revoke_alternative_sidebar_save');
add_action('save_post', 'revoke_disable_padding_save');



/*============================== MENU ======================================================================================================================*/

class Revoke_Nav_Menu_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"menuLevel\"><ul class=\"sub-menu menuDrop font3\">\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>'.($depth?'<div class="menuDropArrow"></div>':'');

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class Revoke_List_Pages_Walker extends Walker_Page {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"menuLevel\"><ul class='children menuDrop font3'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

    function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';

        extract($args, EXTR_SKIP);
        $css_class = array('page_item', 'page-item-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_post( $current_page );
            if ( in_array( $page->ID, $_current_page->ancestors ) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

        $output .= $indent . '<li class="' . $css_class . '">'.($depth?'<div class="menuDropArrow"></div>':'').'<a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

            $output .= " " . mysql2date($date_format, $time);
        }
    }
}

class Revoke_Nav_Menu_Select_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {

    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {

    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $pad = str_repeat('&nbsp;', $depth * 3);

        $output .= "\t<option class=\"level-$depth\" value=\"".$item->url."\"";
        if ( isset($args->selected) && $item->url == $args->selected )
            $output .= ' selected="selected"';
        $output .= '>';
        $title = $item->title;
        $output .= $pad . esc_html( $title );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</option>\n";
    }
}

class Revoke_List_Pages_Select_Walker extends Walker_Page {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        
    }

    function start_el(&$output, $page, $depth = 0, $args = array(), $id = 0 ) {
        $pad = str_repeat('&nbsp;', $depth * 3);

        $url = get_permalink($page->ID);

        $output .= "\t<option class=\"level-$depth\" value=\"".$url."\"";
        if ( isset($args->selected) && $url == $args->selected )
            $output .= ' selected="selected"';
        $output .= '>';
        $title = $page->post_title;
        $output .= $pad . esc_html( $title );
    }

    function end_el( &$output, $page, $depth = 0, $args = array() ) {
        $output .= "</option>\n";
    }
}



/*============================== SHORTCODES ======================================================================================================================*/

function revoke_column_first_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'size' => 4,
            'style' => '',
        ), $atts));
    $size = (int)$size;
    return '<div class="row-fluid"><div class="span'.$size.'" style="'.$style.'">'.do_shortcode($content).'</div>';
}
function revoke_column_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'size' => 4,
            'style' => '',
        ), $atts));
    $size = (int)$size;
    return '<div class="span'.$size.'" style="'.$style.'">'.do_shortcode($content).'</div>';
}
function revoke_column_last_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'size' => 4,
            'style' => '',
        ), $atts));
    $size = (int)$size;
    return '<div class="span'.$size.'" style="'.$style.'">'.do_shortcode($content).'</div></div>';
}
add_shortcode( 'revoke_column_first', 'revoke_column_first_shortcode' );
add_shortcode( 'revoke_column', 'revoke_column_shortcode' );
add_shortcode( 'revoke_column_last', 'revoke_column_last_shortcode' );
add_shortcode( 'tesla_column_first', 'revoke_column_first_shortcode' );
add_shortcode( 'tesla_column', 'revoke_column_shortcode' );
add_shortcode( 'tesla_column_last', 'revoke_column_last_shortcode' );

function revoke_map_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'height' => '384px',
            'width' => '100%',
            'address' => 'London, UK',
            'style' => ''
        ), $atts));
    return '<iframe style="height:'.$height.';width:'.$width.';'.$style.'" src="http://maps.google.com/maps?q=' . urlencode($address) . '&amp;output=embed&amp;iwloc" class="revoke_map"></iframe>';
}
add_shortcode( 'revoke_map', 'revoke_map_shortcode' );

function tesla_map_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'height' => '384px',
            'width' => '100%',
            'address' => 'London, UK',
            'style' => ''
        ), $atts));
    return tt_gmap('contact_map', 'map-canvas','revoke_map\' style=\'height:'.$height.';width:'.$width.';'.$style,'true',false);
}
add_shortcode( 'tesla_map', 'tesla_map_shortcode' );

function revoke_contact_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'title' => '',
            'style' => ''
        ), $atts));
    if(empty($title))
        $title = _go('form_title');
    if(empty($title))
        $title = 'Не бъди толкова АЙляк, ела и кажи здрасти';
    $output = '<form class="contactForm" action="" style="'.$style.'">
            <div class="contactFormTitle font1">
                '.$title.'
                <input name="action" type="hidden" value="revoke_contact" />
            </div>
            <fieldset class="contactFormDetails">
                <input type="text" name="input-name" value="" placeholder="'.__('Име','revoke').'">
                <input type="text" name="input-email" value="" placeholder="'.__('E-mail','revoke').'">
            </fieldset>
            <fieldset class="contactFormMessage">
                <textarea rows="" cols="" name="input-message" placeholder="'.__('Въведи съобщението си тук','revoke').'"></textarea>
            </fieldset>
            <fieldset class="contactFormButtons">
                <input type="submit" value="'.__('Изпрати','revoke').'">
            </fieldset>
        </form>
        <div class="contactResult"></div>';
    return $output;
}
add_shortcode( 'revoke_contact', 'revoke_contact_shortcode' );
add_shortcode( 'tesla_contact', 'revoke_contact_shortcode' );
function revoke_contact_ajax(){
    $receiver_mail = _go('email_contact');
    if(!empty($receiver_mail))
    {
        $mail_title_prefix = _go('email_prefix');
        if(empty($mail_title_prefix))
            $mail_title_prefix = '';
        if( !empty($_POST['input-name']) && !empty($_POST['input-email']) && !empty($_POST['input-message']) ){
                $subject = $mail_title_prefix.__(' съобщение от ','revoke').$_POST['input-name'].' ('.$_POST['input-email'].')';
            $reply_to = is_email($_POST['input-email']);
            if(false!==$reply_to){
                $reply_to = $_POST['input-name'] . '<' . $reply_to . '>';
                $headers = '';
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
                $headers .= 'Reply-to: ' . $reply_to . "\r\n";
                $message = 'Име: '.$_POST['input-name']."\r\n".'E-mail: '.$_POST['input-email']."\r\n".'Съобщение: '.$_POST['input-message'];
                if ( wp_mail($receiver_mail, $subject, $message, $headers) ){
                    $result = __("Вашето съобщение е изпратено успешно.",'revoke');
                    $result_error = false;
                }else{
                    $result = __("Съобщението не може да бъде изпратено.",'revoke');
                    $result_error = true;
                }
            }else{
                $result = __("Грешно въведен e-mail адрес.",'revoke');
                $result_error = true;
            }
        }else{
            $result = __("Моля попълнете всички задължителни полета.",'revoke');
            $result_error = true;
        }
    }else{
        $result = __('Грешка! Грешна конфигурация!','revoke');
        $result_error = true;
    }
    echo json_encode(array(
        'message' => $result,
        'error' => $result_error
    ));
    die;
}
add_action( "wp_ajax_revoke_contact", "revoke_contact_ajax" );
add_action( "wp_ajax_nopriv_revoke_contact", "revoke_contact_ajax" );

function revoke_post_slider_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'speed' => 4,
            'pause' => 8
        ), $atts));
    $speed = (int)$speed;
    $pause = (int)$pause;
    $before = '
    <div class="pageSlider" style="'.$style.'" data-speed="'.($speed*1000).'" data-pause="'.($pause*1000).'">
        <div class="pageSliderItems">
            <ul>
    ';
    $after = '
            </ul>
        </div>
    </div>
    ';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_secondary_slider', 'revoke_post_slider_shortcode' );
function revoke_post_slider_item_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'image' => '',
            'style' => ''
        ), $atts));
    $output = '<li><img src="'.$image.'" alt="" /></li>';
    return $output;
}
add_shortcode( 'revoke_secondary_slider_item', 'revoke_post_slider_item_shortcode' );

function revoke_clients_slider_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'title' => 'our clients',
            'style' => ''
        ), $atts));
    $before = '
    <div class="clients" style="'.$style.'">
        <div class="titleContainer font1">
            <div class="title">
                '.$title.'
            </div>
            <div class="clientsNav">
                <div class="clientsNavPrev"></div>
                <div class="clientsNavNext"></div>
            </div>
        </div>
        <ul>
    ';
    $after = '
        </ul>
    </div>
    ';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_clients_slider', 'revoke_clients_slider_shortcode' );
function revoke_clients_slider_item_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'image' => ''
        ), $atts));
    $output = '<li><img src="'.$image.'" alt="" /></li>';
    return $output;
}
add_shortcode( 'revoke_clients_slider_item', 'revoke_clients_slider_item_shortcode' );

function revoke_testimonial_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'image' => '',
            'author' => '',
            'wide' => 'false',
            'style' => ''
        ), $atts));
    $output = '
    <div class="testimonialbg'.($wide==='true'?' testimonialbgwide':'').'" style="'.$style.'">
        <div class="testimonial">
            <div class="testimonialImg bordercolor">
                <img src="'.$image.'" alt="" />
            </div>
            <div class="testimonialContent font4">
                <div class="testimonialContentText textcolor4">
                    '.do_shortcode($content).'
                </div>
                <div class="testimonialContentAuthor textcolor5">
                    &HorizontalLine; '.$author.'
                </div>
            </div>
        </div>
    </div>
    ';
    return $output;
}
add_shortcode( 'revoke_testimonial', 'revoke_testimonial_shortcode' );

global $revoke_main_slider_toggle_caption;
function revoke_main_slider_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'speed' => 4,
            'pause' => 8,
            'toggle_caption' => true
        ), $atts));
    $speed = (int)$speed;
    $pause = (int)$pause;
    $toggle_caption = (bool)$toggle_caption;
    global $revoke_main_slider_toggle_caption;
    $revoke_main_slider_toggle_caption = $toggle_caption;
    $before = '<div class="mainSlider" style="'.$style.'" data-speed="'.($speed*1000).'" data-pause="'.($pause*1000).'">
        <div class="mainSliderItemsWrapper">
            <div class="mainSliderItems">';
    $after = '</div>
        </div>
        <div class="mainSliderNav">
            <div class="mainSliderNavBar bgcolor"></div>
        </div>
    </div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_main_slider', 'revoke_main_slider_shortcode' );
function revoke_main_slider_item_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'title' => '',
            'image' => '',
            'style' => ''
        ), $atts));
    global $revoke_main_slider_toggle_caption;
    $before = '
        <div class="mainSliderItemsEntry">
            <img src="'.$image.'" class="mainSliderItemsEntryImg" alt="" />
            <div class="mainSliderItemsEntryBox bgcolor2'.($revoke_main_slider_toggle_caption?' mainSliderItemsEntryBoxToggle':'').'">
                <div class="mainSliderItemsEntryBoxBorder"></div>
                <div class="mainSliderItemsEntryBoxTitle textcolor2 font3">
                    '.$title.'
                </div>
                <div class="mainSliderItemsEntryBoxContent textcolor3">
                    ';
    $after = '
                </div>
                <div class="mainSliderItemsEntryBoxButtons">
                    <div class="mainSliderItemsEntryBoxButtonsPrev bgcolor3 bgcolor_hover"></div>
                    <div class="mainSliderItemsEntryBoxButtonsNext bgcolor3 bgcolor_hover"></div>
                </div>
            </div>
        </div>
        ';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_main_slider_item', 'revoke_main_slider_item_shortcode' );


function revoke_portofolio_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
        ), $atts));
    $before = '<div class="works">';
    $after = '</div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio', 'revoke_portofolio_shortcode' );
add_shortcode( 'revoke_portfolio', 'revoke_portofolio_shortcode' );
function revoke_portofolio_categories_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
        ), $atts));
    $before = '<div class="worksFilter">
                        <div class="worksFilterText textcolor6">
                            '.__('Галерия:','revoke').'
                        </div>
                        <ul class="worksFilterCategories">
                            <li class="textcolor6 worksFilterCategoriesActive bordercolor3" data-category="all">
                                <div class="bordercolor3">
                                    '.__('ВСИЧКИ','revoke').'
                                </div>
                            </li>';
    $after = '</ul>
                    </div>
                    <div class="worksViews">
                        <div class="worksViewsOption bordercolor3 worksViewsOptionActive" data-class="worksContainerView1">
                            <img src="'.get_template_directory_uri().'/images/options/sort_opt1.png" alt="" />
                        </div>
                        <div class="worksViewsOption bordercolor3" data-class="worksContainerView2">
                            <img src="'.get_template_directory_uri().'/images/options/sort_opt2.png" alt="" />
                        </div>
                    </div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio_categories', 'revoke_portofolio_categories_shortcode' );
add_shortcode( 'revoke_portfolio_categories', 'revoke_portofolio_categories_shortcode' );
function revoke_portofolio_category_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'slug' => ''
        ), $atts));
    $before = '<li class="textcolor6 bordercolor3" data-category="'.($slug===''?$content:$slug).'">
                                <div class="bordercolor3">';
    $after = '</div>
                            </li>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio_category', 'revoke_portofolio_category_shortcode' );
add_shortcode( 'revoke_portfolio_category', 'revoke_portofolio_category_shortcode' );
function revoke_portofolio_items_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
        ), $atts));
    $before = '<div class="worksContainer worksContainerView1">';
    $after = '</div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio_items', 'revoke_portofolio_items_shortcode' );
add_shortcode( 'revoke_portfolio_items', 'revoke_portofolio_items_shortcode' );
function revoke_portofolio_item_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'categories' => '',
            'image_small' => '',
            'image_big' => '',
            'url' => '',
            'title' => '',
            'no_more' => false
        ), $atts));
    $no_more = (bool)$no_more;
    $before = '<div class="worksEntry" data-categories="'.$categories.'">
        <div class="worksEntryContainer">
            <div class="worksEntryInfo">
                <div class="worksEntryInfoTitle">
                    <a href="'.$url.'">
                        '.$title.'
                    </a>
                </div>';
    $after = (!$no_more?'<div class="worksEntryInfoMore"><a href="'.$url.'">'.__('виж','revoke').'</a></div>':'').
            '</div>
            <a href="'.$url.'"><img class="worksEntryImg" src="'.$image_small.'" alt="" /></a>
            <img class="worksEntryImgBig" src="'.$image_big.'" alt="" />
        </div>
    </div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio_item', 'revoke_portofolio_item_shortcode' );
add_shortcode( 'revoke_portfolio_item', 'revoke_portofolio_item_shortcode' );
function revoke_portofolio_item_description_small_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'category' => '',
        ), $atts));
    $before = '<div  class="worksEntryInfoExcerpt">';
    $after = '</div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio_item_description_small', 'revoke_portofolio_item_description_small_shortcode' );
add_shortcode( 'revoke_portfolio_item_description_small', 'revoke_portofolio_item_description_small_shortcode' );
function revoke_portofolio_item_description_big_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'category' => '',
        ), $atts));
    $before = '<div  class="worksEntryInfoExcerptBig">';
    $after = '</div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_portofolio_item_description_big', 'revoke_portofolio_item_description_big_shortcode' );
add_shortcode( 'revoke_portfolio_item_description_big', 'revoke_portofolio_item_description_big_shortcode' );

function revoke_project_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
        ), $atts));
    $before = '<div class="project">';
    $after = '</div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_project', 'revoke_project_shortcode' );
function revoke_project_slider_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'speed' => 4,
            'pause' => 8
        ), $atts));
    $speed = (int)$speed;
    $pause = (int)$pause;
    $before = '
    <div class="pageSlider" style="'.$style.'" data-speed="'.($speed*1000).'" data-pause="'.($pause*1000).'">
        <div class="pageSliderItems">
            <ul>
    ';
    $after = '
            </ul>
        </div>
    </div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_project_slider', 'revoke_project_slider_shortcode' );
function revoke_project_slider_item_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'image' => ''
        ), $atts));
    $output = '<li><img src="'.$image.'" alt="" /></li>';
    return $output;
}
add_shortcode( 'revoke_project_slider_item', 'revoke_project_slider_item_shortcode' );
function revoke_project_info_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'title' => '',
            'description' => '',
            'categories' => '',
            'skills' => '',
            'url' => '',
        ), $atts));
    $output = '
    <div class="projectInfo">
        <div class="projectInfoTitle font1">
            '.$title.'
        </div>
        <div class="projectInfoDescription">
            '.$description.'
        </div>
        <div class="projectInfoDetails">
            <div class="projectInfoDetailsTitle font1">
                '.__('Описание','revoke').'
            </div>
            <div class="projectInfoDetailsEntry">
                <div class="projectInfoDetailsEntryTitle">
                    '.__('Категория','revoke').'
                </div>
                <div class="projectInfoDetailsEntryBody">
                    '.$categories.'
                </div>
            </div>
            <div class="projectInfoDetailsEntry">
                <div class="projectInfoDetailsEntryTitle">
                    '.__('Фотограф','revoke').'
                </div>
                <div class="projectInfoDetailsEntryBody">
                    '.$skills.'
                </div>
            </div>
            <div class="projectInfoDetailsEntry">
                <div class="projectInfoDetailsEntryTitle">
                    '.__('Още снимки','revoke').'
                </div>
                <div class="projectInfoDetailsEntryBody">
                    <a href="'.$url.'">'.__('link','revoke').'</a>
                </div>
            </div>
        </div>
    </div>
    ';
    return $output;
}
add_shortcode( 'revoke_project_info', 'revoke_project_info_shortcode' );
function revoke_project_related_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
        ), $atts));
    $before = '
    <div class="projectRelated">
        <div class="titleContainer font1">
            <div class="title">
                '.__('Други снимки','revoke').'
            </div>
            <div class="clientsNav">
                <div class="clientsNavPrev"></div>
                <div class="clientsNavNext"></div>
            </div>
        </div>
        <ul>
    ';
    $after = '</ul>
    </div>';
    return $before.do_shortcode(str_replace('<br />','',shortcode_unautop($content))).$after;
}
add_shortcode( 'revoke_project_related', 'revoke_project_related_shortcode' );
function revoke_project_related_item_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(
            'style' => '',
            'title' => '',
            'description' => '',
            'image' => '',
            'url' => '',
        ), $atts));
    $output = '
    <li>
        <a href="'.$url.'">
            <img src="'.$image.'" alt="" />
        </a>
        <div class="title">
            <a href="'.$url.'">
                '.$title.'
            </a>
        </div>
        <div class="description">
            '.$description.'
        </div>
    </li>
    ';
    return $output;
}
add_shortcode( 'revoke_project_related_item', 'revoke_project_related_item_shortcode' );



/*============================== CUSTOM TAXONOMY FIELDS ======================================================================================================================*/

define("TT_TAX_ORDER", "revoke_portfolio");

function tt_taxonomy_add_fields() {
    ?>
    <div class="form-field">
        <label for="tt_tax_order_input"><?php _ex( 'Order', 'portfolio category order', 'revoke' ); ?></label>
        <input type="text" name="tt_tax_order_input" id="tt_tax_order_input" value="">
        <p class="description"><?php _ex( 'Set the order in which the categories should be displayed.', 'portfolio category order', 'revoke' ); ?></p>
    </div>
    <?php
}

add_action( TT_TAX_ORDER.'_tax_add_form_fields', 'tt_taxonomy_add_fields', 10, 2 );

function tt_taxonomy_edit_fields($term) {
 
    $term_id = $term->term_id;
    $term_meta = tt_taxonomy_order($term_id);

    ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="tt_tax_order_input"><?php _ex( 'Order', 'portfolio category order', 'revoke' ); ?></label></th>
        <td>
            <input type="text" name="tt_tax_order_input" id="tt_tax_order_input" value="<?php echo esc_attr( $term_meta ); ?>">
            <p class="description"><?php _ex( 'Set the order in which the categories should be displayed.', 'portfolio category order', 'revoke' ); ?></p>
        </td>
    </tr>
    <?php
}

add_action( TT_TAX_ORDER.'_tax_edit_form_fields', 'tt_taxonomy_edit_fields', 10, 2 );

function tt_taxonomy_save_fields( $term_id ) {
    if ( isset( $_POST['tt_tax_order_input'] ) ) {
        $term_meta_array = tt_taxonomy_order();
        $term_meta = $_POST['tt_tax_order_input'];
        $term_meta_array[$term_id] = $term_meta;
        update_option(TT_TAX_ORDER."_taxonomy_order", $term_meta_array);
    }
}

add_action( 'edited_'.TT_TAX_ORDER.'_tax', 'tt_taxonomy_save_fields', 10, 2 );
add_action( 'create_'.TT_TAX_ORDER.'_tax', 'tt_taxonomy_save_fields', 10, 2 );

function tt_taxonomy_columns_head($columns) {
    $columns['order']  = _x( 'Order', 'portfolio category order column', 'revoke' );
    return $columns;
}

add_filter('manage_edit-'.TT_TAX_ORDER.'_tax_columns', 'tt_taxonomy_columns_head');

function tt_taxonomy_order($term_id = null){

    $term_meta_array = get_option(TT_TAX_ORDER."_taxonomy_order", array());

    if(is_null($term_id)){

        return $term_meta_array;

    }else{

        $term_meta = (int) ( array_key_exists($term_id, $term_meta_array) ? $term_meta_array[$term_id] : 0 );
        return $term_meta;

    }

}

function tt_terms_ordered_compare($a, $b){

    $a_order = tt_taxonomy_order($a->term_id);
    $b_order = tt_taxonomy_order($b->term_id);

    if ($a_order === $b_order)
        return strcmp($a->name, $b->name);
    else
        return ($a_order < $b_order) ? -1 : 1;

}

function tt_terms_ordered($tax_array){

    usort($tax_array, 'tt_terms_ordered_compare');
    return $tax_array;

}

add_filter('tesla_slide_categories_'.TT_TAX_ORDER, 'tt_terms_ordered', 10, 2);

function tt_taxonomy_columns_content($empty, $column_name, $term_id) {
    if ($column_name == 'order') {
        $term_meta = tt_taxonomy_order($term_id);
        echo $term_meta;
    }
}

add_filter('manage_'.TT_TAX_ORDER.'_tax_custom_column', 'tt_taxonomy_columns_content', 10, 3);

function tt_taxonomy_columns_quick_edit($column_name, $screen, $tax){

    if($tax !== TT_TAX_ORDER.'_tax' || $column_name !== 'order')
        return false;

    ?>
    <fieldset>
        <div id="my-custom-content" class="inline-edit-col">
            <label>
                <span class="title">Order</span>
                <span class="input-text-wrap"><input type="text" name="tt_tax_order_input" class="ptitle" value=""></span>
            </label>
        </div>
    </fieldset>
    <?php
}

if('edit-tags.php'===$pagenow)
    add_action('quick_edit_custom_box', 'tt_taxonomy_columns_quick_edit', 10, 3);

function tt_taxonomy_columns_scripts($hook_suffix) {
    if ('edit-tags.php' === $hook_suffix && isset($_GET['taxonomy']) && TT_TAX_ORDER.'_tax' === $_GET['taxonomy'] && !isset($_GET['action'])){
        wp_enqueue_script('tt-tax-quickedit', get_template_directory_uri() . '/admin/quickedit.js',array('inline-edit-tax'),null,true);
    }
}

if(is_admin())
    add_action('admin_enqueue_scripts', 'tt_taxonomy_columns_scripts');



/*============================== THEME VERSION COMPATIBILITY ======================================================================================================================*/

function revoke_compatibility($meta, $id, $context){
    if(is_string($meta)){
        $meta_json = json_decode($meta, true);
        if(is_array($meta_json)){
            $meta = $meta_json;
        }else{
            $meta_serialize = unserialize($meta);
            if(is_array($meta_serialize)){
                $meta = $meta_serialize;
            }else{
                $meta = array();
            }
        }
    }
    $post_type = get_post_type($id);
    switch($post_type){
        case 'revoke_main':
            break;

        case 'revoke_clients':
            break;

        case 'revoke_secondary':
            break;

        case 'revoke_portfolio':
            if(isset($meta['image_slider'])&&!isset($meta['slider'])){
                if(count($meta['image_slider'])){
                    $meta['slider'] = array();
                    foreach ($meta['image_slider'] as $key => $value) {
                        array_push($meta['slider'], array( 'image' => $value ));
                    }
                }
                unset($meta['image_slider']);
            }
            if(isset($meta['categories'])&&isset($meta['skills'])&&isset($meta['url'])&&isset($meta['full_description'])&&!isset($meta['info'])){

                $title = __('Project Details','revoke');
                if('Project Details'!==$title)
                    $title = 'Details';

                if(true||''===$meta['categories']){
                    $terms = get_the_terms($id, $post_type.'_tax');
                    if(false===$terms)
                        $terms = array();
                    $categories = array();
                    foreach ($terms as $key => $value) {
                        array_push($categories, $value->name);
                    }
                    $categories = implode(', ', $categories);
                }else{
                    $categories = $meta['categories'];
                }

                $categories_title = __('Categories','revoke');

                $skills_title = __('Skills','revoke');

                $url_title = __('Project url','revoke');
                if('Project url'!==$url_title)
                    $url_title = 'URL';

                $meta['info'] = array(
                    array(
                        'title' => 'Описание',
                        'content' => array(
                            'text' => $meta['full_description']
                        )
                    ),
                    array(
                        'title' => $title,
                        'content' => array(
                            'fields' => array(
                                array(
                                    'name' => $categories_title,
                                    'value' => $categories
                                ),
                                array(
                                    'name' => $skills_title,
                                    'value' => $meta['skills']
                                ),
                                array(
                                    'name' => $url_title,
                                    'value' => '<a target="_blank" href="'.esc_attr($meta['url']).'">'.__('Project link','revoke').'</a>'
                                )
                            )
                        )
                    )
                );
                unset($meta['categories']);
                unset($meta['skills']);
                unset($meta['url']);
                unset($meta['full_description']);
            }
            break;

        case 'revoke_testimonial':
            break;

        default:
            break;
    }
    return $meta;
}

add_filter('tesla_slide_options', 'revoke_compatibility', 10, 3);

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['gpx'] = 'application/gpx+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');