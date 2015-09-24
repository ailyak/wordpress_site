<?php $slide = $slides[0]; ?>
<div class="project">
	<div class="pageSlider" data-speed="<?php echo $slide['options']['slider_speed'].'000'; ?>" data-pause="<?php echo $slide['options']['slider_resume'].'000'; ?>">
        <div class="pageSliderItems">
            <ul>
        		<?php foreach($slide['options']['slider'] as $item): ?>
                    <?php if(isset($item['image'])): ?>
                    <li><img src="<?php echo $item['image']; ?>" alt="" /></li>
                    <?php endif; ?>
                    <?php if(isset($item['video'])): ?>
                    <li><?php echo $item['video']; ?></li>
                    <?php endif; ?>
				<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="projectInfo">
        <?php foreach($slide['options']['info'] as $info): ?>
        <div class="projectInfoTitle font1">
            <?php echo $info['title']; ?>
        </div>
        <?php if(isset($info['content']['text'])): ?>
        <div class="projectInfoDescription">
            <?php echo $info['content']['text']; ?>
        </div>
        <?php endif; ?>
        <?php if(isset($info['content']['fields'])): ?>
        <div class="projectInfoDetails">
            <?php foreach($info['content']['fields'] as $field): ?>
            <div class="projectInfoDetailsEntry">
                <div class="projectInfoDetailsEntryTitle">
                    <?php echo $field['name']; ?>
                </div>
                <div class="projectInfoDetailsEntryBody">
                    <?php echo $field['value']; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php if(!empty($slide['related'])): ?>
    <div class="projectRelated">
        <div class="titleContainer font1">
            <div class="title">
                <?php _e('related projects','revoke'); ?>
            </div>
            <div class="clientsNav">
                <div class="clientsNavPrev"></div>
                <div class="clientsNavNext"></div>
            </div>
        </div>
        <ul>
    		<?php foreach($slide['related'] as $related): ?>
        	<li>
		        <a href="<?php
                            if(!empty($related['options']['more']))
                                echo $related['options']['more'];
                            else
                                echo get_permalink($related['post']->ID);
                        ?>">
		            <img src="<?php echo $related['options']['related_image']; ?>" alt="" />
		        </a>
		        <div class="title">
		            <a href="<?php
                                if(!empty($related['options']['more']))
                                    echo $related['options']['more'];
                                else
                                    echo get_permalink($related['post']->ID);
                            ?>">
		                <?php echo get_the_title($related['post']->ID); ?>
		            </a>
		        </div>
		        <div class="description">
		            <?php echo $related['options']['related_description']; ?>
		        </div>
		    </li>
			<?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
</div>