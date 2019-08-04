<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/8/4
 * Time: 18:34
 */

namespace app\userapi\controller\v1;


use app\common\model\UserAddressModel;
use app\common\model\UserModel;
use app\userapi\controller\UserApi;
use think\Request;

class UserAddress extends UserApi
{

    /**
     * 新增收货地址
     * @param Request $request
     * @throws \app\common\exception\ParamException
     * @deng      2019/8/4    18:35
     */
    public function add(Request $request)
    {
        $name = $request->param('name');
        $mobile = $request->param('mobile');
        $detail = $request->param('address');

        $user_id = $request->user->id;
        $userFind = UserModel::get($user_id);

        $userFind->addAddress($name, $mobile, $detail);

        $this->success('添加成功');
    }

    /**
     * 获取用户收货地址列表
     * @param Request $request
     * @return void
     * @throws \think\exception\DbException
     * @deng      2019/8/4    20:08
     */
    public function getUserAddressList(Request $request)
    {
        $list_rows = $request->param('list_rows')?:10;
        $page = $request->param('page')?:1;
        $user_id = $request->user->id;

        $userFind = UserModel::get($user_id);
        $result = $userFind->getUserAddressList($list_rows, $page);

        $this->success($result);
    }

    /**
     * @param Request $request
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @deng      2019/8/4    20:35
     */
    public function getUserAddressFind(Request $request)
    {
        $user_id = $request->user->id;

        $userFind = UserModel::get($user_id);
        $result = $userFind->getUserAddressFind();

        $this->success($result);
    }
}
