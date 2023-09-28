<?php
get_header();
$this_product_type = carbon_get_the_post_meta("product_type");
$user = get_userdata(get_current_user_id());
$user_role = $user->roles[0] ?? false;
$bonus = false;
$active = false;

if($user_role && $user_role == 'agent'){
    $active = carbon_get_user_meta($user->ID, 'user_active');

    if($active){
        $regular_price = carbon_get_the_post_meta('discount_value') ? : carbon_get_the_post_meta('sing_product_price');
        $categories = get_the_category();
        $in_way = [83, 81];
        $in_house = [1, 29];
        $bonus_percent = false;

        if($categories){
            foreach ($categories as $category) {
                if(in_array($category->term_id, $in_way)){
                    $bonus_percent = carbon_get_theme_option('percent_in_way');
                }

                if(in_array($category->term_id, $in_house)){
                    $bonus_percent = carbon_get_theme_option('percent_in_house');
                    break;
                }
            }
        }

        if($bonus_percent){
            $bonus = $regular_price * $bonus_percent / 100;

            $bonus = round($bonus,0);
        }
    }
}
?>
    <main>
        <section class="section-product">
            <div class="container">
                <div class="breadcrumbs-container">
                    <div class="breadcrumbs">
                        <?php breadcrumbs(); ?>
                    </div>
                    <div class="page-title-adaptive">
                        <?php the_title(); ?>
                    </div>
                </div>
                <?php var_dump($post); ?>
                <div class="product-content">
                    <?php $vin_code = carbon_get_the_post_meta("sing_product_vin"); ?>
                    <div class="card-column">
                        <div class="single-page-slider-container unselectable">
                            <div class="row single-page-slider">
                                <div class="col-2 slider-thumbnails-container">
                                    <div class="swiper-container product-thumbs">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $sing_product_img = carbon_get_the_post_meta('sing_product_img');
                                            foreach ($sing_product_img as $sing_product_i) {
                                                ?>
                                                <div class="swiper-slide">
                                                    <img src="<?php echo $sing_product_i['img']; ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="swiper-container product-slider">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $sing_product_img = carbon_get_the_post_meta('sing_product_img');
                                            foreach ($sing_product_img as $sing_product_i) {
                                                ?>
                                                <div class="swiper-slide">
                                                    <img src="<?php echo $sing_product_i['img']; ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="swiper-button-next">
                                            <i class="fa fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </div>

                                    </div>
                                    <div class="single-page-swiper-btns-container">
                                        <div class="single-page-swiper-prev-btn">
                                        </div>
                                        <div class="single-page-swiper-next-btn">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info-card mobile <?php echo carbon_get_the_post_meta("booking_status") === 1 || carbon_get_the_post_meta('sold_status') === 1 ? 'booked-box' : '' ?>">
                            <?php if($this_product_type !== 2) : ?>
                            <div class="product-info-table <?php echo carbon_get_the_post_meta("booking_status") === 1 ? 'booked' : '' ?>
<?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>">
<!--                                <div class="table-line">-->
<!--                                    <div class="line__title">-->
<!--                                        --><?php //echo pll__('Рік випуску:'); ?>
<!--                                    </div>-->
<!--                                    <div class="line__description">-->
<!--                                        --><?php //echo carbon_get_the_post_meta('sing_product_year'); ?>
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Стан:'); ?>
                                    </div>
                                    <div class="line__description">

                                        <?php
                                        $condition = carbon_get_theme_option('state');
                                        $current_condition = '';
                                        foreach ($condition as $value) {
                                            if ($value['alias'] == carbon_get_the_post_meta('state')) {
                                                $current_condition = $value['text'];
                                            }
                                        }
                                        echo pll__($current_condition);
                                        ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Пробіг, км:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_mileage'); ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Запас ходу, км:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_power_reserve'); ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Потужність, к.с.:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_power'); ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Комплектація:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_equipment'); ?>
                                    </div>
                                </div>

                                <?php if($vin_code) : ?>
                                    <div class="table-line">
                                        <div class="line__title">
                                            <?php echo pll__('VIN-код:'); ?>
                                        </div>
                                        <div class="line__description">
                                            <?php echo $vin_code; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="price-container <?php echo carbon_get_the_post_meta("booking_status") === 1 ? 'booked' : '' ?>
