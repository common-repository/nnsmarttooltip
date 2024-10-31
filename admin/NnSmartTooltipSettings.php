<?php

class NnSmartTooltipSettings
{
    public function createTooltipMenu()
    {
        add_menu_page(
            'NN Smart Tooltip',
            'NN Smart Tooltip',
            'administrator',
            'nnst_settings',
            [$this, 'settingsPageContent']
        );
    }

    public function registerSettings()
    {
        $optionGroup = 'nn-smart-tooltip-settings-group';
        register_setting($optionGroup, 'nn_smart_tooltip_event', [
            'type'              => 'string',
            'group'             => $optionGroup,
            'description'       => '',
            'sanitize_callback' => [$this, 'saveNnSmartTooltipEvent'],
            'show_in_rest'      => false,
        ]);
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function saveNnSmartTooltipEvent($value)
    {
        if ($value) {
            return $value;
        }

        add_settings_error('nn_smart_tooltip_event', 'settings_updated', __('Event field is required'));
    }

    public function settingsPageContent()
    {
        ob_start();
        include(plugin_dir_path(__FILE__) . 'partials/settingsPage.php');
        echo ob_get_clean();
    }
}
