<?php
$year = date("Y",strtotime($data["date"]));
$month = date("n",strtotime($data["date"]))-1;
$day = date("d",strtotime($data["date"]));
$hour = date("H",strtotime($data["date"]));
$minute = date("i",strtotime($data["date"]));
?>
<div class="cuenta-regresiva">
  <span class="tile-count text-right" >Cierre de Fecha<br /><small>Liga Águila - <?php echo $data["name"]?></small></span>
  <div id="countdown"></div>
</div>
<script type="text/javascript">
  jQuery(function () {
    var jQuerysection = jQuery('#countdown');
    jQuery('#countdown').mbComingsoon({ expiryDate: new Date(<?php echo $year?>, <?php echo $month?>, <?php echo $day?>, <?php echo $hour?>, <?php echo $minute?>), localization: {
      days: "DD",       //Localize labels of counter
      hours: "HH",
      minutes: "MM",
      seconds: "SS"
    },speed:100 });
  });
</script>