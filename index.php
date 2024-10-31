<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/billizzard
 * @since             1.0.0
 * @package           NnSmartTooltip
 *
 * @wordpress-plugin
 * Plugin Name:       NnSmartTooltip
 * Plugin URI:        MyUserfulPlugin
 * Description:       Allows you to simply create tips with any content and any styles.
 * Version:           1.0.0
 * Author:            Hmylko Vladimir
 * Author URI:        https://github.com/billizzard
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('NN_SMART_TOOLTIP', '1.0.0');

/**
 * The code that runs during plugin activation.
 */
function activateNnSmartTooltip()
{
    require_once plugin_dir_path(__FILE__) . 'includes/NnSmartTooltipActivator.php';
    NnSmartTooltipActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivateNnSmartTooltip()
{
    require_once plugin_dir_path(__FILE__) . 'includes/NnSmartTooltipDeactivator.php';
    NnSmartTooltipDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activateNnSmartTooltip');
register_deactivation_hook(__FILE__, 'deactivateNnSmartTooltip');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/NnSmartTooltip.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runNnSmartTooltip()
{
    $plugin = new NnSmartTooltip();
    $plugin->run();
}

runNnSmartTooltip();
