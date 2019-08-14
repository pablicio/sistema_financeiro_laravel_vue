<?php
/**
 * Created by PhpStorm.
 * User: Chronos Tecnologia
 * Date: 13/07/2017
 * Time: 09:49
 */

namespace App\Helpers;


class FluentInterface
{

    protected $fields = array();

    protected $from = array();

    protected $where = array();

    protected $innerjoin = array();

    protected $leftjoin = array();

    protected $outros = array();


    public function select(array $fields = array())
    {
        $this->fields = $fields;
        return $this;
    }

    public function from($table, $alias = "")
    {
        $this->from[] = $table  . $alias;
        return $this;
    }

    public function innerJoin($table, $condition)
    {
        $this->innerjoin[] = $table . ' ON ' . $condition;
        return $this;
    }

    public function leftJoin($table, $condition)
    {
        $this->leftjoin[] = $table . ' ON ' . $condition;
        return $this;
    }

    public function where($condition)
    {
        if ($condition) {
            $this->where[] = $condition;
        }

        return $this;
    }

    public function getQuery()
    {
        $select = 'SELECT ' . implode(',', $this->fields) != 'SELECT ' ? 'SELECT ' . implode(',', $this->fields) : '';

        $from = ' FROM ' . implode(',', $this->from) != ' INNER JOIN ' ? ' FROM ' . implode(',', $this->from) : '';

        $innerJoin = ' INNER JOIN ' . implode($this->innerjoin) != ' INNER JOIN ' ? ' INNER JOIN ' . implode(' INNER JOIN ', $this->innerjoin) : '';

        $leftJoin = ' LEFT JOIN ' . implode($this->leftjoin) != ' LEFT JOIN ' ? ' LEFT JOIN ' . implode(' LEFT JOIN ', $this->leftjoin) : '';

        $where = ' WHERE ' . implode(' AND ', $this->where) != ' WHERE ' ? ' WHERE ' . implode(' AND ', $this->where) : '';

        return $select . $from .$leftJoin. $innerJoin . $where;
    }
}