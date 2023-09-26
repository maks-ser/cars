<?php
/**
 * Template Name: Главная
 */
get_header();
?>

    <main>
    <section class="section-banner"
             style="background-image: url(<?php echo carbon_get_the_post_meta('main_bg_img'); ?>)">
        <div class="container">
            <div class="banner-content">
                <div class="text-block">
                    <h1 class="title">
                        <?php echo carbon_get_the_post_meta('main_title'); ?>
                    </h1>
                    <h1 class="title mobile">
                        <?php echo carbon_get_the_post_meta('main_title_mobile'); ?>
                    </h1>
                    <div class="main-button_icon cursor">
                        <a href="#"><?php echo carbon_get_the_post_meta('main_button'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-slider">
        <div class="container">
            <div class="main-slider-content">
                <div class="main-slider-container">
                    <div class="swiper main-slider swiper-container">
                        <div class="main-slider__wrapper swiper-wrapper">
                            <!-------------------------- SLIDE ---------------------------->
                            <?php
                            $posts = get_posts(array(
                                'category' => 29,
                                'numberposts' => -1,
                            ));
                            //var_dump($posts);
                            foreach ($posts as $value) {
                                $sing_product_img = carbon_get_post_meta($value->ID,'sing_product_img');
                                ?>
                                <div class="main-slider__slide swiper-slide">
                                    <div class="top-part">
                                        <div class="image" style="background-image: url(<?php echo $sing_product_img[0]['img']; ?>)"></div>
                                        <div class="title">
                                            <a href="<?php echo get_post_permalink($value->ID); ?>">
                                                <?php echo $value->post_title; ?>
                                            </a>
                                        </div>
                                        <div class="price-container">
                                            <div class="price">
                                                <?php echo carbon_get_post_meta($value->ID,'sing_product_price'); ?>
                                            </div>
                                            <div class="availability">
                                                <?php if (carbon_get_post_meta($value->ID,'sing_product_availability')) { ?>
                                                    <div class="availability-text">
                                                        <?php echo pll__('В наявності'); ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="availability-text no">
                                                        <?php echo pll__('Немає в наявності'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="center-part">
                                        <div class="product-info-table">
                                            <div class="table-line">
                                                <div class="line__title">
                                                    <?php echo pll__('Рік випуску:'); ?>
                                                </div>
                                                <div class="line__description">
                                                    <?php echo carbon_get_post_meta($value->ID,'sing_product_year'); ?>
                                                </div>
                                            </div>
                                            <div class="table-line">
                                                <div class="line__title">
                                                    <?php echo pll__('Стан:'); ?>
                                                </div>
                                                <div class="line__description">
                                                    <?php echo carbon_get_post_meta($value->ID,'sing_product_condition'); ?>
                                                </div>
                                            </div>
                                            <div class="table-line">
                                                <div class="line__title">
                                                    <?php echo pll__('Пробіг, км:'); ?>
                                                </div>
                                                <div class="line__description">
                                                    <?php echo carbon_get_post_meta($value->ID,'sing_product_mileage'); ?>
                                                </div>
                                            </div>
                                            <div class="table-line">
                                                <div class="line__title">
                                                    <?php echo pll__('Запас ходу, км:'); ?>
                                                </div>
                                                <div class="line__description">
                                                    <?php echo carbon_get_post_meta($value->ID,'sing_product_power_reserve'); ?>
                                                </div>
                                            </div>
                                            <div class="table-line">
                                                <div class="line__title">
                                                    <?php echo pll__('Тип приводу:'); ?>
                                                </div>
                                                <div class="line__description">
                                                    <?php echo carbon_get_post_meta($value->ID,'sing_product_type_of_drive'); ?>
                                                </div>
                                            </div>
                                            <div class="table-line">
                                                <div class="line__title">
                                                    <?php echo pll__('Потужність, к.с.:'); ?>
                                                </div>
                                                <div class="line__description">
                                                    <?php echo carbon_get_post_meta($value->ID,'sing_product_power'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-part">
                                        <div class="main-button">
                                            <a href="#"><?php echo pll__('Замовити консультацію'); ?></a>
                                        </div>
                                        <div class="button-see-more">
                                            <a href="#"><?php echo pll__('Детальніше про авто'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!------------------------------------------------------------->



                            <!--                            --><?php
                            //                            $main_slider = carbon_get_the_post_meta('main_slider');
                            //                            foreach ($main_slider as $main_s) {
                            //                                ?>
                            <!--                                <div class="banner-slider__slide swiper-slide">-->
                            <!--                                    <div class="text-part">-->
                            <!--                                        <h1 class="title">-->
                            <!--                                            --><?php //echo $main_s['title']; ?>
                            <!--                                        </h1>-->
                            <!--                                        <div class="subtitle">-->
                            <!--                                            --><?php //echo $main_s['sub']; ?>
                            <!--                                        </div>-->
                            <!--                                        <div class="main-button">-->
                            <!--                                            <a href="#">--><?php //echo $main_s['button']; ?><!--</a>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="image">-->
                            <!--                                        <img src="--><?php //echo $main_s['img']; ?><!--" alt="Image">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            --><?php //} ?>
                        </div>
                    </div>
                    <div class="main-slider__btn-container">
                        <div class="main-slider__button-prev" style="z-index: 999999;"></div>
                        <div class="main-slider__button-next" Zstyle="z-index: 999999;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-about"
             style="background-image: url(<?php echo carbon_get_the_post_meta('about_bg_img'); ?>)">
        <div class="container">
            <div class="about-content">
                <div class="image">
                    <img src="<?php echo carbon_get_the_post_meta('about_img'); ?>" alt="About us image">
                </div>
                <div class="text-part">
                    <h2 class="title">
                        <?php echo carbon_get_the_post_meta('about_title'); ?>
                    </h2>
                    <div class="description">
                        <?php echo carbon_get_the_post_meta('about_desc'); ?>
                    </div>
                    <div class="main-button_icon arrows-up">
                        <a href="#"><?php echo carbon_get_the_post_meta('about_button'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer(); // подключаем подвал
?>