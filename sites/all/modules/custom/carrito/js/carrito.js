(function ($, Drupal) {
  Drupal.behaviors.carrito = {
    attach: function(context, settings) {

      //---------------------------------------
      // Bloque de resumen de carrito,
      // expandir / contraer
      //---------------------------------------
      if ($('.block-views-carrito-carrito-resumen').length !== 0) {
        var $blockCarrito = $('.block-views-carrito-carrito-resumen')
              .not('.ajax-processed').addClass('ajax-processed');

        $blockCarrito.find('h2.block-title').on('click', function () {
          $blockCarrito.toggleClass('collapsed')
            .find('.view').slideToggle(300);
        });
      }


    } // End Attach
  }; // End Behaviors
})(jQuery, Drupal);
