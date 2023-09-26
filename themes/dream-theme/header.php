<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <meta name="google-site-verification" content="7Q66BDfmniOwS8aG9_Sk7gtQiFnIiRjR2GcuJ0Dp7EE" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Roboto:ital,wght@0,400;0,700;1,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"  />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="icon" type="image/x-icon" href="<?php echo bloginfo('template_url'); ?>/img/favicon.tif">
    <?php wp_head() ?>
</head>
<body <?php body_class('m_header'); ?>>
<header id="top" class="header">
    <div class="main-part">
        <div class="container">
            <div class="main-part-content">
                <div class="left-block">
                    <div class="header__logo">
                        <a href="<?php echo home_url(); ?>">
                            <img src="<?php echo carbon_get_theme_option('logo'); ?>" alt="Logo">
                        </a>
                    </div>
                    <div class="front-navbar">
                        <?php wp_nav_menu([
                            'container' => '',
                            'items_wrap' => '<ul class="nav__list">%3$s</ul>',
                            'theme_location' => 'fast_category_nav'
                        ]); ?>
                    </div>
                    <!-- /.front-navbar -->
                    <div class="navbar">
                        <?php wp_nav_menu([
                            'container' => '',
                            'items_wrap' => '<ul class="nav__list">%3$s</ul>',
                            'theme_location' => 'burger_menu'
                        ]); ?>

                        <div class="header-button mobile">
                            <a href="https://funcar.com.ua/forma-zamovlennya-test-drajvu/"><?php echo pll__('ТЕСТ-ДРАЙВ'); ?></a>
                        </div>
<!--                        <div class="language-switcher mobile">-->
<!--                            <ul class="languages-list">-->
                                    <?php //pll_the_languages(array('show_flags' => 0, 'show_names' => 0, 'display_names_as' => 'slug', 'hide_if_empty' => true, 'hide_current' => true)); ?>
<!--                            </ul>-->
<!--                        </div>-->

                    </div>
                    <div class="header__contacts smaller-screen">
