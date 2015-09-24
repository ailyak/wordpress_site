<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

<div class="titleContainer font1 titlePage titleBordered">
    <div class="title">
        <?php the_title(); ?>
    </div>
</div>

<div class="page page-no-padding">
	<div class="pageContents">
		<?php echo Tesla_slider::get_slider_html('revoke_portfolio','','single',get_the_ID()); ?>
	</div>
    <?php comments_template(); ?>
</div>

<?php endif; ?>

<?php get_footer(); ?>