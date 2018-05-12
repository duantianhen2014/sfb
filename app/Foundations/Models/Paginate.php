<?php
/**
 * File: Paginator.php
 * Author: 小滕<616896861@qq.com>
 * Date: 2018/5/12 18:17
 */


namespace App\Foundations\Models;


use Swoft\Db\Model;

class Paginate
{

    public $data;

    public $total;

    public $page;

    public $pageSize;

    /**
     * Paginate constructor.
     * @param $data
     * @param int $total
     * @param int $page
     * @param int $pageSize
     */
    public function __construct($data, $total = 0, $page = 1, $pageSize = 10)
    {
        $this->data = $data ?: new Model;
        $this->total = intval($total);
        $this->pageSize = intval($pageSize);
        $this->page = intval($page);
    }

}