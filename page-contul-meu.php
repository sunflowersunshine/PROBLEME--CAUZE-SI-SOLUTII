<?php 
/**
* Template Name: Contul meu
* @package WordPress
* @subpackage Probleme
* @since Probleme 1.0
*/
get_header(); ?>

<?php if(is_user_logged_in( )) : ?>

<div class="container-fluid my_account">
    <div class="row tm-tabs-container">
        <div class="tm-tab-links-col">
            <nav>
                <ul class="tm-tabs">
                    <li class="tm-tab-link-item">
                        <a id="tab1" href="javascript:void(0)" class="tm-tab-link active">
                            <i class="fa fa-solid fa-folder tm-tab-icon"></i>
                            <div class="tm-tab-link-label">Postări</div>
                        </a>
                    </li>

                    <li class="tm-tab-link-item">
                        <a id="tab2" href="javascript:void(0)" class="tm-tab-link">
                            <i class="fa fa-solid fa-user tm-tab-icon"></i>
                            <span class="tm-tab-link-label">Date personale</span>
                        </a>
                    </li>
                 
                    <li class="tm-tab-link-item">
                        <a id="tab3" href="javascript:void(0)" class="tm-tab-link">
                        <i class="fa fa-trash tm-tab-icon"></i>
                            <span class="tm-tab-link-label">Ștergere cont</span>
                        </a>
                    </li>

                    <li class="tm-tab-link-item">
                        <a id="tab4" href="javascript:void(0)" class="tm-tab-link">
                        <i class="fa fa-sign-out tm-tab-icon"></i>
                            <span class="tm-tab-link-label">Ieșire din cont</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="tm-tab-content-box-col">
            <div id="tab1C" class="tm-tab-content-box">
                <div class="tm-tab-content-text">
                <?php 
                   $args = array(  
                    'post_type' => 'problema',
                    'author' => get_current_user_id(),
                    'post_status' => 'publish',
                    'orderby' => 'title', 
                    'order' => 'ASC', 
                    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
                );

                $posts = new WP_Query($args);
                if( $posts->have_posts()) : ?>
                <table id="user_posts">
                    <tr>
                        <th>Titlu</th>
                        <th>Număr vizualizări</th>
                        <th>Like-uri</th>
                        <th>Dislike-uri</th>
                        <th>Favorite</th>
                        <th></th>
                        <th></th>
                    </tr>
                   <?php while ( $posts->have_posts()) :  $posts->the_post(); ?>
                     <tr>
                        <?php $post_id = get_the_ID(); ?>
                        <td><?php the_title(); ?></td>
                        <td><?= get_post_views($post_id); ?></td>
                        <td><?= get_post_meta( $post_id, 'my-post-likes', true ); ?></td>
                        <td><?= get_post_meta( $post_id, 'my-post-dislikes', true ); ?></td>
                        <td><?= get_post_meta( $post_id, 'favorite-post', true ); ?></td>
                        <td class="view_post"><a href="<?= the_permalink();?>">Vizualizare <br> postare</a></td>
                        <td class="delete_post"> 
                            <div class="col-sm-12 box-delete btn btn-danger" style="margin-top: 20px;">
                                <a class="option" onclick="return confirm('Ești sigur că vrei să ștergi <?php the_title();?>')" href="<?= get_delete_post_link( $post_id, '', true ); ?>">
                                    <i class="fa fa-trash"></i>
                                    <span class="option-text">Ștergere postare</span>
                                </a>
                            </div>
                        </td>
                     </tr>
                    <?php endwhile; ?>
                </table>
                <?php endif; ?>
                </div>                        
            </div>

            <div id="tab2C" class="tm-tab-content-box">
                <div class="tm-tab-content-text">
                    <p>Nam tortor lacus, fringilla nex quam a, volupat laoreet dui. Nunc consequat nulla vel ipsum cursus, eu tempor mauris gravida. Donec sit amet.                         
                    </p>
                    <ul class="tm-ul-plus">
                        <li>Vestibulum ullamcorper et lectus</li>
                        <li>Donec efficitur placer magna</li>
                        <li>Praesent venenatis diam pellentesque</li>
                        <li>Nunc consequat nulla vel ipsum</li>
                    </ul>
                </div>                        
            </div>

            <div id="tab3C" class="tm-tab-content-box">
                <div class="tm-tab-content-text">
                    <div class="alert alert-warning" role="alert">
                        <p>Ștergerea contului va avea ca efect ștergerea tuturor postarilor și datelor după trimiterea unei copii ale acestora către dumneavoastră, fără posibilitate de a fi restabilite! Sunteți sigur că doriți să ștergeți contul dumneavoastră?
                        </p>
                    </div>
                    <form method="POST" action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>">
                    <input type="hidden" name="action" value="delete_user" />
                    <?php wp_nonce_field('userDelete', 'nonce'); ?>
                         <button type="submit" name="delete_account_button" id="delete_account_button" class="btn btn-danger">DA, sunt de acord cu ștergerea contului (acțiunea este ireversibilă)</button>
                    </form>
                </div>                        
            </div>
            <div id="tab4C" class="tm-tab-content-box">
                <div class="tm-tab-content-text">
                    <p> Dorești să te te dezautentifici?                       
                    </p>
                     <a class="btn btn-danger" href="<?php echo wp_logout_url( home_url() ); ?>">Ieșire din cont</a>          	
                </div>                        
            </div>
        </div>
    </div>
</div> 
<?php else : ?>
   <?php wp_redirect(get_permalink( get_page_by_title( '404' ) )); ?>
<?php endif; ?>
 
<?php get_footer(); ?>