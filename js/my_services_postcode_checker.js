(function($) {
  $(document).ready( function(){
     if($('.postcode_check_input').length){
        $(document).on('keyup', '.postcode_check_input', function(e){
            if (e.keyCode === 10 || e.keyCode === 13) {
                e.preventDefault();
                if(typeof Enabled_Enter !== 'undefined'){
                    cp($(this).closest('.postcode_check_form'));
                }
            }else{
                if (typeof Type_Trigger !== 'undefined' && typeof Trigger_Value !== 'undefined') {
                   if($(this).val().length>=Trigger_Value){
                        cp($(this).closest('.postcode_check_form'));
                    }else{
                        $(this).closest('.postcode_check_form').children('.success-msg').toggle(false);
                        $(this).closest('.postcode_check_form').children('.errors-msg').toggle(false);
                    }
                }
            }
        });
        $(document).on('click', '.submit-postcode', function(e){
            e.preventDefault();
            cp($(this).closest('.postcode_check_form'));
        });
        $('.postcode_check_form').submit(function (e) {
            e.preventDefault();
        });
     }
  });
	
  function cp(element){
        var data = {
            action: 'sapc_ajax_check',
            pc: element.children('.postcode_check_input').val(), 
            verify: element.children('.verify-int').val(),
            list: ((typeof List_Label !== 'undefined') ? List_Label : '')
        };
        $.post(sapc_CHECKER.ajaxurl, data, function(response) {
            var result = $.parseJSON(response);
            if( ! $.isPlainObject(result)){
                element.children('.errors-msg').toggle(true);
                element.children('.success-msg').toggle(false);
                element.children('.errors-msg').children('.errors-return-msg').html('Result Error - Contact Admin');
                return false;
            }
            if( result[0] !== 'Success') {
                element.children('.errors-msg').toggle(true);
                element.children('.success-msg').toggle(false);
                element.children('.errors-msg').children('.errors-return-msg').html(result[1]);
                return false; 
            
            }
            element.children('.errors-msg').toggle(false);
            element.children('.success-msg').toggle(true);
            
            if ( typeof Redirect_URL  === 'undefined' ) {
                        element.children('.success-msg').children('.success-return-msg').html(result[1]); 
                        return false;  
            }  
                     
            element.children('.success-msg').children('.success-return-msg').html(result[1] + '<div>Redirecting - Please Wait</div>');
            window.setTimeout(function(){
                window.location.href = Redirect_URL ;
            }, 2000); 
            return false;
             
        });
  }
})( jQuery );
