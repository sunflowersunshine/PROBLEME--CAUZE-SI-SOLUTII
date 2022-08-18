<?php 

get_header();

$image = get_field('image');
$quote = get_field('quote');
$quote_author = get_field('quote_author'); ?> 

<div class="container-fluid"> 
    <div class="row tm-row-margin-b tm-content-boxes-row">  
        <?php  if(have_rows('sectiune_informatii')) : ?>
            <?php while(have_rows('sectiune_informatii')) : the_row(); ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="tm-content-box">
                            <?php the_sub_field('iconita'); ?>
                            <h2 class="tm-content-title"><?php the_sub_field('titlu'); ?></h2>
                            <p><?php the_sub_field('descriere'); ?></p>
                        </div>
                    </div>
            <?php endwhile; ?>
        <?php endif;?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="tm-testi">
                <?php if($image): ?>
                    <img src="<?php echo $image; ?>" alt="Image" class="img-fluid img-circle tm-testi-img">
                <?php endif; ?>
                <div class="tm-testi-text-box">
                    <?php if($quote) : ?>
                        <p class="tm-testi-text"><?php echo $quote; ?></p>  
                    <?php endif; ?>                             
                </div>
                <?php if($quote) : ?>
                    <p class="tm-testi-sig"><?php echo $quote_author; ?></p>  
                <?php endif; ?> 
            </div>
        </div>
    </div> <!-- row -->
</div>
<?php get_footer(); ?>

