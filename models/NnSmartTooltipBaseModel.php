<?php

abstract class NnSmartTooltipBaseModel
{
    /**
     * WP table model
     */
    protected $model;

    /**
     * @param $object
     */
    public function __construct($object)
    {
        $this->model = $object;
    }
}
