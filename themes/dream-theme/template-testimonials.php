<?php
/**
* Template Name: Отзывы
*/
get_header();
?>

        <div class="section section_sl-fon" >
          <div class="container testimonials">
              <div class="row">
     <div class="title_slider"><span class="line"><span>  <?php echo wp_globus_translate_array_string('Відгуки клієнтів','Отзывы клиентов','Reviews clients');?> </span></span></div>
                           <?php
                                $testimonias = get_posts([
                                'numberposts'      => -1,
                                'post_type'        => 'wpm-testimonial',
                                'suppress_filters' => true,
                                ]);
                                foreach($testimonias as $testimonia){
                                $meta = new stdClass;
                                foreach( (array) get_post_meta( $testimonia->ID ) as $k => $v ) $meta->$k = $v[0];
                                $rating =  $meta->rating;
                                ?>
                                <div class=" col-md-6">
                                    <div class="slide_elem">
                                        <div class="slider_rev-title">
                                            <?php echo $testimonia->post_title; ?>
                                        </div>
                                        <div class="star_container">
                                            <?php for ($i = 1; $i < 6; $i++):
                                            if($rating >= $i){
                                            echo ' <div class="star-icon star_activ"></div>';
                                            }else{
                                            echo ' <div class="star-icon "></div>';
                                            }
                                            endfor;?>
                                        </div>
                                        <div class="review_text">
                                            <p>
                                                <?php echo $testimonia->post_content;?>
                                            </p>
                                        </div>
                                        <div class="review_name"><?php echo $meta->client_name;?></div>
                                       
                                        
                                        
                                    </div>
                                </div>
                                <?php } ?>
              </div>
          </div>
      </div>

<?php
get_footer(); // подключаем подвал
?>