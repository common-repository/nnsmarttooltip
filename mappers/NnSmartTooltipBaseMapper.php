<?php

abstract class NnSmartTooltipBaseMapper
{
    protected $primaryKey = 'id';
    /** @var WP_Query */
    protected $wpdb;

    protected $selectedColumns = [];

    protected static $instance;

    abstract protected function table();
    abstract protected function doCreateObject($object);
    abstract protected function doCreateArray($array);

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            global $wpdb;
            static::$instance = new static();
            static::$instance->wpdb = $wpdb;
        }

        return static::$instance;
    }

    /**
     * Insert data to table
     * @param array $data
     *
     * @return false|int
     */
    public function insert(array $data)
    {
        $this->wpdb->insert($this->table(), $data);
        return $this->wpdb->insert_id;
    }

    /**
     * Update rows
     * @param array $data
     * @param array $where
     */
    public function update($data, $where)
    {
        $this->wpdb->update($this->table(), $data, $where);
    }

    /**
     * Delete row by id
     * @param int $id
     *
     * @return bool|int
     */
    public function delete($id)
    {
        $sql = $this->getClearSql('DELETE FROM %s WHERE %s = %%d', [$this->table(), $this->primaryKey]);
        return $this->wpdb->query($this->wpdb->prepare($sql, $id));
    }

    /**
     * Get inserted id
     *
     * @return int
     */
    public function insertId()
    {
        return $this->wpdb->insert_id;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public function createArray($array)
    {
        if (!$array) {
            return [];
        }
        return $this->doCreateArray($array);
    }

    /**
     * @param object $object
     *
     * @return null
     */
    public function createObject($object)
    {
        if (!$object) {
            return null;
        }
        return $this->doCreateObject($object);
    }

    /**
     * @param int $id
     *
     * @return null|object
     */
    public function getById($id)
    {
        $sql = $this->getClearSql(
            'SELECT %s FROM %s WHERE %s = %%d',
            [
                $this->getSqlSelectedColumns(),
                $this->table(),
                $this->primaryKey
            ]
        );

        return $this->createObject($this->wpdb->get_row($this->wpdb->prepare($sql, $id)));
    }

    /**
     * @param array $ids
     *
     * @return array
     */
    public function getByIds($ids)
    {
        if ($ids) {
            $ids = array_map('intval', $ids);

            $sql = $this->getClearSql(
                'SELECT %s FROM %s WHERE %s IN (' . implode(',', $ids) . ')',
                [
                    $this->getSqlSelectedColumns(),
                    $this->table(),
                    $this->primaryKey
                ]
            );

            $objects = $this->wpdb->get_results($sql);
            return $this->createArray($objects);
        }

        return [];
    }


    /**
     * @param array $columns
     *
     * @return $this
     */
    protected function setSelectedColumns($columns = [])
    {
        $this->selectedColumns = $columns;
        return $this;
    }

    /**
     * Return array of columns for the selection
     *
     * @return array
     */
    protected function getSelectedColumns()
    {
        return $this->selectedColumns;
    }

    /**
     * Return string for mysql query with columns for the selection
     *
     * @return string
     */
    protected function getSqlSelectedColumns()
    {
        return $this->selectedColumns ? implode(',', $this->selectedColumns) : '*';
    }

    /**
     * Return sql query with inserted cleaned parameters
     * @param string $sql
     * @param array $parameters
     *
     * @return string
     */
    protected function getClearSql($sql, $parameters)
    {
        $parameters = $this->clearParameters($parameters);
        return vsprintf($sql, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    private function clearParameters($parameters)
    {
        return array_map(function ($parameter) {
            return $this->clearString($parameter);
        }, $parameters);
    }

    /**
     * @param $string
     *
     * @return null|string
     */
    private function clearString($string)
    {
        return preg_replace('/[^a-zA-Z0-9_,*]/', '', $string);
    }

    final private function __construct () {}
    final private function __clone() {}
    final private function __wakeup() {}
}
