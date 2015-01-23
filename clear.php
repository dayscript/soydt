<?php
// define static var
define('DRUPAL_ROOT', getcwd());
// include bootstrap
include_once('./includes/bootstrap.inc');
// initialize stuff
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
// clear cache
drupal_flush_all_caches();
?>
