<div class="wrap">
    <h2>NN Smart Tooltip Settings</h2>
    <?php settings_errors(); ?>
    <?php $event = get_option('nn_smart_tooltip_event');?>
    <form method="post" action="options.php">
        <?php settings_fields('nn-smart-tooltip-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Show tooltip by:'); ?></th>
                <td>
                    <select name="nn_smart_tooltip_event">
                        <option value="click" <?php echo $event === 'click' ? 'selected' : ''?>>Click</option>
                        <option value="hover" <?php echo $event === 'hover' ? 'selected' : ''?>>Hover</option>
                    </select>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>