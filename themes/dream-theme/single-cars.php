<?php
get_header();
$currency = getCurrency();
?>
    <main class="main">
        <div class="section_rent">
            <div class="container">
                <div class="breadcrumbs_container">
                    <div class="bredcrumb">
                        <?php breadcrumbs();?>
                    </div>
                </div>
                <div class="auto_element-w-wr">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-xs-12">

                            <div class="card_top">
                                <div class="auto_el-em">
                                    <?php   $model_car = carbon_get_theme_option('model_car');
                                    $alias = carbon_get_post_meta(get_the_ID(), 'model_car');
                                    $model_car = (_getParam($model_car,$alias));?>
                                    <img src="<?php echo  $model_car['img'];?>">
                                </div>
                                <div class="auto_el-cl">
                                    <?php
                                    $categories = get_the_category( $post->ID );

                                    echo $categories[0]->name;
                                    //var_dump($categories);
                                    ?>
                                </div>
                            </div>
                            <div class="swiper mySwiper2" >
                                <div class="swiper-wrapper">
                                    <?php $car_img = carbon_get_post_meta(get_the_ID(), 'car_img');
                                    foreach ($car_img as $car_i):?>
                                        <div class="swiper-slide">
                                            <div class="auto_card-img"><img src="<?php echo wp_get_attachment_image_src($car_i,'full')[0]; ?>"></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-button-next s_c">
                                    <svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.1937 11.3417L2.11141 0.259476C1.74453 -0.0948533 1.1599 -0.0846801 0.80557 0.282203C0.459899 0.640103 0.459899 1.20747 0.80557 1.56532L11.2349 11.9946L0.80557 22.424C0.445018 22.7846 0.445018 23.3692 0.80557 23.7298C1.16623 24.0904 1.75081 24.0904 2.11141 23.7298L13.1937 12.6476C13.5542 12.2869 13.5542 11.7023 13.1937 11.3417Z" fill="#E9E9E9"/>
                                    </svg>
                                </div>
                                <div class="swiper-button-prev s_c">
                                    <svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.806335 12.6583L11.8886 23.7405C12.2555 24.0949 12.8401 24.0847 13.1944 23.7178C13.5401 23.3599 13.5401 22.7925 13.1944 22.4347L2.7651 12.0054L13.1944 1.57603C13.555 1.21542 13.555 0.630787 13.1944 0.27018C12.8338 -0.090372 12.2492 -0.090372 11.8886 0.27018L0.806335 11.3524C0.445783 11.7131 0.445784 12.2977 0.806335 12.6583Z" fill="#E9E9E9"/>
                                    </svg>
                                </div>
                            </div>
                            <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <?php $car_img = carbon_get_post_meta(get_the_ID(), 'car_img');
                                    foreach ($car_img as $car_i):?>
                                        <div class="swiper-slide">
                                            <div class="auto_c-s-img"><img src="<?php echo wp_get_attachment_image_src($car_i,'medium')[0]; ?>"></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-xs-12  ">
                            <div class="card_element">
                                <div class="title_custom"><span class="line"><span><?php the_title();?></span></span></div>
                                <div class="auto_el-desc">
                                    <?php   $volume = carbon_get_theme_option('volume');
                                    $alias = carbon_get_post_meta(get_the_ID(), 'volume');
                                    $volume = (_getParam($volume,$alias));
                                    echo  $volume['text'];?>
                                    / <?php   $fuel = carbon_get_theme_option('fuel');
                                    $alias = carbon_get_post_meta(get_the_ID(), 'fuel_type');
                                    $fuel = (_getParam($fuel,$alias));
                                    echo  $fuel[wp_globus_translate_array('text')];?>
                                    / <?php   $transmission = carbon_get_theme_option('transmission');
                                    $alias = carbon_get_post_meta(get_the_ID(), 'transmission');
                                    $transmission = (_getParam($transmission,$alias));
                                    echo  $transmission[wp_globus_translate_array('text')];?>
                                </div>
                                <div class="auto_el-desc-icons">
                                    <div class="auto_el-d">
                                        <img src="<?php echo bloginfo('template_url'); ?>/img/car.svg">
                                        <span>
                                        <?php echo carbon_get_post_meta(get_the_ID(), 'doors');?>
                                    </span>
                                    </div>
                                    <div class="auto_el-d">
                                        <img src="<?php echo bloginfo('template_url'); ?>/img/people.svg">
                                        <span><?php echo carbon_get_post_meta(get_the_ID(), 'places');?></span>
                                    </div>
                                    <div class="auto_el-d">
                                        <img src="<?php echo bloginfo('template_url'); ?>/img/box.svg">
                                        <span><?php echo carbon_get_post_meta(get_the_ID(), 'baggage_big');?></span>
                                    </div>
                                    <div class="auto_el-d">
                                        <img src="<?php echo bloginfo('template_url'); ?>/img/clas.svg">
                                        <span><?php echo carbon_get_post_meta(get_the_ID(), 'baggage_small');?></span>
                                    </div>
                                    <div class="auto_el-d">
                                        <img src="<?php echo bloginfo('template_url'); ?>/img/cond.svg">
                                        <span>
                                        <?php echo carbon_get_post_meta(get_the_ID(), 'climat');?>
                                    </span>
                                    </div>
                                </div>
                                <div class="cart_el-des">
                                    <div class="cart_el-line">
                                        <div class="cart_el-type">
                                            <?php echo wp_globus_translate_array_string('Тип кузова','Тип кузова','Body type');?>
                                        </div>
                                        <div class="cart_el-res">
                                            <?php   $body_type = carbon_get_theme_option('body_type');
                                            $alias = carbon_get_post_meta(get_the_ID(), 'body_type');
                                            $body_type = (_getParam($body_type,$alias));
                                            echo  $body_type[wp_globus_translate_array('text')];?>
                                        </div>
                                    </div>
                                    <div class="cart_el-line">
                                        <div class="cart_el-type">
                                            <?php echo wp_globus_translate_array_string('Двигун','Двигатель','Engine');?>
                                        </div>
                                        <div class="cart_el-res">
                                            <?php   $volume = carbon_get_theme_option('volume');
                                            $alias = carbon_get_post_meta(get_the_ID(), 'volume');
                                            $volume = (_getParam($volume,$alias));
                                            echo  $volume['text'];?>
                                        </div>
                                    </div>
                                    <div class="cart_el-line">
                                        <div class="cart_el-type">
                                            <?php echo wp_globus_translate_array_string('Тип трансмісії','Тип трансмиссии','Transmission type');?>
                                        </div>
                                        <div class="cart_el-res"><?php   $transmission = carbon_get_theme_option('transmission');
                                            $alias = carbon_get_post_meta(get_the_ID(), 'transmission');
                                            $transmission = (_getParam($transmission,$alias));
                                            echo  $transmission[wp_globus_translate_array('text')];?> </div>
                                    </div>
                                    <div class="cart_el-line">
                                        <div class="cart_el-type">
                                            <?php echo wp_globus_translate_array_string('Потужність, к.с.','Мощность, л.с.','Power, h.p.');?>
                                        </div>
                                        <div class="cart_el-res">
                                            <?php echo carbon_get_post_meta(get_the_ID(), 'horsepower');?>
                                        </div>
                                    </div>
                                    <div class="cart_el-line">
                                        <div class="cart_el-type">
                                            <?php echo wp_globus_translate_array_string('Витрата палива (середній)',' Расход топлива (средний)','Fuel consumption (average)');?>

                                        </div>
                                        <div class="cart_el-res">
                                            <?php echo carbon_get_post_meta(get_the_ID(), 'fuel_consumption');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="title_el-c"><span class="line"><span>

                                <?php echo wp_globus_translate_array_string('Вартість оренди','Стоимость аренды','Rent price');?>
                            </span></span></div>
                                <div class="cart_table">
                                    <div class="cart_row">
                                        <div class="cart_th">1-3   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                        <div class="cart_th">4-9   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                        <div class="cart_th">10-25   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                        <div class="cart_th">26+   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                        <div class="cart_th">  <?php echo wp_globus_translate_array_string('Застава','Залог','Pledge');?></div>
                                    </div>
                                    <div class="cart_row">
                                        <div class="cart_tr">
                                            <div class="t_head">1-3   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                            <div class="t_text"> <?php echo getPrice(carbon_get_post_meta($post->ID, 'rent_price_1'), $currency)?><span>/  <?php echo wp_globus_translate_array_string('доба','сутки','Day');?></span></div>
                                        </div>
                                        <div class="cart_tr">
                                            <div class="t_head">4-9   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                            <div class="t_text"><?php echo getPrice(carbon_get_post_meta($post->ID, 'rent_price_2'), $currency)?><span>/  <?php echo wp_globus_translate_array_string('доба','сутки','Day');?></span></div>
                                        </div>
                                        <div class="cart_tr">
                                            <div class="t_head">10-25   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                            <div class="t_text"><?php echo getPrice(carbon_get_post_meta($post->ID, 'rent_price_3'), $currency)?><span>/  <?php echo wp_globus_translate_array_string('доба','сутки','Day');?></span></div>
                                        </div>
                                        <div class="cart_tr">
                                            <div class="t_head">26+   <?php echo wp_globus_translate_array_string('діб','суток','Day');?></div>
                                            <div class="t_text"><?php echo getPrice(carbon_get_post_meta($post->ID, 'rent_price_4'), $currency)?><span>/  <?php echo wp_globus_translate_array_string('доба','сутки','Day');?></span></div>
                                        </div>
                                        <div class="cart_tr">
                                            <div class="t_head">  <?php echo wp_globus_translate_array_string('Застава','Залог','Pledge');?></div>
                                            <div class="t_text"><?php echo getPrice(carbon_get_post_meta($post->ID, 'rent_price_5'), $currency)?><span>/  <?php echo wp_globus_translate_array_string('доба','сутки','Day');?></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btns_cart">
                                    <a href="#" class="btn_main">  <?php echo wp_globus_translate_array_string('Забронювати автомобіль','Забронировать автомобиль','Book a car');?></a>
                                    <a href="#" class="tr_btn">  <?php echo wp_globus_translate_array_string('Забронювати автомобіль','Забронировать автомобиль','Book a car');?></a>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="tabs">
                                <div class="tabs__nav">
                                    <a class="tabs__link tabs__link_active" href="#content-1">  <?php echo wp_globus_translate_array_string('Опис','Описание','Description');?></a>
                                    <a class="tabs__link" href="#content-3">  <?php echo wp_globus_translate_array_string('Відео','Видео','Video');?></a>
                                    <a class="tabs__link" href="#content-4">  <?php echo wp_globus_translate_array_string('Умови оренди','Условия аренды','Rent terms');?></a>
                                </div>
                                <div class="tabs__content">
                                    <div class="tabs__pane tabs__pane_show" id="content-1">
                                        <?php echo apply_filters('the_content', wpGlobusTranslatePost(get_the_ID(), 'cars_description')); ?>
                                    </div>
                                    <div class="tabs__pane" id="content-3">
                                        <?php echo apply_filters('the_content', wpGlobusTranslatePost(get_the_ID(), 'cars_video')); ?>
                                    </div>
                                    <div class="tabs__pane" id="content-4">
                                        <?php echo apply_filters('the_content', wpGlobusTranslatePost(get_the_ID(), 'cars_term')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  </div>
            <div class="section"> -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="auto_element-w-wr">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-xs-12">
                                    <div class="title_custom"><span class="line"><span>
                                <?php echo wpGlobusTranslatePost(get_the_ID(), 'cars_have_questions'); ?>
                            </span></span></div>
                                    <div class="text_f-top">

                                        <?php echo wpGlobusTranslatePost(get_the_ID(), 'cars_have_questions_more'); ?>
                                        <?php $phone = carbon_get_theme_option(  'phone' ); ?>
                                        <a href="tel:<?php echo $phone['0']['text']; ?>" class=""><?php echo $phone['0']['text']; ?></a>

                                    </div>
                                    <div class="form-inl">
                                        <!--<div class="form_top">
                                            <div class="elem-form">
                                                <div class="form_label">Введите ваше имя</div>
                                                <input type="text" class="input" placeholder="Введите Ваше имя...">
                                            </div>
                                            <div class="elem-form">
                                                <div class="form_label">Введите ваш телефон</div>
                                                <input type="text" class="input" placeholder="+ 38(0__) ___ ____">
                                            </div>
                                        </div>
                                        <div  class="elem-form">
                                            <div class="form_label">Введите текст сообщения</div>
                                            <textarea class="textarea" placeholder="Ваше сообщение..."></textarea>
                                        </div>
                                        <div class="form_top">
                                            <div  class="elem-form">
                                                <input type="submit" class="submit_btn" value="Отправить сообщение">
                                            </div>
                                            <div class="elem-form">
                                                <div class="text_f">
                                                    Нажимая кнопку «Отправить», вы подтверждаете согласие с нашей <a href="#">политикой конфиденциальности</a>
                                                </div>
                                            </div>
                                        </div>-->
                                        <?php echo do_shortcode('[contact-form-7 id="195" title="Страница машины_РУ"]');?>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-5 col-md-5 col-xs-12"> -->
                                <div class="images_fon-b">
                                    <img src="<?php echo bloginfo('template_url'); ?>/img/c_fon.png">
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--      </div>
            <div class="section"> -->
            <!-- <div class="container">
                 <div class="row">
                     <div class="col-xs-12">
                         <div class="title_section"><span class="line"><span>Альтернативы в классе Эконом</span></span></div>

                         <div class="auto-block-container">
                             <div class="auto-elems-block">
                                 <div class="auto-elem-bl">
                                     <div class="auto-elem">
                                         <div class="auto-elem-title">Ford Fiesta</div>

                                         <div class="auto-elem-img" style="background-image: url(img/auto1.png);"></div>
                                         <div class="auto-elem-cost">
                                             <span>от 685 грн.</span>
                                         </div>
                                         <a href="#" class="tr_btn el_btn">Забронировать авто</a>
                                     </div>
                                 </div>
                                 <div class="auto-elem-bl">
                                     <div class="auto-elem">
                                         <div class="auto-elem-title">Renault Logan II</div>
                                         <div class="auto-elem-img" style="background-image: url(img/auto2.png);"></div>
                                         <div class="auto-elem-cost">
                                             <span>от 685 грн.</span>
                                         </div>
                                         <a href="#" class="tr_btn el_btn">Забронировать авто</a>
                                     </div>
                                 </div>
                                 <div class="auto-elem-bl">
                                     <div class="auto-elem">
                                         <div class="auto-elem-title">Chevrolet Spark</div>
                                         <div class="auto-elem-img" style="background-image: url(img/auto3.png);"></div>
                                         <div class="auto-elem-cost">
                                             <span>от 685 грн.</span>
                                         </div>
                                         <a href="#" class="tr_btn el_btn">Забронировать авто</a>
                                     </div>
                                 </div>
                                 <div class="auto-elem-bl">
                                     <div class="auto-elem">
                                         <div class="auto-elem-title">Ford Fiesta</div>
                                         <div class="auto-elem-img" style="background-image: url(img/auto4.png);"></div>
                                         <div class="auto-elem-cost">
                                             <span>от 685 грн.</span>
                                         </div>
                                         <a href="#" class="tr_btn el_btn">Забронировать авто</a>
                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>-->
        </div>
    </main>

<?php
get_footer(); // подключаем подвал
?>