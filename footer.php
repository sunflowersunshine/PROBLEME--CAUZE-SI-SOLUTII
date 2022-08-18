<div class="container-fluid">
    <div class="row tm-nav-2-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <nav class="tm-flex-center">
                    <ul class="tm-nav-2">
                    <?php wp_nav_menu( 
                            [ 
                                'container' => false, 
                                'items_wrap' => '%3$s',
                                'theme_location' => 'footer-menu',
                                'add_li_class' => 'tm-nav-item-2',
                                'link_class' => 'tm-nav-link-2',
                            ])
                    ?>  
                    </ul>
                </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="tm-social-icons-container text-xs-center">
            <?php  if(have_rows('social_media', 'options')) : ?>
                <?php  while(have_rows('social_media', 'options')) :the_row();?>
                
                <a href="#" class="tm-social-link"><i class="<?php the_sub_field('iconita', 'options'); ?>"></i></a>
            
                <?php endwhile; ?>
                <?php  endif;?>
            </div>
        </div>
    </div>

    <?php //if(!is_user_logged_in() && !is_page('autentificare') && is_page('inregistrare')) : ?>
        <div class="buttons-account">
            Conectează-te
            <a href="<?= get_permalink( get_page_by_title( 'autentificare' ) ); ?>" class="button-account button-account__blue">Autentificare</a>
            <a href="<?= get_permalink( get_page_by_title( 'inregistrare' ) ); ?>" class="button-account button-account__green">Creează cont</a>
        </div>
    <?php //endif; ?>
    
    <footer class="row tm-footer">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <p class="text-xs-center tm-copyright">Copyright &copy; <?php the_field('numele_companiei', 'options'); ?>
            
            | Design: <a href="http://www.google.com/+templatemo" target="_parent">Templatemo</a></p>
        </div> 
    </footer>
</div>

        <?php wp_footer(); ?>
</body>
</html>     