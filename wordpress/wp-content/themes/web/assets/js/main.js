$(document).ready(function(){
    
    var wow = new WOW();
    wow.init();
    
    if ($('.sel-dpt').length > 0 ) {
        
        $('.sel-dpt').change(function(){
        
            var optionSelected = $("option:selected", this).text();
                                                              
            jQuery.ajax({
        	    url : teachers.ajax_url,
        	    type : 'post',
        	    data : {
        		    action : 'get_teachers',
        		    name_teacher : optionSelected
        	    },
        	    success : function( response ) {
                                    			                                   
                    var newOptions = JSON.parse(response);
                    var $el = $(".sel-prf");
        
                    $el.empty(); // remove old options
                                                
                    if ( newOptions.length === 0 ) {
                                                                
                       $el.append($("<option></option>").text("No profesores")); 
                    }
                    else {
                                                            
                        $.each(newOptions, function(key,value) {
                            $el.append($("<option></option>").text(value));
                        });  
                    }
                                                            
                                                    
                }
            }); 
        });
    
    }
    
});