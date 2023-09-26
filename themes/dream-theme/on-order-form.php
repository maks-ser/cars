<?php
/**
 * Template Name: Форма "Під замовлення"
 */
get_header();
?>
<main>
    <div class="container">
        <div class="order-modal-form single-form" id="order-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="consultation-form-modal modal-form">
                        <div class="form__title">
                            <?php echo pll__("Під замовлення"); ?>
                        </div>
                        <?php echo do_shortcode(pll__('[contact-form-7 id="1746" title="On order"]')); ?>
                        <p class="form__privacy-policy">
                            <?php echo pll__('Натискаючи на кнопку, я погоджуюсь на <span>обробку персональних даних</span>'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- /.container -->
<?php
get_footer();
?>

