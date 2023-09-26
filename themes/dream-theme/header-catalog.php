<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
        <meta name="google-site-verification" content="7Q66BDfmniOwS8aG9_Sk7gtQiFnIiRjR2GcuJ0Dp7EE" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Roboto:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <link rel="icon" type="image/x-icon" href="<?php echo bloginfo('template_url'); ?>/img/favicon.svg">
        <?php
        wp_head() // в этом месте в дальнейшем у нас будет подключаться CSS сайта, настроенный в Theme Customizer
        ?>
        <title><?php echo get_bloginfo('title') ?></title>
    </head>
<body <?php body_class('m_archive'); ?>>
<header id="top" class="header catalog">
    <div class="main-part">
        <div class="container">
            <div class="main-part-content">
                <div class="left-block">
                    <div class="header__logo">
                        <a href="<?php echo home_url();?>">
                            <img src="<?php echo carbon_get_theme_option('logo'); ?>" alt="Logo">
                        </a>
                    </div>
                    <div class="navbar">
                        <?php wp_nav_menu( [
                            'container'       =>'',
                            'items_wrap'      => '<ul class="nav__list">%3$s</ul>',
                            'theme_location'  => 'top'
                        ] ); ?>
                        <div class="header-button mobile">
                            <a data-toggle="modal" data-target="#consultation-modal" href="#"><?php echo pll__('Замовити дзвінок'); ?></a>
                        </div>
                        <div class="language-switcher mobile">
                            <ul class="languages-list">
                                <?php pll_the_languages(array('show_flags' => 0, 'show_names' => 0,'display_names_as' => 'slug')); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="header__contacts smaller-screen">
                        <div class="timetable">
                            <?php echo pll__('Працюємо з 9:00 до 18:00, Пн-Пт'); ?>
                        </div>
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
                            </ul>
                        </div>
                    </div>
                    <div class="header__burger">
                        <div class="burger__body">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="shadow" id="shadow"></div>
                </div>
                <div class="right-block">
                    <div class="header__contacts">
                        <div class="timetable">
                            <?php echo pll__('Працюємо з 9:00 до 18:00, Пн-Пт'); ?>
                        </div>
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
                            </ul>
                        </div>
                    </div>
                    <div class="header-button">
                        <a data-toggle="modal" data-target="#consultation-modal" href="#"><?php echo pll__('Замовити дзвінок'); ?></a>
                    </div>
                    <div class="language-switcher">
                        <ul class="languages-list">
                            <?php pll_the_languages(array('show_flags' => 0, 'show_names' => 0,'display_names_as' => 'slug')); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-part">
        <div class="container">
            <div class="bottom-part-content">
                <div class="catalog">
                    <?php wp_nav_menu( [
                        'container'       =>'',
                        'items_wrap'      => '<ul class="nav__list">%3$s</ul>',
                        'theme_location'  => 'catalog_drop_menu'
                    ] ); ?>
                </div>
                <div class="fast-category-menu">
                    <?php wp_nav_menu( [
                        'container'       =>'',
                        'items_wrap'      => '<ul class="nav__list">%3$s</ul>',
                        'theme_location'  => 'fast_category_nav'
                    ] ); ?>
                </div>
            </div>
        </div>
    </div>
</header>


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