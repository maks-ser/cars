<?php
get_header();
$cat_parent = 1;
$args = array(
    'type' => 'post',
    'child_of' => 0,
    // 'parent' => $cat_parent,
);
$categories = get_categories($args);
$category = get_queried_object();
$currency = getCurrency();

$filters = [];
$query = [];

$post_price = '';
$post_status = false;
$user = get_userdata(get_current_user_id());
$user_role = $user->roles[0] ?? '';

$group_key = '';

if($user_role === 'customer') {
    $group_key = carbon_get_user_meta($user->ID, 'user_price_group');
    if ($group_key) {
        $group_key = 'price_group_' . $group_key;
    }
}

$enabled_filters = [
    'product_type',
    'discount',
    'sold_status',
    'brand',
    'model',
    // 'availability',
    'state',
    'damage',
    'body_type',
    'fuel',
    'drive',
    'sheathing',
    'roof',
    'class',
    'price',
];

if (isset($_GET)) {
    $query_flag = true;

    foreach ($enabled_filters as $item) {
        if (isset($_GET[$item]) && $item != 'sold_status') {
            if ($query_flag == true) {
                $query = [
                    'relation' => 'AND',
                ];
                $query_flag = false;
            }

            $query[] = [
                'key' => $item,
                'value' => $_GET[$item],
            ];
        }
    }

    if(isset($_GET['sold_status'])) {
        $query[] = [
            'key' => 'sold_status',
            'value' => '1',
            'compare' => '!=',
        ];
    }

    if($group_key){
        $key = $group_key;
    } else {
        $key = 'sing_product_price';
    }

    if (isset($_GET['price_min']) && $_GET['price_min'] != '') {
        $price_min = $_GET['price_min'];
        $price_max = $_GET['price_max'];
        $query[] = [
            'key' =>  $key,
            'value' => [$price_min, $price_max],
            'compare' => 'BETWEEN',
            'type' => 'numeric'
        ];
    }


}

$posts = get_posts(array(
    'category' => $category->term_id,
    'meta_query' => $query,
    'numberposts' => -1,
));

foreach ($posts as $post) {
    foreach ($enabled_filters as $item) {
        if (carbon_get_post_meta($post->ID, $item)) {

            $volume = carbon_get_theme_option(str_replace('fuel_type', 'fuel', $item));

            $alias = carbon_get_post_meta($post->ID, $item);

            $volume = (_getParam($volume, $alias));

            if ($item != 'volume') {
                $filters[$item][$alias] = $volume['text'];
            } else {
                $filters[$item][$alias] = $volume['text'];
            }
        }
    }
}
$pagination_items = paginate_links([
    'type' => 'array'
]);


$posts_prices = get_posts([
    'numberposts' => -1,
    'category' => $category->term_id,
]);
if($group_key){
    $key = $group_key;
} else {
    $key = 'sing_product_price';
}
if ($posts_prices) {
    foreach ($posts_prices as $post_price) {
        if(carbon_get_post_meta($post_price->ID, $key)){
            $prices[carbon_get_post_meta($post_price->ID, $key)] = carbon_get_post_meta($post_price->ID, $key);
        } else{
            $prices[carbon_get_post_meta($post_price->ID, 'sing_product_price')] = carbon_get_post_meta($post_price->ID, 'sing_product_price');
        }
    }
} else {
    $prices = [];
}

