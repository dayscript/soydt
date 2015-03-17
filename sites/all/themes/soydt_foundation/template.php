<?php

/**
 * Implements template_preprocess_html().
 *
 */
//function soydt_foundation_preprocess_html(&$variables) {
//  // Add conditional CSS for IE. To use uncomment below and add IE css file
//  drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
//
//  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
//  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external');
//}

/**
 * Implements template_preprocess_page
 *
 */
function soydt_foundation_preprocess_page(&$variables) {
    // Convenience variables.
    if (!empty($variables['page']['sidebar_first'])) {
        $left = $variables['page']['sidebar_first'];
    }

    if (!empty($variables['page']['sidebar_second'])) {
        $right = $variables['page']['sidebar_second'];
    }
    // Dynamic sidebars.
    if (!empty($left) && !empty($right)) {
        $variables['main_grid'] = 'medium-6 medium-push-5';
        $variables['sidebar_first_grid'] = 'medium-5 medium-pull-6';
        $variables['sidebar_sec_grid'] = 'medium-5';
    }
    elseif (empty($left) && !empty($right)) {
        $variables['main_grid'] = 'medium-11';
        $variables['sidebar_first_grid'] = '';
        $variables['sidebar_sec_grid'] = 'medium-5';
    }
    elseif (!empty($left) && empty($right)) {
        $variables['main_grid'] = 'medium-11 medium-push-5';
        $variables['sidebar_first_grid'] = 'medium-5 medium-pull-11';
        $variables['sidebar_sec_grid'] = '';
    }
    else {
        $variables['main_grid'] = '';
        $variables['sidebar_first_grid'] = '';
        $variables['sidebar_sec_grid'] = '';
    }
}

/**
 * Implements template_preprocess_node
 *
 */
//function soydt_foundation_preprocess_node(&$variables) {
//}

/**
 * Return a link to initiate a Facebook Connect login or association.
 *
 * @param $variables
 *   An array of properties to be used to generate a login link. Note that all
 *   provided properties are required for the Facebook login to succeed and
 *   must not be changed. If $link is FALSE, Facebook OAuth is not yet
 *   configured.
 * @see fboauth_link_properties()
 * @return string
 */
function soydt_foundation_fboauth_action__connect($variables) {
  $action = $variables['action'];
  $link = $variables['properties'];
  $url = url($link['href'], array('query' => $link['query']));
  $link['attributes']['class'] = isset($link['attributes']['class']) ? $link['attributes']['class'] : 'facebook-action-connect';
  $link['attributes']['rel'] = 'nofollow';
  $attributes = isset($link['attributes']) ? drupal_attributes($link['attributes']) : '';
  $title = isset($link['title']) ? check_plain($link['title']) : '';
  $src = drupal_get_path('theme', 'soydt_foundation') . '/images/buttons/facebook-connect.png';
  return '<div class="description">Puede registrarse o iniciar sesi&oacute;n usando su cuenta de Facebook</div><a ' . $attributes . ' href="' . $url . '"><img src="/' . $src . '" alt="' . $title . '" /></a>';
}