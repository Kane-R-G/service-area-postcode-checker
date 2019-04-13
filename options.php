<?php

function register_sapc_settings() {
    //set defaults
    
    $checker_option     = get_option( 'sapc_checker_settings_options' );
    $submit_option      = get_option( 'sapc_checker_settings_submit_options' );
    $list_option        = get_option( 'sapc_list_settings_options ');
    $display_option     = get_option( 'sapc_checker_settings_display_options' );
    
    //set checkboxs
    $checker_option['checker-ONOFF']    = ( $checker_option['checker-ONOFF']    == 'on' ? 'checked' : '' );
    
    $submit_option['verify-integer']    = ( $submit_option['verify-integer']    == 'on' ? 'checked' : '' );
    $submit_option['enable-enter']      = ( $submit_option['enable-enter']      == 'on' ? 'checked' : '' );
    $submit_option['type-trigger']      = ( $submit_option['type-trigger']      == 'on' ? 'checked' : '' );
    $submit_option['enable-button']     = ( $submit_option['enable-button']     == 'on' ? 'checked' : '' );
    $submit_option['type-trigger'] == 'checked' ? $tv = '' : $tv = 'hide-field';

    $display_option['display-ONOFF']    = ( $display_option['display-ONOFF']    == 'on' ? 'checked' : '' );    
    
    
    //set sections
    add_settings_section( 
        'sapc_checker_settings_op',
        __( 'Default Settings' , 'sapc-domain'),
        'sapc_checker_settings_callback',
        'sapc_checker_settings_op'
    );
    add_settings_section( 
        'sapc_checker_settings_submit_op',
        __( 'Submit Settings' , 'sapc-domain'),
        'sapc_checker_settings_submit_callback',
        'sapc_checker_settings_submit_op'
    );
    add_settings_section( 
        'sapc_checker_settings_display_op',
        __( 'Submit Settings' , 'sapc-domain'),
        'sapc_checker_display_callback',
        'sapc_checker_settings_display_op'
    );
    add_settings_section( 
        'sapc_list_op',
        __( 'Postcode Lists' , 'sapc-domain'),
        'sapc_lists_callback',
        'sapc_list_op'
    );
    add_settings_section( 
        'sapc_display_op',
        __( 'Plugin Details' , 'sapc-domain'),
        'sapc_details_callback',
        'sapc_display_op'
    );
    
    
    //checker fields
    add_settings_field(  
        'checker-ONOFF',                      
        '',               
        'sapc_switch_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'checker-ONOFF', 
            'ID'          => 'checker-ONOFF', 
            'name'        => 'checker-ONOFF',
            'value'       => $checker_option['checker-ONOFF'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => '',
            'hint'        => __( 'Turn Postcode Checker On / Off Sitewide' , 'sapc-domain')
        )
    );
    add_settings_field(  
        'title-checker',                      
        __( 'Title' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'title-checker', 
            'ID'          => 'title-checker', 
            'name'        => 'title-checker',
            'value'       => $checker_option['title-checker'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => ''
        )
    );

    add_settings_field(  
        'message-success',                      
        __( 'Success Message' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'message-success', 
            'ID'          => 'message-success', 
            'name'        => 'message-success',
            'value'       => $checker_option['message-success'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => ''
        )
    );
    add_settings_field(  
        'class-success',                      
        __( 'Success Message Class' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'class-success', 
            'ID'          => 'class-success', 
            'name'        => 'class-success',
            'value'       => $checker_option['class-success'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => '',
            'hint'        => 'Defaults: mgreen, mred, mblue, myellow, mpurple'
        )
    );
    add_settings_field(  
        'message-error',                      
        __( 'Error Message' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'message-error', 
            'ID'          => 'message-error', 
            'name'        => 'message-error',
            'value'       => $checker_option['message-error'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => ''
        )
    );
    add_settings_field(  
        'class-error',                      
        __( 'Error Message Class' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'class-error', 
            'ID'          => 'class-error', 
            'name'        => 'class-error',
            'value'       => $checker_option['class-error'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => '',
            'hint'        => 'Defaults: mgreen, mred, mblue, myellow, mpurple'
        )
    );
    add_settings_field(  
        'placeholder',                      
        __( 'Placeholder Text' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_op',                     
        'sapc_checker_settings_op',
        array (
            'label_for'   => 'placeholder', 
            'ID'          => 'placeholder', 
            'name'        => 'placeholder',
            'value'       => $checker_option['placeholder'],
            'option_name' => 'sapc_checker_settings_options',
            'class'       => '',
            'hint'        => 'Postcode Input Placeholder Text'
        )
    );

    //submit fields
    add_settings_field(  
        'enable-enter',                      
        __( 'Enable Enter' , 'sapc-domain'),               
        'sapc_checkbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'enable-enter', 
            'ID'          => 'enable-enter', 
            'name'        => 'enable-enter',
            'value'       => $submit_option['enable-enter'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => '',
            'hint'        => __( 'If selected pressing Enter on input will check users input' , 'sapc-domain')
        )
    );
    add_settings_field(  
        'verify-integer',                      
        __( 'Verify Integer' , 'sapc-domain'),               
        'sapc_checkbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'verify-integer', 
            'ID'          => 'verify-integer', 
            'name'        => 'verify-integer',
            'value'       => $submit_option['verify-integer'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => '',
            'hint'        => __( 'Checks users input postcode to see if all numbers. Uncheck if postcodes contain letters' , 'sapc-domain')
        )
    );
    add_settings_field(  
        'type-trigger',                      
        __( 'Enable Typing Trigger' , 'sapc-domain'),               
        'sapc_checkbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'type-trigger', 
            'ID'          => 'type-trigger', 
            'name'        => 'type-trigger',
            'value'       => $submit_option['type-trigger'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => '',
            'hint'        => __( 'Checks users input postcode to see if all numbers. Uncheck if postcodes contain letters' , 'sapc-domain')
        )
    );
    
    add_settings_field(  
        'trigger-value',                      
        __( 'Input Trigger Value' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'trigger-value', 
            'ID'          => 'trigger-value', 
            'name'        => 'trigger-value',
            'value'       => $submit_option['trigger-value'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => 'type-trigger '.$tv,
            'hint'        => __( 'Input box character count limit before it triggers the AJAX call to check the postcode' , 'sapc-domain')
        )
    );
    add_settings_field(  
        'enable-button',                      
        __( 'Enable Button' , 'sapc-domain'),               
        'sapc_checkbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'enable-button', 
            'ID'          => 'enable-button', 
            'name'        => 'enable-button',
            'value'       => $submit_option['enable-button'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => '',
            'hint'        => __( 'Checks users input postcode to see if all numbers. Uncheck if postcodes contain letters' , 'sapc-domain')
        )
    );
    $submit_option['enable-button'] == 'checked' ? $eb = '' : $eb = 'hide-field';
    add_settings_field(  
        'button-class',                      
        __( 'Button Class' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'button-class', 
            'ID'          => 'button-class', 
            'name'        => 'button-class',
            'value'       => $submit_option['button-class'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => 'enable-button '.$eb,
            'hint'        => __( 'Input box character count limit before it triggers the AJAX call to check the postcode' , 'sapc-domain')
        )
    );
    add_settings_field(  
        'button-txt',                      
        __( 'Button Text' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'button-txt', 
            'ID'          => 'button-txt', 
            'name'        => 'button-txt',
            'value'       => $submit_option['button-txt'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => 'enable-button '.$eb,
            'hint'        => __( 'Input box character count limit before it triggers the AJAX call to check the postcode' , 'sapc-domain')
        )
    );
    
    add_settings_field(  
        'redirect',                      
        __( 'Redirect URL' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_submit_op',                     
        'sapc_checker_settings_submit_op',
        array (
            'label_for'   => 'redirect', 
            'ID'          => 'redirect', 
            'name'        => 'redirect',
            'value'       => $submit_option['redirect'],
            'option_name' => 'sapc_checker_settings_submit_options',
            'class'       => '',
            'hint'        => __( 'Redirect URL on successful match - Blank = No redirect' , 'sapc-domain')
        )
    );
    //display settings
    
    add_settings_field(  
        'display-ONOFF',                      
        '',               
        'sapc_switch_callback',   
        'sapc_checker_settings_display_op',                     
        'sapc_checker_settings_display_op',
        array (
            'label_for'   => 'display-ONOFF', 
            'ID'          => 'display-ONOFF', 
            'name'        => 'display-ONOFF',
            'value'       => $display_option['display-ONOFF'],
            'option_name' => 'sapc_checker_settings_display_options',
            'class'       => '',
            'hint'        => __( 'Turn Postcode Display On / Off Sitewide' , 'sapc-domain')
        )
    );
    add_settings_field(  
        'title-display',                      
        __( 'Title' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_display_op',                     
        'sapc_checker_settings_display_op',
        array (
            'label_for'   => 'title-display', 
            'ID'          => 'title-display', 
            'name'        => 'title-display',
            'value'       => $display_option['title-display'],
            'option_name' => 'sapc_checker_settings_display_options',
            'class'       => '',
            'hint'        => ''
        )
    );
    add_settings_field(  
        'class-display',                      
        __( 'Display Class' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_display_op',                     
        'sapc_checker_settings_display_op',
        array (
            'label_for'   => 'class-display', 
            'ID'          => 'class-display', 
            'name'        => 'class-display',
            'value'       => $display_option['class-display'],
            'option_name' => 'sapc_checker_settings_display_options',
            'class'       => '',
            'hint'        => sprintf( __( 'Defaults: Left Blank %s' , 'sapc-domain' ) , ' -> display: block, ds-inline -> display: inline-block' )
        )
    );
    add_settings_field(  
        'class-bullet',                      
        __( 'Display Class' , 'sapc-domain'),               
        'sapc_textbox_callback',   
        'sapc_checker_settings_display_op',                     
        'sapc_checker_settings_display_op',
        array (
            'label_for'   => 'class-bullet', 
            'ID'          => 'class-bullet', 
            'name'        => 'class-bullet',
            'value'       => $display_option['class-bullet'],
            'option_name' => 'sapc_checker_settings_display_options',
            'class'       => '',
            'hint'        => sprintf( __( 'Defaults: %s' , 'sapc-domain' ) , ' bgreen, bblue, bred, byellow, bpurple' )
        )
    );
    //list settings
    add_settings_field(  
        'addlistButton',                      
        '',               
        'spac_custom_button',   
        'sapc_list_op',                     
        'sapc_list_op',
        array (
            'label_for'   => '', 
            'ID'          => 'add-list', 
            'value'       => __( 'Add List' , 'sapc-domain'),
            'class'       => ''
        )
    );
    add_settings_field(  
        'postcodesLists',                      
        'Postcode List',               
        'sapc_listarea_callback',   
        'sapc_list_op',                     
        'sapc_list_op',
        array (
            'label_for'   => 'postcodesLists', 
            'ID'          => 'postcodesLists', 
            'value'       => $list_option['postcodesLists'],
            'option_name' => 'sapc_list_settings_options',
            'class'       => ''
        )
    );
    
    
    
    
    //detail settings
    add_settings_field(  
        'plugindetails',                      
        '',               
        'sapc_infobox_callback',   
        'sapc_display_op',                     
        'sapc_display_op',
        array ( 
            'ID'          => 'plugindetails',
            'title'       => 'Donate',
            'class'       => '',
            'text'        => sprintf ( __( 'This plugin will always be free but to help improve the chances of it being updated regularly and new features introduced, please %s Share the love and donate here. ' , 'sapc-domain' ), '<a href="http://wordpress.plustime.com.au/donate/" target="_blank">' , '<a/>' )
        )
    );
    
    
    //register settings
    $checker_args   = array( 'sanitize_callback'   => 'sapc_checker_post_callback' );
    $display_args   = array( 'sanitize_callback'   => 'sapc_display_post_callback' );
    $list_args      = array( 'sanitize_callback'   => 'sapc_list_post_callback' );
        
    register_setting( 'sapc_checker_settings' , 'sapc_checker_settings_options' , $checker_args );
    register_setting( 'sapc_checker_settings' , 'sapc_checker_settings_submit_options' , $checker_args );
    register_setting( 'sapc_list_settings' , 'sapc_list_settings_options' , $list_args );
    register_setting( 'sapc_checker_settings_display' , 'sapc_checker_settings_display_options' , $display_args );
}
function sapc_list_post_callback( $input ){
    return $input;
}
function sapc_display_post_callback( $input ) {
    if( ! isset( $input['display-ONOFF'] ) ){ $input['display-ONOFF'] = 'off'; } 
    return $input; 
}
function sapc_checker_post_callback( $input ) {
    if( ! isset( $input['checker-ONOFF'])){    $input['checker-ONOFF'] = 'off'; }    
    if( ! isset( $input['verify-integer'])){   $input['verify-integer'] = 'off'; }
    if( ! isset( $input['enable-enter'])){     $input['enable-enter'] = 'off'; }
    if( ! isset( $input['type-trigger'])){     $input['type-trigger'] = 'off'; }
    if( ! isset( $input['enable-button'])){    $input['enable-button'] = 'off'; }
    return $input;  
}
function sapc_checker_settings_submit_callback( $args ) { 
    printf( '<p>%s</p>', __( 'Determine how the widget should be submitted' , 'sapc-domain' ) );
}
function sapc_lists_callback( $args ) { 
    printf( '<p>%s</p>', __( 'Create and Edit your Postcode Lists' , 'sapc-domain' ) );
}
function sapc_details_callback( $args ) { 
    printf( '<p>%s<a href="http://wordpress.plustime.com.au/service-area-postcode-checker/" target="_blank">Second2None</a></p>', __( 'For more information head to: ' , 'sapc-domain' ) );
}
function sapc_checker_settings_callback( $args ) { 
    printf( '<p>%s [sapc_checker] <a href="http://wordpress.plustime.com.au/service-area-postcode-checker/" target="_blank">%s</a></p>', __( 'Shortcode:' , 'sapc-domain' ), __( 'Shortcode Options' , 'sapc-domain' ) );
    printf( '<p>%s</p>', __( 'These settings are used when shortcodes aren\'t passed options' , 'sapc-domain' ) );
}
function sapc_checker_display_callback( $args ) { 
    printf( '<p>%s [sapc_display] <a href="http://wordpress.plustime.com.au/service-area-postcode-checker/" target="_blank">%s</a></p>', __( 'Shortcode:' , 'sapc-domain' ), __( 'Shortcode Options' , 'sapc-domain' ) );
    printf( '<p>%s</p>', __( 'These settings are used when shortcodes aren\'t passed options' , 'sapc-domain' ) );
}
function spac_custom_button ( $args ){
    echo '<button id="' . $args["ID"] . '" class="' . $args["class"] . '"> ' . $args["value"] . ' </button> ';
}
function sapc_switch_callback( $args ){
    echo '<div class="onoffswitch">
                <input type="checkbox" name="' . $args["option_name"] . '[' . $args["ID"] . ']" class="onoffswitch-checkbox" id="' . $args["ID"] . '" ' . $args["value"] . '>
                <label class="onoffswitch-label" for="' . $args["ID"] . '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
          </div>';         
    echo ( isset( $args["hint"] ) ? '<p class="hint">' . $args["hint"] . '</p>' : '' );
}
function sapc_listarea_callback( $args ){
    $html = '';
    if( ! is_array( $args['value'] ) || empty( $args['value'] ) ){
        $args['value'] = array(
                                array(
                                'Label' => 'Default',
                                'List'  => '4000:Brisbane'
                                )
                            );
    }
    $i = 0;
    foreach( $args['value'] as $list ){
        $html .= '<div class="postcode-list-container field-40">';
        $html .= '<div class="delete-list"> <a href="#" class="deletelist">X</a></div>';
        $html .= '<p>List Name:</p>';
        $html .= '<input type="text" name="' . $args["option_name"] . '[' . $args["ID"] . ']['.$i.'][Label]" value="' . $list['Label'] . '" class="postcode-list-input"></input>';
        $html .= '<p>List:</p>';
        $html .= '<textarea name="' . $args["option_name"] . '[' . $args["ID"] . ']['.$i.'][List]" rows="5" class="postcode-list-input">' .  $list['List'] . '</textarea> ';
        $html .= '</div>';
        $i++;
    }
    echo '<div id="' . $args["ID"] . '">
          ' . $html . '  
         </div>
         <input type="hidden" id="current_iteration" value="' . $i . '" />
         <script>
                var ListOptionName = "' . $args["option_name"] . '[' . $args["ID"] . ']";
         </script>';
}
function sapc_textbox_callback( $args ) { 
    echo '<input type="text" id="' . $args["ID"] . '" name="' . $args["option_name"] . '[' . $args["ID"] . ']" value="' . $args["value"] . '" class="field-40"></input>';
    echo ( isset( $args["hint"] ) ? '<p class="hint">' . $args["hint"] . '</p>' : '' );
}
function sapc_textarea_callback( $args ) { 
    if(!isset($args["rows"]))$args["rows"] = 5;
    echo '<textarea id="' . $args["ID"] . '" name="' . $args["option_name"] . '[' . $args["ID"] . ']" rows="'.$args["rows"].'" class="field-40">' . $args["value"] . '</textarea> ';
    echo ( isset( $args["hint"] ) ? '<p class="hint">' . $args["hint"] . '</p>' : '' );
}
function sapc_checkbox_callback( $args ) { 
    echo '<input type="checkbox" id="' . $args["ID"] . '" name="' . $args["option_name"] . '[' . $args["ID"] . ']" ' . $args["value"] . ' ></input>';
    echo ( isset( $args["hint"] ) ? '<p class="hint">' . $args["hint"] . '</p>' : '' );
}
function sapc_infobox_callback( $args ) { 
    echo '<tr id="' . $args["ID"] . ' class="'.$args["class"].'>';
    echo '<td class="mw_d_title">' . $args["title"] . '</td><td>' . $args["text"] . '</td>';
    echo '</tr>';
}
function sapc_select_callback( $args ) { 
    echo '<select id="' . $args["ID"] . '" name="' . $args["option_name"] . '[' . $args["ID"] . ']" class="field-40">';
    foreach( $args['options'] as $type => $label ){
        echo ( ( $args["value"] === $type ) ? '<option value="' . $type . '" selected>' . $label . '</option>' : '<option value="' . $type . '">' . $label . '</option>' );
    }
    echo '</select>';
    echo ( isset( $args["hint"] ) ? '<p class="hint">' . $args["hint"] . '</p>' : '' );
}
function sapc_settings_page() {
?>
<div class="wrap">  
        <div id="icon-themes" class="icon32"></div>  
        <h2><?php _e( 'Service Area Postcode Checker', 'sapc-domain' ); ?></h2>  
        <div class="description"><?php _e( 'Improve user experience', 'sapc-domain' ); ?></div>
        <?php settings_errors(); 
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'checker';  
        ?>  

        <h2 class="nav-tab-wrapper">  
            <a href="?page=sapc_options&tab=checker" class="nav-tab <?php   echo $active_tab == 'checker'   ? 'nav-tab-active' : ''; ?>">Checker Options</a>  
            <a href="?page=sapc_options&tab=display" class="nav-tab <?php   echo $active_tab == 'display'   ? 'nav-tab-active' : ''; ?>">Display Options</a>   
            <a href="?page=sapc_options&tab=lists" class="nav-tab <?php     echo $active_tab == 'lists'     ? 'nav-tab-active' : ''; ?>">List Options</a>   
            <a href="?page=sapc_options&tab=details" class="nav-tab <?php   echo $active_tab == 'details'   ? 'nav-tab-active' : ''; ?>">Plugin Details</a>  
        </h2>  

        <form method="post" action="options.php">  
            <?php 
            
            if( $active_tab == 'checker' ) {  
                settings_fields( 'sapc_checker_settings' );
                do_settings_sections( 'sapc_checker_settings_op' );
                settings_fields( 'sapc_checker_settings' );
                do_settings_sections( 'sapc_checker_settings_submit_op' );
                submit_button();
            } elseif( $active_tab == 'display' ) {
                settings_fields( 'sapc_checker_settings_display' );
                do_settings_sections( 'sapc_checker_settings_display_op' );
                submit_button();
            } elseif( $active_tab == 'lists' ) {
                settings_fields( 'sapc_list_settings' );
                do_settings_sections( 'sapc_list_op' );
                submit_button();
            } elseif( $active_tab == 'details' ) {
            ?>
            <table id="sapc_details" class="sapc_details">
            <?php
                settings_fields( 'sapc_checker_settings' );
                do_settings_sections( 'sapc_display_op' ); 
            ?>
            </table>
            <?php
            }
            ?>             
        </form> 
    </div> 

<?php 
}
function sapc_ajax_check() {

    $checker_settings = get_option( 'sapc_checker_settings_options' );

    if ( empty( $_POST ) && ! isset( $_POST['action'] ) && strcmp( $_POST['action'] , 'sapc_ajax_check' ) !== 0 ) {
        echo json_encode( array( 'Error' , __( 'Data Error - Contact Admin', 'sapc-domain' ) ) , JSON_FORCE_OBJECT );
        die();
    }
    
    if( ! isset( $_POST['pc'] ) ){
        echo json_encode( array( 'Error' , __( 'No Postcode Sent - Contact Admin', 'sapc-domain' ) ) , JSON_FORCE_OBJECT );
        die();
    }
    if( ! isset( $_POST['list'] ) ){
        echo json_encode( array( 'Error' , __( 'List Error - Contact Admin', 'sapc-domain' ) ) , JSON_FORCE_OBJECT );
        die();
    }
    
    include( plugin_dir_path( __FILE__ ) . 'php_libraries/postcode_class.php');
    $postcode = new Postcodes();
    
    if( isset( $_POST['verify-int'] ) && $_POST['verify-int'] == 'on' && ! $postcode->isPostcodeInteger( $_POST['pc'] )){
        echo json_encode( array( 'Error' , __( 'Post Must Contain Numbers Only', 'sapc-domain' ) ) , JSON_FORCE_OBJECT );
        die();
    }

    $lists = get_option( 'sapc_list_settings_options' );
    $get_list = $postcode->returnListFromLabel( $lists['postcodesLists'] , $_POST['list'] );
    if( ! $get_list ){
        echo json_encode( array( 'Error' , __( 'Invalid List - Contact Admin', 'sapc-domain' ) ) , JSON_FORCE_OBJECT );
        die();    
    }
    
    if( ! isset( $_POST['list'] ) ){
        echo json_encode( array( 'Error' , __( 'Invalid List - Contact Admin', 'sapc-domain' ) ) , JSON_FORCE_OBJECT );
        die();
    }

    $isServiceable = $postcode->isAreaServiceable( $_POST['pc'] , $get_list );
    if( ! $isServiceable['Result'] ){
        echo json_encode( array( 'Error' , $checker_settings['message-error'] . ' ' . $isServiceable['Error'] ) , JSON_FORCE_OBJECT );
        die(); 
    }
    
    echo json_encode( array( 'Success' , $checker_settings['message-success'] . ' ' . $isServiceable['Success'] ) , JSON_FORCE_OBJECT );
    die();
}
add_action( 'wp_ajax_sapc_ajax_check' , 'sapc_ajax_check' );
add_action( 'wp_ajax_nopriv_sapc_ajax_check' , 'sapc_ajax_check' );
?>