(function($) {
  Drupal.behaviors.theme_name = {
    attach: function(context){

      //-----Posicionar el "throbber" en el centro de la ventana------
      var $throbber = $("#throbber");
      var throbberWidth = $throbber.width();
      var throbberHeight = $throbber.width();
      var win = window;
      var winWidth = win.innerWidth;
      var winHeight = win.innerHeight;

      $throbber.css({
        bottom: ( winHeight - throbberHeight  ) / 2,
        right: ( winWidth - throbberWidth  ) / 2
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
        var _this = this;
        var url = '/jugar/formacion/' + $("#id_alineacion").val()  + '/' + this.value;
        $.get(url).then(function(data){
          recargarDatos(_this, data);
        });
      });

      $delegateTo.on('change', '.active #capitan', function(){
        var url = '/jugar/capitan/'+ $("#id_alineacion").val() + '/' + this.value;
        //-----Recargar la página al cambiar de capitan------
        $.get(url).then(function(data){
          window.location.reload();
        });
      });

      $delegateTo.on('change', '#fecha', function(){
        //-----Redirigir la página al cambiar de fecha------
        window.location.href = "/jugar/m-alineaciones/" + this.value + '#estadio'
      });


      //-----Acciones sobre el futbolista------
      $delegateTo.on('click', 'a.drop', function(){
          var _this = this;
          var url = '/jugar/desalinear/' + $("#id_alineacion").val() + '/' + this.id;
          $.get(url).then(function(data){
            recargarDatos(_this, data);
          });
      });

      $delegateTo.on('click', 'a.put', function(){
          var _this = this;
          var url = '/jugar/autoalinear/' + $("#id_alineacion").val() + '/' + this.id;
          $.get(url).then(function(data){
            recargarDatos(_this, data);
          });
      });

      $delegateTo.on('click', 'a.sell', function(){
          var _this = this;
          var url = '/carrito/sell' + '/' + this.id + '/' + $("#id_alineacion").val();
          $.get(url).then(function(data){
            recargarDatos(_this, data);
          });
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




  function recargarDatos(_this, response) {
    // Crear el <a> para cerrar la notificación
    var a = document.createElement('a');
        a.innerHTML = '&times;';
        a.className = 'close-alert';

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

        // Si se hizo click en DROP Mover a la banca
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
                      .append(a)
                      .slideDown();
  }

})(jQuery);
