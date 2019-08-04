<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/11
 * Time: 0:05
 */

namespace app\userapi\controller\v1;


use app\common\model\OrderModel;
use app\common\model\UserModel;
use app\userapi\controller\UserApi;
use think\Request;

class Order extends UserApi
{
    /**
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function getOrderList(Request $request)
    {
        $condition = [
            'list_rows' => $request->param('list_rows')?:10,
            'page' => $request->param('page')?:1
        ];

        $getOrderList = OrderModel::getOrderList($condition);

        $this->success($getOrderList);

    }

    /**
     * @param Request $request
     * @throws \app\common\exception\ParamException
     * @deng      2019/8/4    22:20
     */
    public function addOrder(Request $request)
    {
        $orderArray = $request->param('products');

        $user_id = $request->user->id;

        $userFind = UserModel::get($user_id);

        $result = $userFind->addOrder($orderArray);

        $this->success($result);

    }

}
