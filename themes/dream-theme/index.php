<?php

get_header('home');

?>
    <div class="section section_blog" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="title_section"><span class="line"><span>  <?php echo wp_globus_translate_array_string('Новини','Новости','News');?></span></span></div>
                </div>
            </div>
            <div class="row blog_elements">
                <?php
                // параметры по умолчанию
                $posts = get_posts( array(
                'numberposts' => 3,
                'category'    => 0,
                'orderby'     => 'post__in',
                'order'       => 'ASC',
                'include'     => array(),
                'exclude'     => array(),
                'meta_key'    => '',
                'meta_value'  =>'',
                'post_type'   => 'post',
                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) ); 
                foreach( $posts as $post ){
  setup_postdata( $post );?>


                <div class="col-lg-8 col-md-8 col-xs-12  blog_el article_f">
                    <div class="article_img" style="background-image: url(<?php echo get_the_post_thumbnail_url($post);?>);"></div>
                    <a href="<?php the_permalink(); ?>" class="article_title">
                     <?php the_title(); ?>
                    </a>
                    <div class="article_text" >
                        <p>
                            <?php echo $posts[0]->post_excerpt;?>
                            
                        </p>
                    </div>
                    <div class="article_btns clearfix">
                        <a href="<?php the_permalink(); ?>" class="article_more"> <?php echo wp_globus_translate_array_string('Детальніше','Подробнее','More details');?></a>
                        <div class="date">
                         <?php echo get_the_date('j F Y',$post)?>
                        </div>
                    </div>
                </div> 
                  <?php
}
wp_reset_postdata();
               ?>
            </div>
        </div>
    </div>
<?php
get_footer(); // подключаем подвал
?>