<?php
/**
 * Template Name: Форма тест-драйву
 */
get_header();
?>
<main>
    <div class="container">
        <div class="drive-modal-form single-form" id="drive-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="consultation-form-modal modal-form">
                        <div class="form__title">
                            <?php echo pll__("Запис на тест-драйв"); ?>
                        </div>
                        <?php echo do_shortcode(pll__('[contact-form-7 id="1749" title="Test drive popup"]')); ?>
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

