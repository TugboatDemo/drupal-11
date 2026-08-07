<?php
/**
 * @file
 * Tugboat preview environment settings.
 *
 * To activate these settings for sites in Tugboat preview environments,
 * ensure that this file is placed in .tugboat/settings.local.php
 * in the root of your git repository.
 */

/**
 * Database connection information for Tugboat preview environments.
 */
$databases['default']['default'] = array (
  'database' => 'tugboat',
  'username' => 'tugboat',
  'password' => 'tugboat',
  'prefix' => '',
  'host' => 'database',
  'port' => '3306',
  'driver' => 'mysql',
  'isolation_level' => "READ COMMITTED",
);

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 *
 * Use the TUGBOAT_REPO_ID to generate a hash salt for Tugboat sites.
 */
$settings['hash_salt'] = hash('sha256', getenv('TUGBOAT_REPO_ID'));

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
$settings['skip_permissions_hardening'] = TRUE;

/**
 * Trusted host configuration for Tugboat preview environments.
 *
 * Drupal requires you to specify which hostnames are allowed to access your
 * site. Since Tugboat preview URLs use the tugboatqa.com domain, we add this
 * pattern to allow Drupal to accept requests from any Tugboat preview URL.
 *
 * @see https://www.drupal.org/docs/installing-drupal/trusted-host-settings
 */
$settings['trusted_host_patterns'] = [
  '\.tugboatqa\.com$',
];

/**
 * Set the memory limit for the CLI (drush).
 */
if (PHP_SAPI === 'cli') {
  ini_set('memory_limit', '-1');
}
