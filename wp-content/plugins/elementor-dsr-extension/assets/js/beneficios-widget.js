jQuery(document).ready(function() {
    var $ = jQuery;
    
    $(document).on("click", ".dsr-btn-carregar-mais" , function() {
        dsr_append_beneficios();
    });

});

function dsr_load_beneficios(){
    
    var limit = dsr_get_limit();
    var categoria = dsr_get_categoria();
    var local = dsr_get_local();
    var orderby = jQuery(".dsr-beneficios-paginacao").data('orderby');
    var order = jQuery(".dsr-beneficios-paginacao").data('order');
    var length = jQuery(".dsr-beneficios-container .single").length;

    var mode = jQuery(".dsr-beneficios-paginacao").data('mode');
    if('numeros' == mode){

        jQuery(".dsr-loading-spinner").css('display', 'inline');

        var url = dsr.site_url + `/wp-json/wp/v2/beneficios?status=publish&categoria_beneficio=${categoria}&local=${local}&per_page=${limit}&orderby=${orderby}&order=${order}`;

        jQuery.get(url, function(data) { 

            jQuery(".dsr-beneficios-paginacao").html("");

            dsr_render_html(data);

        }).done(function() {

            var categoria__ = categoria;
            var local__ = local;
            if('' == categoria__){
                categoria__ = 0;
            }
            if('' == local__){
                local__ = 0;
            }

            var url_pag = dsr.site_url + `/wp-json/beneficio_paginacao/v1/dsr/${categoria__}/${local__}/${orderby}/${order}/${limit}`;

            jQuery.get(url_pag, function(result) { 
                jQuery(".dsr-beneficios-paginacao").html(result.data);
            }).done(function() {
                jQuery(".dsr-loading-spinner").css('display', 'none');
            });
            
        });

    } else if('ajax' == mode){

        jQuery(".dsr-loading-spinner").css('display', 'inline');

        var url = dsr.site_url + `/wp-json/wp/v2/beneficios?status=publish&categoria_beneficio=${categoria}&local=${local}&per_page=${limit}&orderby=${orderby}&order=${order}`;

        jQuery.get(url, function(data) {

            jQuery(".dsr-beneficios-paginacao").html("");

            dsr_render_html(data);

            jQuery(".dsr-beneficios-paginacao").html(`
                <a href="javascript:void(0);" class="dsr-btn-carregar-mais">
                    <i class="far fa-plus-square"></i>
                    Carregar mais
                </a>
            `);

            jQuery(".dsr-beneficios-paginacao").fadeIn(180);

        }).done(function() {
            jQuery(".dsr-loading-spinner").css('display', 'none');
        });
    }

}

function dsr_append_beneficios(){

    var limit = dsr_get_limit();
    var categoria = dsr_get_categoria();
    var local = dsr_get_local();
    var orderby = jQuery(".dsr-beneficios-paginacao").data('orderby');
    var order = jQuery(".dsr-beneficios-paginacao").data('order');
    var length = jQuery(".dsr-beneficios-container .single").length;

    jQuery(".dsr-loading-spinner").css('display', 'inline');

    var url = dsr.site_url + `/wp-json/wp/v2/beneficios?status=publish&categoria_beneficio=${categoria}&local=${local}&per_page=${length+limit}&orderby=${orderby}&order=${order}`;

    jQuery.get(url, function(data) {

        var url_ = dsr.site_url + `/wp-json/wp/v2/beneficios?status=publish&categoria_beneficio=${categoria}&local=${local}&per_page=${length+limit+1}&orderby=${orderby}&order=${order}`;

        jQuery(".dsr-beneficios-paginacao").html("");

        dsr_render_html(data);

        jQuery.get(url_, function(data_) {

            if(data_.length > data.length){
                jQuery(".dsr-beneficios-paginacao").fadeIn(180).html(`
                    <a href="javascript:void(0);" class="dsr-btn-carregar-mais">
                        <i class="far fa-plus-square"></i>
                        Carregar mais
                    </a>
                `);
                jQuery(".dsr-beneficios-paginacao").fadeIn(180);
            }

        }).done(function() {

        });

    }).done(function() {
        jQuery(".dsr-loading-spinner").css('display', 'none');
    });
    
}

function dsr_render_html(data){
    if(data.length > 0){
        var template = ``;
        data.forEach(function(beneficio) {
            template = template + `
            <div class="single">
                <div class="thumb" style="background-image: url(${beneficio.thumb})">
                    <div class="desconto">
                        ${beneficio.beneficio_desconto}%<br /> 
                        <span>OFF</span>
                    </div>
                </div>

                <img class="logo" src="${beneficio.beneficio_logo_empresa}" />

                <div class="text">
                    <h3>${beneficio.title.rendered}</h3>
                    <a class="url_empresa" href="#">${beneficio.beneficio_url_empresa}</a>
                    ${beneficio.content.rendered}
                </div>
            </div>
            `;
        });
        //jQuery(".dsr-btn-carregar-mais").css('display', 'inline');
    }else{
        var template = `<div></div><div class="dsr-nenhum-resultado"><p>Nenhum resultado encontrado</p></div>`;
        jQuery(".dsr-btn-carregar-mais").css('display', 'none');
    }
    jQuery(".dsr-beneficios-container").fadeOut(180).html(template).fadeIn(180);
}

function dsr_render_paginacao(data, limit){
    if(data.length >= limit){
        jQuery(".dsr-beneficios-paginacao").html(`
            <a href="javascript:void(0);" class="dsr-btn-carregar-mais" data-offset="0" data-limit="${limit}" data-step="3">
                <i class="far fa-plus-square"></i>
                Carregar mais
            </a>
        `);
        
    }
}

function dsr_get_categoria(){
    var categoria = ''; 
    jQuery( ".dsr-wrapper-buttons li .dsr-btn").each(function(i) {
        if(jQuery(this).hasClass("active")){
            var categoria_atual = jQuery(this).data('categoria');
            categoria = categoria_atual;
        }
    });
    return categoria;
}

function dsr_get_local(){
    var local = '';
    jQuery( ".dsr-sel-locais option").each(function(i) {
        if(this.selected){ 
            var local_atual = jQuery(this).attr('value');
            local = local_atual;
        }
    });
    return local;
}

function dsr_get_limit(){
    var limit = jQuery( ".dsr-beneficios-paginacao").data('limit');
    return limit;
}