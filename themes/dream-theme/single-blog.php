<?php
/**
 * Применение (single-blog.php)
 * Template Name: Новость
 * Template Post Type: post
 * @package WordPress
 */
get_header();

?>

    <div class="header_page" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page_title-pos">
                        <div class="page_title"><span class="line"><span><?php the_title();?></span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section_g">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php the_content();?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer(); // подключаем подвал
?>