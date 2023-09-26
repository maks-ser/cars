<?php
require_once 'customers/functions.php';
setlocale(LC_TIME, 'uk_UA.UTF-8');

add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
    function add_styles()
    {
        if (is_admin()) {
            return false;
        }
        wp_enqueue_style('main', get_template_directory_uri() . '/css/style.css', array(), '27.06.2023');
    }
}

add_action('admin_head', 'my_custom_styles');
function my_custom_styles() {
    echo '
    <style>
        .cf-container--tabbed {
            flex-direction: column !important;
        }
    </style>';
}

function pll_current_url($lang = null) {
    global $wp;
    $url = home_url(add_query_arg(array(),$wp->request));
    if ($lang) {
        $url = pll_home_url($lang) . substr($url, strlen(home_url()));
    }
    return $url;
}

function dream_theme_get_menu_items($location_id){
    //$locations = get_registered_nav_menus();
    $menus = wp_get_nav_menus();
    $menu_locations = get_nav_menu_locations();

    if (isset($menu_locations[ $location_id ]) && $menu_locations[ $location_id ]!=0) {
        foreach ($menus as $menu) {
            if ($menu->term_id == $menu_locations[ $location_id ]) {
                $menu_items = wp_get_nav_menu_items($menu);
                break;
            }
        }
        return $menu_items;
    }
}

//function custom_taxonomy_labels() {
//    global $wp_taxonomies;
//
//    $labels = &$wp_taxonomies['post_tag']->labels;
//    $labels->name = 'VIN-код';
//    $labels->singular_name = 'VIN-код';
//    $labels->menu_name = 'VIN-код';
//}

//add_action( 'init', 'custom_taxonomy_labels' );


add_filter('manage_posts_columns', 'my_custom_column');
function my_custom_column($columns) {
    // Add the 'vin_code_col' column after the first column
    $new_columns = array_slice($columns, 0, 2, true) +
        array('vin_code_col' => 'VIN') +
        array('sing_product_price_col' => 'Ціна') +
        array('sing_product_arriving_date_col' => 'Очікується') +
        array('discount_col' => 'Акція') +
        array('booking_col' => 'Бронь') +
        array('sold_col' => 'Продано') +
        array_slice($columns, 2, count($columns) - 1, true);
    return $new_columns;
}

add_action('manage_posts_custom_column', 'populate_my_custom_column', 10, 2);
function populate_my_custom_column($column, $post_id) {
    if ($column == 'sing_product_price_col') {
        $my_custom_field = carbon_get_post_meta($post_id, 'sing_product_price');
        echo $my_custom_field;
    }
    if ($column == 'sing_product_arriving_date_col') {
        $my_custom_field = carbon_get_post_meta($post_id, 'sing_product_arriving_date');
        echo $my_custom_field;
    }
    if ($column == 'vin_code_col') {
        $my_custom_field = carbon_get_post_meta($post_id, 'sing_product_vin');
        echo $my_custom_field;
    }
    if ($column == 'discount_col') {
        $my_custom_field = getDiscount()[carbon_get_post_meta($post_id, 'discount')];
        echo $my_custom_field;
    }
    if ($column == 'booking_col') {
        $my_custom_field = getBookingStatus()[carbon_get_post_meta($post_id, 'booking_status')];
        echo $my_custom_field;
    }
    if ($column == 'sold_col') {
        $my_custom_field = getSoldStatus()[carbon_get_post_meta($post_id, 'sold_status')];
        echo $my_custom_field;
    }
}


add_filter('manage_edit-post_sortable_columns', 'make_my_custom_column_sortable');
function make_my_custom_column_sortable($columns) {
    $columns['vin_code_col'] = 'vin_code_col';
    return $columns;
}




add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;
use Carbon_Fields\Field\Choice_Field;


