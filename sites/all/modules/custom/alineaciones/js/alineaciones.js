jQuery( document ).ready(function() {
    jQuery('.active #formacion').change( function(){
        jQuery('#alineaciones-popup').foundation('reveal', 'open', '/formacion/'+ jQuery("#id_alineacion").val()  +'/'+this.value);
    });
    jQuery('a.drop').click( function(){
        jQuery('#alineaciones-popup').foundation('reveal', 'open', '/desalinear/'+ jQuery("#id_alineacion").val()  +'/'+this.id);
    });
    jQuery('a.sell').click( function(){
        jQuery('#alineaciones-popup').foundation('reveal', 'open', '/carrito/sell'+'/'+this.id + '/' + jQuery("#id_alineacion").val());
    });
    jQuery('a.info').click( function(){
        jQuery('#alineaciones-popup2').foundation('reveal', 'open', '/detallejugador/'+this.id);
        jQuery('.reveal-modal-bg').blurjs({
            source: '#cancha',
            radius: 10,
            overlay: 'rgba(255,255,255,0.4)'
        });
    });
    jQuery('.active #capitan').change( function(){
        jQuery('#alineaciones-popup').foundation('reveal', 'open', '/capitan/'+ jQuery("#id_alineacion").val()  +'/'+this.value);
    });
    jQuery('#fecha').change( function(){
        window.location.href = "/jugar/alineaciones/" + this.value;
    });
    for(var i=1; i<=11; i++){
        var place = jQuery('#place'+i);
        var asigned = jQuery('#place'+i + '.asigned');
        var position = jQuery('#cancha.active #place'+i+' .position').val();
        place.droppable({accept:"#cancha.active .player_position"+position, activeClass: "drop-hover",hoverClass:"drop-hover",tolerance: "intersect",
            drop: function(event, ui) {
                jQuery(this).animate({opacity:0});
                jQuery('#alineaciones-popup').foundation('reveal', 'open', '/alinear/'+ jQuery("#id_alineacion").val() +'/' + this.id +'/'+ui.draggable[0].id);
                console.log(this);
            },
            out: function(event, ui){
                jQuery(this).animate({opacity:1});
            }
        });
        if (asigned.length){
            var id = jQuery('#place'+i + '.asigned .id').val();
            var ele = jQuery('.player'+id);
            ele.animate({top: place.position().top, left:place.position().left,margin:0,easing:'swing'},1000).css({position:'absolute'});
            place.animate({opacity:0});
        }
    }
    jQuery('#cancha.active .player').draggable({snap:".place", snapMode: "inner",snapTolerance: 5,revert:'invalid'});

});