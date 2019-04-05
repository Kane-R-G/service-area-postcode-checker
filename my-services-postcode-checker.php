<?php
/*
Plugin Name: Service Area Postcode Checker
Plugin URI: http://wordpress.plustime.com.au/service-area-postcode-checker/
Description: Customizable plugin that creates an input box to allow your vistors to check if you service or deliver to their area through a postcode check.
Version: 2.0.6
Text Domain: sapc-domain
Author: second2none
Author URI: http://wordpress.plustime.com.au/
License: GPL2
*/


if( ! defined( 'WP_CONTENT_DIR' ) ) {if ( ! defined( 'ABSPATH' ) ) { exit; } }

include( plugin_dir_path( __FILE__ ) . 'options.php' );

add_action( 'plugins_loaded' , 'sapc_init_plugin' );

include( plugin_dir_path( __FILE__ ) . 'my-services-postcode-widget.php' );
include( plugin_dir_path( __FILE__ ) . 'my-services-postcode-display-widget.php' );

add_action( 'widgets_init' , 'register_sapc_widget' );
add_action( 'widgets_init' , 'register_sapc_display_widget' );

function register_sapc_widget(){
    return register_widget("sapc_Widget");
}
function register_sapc_display_widget(){
    return register_widget("sapc_display_Widget");
}

function sapc_init_plugin(){
    add_action( 'admin_menu' , 'sapc_create_menu' );
}

function sapc_create_menu() {
	add_menu_page( __( 'Service Area Postcode Checker Settings' , 'sapc-domain') , __( 'Postcode Settings' , 'sapc-domain') , 'manage_options' , 'sapc_options' , 'sapc_settings_page' , 'dashicons-search' );
	add_action( 'admin_init', 'register_sapc_settings' );
}

function sapc_admin_scripts( $args ){
    $current_screen = get_current_screen();
    if( strpos( $current_screen->base , 'sapc_options' ) !== false ) {
        wp_enqueue_style( 'sapc_admin_css' , plugins_url( 'css/admin_page_css.css' , __FILE__ ) , false , '2.0.6' , 'all' );
        wp_enqueue_script( 'sapc_admin_js' , plugins_url( 'js/sapc_admin.js' , __FILE__ ) , array( 'jquery') , '2.0.6' , true );
    }
} 
add_action( 'admin_enqueue_scripts' , 'sapc_admin_scripts' );

