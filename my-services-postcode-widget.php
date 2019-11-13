<?php 
class sapc_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 
    		'classname'       => 'sapc_Checker',
    		'description'     => 'Check from a list of postcodes.',
    	);
    	parent::__construct( 'sapc_Checker', 'Service Area Postcode Checker', $widget_ops );
    }

    public function widget( $args, $instance ) {
        $submit_defaults = get_option( 'sapc_checker_settings_submit_options' );
        $checker_defaults = get_option( 'sapc_checker_settings_options' );
        $listsettings = get_option( 'sapc_list_settings_options' );
        
        
        
        $join_defaults = array(
    		'title-checker'         => $checker_defaults['title-checker'], 
            'message-success'       => $checker_defaults['message-success'], 
            'class-success'         => $checker_defaults['class-success'], 
            'message-error'         => $checker_defaults['message-error'],
            'class-error'           => $checker_defaults['class-error'], 
            'placeholder'           => $checker_defaults['placeholder'], 
            'trigger-value'         => $submit_defaults['trigger-value'], 
            'verify-integer'        => $submit_defaults['verify-integer'],
            'type-trigger'          => $submit_defaults['type-trigger'],
            'enable-enter'          => $submit_defaults['enable-enter'],
            'enable-button'         => $submit_defaults['enable-button'],
            'button-class'          => $submit_defaults['button-class'],
            'button-txt'            => $submit_defaults['button-txt'],
            'redirect'              => $submit_defaults['redirect'],
            'list-select'           => $listsettings['postcodesLists'][0]['Label']
        );
        if( $checker_defaults['checker-ONOFF'] != 'off' ){
            if ( ! class_exists( 'Postcodes' ) ) {
                include_once( plugin_dir_path( __FILE__ ) . 'php_libraries/postcode_class.php');
            }
            $postcode = new Postcodes();

            $instance = wp_parse_args( (array) $instance , $join_defaults );
            $title = apply_filters( 'widget_title' , $instance['title-checker'] );
            echo $args['before_widget'];
            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
            
            
            
            echo $postcode->printPostcodeInput ( $instance );
            echo $args['after_widget'];
        }
    }
                 
        // Widget Backend 
    public function form( $instance ) {
        $submit_defaults = get_option( 'sapc_checker_settings_submit_options' );
        $checker_defaults = get_option( 'sapc_checker_settings_options' );
        $listsettings = get_option('sapc_list_settings_options');
        
        
        $widget_defaults = array(
            'title-checker'         => $checker_defaults['title-checker'], 
            'message-success'       => $checker_defaults['message-success'], 
            'class-success'         => $checker_defaults['class-success'], 
            'message-error'         => $checker_defaults['message-error'],
            'class-error'           => $checker_defaults['class-error'], 
            'placeholder'           => $checker_defaults['placeholder'], 
            'trigger-value'         => $submit_defaults['trigger-value'], 
            'verify-integer'        => $submit_defaults['verify-integer'],
            'type-trigger'          => $submit_defaults['type-trigger'],
            'enable-enter'          => $submit_defaults['enable-enter'],
            'enable-button'         => $submit_defaults['enable-button'],
            'button-class'          => $submit_defaults['button-class'],
            'button-txt'            => $submit_defaults['button-txt'],
            'redirect'              => $submit_defaults['redirect'],
            'list-select'           => $listsettings['postcodesLists'][0]['Label']
        );
        
        $instance = wp_parse_args( (array) $instance, $widget_defaults);
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title-checker' ); ?>"><?php _e( 'Title:' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title-checker' ); ?>" name="<?php echo $this->get_field_name( 'title-checker' ); ?>" type="text" value="<?php echo esc_attr( $instance['title-checker'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'list-select' ); ?>"><?php _e( 'List:' , 'sapc-domain' ); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id( 'list-select' ); ?>" name="<?php echo $this->get_field_name( 'list-select' ); ?>">
        <?php  
        foreach($listsettings['postcodesLists'] as $lists){
             echo '<option value="' . $lists['Label'] . '" ' . ( ( $instance['list-select'] == $lists['Label'] ) ? 'selected' : ''  ) . '> ' . $lists['Label'] . ' </option>';
        }
        ?>
        </select>
        </p>        
        <p>
        <label for="<?php echo $this->get_field_id( 'message-success' ); ?>"><?php _e( 'Success Message' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'message-success' ); ?>" name="<?php echo $this->get_field_name( 'message-success' ); ?>" type="text" value="<?php echo esc_attr( $instance['message-success'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'class-success' ); ?>"><?php _e( 'Success Class' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'class-success' ); ?>" name="<?php echo $this->get_field_name( 'class-success' ); ?>" type="text" value="<?php echo esc_attr( $instance['class-success'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'message-error' ); ?>"><?php _e( 'Error Message' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'message-error' ); ?>" name="<?php echo $this->get_field_name( 'message-error' ); ?>" type="text" value="<?php echo esc_attr( $instance['message-error'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'class-error' ); ?>"><?php _e( 'Error Class' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'class-error' ); ?>" name="<?php echo $this->get_field_name( 'class-error' ); ?>" type="text" value="<?php echo esc_attr( $instance['class-error'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'placeholder' ); ?>"><?php _e( 'Placeholder Text' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="text" value="<?php echo esc_attr( $instance['placeholder'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'verify-integer' ); ?>"><?php _e( 'Verify Integer' , 'sapc-domain' ); ?></label> 
        <input type="checkbox" name="<?php echo $this->get_field_name( 'verify-integer' ); ?>" class="" id="<?php echo $this->get_field_id( 'verify-integer' ); ?>" <?php echo ( ( ($instance['verify-integer'] == 'on') ) ? 'checked' : '' ); ?>/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'type-trigger' ); ?>"><?php _e( 'Enable Typing Trigger' , 'sapc-domain' ); ?></label> 
        <input type="checkbox" name="<?php echo $this->get_field_name( 'type-trigger' ); ?>" class="" id="<?php echo $this->get_field_id( 'type-trigger' ); ?>" <?php echo ( ( ($instance['type-trigger'] == 'on') ) ? 'checked' : '' ); ?>/>
        </p>
        <?php 
        if($instance['type-trigger'] == 'on'){
            if($instance['trigger-value'] == '') $instance['trigger-value'] = $submit_defaults['trigger-value'];
         ?>
         <p>
            <label for="<?php echo $this->get_field_id( 'trigger-value' ); ?>"><?php _e( 'Input Trigger Value' , 'sapc-domain' ); ?></label> 
            <input class="widefat"  id="<?php echo $this->get_field_id( 'trigger-value' ); ?>" name="<?php echo $this->get_field_name( 'trigger-value' ); ?>" type="text" value="<?php echo esc_attr( $instance['trigger-value'] ); ?>" />
        </p>
        <?php
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'enable-enter' ); ?>"><?php _e( 'Enable Enter' , 'sapc-domain' ); ?></label> 
        <input type="checkbox" name="<?php echo $this->get_field_name( 'enable-enter' ); ?>" class="" id="<?php echo $this->get_field_id( 'enable-enter' ); ?>" <?php echo ( ( ($instance['enable-enter'] == 'on') ) ? 'checked' : '' ); ?>/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'enable-button' ); ?>"><?php _e( 'Enable Button' , 'sapc-domain' ); ?></label> 
        <input type="checkbox" name="<?php echo $this->get_field_name( 'enable-button' ); ?>" class="" id="<?php echo $this->get_field_id( 'enable-button' ); ?>" <?php echo ( ( ($instance['enable-button'] == 'on') ) ? 'checked' : '' ); ?>/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'redirect' ); ?>"><?php _e( 'Redirect URL' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'redirect' ); ?>" name="<?php echo $this->get_field_name( 'redirect' ); ?>" type="text" value="<?php echo esc_attr( $instance['redirect'] ); ?>" />
        </p>
        
        <?php 
        if($instance['enable-button'] == 'on'){
        ?>  
        <p>  
        <label for="<?php echo $this->get_field_id( 'button-class' ); ?>"><?php _e( 'Button Class' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'button-class' ); ?>" name="<?php echo $this->get_field_name( 'button-class' ); ?>" type="text" value="<?php echo esc_attr( $instance['button-class'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'button-txt' ); ?>"><?php _e( 'Button Text' , 'sapc-domain' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'button-txt' ); ?>" name="<?php echo $this->get_field_name( 'button-txt' ); ?>" type="text" value="<?php echo esc_attr( $instance['button-txt'] ); ?>" />
        </p>
        
        <?php
        }
    }     
        // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title-checker']      = ( ! empty( $new_instance['title-checker'] ) )     ? strip_tags( $new_instance['title-checker'] )      : '';
        $instance['message-error']      = ( ! empty( $new_instance['message-error'] ) )     ? strip_tags( $new_instance['message-error'] )      : '';
        $instance['class-error']        = ( ! empty( $new_instance['class-error'] ) )       ? strip_tags( $new_instance['class-error'] )        : '';
        $instance['placeholder']        = ( ! empty( $new_instance['placeholder'] ) )       ? strip_tags( $new_instance['placeholder'] )        : '';
        $instance['message-success']    = ( ! empty( $new_instance['message-success'] ) )   ? strip_tags( $new_instance['message-success'] )    : '';
        $instance['class-success']      = ( ! empty( $new_instance['class-success'] ) )     ? strip_tags( $new_instance['class-success'] )      : '';
        $instance['trigger-value']      = ( ! empty( $new_instance['trigger-value'] ) )     ? strip_tags( $new_instance['trigger-value'] )      : '';
        $instance['verify-integer']     = ( isset( $new_instance['verify-integer']) )       ? strip_tags( $new_instance['verify-integer'] )     : 'off';
        $instance['type-trigger']       = ( isset( $new_instance['type-trigger'] ) )        ? strip_tags( $new_instance['type-trigger'] )       : 'off';
        $instance['enable-enter']       = ( isset( $new_instance['enable-enter'] ) )        ? strip_tags( $new_instance['enable-enter'] )       : 'off';
        $instance['enable-button']      = ( isset( $new_instance['enable-button'] ) )       ? strip_tags( $new_instance['enable-button'] )      : 'off';
        $instance['button-class']       = ( ! empty( $new_instance['button-class'] ) )      ? strip_tags( $new_instance['button-class'] )       : '';
        $instance['button-txt']         = ( ! empty( $new_instance['button-txt'] ) )        ? strip_tags( $new_instance['button-txt'] )         : '';
        $instance['redirect']           = ( ! empty( $new_instance['redirect'] ) )          ? strip_tags( $new_instance['redirect'] )           : '';
        $instance['list-select']        = ( ! empty( $new_instance['list-select'] ) )       ? strip_tags( $new_instance['list-select'] )        : '';
        return $instance;
    }
    
}
?>
