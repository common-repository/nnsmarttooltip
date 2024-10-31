<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link AuthorUri
 * @since 1.0.0
 *
 * @package NnSmartTooltip
 * @subpackage NnSmartTooltip/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package NnSmartTooltip
 * @subpackage NnSmartTooltip/public
 * @author AuthorName <AuthorEmail@email.com>
 */
class NnSmartTooltipPublic
{
    /**
     * The ID of this plugin.
     *
     * @since 1.0.0
     * @access private
     * @var string $pluginName The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @since 1.0.0
     * @access private
     * @var string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $pluginName The name of the plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueueStyles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in NnSmartTooltipLoader as all of the hooks are defined
         * in that particular class.
         *
         * The NnSmartTooltipLoader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->pluginName,
            plugin_dir_url(__FILE__) . '../plugin-assets/public.css',
            [],
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueueScripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in NnSmartTooltipLoader as all of the hooks are defined
         * in that particular class.
         *
         * The NnSmartTooltipLoader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(
            $this->pluginName,
            plugin_dir_url(__FILE__) . '../plugin-assets/public.bundle.js',
            ['jquery'],
            $this->version,
            false
        );
    }
}
