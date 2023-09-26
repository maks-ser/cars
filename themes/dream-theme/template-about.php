<?php
/**
 * Template Name: О нас
 */
get_header();
?>
<main>
    <section class="section-about-us-page">
        <div class="container">
            <div class="about-us-page-content">
                <?php
                the_content();
                ?>
            </div>
        </div>
    </section>


<?php
get_footer(); // подключаем подвал
?>