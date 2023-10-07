<div class="hidden-all-posts" style="display:none;">
    <?php
    $args = array(
        'category' => 29,
        'numberposts' => -1,
        'meta_query' => array(
            array(
                'key' => 'booking_status',
                'value' => 1,
                'compare' => '!=',
                'type' => 'NUMERIC',
            ),
            array(
                'key' => 'booking_status',
                'compare' => 'NOT EXISTS',
            ),
        ),
    );
    $posts = get_posts( $args );
    foreach ( $posts as $post ) :
        $vin_code_array = get_the_tags($post->ID);
        $vin_code = $vin_code_array[0]->name;
    ?>
    <div class="hidden-posts-title">
        <?php the_title();?>
    </div>
    <div class="hidden-posts-vincode">
        <?php if($vin_code) {
            echo $vin_code;
        } else echo ''; ?>
    </div>
    <div class="hidden-posts-equipment">
        <?php echo carbon_get_post_meta($post->ID, 'sing_product_equipment'); ?>
    </div>
    <!-- /.hidden-posts-equipment -->
    <?php endforeach; wp_reset_postdata(); ?>
</div>


<section class="section-contacts" id="contacts">
    <div class="map">
        <?php echo carbon_get_theme_option('google_maps_iframe'); ?>
    </div>
    <div class="container">
        <div class="contacts-content">
            <div class="contact-block">
                <h2 class="block-title">
                    <?php echo pll__('Наші контакти:'); ?>
                </h2>
                <div class="address-column">
                    <div class="address-title">
                        <?php echo pll__('Адреса майданчика:'); ?>
                    </div>
                    <div class="address">
                        <a href="<?php echo carbon_get_theme_option('google_maps'); ?>"
                           target="_blank">
                            <?php echo pll__('Киевская'); ?>
                        </a>
                    </div>
                </div>
                <div class="phone-contacts-column">
                    <div class="column-title">
                        <?php echo pll__('Наші телефони:'); ?>
                        <ul class="numbers-list">
                            <?php
                            $numbers = carbon_get_theme_option('phone');
                            foreach ($numbers as $key => $numb) {
                                ?>
                                <li>
<!--                                    <img src="--><?php //echo bloginfo('template_url'); ?><!--/img/viber.svg" alt="">-->
<!--                                    <img src="--><?php //echo bloginfo('template_url'); ?><!--/img/telegram.svg" style="margin-right: 5px" alt="">-->
                                    <a href="tel:<?php echo $numb['text']; ?>"
                                       class="number"><?php echo $numb['text']; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                        <ul class="messenger-list">
                            <li>
                                <a href="viber://chat?number=<?php echo str_replace("-", "", $numbers[0]['text']); ?>">
                                    <img src="<?php echo bloginfo('template_url'); ?>/img/viber.svg" alt="viber">
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?phone=38<?php echo str_replace("-", "", $numbers[0]['text']); ?>">
                                    <img src="<?php echo bloginfo('template_url'); ?>/img/whatsapp.svg" alt="whatsapp">
                                </a>
                            </li>
                        </ul>
                        <div class="email">
                            <a href="mailto:<?php echo carbon_get_theme_option('email'); ?>"><?php echo carbon_get_theme_option('email'); ?></a>
                        </div>
                        <div class="main-button_icon cursor">
                            <a href=<?php echo get_page_link(1932) ?>><?php echo pll__('Замовити ТЕСТ-ДРАЙВ'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="timetable-column">
                    <div class="column-title">
                        <?php echo pll__('Режим роботи:'); ?>
                    </div>
                    <div class="timetable">
                        <?php echo pll__('Понеділок-пятниця з 9:00 до 18:00'); ?>
                    </div>
                    <div class="weekends">
                        <?php echo pll__('Субота - вихідний <br> Неділя - вихідний'); ?>
                    </div>
                </div>
                <div class="social-networks-column">
                    <div class="column-title">
                        <?php echo pll__('Ми у соцмережах:'); ?>
                    </div>
                    <div class="social-networks">
                        <?php
                        $social_networks = carbon_get_theme_option('social_networks');
                        foreach ($social_networks as $social_net) {
                            ?>
                            <a href="<?php echo $social_net['link'] ?>" target="_blank">
                                <img src="<?php echo $social_net['icon'] ?>" alt="Social network">
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<div class="main-modal-form modal fade" id="consultation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="modal__close-button close" data-dismiss="modal" aria-label="Close">
            </button>
            <div class="consultation-form-modal modal-form">
                <div class="form__title">
                    <?php echo pll__("Замовити консультацію"); ?>
                </div>
                <?php echo do_shortcode(pll__('[contact-form-7 id="1224" title="Popup_RU"]')); ?>
                <p class="form__privacy-policy">
                    <?php echo pll__('Натискаючи на кнопку, я погоджуюсь на <span>обробку персональних даних</span>'); ?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="buy-modal-form modal fade" id="buy-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <h1>test</h1>
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="modal__close-button close" data-dismiss="modal" aria-label="Close">
            </button>
            <div class="consultation-form-modal modal-form">
                <div class="form__title">
                    <?php echo pll__("Замовити консультацію"); ?>
                </div>
                <?php echo do_shortcode(pll__('[contact-form-7 id="1747" title="Buy car popup"]')); ?>
                <p class="form__privacy-policy">
                    <?php echo pll__('Натискаючи на кнопку, я погоджуюсь на <span>обробку персональних даних</span>'); ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php if(!is_user_logged_in()): ?>
<div class="main-modal-form modal fade" id="auth-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="modal__close-button close" data-dismiss="modal" aria-label="Close">
            </button>
            <div class="consultation-form-modal modal-form">
                <div class="form__title">
                    <?php echo pll__("Вхід дилера"); ?>
                </div>
                <form id="auth-form">
                    <div class="form__inputs">
                        <div class="form__input">
                            <div class="input__upper-title">
                                <p><?php echo pll__('Email'); ?></p>
                            </div>
                            <p>
                                <input name="email" id="auth-form-email" type="text" placeholder="<?php echo pll__('Email'); ?>">
                                <span class="wpcf7-not-valid-tip" style="display: none" aria-hidden="true"><?php echo pll__('Email не коректний'); ?></span>
                            </p>
                        </div>
                        <div class="form__input">
                            <div class="input__upper-title">
                                <p><?php echo pll__('Пароль'); ?></p>
                            </div>
                            <p>
                                <input name="password" id="auth-form-password" type="password" placeholder="<?php echo pll__('Пароль'); ?>">
                                <span class="wpcf7-not-valid-tip" style="display: none" aria-hidden="true"><?php echo pll__('Введіть пароль'); ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="form__button main-button">
                        <p>
                            <input type="submit" id="auth-form-submit" value="<?php echo pll__('Увійти'); ?>">
                            <a data-toggle="modal" data-target="#registration-modal" class="margin-top"  href="#"><?php echo pll__('Зареєструватись'); ?></a>
                            <span class="wpcf7-not-valid-tip"
                                  style="display: none"><?php echo pll__('Логін або Email не коректний'); ?></span>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
   <div class="main-modal-form modal fade" id="registration-modal" tabindex="20" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="modal__close-button close" data-dismiss="modal" aria-label="Close">
                </button>
                <div class="consultation-form-modal modal-form">
                    <div class="form__title">
                        <?php echo pll__("Зареєструватись"); ?>
                    </div>
                    <?php echo do_shortcode(pll__('[contact-form-7 id="1722" title="Форма на реєстрацію"]')); ?>
                    <p class="form__privacy-policy">
                        <?php echo pll__('Натискаючи на кнопку, я погоджуюсь на <span>обробку персональних даних</span>'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="main-modal-form modal fade" id="no-active">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="modal__close-button close" data-dismiss="modal" aria-label="Close">
                </button>
                <div class="consultation-form-modal modal-form">
                   <?php echo apply_filters('the_content', carbon_get_theme_option('agent_no_active_text_' . pll_current_language())); ?>
                </div>
            </div>
        </div>
    </div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#auth-form').on('submit', function (e) {
            e.preventDefault();
            $(this).find('.wpcf7-not-valid-tip').hide();

            let email = $(this).find('#auth-form-email').val();
            let password = $(this).find('#auth-form-password').val();
            let re = /\S+@\S+\.\S+/;
            let validate = true;

            if(!re.test(email)){
                validate = false;
                $(this).find('#auth-form-email').siblings('.wpcf7-not-valid-tip').show();
            }

            if(password === ''){
                validate = false;
                $(this).find('#auth-form-password').siblings('.wpcf7-not-valid-tip').show();
            }

            let data = {
                action: 'customer_auth',
                email: email,
                password: password,
                security: '<?php echo wp_create_nonce("nonce"); ?>'
            };

            if(validate){
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(json) {
                        if(json.success === true){
                            window.location.reload();
                        } else {
                            if(json.modal){
                                $('#auth-modal').modal('hide');
                                $('#' + json.modal).modal('show');
                            } else {
                                $('#auth-form-submit').siblings('.wpcf7-not-valid-tip').show();
                            }
                        }
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log(xhr.responseText);
                    }
                });
            }

        });
    });
