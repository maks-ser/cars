<?php
/**
* Template Name: Бизнес
*/
get_header();
?>
    <div class="header_page" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs_container">
                        <div class="bredcrumb">
                            <?php breadcrumbs();?>
                        </div>            
                    </div>
                    <div class="page_title-pos">
                        <div class="page_title"><span class="line"><span><?php the_title();?></span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <main class="main">

        <div class="section_images">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="title_custom d-flex"><span class="line"><span>
                            <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_title'); ?>
                            <img  src="<?php echo carbon_get_theme_option('logo'); ?>" style="width: 250px;" alt="dreamscars" title="dreamscars"></span></span></div>
                        <div class="h2-title">
                        <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_sub'); ?>
                        </div>
                        <p>
                        <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_more'); ?>
                        </p>
                        <a href="#" class="tr_btn text_btn">

                         <?php echo wp_globus_translate_array_string('Подати заявку','Подать заявку','Apply');?></a>
                    </div>
                    <div class="col-lg-10 col-md-12 col-xs-12">
                        <div class="buis_icons-container">
                           <?php $banefits_business = carbon_get_post_meta(get_the_ID(), 'banefits_business');?>
                           <?php foreach ($banefits_business as $benefits_bus):?>
                            <div class="buis_icons-block">
                                <div class="buis_icons-img" style="background-image: url(<?php echo $benefits_bus['img'];?>);"></div>
                                <div class="buis_icons-text">
                                    <?php echo $benefits_bus[wp_globus_translate_array('title')]; ?>
                                </div>
                            </div>
                           <?php endforeach;?>
                        </div>
                    </div>
                   <!--  <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="img_b"><img src="img/auto.jpg"></div>
                    </div> -->
                </div>
            </div>
            <div class="img_b"><img src="<?php echo carbon_get_post_meta($post->ID, 'business_img');?>"></div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="title_custom"><span class="line"><span>
                            <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_why_title'); ?>
                            </span></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="h2-title">
                            <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_why_sub_first'); ?>                            
                        </div>
                        <ul class="number_list">
                            <?php $business_why_first = carbon_get_post_meta(get_the_ID(), 'business_why_first');?>
                            <?php foreach ($business_why_first as $key=>$business_w_f):?>
                            <li>
                                <span class="number_item">0<?php echo $key + 1; ?></span>
                                <span class="number_it-text">
                                    <?php echo $business_w_f[wp_globus_translate_array('title')]; ?>
                                </span>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="h2-title">
                            <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_why_sub_second'); ?>                            
                        </div>
                        <ul class="number_list">
                            <?php $business_why_second = carbon_get_post_meta(get_the_ID(), 'business_why_second');?>
                            <?php foreach ($business_why_second as $key=>$business_w_s):?>
                            <li>
                                <span class="number_item">0<?php echo $key + 1; ?></span>
                                <span class="number_it-text">
                                    <?php echo $business_w_s[wp_globus_translate_array('title')]; ?>
                                </span>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="section_f-d">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="title_slider t_l">
                            <span class="line"><span>
                            <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_all_title'); ?>   
                            </span></span>
                        </div>
                        <div class="all-container-position">
                            <div class="all-container">
                            <?php $business_all = carbon_get_post_meta(get_the_ID(), 'business_all');?>
                            <?php foreach ($business_all as $business_al):?>
                                <div class="all-element">
                                    <div class="all-elem">
                                        <div class="all_icon"><img src="<?php echo $business_al['img'];?>"></div>
                                        <div class="sl-title"><?php echo $business_al[wp_globus_translate_array('title')]; ?></div>
                                        <div class="sl-title_citat"><?php echo $business_al[wp_globus_translate_array('sub')]; ?></div>
                                        <div class="sl-text">
                                            <p>
                                               <?php echo $business_al[wp_globus_translate_array('description')]; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div> 
                    </div>
                
                </div>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="#" class="btn_main btn_bus">     <?php echo wp_globus_translate_array_string('Подати заявку','Подать заявку','Apply');?></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="reclam_element">
                            <div class="reclam_el-text">
                              <?php echo wpGlobusTranslatePost(get_the_ID(), 'business_contact_title'); ?>
                            </div>
                            <?php $phone = carbon_get_theme_option(  'phone' ); ?>
                            <a href="tell:<?php echo $phone['0']['text']; ?>" class="r-tell"><?php echo $phone['0']['text']; ?></a>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="title_custom"><span class="line"><span><?php echo wpGlobusTranslatePost(get_the_ID(), 'business_our_clients_title'); ?></span></span></div>
                        <div class="cl-container">
                        <?php $business_clients_img = carbon_get_post_meta(get_the_ID(), 'business_clients_img');
                         foreach ($business_clients_img as $business_c_i):?>
                            <div class="cl-el"><img src="<?php echo wp_get_attachment_image_src($business_c_i,'medium')[0]; ?>"></div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section_g">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    <?php the_content();?>
                    </div>
                </div>
            </div>
        </div>



        <!-- Load Cocoen library -->
  
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript">


        const swiperWhy = new Swiper('.swiper-w', {
            slidesPerView: 3,
            // centeredSlides: true,
            spaceBetween: 30,
            autoplay: {
            delay: 5000,
            },
            loop: true,
            // mousewheel: true,
            navigation: {
                nextEl: '.swiper-button-next.sw_w',
                prevEl: '.swiper-button-prev.sw_w',
            },
            breakpoints: {
                100: {
                slidesPerView: 1,
                // centeredSlides: false,
                spaceBetween: 30
                },
                768: {
                slidesPerView: 2,
                spaceBetween: 30
                },
                1200: {
                slidesPerView: 3,
                spaceBetween: 30
                }
            }
         
        });


        const swiperSert = new Swiper('.swiper-rew', {
            slidesPerView: 3,
            // centeredSlides: true,
            roundLengths:true,
            loop: true,
            // mousewheel: true,
            navigation: {
                nextEl: '.swiper-button-next.sw_k',
                prevEl: '.swiper-button-prev.sw_k',
            },
            // pagination: {
            //     el: '.swiper-pagin',
            //     clickable: true
            // },
            breakpoints: {
                100: {
                slidesPerView: 1,
                // centeredSlides: false,
                spaceBetween: 30
                },
                768: {
                slidesPerView: 2,
                spaceBetween: 30
                },
                1200: {
                slidesPerView: 3,
                spaceBetween: 30
                }
            }
        });





        var toggle = document.getElementById('toggle');
        var wrapper = document.getElementById('wrapper');
        var shadow = document.getElementById('shadow');
        var headTop = document.getElementById('headertop');
        if (toggle) {
            // var wrapTop;
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                // wrapTop = window.pageYOffset || document.documentElement.scrollTop;
                if(!(wrapper.classList.contains("on"))) {
                    wrapper.classList.add('on');
                    // wrapper.style.top =  '-' + wrapTop + 'px';
                }else{
                     wrapper.classList.remove('on');
                }
            }); 
        }




    </script>  

    <script type="text/javascript">
        var answer = document.getElementById('answer');
        

        if (answer) {
            var answerArray = answer.querySelectorAll('.faq_element');
            accordion(answerArray);
        }
        function accordion(accArray){
            for (var i = 0; i < accArray.length; i++) {
                accArray[i].addEventListener('click', function(e) {
               e.preventDefault();
                if(!(this.classList.contains("open"))) {
                    for (var j = 0; j < answerArray.length; j++) {
                        accArray[j].classList.remove('open');
                    }
                  this.classList.add('open');
                }
                else{ 
                  this.classList.remove('open');
                }
              }); // end click
            }
        }













        var menuHeaderTopItem = document.querySelectorAll('.nav__list .arrow_item ');
        var menuHeadTopIt = document.querySelectorAll('.nav__list > li > a');

        var TopItemMouseEnter = function(elem, arrayList) {
            if(!(elem.classList.contains("openes"))) {
                for (var i = 0; i < arrayList.length; i++) {
                    elem.classList.remove('openes');
                }
             
                elem.classList.add('openes');
            }
        }
        var TopItemMouseLeave =   function(elem) {
            if((elem.classList.contains("openes"))) {
                elem.classList.remove('openes');
            }}

           if ((window.innerWidth) >= '980'){

            for (var i = 0; i < menuHeaderTopItem.length; i++) {
                  let times;
                  let timesVis;
                menuHeaderTopItem[i].addEventListener('mouseenter', function(e){
                    clearTimeout(times);
                    timesVis = setTimeout(() => {
                            TopItemMouseEnter(this , menuHeaderTopItem);
                       }, 200);
                    
                });
                menuHeaderTopItem[i].addEventListener('mouseleave', function(e) {
                        clearTimeout(timesVis);
                        times = setTimeout(() => {
                            TopItemMouseLeave(this);
                       }, 200);
                }); // end 
            }

        }

        var menuHeadMobItem = document.querySelectorAll('.arrow_it-mob');
        if(menuHeadMobItem){
            for (var i = 0; i < menuHeadMobItem.length; i++) {
                menuHeadMobItem[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    if(!(this.classList.contains("opened"))) {
                        for (var j = 0; j < menuHeadMobItem.length; j++) {
                            menuHeadMobItem[j].classList.remove('opened');
                        }
                      this.classList.add('opened');
                    }
                    else{ 
                      this.classList.remove('opened');
                    }
              }); // end click
            }
        }


          document.addEventListener('click', e => {
            if (menuHeadMobItem) {
          
            if ( !e.target.closest(".drobd_block") ) {
                for (var j = 0; j < menuHeadMobItem.length; j++) {
                    menuHeadMobItem[j].classList.remove('opened');
                }
            }
            if ( !e.target.closest(".drobd_block")  &&   !e.target.closest(".toggle_block") ) {
                 wrapper.classList.remove('on');
             }
        }
       
            // const dateSelectOptions = Array.from(
       });


    </script>


<?php
get_footer(); // подключаем подвал
?>