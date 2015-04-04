(function($) {
  Drupal.behaviors.alineaciones = {
    attach: function(context){

      var alineaciones = {};

      alineaciones.init = function() {
        this.alinearFormacion();
        this.bindDraggable();
        this.bindDroppable();
        this.bindEvents();
      }

      //---------------------------------------
      // Alinear Formacion
      // Anima desde la banca, hasta la cancha, los jugadores que ya tienen una posición asignada
      //---------------------------------------
      alineaciones.alinearFormacion = function () {
        var $asigned = $('#cancha').find('.droppable.asigned');

        if ($asigned.length) {
          $asigned.each(alinearFutbolista);
        }

        function alinearFutbolista (index, el){
          var $el = $(el);
          var id = $el.find('.id').val();
          //$('#'+id) = Es igual al futbolista con id="id"
          $('#'+id).animate({
              top: $el.position().top,
              left: $el.position().left,
              margin:0, easing:'swing'}, 300)
            .css({position:'absolute'});
        }
      }


      //---------------------------------------
      // Bind Ajax
      //---------------------------------------
      alineaciones.bindAjaxLoads = function () {
        $(document).ajaxStart(function () {
          $("#throbber").fadeIn();
        });

        $(document).ajaxStop(function () {
          $("#throbber").fadeOut();
        });
      }


      //---------------------------------------
      // Bind Draggable
      //---------------------------------------
      alineaciones.bindDraggable = function() {
        $('#cancha.active').find('.futbolista').draggable({
          snap:".droppable",
          snapMode: "inner",
          snapTolerance: 5,
          revert:'invalid'
        });
      }


      //---------------------------------------
      // Bind Droppable
      //---------------------------------------
      alineaciones.bindDroppable = function () {
        var _this = this;
        var $place = $('#cancha').find('.droppable');
        var idAlineacion = $("#id_alineacion").val();

        $place.each(setDroppable);

        function setDroppable (index, el) {
          var $el =  $(el);
          var position = $el.find('.position').val();
          $el.droppable({
            accept:"#cancha.active .ftb-posicion-" + position,
            activeClass: "drop-hover",
            hoverClass:"drop-hover",
            tolerance: "intersect",

            drop: function(event, ui) {
              $(this).animate({opacity:0});
              var url = '/jugar/alinear/' + idAlineacion + '/' + this.id + '/' + ui.draggable[0].id;
              _this.guardar(url);
            },

            out: function(event, ui){
              $(this).animate({opacity:1});
            }
          });
        }
      }


      //---------------------------------------
      // Bind Events
      //---------------------------------------
      alineaciones.bindEvents = function () {

        var _this = this;
        var $delegateTo = $('.l-content-after');
        var $documentPage = $('#document-page');
        var idAlineacion = $("#id_alineacion").val();

        //-----Filtros de la Cancha------
        $delegateTo.on('change', '#fecha', function(){
          window.location.href = "/jugar/alineaciones/" + this.value;
        });

        $delegateTo.on('change', '#filtros.active #formacion', function(){
          var url = '/jugar/formacion/' + idAlineacion  + '/' + this.value;
          _this.guardar(url);
        });

        $delegateTo.on('change', '.active #capitan', function(){
          var url = '/jugar/capitan/'+ idAlineacion + '/' + this.value;
          _this.guardar(url);
        });

        //-----Acciones sobre el futbolista------
        $delegateTo.on('click', 'a.drop', function(){
          var url = '/jugar/desalinear/' + idAlineacion + '/' + this.id;
          _this.guardar(url);
        });

        $delegateTo.on('click', 'a.put', function(){
          var url = '/jugar/autoalinear/' + idAlineacion + '/' + this.id;
          _this.guardar(url);
        });

        $delegateTo.on('click', 'a.sell', function(){
          var url = '/carrito/sell' + '/' + this.id + '/' + idAlineacion;
          _this.guardar(url);
        });

        $delegateTo.on('click', 'a.info', function(){
          var url = '/jugar/detallejugador/' + this.id;
          jQuery('#alineaciones-popup').foundation('reveal', 'open', url);
          $documentPage.addClass('blurred');
        });

        //-----Desactivar el Desenfoque al cerrar la ventana emergente------
        $(document).on('close.fndtn.reveal', '[data-reveal]', function () {
          $documentPage.removeClass('blurred');
        });
      }

      //---------------------------------------
      // CleanEvents
      // Avoiding Detached DOM Elements
      //---------------------------------------
      alineaciones.cleanEvents = function () {
        $('.fade-me').fadeOut(300, function () {
          $('.l-content-after').off()
          $('.droppable').remove();
          $('#alineados').empty();
          $('#suplentes').empty();
          $('.cancha-tribuna').empty();
          $('.cancha-alertas').empty();
          $('.reveal-modal').empty();
        });
      }


      //---------------------------------------
      // Guardar Datos
      //---------------------------------------
      alineaciones.guardar = function (url) {
        var _this = this;
        _this.cleanEvents();
        $.get(url).then(function(response){ _this.recargarDatos(response); });
      }

      //---------------------------------------
      // Recargar Datos
      //---------------------------------------
      alineaciones.recargarDatos = function (response) {
        var _this = this;
        $('.block-alineaciones-estadio').load('/jugar/cancha', function () {
          _this.init();
          //-----Actualizar Notificacion------
          $('#notificacion').hide()
              .text(response.text)
              .addClass(response.status)
              .slideDown();
        });
      }


      alineaciones.init();
      alineaciones.bindAjaxLoads();
    } // attach:
  }; //-- end Drupal.behaviors
})(jQuery);
