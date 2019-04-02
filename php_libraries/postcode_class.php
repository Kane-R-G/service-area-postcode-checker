<?php

class Postcodes {
    public $search;
    public $list;
    
    public function isAreaServiceable( $search , $list_string ){
        $this->search   = $search;
        $this->list     = $this->convertStringToList( $list_string );
        
        if( ! is_array( $this->list )){
            return array( 'Result' => false, 'Error' => __( 'List Error Contact Admin', 'sapc-domain' ) );
        }
        
        $check = $this->checkPostcode();
        if( ! is_array( $check ) || empty( $check ) ){
            return array( 'Result' => false, 'Error' => __( 'Postcode Not Found', 'sapc-domain' ) );    
        }
        
        $check = array_values( $check );
    
        return array( 'Result' => true, 'Success' => $this->joinPostcodeDetails( $check ) );

    }
    
    function isPostcodeInteger( $postcode ){
        return ( ctype_digit ( $postcode ) );
    }
    
    function joinPostcodeDetails( $postcodes ){
        $details = array();
        foreach( $postcodes as $postcode ){
            $postcode_details = $this->returnPostcodeDetails( $postcode );
            if( $postcode_details['Suburb'] ){
                array_push( $details , $postcode_details['Suburb'] . ' - ' . $postcode_details['Postcode'] );        
            }else{
                array_push( $details , $postcode_details['Postcode'] ); 
            }
        }
        
        return implode(', ', $details);
    }
    
    function returnPostcodeDetails( $postcode ){
        
        $postcode = trim($postcode);
        $before_colon = strstr( $postcode , ':' , true );
        $after_colon = strstr( $postcode , ':' );
        
        return array( 'Postcode' => ( ( $before_colon === false ) ? $postcode : $before_colon ), 'Suburb' => ( ( $after_colon === false ) ? false : str_replace( ':', '', $after_colon ) ) ); 
    }
   
    public function returnListFromLabel( $lists , $label ) {
        foreach( $lists as $details ){
            if( strtolower( $details['Label'] ) == strtolower( $label ) ){
                return $details['List'];
            }
        }
        return false;      
    }
    
    function convertStringToList( $string ){
        $list = explode( PHP_EOL , $string); 
        if( ! is_array($list) || empty($list ) ){
            return false;
        }
        return $list; 
    }
    public function printPostcodeInput ( $instance ) {
        $postcode_search = '
            <form action="/" class="postcode_check_form">
                <input class="postcode_check_input" type="text" name="postcode_check" placeholder="'.$instance['placeholder'].'" />
                '. ( ( $instance['enable-button'] == 'on')  ? '<button type="submit" id="submit-postcode" class="submit-postcode pc-submit '.$instance['button-class'].'"><span>'.$instance['button-txt'].'</span></button>' : '' ) .'
                <p class="success-msg '.$instance['class-success'].' hide-msg">
                    <span class="success-return-msg"> </span>  
                </p>
                <p class="errors-msg '.$instance['class-error'].' hide-msg">
                    <span class="errors-return-msg"> </span>  
                </p>
                <input type="hidden" name="verify-int" class="verify-int" value="'.$instance['verify-integer'].'" />
            </form>
            <script> 
            ' . (($instance['enable-enter'] == 'on')    ? 'var Enabled_Enter = "'.$instance['enable-enter'].'";'    : '') . '
            ' . (($instance['type-trigger'] == 'on')    ? 'var Type_Trigger = "'.$instance['type-trigger'].'"; var Trigger_Value = "'.$instance['trigger-value'].'";'   : '') . '
            ' . (($instance['redirect'] !== '')         ? 'var Redirect_URL = "'.$instance['redirect'].'";'         : '') . '
            ' . (($instance['list-select'] !== '')      ? 'var List_Label = "'.$instance['list-select'].'";'        : 'var List_Label = "Default"') . '
            </script>
            ';
        return $postcode_search;
    }
    public function printPostcodeList( $list_string , $class , $bullet_class ){
        $printPostcodes = '<div class="w100"><ul class="postcode_display">';
        foreach($this->convertStringToList( $list_string ) as $postcodes){
            $details = $this->returnPostcodeDetails( $postcodes );
            $printPostcodes .= '<li class="postcode_li '. $class .' '. $bullet_class .'">' .  $details['Postcode']  . ( ( $details['Suburb'] !== false )  ? ', ' . $details['Suburb'] : '')  . '</li>';
        }
        
        $printPostcodes .= '</ul></div>';    
        return $printPostcodes;
    }
    
    function checkPostcode(){
        return array_filter( $this->list , array( $this ,  'checkPostcodeArray' ) );
    }
    
    function checkPostcodeArray( $postcode ){
        $details = $this->returnPostcodeDetails( $postcode );
        return ( fnmatch( $details['Postcode'] , $this->search ) );
    }
}


?>