<?php

namespace App\Foundations\Models;

use Swoft\Db\Query;

trait EasyTrait
{

    /**
     * 获取某个某个模型的记录条数
     *
     * @return int
     */
    public static function getCountData()
    {
        $result = Query::table(self::class)->count()->getResult();
        return intval($result['count']);
    }

    /**
     * 分页获取数据
     *
     * @param array $condition
     * @param array $orderBy
     * @param null $page
     * @param int $pageSize
     *
     * @return \App\Foundations\Models\Paginate
     */
    public static function getPaginateData(
        $condition = [],
        $orderBy = ['id' => 'desc'],
        $page = null,
        $pageSize = null
    )
    {
        $page = is_null($page) ? request()->input('page', 1) : $page;
        $pageSize = is_null($pageSize) ? request()->input('page_size', 10) : $pageSize;
        $offset = ($page - 1) * $pageSize;

        $total = self::getCountData();

        $data = self::findAll($condition, [
            'limit' => $pageSize,
            'offset' => $offset,
            'orderby' => $orderBy
        ])->getResult();

        return new Paginate($data, $total, $page, $pageSize);
    }

}
