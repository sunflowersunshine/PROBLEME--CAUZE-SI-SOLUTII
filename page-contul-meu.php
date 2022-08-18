<?php 
/**
* Template Name: Contul meu
* @package WordPress
* @subpackage Probleme
* @since Probleme 1.0
*/
get_header(); ?>

<?php if(is_user_logged_in( )) : ?>

<div class="container-fluid">
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
                            <span class="tm-tab-link-label">Dezautentificare</span>
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
                <table>
                   <?php while ( $posts->have_posts()) :  $posts->the_post(); ?>
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
                    <p><em>Nunc finibus vehicula pharetra. Fusce sed ante a odio fringilla bibendum. Donec et pharetra orci. Praesent tempus efficitur tellus.</em>                        
                    </p>
                    <ul class="tm-ul-plus">
                        <li>Vestibulum ullamcorper et lectus</li>
                        <li>Donec efficitur placer magna</li>
                        <li>Praesent venenatis diam pellentesque</li>
                        <li>Nunc consequat nulla vel ipsum</li>
                    </ul>
                </div>                        
            </div>

            <div id="tab4C" class="tm-tab-content-box">
                <div class="tm-tab-content-text">
                    <p>Donec a suscipit turpis. Duis hendrerit risus arcu, et eleifend ipsum vaius vel. Nam tortor lacus, fringilla nec quam a, volupat laoreet dui.                       
                    </p>
                    <ul class="tm-ul-plus">
                        <li>Vestibulum ullamcorper et lectus</li>
                        <li>Donec efficitur placer magna</li>
                        <li>Praesent venenatis diam pellentesque</li>
                        <li>Nunc consequat nulla vel ipsum</li>
                    </ul>
                </div>                        
            </div>
        </div>
    </div>
</div> 
<?php else : ?>
   <?php wp_redirect(get_permalink( get_page_by_title( '404' ) )); ?>
<?php endif; ?>
 
<?php get_footer(); ?>