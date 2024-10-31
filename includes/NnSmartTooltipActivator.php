<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 1.0.0
 * @package NnSmartTooltip
 * @subpackage NnSmartTooltip/includes
 * @author AuthorName <AuthorEmail@email.com>
 */
class NnSmartTooltipActivator
{
    const TABLE_TOOLTIP = 'nn_smart_tooltip';
    const VERSION_OPTION = 'nn_smart_tooltip_version';
    const DB_VERSION = '1.0';

    /**
     * Create table for blocks
     */
    public static function createTooltipTable()
    {
        global $wpdb;

        $tableName = $wpdb->prefix . self::TABLE_TOOLTIP;
        $postsTableName = $wpdb->prefix . 'posts';

        if ($wpdb->get_var("show tables like '$tableName'") !== $tableName) {
            $sql = "CREATE TABLE " . $tableName . " (
                  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                  post_id BIGINT(20) UNSIGNED NOT NULL,
                  tooltip TEXT NOT NULL,
                  PRIMARY KEY(id),
                  INDEX post_id (post_id),
                  FOREIGN KEY (post_id)
                    REFERENCES " . $postsTableName . "(id)
                    ON DELETE CASCADE
                );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since 1.0.0
     */
    public static function activate()
    {
        $installedVersion = get_option(self::VERSION_OPTION);

        if (!$installedVersion) {
            self::createTooltipTable();
        }

        update_option(self::VERSION_OPTION, self::DB_VERSION);
    }
}
