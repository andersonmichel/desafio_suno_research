jQuery(document).ready(function() {
    var $ = jQuery;
    $(".dsr-wrapper-buttons li .dsr-btn").each(function( i ) {
        var active = $(this).hasClass('active');
        if(active == true){
            dsr_set_active_class(this);
        }else{
            dsr_remove_active_class(this);
        }
    });

    $(".dsr-wrapper-buttons li .dsr-btn").click(function() {
        $( ".dsr-wrapper-buttons li .dsr-btn").each(function(i) {
            $(this).removeClass("active");
            dsr_remove_active_class(this);
        });
        $(this).addClass("active");
        dsr_set_active_class(this);
        dsr_load_beneficios();
    });

    function dsr_set_active_class(e){
        var cor = $(e).data('cor');
        $(e).mouseover(function() {
            $(e).css("background-color", '#ffffff');
            $(e).css("color", cor);
        }).mouseout(function() {
            $(e).css("background-color", cor);
            $(e).css("color", "#ffffff");
        });
    }
    function dsr_remove_active_class(e){
        var cor = $(e).data('cor');
        $(e).css("color", cor);
        $(e).css("border-color", cor);
        $(e).css("background-color", '#ffffff');

        $(e).mouseover(function() {
            $(e).css("background-color", cor);
            $(e).css("color", "#ffffff");
        }).mouseout(function() {
            $(e).css("background-color", '#ffffff');
            $(e).css("color", cor);
        });
    }
});