<?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>">
                                <div class="price">
                                    <?php
                                    $user = get_userdata(get_current_user_id());
                                    $user_role = $user->roles[0] ?? '';

                                    $price_key = carbon_get_user_meta($user->ID, 'user_price_group');
                                    if ($price_key) {
                                        $price_key = 'price_group_' . $price_key;
                                    }
                                    $role_price = carbon_get_the_post_meta($price_key);
                                    $group_price = get_current_price(get_the_ID());
                                    ?>
                                    <?php if (carbon_get_the_post_meta('sing_product_price')) { ?>
                                        <span class="think"><?php echo pll__('Роздріб:')?> &nbsp;</span>
                                        <span class="<?php echo carbon_get_the_post_meta('discount_value') ? 'old-price' : ''; ?>">
                                            <?php echo number_format(carbon_get_the_post_meta('sing_product_price'), 0, ',', ' ') ?>$
                                        </span>
                                        <?php if(carbon_get_the_post_meta('discount_value')) {
                                            echo '<br><span class="think">' . pll__('Акція:') . ' &nbsp;</span><span class="new-price">' . number_format(carbon_get_the_post_meta('discount_value'), 0, ',', ' ') . '$</span>';
                                        }
                                        ?>
                                        <?php if($bonus) { ?>
                                            <br>
                                            <div class="think"><?php echo pll__('Ваш бонус:') ?> &nbsp;</div>
                                            <?php echo $bonus . '$';
                                        }?>
                                    <?php } else { ?>
                                        <div class="no-price">
                                            <?php
                                            echo pll__('Ціна не вказана');
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="availability">
                                    <div class="availability-text">
                                        <?php
                                        $name_cat = get_the_category();
                                        echo $name_cat[0]->name;
                                        ?>
                                    </div>
                                    <?php $date_value = carbon_get_the_post_meta('sing_product_arriving_date');
                                    if (!function_exists('get_month_name')) {
                                        function get_month_name($month_number)
                                        {
                                            $month_names = array(
                                                1 => 'січня',
                                                2 => 'лютого',
                                                3 => 'березня',
                                                4 => 'квітня',
                                                5 => 'травня',
                                                6 => 'червня',
                                                7 => 'липня',
                                                8 => 'серпня',
                                                9 => 'вересня',
                                                10 => 'жовтня',
                                                11 => 'листопада',
                                                12 => 'грудня'
                                            );

                                            $last_digit = $month_number % 10;

                                            if ($month_number >= 11 && $month_number <= 14) {
                                                return $month_names[$month_number];
                                            } elseif ($last_digit == 1) {
                                                return str_replace('а', 'я', $month_names[$month_number]);
                                            } elseif ($last_digit >= 2 && $last_digit <= 4) {
                                                return str_replace('а', 'і', $month_names[$month_number]);
                                            } else {
                                                return $month_names[$month_number];
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if($date_value) :
                                        $date_obj = DateTime::createFromFormat('d.m.y', $date_value);
                                        $month_number = (int)$date_obj->format('m');
                                        $month_name = get_month_name($month_number);
                                        $date_str_ukr = $date_obj->format('j ') . pll__($month_name); ?>
                                        <div class="arriving-date">
                                                    <span>
                                                        <?php echo pll__('Очікується:'); ?>
                                                    </span>
                                            <span>
                                                        <?php echo $date_str_ukr; ?>
                                                    </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="main-button <?php echo carbon_get_the_post_meta("booking_status") === 1 ? 'booked' : '' ?>
<?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>">
                                <a <?php echo carbon_get_the_post_meta('booking_status') !== 1 ? 'data-toggle="modal" data-target="#buy-modal"' : ''; ?>
                                    class="buy-modal-btn <?php echo carbon_get_the_post_meta('booking_status') === 1 ? 'booked' : ''; ?>"
                                    <?php echo carbon_get_the_post_meta('booking_status') === 1 ? 'disabled' : ''; ?>
                                    <?php echo carbon_get_the_post_meta('booking_status') === 1 ? '' : 'href="#"'; ?>
                                    data-title="<?php the_title(); ?>"
                                    <?php if($vin_code) { ?>
                                        data-vin="<?php echo $vin_code; ?>"
                                    <?php } ?>
                                    <?php if(carbon_get_the_post_meta('sing_product_equipment')) { ?>
                                        data-equipment="<?php echo carbon_get_the_post_meta('sing_product_equipment'); ?>"
                                    <?php } ?>
                                >
                                    <?php echo carbon_get_the_post_meta('product_type') === 2 ? pll__('Придбати') : pll__('Придбати авто'); ?></a>
                            </div>
                </div>
                        <div class="description-block">
                            <div class="description-block-tabs">
                                <div class="column-title active">
                                    <?php echo pll__('Характеристика'); ?>
                                </div>
                                <?php if($this_product_type !== 2) : ?>
                                    <div class="column-title">
                                        <?php echo pll__('Комплектація:'); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <!-- /.description-block-tabs -->

                            <div class="description-column">
                                <div class="description">
                                    <?php echo carbon_get_the_post_meta('sing_product_description'); ?>
                                </div>
                                <?php
                                    function getDataForTable($theme_option_value) {
                                        $th_option = carbon_get_theme_option($theme_option_value);
                                        $current_item = '';
                                        foreach ($th_option as $value) {
                                            if ($value['alias'] == carbon_get_the_post_meta($theme_option_value)) {
                                                $current_item = $value['text'];
                                            }
                                        }
                                        echo pll__($current_item);
                                    }

                                function getMultiselectForTable($theme_option_value, $callback) {
                                    $all_options = $callback();
                                    $available_on = carbon_get_the_post_meta($theme_option_value);
                                    foreach ( $available_on as $key=>$option_key ) {
                                        $result = $all_options[$option_key];
                                        echo pll__($key + 1 !== count($available_on) ? $result . ", " : $result);
                                    }
                                }

                                ?>
                                <?php if($this_product_type === 1) : ?>
                                    <div class="table active">
                                        <figure>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo pll__('Марка авто:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $brand = carbon_get_theme_option('brand');
                                                            $current_brand = '';
                                                            foreach ($brand as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('brand')) {
                                                                    $current_brand = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_brand);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Модель авто:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $model = carbon_get_theme_option('model');
                                                            $current_model = '';
                                                            foreach ($model as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('model')) {
                                                                    $current_model = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_model);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Комплектація:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_equipment'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Рік випуску:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_year'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Тип кузова:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $body_type = carbon_get_theme_option('body_type');
                                                            $current_body_type = '';
                                                            foreach ($body_type as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('body_type')) {
                                                                    $current_body_type = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_body_type);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Колір кузова:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_body_color'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Колір салону:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_interior_color'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Обшивка салону:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $sheathing = carbon_get_theme_option('sheathing');
                                                            $current_sheathing = '';
                                                            foreach ($sheathing as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('sheathing')) {
                                                                    $current_sheathing = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_sheathing);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Тип двигуна:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $fuel = carbon_get_theme_option('fuel');
                                                            $current_fuel = '';
                                                            foreach ($fuel as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('fuel')) {
                                                                    $current_fuel = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_fuel);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Тип приводу:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $drive = carbon_get_theme_option('drive');
                                                            $current_drive = '';
                                                            foreach ($drive as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('drive')) {
                                                                    $current_drive = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_drive);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Запас ходу від виробника, км:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_power_reserve'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Коробка передач:'); ?></td>
                                                    <td>
                                                        <strong>
                                                            <?php getDataForTable("gearbox"); ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Місткість батареї, кВт:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_battery_capacity'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Потужність, к.с.:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_power'); ?></strong>
                                                    </td>
                                                </tr>
                                                <!--                                            <tr>-->
                                                <!--                                                <td>-->
                                                <?php //echo pll__('Розгін до 100 км, сек:'); ?><!--</td>-->
                                                <!--                                                <td>-->
                                                <!--                                                    <strong>-->
                                                <?php //echo carbon_get_the_post_meta('sing_product_dispersal'); ?><!--</strong>-->
                                                <!--                                                </td>-->
                                                <!--                                            </tr>-->
                                                <tr>
                                                    <td><?php echo pll__('Макс, швидкість, км/г:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_max_speed'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Пробіг км:'); ?></td>
                                                    <td>
                                                        <strong><?php echo carbon_get_the_post_meta('sing_product_mileage'); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Стан:'); ?></td>
                                                    <td>
                                                        <strong>
                                                            <?php
                                                            $condition = carbon_get_theme_option('state');
                                                            $current_condition = '';
                                                            foreach ($condition as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('state')) {
                                                                    $current_condition = $value['text'];
                                                                }
                                                            }
                                                            echo pll__(trim($current_condition));

                                                            ?>

                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Ушкодження:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $damage = carbon_get_theme_option('damage');
                                                            $current_damage = '';
                                                            foreach ($damage as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('damage')) {
                                                                    $current_damage = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_damage);
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo pll__('Панорамний дах:'); ?></td>
                                                    <td>
                                                        <strong><?php
                                                            $roof = carbon_get_theme_option('roof');
                                                            $current_roof = '';
                                                            foreach ($roof as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('roof')) {
                                                                    $current_roof = $value['text'];
                                                                }
                                                            }
                                                            echo pll__(trim($current_roof));
                                                            ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php echo pll__('Зарядний пристрій:'); ?>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                            <?php $charge = carbon_get_theme_option('charge');
                                                            $current_charge = '';
                                                            foreach ($charge as $value) {
                                                                if ($value['alias'] == carbon_get_the_post_meta('charge')) {
                                                                    $current_charge = $value['text'];
                                                                }
                                                            }
                                                            echo pll__($current_charge); ?>
                                                        </strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?php echo pll__('Габарити авто (Д*Ш*В), см:'); ?>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                            <?php echo carbon_get_the_post_meta("sing_product_dimensions")?>
                                                        </strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?php echo pll__('Вага:'); ?>
                                                    </td>
                                                    <td>
                                                        <strong>
    <!--                                                        --><?php //$weight = carbon_get_theme_option('weight');
    //                                                        $current_weight = '';
    //                                                        foreach ($weight as $value) {
    //                                                            if ($value['alias'] == carbon_get_the_post_meta('weight')) {
    //                                                                $current_weight = $value['text'];
    //                                                            }
    //                                                        }
    //                                                        echo pll__($current_weight); ?>
                                                            <?php echo carbon_get_the_post_meta("weight")?>

                                                            кг
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <!--                                            <tr>-->
                                                <!--                                                <td>-->
                                                <?php //echo pll__('Автопілот:'); ?><!--</td>-->
                                                <!--                                                <td>-->
                                                <!--                                                    <strong>-->
                                                <?php //echo carbon_get_the_post_meta('sing_product_autopilot'); ?><!--</strong>-->
                                                <!--                                                </td>-->
                                                <!--                                            </tr>-->
                                                <!--                                            <tr>-->
                                                <!--                                                <td>-->
                                                <?php //echo pll__('Клас авто:'); ?><!--</td>-->
                                                <!--                                                <td>-->
                                                <!--                                                    <strong>--><?php
                                                //                                                        $class = carbon_get_theme_option('class');
                                                //                                                        $current_class = '';
                                                //                                                        foreach ($class as $value) {
                                                //                                                            if($value['alias'] == carbon_get_the_post_meta('class')){
                                                //                                                                $current_class = $value['text'];
                                                //                                                            }
                                                //                                                        }
                                                //                                                        echo $current_class;
                                                //                                                        ?><!--</strong>-->
                                                <!--                                                </td>-->
                                                <!--                                            </tr>-->
                                                <!--                                            <tr>-->
                                                <!--                                                <td>-->
                                                <?php //echo pll__('Пригнаний з:'); ?><!--</td>-->
                                                <!--                                                <td>-->
                                                <!--                                                    <strong>-->
                                                <?php //echo carbon_get_the_post_meta('sing_product_driven'); ?><!--</strong>-->
                                                <!--                                                </td>-->
                                                <!--                                            </tr>-->
                                                <!--                                            <tr>-->
                                                <!--                                                <td>-->
                                                <?php //echo pll__('VIN:'); ?><!--</td>-->
                                                <!--                                                <td>-->
                                                <!--                                                    <strong>-->
                                                <?php //echo carbon_get_the_post_meta('sing_product_vin'); ?><!--</strong>-->
                                                <!--                                                </td>-->
                                                <!--                                            </tr>-->
                                                </tbody>
                                            </table>
                                        </figure>
                                    </div>
                                    <div class="table">
                                        <figure>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo pll__('Технічний стан авто:'); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("tech_condition"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__('Стан лакофарбового покриття:'); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("lacq_coating"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__('Електросклопідйомники:'); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("el_window_lifters"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
    <!--                                                <tr>-->
    <!--                                                    <td>--><?php //echo pll__('Коробка передач:'); ?><!--</td>-->
    <!--                                                    <td>-->
    <!--                                                        <strong>-->
    <!--                                                            --><?php //getDataForTable("gearbox"); ?>
    <!--                                                        </strong>-->
    <!--                                                    </td>-->
    <!--                                                </tr>-->

                                                    <tr>
                                                        <td><?php echo pll__("Підсилювач керма:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("power_steering"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Кондиціонер:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("air_conditioning"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Регулювання сидінь:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("seat_adjustment"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Пам'ять положення сидінь:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("seat_position_memory"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Підігрів сидінь:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("heated_seats"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Вентиляція сидінь:"); ?></td>
                                                        <td>
                                                            <strong>
                                                               <?php getDataForTable("seat_ventilation"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Фари:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("headlights"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Запаска:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("spare"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Розмір дисків:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getDataForTable("disk_size"); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Швидкість заряду від 0% до 100%, годин:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php echo carbon_get_the_post_meta("charge_speed")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Оптика:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("optics", "get_optics")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Мультимедіа:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("multimedia", "get_multimedia")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Салон та комфорт:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("comfort", "get_comfort")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Подушки безпеки:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("airbags", "get_airbags")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Система допомоги паркування:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("parking_help", "get_parking_help")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Електронні системи безпеки:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("electro_save", "get_electro_save")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Кузов:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("bodywork", "get_bodywork")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo pll__("Безпека:"); ?></td>
                                                        <td>
                                                            <strong>
                                                                <?php getMultiselectForTable("safety", "get_safety")?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </figure>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="product-info-card-column">
                        <div class="product-info-card <?php echo carbon_get_the_post_meta("booking_status") === 1 || carbon_get_the_post_meta("sold_status") === 1 ? 'booked-box' : '' ?> <?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>">
                            <div class="title">
                                <?php
                                the_title();
                                ?>
                            </div>
                            <?php if($this_product_type !== 2) : ?>
                            <div class="product-info-table <?php echo carbon_get_the_post_meta("booking_status") === 1 ? 'booked' : '' ?><?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>">
<!--                                <div class="table-line">-->
<!--                                    <div class="line__title">-->
<!--                                        --><?php //echo pll__('Рік випуску:'); ?>
<!--                                    </div>-->
<!--                                    <div class="line__description">-->
<!--                                        --><?php //echo carbon_get_the_post_meta('sing_product_year'); ?>
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Стан:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php
                                        $condition = carbon_get_theme_option('state');
                                        $current_condition = '';
                                        foreach ($condition as $value) {
                                            if ($value['alias'] == carbon_get_the_post_meta('state')) {
                                                $current_condition = $value['text'];
                                            }
                                        }
                                        echo pll__(trim($current_condition));
                                        ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Пробіг, км:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_mileage'); ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Запас ходу, км:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_power_reserve'); ?>
                                    </div>
                                </div>

                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Потужність, к.с.:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_power'); ?>
                                    </div>
                                </div>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('Комплектація:'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo carbon_get_the_post_meta('sing_product_equipment'); ?>
                                    </div>
                                </div>
                                <?php if($vin_code) : ?>
                                <div class="table-line">
                                    <div class="line__title">
                                        <?php echo pll__('VIN-код'); ?>
                                    </div>
                                    <div class="line__description">
                                        <?php echo $vin_code; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="price-container <?php echo carbon_get_the_post_meta("booking_status") === 1 ? 'booked' : '' ?>
                            <?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>">
                                <div class="price">
                                    <?php if (carbon_get_the_post_meta('sing_product_price')) { ?>
                                        <span class="think"><?php echo pll__('Роздріб:')?> &nbsp;</span>
                                        <span class="<?php echo carbon_get_the_post_meta('discount_value') ? 'old-price' : ''; ?>">
                                            <?php echo number_format(carbon_get_the_post_meta('sing_product_price'), 0, ',', ' ') ?>$
                                        </span>
                                        <?php if(carbon_get_the_post_meta('discount_value')) {
                                            echo '<br><span class="think">' . pll__('Акція:') . ' &nbsp;</span><span class="new-price">' . number_format(carbon_get_the_post_meta('discount_value'), 0, ',', ' ') . '$</span>';
                                        }
                                        ?>
                                        <?php if($bonus) { ?>
                                            <br>
                                            <div class="think"><?php echo pll__('Ваш бонус:') ?>&nbsp;</div>
                                            <?php echo $bonus . '$';
                                        }
                                    } else { ?>
                                    <div class="no-price">
                                        <?php
                                        echo pll__('Ціна не вказана');
                                        ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="availability">
                                    <?php if(carbon_get_the_post_meta('booking_status') !== 1 && carbon_get_the_post_meta('sold_status') !== 1) : ?>
                                    <div class="availability-text">
                                        <?php
                                        $name_cat = get_the_category();
                                        echo $name_cat[0]->name;
                                        ?>
                                    </div>
                                    <?php /* if (carbon_get_the_post_meta('sing_product_availability')) { ?>
                                        <div class="availability-text">
                                            <?php echo pll__('В наявності'); ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="availability-text no">
                                            <?php echo pll__('Немає в наявності'); ?>
                                        </div>
                                    <?php } */ ?>
                                    <?php endif; ?>
                                    <?php $date_value = carbon_get_the_post_meta('sing_product_arriving_date');
                                    if (!function_exists('get_month_name')) {
                                        function get_month_name($month_number)
                                        {
                                            $month_names = array(
                                                1 => 'січня',
                                                2 => 'лютого',
                                                3 => 'березня',
                                                4 => 'квітня',
                                                5 => 'травня',
                                                6 => 'червня',
                                                7 => 'липня',
                                                8 => 'серпня',
                                                9 => 'вересня',
                                                10 => 'жовтня',
                                                11 => 'листопада',
                                                12 => 'грудня'
                                            );
                                        }
                                    }
                                    ?>
                                    <?php if($date_value && carbon_get_the_post_meta('booking_status') !== 1 && carbon_get_the_post_meta('sold_status') !== 1) :
                                        $date_obj = DateTime::createFromFormat('d.m.y', $date_value);
                                        $month_number = (int)$date_obj->format('m');
                                        $month_name = get_month_name($month_number);
                                        $date_str_ukr = $date_obj->format('j ') . pll__($month_name); ?>
                                        <div class="arriving-date">
                                                    <span>
                                                        <?php echo pll__('Очікується:'); ?>
                                                    </span>
                                            <span>
                                                        <?php echo $date_str_ukr; ?>
                                                    </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="main-button">
                                <a <?php echo carbon_get_the_post_meta('booking_status') !== 1 || carbon_get_the_post_meta('sold_status') !== 1 ? 'data-toggle="modal" data-target="#buy-modal"' : ''; ?>
                                    class="buy-modal-btn <?php echo carbon_get_the_post_meta('booking_status') === 1 ? 'booked' : ''; ?>
<?= carbon_get_the_post_meta('sold_status') === 1 ? 'sold' : ''; ?>"
                                    <?php echo carbon_get_the_post_meta('booking_status') === 1 ? 'disabled' : ''; ?>
                                    <?php echo carbon_get_the_post_meta('booking_status') === 1 ? '' : 'href="#"'; ?>
                                    data-title="<?php the_title(); ?>"
                                    <?php if($vin_code) { ?>
                                        data-vin="<?php echo $vin_code; ?>"
                                    <?php } ?>
                                    <?php if(carbon_get_the_post_meta('sing_product_equipment')) { ?>
                                        data-equipment="<?php echo carbon_get_the_post_meta('sing_product_equipment'); ?>"
                                    <?php } ?>
                                >
                                    <?php echo carbon_get_the_post_meta('product_type') === 2 ? pll__('Придбати') : pll__('Придбати авто'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $related = carbon_get_the_post_meta('related');

        if ($related) {
            ?>
            <div class="container">
                <h2><?php echo pll__('Другие машины'); ?></h2>
            </div>
            <section class="section-main-slider related">


                <div class="container">


                    <!-- slider main container -->
                    <div class="home-swiper-container">
                        <!-- additional required wrapper -->
                        <div class="swiper-wrapper home-swiper-wrapper">

                            <!-- slides -->
                            <!-------------------------- SLIDE ---------------------------->
                            <?php


                            foreach ($related as $value) {
                                $related_post = get_post($value['match_home']);
                                $sing_product_img = carbon_get_post_meta($related_post->ID, 'sing_product_img');
                                ?>
                                <div class="main-slider__slide swiper-slide">
                                    <div class="top-part">
                                        <div class="image"
                                             style="background-image: url(<?php echo $sing_product_img[0]['img']; ?>)"></div>
                                        <div class="title">
                                            <a href="<?php echo get_post_permalink($value->ID); ?>">
                                                <?php echo $related_post->post_title; ?>
                                            </a>
                                        </div>
                                        <div class="price-container">
                                            <div class="price">
                                                <?php
                                                $group_price = get_current_price($related_post->ID);
                                                $group_price = false;
                                                if($group_price): ?>
                                                    <div class="think"><?php echo pll__('Роздріб:')?></div>
                                                    <?php echo number_format(carbon_get_the_post_meta('sing_product_price'), 0, ',', ' ');
                                                    echo '$';?>
                                                <br>
                                                    <div class="think"><?php echo pll__('Ваша ціна:') ?></div>
                                                    <?php echo number_format($group_price, 0, ',', ' ') . '$'; ?>
                                                <?php else: ?>
                                                <?php if (carbon_get_the_post_meta('sing_product_price')) { ?>
                                                        <span class="<?php echo carbon_get_the_post_meta('discount_value') ? 'old-price' : ''; ?>">
                                                            <?php echo number_format(carbon_get_the_post_meta('sing_product_price'), 0, ',', ' ') ?>$
                                                        </span>
                                                        <?php
                                                        if(carbon_get_the_post_meta('discount_value')) {
                                                            echo '<span>' . pll__('Акція:') . ' </span><span class="new-price">' . number_format(carbon_get_the_post_meta('discount_value'), 0, ',', ' ') . '$</span>';
                                                        }
                                                    } else{ ?>
                                                <div class="no-price">
                                                    <?php echo pll__('Ціна не вказана'); ?>
                                                </div>
                                                    <?php } ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(carbon_get_the_post_meta('booking_status') !== 1 && carbon_get_the_post_meta('sold_status') !== 1) : ?>
                                            <div class="availability">
                                                <div class="availability-text">

                                                    <?php
                                                    $name_cat = get_the_category();
                                                    echo $name_cat[0]->name;
                                                    ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!--                                    <div class="center-part">-->
                                    <!--                                        <div class="product-info-table">-->
                                    <!--                                            <div class="table-line">-->
                                    <!--                                                <div class="line__title">-->
                                    <!--                                                    --><?php //echo pll__('Рік випуску:'); ?>
                                    <!--                                                </div>-->
                                    <!--                                                <div class="line__description">-->
                                    <!--                                                    --><?php //echo carbon_get_post_meta($related_post->ID, 'sing_product_year'); ?>
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="table-line">-->
                                    <!--                                                <div class="line__title">-->
                                    <!--                                                    --><?php //echo pll__('Стан:'); ?>
                                    <!--                                                </div>-->
                                    <!--                                                <div class="line__description">-->
                                    <!--                                                    --><?php //echo carbon_get_post_meta($related_post->ID, 'sing_product_condition'); ?>
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="table-line">-->
                                    <!--                                                <div class="line__title">-->
                                    <!--                                                    --><?php //echo pll__('Пробіг, км:'); ?>
                                    <!--                                                </div>-->
                                    <!--                                                <div class="line__description">-->
                                    <!--                                                    --><?php //echo carbon_get_post_meta($related_post->ID, 'sing_product_mileage'); ?>
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="table-line">-->
                                    <!--                                                <div class="line__title">-->
                                    <!--                                                    --><?php //echo pll__('Запас ходу, км:'); ?>
                                    <!--                                                </div>-->
                                    <!--                                                <div class="line__description">-->
                                    <!--                                                    --><?php //echo carbon_get_post_meta($related_post->ID, 'sing_product_power_reserve'); ?>
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="table-line">-->
                                    <!--                                                <div class="line__title">-->
                                    <!--                                                    --><?php //echo pll__('Тип приводу:'); ?>
                                    <!--                                                </div>-->
                                    <!--                                                <div class="line__description">-->
                                    <!--                                                    --><?php //echo carbon_get_post_meta($related_post->ID, 'sing_product_type_of_drive'); ?>
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="table-line">-->
                                    <!--                                                <div class="line__title">-->
                                    <!--                                                    --><?php //echo pll__('Потужність, к.с.:'); ?>
                                    <!--                                                </div>-->
                                    <!--                                                <div class="line__description">-->
                                    <!--                                                    --><?php //echo carbon_get_post_meta($related_post->ID, 'sing_product_power'); ?>
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <div class="bottom-part">
                                        <div class="main-button">
                                            <a <?php echo carbon_get_the_post_meta('booking_status') !== 1 ? 'data-toggle="modal" data-target="#buy-modal"' : ''; ?>
                                                class="buy-modal-btn <?php echo carbon_get_the_post_meta('booking_status') === 1 ? 'booked' : ''; ?>"
                                                <?php echo carbon_get_the_post_meta('booking_status') === 1 ? 'disabled' : ''; ?>
                                                <?php echo carbon_get_the_post_meta('booking_status') === 1 ? '' : 'href="#"'; ?>
                                                data-title="<?php the_title(); ?>"
                                                <?php if($vin_code) { ?>
                                                    data-vin="<?php echo carbon_get_the_post_meta("sing_product_vin")?>"
                                                <?php } ?>
                                                <?php if(carbon_get_the_post_meta('sing_product_equipment')) { ?>
                                                    data-equipment="<?php echo carbon_get_the_post_meta('sing_product_equipment'); ?>"
                                                <?php } ?>
                                            >
                                                <?php echo carbon_get_the_post_meta('product_type') === 2 ? pll__('Придбати') : pll__('Придбати авто'); ?></a>
                                        </div>
                                        <div class="button-see-more">
                                            <a href="<?php echo get_post_permalink($related_post->ID); ?>"><?php echo pll__('Детальніше про авто'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!------------------------------------------------------------->
                        </div>
                        <!-- navigation buttons -->
                        <div class="main-slider__btn-container">
                            <div class="main-slider__button-prev"></div>
                            <div class="main-slider__button-next"></div>
                        </div>


                    </div>
                </div>
            </section>
        <?php } ?>
    </main>
<?php
get_footer(); // подключаем подвал
?>