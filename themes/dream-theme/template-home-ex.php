<?php
/**
 * Template Name: Главная
 */
$sold_1week_posts_ids = get_posts(array(
//    'category' => $category->term_id,
    'post_type' => 'post',
    'meta_query' => [ [
        'key' => '_sold_status',
        'value' => '1',
    ] ],
    'date_query' => [
        [
            'column' => 'post_modified_gmt',
            'before'  => '1 week ago',
        ],
    ],
    'fields' => 'ids',
    'numberposts' => -1,
));
get_header();
?>

    <!-- /.hidden-all-posts -->

    <main>
<?php
//ф-ция сортировки
function cmp_function($a, $b){
    return ($a['num_slide'] > $b['num_slide']);
}
//данные слайдера
$slider_items_show = [];
$slider_items = carbon_get_post_meta($post->ID, 'c_slider');
foreach ($slider_items as $slider_item) {
    if($slider_item['show_slide']) {
        $slider_items_show[] = $slider_item;
    }
}
uasort($slider_items_show, 'cmp_function');

if (!empty($slider_items_show) && 0 < count($slider_items_show) ) { ?>

    <section class="section__banner-slider">
        <div class="banner__slider-container">
            <div class="banner__slider swiper-container">
                <div class="banner__slider__wrapper swiper-wrapper">
                    <?php foreach ($slider_items_show as $item) { ?>
                        <?php
                        $sl_img = $item['slider_img']; ;
                        if(wp_is_mobile() && isset($item['slider_img_m']) && !empty($item['slider_img_m'])) {
                            $sl_img = $item['slider_img_m']; ;
                        }
                        ?>
                        <div class="banner__slider__slide swiper-slide" style="background-image: url(<?php echo $sl_img; ?>)" >
                            <div class="banner__slider-text text-block">
                                <h2 class="title">
                                    <?php echo $item['slide_title']; ?>
                                </h2>
                            </div>
                            <?php if(isset($item['link_slide']) && !empty($item['link_slide'])) { ?>
                                <div class="btn__wrap">
                                    <a href="<?php echo esc_url($item['link_slide']); ?>" class="more__btn"><?php echo pll__('Детальніше') ?></a>
                                </div>
                            <?php  } ?>
                        </div>
                    <?php  } ?>
                </div>

            </div>
            <!-- If we need navigation buttons -->
            <div class="main-slider__btn-container">
                <div class="banner__slider__button-prev" ></div>
                <div class="banner__slider__button-next" ></div>
            </div>

        </div>

    </section>
<?php } ?>
    <section class="section-main-slider">
        <div class="container">
            <?php
            $posts = get_posts(array(
                //'category' => 29,
                'numberposts' => -1,
                'sort_order' => 'rand',
                'meta_query' => array(
                    array(
                        'key' => 'discount',
                        'value' => '1',
                        'compare' => '=',
                    ),
                ),
                'post__not_in' => $sold_1week_posts_ids,
            ));
            if ($posts) : ?>
                <h4 class="catalog-title discount-title">
                    <?php echo pll__('Акційні пропозиції'); ?>
                </h4>
                <div class="home-swiper-container">
                    <!-- additional required wrapper -->
                    <div class="swiper-wrapper home-swiper-wrapper">

                        <!-- slides -->
                        <!-------------------------- SLIDE ---------------------------->
                        <?php
                        foreach ($posts as $value) {

                            $sing_product_img = carbon_get_post_meta($value->ID, 'sing_product_img');
                            ?>
                            <div class="main-slider__slide swiper-slide <?php echo carbon_get_post_meta($value->ID, 'booking_status') === 1 || carbon_get_post_meta($value->ID, 'sold_status') === 1 ? 'booked-box' : '' ?> <?php echo carbon_get_post_meta($value->ID, 'sold_status') === 1 ? 'sold' : '' ?>">
                                <div class="top-part <?php echo carbon_get_post_meta($value->ID, 'booking_status') === 1 ? 'booked' : '' ?>
                                <?php echo carbon_get_post_meta($value->ID, 'sold_status') === 1 ? 'sold' : '' ?>">
                                    <a href="<?php echo get_post_permalink($value->ID); ?>">
                                        <div class="image" style="background-image: url(<?php echo $sing_product_img[0]['img']; ?>)"></div>
                                    </a>
                                    <div class="title">
                                        <a href="<?php echo get_post_permalink($value->ID); ?>">
                                            <?php echo $value->post_title; ?>
                                        </a>
                                    </div>
                                    <div class="price-container">
                                        <div class="price">
                                            <?php $group_price = get_current_price($value->ID);
                                            if (carbon_get_post_meta($value->ID, 'sing_product_price')) {
                                                if(carbon_get_post_meta($value->ID, 'discount_value')) {
                                                    echo '<span class="old-price">' . number_format(carbon_get_post_meta($value->ID, 'sing_product_price'), 0, ',', ' ') . '$</span>';
                                                    echo '<span class="new-price">' . number_format(carbon_get_post_meta($value->ID, 'discount_value'), 0, ',', ' ') . '$</span>';
                                                } else {
                                                    echo number_format(carbon_get_post_meta($value->ID, 'sing_product_price'), 0, ',', ' ') . '$';
                                                }
                                            } else { ?>
                                                <div class="no-price">
                                                    <?php
                                                    echo pll__('Ціна не вказана'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="availability">
                                            <?php if(carbon_get_post_meta($value->ID, 'booking_status') !== 1) : ?>
                                                <div class="availability-text">
                                                    <?php
                                                    $cat_name = get_the_category($value->ID);
                                                    echo $cat_name[0]->name;
                                                    ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php /* if (carbon_get_post_meta($value->ID, 'sing_product_availability')) { ?>
                                            <div class="availability-text">
                                                <?php echo pll__('В наявності'); ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="availability-text no">
                                                <?php echo pll__('Немає в наявності'); ?>
                                            </div>
                                        <?php } */ ?>
                                        </div>
                                    </div>
                                </div>
                                <!--                            <div class="center-part">-->
                                <!--                                <div class="product-info-table">-->
                                <!--                                    <div class="table-line">-->
                                <!--                                        <div class="line__title">-->
                                <!--                                            --><?php //echo pll__('Рік випуску:'); ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="line__description">-->
                                <!--                                            --><?php //echo carbon_get_post_meta($value->ID, 'sing_product_year'); ?>
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="table-line">-->
                                <!--                                        <div class="line__title">-->
                                <!--                                            --><?php //echo pll__('Стан:'); ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="line__description">-->
                                <!--                                            --><?php //echo carbon_get_post_meta($value->ID, 'sing_product_condition'); ?>
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="table-line">-->
                                <!--                                        <div class="line__title">-->
                                <!--                                            --><?php //echo pll__('Пробіг, км:'); ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="line__description">-->
                                <!--                                            --><?php //echo carbon_get_post_meta($value->ID, 'sing_product_mileage'); ?>
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="table-line">-->
                                <!--                                        <div class="line__title">-->
                                <!--                                            --><?php //echo pll__('Запас ходу, км:'); ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="line__description">-->
                                <!--                                            --><?php //echo carbon_get_post_meta($value->ID, 'sing_product_power_reserve'); ?>
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="table-line">-->
                                <!--                                        <div class="line__title">-->
                                <!--                                            --><?php //echo pll__('Тип приводу:'); ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="line__description">-->
                                <!--                                            --><?php //echo carbon_get_post_meta($value->ID, 'sing_product_type_of_drive'); ?>
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="table-line">-->
                                <!--                                        <div class="line__title">-->
                                <!--                                            --><?php //echo pll__('Потужність, к.с.:'); ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="line__description">-->
                                <!--                                            --><?php //echo carbon_get_post_meta($value->ID, 'sing_product_power'); ?>
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                                <?php $vin_code_array = get_the_tags($value->ID);
                                $vin_code = $vin_code_array[0]->name; ?>
                                <div class="bottom-part <?php echo carbon_get_post_meta($value->ID, 'booking_status') === 1 ? 'booked' : '' ?>
<?php echo carbon_get_post_meta($value->ID, 'sold_status') === 1 ? 'sold' : '' ?>">
                                    <div class="main-button">
                                        <a <?php echo carbon_get_post_meta($value->ID,'booking_status') !== 1 ? 'data-toggle="modal" data-target="#buy-modal"' : ''; ?>
                                            class="buy-modal-btn <?php echo carbon_get_post_meta($value->ID,'booking_status') === 1 ? 'booked' : ''; ?>
<?php echo carbon_get_post_meta($value->ID, 'sold_status') === 1 ? 'sold' : '' ?>"
                                            <?php echo carbon_get_post_meta($value->ID,'booking_status') === 1 ? 'disabled' : ''; ?>
                                            <?php echo carbon_get_post_meta($value->ID,'booking_status') === 1 ? '' : 'href="#"'; ?>
                                            data-title="<?php echo $value->post_title; ?>"
                                            <?php if($vin_code) { ?>
                                                data-vin="<?php echo $vin_code; ?>"
                                            <?php } ?>
                                            <?php if(carbon_get_post_meta($value->ID,'sing_product_equipment')) { ?>
                                                data-equipment="<?php echo carbon_get_post_meta($value->ID,'sing_product_equipment'); ?>"
                                            <?php } ?>
                                        >

                                            <?php echo carbon_get_post_meta($value->ID, 'product_type') === 2 ? pll__('Придбати') : pll__('Придбати авто'); ?></a>
                                    </div>
                                    <div class="button-see-more">
                                        <a href="<?php echo get_post_permalink($value->ID); ?>"><?php echo pll__('Детальніше про авто'); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!------------------------------------------------------------->
                    </div>
                    <!-- navigation buttons -->
                    <div class="main-slider__btn-container">
                        <div class="main-slider__button-prev"></div>
                        <div class="main-slider__button-next"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="choose">
        <div class="container">
            <div class="choose-content">

                <?php
                $categories = get_categories(array(
                    'hide_empty' => 0, // exclude empty categories
                ));
                ?>
                <a href="<?php echo get_category_link($categories[2]->term_id); ?>" class="choose-item">
                    <span><?php echo pll__($categories[2]->name); ?></span>
                </a>
                <a href="<?php echo get_category_link($categories[1]->term_id); ?>" class="choose-item">
                    <span><?php echo pll__($categories[1]->name); ?></span>
                </a>
                <a href="<?php echo pll__(get_home_url().'/forma-pid-zamovlennya/'); ?>" class="choose-item">
                    <span><?php echo pll__("Під замовлення"); ?></span>
                </a>
                <a href="<?php echo get_category_link($categories[0]->term_id); ?>" class="choose-item">
                    <span><?php echo pll__($categories[0]->name); ?></span>
                </a>
                <a href="<?php echo pll__( get_home_url().'/category/all/'); ?>" class="choose-item">
                    <span><?php echo pll__('Каталог авто'); ?></span>
                </a>
                <?php
                $all_posts = get_posts(array(
                    'numberposts' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'brand',
                            'compare' => 'EXISTS',
                        ),
                    ),
                    'post__not_in' => $sold_1week_posts_ids,
                    'fields' => 'ids',
                ));

                $brand_ids = array();
                foreach ($all_posts as $post_id) {
                    $brand_id = carbon_get_post_meta($post_id, 'brand');
                    if (!empty($brand_id)) {
                        $brand_ids[] = $brand_id;
                    }
                }
                $brands = carbon_get_theme_option("brand");
                foreach ($brands as $brand) :
                    if (in_array($brand['alias'], $brand_ids) && $brand['alias'] > 2) :?>
                        <a href="<?php echo pll__(get_home_url().'/category/all/');?>?brand=<?php echo $brand['alias'] ?>" class="choose-item">
                            <img src="<?php echo $brand['brand_logo'] ?>" alt="">
                        </a>
                    <?php endif; endforeach; ?>


            </div>
            <!-- /.choose-content -->
        </div>
        <!-- /.container -->
    </section>




    <section id="about" class="section-about"
             style="background-image: url(<?php echo carbon_get_the_post_meta('about_bg_img'); ?>)">
        <div class="container">
            <div class="about-content">
                <div class="image">
                    <img src="<?php echo carbon_get_the_post_meta('about_img'); ?>" alt="About us image">
                </div>
                <div class="text-part">
                    <!--                    <h2 class="title">-->
                    <!--                        --><?php //echo carbon_get_the_post_meta('about_title'); ?>
                    <!--                    </h2>-->
                    <div class="description">
                        <?php echo carbon_get_the_post_meta('about_desc'); ?>
                    </div>
                    <!--                    <div class="main-button_icon arrows-up">-->
                    <!--                        <a href="/about-us">-->
                    <?php //echo carbon_get_the_post_meta('about_button'); ?><!--</a>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </section>

<?php
get_footer(); // подключаем подвал
?>