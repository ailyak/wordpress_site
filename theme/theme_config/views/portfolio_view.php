<?php
$categories_filter = explode(',', $shortcode['categories_filter']);
$categories_filter = array_filter($categories_filter);
foreach ($categories_filter as $key => $value) $categories_filter[$key] = trim($value);
$categories_filter_count = count($categories_filter);
?>

<div class="works" data-view="<?php echo $shortcode['default_view']; ?>">
	<div class="worksFilter">
	    <div class="worksFilterText textcolor6">
	        <?php echo $shortcode['title']; ?>
	    </div>
	    <ul class="worksFilterCategories">
	        <li class="textcolor6 worksFilterCategoriesActive bordercolor3" data-category="all">
	            <div class="bordercolor3">
	                <?php _e('all','revoke'); ?>
	            </div>
	        </li>
	        <?php foreach($all_categories as $category_slug => $category_name): ?>
	        <?php if($categories_filter_count && !in_array($category_slug, $categories_filter)) continue; ?>
			<li class="textcolor6 bordercolor3" data-category="<?php echo $category_slug; ?>">
	            <div class="bordercolor3">
	            	<?php echo $category_name; ?>
	            </div>
	        </li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="worksViews">
	    <div class="worksViewsOption bordercolor3 worksViewsOptionActive" data-class="worksContainerView1">
	        <img src="<?php echo get_template_directory_uri(); ?>/images/options/sort_opt1.png" alt="" />
	    </div>
	    <div class="worksViewsOption bordercolor3" data-class="worksContainerView2">
	        <img src="<?php echo get_template_directory_uri(); ?>/images/options/sort_opt2.png" alt="" />
	    </div>
	</div>
	<div class="worksContainer worksContainerView1">
		<?php
		$nr = (int)$shortcode['nr'];
		if($nr===0)
			$nr = count($slides);
		$counter = 0;
		foreach($slides as $i => $slide):
			if($categories_filter_count && !count(array_intersect($categories_filter, array_keys($slide['categories'])))) continue;
			if($counter>=$nr)
				break;
			else
				$counter++;
		?>
		<div class="worksEntry<?php if($slide['options']['video']!=='') echo ' no_effect'; ?>" data-categories="<?php echo implode(' ', array_keys($slide['categories'])); ?>">
	        <div class="worksEntryContainer">
	            <div class="worksEntryInfo">
	                <div class="worksEntryInfoTitle">
	                    <a href="<?php
	                    	if(!empty($slide['options']['more']))
								echo $slide['options']['more'];
							else
	                    		echo get_permalink($slide['post']->ID);
                    	?>">
	                        <?php echo get_the_title($slide['post']->ID); ?>
	                    </a>
	                </div>
	                <div  class="worksEntryInfoExcerpt">
	                	<?php echo $slide['options']['small_description']; ?>
	                </div>
	                <div  class="worksEntryInfoExcerptBig">
	                	<?php echo $slide['options']['big_description']; ?>
	                </div>
	                <?php if(!$shortcode['no_more']): ?>
					<div class="worksEntryInfoMore">
						<a href="<?php
							if(!empty($slide['options']['more']))
								echo $slide['options']['more'];
							else
								echo get_permalink($slide['post']->ID);
						?>">
							<?php _e('read more','revoke'); ?>
						</a>
					</div>
					<?php endif; ?>
		        </div>
		        <?php if($slide['options']['video']===''): ?>
		        <a href="<?php
		        	if(!empty($slide['options']['more']))
						echo $slide['options']['more'];
					else
		        		echo get_permalink($slide['post']->ID);
	        	?>"><img class="worksEntryImg" src="<?php echo $slide['options']['small_image']; ?>" alt="" /></a>
	        	<img class="worksEntryImgBig" src="<?php echo $slide['options']['big_image']; ?>" alt="" />
	        	<?php else: ?>
	        	<div class="worksEntryImg">
	        	<?php echo $slide['options']['video']; ?>
	        	</div>
	        	<div class="worksEntryImgBig">
	        	<?php echo $slide['options']['video']; ?>
	        	</div>
	        	<?php endif; ?>
		    </div>
		</div>
		<?php endforeach; ?>
    </div>
</div>