<?php
/**
* Template Name:  <?php echo wp_globus_translate_array_string('Контакти','Контакты','Contacts');?>
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
    				<div class="col-lg-6 col-md-6 col-xs-12">
    					<div class="block_contact-container">
    						<div class="title_custom"><span class="line"><span>
                             <?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_title'); ?>
    						</span></span></div>
    						<p>
    						 <?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_sub'); ?>
    						</p>
    						<?php $phone = carbon_get_theme_option(  'phone' ); ?>
    						<a href="tell:<?php echo $phone['0']['text']; ?>" class="tell_contact"><?php echo $phone['0']['text']; ?></a>
    						<div class="text_c-bottom"><?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_time'); ?></div>
    					</div>
    					<div class="block_contact-container">
    						<div class="title_custom"><span class="line"><span>
    							<?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_techikal'); ?></span></span></div>
    						<p>
    							<?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_techikal_sub'); ?>
    						</p>
    						<a href="tell:<?php echo $phone['0']['text']; ?>" class="tell_contact"><?php echo $phone['0']['text']; ?></a>
    						<div class="text_c-bottom">
								<?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_techikal_time'); ?>
    						</div>
    					</div>
    					<div class="block_contact-container">
    						<div class="title_custom"><span class="line"><span>
								<?php echo wpGlobusTranslatePost(get_the_ID(), 'contact_adress'); ?>
    						</span></span></div>
    						<div class="adress_b">

								<?php echo apply_filters('the_content', wpGlobusTranslatePost(get_the_ID(), 'contact_more')); ?>

    						</div>
							<div class="email_c"><span>E-mail:</span> <a href="mailto:<?php echo carbon_get_theme_option('email'); ?>"><?php echo carbon_get_theme_option('email'); ?></a></div>

    					</div>
    				</div>
    				<div class="col-lg-6 col-md-6 col-xs-12">
    					<div class="block_contact-container">
    						<div class="title_custom"><span class="line"><span> <?php echo wp_globus_translate_array_string('Написати нам','Написать нам ','Write to us');?></span></span></div>
    						<div class="form_contact">
    							<?php echo do_shortcode('[contact-form-7 id="137" title="На контактах"]');?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

<?php
get_footer(); // подключаем подвал
?>