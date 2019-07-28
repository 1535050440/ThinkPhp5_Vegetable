<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/28
 * Time: 23:37
 */

namespace app\userapi\controller\v1;


use app\common\model\UserModel;
use app\userapi\controller\UserApi;
use think\Request;

class UserSign extends UserApi
{
    /**
     * 用户签到
     * @param Request $request
     * @throws \app\common\exception\ParamException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function addUserSign(Request $request)
    {
        $userFind = UserModel::get($request->user->id);

        $userFind->addSign();

        $this->success('签到成功');
    }
}
