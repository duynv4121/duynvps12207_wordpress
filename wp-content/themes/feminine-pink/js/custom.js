jQuery(document).ready(function ($) {
    // $('.site-header .header-b .tools .btn-search').click(function(){
    //     $('.site-header .header-b .tools .btn-search .search-form-holder').slideToggle();
    //     $('.site-header .header-b .tools .btn-search .search-form-holder').click(function(event) {
    //         event.stopPropagation();
    //     });
    // }) ;

    // $('body').click(function(){
    //     $('.site-header .header-b .tools .btn-search .search-form-holder').hide();
    //     $('.site-header .header-b .tools .btn-search').click(function(event) {
    //         event.stopPropagation();
    //     });
    // }) ;           
    
    $('html').click(function() {
        $('.search-form-holder').slideUp();
    });

    $('.site-header .form-section').click(function(event) {
        event.stopPropagation();
    });
    $("#btn-search").click(function() {
        $(".search-form-holder").slideToggle();
        return false;
    });
    $(".btn-form-close").click(function() {
        $(".search-form-holder").slideToggle();
        return false;
    });
   
});