add_action('init', function () {
    pll_register_string('pagin', '-а сторінка');
    pll_register_string('no_products', 'Товарів не знайдено');
    pll_register_string('yes', 'Так');
    pll_register_string('accessories', 'Аксесуари');
    pll_register_string('on_way', 'В дорозі');
    pll_register_string('discount_offer_1', 'Акційні');
    pll_register_string('discount_offer_2', 'пропозиції');
    pll_register_string('call_order', 'Замовити дзвінок');
    pll_register_string('test_drive_order', 'Замовити ТЕСТ-ДРАЙВ');
    pll_register_string('test_drive_record', 'Запис на тест-драйв');
    pll_register_string('on_order', 'Під замовлення');
    pll_register_string('on_order_link', 'https://funcar.com.ua/forma-pid-zamovlennya/');
    pll_register_string('catalog_link', 'https://funcar.com.ua/category/all/');
    pll_register_string('footer_company_title', 'Продаж електроавтомобілів по Україні');
    pll_register_string('footer_up_button', 'Вгору');
    pll_register_string('our_contacts', 'Наші контакти:');
    pll_register_string('our_address', 'Адреса майданчика:');
    pll_register_string('our_address_text', 'Киевская');
    pll_register_string('our_numbers', 'Наші телефони:');
    pll_register_string('timetable_title', 'Режим роботи:');
    pll_register_string('contacts_timetable', 'Понеділок-пятниця з 9:00 до 18:00');
    pll_register_string('weekends', 'Субота - вихідний <br> Неділя - вихідний');
    pll_register_string('our_social_networks', 'Ми у соцмережах:');
    pll_register_string('header_timetable', 'Працюємо з 9:00 до 18:00, Пн-Пт');
    pll_register_string('other', 'Другие машины');
    pll_register_string('see_more', 'Детальніше');
    pll_register_string('filter_1', 'В наличии');
    pll_register_string('filter_2', 'С пробегом');
    pll_register_string('filter_3312', 'Новая');
    pll_register_string('filter_4', 'На на ходу / на запчасти');
    pll_register_string('filter_5', 'Не поврежден');
    pll_register_string('filter_6', 'Седан');
    pll_register_string('filter_7', 'Электро');
    pll_register_string('filter_8', 'Передний');
    pll_register_string('filter_9', 'Кожа');
    pll_register_string('filter_10', 'Да');
    pll_register_string('filter_10112122', 'Нет');
    pll_register_string('filter_11', 'Премиум');
    pll_register_string('filter_12', 'Под заказ');
    pll_register_string('filter_13', 'Габарити авто (Д*Ш*В), см:');
    pll_register_string('filter_14', 'Вага:');
    pll_register_string('see_more_about_car', 'Детальніше про авто');
    pll_register_string('order_consultation', 'Замовити консультацію');
    pll_register_string('site_development', 'Розробка сайту');
    pll_register_string('available', 'В наявності');
    pll_register_string('not_available', 'Немає в наявності');
    pll_register_string('graduation_year', 'Рік випуску:');
    pll_register_string('condition', 'Стан');
    pll_register_string('mileage', 'Пробіг, км:');
    pll_register_string('power_reserve', 'Запас ходу, км:');
    pll_register_string('drive_type', 'Тип приводу:');
    pll_register_string('power', 'Потужність, к.с.:');
    pll_register_string('form', '[contact-form-7 id="1224" title="Popup_RU"]');
    pll_register_string('privacy_policy', 'Натискаючи на кнопку, я погоджуюсь на <span>обробку персональних даних</span>');
    pll_register_string('form_title', 'Зв’язатись з нами');
    pll_register_string('filter_column_title', 'Фільтр параметрів');
    pll_register_string('filter_price', 'Ціна, USD');
    pll_register_string('table_1', 'Марка авто:');
    pll_register_string('table_2', 'Модель авто:');
    pll_register_string('table_3', 'Комплектація:');
    pll_register_string('table_4', 'Рік випуску:');
    pll_register_string('table_5', 'Тип кузова:');
    pll_register_string('table_6', 'Колір кузова:');
    pll_register_string('table_7', 'Колір салону:');
    pll_register_string('table_8', 'Обшивка салону:');
    pll_register_string('table_9', 'Тип двигуна:');
    pll_register_string('table_10', 'Тип приводу:');
    pll_register_string('table_11', 'Запас ходу від виробника, км:');
    pll_register_string('table_12', 'Місткість батареї, кВт:');
    pll_register_string('table_13', 'Потужність, к.с.:');
    pll_register_string('table_14', 'Розгін до 100 км, сек:');
    pll_register_string('table_15', 'Макс, швидкість, км/г:');
    pll_register_string('table_16', 'Пробіг км:');
    pll_register_string('table_17', 'Стан:');
    pll_register_string('table_18', 'Ушкодження:');
    pll_register_string('table_19', 'Панорамний дах:');
    pll_register_string('table_20', 'Автопілот:');
    pll_register_string('table_21', 'Клас авто:');
    pll_register_string('table_22', 'Пригнаний з:');
    pll_register_string('table_23', 'VIN:');
    pll_register_string('table_24', 'Очікується:');
    pll_register_string('table_25', 'Роздріб:');
    pll_register_string('table_26', 'Акція:');

    pll_register_string('table_27', "Технічний стан авто:");
    pll_register_string('table_28', "Стан лакофарбового покриття:");
    pll_register_string('table_29', "Електросклопідйомники:");
    pll_register_string('table_30', "Підсилювач керма:");
    pll_register_string('table_31', "Кондиціонер:");
    pll_register_string('table_32', "Регулювання сидінь:");
    pll_register_string('table_33', "Пам'ять положення сидінь:");
    pll_register_string('table_34', "Підігрів сидінь:");
    pll_register_string('table_35', "Вентиляція сидінь:");
    pll_register_string('table_36', "Фари:");
    pll_register_string('table_37', "Запаска:");
    pll_register_string('table_38', "Розмір дисків:");
    pll_register_string('table_39', "Швидкість заряду від 0% до 100%, годин:");
    pll_register_string('table_40', "Оптика:");
    pll_register_string('table_41', "Мультимедіа:");
    pll_register_string('table_42', "Салон та комфорт:");
    pll_register_string('table_43', "Подушки безпеки:");
    pll_register_string('table_44', "Система допомоги паркування:");
    pll_register_string('table_45', "Електронні системи безпеки:");
    pll_register_string('table_46', "Кузов:");
    pll_register_string('table_47', "Безпека:");

    pll_register_string('table_48', "Повністю нове");
    pll_register_string('table_49', "Професійно виправленні пошкодження");
    pll_register_string('table_50', "Передні");
    pll_register_string('table_51', "Передні і задні");
    pll_register_string('table_52', "Відсутні");
    pll_register_string('table_53', "Автомат");
    pll_register_string('table_54', "Електро");
    pll_register_string('table_55', "Гідро");
    pll_register_string('table_56', "Клімат-контроль 1 зона");
    pll_register_string('table_57', "Клімат-контроль 2 зони");
    pll_register_string('table_58', "Багатозонний клімат-контроль");
    pll_register_string('table_59', "Відсутній");
    pll_register_string('table_60', "Сидіння водія");
    pll_register_string('table_61', "Передніх сидінь");
    pll_register_string('table_62', "Всіх сидінь");
    pll_register_string('table_63', "Відсутня");
    pll_register_string('table_64', "Повнорозмірна");
    pll_register_string('table_65', "Докатка");
    pll_register_string('table_66', "Галогенні");
    pll_register_string('table_67', "Ксенон/біксенон");
    pll_register_string('table_68', "Світлодіодні");
    pll_register_string('table_69', "Датчик світла");
    pll_register_string('table_70', "Денні ходові вогні");
    pll_register_string('table_71', "Омивач фар");
    pll_register_string('table_72', "Протитуманні фари");
    pll_register_string('table_73', "Система адаптивного освітлення");
    pll_register_string('table_74', "Аудіо-підготовка");
    pll_register_string('table_75', "Голосове керування");
    pll_register_string('table_76', "Мультимедіа система з LCD-екраном");
    pll_register_string('table_77', "Навігаційна система");
    pll_register_string('table_78', "Система мультимедіа для задніх пасажирів");
    pll_register_string('table_79', "Адаптивний круїз");
    pll_register_string('table_80', "Бардачок із охолодженням");
    pll_register_string('table_81', "Бездротова зарядка для смартфона");
    pll_register_string('table_82', "Бортовий комп'ютер");
    pll_register_string('table_83', "Швидка зарядка CHAdeMO");
    pll_register_string('table_84', "Вибір режиму руху");
    pll_register_string('table_85', "Датчик дощу");
    pll_register_string('table_86', "Декоративне підсвічування салону");
    pll_register_string('table_87', "Декоративні накладки на педалі");
    pll_register_string('table_88', "Дистанційний запуск двигуна");
    pll_register_string('table_89', "Доводчик дверей");
    pll_register_string('table_90', "Запуск двигуна з кнопки");
    pll_register_string('table_91', "Круїз контроль");
    pll_register_string('table_92', "Мультифункціональне кермо");
    pll_register_string('table_93', "Обігрів лобового скла");
    pll_register_string('table_94', "Обігрів керма");
    pll_register_string('table_95', "Оздоблення шкірою важеля КПП");
    pll_register_string('table_96', "Оздоблення стелі чорного кольору");
    pll_register_string('table_97', "Оздоблення керма шкірою");
    pll_register_string('table_98', "Відкриття багажника без допомоги рук");
    pll_register_string('table_99', "Панорамний дах");
    pll_register_string('table_100', "Передній центральний підлокітник");
    pll_register_string('table_101', "Підігрів дзеркал");
    pll_register_string('table_102', "Підрульові пелюстки перемикання передач");
    pll_register_string('table_103', "Прикурювач та попільничка");
    pll_register_string('table_104', "Проекційний дисплей");
    pll_register_string('table_105', "Регульований педальний вузол");
    pll_register_string('table_106', "Розетка");
    pll_register_string('table_107', "Кермо з пам'яттю положення");
    pll_register_string('table_108', "Сидіння з масажем");
    pll_register_string('table_109', 'Система "старт-стоп"');
    pll_register_string('table_110', "Система доступу без ключа");
    pll_register_string('table_111', "Складаний столик на спинках передніх сидінь");
    pll_register_string('table_112', "Заднє сидіння, що складається");
    pll_register_string('table_113', "Сонцезахисна шторка на задньому склі");
    pll_register_string('table_114', "Сонцезахисні шторки в задніх дверях");
    pll_register_string('table_115', "Тоноване скло");
    pll_register_string('table_116', "Третій задній підголівник");
    pll_register_string('table_117', "Третій ряд сидінь");
    pll_register_string('table_118', "Функція складання спинки сидіння пасажира");
    pll_register_string('table_119', "Холодильник");
    pll_register_string('table_120', "Електронна панель приладів");
    pll_register_string('table_121', "Електропривод дзеркал");
    pll_register_string('table_122', "Електропривод кришки багажника");
    pll_register_string('table_123', "Електрорегулювання керма");
    pll_register_string('table_124', "Бічні задні");
    pll_register_string('table_125', "Бічні передні");
    pll_register_string('table_126', "Водія");
    pll_register_string('table_127', "Колін водія");
    pll_register_string('table_128', "Віконні (шторки)");
    pll_register_string('table_129', "Пасажира");
    pll_register_string('table_130', "Задня камера");
    pll_register_string('table_131', "Камера 360");
    pll_register_string('table_132', "Парктронік задній");
    pll_register_string('table_133', "Парктронік передній");
    pll_register_string('table_134', "Передня камера");
    pll_register_string('table_135', "Система автоматичного паркування");
    pll_register_string('table_136', "Броньований кузов");
    pll_register_string('table_137', "Довга база");
    pll_register_string('table_138', "Захист картера");
    pll_register_string('table_139', "Захист коробки");
    pll_register_string('table_140', "Кузов MAXI");
    pll_register_string('table_141', "Накладки на пороги");
    pll_register_string('table_142', "Фаркоп");
    pll_register_string('table_143', "Антиблокувальна система (ABS)");
    pll_register_string('table_144', "Антипробуксовочна система (ASR)");
    pll_register_string('table_145', "Централь");
    pll_register_string('table_146', "Стабілізація рульового керування (VSM)");
    pll_register_string('table_147', "Система стабілізації (ESP)");
    pll_register_string('table_148', "Система кріплення IsoFix");
    pll_register_string('table_149', "Сигналізація");
    pll_register_string('table_150', "Розподіл гальмівних зусиль (BAS, EBD)");
    pll_register_string('table_151', "Розпізнавання дорожніх знаків");
    pll_register_string('table_152', "Запобігання зіткненню");
    pll_register_string('table_153', "Допомога при старті в гору");
    pll_register_string('table_154', "Допомога під час спуску");
    pll_register_string('table_155', "Блокування замків задніх дверей");
    pll_register_string('table_156', "Датчик тиску в шинах");
    pll_register_string('table_157', "Датчик проникнення в салон (датчик об'єму)");
    pll_register_string('table_158', "Датчик втоми водія");
    pll_register_string('table_159', "Іммобілайзер");
    pll_register_string('table_160', "Контроль за смугою руху");
    pll_register_string('table_161', "Контроль сліпих зон");
    pll_register_string('table_162', "Нічне бачення");

    pll_register_string('archive_text', 'SEO - текст викликає у деяких людей недоуміння при спробах прочитати рибу тексту. У відмінності від lorem ipsum текст риби на російській мові наповнить будь-який макет непонятним змістом і придасть неповторимий колорит радянських часів.<br><br>
По своїй суті рибатекст є альтернативою традиційному lorem ipsum, який викликає у некторих людей недоуміння при спробах прочитати рибу тексту. У відмінності від lorem ipsum текст риби на російській мові наповнить будь-який макет непонятним змістом і придасть неповторимий колорит радянських часів.');
    pll_register_string('from', 'від');
    pll_register_string('to', 'до');
    pll_register_string('price_not', 'Ціна не вказана');
    pll_register_string('your_price', 'Ваша ціна:');
    pll_register_string('your_bonus', 'Ваш бонус:');
    pll_register_string('register_agent', 'Хочу стати агентом');
    pll_register_string('clear', 'Очистити');
    pll_register_string('loging_auto', 'Увійти');
    pll_register_string('buy_car', 'Придбати авто');
    pll_register_string('buy', 'Придбати');
    pll_register_string('month_1', 'січня');
    pll_register_string('month_2', 'лютого');
    pll_register_string('month_3', 'березня');
    pll_register_string('month_4', 'квітня');
    pll_register_string('month_5', 'травня');
    pll_register_string('month_6', 'червня');
    pll_register_string('month_7', 'липня');
    pll_register_string('month_8', 'серпня');
    pll_register_string('month_9', 'вересня');
    pll_register_string('month_10', 'жовтня');
    pll_register_string('month_11', 'листопада');
    pll_register_string('month_12', 'грудня');
});





add_action('carbon_fields_register_fields', 'crb_attach_theme_options'); // Для версии 2.0 и выше
function crb_attach_theme_options()
{

    function getPages()
    {
        $carbon_pages = array();
        $pages = get_posts([
                'numberposts' => -1,
                'lang' => 'ua'
            ]
        );
        foreach ($pages as $page) {
            $carbon_pages[$page->ID] = $page->post_title;
        }
        return $carbon_pages;
    }
    function getProductType()
    {
        $product_type = carbon_get_theme_option('product_type');
        $result = [];

        foreach ($product_type as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function getBookingStatus()
    {
        $booking_status = carbon_get_theme_option('booking_status');
        $result = [];

        foreach ($booking_status as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function getSoldStatus()
    {
        $sold_status = carbon_get_theme_option('sold_status');
        $result = [];

        foreach ($sold_status as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function getDiscount()
    {
        $discount = carbon_get_theme_option('discount');
        $result = [];

        foreach ($discount as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getBrand()
    {
        $fuel = carbon_get_theme_option('brand');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getModel()
    {
        $fuel = carbon_get_theme_option('model');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getAvailability()
    {
        $fuel = carbon_get_theme_option('availability');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getState()
    {
        $fuel = carbon_get_theme_option('state');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getDamage()
    {
        $fuel = carbon_get_theme_option('damage');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getDrive()
    {
        $fuel = carbon_get_theme_option('drive');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getSheathing()
    {
        $fuel = carbon_get_theme_option('sheathing');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getRoof()
    {
        $fuel = carbon_get_theme_option('roof');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getCharge()
    {
        $charge = carbon_get_theme_option('charge');
        $result = [];

        foreach ($charge as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

//    function getWeight()
//    {
//        $item = carbon_get_theme_option('weight');
//        $result = [];
//
//        foreach ($item as $key => $value) {
//            $result[$value['alias']] = $value['text'];
//        }
//        return $result;
//    }



    // Комплектація -------------------------------

    function getTechCondition()
    {
        $item = carbon_get_theme_option('tech_condition');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    
    function get_lacq_coating()
    {
        $item = carbon_get_theme_option('lacq_coating');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_el_window_lifters()
    {
        $item = carbon_get_theme_option('el_window_lifters');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_gearbox()
    {
        $item = carbon_get_theme_option('gearbox');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_power_steering()
    {
        $item = carbon_get_theme_option('power_steering');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_air_conditioning()
    {
        $item = carbon_get_theme_option('air_conditioning');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_seat_adjustment()
    {
        $item = carbon_get_theme_option('seat_adjustment');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_seat_position_memory()
    {
        $item = carbon_get_theme_option('seat_position_memory');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_heated_seats()
    {
        $item = carbon_get_theme_option('heated_seats');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_seat_ventilation()
    {
        $item = carbon_get_theme_option('seat_ventilation');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_headlights()
    {
        $item = carbon_get_theme_option('headlights');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_disk_size()
    {
        $item = carbon_get_theme_option('disk_size');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function get_spare()
    {
        $item = carbon_get_theme_option('spare');
        $result = [];

        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_optics()
    {
        $item = carbon_get_theme_option('optics');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_multimedia()
    {
        $item = carbon_get_theme_option('multimedia');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_comfort()
    {
        $item = carbon_get_theme_option('comfort');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_airbags()
    {
        $item = carbon_get_theme_option('airbags');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_parking_help()
    {
        $item = carbon_get_theme_option('parking_help');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_electro_save()
    {
        $item = carbon_get_theme_option('electro_save');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_bodywork()
    {
        $item = carbon_get_theme_option('bodywork');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }
    function get_safety()
    {
        $item = carbon_get_theme_option('safety');
        $result = [];
//
        foreach ($item as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }



//    function getClass()
//    {
//        $fuel = carbon_get_theme_option('class');
//        $result = [];
//
//        foreach ($fuel as $key => $value) {
//            $result[$value['alias']] = $value['text'];
//        }
//        return $result;
//    }

    function getFuel()
    {
        $fuel = carbon_get_theme_option('fuel');
        $result = [];

        foreach ($fuel as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;
    }

    function getVolume()
    {
        $volume = carbon_get_theme_option('volume');
        $result = [];
        foreach ($volume as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;

    }

    function getTransmission()
    {
        $transmission = carbon_get_theme_option('transmission');
        $result = [];
        foreach ($transmission as $key => $value) {
            $result[$value['alias']] = $value['text_ru'];
        }
        return $result;

    }

    function getBodyType()
    {
        $body_type = carbon_get_theme_option('body_type');
        $result = [];
        foreach ($body_type as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;

    }

    function getModelCar()
    {
        $model_car = carbon_get_theme_option('model_car');
        $result = [];
        foreach ($model_car as $key => $value) {
            $result[$value['alias']] = $value['text'];
        }
        return $result;

    }

    Container::make('theme_options', 2, __(' Главная информация', 'crb'))
        ->add_tab('Контакты', array(

            Field::make('text', 'percent_in_way', '% В дорозі')->set_width(50),
            Field::make('text', 'percent_in_house', '% В наявності')->set_width(50),
            Field::make('rich_text', 'agent_no_active_text_ua', 'Текст для деактивированого агента UA')->set_width(50),
            Field::make('rich_text', 'agent_no_active_text_ru', 'Текст для деактивированого агента ru')->set_width(50),

            Field::make('image', 'logo', 'Логотип')->set_value_type('url'),
            Field::make('text', 'email', 'Почта')->set_width(50),

            Field::make('complex', 'phone', 'Телефон')
                ->add_fields(array(
                        Field::make('text', 'text', 'Номер телефона')
                            ->set_width(100),
                    )
                ),

            Field::make('complex', 'social_networks', 'Социальные сети')
                ->add_fields(array(
                        Field::make('image', 'icon', 'Иконка')->set_value_type('url'),
                        Field::make('text', 'link', 'Ссылка на социальную сеть')
                            ->set_width(100),
                    )
                ),

            Field::make('text', 'address', 'Адресс')->set_width(50),
            Field::make('text', 'google_maps', 'Google maps')->set_width(50),
            Field::make('text', 'instagram', 'Instagram')->set_width(50),
            Field::make('text', 'viber', 'Viber')->set_width(50),
            Field::make('text', 'telegram', 'Telegram')->set_width(50),

            Field::make('text', 'whatsapp', 'Whatsapp')->set_width(50),
            Field::make('text', 'facebook', 'Facebook')->set_width(50),

            Field::make('text', 'copyright', 'Copyright')->set_width(50),

            Field::make('textarea', 'google_maps_iframe', 'Google maps iframe')->set_width(50),

        ));

    Container::make('theme_options', 3, __('Данные для машин и для фильтра', 'crb'))
        ->add_tab('Тип товару', array(
            Field::make('complex', 'product_type', 'Тип товару')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(10),
                        Field::make('text', 'text', 'Название')
                            ->set_width(90),
                    )
                ),
        ))
        ->add_tab('Чи заброньовано', array(
            Field::make('complex', 'booking_status', 'Чи заброньовано')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(10),
                        Field::make('text', 'text', 'Название')
                            ->set_width(90),
                    )
                ),
        ))
        ->add_tab('Чи продано', array(
            Field::make('complex', 'sold_status', 'Чи продано')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(10),
                        Field::make('text', 'text', 'Название')
                            ->set_width(90),
                    )
                ),
        ))
        ->add_tab('Марка и модель', array(
            Field::make('complex', 'brand', 'Марка машины')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(10),
                        Field::make('text', 'text', 'Название')
                            ->set_width(90),
                        Field::make('image', 'brand_logo', 'Логотип')->set_value_type('url'),
                    )
                ),
            Field::make('complex', 'model', 'Модель машины')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(10),
                        Field::make('text', 'text', 'Название')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Статус наличия', array(
            Field::make('complex', 'availability', 'Наличие')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                        Field::make('text', 'text_ua', 'Заголовок на UA')
                            ->set_width(25),
                        Field::make('text', 'text_ru', 'Заголовок на ru')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Состояние', array(
            Field::make('complex', 'state', 'Состояние')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Повреждения', array(
            Field::make('complex', 'damage', 'Повреждение')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Тип кузова', array(
            Field::make('complex', 'body_type', 'Тип кузова')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(10),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(90),

                    )
                ),
        ))
        ->add_tab('Тип Двигателя', array(
            Field::make('complex', 'fuel', 'тип')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Тип привода', array(
            Field::make('complex', 'drive', 'тип привода')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Обшивка салона', array(
            Field::make('complex', 'sheathing', 'Обшивка')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Панорамная крыша', array(
            Field::make('complex', 'roof', 'Крыша')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Класс машины', array(
            Field::make('complex', 'class', 'Класс машины')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Зарядний пристрій', array(
            Field::make('complex', 'charge', 'зарядний пристрій')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ))
        ->add_tab('Акція', array(
            Field::make('complex', 'discount', 'Акція')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ),
        ));
//        ->add_tab('Вага, кг', array(
//            Field::make('text', 'weight', 'Вага, кг')
//                ->set_width(25),
//        ));

    Container::make('theme_options', 4, __('Комплектація', 'crb'))
        ->add_tab('Технічній стан авто', array(
                Field::make('complex', 'tech_condition', 'Технічній стан авто')
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Стан лакофарбового покриття', array(
            Field::make('complex', 'lacq_coating', 'Стан лакофарбового покриття:')
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab('Електросклопідйомники', array(
            Field::make('complex', 'el_window_lifters', "Електросклопідйомники")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )

        ->add_tab('Коробка передач', array(
                Field::make('complex', 'gearbox', "Коробка передач")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Підсилювач керма', array(
            Field::make('complex', 'power_steering', "Підсилювач керма")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab('Кондиціонер', array(
            Field::make('complex', 'air_conditioning', "Кондиціонер")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab('Регулювання сидінь', array(
            Field::make('complex', 'seat_adjustment', "Регулювання сидінь")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab("Пам'ять положення сидінь", array(
            Field::make('complex', 'seat_position_memory', "Пам'ять положення сидінь")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab('Підігрів сидінь', array(
            Field::make('complex', 'heated_seats', "Підігрів сидінь")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab('Вентиляція сидінь', array(
            Field::make('complex', 'seat_ventilation', "Вентиляція сидінь")
                ->add_fields(array(
                        Field::make('text', 'alias', 'Внутренний код')
                            ->set_width(25),
                        Field::make('text', 'text', 'Заголовок')
                            ->set_width(25),
                    )
                ))
        )
        ->add_tab('Запаска', array(
                Field::make('complex', 'spare', "Запаска")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Розмір дисків', array(
                Field::make('complex', 'disk_size', "Розмір дисків")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Фари', array(
                Field::make('complex', 'headlights', "Фари")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Оптика', array(
                Field::make('complex', 'optics', "Оптика")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Мультимедіа', array(
                Field::make('complex', 'multimedia', "Мультимедіа")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Салон та комфорт', array(
                Field::make('complex', 'comfort', "Салон та комфорт")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Подушки безпеки', array(
                Field::make('complex', 'airbags', "Подушки безпеки")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Система допомоги паркування', array(
                Field::make('complex', 'parking_help', "Система допомоги паркування")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Електронні системи безпеки', array(
                Field::make('complex', 'electro_save', "Електронні системи безпеки")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Кузов', array(
                Field::make('complex', 'bodywork', "Кузов")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ->add_tab('Безпека', array(
                Field::make('complex', 'safety', "Безпека")
                    ->add_fields(array(
                            Field::make('text', 'alias', 'Внутренний код')
                                ->set_width(25),
                            Field::make('text', 'text', 'Заголовок')
                                ->set_width(25),
                        )
                    ))
        )
        ;



    Container::make('post_meta', 'Данные о машине')
        ->where('post_type', '=', 'post')
        ->add_tab('Товар', array(
            Field::make('select', 'product_type', __('Тип товару'))
                ->set_options(getProductType())->set_width(10),
            Field::make('select', 'booking_status', __('Чи заброньовано'))
                ->set_options(getBookingStatus())
                ->set_width(10)
                ->set_default_value(2),
//                ->set_conditional_logic(array(
//                    array(
//                        'field' => 'product_type',
//                        'value' => '1',
//                        'compare' => '=',
//                    )
//                )),

            Field::make('select', 'sold_status', __('Чи продано (в розробці)'))
                ->set_options(getSoldStatus())
                ->set_width(10)
                ->set_default_value(2),

            Field::make('complex', 'related', 'Інші машини')
                ->add_fields(array(
                        Field::make('select', 'match_home', 'Інші машини')
                            ->set_options(
                                getPages()
                            ),
                    )
                )
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('complex', 'sing_product_img', 'Изображения товара')
                ->add_fields(array(
                        Field::make('image', 'img', 'Изображение')->set_value_type('url'),
                    )
                ),

            Field::make('text', 'sing_product_price', __('Ціна', 'crb'))->set_width(45),
            Field::make('select', 'discount', __('Акція'))
                ->set_options(getDiscount())->set_width(10)
                ->set_default_value(2),
            Field::make( 'text', 'discount_value', 'Акційна ціна' )->set_width(45)
                ->set_conditional_logic( array(
                    array(
                        'field' => 'discount',
                        'value' => 1,
                    ),
                ) ),
//            Field::make( 'checkbox', 'discount', 'Акція' )->set_width(10),
//            Field::make( 'text', 'discount_value', 'Акційна ціна' )->set_width(45)
//                ->set_conditional_logic( array(
//                    array(
//                        'field' => 'discount',
//                        'value' => true,
//                    ),
//                ) ),
            Field::make( 'date', 'sing_product_arriving_date', 'Очікується: ' )
                ->set_attribute( 'placeholder', __('Дата прибуття автомобіля') )
                ->set_storage_format( 'd.m.y' )
                ->set_input_format( 'j F Y', 'j M Y' )
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                ))
                ->set_width(33),
            Field::make('checkbox', 'sing_product_availability', __('В наличии'))
                ->set_option_value('yes'),
            Field::make('textarea', 'sing_product_description', __('Описание', 'crb'))->set_width(33),
            Field::make('textarea', 'sing_product_short_description', __('Короткий опис (для карточки)', 'crb'))->set_width(33),
            Field::make('text', 'sing_product_year', __('Год выпуска', 'crb'))->set_width(33)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
           // Field::make('text', 'sing_product_condition', __('Состояние', 'crb'))->set_width(33),
            Field::make('text', 'sing_product_mileage', __('Пробег, км', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_power_reserve', __('Запас хода, км', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_type_of_drive', __('Тип привода:', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_power', __('Мощность, к.с.:', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_equipment', __('Комплектация', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_body_color', __('Цвет кузова', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_interior_color', __('Цвет салона', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_battery_capacity', __('Емкость батареи, кВт', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
//            Field::make('text', 'sing_product_dispersal', __('Разгон до 100 км, сек:', 'crb'))->set_width(33),
            Field::make('text', 'sing_product_max_speed', __('Максимальная скорость, км/ч:', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'sing_product_dimensions', __('Габарити авто (Д*Ш*В), см:', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
//            Field::make('text', 'sing_product_autopilot', __('Автопилот:', 'crb'))->set_width(33),
//                Field::make('text', 'sing_product_driven', __('Пригнан из:', 'crb'))->set_width(33),
            Field::make('text', 'sing_product_vin', __('VIN:', 'crb'))->set_width(33),
        ))
        ->add_tab('Данные для фильтра', array(
            Field::make('select', 'brand', __('Марка'))
                ->set_options(getBrand())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'model', __('Модель'))
                ->set_options(getModel())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'availability', __('Наличие'))
                ->set_options(getAvailability())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'state', __('Состояние'))
                ->set_options(getState())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'damage', __('Повреждение'))
                ->set_options(getDamage())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'body_type', __('Тип кузова'))
                ->set_options(getBodyType())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'fuel', __('Тип двигателя'))
                ->set_options(getFuel())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'drive', __('Тип привода'))
                ->set_options(getDrive())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'sheathing', __('Обшивка'))
                ->set_options(getSheathing())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'roof', __('Панорама'))
                ->set_options(getRoof())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'charge', __('Зарядний пристрій'))
                ->set_options(getCharge())->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('text', 'weight', __('Вага, кг', 'crb'))->set_width(25)
                ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),


//            Field::make('select', 'class', __('Класс машины'))
//                ->set_options(getClass())->set_width(25),
        ))
        ->add_tab('Цены для групп пользователей', get_prices_groups())
        ->add_tab('Комплектація', array(
            Field::make('select', 'tech_condition', __('Технічний стан авто'))
                ->set_options(getTechCondition())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'lacq_coating', __('Стан лакофарбового покриття'))
                ->set_options(get_lacq_coating())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'el_window_lifters', __('Електросклопідйомники'))
                ->set_options(get_el_window_lifters())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'gearbox', __('Коробка передач'))
                ->set_options(get_gearbox())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'power_steering', __('Підсилювач керма'))
                ->set_options(get_power_steering())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'air_conditioning', __('Кондиціонер'))
                ->set_options(get_air_conditioning())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'seat_adjustment', __('Регулювання сидінь'))
                ->set_options(get_seat_adjustment())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'seat_position_memory', __("Пам'ять положення сидінь"))
                ->set_options(get_seat_position_memory())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'heated_seats', __("Підігрів сидінь"))
                ->set_options(get_heated_seats())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'seat_ventilation', __("Вентиляція сидінь"))
                ->set_options(get_seat_ventilation())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'spare', __("Запаска"))
                ->set_options(get_spare())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'disk_size', __("Розмір дисків"))
                ->set_options(get_disk_size())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make('select', 'headlights', __("Фари"))
                ->set_options(get_headlights())->set_width(25)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),

            Field::make( "multiselect", "optics", "Оптика" )
                ->add_options(get_optics())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "multimedia", "Мультимедіа" )
                ->add_options(get_multimedia())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "comfort", "Салон та комфорт" )
                ->add_options(get_comfort())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "airbags", "Подушки безпеки" )
                ->add_options(get_airbags())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "parking_help", "Система допомоги паркування" )
                ->add_options(get_parking_help())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "electro_save", "Електронні системи безпеки" )
                ->add_options(get_electro_save())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "bodywork", "Кузов" )
                ->add_options(get_bodywork())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
            Field::make( "multiselect", "safety", "Безпека" )
                ->add_options(get_safety())
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),


            Field::make('text', 'charge_speed', __('Швидкість заряду від 0% до 100%, годин:', 'crb'))->set_width(33)
            ->set_conditional_logic(array(
                    array(
                        'field' => 'product_type',
                        'value' => '1',
                        'compare' => '=',
                    )
                )),
        ));

    Container::make('post_meta', 'Главная страница')
        ->where('post_template', '=', 'template-home.php')
        ->add_tab('Первый экран', array(
            Field::make('image', 'main_bg_img', 'Картинка на задний фон')->set_value_type('url'),
            Field::make('textarea', 'main_title', __('Заголовок', 'crb'))->set_width(33),
            Field::make('textarea', 'main_title_mobile', __('Заголовок на телефоне', 'crb'))->set_width(33),
            Field::make('text', 'main_button', __('Текст кнопки', 'crb'))->set_width(33),
        ))
        ->add_tab('Про нас', array(
            Field::make('image', 'about_bg_img', 'Картинка на задний фон')->set_value_type('url'),
            Field::make('image', 'about_img', 'Картинка')->set_value_type('url'),
            Field::make('textarea', 'about_title', __('Заголовок', 'crb'))->set_width(100),
            Field::make('textarea', 'about_desc', __('Описание', 'crb'))->set_width(100),
            Field::make('text', 'about_button', __('Текст кнопки', 'crb'))->set_width(100),
        ));

    Container::make('post_meta', 'Сторінка INFO')
        ->where('post_template', '=', 'template-info.php')
        ->add_tab('Контент', array(
            Field::make('text', 'info_page_title', __('Заголовок', 'crb'))->set_width(33),
            Field::make('textarea', 'info_page_text', __('Текст', 'crb'))->set_width(33),
            Field::make('image', 'info_page_img', 'Головне зображення')->set_value_type('url'),
            Field::make('text', 'info_page_button_text', __('Текст кнопки під зображенням (optional)', 'crb'))->set_width(33),
            Field::make('text', 'info_page_button_link', __('Посилання кнопки під зображенням (optional)', 'crb'))->set_width(33),
            Field::make('text', 'info_page_items_title', __('Заголовок плашок', 'crb'))->set_width(33),
            Field::make('complex', 'info_page_items', 'Плашки')
                ->add_fields(array(
                        Field::make('image', 'info_page_items_img', 'Зображення (optional)')->set_value_type('url'),
                        Field::make('textarea', 'info_page_items_text', 'Текст (optional)')
                            ->set_width(100),
                        Field::make('text', 'info_page_items_link_text', 'Текст посилання (optional)')
                            ->set_width(100),
                        Field::make('text', 'info_page_items_link', 'Посилання (optional)')
                            ->set_width(100),
                    )
                ),
        ));

    Container::make('post_meta', 'О нас')
        ->where('post_template', '=', 'template-about.php');


    Container::make('post_meta', ' Контакты')
        ->where('post_template', '=', 'template-contact.php')
        ->add_tab('Контакты', array(
            Field::make('text', 'contact_title_uk', __('Заголовок на UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_title_ru', __('Заголовок на RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_title_en', __('Заголовок на EN ', 'crb'))->set_width(33),
            Field::make('text', 'contact_sub_uk', __('Под заголовк на UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_sub_ru', __('Под заголовк на RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_sub_en', __('Под заголовк на EN ', 'crb'))->set_width(33),
            Field::make('text', 'contact_time_uk', __('Время на UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_time_ru', __('Время на RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_time_en', __('Время на EN ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_uk', __('Тех под. на UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_ru', __('Тех под. на RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_en', __('Тех под. на EN ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_sub_uk', __('Тех под. под-заголовок на UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_sub_ru', __('Тех под. под-заголовок на RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_sub_en', __('Тех под. под-заголовок на EN ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_time_uk', __('Тех под. времяна UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_time_ru', __('Тех под. времяна RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_techikal_time_en', __('Тех под. времяна EN ', 'crb'))->set_width(33),

        ))
        ->add_tab('Данные', array(
            Field::make('text', 'contact_adress_uk', __('Заголовок на UA ', 'crb'))->set_width(33),
            Field::make('text', 'contact_adress_ru', __('Заголовок на RU ', 'crb'))->set_width(33),
            Field::make('text', 'contact_adress_en', __('Заголовок на EN ', 'crb'))->set_width(33),
            Field::make('rich_text', 'contact_more_uk', __('Юр данные на UA ', 'crb'))->set_width(33),
            Field::make('rich_text', 'contact_more_ru', __('Юр данные на RU ', 'crb'))->set_width(33),
            Field::make('rich_text', 'contact_more_en', __('Юр данные на EN ', 'crb'))->set_width(33),
        ));
    Container::make('term_meta', 'Категория')
        ->where('term_taxonomy', '=', 'category')
        ->add_fields(array(
            Field::make('image', 'car_class_image', 'Картинка категории')->set_value_type('url'),
            Field::make('textarea', 'sing_main_sub_text', __('Текст', 'crb'))->set_width(100),
            Field::make('textarea', 'sing_main_sub_text_mob', __('Текст для моб', 'crb'))->set_width(100),

        ));
}


//add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
    //remove_menu_page('options-general.php'); // Удаляем раздел Настройки
  //  remove_menu_page('tools.php'); // Инструменты
    //remove_menu_page('users.php'); // Пользователи
   // remove_menu_page('plugins.php'); // Плагиныss
  //s  remove_menu_page('themes.php'); // Внешний вид
   // remove_menu_page('edit.php'); // Посты блога
   // remove_menu_page('upload.php'); // Медиабиблиотека
    //remove_menu_page('edit.php?post_type=page'); // Страницы
    remove_menu_page('edit-comments.php'); // Комментарии
    remove_menu_page('link-manager.php'); // Ссылки
//    remove_menu_page('wpcf7');   // Contact form 7
    remove_menu_page('litespeed');   // Contact form 7
 //   remove_menu_page('duplicator');   // Contact form 7
    //remove_menu_page('mlang');   // Contact form 7
    remove_menu_page('wpseo_dashboard');   // Contact form 7
    remove_menu_page('options-framework'); // Cherry Framework
}
function custom_globus_change()
{
    if (class_exists('WPGlobus')) {
        $enabled_languages = apply_filters('wpglobus_extra_languages', WPGlobus::Config()->enabled_languages, WPGlobus::Config()->language);
        $a = '';
        $span = '';
        if (WPGlobus::Config()->language == 'ru') {
            $enabled_languages = array_reverse($enabled_languages);
        }
        foreach ($enabled_languages as $language) {
            $url = null;

            if ($language != WPGlobus::Config()->language) {
                $url = WPGlobus_Utils::localize_current_url($language);
                $a .= '<div class="leng_bl">';
                $a .= '<a href="' . $url . '"><img src="' . get_template_directory_uri() . '/img/' . $language . '.svg"></a>';
                $a .= '</div>';

            } else {
                $span .= '<div class="leng_bl-ch">';
                $span .= '<span><img src="' . get_template_directory_uri() . '/img/' . $language . '.svg"></span>';
                $span .= '</div>';
            }
        }
        $result = $span . $a;

        return $result;
    }
}

add_action('customize_register', 'wpb_customize_register');
register_nav_menus(array(
    'top' => 'Верхнее меню'
));

add_theme_support('post-thumbnails');


register_nav_menus(array(
    'top' => 'Главное меню',
    'catalog_drop_menu' => 'Выпадающее меню каталога',
    'burger_menu' => 'Випадаюче меню',
    'blocks_menu' => 'Блокове меню',
));


//add_action('init', 'true_register_post_type_init'); // Использовать функцию только внутри хука init

function true_register_post_type_init()
{
    $labels = array(
        'name' => 'Новости',
        'singular_name' => 'Новости', // админ панель Добавить->Функцию
        'add_new' => 'Добавить машину',
        'add_new_item' => 'Добавить новую машину', // заголовок тега <title>
        'edit_item' => 'Редактировать машину',
        'new_item' => 'Новая услуга',
        'all_items' => 'Все Новости',
        'view_item' => 'Просмотр Новости на сайте',
        'search_items' => 'Искать Новости',
        'not_found' => 'Новости не найдено.',
        'not_found_in_trash' => 'В корзине нет машин.',
        'menu_name' => 'Новости' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'has_archive' => true,
        'rewrite' => true,
        'menu_icon' => 'dashicons-car', // иконка в меню
        'menu_position' => 20, // порядок в меню
        'supports' => array('title', 'editor', 'revisions', 'post-formats'),
        //'taxonomies'          => array( 'category' ),

    );
    register_post_type('cars', $args);

    $args = array(
        'labels' => array(
            'name' => 'Класс машины', // основное название во множественном числе
            'singular_name' => 'Класс машины', // название единичного элемента таксономии
            'menu_name' => 'Класс машины', // Название в меню. По умолчанию: name.
            'all_items' => 'Все классы машины',
            'edit_item' => 'Изменить класс машины',
            'view_item' => 'Просмотр классы машины', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item' => 'Обновить класс машины',
            'add_new_item' => 'Добавить новый класс машины',
            'new_item_name' => 'Название нового класса машины',
            'parent_item' => 'Родительский класс машины', // только для таксономий с иерархией
            'parent_item_colon' => 'Родительский класс машины:',
            'search_items' => 'Искать классы машины',
            'popular_items' => 'Популярные классы машины', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте классы машины запятыми',
            'add_or_remove_items' => 'Добавить или удалить классы машины',
            'choose_from_most_used' => 'Выбрать из часто используемых классов машин',
            'not_found' => 'Класс машины не найдено',
            'back_to_items' => '← Назад к классам машин',

        ),
        'rewrite' => true,
    );
    register_taxonomy('car_class', 'cars', $args);

    $args = array(
        'labels' => array(
            'name' => 'Города', // основное название во множественном числе
            'singular_name' => 'Город', // название единичного элемента таксономии
            'menu_name' => 'Города', // Название в меню. По умолчанию: name.
            'all_items' => 'Все Города',
            'edit_item' => 'Изменить город',
            'view_item' => 'Просмотр город', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item' => 'Обновить город',
            'add_new_item' => 'Добавить новый город',
            'new_item_name' => 'Название нового город',
            'parent_item' => 'Родительский город', // только для таксономий с иерархией
            'parent_item_colon' => 'Родительский город:',
            'search_items' => 'Искать города',
            'popular_items' => 'Популярные города', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте города запятыми',
            'add_or_remove_items' => 'Добавить или удалить города',
            'choose_from_most_used' => 'Выбрать из часто используемых городов',
            'not_found' => 'Город не найдено',
            'back_to_items' => '← Назад к городам',

        )
    );
    register_taxonomy('cities', 'cars', $args);
}

add_filter('excerpt_length', function () {
    return 20;
});

function wp_pll_translate_array($string)
{
    return $string . '_' . pll_current_language();
}

function breadcrumbs()
{

    // получаем номер текущей страницы
    $page_num = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $separator = ''; //  разделяем обычным слэшем, но можете чем угодно другим

    // если главная страница сайта
    if (is_front_page()) {

        if ($page_num > 1) {
            echo '<a href="' . site_url() . '">Главная</a>' . $separator . $page_num . pll__('-а сторінка');
        } else {
            echo 'Вы находитесь на главной странице';
        }

    } else { // не главная

        echo '<li class="list-item "><a href="' . site_url() . '">Головна</a></li>' . $separator;


        if (is_single()) { // записи

            $arg = get_the_category();

            echo '<li class="list-item active"><a href="'.get_category_link($arg[0]->term_id).'">'.$arg[0]->name.'</a></li>';
            echo $separator;
            echo '<li class="list-item active">'.get_the_title().'</li>';

        } elseif (is_page()) { // страницы WordPress

            echo '<li class="list-item active">'.get_the_title().'</li>';

        } elseif (is_category()) {

            '<span>'.single_cat_title().'</span>';

        } elseif (is_tag()) {

            single_tag_title();

        } elseif (is_day()) { // архивы (по дням)

            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $separator;
            echo get_the_time('d');

        } elseif (is_month()) { // архивы (по месяцам)

            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
            echo get_the_time('F');

        } elseif (is_year()) { // архивы (по годам)

            echo get_the_time('Y');

        } elseif (is_author()) { // архивы по авторам

            global $author;
            $userdata = get_userdata($author);
            echo 'Опубликовал(а) ' . $userdata->display_name;

        } elseif (is_404()) { // если страницы не существует

            echo 'Ошибка 404';

        }

        if ($page_num > 1) { // номер текущей страницы
            echo ' (' . $page_num . pll__('-а сторінка') . ')';
        }

    }

}

function _getParam($array, $alias)
{
    foreach ($array as $item) {
        if ($item['alias'] == $alias) {
            return $item;
        }
    }
    return null;
}


/*
 * Функция создает дубликат поста в виде черновика и редиректит на его страницу редактирования
 */
function true_duplicate_post_as_draft()
{
    global $wpdb;
    if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'true_duplicate_post_as_draft' == $_REQUEST['action']))) {
        wp_die('Нечего дублировать!');
    }

    /*
     * получаем ID оригинального поста
     */
    $post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
    /*
     * а затем и все его данные
     */
    $post = get_post($post_id);

    /*
     * если вы не хотите, чтобы текущий автор был автором нового поста
     * тогда замените следующие две строчки на: $new_post_author = $post->post_author;
     * при замене этих строк автор будет копироваться из оригинального поста
     */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    /*
     * если пост существует, создаем его дубликат
     */
    if (isset($post) && $post != null) {

        /*
         * массив данных нового поста
         */
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status' => $post->ping_status,
            'post_author' => $new_post_author,
            'post_content' => $post->post_content,
            'post_excerpt' => $post->post_excerpt,
            'post_name' => $post->post_name,
            'post_parent' => $post->post_parent,
            'post_password' => $post->post_password,
            'post_status' => 'draft', // черновик, если хотите сразу публиковать - замените на publish
            'post_title' => $post->post_title,
            'post_type' => $post->post_type,
            'to_ping' => $post->to_ping,
            'menu_order' => $post->menu_order
        );

        /*
         * создаем пост при помощи функции wp_insert_post()
         */
        $new_post_id = wp_insert_post($args);

        /*
         * присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
         */
        $taxonomies = get_object_taxonomies($post->post_type); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        /*
         * дублируем все произвольные поля
         */
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos) != 0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query .= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }


        /*
         * и наконец, перенаправляем пользователя на страницу редактирования нового поста
         */
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    } else {
        wp_die('Ошибка создания поста, не могу найти оригинальный пост с ID=: ' . $post_id);
    }
}

add_action('admin_action_true_duplicate_post_as_draft', 'true_duplicate_post_as_draft');

/*
 * Добавляем ссылку дублирования поста для post_row_actions
 */
function true_duplicate_post_link($actions, $post)
{
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="admin.php?action=true_duplicate_post_as_draft&post=' . $post->ID . '" title="Дублировать этот пост" rel="permalink">Дублировать</a>';
    }
    return $actions;
}

add_filter('post_row_actions', 'true_duplicate_post_link', 10, 2);


add_action('init', 'setCurrency');

function setCurrency()
{
    if (!isset($_COOKIE['currency']) || $_COOKIE['currency'] != 'uah' && $_COOKIE['currency'] != 'usd') {
        setcookie('currency', 'uah', time() + 31556926, COOKIEPATH, COOKIE_DOMAIN);
    }
}

if (is_user_logged_in()) {
    add_action('wp_ajax_setLang', 'setLang');
} else {
    add_action('wp_ajax_nopriv_setLang', 'setLang');
}

function setLang()
{

    check_ajax_referer('currency', 'security');
    if (isset($_POST['currency'])) {
        if ($_POST['currency'] == 'uah' || $_POST['currency'] == 'usd') {
            setcookie('currency', $_POST['currency'], time() + 31556926, COOKIEPATH, COOKIE_DOMAIN);
        }
    }
}

function getCurrency()
{
    return $_COOKIE['currency'];
}

function getPrice($price, $currency)
{
    if ($currency == 'uah') {
        return $price . ' грн';
    } else {
        $usd = carbon_get_theme_option('usd');
        $price = $price / $usd;
        return round($price, 2) . ' $';
    }
}

//mx
if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    if($current_user->user_login === 'm_admin') {
        show_admin_bar( false );
    }
}