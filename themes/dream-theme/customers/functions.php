<?php
require_once 'carbon.php';



if(
    isset($_GET['loggedout']) && $_GET['loggedout'] === 'true'
){
    wp_redirect( home_url() );
    exit;
}
/**
 * Use once
 */
if(isset($_GET['create_role']) && $_GET['create_role'] === 'Q*zrmCwWtQ4GG6d$Xwzb^WCt'){
    die();
    $result = add_role( 'agent', 'Агент',
        array(
            'read'         => true,
        )
    );

    echo '<pre>'; var_dump($result); die;
}


function get_type_prices() {
    $carbon_prices = [
        '' => 'Выберите'
    ];

    $prices = carbon_get_theme_option('type_price_customers');
    foreach ($prices as $price){
        $carbon_prices[$price['code']] =  $price['name'];
    }
    return $carbon_prices;
}


if(is_user_logged_in()){
    $user_role = get_userdata(get_current_user_id());
    $user_role = $user_role->roles[0] ?? '';
    if($user_role === 'customer' || $user_role === 'agent' ){
        if ( is_admin() && ! current_user_can( 'administrator' ) &&
            ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
            wp_redirect( home_url() );
            exit;
        }
        add_filter( 'show_admin_bar', '__return_false' );
    }
    add_action( 'wp_ajax_customer_auth', 'customer_auth');
} else {
    add_action( 'wp_ajax_nopriv_customer_auth', 'customer_auth');
}

function customer_auth(){
    check_ajax_referer( 'nonce', 'security' );

    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $auth = wp_authenticate( $email, $password );

        if(is_wp_error($auth)) {
            wp_die(json_encode([
                'success' => false,
            ]));
        }else {
            $user = get_userdata($auth->ID);
            $user_role = $user->roles[0] ?? false;

            if($user_role && $user_role == 'agent'){
                $active = carbon_get_user_meta($user->ID, 'user_active');

                if(!$active){
                    wp_logout();
                    wp_die(json_encode([
                        'success' => false,
                        'modal' => 'no-active',
                    ]));
                }
            }

            wp_set_auth_cookie( $auth->ID );
            wp_die(json_encode([
                'success' => true,
            ]));
        }
    }

    wp_die(json_encode([
        'success' => false,
    ]));
}

function get_current_price($id){
    if(is_user_logged_in()){
        $user = get_userdata(get_current_user_id());
        $user_role = $user->roles[0] ?? '';
        if($user_role === 'customer'){
            $user_group = carbon_get_user_meta($user->ID,'user_price_group');
            if($user_group){
               $price =  carbon_get_post_meta($id,'price_group_' . $user_group);
               if($price){
                   return $price;
               }
            }
        }
    }
    return false;
}


function my_custom_login_logo()
{
    echo '<style> h1 a {  background-image:url(' . carbon_get_theme_option('logo')  . ')  !important; } </style>';
}
add_action('login_head',  'my_custom_login_logo');

function wpse_lost_password_redirect() {
    wp_redirect( home_url() );
    exit;
}
add_action('after_password_reset', 'wpse_lost_password_redirect');


function check_agent_user_account(){
    $users = get_users([
        'role' => 'agent'
    ]);

    $current_date = time();

    if($users){
        foreach ($users as $user) {
            $added_date =  strtotime($user->user_registered . ' +90 days');
            if($added_date < $current_date){
                carbon_set_user_meta($user->ID, 'user_active', 'no');
            }
        }
    }
}


function agent_user_should_save_field_value( $save, $value, $field ) {

    if ( $field->get_base_name() === 'user_active' ) {
        $user_id = $_POST['user_id'] ?? false;

        if($user_id){
            $user = get_userdata($user_id);
            $user_role = $user->roles[0] ?? '';

            if($user_role == 'agent' && $value == 'yes'){
                $added_date =  strtotime($user->user_registered . ' +89 days');

                if(time() > $added_date){
                    $user_data = array(
                        'ID' => $user_id,
                        'user_registered' => current_time('mysql', true)
                    );
                    wp_update_user($user_data);
                }
            }
        }
    }
    return $save;
}

function check_agent_user_account_register() {

    if (!wp_next_scheduled('check_agent_user_account_cron')) {
        wp_schedule_event(time(), 'daily', 'check_agent_user_account_cron');
    }
}
function check_agent_user_account_deactivate() {
    wp_clear_scheduled_hook('check_agent_user_account_cron');
}

add_filter( 'carbon_fields_should_save_field_value', 'agent_user_should_save_field_value', 10, 3 );

add_action('init', 'check_agent_user_account');
add_action('init', 'check_agent_user_account_register');
add_action('check_agent_user_account_cron', 'check_agent_user_account');
register_deactivation_hook(__FILE__, 'check_agent_user_account_deactivate');
