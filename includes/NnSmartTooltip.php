<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 1.0.0
 * @package NnSmartTooltip
 * @subpackage NnSmartTooltip/includes
 * @author AuthorName <AuthorEmail@email.com>
 */
class NnSmartTooltip
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since 1.0.0
     * @access protected
     * @var NnSmartTooltipLoader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since 1.0.0
     * @access protected
     * @var string $pluginName The string used to uniquely identify this plugin.
     */
    protected $pluginName;

    /**
     * The current version of the plugin.
     *
     * @since 1.0.0
     * @access protected
     * @var string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('NN_SMART_TOOLTIP')) {
            $this->version = NN_SMART_TOOLTIP;
        } else {
            $this->version = '1.0.0';
        }

        $this->pluginName = 'NnSmartTooltip';

        $this->loadDependencies();
        $this->setLocale();
        $this->defineAdminHooks();
        $this->definePublicHooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - NnSmartTooltipLoader. Orchestrates the hooks of the plugin.
     * - NnSmartTooltipI18n. Defines internationalization functionality.
     * - NnSmartTooltipAdmin. Defines all hooks for the admin area.
     * - NnSmartTooltipPublic. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since 1.0.0
     * @access private
     */
    private function loadDependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(__DIR__) . 'includes/NnSmartTooltipLoader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(__DIR__) . 'includes/NnSmartTooltipI18n.php';

        /**s
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(__DIR__) . 'admin/NnSmartTooltipAdmin.php';
        require_once plugin_dir_path(__DIR__) . 'admin/NnSmartTooltipTinymceTooltip.php';
        require_once plugin_dir_path(__DIR__) . 'admin/partials/tinymceTooltipPopup.php';
        require_once plugin_dir_path(__DIR__) . 'admin/NnSmartTooltipSettings.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(__DIR__) . 'public/NnSmartTooltipPublic.php';
        require_once plugin_dir_path(__DIR__) . 'public/FrontNnSmartTooltip.php';

        $this->loader = new NnSmartTooltipLoader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the NnSmartTooltipI18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since 1.0.0
     * @access private
     */
    private function setLocale()
    {
        $plugin_i18n = new NnSmartTooltipI18n();
        $this->loader->addAction('plugins_loaded', $plugin_i18n, 'loadPluginTextdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since 1.0.0
     * @access private
     */
    private function defineAdminHooks()
    {
        $pluginAdmin = new NnSmartTooltipAdmin($this->getPluginName(), $this->getVersion());

        $tinymceTooltip = new NnSmartTooltipTinymceTooltip();
        $settingsPage = new NnSmartTooltipSettings();

        if (is_admin()) {
            $this->loader->addAction('admin_menu', $settingsPage, 'createTooltipMenu', 10, 4);
            $this->loader->addAction('admin_menu', $settingsPage, 'registerSettings', 10);
            $this->loader->addFilter('mce_external_plugins', $tinymceTooltip, 'addTooltipButtonToPanel');
            $this->loader->addFilter('mce_buttons', $tinymceTooltip, 'registerTooltipButton');
            $this->loader->addFilter('mce_css', $tinymceTooltip, 'addStyles');
            $this->loader->addAction('wp_ajax_save_tooltip', $tinymceTooltip, 'ajaxSaveTooltip', 10, 2);
            $this->loader->addAction('wp_ajax_get_tooltip', $tinymceTooltip, 'ajaxGetTooltipById', 10, 2);
            $this->loader->addAction('wp_ajax_update_tooltip', $tinymceTooltip, 'ajaxUpdateTooltip', 10, 2);
            $this->loader->addAction('admin_enqueue_scripts', $pluginAdmin, 'enqueueStyles');
            $this->loader->addAction('admin_enqueue_scripts', $pluginAdmin, 'enqueueScripts');
        }
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since 1.0.0
     * @access private
     */
    private function definePublicHooks()
    {
        $pluginPublic = new NnSmartTooltipPublic($this->getPluginName(), $this->getVersion());
        $frontTooltip = new FrontNnSmartTooltip();

        if (!is_admin()) {
            $this->loader->addAction('the_content', $frontTooltip, 'addTooltips');
            $this->loader->addAction('wp_enqueue_scripts', $pluginPublic, 'enqueueStyles');
            $this->loader->addAction('wp_enqueue_scripts', $pluginPublic, 'enqueueScripts');
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since 1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since 1.0.0
     * @return string The name of the plugin.
     */
    public function getPluginName()
    {
        return $this->pluginName;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since 1.0.0
     * @return NnSmartTooltipLoader Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since 1.0.0
     * @return string The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }

}
