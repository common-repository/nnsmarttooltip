<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since 1.0.0
 * @package NnSmartTooltip
 * @subpackage NnSmartTooltip/includes
 */
class NnSmartTooltipI18n
{
    /**
     * Load the plugin text domain for translation.
     *
     * @since 1.0.0
     */
    public function loadPluginTextdomain()
    {
        load_plugin_textdomain(
            'NnSmartTooltip',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
