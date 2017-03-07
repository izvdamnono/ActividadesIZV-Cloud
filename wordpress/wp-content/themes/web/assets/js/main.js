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
                                    			                                   
                    var newOptions  = JSON.parse(response);
                    var $el         = $(".sel-prf");
                    var text        = $('.wtsp').text();
                    
                    $el.empty(); // remove old options
                                                
                    if ( newOptions.length === 0 ) {
                                                                
                       $el.append($("<option></option>").text(text)); 
                    }
                    else {
                        
                        $el.append($("<option></option>").text(text));                                    
                        $.each(newOptions, function(key,value) {
                            $el.append($("<option></option>").text(value));
                        });  
                    }
                                                            
                                                    
                }
            }); 
        });
    
    }
    
    $('.selectpicker').selectpicker(); 
    
    $('.selectpicker').change(function(){
        
            var optionSelected = $("option:selected", this).val(); 
           
            jQuery.ajax({
        	    url : teachers.ajax_url,
        	    type : 'post',
        	    data : {
        		    action : 'wpsx_redefine_locale',
        		    locale : optionSelected
        	    },
        	    success : function( response ) {
                                        			                                   
                    location.reload();                                                            
                                                    
                }
            }); 
        });
});