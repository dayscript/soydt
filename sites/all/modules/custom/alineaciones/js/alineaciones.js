(function($) {
  Drupal.behaviors.theme_name = {
    attach: function(context){

      alinearFormacion();
      bindDraggable();

      $(document).ajaxStart(function () {
          $("#throbber").fadeIn();
      });

      $(document).ajaxStop(function () {
          $("#throbber").fadeOut();
      });

      $delegateTo = $('.l-content-after');

      //-----Filtros de la Cancha------
      $delegateTo.on('change', '#filtros.active #formacion', function(){
        var url = '/jugar/formacion/' + $("#id_alineacion").val()  + '/' + this.value;
        $.get(url, function (data) { /*console.log(data, url);*/ recargarDatos(data); });
      });

      $delegateTo.on('change', '.active #capitan', function(){
        var url = '/jugar/capitan/'+ $("#id_alineacion").val() + '/' + this.value;
        $.get(url, function (data) { /*console.log(data, url);*/ recargarDatos(data); });
      });

      $delegateTo.on('change', '#fecha', function(){
          window.location.href = "/jugar/alineaciones/" + this.value;
      });

      //-----Acciones sobre el futbolista------
      $delegateTo.on('click', 'a.drop', function(){
          var url = '/jugar/desalinear/' + $("#id_alineacion").val() + '/' + this.id;
          $.get(url, function (data) { /*console.log(data, url);*/ recargarDatos(data); });
      });

        $delegateTo.on('click', 'a.put', function(){
            var url = '/jugar/autoalinear/' + $("#id_alineacion").val() + '/' + this.id;
            $.get(url, function (data) { /*console.log(data, url);*/ recargarDatos(data); });
        });

      $delegateTo.on('click', 'a.sell', function(){
          var url = '/carrito/sell' + '/' + this.id + '/' + $("#id_alineacion").val();
          $.get(url, function (data) { /*console.log(data, url);*/ recargarDatos(data); });
      });

      $delegateTo.on('click', 'a.info', function(){
          var url = '/jugar/detallejugador/' + this.id;
          jQuery('#alineaciones-popup').foundation('reveal', 'open', url);
          $('#document-page').addClass('blurred');
      });

      //-----Desactivar el Desenfoque al cerrar la ventana emergente------
      $('.reveal-modal').on('click', '.close-reveal-modal', function () {
        $('#document-page').removeClass('blurred');
      });

    } // attach:
  }; //-- end Drupal.behaviors

  function alinearFormacion() {
    for(var i=1; i<=11; i++){
        var place = $('#place'+i);
        var asigned = $('#place'+ i + '.asigned');
        var position = $('#cancha.active #place'+i+' .position').val();
        place.droppable({
          accept:"#cancha.active .ftb-posicion-" + position,
          activeClass: "drop-hover",
          hoverClass:"drop-hover",
          tolerance: "intersect",

          drop: function(event, ui) {
            $(this).animate({opacity:0});

            var url = '/jugar/alinear/'+ $("#id_alineacion").val() + '/' + this.id + '/' + ui.draggable[0].id;
            $.get(url, function (data) { /*console.log(data, url);*/ recargarDatos(data); });
          },

          out: function(event, ui){
            $(this).animate({opacity:1});
          }
        });

      /* Anima desde la banca, hasta la cancha, los jugadores que ya tienen
         una posición asignada */
      if (asigned.length){
        var id = $('#place'+i + '.asigned .id').val();
        var ele = $('.ftb-'+id);
        ele.animate({ top: place.position().top, left:place.position().left, margin:0, easing:'swing'}, 300)
           .css({position:'absolute'});
      }
    }
  } // alinearFormacion

  function bindDraggable() {
    $('#cancha.active .futbolista').draggable({snap:".droppable", snapMode: "inner", snapTolerance: 5, revert:'invalid'});
  }

  function recargarDatos(response) {
    $('.block-alineaciones-estadio').load('/jugar/cancha', function () {
      $('#notificacion').hide().text(response.text).addClass(response.status).slideDown();
      alinearFormacion();
      bindDraggable();
    });
  }

})(jQuery);