function sapc_scripts_with_jquery(){
    wp_enqueue_script( 'postcode-checker' , plugins_url( '/js/my_services_postcode_checker.js' , __FILE__ ) , array( 'jquery' ) , '2.0.6' );
    wp_localize_script( 'postcode-checker' , 'sapc_CHECKER' , array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_style( 'sapc_css' , plugins_url( '/css/my_services_postcode_checker.css' , __FILE__ ) , false , '2.0.6' , 'all' );
}
add_action( 'wp_enqueue_scripts', 'sapc_scripts_with_jquery' );

function sapc_activate() {
   
    $checkersettings = get_option( 'sapc_checker_settings_options' );
    $submitsettings = get_option( 'sapc_checker_settings_submit_options' );
    $displaysettings = get_option( 'sapc_checker_settings_display_options' );
    $listsettings = get_option( 'sapc_list_settings_options' );
    
    $checker_defaults = array(
            'checker-ONOFF'           => 'on',
            'title-checker'           => __( ( isset( $checkersettings['title-checker'] ) ) ? $checkersettings['title-checker'] : 'Do We Service Your Postcode?' , 'sapc-domain'),
            'message-success'         => __( ( isset( $checkersettings['message-success'] ) ) ? $checkersettings['message-success'] : 'Awesome, we currently do service your postcode!' , 'sapc-domain'),
            'message-error'           => __( ( isset( $checkersettings['message-error'] ) ) ? $checkersettings['message-error'] : 'We haven\'t expanded to your postcode yet, but contact us to see when we might!' , 'sapc-domain'),
            'class-success'           =>     ( isset( $checkersettings['class-success'] ) ) ? $checkersettings['class-success'] : 'mgreen',
            'placeholder'             =>     ( isset( $checkersettings['placeholder'] ) ) ? $checkersettings['placeholder'] : 'Start Typing Your Postcode',
            'class-error'             =>     ( isset( $checkersettings['class-error'] ) ) ? $checkersettings['class-error'] : 'mred',
            'postcodes'               => ''
    ); 
    
    $submit_defaults = array(
        'verify-integer'          =>     ( isset( $submitsettings['verify-integer'] ) ) ? $submitsettings['verify-integer'] : 'on',
        'enable-enter'            =>     ( isset( $submitsettings['enable-enter'] ) ) ? $submitsettings['enable-enter']  : 'off',
        'type-trigger'            =>     ( isset( $submitsettings['type-trigger'] ) ) ? $submitsettings['type-trigger'] : 'on',
        'trigger-value'           =>     ( isset( $submitsettings['trigger-value'] ) ) ? $submitsettings['trigger-value']  : '4',
        'enable-button'           =>     ( isset( $submitsettings['enable-button'] ) ) ? $submitsettings['enable-button'] : 'off',
        'button-class'            =>     ( isset( $submitsettings['button-class'] ) ) ? $submitsettings['button-class'] : 'bbw',
        'button-txt'              => __( ( isset( $submitsettings['button-txt'] ) ) ? $submitsettings['button-txt'] : 'Search' , 'sapc-domain'),
        'redirect'                =>     ( isset( $submitsettings['redirect'] ) ) ? $submitsettings['redirect'] : '',
    ); 
    $display_defaults = array(
        'display-ONOFF'           =>     ( isset( $displaysettings['verify-integer'] ) ) ? $displaysettings['verify-integer'] : 'on',
        'title-display'           => __( ( isset( $displaysettings['title-display'] ) ) ? $displaysettings['title-display'] : 'We Currently Service These Areas' , 'sapc-domain'),
        'class-display'           =>     ( isset( $displaysettings['class-display'] ) ) ? $displaysettings['class-display'] : 'ds-inline',
        'class-bullet'            =>     ( isset( $displaysettings['class-bullet'] ) ) ? $displaysettings['class-bullet'] : 'class-bullet',
        'list-display'            =>     ( isset( $displaysettings['list-display'] ) ) ? $displaysettings['list-display'] : 'Default'
    );

    $list_default = array(
        'postcodesLists' =>
            array(
            'Label' => 'Default',
            'List'  => ( isset( $checkersettings['postcodes'] ) ) ?  $checkersettings['postcodes'] : 'Brisbane:4000'
            )
    );  
    
    $lists = get_option( 'sapc_list_settings_options' );

    if( isset( $lists['postcodesLists'] ) ){ 
        $list_option    = $lists;    
    }else{
        $list_option    = $list_default;
    }
    
    $checker_option     = wp_parse_args( get_option( 'sapc_checker_settings_options' ) , $checker_defaults );
    $submit_option      = wp_parse_args( get_option( 'sapc_checker_settings_submit_options' ) , $submit_defaults );
    $display_option     = wp_parse_args( get_option( 'sapc_checker_settings_display_options' ) , $display_defaults ); 

    update_option( 'sapc_checker_settings_options' ,            $checker_option ); 
    update_option( 'sapc_checker_settings_submit_options',      $submit_option ); 
    update_option( 'sapc_version' , '2.0.6' );

    
}
register_activation_hook( __FILE__ , 'sapc_activate' );





function sapc_checker_shortcode( $atts ) {
        $submit_settings =  get_option( 'sapc_checker_settings_submit_options' );
        $checker_settings = get_option( 'sapc_checker_settings_options' );
        $listsettings =     get_option( 'sapc_list_settings_options' );
        
        $join_defaults = array(
    		'title'                 => $checker_settings['title-checker'], 
            'success-msg'           => $checker_settings['message-success'], 
            'success-class'         => $checker_settings['class-success'], 
            'error-msg'             => $checker_settings['message-error'],
            'error-class'           => $checker_settings['class-error'], 
            'placeholder'           => $checker_settings['placeholder'], 
            'trigger-value'         => $submit_settings['trigger-value'], 
            'verify-integer'        => $submit_settings['verify-integer'],
            'type-trigger'          => $submit_settings['type-trigger'],
            'enable-enter'          => $submit_settings['enable-enter'],
            'enable-button'         => $submit_settings['enable-button'],
            'button-class'          => $submit_settings['button-class'],
            'button-txt'            => $submit_settings['button-txt'],
            'redirect'              => $submit_settings['redirect'],
            'list-select'           => $listsettings['postcodesLists'][0]['Label']
        );

        if($checker_settings['checker-ONOFF'] != 'off'){
        	$instance = shortcode_atts( $join_defaults , $atts , 'sapc' );

            include( plugin_dir_path( __FILE__ ) . 'php_libraries/postcode_class.php' );
            $postcode = new Postcodes();

            return '<h2 class="widget-title">' . $instance['title'].'</h2>' . $postcode->printPostcodeInput ( $instance );
        }
}
add_shortcode( 'sapc_checker', 'sapc_checker_shortcode' );
function sapc_display_shortcode( $atts ) {
        $display_settings = get_option( 'sapc_checker_settings_display_options' );
        $lists = get_option( 'sapc_list_settings_options' );
        
        $display_defaults = array(     
            'title'         => $display_settings['title-display'], 
            'class-display' => $display_settings['class-display'], 
            'class-bullet'  => $display_settings['class-bullet'],
            'list-display'  => 'Default'
        );
        if( $display_settings['display-ONOFF'] != 'off '){
            //display sitewide is on - run check
            $instance = shortcode_atts( $display_defaults , $atts , 'sapd' );
            
            include( plugin_dir_path( __FILE__ ) . 'php_libraries/postcode_class.php');
            $postcode = new Postcodes(); 
             
            return '<h2 class="widget-title">' . $instance['title'] . '</h2>' . $postcode->printPostcodeList( $postcode->returnListFromLabel( $lists['postcodesLists'] , $instance['list-display'] ) , $instance['class-display'] , $instance['class-bullet'] );
        }
}
add_shortcode( 'sapc_display', 'sapc_display_shortcode' );
