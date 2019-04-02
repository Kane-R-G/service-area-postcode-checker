<?php

class sapc_display_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 
    		'classname' => 'sapc_display',
    		'description' => 'Display Suburbs and Postcodes',
    	);
    	parent::__construct( 'sapc_display', 'Service Area Postcode Display', $widget_ops );
    }

    public function widget( $args, $instance ) {
        
        $display_settings = get_option( 'sapc_checker_settings_display_options' );
        $lists = get_option( 'sapc_list_settings_options' );
        
        $display_defaults = array(     
            'title-display'     => $display_settings['title-display'], 
            'class-display'     => $display_settings['class-display'], 
            'class-bullet'      => $display_settings['class-bullet'],
            'list-display'      => $display_settings['list-display']
        );
        
        $instance = wp_parse_args( (array) $instance, $display_defaults);  
        
        if($display_settings['display-ONOFF'] != 'off'){
            $title = apply_filters( 'widget_title', $instance['title-display'] );
            
            if ( ! class_exists( 'Postcodes' ) ) {
                include( plugin_dir_path( __FILE__ ) . 'php_libraries/postcode_class.php');
            }
            
            $postcode = new Postcodes();            
            
            echo $args['before_widget'];
            echo $args['before_title'] . $title . $args['after_title'];
            _e( $postcode->printPostcodeList( $postcode->returnListFromLabel( $lists['postcodesLists'] , $instance['list-display'] ) , $instance['class-display'] , $instance['class-bullet'] ), 'sapc-domain' );
            echo $args['after_widget'];
        }
    }
                 
        // Widget Backend 
    public function form( $instance ) {
        
        $display_defaults = get_option( 'sapc_checker_settings_display_options' );
        $listsettings = get_option( 'sapc_list_settings_options' );
        
        $widget_defaults = array(
            'title-display'         => $display_defaults['title-display'], 
            'class-display'         => $display_defaults['class-display'], 
            'class-bullet'          => $display_defaults['class-bullet'],
            'list-display'          => $listsettings['postcodesLists'][0]['Label']
        );
        $instance = wp_parse_args( (array) $instance, $widget_defaults);
        
        $list_select = '<select class="widefat" id=" '. $this->get_field_id( 'list-display' ) . '" name="' . $this->get_field_name( 'list-display' ) . '">';
        
        $list_select .= '</select>';
        
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title-display' ); ?>"><?php _e( 'Title:' , 'sapc-domain'  ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title-display' ); ?>" name="<?php echo $this->get_field_name( 'title-display' ); ?>" type="text" value="<?php echo esc_attr( $instance['title-display'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'list-display' ); ?>"><?php _e( 'Display List:' , 'sapc-domain'  ); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id( 'list-display' ); ?>" name="<?php echo $this->get_field_name( 'list-display' ); ?>">
        <?php 
            foreach($listsettings['postcodesLists'] as $lists){
                echo '<option value="' . $lists['Label'] . '" ' . ( ( $instance['list-display'] == $lists['Label'] ) ? 'selected' : ''  ) . '> ' . $lists['Label'] . ' </option>';
            }
         ?>
        </select>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'class-display' ); ?>"><?php _e( 'Display Class:' , 'sapc-domain'  ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'class-display' ); ?>" name="<?php echo $this->get_field_name( 'class-display' ); ?>" type="text" value="<?php echo esc_attr( $instance['class-display'] ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'class-bullet' ); ?>"><?php _e( 'Bullet Class:' , 'sapc-domain'  ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'class-bullet' ); ?>" name="<?php echo $this->get_field_name( 'class-bullet' ); ?>" type="text" value="<?php echo esc_attr( $instance['class-bullet'] ); ?>" />
        </p>
        <?php 
    }     
        // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title-display']  = ( ! empty( $new_instance['title-display'] ) ) ? strip_tags( $new_instance['title-display'] )  : '';
        $instance['class-display']  = ( ! empty( $new_instance['class-display'] ) ) ? strip_tags( $new_instance['class-display'] )  : '';
        $instance['class-bullet']   = ( ! empty( $new_instance['class-bullet'] ) )  ? strip_tags( $new_instance['class-bullet'] )   : '';
        $instance['list-display']   = ( ! empty( $new_instance['list-display'] ) )  ? strip_tags( $new_instance['list-display'] )   : '';
        return $instance;
    }
    
}
?>