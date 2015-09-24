<?php
$revoke_footer_company = _go('footer_company');
if(empty($revoke_footer_company)){
    $revoke_footer_company = 'teslathemes';
    $revoke_footer_url = 'http://teslathemes.com/';
}else
    $revoke_footer_url = _go('footer_url');
?>
            </div>
        </div><!-- CONTENTS END -->
        
        <?php if (is_active_sidebar('footer-sidebar')): ?>
        
        <div class="footerbg"><!-- FOOTER START -->
            <div class="wrapper">
                <div class="footer textcolor5">
                    <?php dynamic_sidebar('footer-sidebar'); ?>
                </div>
            </div>
        </div><!-- FOOTER END -->
        
        <?php endif; ?>
        
        <div class="lowerfooterbg">
            <div class="wrapper">
                <div class="lowerfooter">
                    <div class="copyright textcolor10">
                        &copy; <?php _e('copyright','revoke'); ?> <?php echo date("Y"); ?> <?php _e('','revoke'); ?> <span class="textcolor">
                        <?php if(!empty($revoke_footer_url)): ?>
                        <a href="<?php echo $revoke_footer_url; ?>" target="_blank">
                            <?php echo $revoke_footer_company; ?>
                        </a>
                        <?php else: ?>
                        <?php echo $revoke_footer_company; ?>
                        <?php endif; ?>
                    </span>
                    </div>
                   <!-- <div class="signature textcolor10">
                        <span class="textcolor9"><?php echo get_bloginfo('name'); ?></span> <?php _e('by','revoke'); ?> <span class="textcolor">
                        <?php if(!empty($revoke_footer_url)): ?>
                        <a href="<?php echo $revoke_footer_url; ?>" target="_blank">
                            <?php echo $revoke_footer_company; ?>
                        </a>
                        <?php else: ?>
                        <?php echo $revoke_footer_company; ?>
                        <?php endif; ?>
                    </span>
                    </div>-->
                </div>
            </div>
        </div>

        <?php wp_footer(); ?>
        
    </body>
</html>
