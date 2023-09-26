<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

function get_prices_groups(){
    $prices = carbon_get_theme_option('type_price_customers');
    $result = [];

    foreach ($prices as $price) {
        $result[] = Field::make('text','price_group_' . $price['code'],'Группа ' . $price['name'] );
    }

    return $result;
}

add_action( 'carbon_fields_register_fields', 'crb_customer_options' );
function crb_customer_options() {

    Container::make( 'theme_options',99, __( 'Типы цен' ) )
        ->set_icon( 'dashicons-money-alt' )
        ->add_fields( array(
            Field::make( 'complex', 'type_price_customers', __( 'Типы цен' ) )
                ->add_fields( array(
                    Field::make( 'text', 'code', __( 'Уникальный код' ) )->set_width(20),
                    Field::make( 'text', 'name', __( 'Название' ) )->set_width(80),
                ) )
        ) );



    Container::make( 'user_meta', 100, 'Тип цены' )
        ->add_fields( array(
            Field::make( 'checkbox', 'user_active', 'Користувач активний' )
                ->set_option_value( 'yes' ),
            Field::make( 'text', 'user_price_phone', __( 'Телефон' ) ),
            Field::make( 'text', 'city', __( 'Місто' ) ),
            Field::make( 'text', 'location', __( 'Адреса' ) ),
            Field::make( 'select', 'user_price_group', __( 'Тип цены' ) )
                ->set_options( get_type_prices() )
        ) );
}