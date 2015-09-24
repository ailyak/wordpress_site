<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head profile="http://gmpg.org/xfn/11">

        <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
      <!--  <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />  leave this for stats please -->

        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
        <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php
            $favicon = _go('favicon');
            if(empty($favicon))
                $favicon = get_template_directory_uri().'/images/favicon.ico';
            echo '<link rel="icon" type="image/png" href="'.$favicon.'">';
        ?>

        <?php wp_head(); ?>

    </head>
    <body <?php body_class(array('font3 revoke_custom_background')); ?>>

        
        <div class="yellow">
            <div class="wrapper">
                <div class="header"><!-- HEADER START -->
                	
                    <?php
                        $logo = _go('logo_text');
                        if(empty($logo)){
                                $logo = _go('logo_image');
							
                            if(empty($logo))
                                $logo = get_template_directory_uri().'/images/logo.png';
                            echo '<div class="logo"><a href="'.home_url().'"><img src="'.$logo.'" alt="logo" /></a></div>';
                        }else{
                            $text_color = _go('logo_text_color');
                            if(empty($text_color))
                                $text_color = '#fe5113';
                            echo '<div class="logo" style="margin-top:0;"><a href="'.home_url().'"><span style="line-height:43px;font-family:'._go('logo_text_font').';color:'.$text_color.';font-size:'._go('logo_text_size').'px;">'.$logo.'</span></a></div>';
                        }
                    ?>
                    <?php
                    $revoke_social = array(
                        'facebook'=>_go('social_platforms_facebook'),
                        'twitter'=>_go('social_platforms_twitter'),
                        'google'=>_go('social_platforms_google'),
                        'pinterest'=>_go('social_platforms_pinterest'),
                        'linkedin'=>_go('social_platforms_linkedin'),
                        'dribble'=>_go('social_platforms_dribbble'),
                        'behance'=>_go('social_platforms_behance'),
                        'youtube'=>_go('social_platforms_youtube'),
                        'flickr'=>_go('social_platforms_flickr'),
                        'instagram'=>_go('social_platforms_instagram')
                    );
                    $revoke_social_values = array_values($revoke_social);
                    $revoke_social_filtered = array_filter($revoke_social_values);
                    if(!empty($revoke_social_filtered)): ?>
                    <div class="social">
                        <?php if(!empty($revoke_social['facebook'])): ?>
                        <a href="<?php echo $revoke_social['facebook']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="facebook" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['twitter'])): ?>
                        <a href="<?php echo $revoke_social['twitter']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="twitter" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['google'])): ?>
                        <a href="<?php echo $revoke_social['google']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/googleplus.png" alt="google plus" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['pinterest'])): ?>
                        <a href="<?php echo $revoke_social['pinterest']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/pinterest.png" alt="pinterest" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['linkedin'])): ?>
                        <a href="<?php echo $revoke_social['linkedin']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt="linkedin" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['dribble'])): ?>
                        <a href="<?php echo $revoke_social['dribble']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/dribble.png" alt="dribble" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['behance'])): ?>
                        <a href="<?php echo $revoke_social['behance']; ?>" target="_blank">
                            <img style="width:20px;height:auto;" src="<?php echo get_template_directory_uri(); ?>/images/social/behance.png" alt="behance" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['youtube'])): ?>
                        <a href="<?php echo $revoke_social['youtube']; ?>" target="_blank">
                            <img style="width:20px;height:auto;" src="<?php echo get_template_directory_uri(); ?>/images/social/youtube.png" alt="youtube" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['flickr'])): ?>
                        <a href="<?php echo $revoke_social['flickr']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/flickr.png" alt="flickr" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['instagram'])): ?>
                        <a href="<?php echo $revoke_social['instagram']; ?>" target="_blank">
                            <img style="width:20px;height:auto;" src="<?php echo get_template_directory_uri(); ?>/images/social/instagram.png" alt="instagram" />
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($revoke_social['rss'])): ?>
                        <a href="<?php echo $revoke_social['rss']; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/social/rss.png" alt="rss" />
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="menuContainer">
                        <?php
                        if(has_nav_menu('revoke_menu')){
                            wp_nav_menu(array(
                                'theme_location'  => 'revoke_menu',
                                'menu'            => '',
                                'container'       => false,
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'menu font1',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => false,
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => new Revoke_Nav_Menu_Walker
                            ));
                            wp_nav_menu(array(
                                'theme_location'  => 'revoke_menu',
                                'menu'            => '',
                                'container'       => false,
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => '',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => false,
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<select id="%1$s" class="%2$s"><option> -- Select A Page -- </option>%3$s</select>',
                                'depth'           => 0,
                                'walker'          => new Revoke_Nav_Menu_Select_Walker
                            ));
                        }else{
                            echo '<ul class="menu font1">'.wp_list_pages(array(
                                'depth'        => 0,
                                'show_date'    => '',
                                'date_format'  => get_option('date_format'),
                                'child_of'     => 0,
                                'exclude'      => '',
                                'include'      => '',
                                'title_li'     => '',
                                'echo'         => 0,
                                'authors'      => '',
                                'sort_column'  => 'menu_order, post_title',
                                'link_before'  => '',
                                'link_after'   => '',
                                'walker'       => new Revoke_List_Pages_Walker,
                                'post_type'    => 'page',
                                'post_status'  => 'publish' 
                            )).'</ul>';
                            echo '<select><option>Начално меню</option>'.wp_list_pages(array(
                                'depth'        => 0,
                                'show_date'    => '',
                                'date_format'  => get_option('date_format'),
                                'child_of'     => 0,
                                'exclude'      => '',
                                'include'      => '',
                                'title_li'     => '',
                                'echo'         => 0,
                                'authors'      => '',
                                'sort_column'  => 'menu_order, post_title',
                                'link_before'  => '',
                                'link_after'   => '',
                                'walker'       => new Revoke_List_Pages_Select_Walker,
                                'post_type'    => 'page',
                                'post_status'  => 'publish'
                            )).'</select>';
                        }
                        ?>
                    </div>
                </div><!-- HEADER END -->
            </div>
       	</div>
        <?php if (is_page( '22' )) { ?>
        <div class="main-page-sub-header">
			<div class="black">
            	<div class="header-img">
            		<div class="slogan">
                    	<h1>
                    	Айляк Cycling, майна!
                        </h1>
                    </div>
                </div>
            </div>
		</div>
       <?php }?>
       
        <div id="contents"><!-- CONTENTS START -->
            <div class="wrapper">