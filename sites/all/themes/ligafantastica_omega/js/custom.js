jQuery(document).ready(function(){

            jQuery('.boton-carro').mousedown(function(){
                jQuery('.boton-carro').hide();
            });

            jQuery('#edit-submit').click(function(event){

               // jQuery('#equipoCreado').dialog({ modal: true, resizable: false });
               //alert('Ya tienes un equipo, ahora puedes fichar jugadores.');.
              /* event.preventDefault();
               jQuery( this ).hide( "slow" );*/
           });

         
            if (jQuery('#user-register-form').length){
                jQuery('#user-register-form #edit-field-nombres-und-0-value').attr('placeholder','Nombres');
                jQuery('#user-register-form #edit-field-apellidos-und-0-value').attr('placeholder','Apellidos');
                jQuery('#user-register-form #edit-field-c-dula-und-0-value').attr('placeholder','Cédula');
                jQuery('#user-register-form #edit-mail').attr('placeholder','Correo Electrónico');
                jQuery('#user-register-form #edit-pass-pass1').attr('placeholder','Contraseña (6 car).');
                jQuery('#user-register-form #edit-pass-pass2').attr('placeholder','Repite la contraseña');
            }
            if(jQuery("body").hasClass("page-user-edit")){

            	jQuery('.tabs--primary, .tabs--secondary').hide();

            }
            jQuery( document ).ajaxComplete(function(){
                jQuery('.boton-carro').each(function(){
                    var img = jQuery(this).closest('td').find('img');
                    jQuery(this).mousedown(function(){
                        flyToElement(jQuery(img), jQuery('.checkout'));
                        return false;
                    });

                });
                function flyToElement(flyer, flyingTo, callBack /*callback is optional*/) {
                    var jQueryfunc = jQuery(this);

                    var divider = 3;

                    var flyerClone = jQuery(flyer).clone();
                    jQuery(flyerClone).css({
                        position: 'absolute',
                        top: jQuery(flyer).offset().top + 'px',
                        left: jQuery(flyer).offset().left + 'px',
                        opacity: 1,
                        'z-index': 1000
                    });
                    jQuery('body').append(jQuery(flyerClone));

                    var gotoX = jQuery(flyingTo).offset().left + (jQuery(flyingTo).width() / 2) - (jQuery(flyer).width()/divider)/2;
                    var gotoY = jQuery(flyingTo).offset().top + (jQuery(flyingTo).height() / 2) - (jQuery(flyer).height()/divider)/2;

                    jQuery(flyerClone).animate({
                        opacity: 0.4,
                        left: gotoX,
                        top: gotoY,
                        width: jQuery(flyer).width()/divider,
                        height: jQuery(flyer).height()/divider
                    }, 700,
                    function () {
                        jQuery(flyingTo).fadeOut('fast', function () {
                            jQuery(flyingTo).fadeIn('fast', function () {
                                jQuery(flyerClone).fadeOut('fast', function () {
                                    jQuery(flyerClone).remove();
                                    if( callBack != null ) {
                                        callBack.apply(jQueryfunc);
                                    }
                                });
                            });
                        });
                    });
                }
            });

        jQuery('.boton-carro').each(function(){
            var img = jQuery(this).closest('td').find('img');
            jQuery(this).mousedown(function(){
                flyToElement(jQuery(img), jQuery('.checkout'));
                return false;
            });

        });

        function flyToElement(flyer, flyingTo, callBack /*callback is optional*/) {
            var jQueryfunc = jQuery(this);

            var divider = 3;

            var flyerClone = jQuery(flyer).clone();
            jQuery(flyerClone).css({
                position: 'absolute',
                top: jQuery(flyer).offset().top + 'px',
                left: jQuery(flyer).offset().left + 'px',
                opacity: 1,
                'z-index': 1000
            });
            jQuery('body').append(jQuery(flyerClone));

            var gotoX = jQuery(flyingTo).offset().left + (jQuery(flyingTo).width() / 2) - (jQuery(flyer).width()/divider)/2;
            var gotoY = jQuery(flyingTo).offset().top + (jQuery(flyingTo).height() / 2) - (jQuery(flyer).height()/divider)/2;

            jQuery(flyerClone).animate({
                opacity: 0.4,
                left: gotoX,
                top: gotoY,
                width: jQuery(flyer).width()/divider,
                height: jQuery(flyer).height()/divider
            }, 700,
            function () {
                jQuery(flyingTo).fadeOut('fast', function () {
                    jQuery(flyingTo).fadeIn('fast', function () {
                        jQuery(flyerClone).fadeOut('fast', function () {
                            jQuery(flyerClone).remove();
                            if( callBack != null ) {
                                callBack.apply(jQueryfunc);
                            }
                        });
                    });
                });
            });
        }




});