<?php
/**
 * Exposes the variable $site_frontpage as context reaction.
 */
class context_reaction_site_frontpage extends context_reaction {
  /**
   * Display the reaction field to set the new front page.
   */
  public function options_form($context) {
    $values = $this->fetch_from_context($context);

    $form = array(
      '#tree'             => TRUE,
      '#title'            => t('Front page'),
      'site_frontpage' => array(
        '#type'          => 'textfield',
        '#title'         => t('Default front page'),
        '#description'   => t('Enter the path for the default front page.'),
        '#default_value' => isset($values['site_frontpage'])
                              ? $values['site_frontpage']
                              : variable_get('site_frontpage', 'node'),
        '#element_validate' => array('context_reaction_site_frontpage_validate'),
      ),
    );

    return $form;
  }

  /**
   * For the homepage only, set the new path as the front page.
   *
   * @global string $conf['site_frontpage']
   */
  public function execute() {
    if ($_SERVER['REQUEST_URI'] !== base_path()) {
      return;
    }

    global $conf;

    foreach (context_active_contexts() as $context) {
      if (!isset($context->reactions[$this->plugin]['site_frontpage']))
        continue;

      $frontpage = $context->reactions[$this->plugin]['site_frontpage'];
      $_GET['q'] = drupal_get_normal_path($frontpage);
      $conf['site_frontpage'] = $frontpage;
    }
  }
}

