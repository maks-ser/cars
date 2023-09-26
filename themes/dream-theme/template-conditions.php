<?php
/**
* Template Name: Условия проката
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
                <div class="pages_menu-container">
                    <?php wp_nav_menu( [
                    'container'       =>'',
                'items_wrap'      => '<ul class="pages_menu">%3$s</ul>',
                'theme_location'  => 'company'
                ] ); ?>
            </div>
        </div>
    </div>
</div>
</div>
<main class="main">
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-xs-12">
                <div class="block_contact-container">
                    <div class="title_custom"><span class="line"><span><?php echo wpGlobusTranslatePost(get_the_ID(), 'requirements_text'); ?></span></span></div>
                    
                    <div class="text_inl-block">
                        <?php echo apply_filters('the_content', wpGlobusTranslatePost(get_the_ID(), 'condition_text')); ?>
                    </div>
                </div>
                <div class="block_contact-container">
                    <div class="title_custom"><span class="line"><span><?php echo wpGlobusTranslatePost(get_the_ID(), 'condition_for_rent'); ?></span></span></div>
                    <ul class="info_list">
                        <?php $condition_for_rent_info = carbon_get_post_meta(get_the_ID(), 'condition_for_rent_info');?>
                        <?php foreach ($condition_for_rent_info as $condition_for_rent_i):?>
                        <li><?php echo $condition_for_rent_i[wp_globus_translate_array('title')]; ?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="block_btns-container">
                    <?php $condition_contract = carbon_get_post_meta(get_the_ID(), 'condition_contract');?>
                    <?php foreach ($condition_contract as $condition_c):?>
                    <div class="block_btn clearfix">
                        <div class="btn-d_text"><?php echo $condition_c[wp_globus_translate_array('title')]; ?></div>
                        <a href="<?php echo $condition_c['contract'];?>" class="donl tr_btn" target="_blang">  <?php echo wp_globus_translate_array_string('Завантажити','Cкачать','Download');?></a>
                    </div>
                    <?php endforeach;?>
                </div>
                <div class="block_contact-container">
                    <div class="title_custom"><span class="line"><span>
                        <?php echo wpGlobusTranslatePost(get_the_ID(), 'condition_have_questions'); ?>
                    </span></span></div>
                    <?php $phone = carbon_get_theme_option(  'phone' ); ?>
                    <a href="tell:<?php echo $phone['0']['text']; ?>" class="tell_contact"><?php echo $phone['0']['text']; ?></a>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-xs-12">
                <div class="block_contact-container">
                    <div class="title_custom"><span class="line"><span><?php echo wpGlobusTranslatePost(carbon_get_theme_option('match_home'),'good_know_text');?></span></span></div>
                    <div class="faq_element-container" id="answer">
                        <?php $good_know= carbon_get_post_meta(carbon_get_theme_option('match_home'),'good_know');?>
                        <div class="faq_element-container" id="answer">
                            <?php foreach ( $good_know as $good ): ?>
                            <div class="faq_element">
                                <div class="faq_element-head">
                                    <div class="faq_element-question">
                                        <?php echo $good[wp_globus_translate_array('text')]; ?>
                                    </div>
                                    <div class="faq_element-icon"></div>
                                </div>
                                <div class="faq_element-body">
                                    <div class="faq_element-answer">
                                        <p>
                                            <?php echo $good[wp_globus_translate_array('sub_text')]; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        var answer = document.getElementById('answer');
        var answerArray = answer.querySelectorAll('.faq_element');

        if (answer) {
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
    </script>
<?php
get_footer(); // подключаем подвал
?>