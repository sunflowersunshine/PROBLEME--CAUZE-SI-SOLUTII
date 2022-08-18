<?php
/**
* Template Name: 404

* @package WordPress
* @subpackage Probleme
* @since Probleme 1.0
*/

get_header(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="primary" class="content-area">
                <div id="content" class="site-content-404" role="main">

                    <header class="page-header">
                        <h1 class="page-title"><?php _e( 'Pagina nu a fost găsită!', 'twentythirteen' ); ?></h1>
                    </header>

                    <div class="page-wrapper">
                        <div class="page-content">
                            <p><?php _e( 'Pagina aceasta nu există! Îmi pare rău! ' ); ?> <i class="fa fa-solid fa-face-frown"></i> </p>

                        </div><!-- .page-content -->
                    </div><!-- .page-wrapper -->

                </div><!-- #content -->
            </div><!-- #primary -->
        </div>
    </div>
</div>

<?php get_footer(); ?>