(function($) {
  Drupal.behaviors.theme_name = {
    attach: function(context){

      $(document).ajaxStart(function () {
        $('#document-page').addClass('loading');
        $('#throbber').fadeIn();

      });

      $(document).ajaxStop(function () {
        $('#document-page').removeClass('blurred');
        $('#throbber').fadeOut();
        dibujar_formacion();
      });

      $('.l-content-after').on('change', '#filtros.active #formacion', function(){
        $('#filtros').find('select').attr( "disabled", "disabled" );
        $('#document-page').addClass('blurred');
        $('#estadio').fadeOut(200);
        $.get('/jugar/formacion/'+ $("#id_alineacion").val()  +'/'+this.value, function(data){
          data = JSON.parse(data);
          console.log(data);
          $alert = $('#notificaciones');
          $alert.find('.msj').text(data.text);
          // $alert.fadeIn(500);
          $('.block-alineaciones-estadio').load('/jugar/cancha');
        });
      });


      // $('.active #formacion').change( function(){
      //     $('#alineaciones-popup').foundation('reveal', 'open', '/formacion/'+ $("#id_alineacion").val()  +'/'+this.value);
      // });
      $('a.drop').click( function(){
          $('#alineaciones-popup').foundation('reveal', 'open', '/desalinear/'+ $("#id_alineacion").val()  +'/'+this.id);
          $('#document-page').addClass('blurred');
      });
      $('a.sell').click( function(){
          $('#alineaciones-popup').foundation('reveal', 'open', '/carrito/sell'+'/'+this.id + '/' + $("#id_alineacion").val());
      });
      $('a.info').click( function(){
          $('#alineaciones-popup2').foundation('reveal', 'open', '/detallejugador/'+this.id);
      });
      $('.active #capitan').change( function(){
          $('#document-page').addClass('blurred');
          $('#alineaciones-popup').foundation('reveal', 'open', '/capitan/'+ $("#id_alineacion").val()  +'/'+this.value);
      });
      $('#fecha').change( function(){
          window.location.href = "/jugar/alineaciones/" + this.value;
      });

      //---------------------------------------
      // Hubicar los Futbolistas dentro de las posiciones guardadas
      //---------------------------------------


      dibujar_formacion();


      $('#cancha.active .player').draggable({snap:".place", snapMode: "inner",snapTolerance: 5,revert:'invalid'});



    } // attach:
  }; //-- end Drupal.behaviors

  function dibujar_formacion() {
    for(var i=1; i<=11; i++){
        var place = $('#place'+i);
        var asigned = $('#place'+i + '.asigned');
        var position = $('#cancha.active #place'+i+' .position').val();
        place.droppable({accept:"#cancha.active .player_position"+position, activeClass: "drop-hover",hoverClass:"drop-hover",tolerance: "intersect",
            drop: function(event, ui) {
                $(this).animate({opacity:0});
                $('#alineaciones-popup').foundation('reveal', 'open', '/alinear/'+ $("#id_alineacion").val() +'/' + this.id +'/'+ui.draggable[0].id);
                $('#document-page').addClass('blurred');
                console.log(this);
            },
            out: function(event, ui){
                $(this).animate({opacity:1});
            }
        });
        if (asigned.length){
            var id = $('#place'+i + '.asigned .id').val();
            var ele = $('.player'+id);
            ele.animate({top: place.position().top, left:place.position().left,margin:0,easing:'swing'},1000).css({position:'absolute'});
            place.animate({opacity:0});
        }
    }
  }
})(jQuery);