$translate = [
    'ua' => [
        'product_type' => 'Тип товару',
        'discount' => 'Акції',
        'sold_status' => 'Сховати продані',
        'brand' => 'Марка',
        'model' => 'Модель',
        'availability' => 'Наявність',
        'state' => 'Стан',
        'damage' => 'Ушкодження',
        'body_type' => 'Тип кузова',
        'fuel' => 'Тип двигуна',
        'drive' => 'Тип привода',
        'sheathing' => 'Обшивка',
        'roof' => 'Панорама',
        'class' => 'Клас машини',

    ],
    'ru' => [
        'product_type' => 'Тип товара',
        'discount' => 'Акции',
        'sold_status' => 'Спрятать проданные',
        'brand' => 'Марка',
        'model' => 'Модель',
        'availability' => 'Наличие',
        'state' => 'Состояние',
        'damage' => 'Повреждения',
        'body_type' => 'Тип кузова',
        'fuel' => 'Тип двигателя',
        'drive' => 'Тип привода',
        'sheathing' => 'Обшивка',
        'roof' => 'Панорама',
        'class' => 'Класс машины',
    ]
];
?>
    <!--    <div class="col-lg-3 col-md-5 col-xs-12 aside-wr" id="aside_l">-->
    <!---->
    <!--    </div>-->

    <main class="main-catalog">
    <section class="section-catalog">
        <div class="container">
            <div class="breadcrumbs-container">
                <div class="breadcrumbs">

                    <?php

                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $limit = 25;
                    $offset = ($paged - 1) * $limit;
                    ?>
                    <?php
                    breadcrumbs(); ?>
                </div>
                <div class="page-title-adaptive">


                    <?php echo $term_title = single_term_title('', 0);

                    ?>

                </div>
            </div>
            <div class="catalog-content">
                <div class="sidebar">
                    <div class="aside-wrapper">
                        <div class="filter-column__title">
                            <?php echo pll__('Фільтр параметрів'); ?>
                        </div>
                        <div class="filter-body">

                            <div class="w-block">
                                <div class="title_custom"><span class="line"><span>
                                            <?php echo pll__('Ціна, USD'); ?>
                                            </span></span></div>
                                <div class="slider-price">
                                    <div class="flex">
                                        <?php echo pll__('від'); ?> <span class="from"></span>
                                    </div>
                                    <div class="flex">
                                        <?php echo pll__('до'); ?> <span class="while"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="pricemin"
                                       id="pricemin"<?php if (isset($price_min)) echo "value=\"{$price_min}\""; ?>>
                                <input type="hidden" name="pricemax"
                                       id="pricemax"<?php if (isset($price_max)) echo "value=\"{$price_max}\""; ?>>
                                <div id="slider-range" style="width: 100%"></div>
                            </div>
                            <?php
                            foreach ($filters as $key => $filter):
                                $i = 1; ?>
