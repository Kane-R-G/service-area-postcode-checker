(function($) {
  $(document).ready( function(){
    $('#type-trigger').click(function(){
        if($(this).is(':checked')){
            $('.type-trigger').toggle(true);
        } else {
            $('.type-trigger').toggle(false);
        }
    });
    $('#enable-button').click(function(){
        if($(this).is(':checked')){
            $('.enable-button').toggle(true);
        } else {
            $('.enable-button').toggle(false);
        }
    });
    $('#add-list').click(function(e){
        e.preventDefault();
        create_postcode_area();
    });
    $(document).on('click', '.deletelist', function(e) {
        $(this).parent('div').parent('div').remove();    
    });
  });
  function deletelist(){
        $(this).parent().remove();
  }
  function create_postcode_area(){
    //create container
    if(typeof ListOptionName !== 'undefined'){
        var current_iteration = $('#current_iteration').val();
        current_iteration = parseInt(current_iteration) + 1;
        
        
        //create close button
        var deletediv = document.createElement("div");
        deletediv.className = 'delete-list';
        
        var deletelink = document.createElement("a");
        deletelink.href = '#';
        deletelink.className = 'deletelist';
        var labeltext = document.createTextNode("X");
        deletelink.append(labeltext);
        deletediv.append(deletelink);

        var listcontainer = document.createElement("div");
        listcontainer.className = 'postcode-list-container field-40';
        
        //create label and input
        var listlabel = document.createElement("p");
        var labeltext = document.createTextNode("List Name:");
        listlabel.append(labeltext);
        
        var labelinput = document.createElement("input");
        labelinput.type = 'text';
        labelinput.name = ListOptionName + '[' + current_iteration + '][Label]';
        labelinput.className = 'postcode-list-input';
        
        //create label and textarea
        var textlabel = document.createElement("p");
        var labeltext = document.createTextNode("List:");
        textlabel.append(labeltext);
        
        var textareainput = document.createElement("textarea");
        textareainput.rows = 5;
        textareainput.name = ListOptionName + '[' + current_iteration + '][List]';
        textareainput.className = 'postcode-list-input';
        
        //append together
        listcontainer.append(deletediv);
        listcontainer.append(listlabel);
        listcontainer.append(labelinput);
        listcontainer.append(textlabel);
        listcontainer.append(textareainput);
        
        console.log(ListOptionName + '[' + current_iteration + '][Label]');
        
        //append to postcode area
        $('#postcodesLists').append(listcontainer);
        $('#current_iteration').val(current_iteration);
    }
    
  }
})( jQuery );