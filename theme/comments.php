<?php if (post_password_required()) return; ?>

<div class="postComments">

    <?php if (have_comments()) : ?>

        <?php wp_list_comments(array('callback' => 'revoke_comment', 'end-callback' => 'revoke_comment_end', 'style' => 'div')); ?>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e('Коментари', 'revoke'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; стари коментари', 'revoke')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('нови коментари &rarr;', 'revoke')); ?></div>
            </nav>
        <?php endif; ?>

        <?php
        if (!comments_open() && get_comments_number()) :
            ?>
            <p class="nocomments"><?php _e('Затворено за коментари.', 'revoke'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

</div>

<?php
$user = wp_get_current_user();
$user_identity = $user->exists() ? $user->display_name : '';
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
comment_form(array(
    'fields' => array(
		'author' => '<input placeholder="Име'.($req?' *':'').'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
		'email'  => '<input placeholder="E-mail'.($req?' *':'').'" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'
	),
    'comment_field'        => '<div class="commentWrapper"><div class="commentContainer"><textarea placeholder="'.__('Напишете съобщението си тук','revoke').'" id="comment" name="comment" cols="" rows="" aria-required="true"></textarea></div></div></fieldset>',
    'must_log_in'          => '<p class="must-log-in">' . sprintf( __( '<a href="%s">Влез</a>, за да коментираш.','revoke' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
    'logged_in_as'         => '<fieldset>',
    'comment_notes_before' => '<fieldset>',
    'comment_notes_after'  => '',
    'id_form'              => 'postForm',
    'id_submit'            => 'submit',
    'title_reply'          => __( 'Остави коментар','revoke' ),
    'title_reply_to'       => __( 'Отговори','revoke' ).' "%s" /',
    'cancel_reply_link'    => __( 'Отказване на отговора','revoke' ),
    'label_submit'         => __( 'Изпрати','revoke' ),
));
?>