<!--                   m_admin            <div class="w-block --><?php //echo $key === 'discount' ? 'active' : ''?><!--">-->
                                <div class="w-block">
                                    <div class="title_custom">
                                        <span class="line">
                                            <span>
                                                <?php echo $translate[pll_current_language()][$key]; ?>:
                                            </span>
                                        </span>
                                    </div>
                                    <div class="check-elem-list">
                                        <?php foreach ($filter as $k => $item): ?>
                                            <?php if($key === 'discount') {
                                                if($k === 2) continue;
                                            } else if($key === 'sold_status' && $k === 1) continue;
                                            ?>
                                            <div class="checkbox-elem-wrapper <?php echo (isset($_GET[$key]) && $_GET[$key] == $k) ? 'opens' : ''; ?>">
                                                <div class="checkbox-elem">
                                                    <input
                                                            id="<?php echo $key . $i; ?>"
                                                            data-id="<?php echo $key; ?>"
                                                            class="checkbox"
                                                            type="checkbox"
                                                            value="<?php echo $k; ?>"
                                                            onchange="filter('<?php echo $key; ?>', '<?php echo $k; ?>')"
                                                        <?php echo (isset($_GET[$key]) && $_GET[$key] == $k) ? 'checked' : ''; ?>
                                                    >
                                                    <label for="<?php echo $key . $i; ?>"></label>
                                                </div>
                                                <div class="checkbox-label">

                                                    <?php
                                                    if($key === 'sold_status') {
                                                        echo str_replace('Ні', 'Так', pll__($item));
                                                    } else {
                                                        echo pll__($item);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div id="clear">
                                <?php echo pll__('Очистити'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="catalog">
                    <div class="catalog-title">
                        <?php echo $term_title = single_term_title('', 0);
                        ?>

                    </div>
                    <div class="catalog-list">
                        <?php foreach (array_slice($posts, $offset, $limit) as $post) : ?>
                            <?php $vin_code = carbon_get_post_meta($post->ID, "sing_product_vin"); ?>
                            <li class="list-item
                                <?php echo carbon_get_post_meta($post->ID,'booking_status') === 1 ? 'booked-box' : '' ?>
                                <?php echo carbon_get_post_meta($post->ID,'sold_status') === 1 ? 'booked-box sold' : '' ?>">
                                <div class="left-block
                                <?php echo carbon_get_post_meta($post->ID,'booking_status') === 1 ? 'booked' : '' ?>
                                <?php echo carbon_get_post_meta($post->ID,'sold_status') === 1 ? 'booked' : '' ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="image"
                                             style="background-image: url(<?php echo carbon_get_the_post_meta('sing_product_img')[0]['img']; ?>)"></div>
                                    </a>
                                    <div class="info-part">
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="title">
                                                <?php the_title(); ?>
                                            </div>
                                        </a>
                                        <div class="price-container mobile">
                                            <div class="price">
                                                <?php $group_price = get_current_price($post->ID);
                                                if (carbon_get_post_meta($post->ID, 'sing_product_price')) {
                                                    if(carbon_get_post_meta($post->ID, 'discount_value')) {
                                                        echo '<span class="old-price">' . number_format(carbon_get_post_meta($post->ID, 'sing_product_price'), 0, ',', ' ') . '$</span>';
                                                        echo '<span class="new-price">' . number_format(carbon_get_post_meta($post->ID, 'discount_value'), 0, ',', ' ') . '$</span>';
                                                    } else {
                                                        echo number_format(carbon_get_post_meta($post->ID, 'sing_product_price'), 0, ',', ' ') . '$';
                                                    }
                                                } else { ?>
                                                    <div class="no-price">
                                                        <?php
                                                        echo pll__('Ціна не вказана'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="availability">
                                                <?php if(carbon_get_post_meta($post->ID,'booking_status') !== 1) : ?>
                                                    <div class="availability-text">
                                                        <?php $categories = get_the_category();
                                                        $main_category = $categories[0]->cat_name;
                                                        echo $main_category; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php $date_value = carbon_get_post_meta($post->ID,'sing_product_arriving_date');
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
                                        <div class="product-info-table">
                                            <!--                                            <div class="table-line">-->
                                            <!--                                                <div class="line__title">-->
                                            <!--                                                    --><?php //echo pll__('Рік випуску:'); ?>
                                            <!--                                                </div>-->
                                            <!--                                                <div class="line__description">-->
                                            <!--                                                    --><?php //echo carbon_get_post_meta($post->ID, 'sing_product_year'); ?>
                                            <!--                                                </div>-->
                                            <!--                                            </div>-->


                                            <?php if(carbon_get_post_meta($post->ID, 'product_type') !== 2): ?>
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
                                                        <?php echo carbon_get_post_meta($post->ID, 'sing_product_mileage'); ?>
                                                    </div>
                                                </div>
                                                <div class="table-line">
                                                    <div class="line__title">
                                                        <?php echo pll__('Запас ходу, км:'); ?>
                                                    </div>
                                                    <div class="line__description">
                                                        <?php echo carbon_get_post_meta($post->ID, 'sing_product_power_reserve'); ?>
                                                    </div>
                                                </div>
                                                <!--                                            <div class="table-line">-->
                                                <!--                                                <div class="line__title">-->
                                                <!--                                                    --><?php //echo pll__('Тип приводу:'); ?>
                                                <!--                                                </div>-->
                                                <!--                                                <div class="line__description">-->
                                                <!--                                                    --><?php //echo carbon_get_post_meta($post->ID, 'sing_product_type_of_drive'); ?>
                                                <!--                                                </div>-->
                                                <!--                                            </div>-->
                                                <div class="table-line">
                                                    <div class="line__title">
                                                        <?php echo pll__('Потужність, к.с.:'); ?>
                                                    </div>
                                                    <div class="line__description">
                                                        <?php echo carbon_get_post_meta($post->ID, 'sing_product_power'); ?>
                                                    </div>
                                                </div>
                                                <div class="table-line">
                                                    <div class="line__title">
                                                        <?php echo pll__('Комплектація:'); ?>
                                                    </div>
                                                    <div class="line__description">
                                                        <?php echo carbon_get_post_meta($post->ID, 'sing_product_equipment'); ?>
                                                    </div>
                                                </div>
                                                <?php if($vin_code): ?>
                                                    <div class="table-line">
                                                        <div class="line__title">
                                                            <?php echo pll__('VIN:'); ?>
                                                        </div>
                                                        <div class="line__description">
                                                            <?php echo $vin_code; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else:  ?>
                                                <div class="product-cart-description">
                                                    <?php echo carbon_get_post_meta($post->ID, 'sing_product_short_description'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-block
                                <?php echo carbon_get_post_meta($post->ID,'booking_status') === 1 ? 'booked' : '' ?>
                                <?php echo carbon_get_post_meta($post->ID,'sold_status') === 1 ? 'booked' : '' ?>">
                                    <div class="price-container">
                                        <div class="price">
                                            <?php $group_price = get_current_price($post->ID);
                                            if (carbon_get_post_meta($post->ID, 'sing_product_price')) {
                                                if(carbon_get_post_meta($post->ID, 'discount_value')) {
                                                    echo '<span class="old-price">' . number_format(carbon_get_post_meta($post->ID, 'sing_product_price'), 0, ',', ' ') . '$</span>';
                                                    echo '<span class="new-price">' . number_format(carbon_get_post_meta($post->ID, 'discount_value'), 0, ',', ' ') . '$</span>';
                                                } else {
                                                    echo number_format(carbon_get_post_meta($post->ID, 'sing_product_price'), 0, ',', ' ') . '$';
                                                }
                                            } else { ?>
                                                <div class="no-price">
                                                    <?php
                                                    echo pll__('Ціна не вказана'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="availability">
                                            <?php if(carbon_get_post_meta($post->ID,'booking_status') !== 1) : ?>
                                                <div class="availability-text">
                                                    <?php $categories = get_the_category();
                                                    $main_category = $categories[0]->cat_name;
                                                    echo $main_category; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php /* if (carbon_get_post_meta($post->ID, 'sing_product_availability')) { ?>
                                                <div class="availability-text">
                                                    <?php echo pll__('В наявності'); ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="availability-text no">
                                                    <?php echo pll__('Немає в наявності'); ?>
                                                </div>
                                            <?php }*/ ?>
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
                                    <div class="main-button">
                                        <a  <?php echo carbon_get_post_meta($post->ID,'booking_status') !== 1 ? 'data-toggle="modal" data-target="#buy-modal"' : ''; ?>
                                            <?php echo carbon_get_post_meta($post->ID,'sold_status') !== 1 ? 'data-toggle="modal" data-target="#buy-modal"' : ''; ?>
                                            class="buy-modal-btn <?php echo carbon_get_post_meta($post->ID,'booking_status') === 1 ? 'booked' : ''; ?>
                                            <?php echo carbon_get_post_meta($post->ID,'sold_status') === 1 ? 'booked' : '' ?>"
                                            <?php echo carbon_get_post_meta($post->ID,'booking_status') === 1 ? 'disabled' : ''; ?>
                                            <?php echo carbon_get_post_meta($post->ID,'sold_status') === 1 ? 'disabled' : ''; ?>
                                            <?php echo carbon_get_post_meta($post->ID,'booking_status') === 1 ? '' : 'href="#"'; ?>
                                            <?php echo carbon_get_post_meta($post->ID,'sold_status') === 1 ? '' : 'href="#"'; ?>
                                            data-title="<?php the_title(); ?>"
                                            <?php if($vin_code) { ?>
                                                data-vin="<?php echo $vin_code; ?>"
                                            <?php } ?>
                                            <?php if(carbon_get_post_meta($post->ID,'sing_product_equipment')) { ?>
                                                data-equipment="<?php echo carbon_get_post_meta($post->ID,'sing_product_equipment'); ?>"
                                            <?php } ?>
                                        >
                                            <?php echo carbon_get_post_meta($post->ID, 'product_type') === 2 ? pll__('Придбати') : pll__('Придбати авто'); ?></a>
                                    </div>
                                    <div class="button-see-more">
                                        <a href="<?php the_permalink(); ?>"><?php echo pll__('Детальніше про авто'); ?></a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        
                    </div>
                    <div class="pagination-nav">
                        <?php the_posts_pagination(); ?>
                    </div>
                    <!--<div class="archive-text">
                        <?php echo pll__('SEO - текст викликає у деяких людей недоуміння при спробах прочитати рибу тексту. У відмінності від lorem ipsum текст риби на російській мові наповнить будь-який макет непонятним змістом і придасть неповторимий колорит радянських часів.<br><br>
По своїй суті рибатекст є альтернативою традиційному lorem ipsum, який викликає у некторих людей недоуміння при спробах прочитати рибу тексту. У відмінності від lorem ipsum текст риби на російській мові наповнить будь-який макет непонятним змістом і придасть неповторимий колорит радянських часів.'); ?>
                    </div>-->
                </div>
            </div>
        </div>
    </section>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            $('#clear').on('click', function () {
                document.location.href = '<?php echo $_SERVER['SCRIPT_URL'];?>';
            });
            $('.filter-body').find('.w-block').each(function () {
                if ($(this).find('.opens').length) {
                    $(this).addClass('active');
                }
            });
        });

        function insertParam(key, value) {
            key = encodeURIComponent(key);
            value = encodeURIComponent(value);

            var kvp = document.location.search.substr(1).split('&');
            let i = 0;

            for (; i < kvp.length; i++) {
                if (kvp[i].startsWith(key + '=')) {
                    let pair = kvp[i].split('=');
                    pair[1] = value;
                    kvp[i] = pair.join('=');
                    break;
                }
            }

            if (i >= kvp.length) {
                kvp[kvp.length] = [key, value].join('=');
            }

            let params = kvp.join('&');

            document.location.search = params;
        }

        function filter(key, param) {
            let url = window.location.href;
            let get = key + '=' + param;
            let reg = new RegExp('&?' + get, "g");

            if (url.indexOf(get) > 0) {
                url = url.replace(reg, '');
                url = url.replace('?&', '?');
                if (parseInt(url.length) == (parseInt(url.indexOf('/?')) + 2)) {
                    url = url.replace('?', '');
                }
                document.location.href = url;
            } else {
                insertParam(key, param);
            }
        }


    </script>


    <?php

    if (isset($price_min) && isset($price_max)) {
        $min = $price_min;
        $max = $price_max;
    } else {
        if ($prices) {
            $min = min($prices);
            $max = max($prices);
        }
    }


    ?>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            $("#slider-range").slider({
                range: true,
                values: [
                    <?php echo $min; ?>,
                    <?php echo $max;?>
                ],
                step: 1000,
                min: <?php echo min($prices); ?>,
                max: <?php echo max($prices); ?>,
                stop: function (event, ui) {
                    $('#pricemin').val(ui.values[0]);
                    $('#pricemax').val(ui.values[1]);

                    let href = window.location.href;
                    if (/\?/.test(href)) {
                        if (/price_min/.test(href)) {
                            let regular = /price_min=\d+&price_max=\d+/;
                            href = href.replace(regular, '');
                            href += '&price_min=' + ui.values[0] + '&price_max=' + ui.values[1];
                        } else {
                            href += '&price_min=' + ui.values[0] + '&price_max=' + ui.values[1];
                        }
                    } else {
                        href += '?price_min=' + ui.values[0] + '&price_max=' + ui.values[1];
                    }
                    window.location.href = href;
                },
                slide: function (event, ui) {

                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    $(".from").text("$" + ui.values[0]);
                    $(".while").text("$" + ui.values[1]);
                }
            });

            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
            $(".from").text("$" + $("#slider-range").slider("values", 0));
            $(".while").text("$" + $("#slider-range").slider("values", 1));


            /*$('#reset').on('click', function () {
                $('#simple-filter').find('input').each(function () {
                    $(this).val("");
                });
                setTimeout(function () {
                    $('#simple-filter').submit();
                }, 300);
            });*/
        });

    </script>

<?php
get_footer(); // подключаем подвал
?>