</script>
<?php endif; ?>
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="up-button">
                <a href="#top"><?php echo pll__('Вгору'); ?></a>
            </div>
            <div class="left-block">
                <div class="footer__logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo carbon_get_theme_option('logo'); ?>" alt="Logo">
                    </a>
                </div>
                <div class="company-title">
                    <?php echo pll__('Дилер електромобілів в Україні'); ?>
                </div>
            </div>
            <div class="right-block">
                <a href="https://horenko-production.com/" target="_blank" class="site-development">
                    <?php echo pll__('Розробка сайту'); ?>
                </a>
                <div class="copyright">
                    <?php echo carbon_get_theme_option('copyright') ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal-backdrop fade close-modal-window"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css" rel="stylesheet"/>
<link href="<?php echo bloginfo('template_url'); ?>/css/jquery-ui.css" rel="stylesheet"/>


<script src="<?php echo bloginfo('template_url'); ?>/js/jquery-ui.min.js"></script>
<script src="<?php echo bloginfo('template_url'); ?>/js/jquery.ui.touch-punch.min.js"></script>

<script src="<?php echo bloginfo('template_url'); ?>/js/script.js"></script>
<?php

$user = get_userdata(get_current_user_id());
$user_role = $user->roles[0] ?? false;

if($user_role && $user_role == 'agent'){
    $active = carbon_get_user_meta($user->ID, 'user_active');

    if(!$active){
        wp_logout();
    }
}


 ?>
<?php wp_footer() /* конкретно для нашего примера эта функция не обязательна, но во всех темах WP она должна присутствовать */ ?>

</body>
</html>