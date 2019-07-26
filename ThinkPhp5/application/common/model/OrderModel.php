<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/11
 * Time: 0:07
 */

namespace app\common\model;


class OrderModel extends BaseModel
{
    protected $name = 'order';

    /**
     * @param $condition
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function getOrderList($condition)
    {
        $list_rows = empty($condition['list_rows'])?:10;
        $page = empty($condition['page'])?:1;

        $query = self::field('*');

        if (!empty($condition['user_id'])) {
            $query->where('user_id','=',$condition['user_id']);
        }

        return $query->paginate($list_rows,false,['page'=>$page]);
    }
}
