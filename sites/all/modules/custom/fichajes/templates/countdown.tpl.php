<?php
$time = 1414904400;
$fecha = format_date($time, 'custom', 'Y,n,j,G,i');
$año = format_date($time, 'custom', 'Y');
$mesIni = format_date($time, 'custom', 'n');
$mes = $mesIni - 1;
$dia = format_date($time, 'custom', 'j');
$min = format_date($time, 'custom', 'H');
$seg = format_date($time, 'custom', 'i');

//dpm($data);
?>
<div class="cuenta-regresiva">
<span class="tile-count" >Próxima Fecha</span>
<div id="countdown"></div>
</div>
  <script type="text/javascript">
    jQuery(function () {
            var jQuerysection = jQuery('#countdown');
            jQuery('#countdown').mbComingsoon({ expiryDate: new Date(2014, 11, 21, 17, 30), localization: {
                			days: "DD",       //Localize labels of counter
                            hours: "HH",
                            minutes: "MM",
                            seconds: "SS"
            },speed:100 });
	});

 </script>