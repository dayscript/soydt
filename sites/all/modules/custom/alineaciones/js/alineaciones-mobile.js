(function($) {
  Drupal.behaviors.theme_name = {
    attach: function(context){

      //-----Posicionar el "throbber" en el centro de la ventana------
      var $throbber = $("#throbber");
      var win = window;
      var idAlineacion = $("#id_alineacion").val();

      $throbber.css({
        bottom: ( win.innerHeight - $throbber.height() ) / 2,
        right: ( win.innerWidth - $throbber.width() ) / 2
      });

      //-----Mostrar / Ocultar el throbber en los enventos ajax------
      $(document).ajaxStart(function () {
          $("#throbber").fadeIn();
      });

      $(document).ajaxStop(function () {
          $("#throbber").fadeOut();
      });


      //============== Bind de Eventos ==============
      $delegateTo = $('.l-content-after');

      //-----Filtros de la Cancha------
      $delegateTo.on('change', '#filtros.active #formacion', function(){
        var url = '/jugar/formacion/' + idAlineacion  + '/' + this.value;
        guardarDatos(this, url);
      });

      $delegateTo.on('change', '.active #capitan', function(){
        //-----Recargar la página al cambiar de capitan------
        var url = '/jugar/capitan/'+ idAlineacion + '/' + this.value;
        $.get(url).then(function(data){
          window.location.reload();
        });
      });

      $delegateTo.on('change', '#fecha', function(){
        //-----Redirigir la página al cambiar de fecha------
        window.location.href = "/jugar/m-alineaciones/" + this.value;
      });


      //-----Acciones sobre el futbolista------
      $delegateTo.on('click', 'a.drop', function(){
          var url = '/jugar/desalinear/' + idAlineacion + '/' + this.id;
          guardarDatos(this, url);
      });

      $delegateTo.on('click', 'a.put', function(){
          var url = '/jugar/autoalinear/' + idAlineacion + '/' + this.id;
          guardarDatos(this, url);
      });

      $delegateTo.on('click', 'a.sell', function(){
          var url = '/carrito/sell' + '/' + this.id + '/' + idAlineacion;
          guardarDatos(this, url);
      });

      $delegateTo.on('click', 'a.info', function(){
          var url = '/jugar/detallejugador/' + this.id;
          jQuery('#alineaciones-popup').foundation('reveal', 'open', url);
      });

      //-----Ocultar notificiacion------
      // Se cambió la funcionalidad por defecto de cerrar de foundation
      // Puesto que esta all cerrar elimina el elemento del DOM,
      // Solo se necesita esconderla
      $('#notificacion').on('click', '.close-alert', function(){
        $(this).closest('#notificacion').fadeOut();
      });

    } // attach:
  }; //-- end Drupal.behaviors

  function guardarDatos(_this, url) {
    $.get(url).then(function(response){
      recargarDatos(_this, response);
    });
  }

  function recargarDatos(_this, response) {
    // Crear el <a> para cerrar la notificación
    var close = document.createElement('a');
        close.innerHTML = '&times;';
        close.className = 'close-alert';

    // Mover el futbolista entre las listas de suplentes / alineados
    // Si se guardó correctamente
    if (response.status === 'success') {
      var $_this = $(_this);
      var $el = $_this.closest('.futbolista').slideUp(300, function () {

        // Si se hizo click en PUT -> Mover a la Titular
        if ($_this.hasClass('put')) {
          var newId = $_this.attr('id').replace('put','drop');
          $_this.attr('id', newId).removeClass('put').addClass('drop');
          $el.prependTo('#alineados').slideDown();
        }

        // Si se hizo click en DROP -> Mover a la banca
        else if ($_this.hasClass('drop')) {
          var newId = $_this.attr('id').replace('drop','put');
          $_this.attr('id', newId).removeClass('drop').addClass('put');
          $el.prependTo('#suplentes').slideDown();
        }
      });
    }

    //-----Mostar la notificación------
    $('#notificacion').hide()
                      .text(response.text)
                      .removeClass('success').removeClass('error')
                      .addClass(response.status)
                      .append(close)
                      .slideDown();
  }

})(jQuery);
