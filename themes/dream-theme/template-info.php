<?php
/**
 * Template Name: Сторінка INFO
 */
get_header();
?>
    <main>
    <section class="section-info-page">
        <div class="container">
            <div class="info-page-content">
                <h1 class="info-page-content__title"><?php echo carbon_get_the_post_meta("info_page_title")?></h1>
                <div class="info-page-content__row row-info-page">
                    <div class="row-info-page__left left-info-page">
                        <p class="left-info-page__text"><?php echo carbon_get_the_post_meta("info_page_text")?></p>
                        <h3 class="items-left-info__title">
                        <?php echo carbon_get_the_post_meta("info_page_items_title")?>
                        </h3>
                        <div class="left-info-page__items items-left-info">
                            <!-- /.items-left-info__item -->
                            <?php $info_page_items_array = carbon_get_the_post_meta("info_page_items");
                            foreach($info_page_items_array as $item) { ?>
                                <div class="items-left-info__item">
                                    <?php if($item['info_page_items_img']): $class='';?>
                                        <?php if(is_page(2584) || is_page(2611)) {
                                            $class="large";
                                        } ?>
                                        <img class="<?php echo $class; ?>" src="<?php echo $item['info_page_items_img'] ?>" alt="">
                                    <?php endif; ?>
                                    <?php if($item['info_page_items_text']): ?>
                                        <p><?php echo $item['info_page_items_text'] ?></p>
                                    <?php endif; ?>
                                    <?php if($item['info_page_items_link_text']): ?>
                                        <a target="_blank" href="mailto:<?php echo $item['info_page_items_link'] ?>">
                                            <?php echo $item['info_page_items_link_text'] ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                            <?php if(carbon_get_the_post_meta("info_page_button_link")) : ?>
                                <a class="right-info-page__btn" target="_blank" href="<?php echo carbon_get_the_post_meta("info_page_button_link")?>">
                                    <?php echo carbon_get_the_post_meta("info_page_button_text")?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row-info-page__right right-info-page">
                        <div class="right-info-page__img">
                            <img src="<?php echo carbon_get_the_post_meta("info_page_img")?>" alt="">
                        </div>
                        <?php if(carbon_get_the_post_meta("info_page_button_link")) : ?>
                            <a class="right-info-page__btn mobile" target="_blank" href="<?php echo carbon_get_the_post_meta("info_page_button_link")?>">
                                <?php echo carbon_get_the_post_meta("info_page_button_text")?>
                            </a>
                        <?php endif; ?>
                        <!-- /.right-info-page__img -->
                    </div>
                    <!-- /.row-info-page__right -->
                    <!-- /.row-info-page__content -->
                </div>
                <!-- /.info-page-content__row -->
            </div>
            <!-- /.info-page-content -->
        </div>
    </section>
<?php
get_footer();
?>