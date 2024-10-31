<?php

require_once plugin_dir_path(dirname(__FILE__)) . 'models/NnSmartTooltipTooltipModel.php';
require_once plugin_dir_path(dirname(__FILE__)) . 'mappers/NnSmartTooltipBaseMapper.php';

class NnSmartTooltipTooltipMapper extends NnSmartTooltipBaseMapper
{
    /**
     * @return string
     */
    protected function table()
    {
        return $this->wpdb->prefix . 'nn_smart_tooltip';
    }

    /**
     * @param object $object
     *
     * @return null|NnSmartTooltipTooltipModel
     */
    protected function doCreateObject($object)
    {
        return $object ? new NnSmartTooltipTooltipModel($object) : null;
    }

    /**
     * @param array $array
     *
     * @return NnSmartTooltipTooltipModel[]
     */
    protected function doCreateArray($array)
    {
        return array_map(function ($rawData) {
            return new NnSmartTooltipTooltipModel($rawData);
        }, $array);
    }
}
