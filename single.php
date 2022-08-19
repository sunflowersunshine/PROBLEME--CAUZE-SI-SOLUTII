<?php get_header(); ?>
  
<div class="container-fluid">
    <div class="row d-flex">
        <?php 
        $post = get_post();
        while ( have_posts() ) : the_post(); ?>
            <div class="text-justify col-xs-12 col-sm-12 col-md-9 mx-auto">
                <div class="post-feature-image mt-100"> <?php the_post_thumbnail('full'); ?> </div>
                <div class="date-category mt-60">
                    <div class="post-date" ><?= get_the_date();  ?></div>
                    <div class="post-category">
                    <?php
                        $tax_name = '';
                        if($post-> post_type == 'post') { 
                            $tax_name = 'category';
                        }
                        elseif ($post-> post_type == 'problema'){
                            $tax_name = 'categorie_problema';
                        }

                        $categories = get_the_terms($post->ID, $tax_name);

                        if(!empty($categories)) {
                            foreach( $categories as $category ) {
                                if(strcmp($category->name,'Uncategorized'))
                                     echo $category->name . ', '; 
                            }
                        } ?>
                    </div>  
                </div>
                
                <?php set_post_views(get_the_ID()); ?>      

                <?php if( is_singular ('problema') ): ?>
                    <?php 
                    $args = array(
                    'post_parent'    => $post->ID,
                    'post_type'      => 'attachment',
                    'numberposts'    => -1, // show all
                    'post_status'    => 'any',
                    'post_mime_type' => 'image',
                    'orderby'        => 'menu_order',
                    'order'           => 'ASC'
                    );

                     $images = get_posts($args);
                    if($images) :?>  
                        <div class="post-images">
                            <?php foreach($images as $image) : ?>
                                <div class="post-images__image">
                                    <img src="<?php echo wp_get_attachment_url($image->ID); ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="mt-60 text-padding-60"><? the_content(); ?></div>
                <div class="mt-60 text-padding-60"><? the_title(); ?></div>
                <?php echo get_the_author_meta(); ?>

                <?php 
                    if(get_post_type() != 'problema') :
                        $tags = get_the_tags($post->ID); 
                        if(!empty($tags)) : ?>
                            <div class="post-tags text-padding-60 mt-40"> Tag:
                                <?php
                                    if(!empty($tags)) {
                                         foreach( $tags as $tag ) {
                                             echo '<div class="post-tag"> '. $tag->name . '  ' .'</div>'; 
                                         }
                                    }?>
                            </div>
                         <?php endif; ?>

                        <?php 
                        global $post;
                        $author_id = $post->post_author;
                        $author_id = get_the_author_meta('ID');

                        $image_size = 60;
                        $author_image = get_avatar( $author_id, $image_size );
                        $author_displayname = get_the_author_meta('display_name');
                        $author_description = get_the_author_meta('description');
                        ?>

                        <div class="author-meta text-padding-60 mt-80">
                            <div class="author-avatar"><p><?php echo $author_image; ?></p></div>
                            <div class="author-name-description"> 
                                <div class="author-name"><p><?php echo $author_displayname; ?></p></div>
                                <div class="author-description mt-15"><p><?php echo $author_description; ?></p></div>
                            </div>
                        </div>
                    <?php endif; ?>
 
                    <?php
                        global $post;
                        $likes = get_post_meta( $post->ID, 'my-post-likes', true );
                        $dislikes = get_post_meta( $post->ID, 'my-post-dislikes', true );
                        $favorite = get_post_meta( $post->ID, 'favorite-post', true );

                        $likes = ($likes == "") ? 0 : $likes;
                        $dislikes = ($dislikes == "") ? 0 : $dislikes;
                        $favorite = ($favorite == "") ? 0 : $favorite;
                        
                        $user = get_current_user_id();
                        $user_meta_likes = get_user_meta($user, 'post='. $post->ID .'likes', true );
                        $user_meta_dislikes = get_user_meta($user, 'post='. $post->ID .'dislikes', true );
                        $user_meta_favorite= get_user_meta($user, 'post='. $post->ID .'favorite', true );

                        // var_dump($user_meta_favorite);
                    
                        
                    ?>
                    <div class="user_actions">
                        <!-- User like/ dislike post -->
                        <div class="like mt-60 text-padding-60">
                            <p>Ti-a plăcut postarea? </p>
                                <a data-target="#myModal" class="user_like <?php echo $user_meta_likes == 1 ? "active" : ""; ?>" data-id="<?php the_ID(); ?>" appreciation="my_user_like" other-appreciation="my_user_dislike">
                                    <i class="fa fa-regular fa-thumbs-up"></i>
                                </a>
                                <span class="counter" id='my_user_like'>(<?php echo $likes; ?>)</span>
                    
                                <a data-target="#myModal" class="user_dislike <?php echo $user_meta_dislikes == 1 ? "active" : ""; ?>" data-id="<?php the_ID(); ?>" appreciation="my_user_dislike" other-appreciation="my_user_like">
                                    <i class="fa fa-regular fa-thumbs-down"></i>
                                </a>
                                <span class="counter" id='my_user_dislike'>(<?php echo $dislikes; ?>)</span>           
                        </div>

                        <!-- User add post to favorite -->
                        <div class="favorite mt-60 text-padding-60">
                                 <p> Vrei să recitești? Adaugă la favorite</p>
                                <div class="favorite_user">
                                    <a data-target="#myModal" class="user_favorite <?php echo $user_meta_favorite == 1 ? "active" : ""; ?>" data-id="<?php the_ID(); ?>">
                                    <i class="fa fa-regular fa-heart"></i>
                                    </a>
                                    <span class="counter_fav">(<?php echo $favorite; ?>)</span>    
                                </div>      
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <!-- <h4 class="modal-title" id="myModalLabel">My Modal</h4> -->
                            </div>
                            <div class="modal-body">
                                <p> Pentru aprecirerea postărilor este necesar să fiți autentificați. Intră acum</p>
                                 <span><a href="">link catre pargina de logare</a></span>
                            </div>
                            <div class="modal-footer">
                            <buttontype="button" class="btn btn-primary" data-dismiss="modal"> Ok </button>
                            </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="pagination-post text-padding-60 mt-80">
                        <div class="link">
                            <div class="before-title"><?php previous_post_link( '%link', 'Postarea anterioară' ); ?></div>
                            <div class=" mt-15 title"><?php previous_post_link( '<strong>%link</strong>' ); ?></div>
                        </div>
                        <div class="link">
                            <div class="before-title"><?php next_post_link( '%link', 'Următoarea postare' ); ?></div>
                            <div class="mt-15 title"><?php next_post_link( '<strong>%link</strong>' ); ?></div>
                        </div>

                    </div> 
            </div>
        <?php endwhile; ?>
    </div>
    <div class="row d-flex">
        <div class="col-xs-12 col-sm-12 col-md-8 mx-auto">
            <?php 
            if ( comments_open() || get_comments_number()) :
                comments_template();
            endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>