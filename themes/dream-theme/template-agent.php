<?php
/**
 * Template Name: Агентам
 */
get_header(); ?>
<main>
    <section class="section-info-page">
        <div class="container">
            <div class="info-page-content">
                <h1 class="info-page-content__title"><?php the_title(); ?></h1>
                <div class="info-page-content__row row-info-page">
                    <div class="row-info-page__left left-info-page">
                        <div class="left-info-page__text"><?php the_content(); ?></div>
                        <div class="agent-button">
                            <a class="right-info-page__btn" href="javascript:void(0)"
                               data-target="#agent-modal"
                               data-toggle="modal">
                                <?php echo pll__('Хочу стати агентом'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="row-info-page__right right-info-page">
                        <div class="right-info-page__img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <a class="right-info-page__btn mobile" href="javascript:void(0)"
                           data-target="#agent-modal"
                           data-toggle="modal">
                            <?php echo pll__('Хочу стати агентом'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="main-modal-form modal" id="agent-modal" tabindex="20" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="modal__close-button close" data-dismiss="modal" aria-label="Close">
                </button>
                <div class="consultation-form-modal modal-form">
                    <div class="form__title">
                        <?php echo pll__('Хочу стати агентом'); ?>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="3134" title="Заявка Агента"]'); ?>
                    <p class="form__privacy-policy">
                        <?php echo pll__('Натискаючи на кнопку, я погоджуюсь на <span>обробку персональних даних</span>'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>