<!--                        <a href="#contacts" class="timetable">-->
<!--                            --><?php //echo pll__('Працюємо з 9:00 до 18:00, Пн-Пт'); ?>
<!--                        </a>-->
                        <div class="numbers-container">
                            <div class="main-number">
                                <?php $phone = carbon_get_theme_option('phone'); ?>
                                <a href="tel:<?php echo $phone[0]['text']; ?>">
                                    <?php echo $phone[0]['text']; ?>
                                </a>
                            </div>
                            <ul class="numbers-list">
                                <?php
                                foreach ($phone as $ph) {
                                    ?>
                                    <li>
                                        <a href="tel:<?php echo $ph['text'] ?>"><?php echo $ph['text'] ?></a>
                                    </li>
                                <?php } ?>
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
                            </ul>
                        </div>
                    </div>
                    <div class="aut">
                        <?php
                        if (is_user_logged_in()) {
                            $auth = '<div><a href="' . wp_logout_url() . '">  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="50" height="50" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g fill="#000" fill-rule="evenodd" clip-rule="evenodd"><path d="M5.077 5.926c0-1.537 1.263-2.783 2.82-2.783H12c.425 0 .77.34.77.759s-.345.76-.77.76H7.897c-.708 0-1.282.566-1.282 1.264V6.94c0 .419-.344.759-.769.759a.764.764 0 0 1-.77-.76zm.77 10.376c.424 0 .768.34.768.76v1.011c0 .7.574 1.266 1.282 1.266H12c.425 0 .77.34.77.759 0 .42-.345.76-.77.76H7.897c-1.557 0-2.82-1.247-2.82-2.785v-1.012c0-.419.344-.759.77-.759z" fill="#88D802" data-original="#000000" class=""></path><path d="M12.77 4.786c0-.881.89-1.492 1.727-1.186l5.128 1.874c.503.184.837.657.837 1.187v10.678c0 .53-.334 1.003-.837 1.187L14.497 20.4c-.838.307-1.728-.305-1.728-1.186zm2.26-2.61c-1.841-.674-3.8.671-3.8 2.61v14.428c0 1.939 1.959 3.284 3.8 2.61l5.13-1.874A2.785 2.785 0 0 0 22 17.34V6.66a2.785 2.785 0 0 0-1.84-2.61zM5.364 9.439a.776.776 0 0 0-1.087 0l-2.052 2.024c-.3.297-.3.777 0 1.074l2.052 2.024c.3.297.787.297 1.087 0 .3-.296.3-.777 0-1.073l-.738-.729h4.297c.425 0 .77-.34.77-.759s-.345-.76-.77-.76H4.626l.738-.728c.3-.296.3-.777 0-1.073z" fill="#88D802" data-original="#000000" class=""></path></g></g></svg> </a></div>';
                        } else {
                            $auth = '<div><a href="#" data-toggle="modal" data-target="#auth-modal"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="50" height="50" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M32 0C14.355 0 0 14.356 0 32s14.355 32 32 32c17.644 0 32-14.355 32-32S49.644 0 32 0zm0 4c15.439 0 28 12.56 28 28 0 5.603-1.66 10.821-4.505 15.203A24.112 24.112 0 0 0 42.972 30.67 13.93 13.93 0 0 0 46 22c0-7.72-6.28-14-14-14s-14 6.28-14 14a13.93 13.93 0 0 0 3.028 8.67C14.562 34.006 9.96 40.129 8.505 47.203A27.827 27.827 0 0 1 4 32C4 16.56 16.56 4 32 4zM22 22c0-5.514 4.486-10 10-10s10 4.486 10 10-4.486 10-10 10-10-4.486-10-10zm10 38c-7.82 0-14.898-3.227-19.983-8.414.164-7.855 4.965-14.918 12.158-17.982A13.92 13.92 0 0 0 32 36c2.896 0 5.59-.884 7.825-2.396 7.193 3.064 11.994 10.127 12.158 17.982C46.898 56.773 39.82 60 32 60z" fill="#88D802" data-original="#000000" class=""></path></g></svg>   </a></div>';
                        }
                        echo $auth;
                        ?>
                    </div>
                    <div class="header__burger">
                        <div class="burger__body">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
<!--                    <div class="language-switcher">-->
<!--                        <ul class="languages-list">-->
<!--                            --><?php ////pll_the_languages(array('show_flags' => 0, 'show_names' => 0, 'display_names_as' => 'slug', 'hide_if_empty' => true, 'hide_current' => false)); ?>
<!--                            --><?php //pll_the_languages(array('show_flags' => 0, 'show_names' => 0, 'display_names_as' => 'slug', 'hide_if_empty' => true, 'hide_current' => true)); ?>
<!---->
<!---->
<!--                            <script>-->
<!--                               const lang = document.querySelector('.lang-item a');-->
<!--                               if(lang.getAttribute('lang') === 'ru-RU') {-->
<!--                                   lang.textContent = 'ua'-->
<!--                               } else {-->
<!--                                   lang.textContent = 'ru'-->
<!--                               }-->
<!--                            </script>-->
<!--                        </ul>-->
<!--                    </div>-->
                    <div class="shadow" id="shadow"></div>
                </div>
                <div class="right-block">
                    <div class="header__contacts">
