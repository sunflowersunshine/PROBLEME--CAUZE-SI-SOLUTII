
<?php 

/**
* Template Name: Blog
*
* @package WordPress
* @subpackage Probleme
* @since Probleme 1.0
*/
get_header(); ?>

<?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page'  => '4',
        'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
    );

    $posts = new WP_Query($args);
    $temp_query = $wp_query;
    $wp_query   = NULL;
    $wp_query   = $posts;
?>
<div class="container-fluid">
    <div class="row mt-100">
        <div class = "col-lg-9" >
            <div class="row">
                <?php if( $posts->have_posts()) : ?>
                    <?php while ( $posts->have_posts()) :  $posts->the_post(); ?>
                        <div class=" col-lg-6 tm-blog-post-margin-b tm-blog-post-box-container">
                            <div class="tm-blog-post-box">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid tm-header-img')); ?>
                                <div class="tm-blog-post-text-box-outer">
                                    <div class="tm-blog-post-text-box">
                                        <h2 class="tm-blog-post-title"><?php the_title(); ?></h2>
                                        <p class="tm-blog-post-description"><?php  the_excerpt(); ?></p>
                                    </div>

                                    <a href="<?php the_permalink();?>" class="tm-blog-post-link">Read More...</a>
                                    
                                </div>                                                
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="pagination">
                    <p class="alignleft"><?php previous_posts_link( '<img class = "chevrons" src="/wp-content/themes/probleme/img/chevrons-left-solid.svg" />  Postări recente'); ?></p>
                    <p class="alignright"><?php next_posts_link( 'Postări vechi <img class = "chevrons" src="/wp-content/themes/probleme/img/angles-right-solid.svg" />'); ?></p>
                </div>
            </div>
            <?php
            $wp_query = NULL;
            $wp_query = $temp_query;
            ?>
        </div>
        <div class="col-xs-3">
            <?php get_sidebar(); ?>
        </div>
    </div>         
</div>

<?php get_footer(); ?>
