<?php
/**
 * @file
 * fetures_programacion.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function fetures_programacion_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'create banner_programacion content'.
  $permissions['create banner_programacion content'] = array(
    'name' => 'create banner_programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'create programacion content'.
  $permissions['create programacion content'] = array(
    'name' => 'create programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete any banner_programacion content'.
  $permissions['delete any banner_programacion content'] = array(
    'name' => 'delete any banner_programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete any programacion content'.
  $permissions['delete any programacion content'] = array(
    'name' => 'delete any programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete own banner_programacion content'.
  $permissions['delete own banner_programacion content'] = array(
    'name' => 'delete own banner_programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete own programacion content'.
  $permissions['delete own programacion content'] = array(
    'name' => 'delete own programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit any banner_programacion content'.
  $permissions['edit any banner_programacion content'] = array(
    'name' => 'edit any banner_programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit any programacion content'.
  $permissions['edit any programacion content'] = array(
    'name' => 'edit any programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit own banner_programacion content'.
  $permissions['edit own banner_programacion content'] = array(
    'name' => 'edit own banner_programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit own programacion content'.
  $permissions['edit own programacion content'] = array(
    'name' => 'edit own programacion content',
    'roles' => array(),
    'module' => 'node',
  );

  return $permissions;
}
