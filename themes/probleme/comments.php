<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
* @subpackage Probleme
* @since Probleme 1.0
*/
if ( post_password_required() )
    return; ?>
 
<div class="container-fluid">
    <div id="comments" class="comments-area">
    
        <?php if ( have_comments() ) : ?>
            <h2 class="comments-title">
                <?php
               $number_of_comments = number_format_i18n( get_comments_number()); ?>
                <p class='number-of-comments'><?php printf('%u comentarii', $number_of_comments ); ?></p>
                
            </h2>
             
            <div class="comment-list">
                <?php
                    wp_list_comments( array(
                        'avatar_size' => 60,
                        'type'        => 'comment',
                        'callback'     =>'mytheme_comment',
                    ) );
                ?>
            </div><!-- .comment-list -->

            <?php
                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( 'Comentarii vechi') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Comentarii noi') ); ?></div>
            </nav><!-- .comment-navigation -->
            <?php endif; // Check for comment navigation ?>
    
            <?php if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php _e( 'Nu sunt comentarii!'); ?></p>
            <?php endif; ?>
    
        <?php endif; // have_comments() ?>
        <?php 

        $comment_send = 'Trimite';
        $comment_reply = 'Adaugă un comentariu';
        $comment_reply_to = 'Răspunde';
        $comment_notes_before = 'Adresa ta de email nu va fi publicată.';

        $comment_cookies_1 = ' Accept';
        $comment_cookies_2 = ' Termenii si condițiile.';
        
        $comment_author = 'Numele tău';
        $comment_email = 'Email';
        $comment_url = 'Website';
        $comment_body = 'Scrie comentariul tău';
        
        $comment_cancel = 'Anulează';
        
        //Array
        $comments_args = array(
            'fields' => array(
                //Author field
                'author' => '<input id="author" class="author_name" name="author" aria-required="true" placeholder="' . $comment_author .'"></input>',
                //Email Field
                'email' => '<input id="email"  class="author_email" name="email" placeholder="' . $comment_email .'"></input>',
                //URL Field
                'url' => '<input id="url" name="url"  class="author_url"  placeholder="' . $comment_url .'"></input>',
                //Cookies
                'cookies' => '<input class="author_cookies" type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a>',
            ),
                // Change the title of send button
                'class_submit' => 'tm-submit-comment-btn mt-15 ' ,
                'comment_notes_before' => '<p class="comment_notes_before">'.  $comment_notes_before .'</p>',
                'label_submit' => __( $comment_send ),
                // Change the title of the reply section
                'title_reply' => __( $comment_reply ),
                // Change the title of the reply section
                'title_reply_to' => __( $comment_reply_to ),
                //Cancel Reply Text
                'cancel_reply_link' => __( $comment_cancel ),
                // Redefine your own textarea (the comment body).
                'comment_field' => '<textarea id="comment" class="author_comment" name="comment" placeholder= "'. $comment_body .'" rows="8" aria-required="true"></textarea>',
                //Message Before Comment
        );
        comment_form( $comments_args );
       ?>        
    </div><!-- #comments -->
</div>
