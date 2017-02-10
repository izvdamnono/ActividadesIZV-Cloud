$(document).ready(function(){
    
    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });
    
    
    var wow = new WOW();
    wow.init();
    
});