<!--                        <div class="timetable">-->
<!--                            --><?php //echo pll__('Працюємо з 9:00 до 18:00, Пн-Пт'); ?>
<!--                        </div>-->
                        <div class="numbers-container">
                            <div class="main-number">
                                <?php $phone = carbon_get_theme_option('phone'); ?>
                                <a href="tel:<?php echo $phone[0]['text']; ?>">
                                    <?php echo $phone[0]['text']; ?>
                                </a>
                            </div>
                            <ul class="numbers-list">
                                <?php
                                foreach ($phone as $ph) {
                                    ?>
                                    <li>
                                        <a href="tel:<?php echo $ph['text'] ?>"><?php echo $ph['text'] ?></a>
                                    </li>
                                <?php } ?>
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
                            </ul>
                        </div>
                    </div>
                    <div class="header-button">
                        <a href="https://funcar.com.ua/category/all/"><?php echo pll__('КАТАЛОГ'); ?></a>
                    </div>
                    <div class="header-button">
                        <a href="https://funcar.com.ua/forma-zamovlennya-test-drajvu/"><?php echo pll__('ТЕСТ-ДРАЙВ'); ?></a>
                    </div>
                    <div class="aut">
                        <?php
                        if (is_user_logged_in()) {
                            $auth = '<div><a href="' . wp_logout_url() . '">  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="50" height="50" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g fill="#000" fill-rule="evenodd" clip-rule="evenodd"><path d="M5.077 5.926c0-1.537 1.263-2.783 2.82-2.783H12c.425 0 .77.34.77.759s-.345.76-.77.76H7.897c-.708 0-1.282.566-1.282 1.264V6.94c0 .419-.344.759-.769.759a.764.764 0 0 1-.77-.76zm.77 10.376c.424 0 .768.34.768.76v1.011c0 .7.574 1.266 1.282 1.266H12c.425 0 .77.34.77.759 0 .42-.345.76-.77.76H7.897c-1.557 0-2.82-1.247-2.82-2.785v-1.012c0-.419.344-.759.77-.759z" fill="#88D802" data-original="#000000" class=""></path><path d="M12.77 4.786c0-.881.89-1.492 1.727-1.186l5.128 1.874c.503.184.837.657.837 1.187v10.678c0 .53-.334 1.003-.837 1.187L14.497 20.4c-.838.307-1.728-.305-1.728-1.186zm2.26-2.61c-1.841-.674-3.8.671-3.8 2.61v14.428c0 1.939 1.959 3.284 3.8 2.61l5.13-1.874A2.785 2.785 0 0 0 22 17.34V6.66a2.785 2.785 0 0 0-1.84-2.61zM5.364 9.439a.776.776 0 0 0-1.087 0l-2.052 2.024c-.3.297-.3.777 0 1.074l2.052 2.024c.3.297.787.297 1.087 0 .3-.296.3-.777 0-1.073l-.738-.729h4.297c.425 0 .77-.34.77-.759s-.345-.76-.77-.76H4.626l.738-.728c.3-.296.3-.777 0-1.073z" fill="#88D802" data-original="#000000" class=""></path></g></g></svg> </a></div>';
                        } else {
                            $auth = '<div><a href="#" data-toggle="modal" data-target="#auth-modal"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="50" height="50" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M32 0C14.355 0 0 14.356 0 32s14.355 32 32 32c17.644 0 32-14.355 32-32S49.644 0 32 0zm0 4c15.439 0 28 12.56 28 28 0 5.603-1.66 10.821-4.505 15.203A24.112 24.112 0 0 0 42.972 30.67 13.93 13.93 0 0 0 46 22c0-7.72-6.28-14-14-14s-14 6.28-14 14a13.93 13.93 0 0 0 3.028 8.67C14.562 34.006 9.96 40.129 8.505 47.203A27.827 27.827 0 0 1 4 32C4 16.56 16.56 4 32 4zM22 22c0-5.514 4.486-10 10-10s10 4.486 10 10-4.486 10-10 10-10-4.486-10-10zm10 38c-7.82 0-14.898-3.227-19.983-8.414.164-7.855 4.965-14.918 12.158-17.982A13.92 13.92 0 0 0 32 36c2.896 0 5.59-.884 7.825-2.396 7.193 3.064 11.994 10.127 12.158 17.982C46.898 56.773 39.82 60 32 60z" fill="#88D802" data-original="#000000" class=""></path></g></svg>   </a></div>';
                        }
                        echo $auth;
                        ?>
                    </div>
                    <!--<div class="language-switcher">-->
                    <!--    <ul class="languages-list">-->
                    <!--        --><?php //pll_the_languages(array('show_flags' => 0, 'show_names' => 0, 'display_names_as' => 'slug', 'hide_if_empty' => true, 'hide_current' => true)); ?>
                    <!--    </ul>-->
                    <!--</div>-->

                </div>
            </div>
        </div>
    </div>
    <div class="bottom-part">
        <div class="container">
            <div class="bottom-part-content">
                <div class="catalog">
                    <?php wp_nav_menu([
                        'container' => '',
                        'items_wrap' => '<ul class="nav__list">%3$s</ul>',
                        'theme_location' => 'catalog_drop_menu'
                    ]); ?>
                </div>
                <div class="fast-category-menu">
                    <?php wp_nav_menu([
                        'container' => '',
                        'items_wrap' => '<ul class="nav__list">%3$s</ul>',
                        'theme_location' => 'fast_category_nav'
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- BEGIN HEADER -->
<?php /* <div class="wrapper" id="wrapper">
            <header class="header" id="headertop">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 ">
                            <div class="header_container">
                                <div class="head_elem-l">
                                    <a href="<?php echo home_url();?>" class="logo center_el">
                                        <img  src="<?php echo carbon_get_theme_option('logo'); ?>" alt="dreamscars" title="dreamscars">
                                    </a>
                                    <div class="toggle_block center_el" id="toggle">
                                        <div class="toggle">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>

                                <!--   <div class="shadow" id="shadow"></div> -->
                                <div class="head_elem-r">
                           <div class=" elem_currency bord_el center_el">
                                   <?php if($currency=='uah'):?>
                                       <div class="curr_bl-ch">UAH</div>
                                       <div  class="curr_bl" id="currency" data-currency="usd">USD</div>

                                   <?php else:?>
                                       <div class="curr_bl-ch">USD</div>
                                       <div  class="curr_bl" id="currency" data-currency="uah">UAH</div>
                                   <?php endif;?>
                            </div>

    

                                    <div class="elem_leng bord_el center_el">
 <?php echo custom_globus_change();?>
                              

                            </div>
                                    <?php $phone = carbon_get_theme_option(  'phone' ); ?>
                                    <a href="tel:<?php echo $phone['0']['text']; ?>" class="link-tell bord_el center_el"><?php echo $phone['0']['text']; ?></a>
                                    <a href="#" class="btn_top mod_open">
                                        <?php echo wp_globus_translate_array_string('Замовити в 1 клік','Заказать в 1 клик','Order in 1 click');?>
                                    </a>
                                </div>
                                <div class="header_navs center_el">
                                    <div class="nav__list-position">
                                        <?php wp_nav_menu( [
                                        'container'       =>'',
                                    'items_wrap'      => '<ul class="nav__list">%3$s</ul>',
                                    'theme_location'  => 'top'
                                    ] ); ?>
                                    
                                    
                                </div>
                            </div>
                            <div class="drobd_block">
                                <div class="drobd_block-d">
                                    <div class="elem_h-list">
                                        <div class="title_list"><span class="line"><span>
                                            <?php echo wp_globus_translate_array_string('Умови та послуги','Условия и услуги','Conditions and services');?>
                                        </span></span></div>
                                        <?php wp_nav_menu( [
                                        'container'       =>'',
                                    'items_wrap'      => '<ul class="sub-menu">%3$s</ul>',
                                    'theme_location'  => 'conditions'
                                    ] ); ?>
                                </div>
                                <div class="elem_h-list">
                                    <div class="title_list"><span class="line"><span>
                                        <?php echo wp_globus_translate_array_string('Компанія','Компания','Company');?>
                                    </span></span></div>
                                    <?php wp_nav_menu( [
                                    'container'       =>'',
                                'items_wrap'      => '<ul class="sub-menu">%3$s</ul>',
                                'theme_location'  => 'company'
                                ] ); ?>
                            </div>
                            <div class="elem_h-list">
                                <div class="title_list"><span class="line"><span>
                                    
                                    <?php echo wp_globus_translate_array_string('Лояльність','Лояльность','Loyalty');?>
                                </span></span></div>
                                <?php wp_nav_menu( [
                                'container'       =>'',
                            'items_wrap'      => '<ul class="sub-menu">%3$s</ul>',
                            'theme_location'  => 'loyalty'
                            ] ); ?>
                        </div>
                    </div>
                    <div class="nav__list-mob">
                        <ul class="nav__list-mob">
                            <li  class="arrow_it-mob">
                                <div class="elem_link">
                                    <a href="#">  <?php echo wp_globus_translate_array_string('Умови та послуги','Условия и услуги','Conditions and services');?></a>
                                    <span class="icon_arrow">
                                        <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.27438 5.58077L9.89199 0.963171C10.0396 0.810303 10.0354 0.566706 9.88252 0.419069C9.73339 0.275039 9.49699 0.275039 9.34789 0.419069L5.00233 4.76462L0.656779 0.419069C0.506526 0.268839 0.262929 0.268839 0.112677 0.419069C-0.0375528 0.569344 -0.0375529 0.812918 0.112677 0.96317L4.73028 5.58077C4.88056 5.731 5.12413 5.731 5.27438 5.58077Z"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="drobd__list-m">
                                    <?php wp_nav_menu( [
                                    'container'       =>'',
                                'items_wrap'      => '<ul class="drobd__list">%3$s</ul>',
                                'theme_location'  => 'conditions'
                                ] ); ?>
                            </div>
                        </li>
                        
                        
                        
                        <li  class="arrow_it-mob">
                            <div class="elem_link">
                                <a href="#"> <?php echo wp_globus_translate_array_string('Компанія','Компания','Company');?></a>
                                <span class="icon_arrow">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.27438 5.58077L9.89199 0.963171C10.0396 0.810303 10.0354 0.566706 9.88252 0.419069C9.73339 0.275039 9.49699 0.275039 9.34789 0.419069L5.00233 4.76462L0.656779 0.419069C0.506526 0.268839 0.262929 0.268839 0.112677 0.419069C-0.0375528 0.569344 -0.0375529 0.812918 0.112677 0.96317L4.73028 5.58077C4.88056 5.731 5.12413 5.731 5.27438 5.58077Z"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="drobd__list-m">
                                <div class="drobd__list-m">
                                    <?php wp_nav_menu( [
                                    'container'       =>'',
                                'items_wrap'      => '<ul class="drobd__list">%3$s</ul>',
                                'theme_location'  => 'company'
                                ] ); ?>
                            </div>
                        </div>
                    </li>
                    <li  class="arrow_it-mob">
                        <div class="elem_link">
                            <a href="#"> <?php echo wp_globus_translate_array_string('Лояльність','Лояльность','Loyalty');?></a>
                            <span class="icon_arrow">
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.27438 5.58077L9.89199 0.963171C10.0396 0.810303 10.0354 0.566706 9.88252 0.419069C9.73339 0.275039 9.49699 0.275039 9.34789 0.419069L5.00233 4.76462L0.656779 0.419069C0.506526 0.268839 0.262929 0.268839 0.112677 0.419069C-0.0375528 0.569344 -0.0375529 0.812918 0.112677 0.96317L4.73028 5.58077C4.88056 5.731 5.12413 5.731 5.27438 5.58077Z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="drobd__list-m">
                            <?php wp_nav_menu( [
                            'container'       =>'',
                        'items_wrap'      => '<ul class="drobd__list">%3$s</ul>',
                        'theme_location'  => 'loyalty'
                        ] ); ?>
                        
                    </div>
                </li>
                <li>
                    <div class="elem_link"><a href="#"> <?php echo wp_globus_translate_array_string('Контакти','Контакты','Contacts');?></a></div>
                </li>
            </ul>
            <a href="tel:<?php echo $phone['0']['text']; ?>" class="link-tell link_m"><?php echo $phone['0']['text']; ?></a>
        </div>
        
    </div>
</div>
</div>
</div>
</div>

</header>*/ ?>