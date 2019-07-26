<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/24
 * Time: 23:52
 */

namespace app\userapi\controller\v1;


use app\userapi\controller\UserApi;
use think\Request;

class User extends UserApi
{
    public function info(Request $request)
    {
        if (!$request->user->nick_name) {
            $request->user->nick_name = '请授权';
        }

        if ($request->user->nick_name) {
            $request->user->nick_name = base64_decode($request->user->nick_name);
        }

        $this->success($request->user);

    }

    public function updateUserInfo(Request $request)
    {
        $avatar = $request->param('avatar');
        $nick_name = $request->param('nick_name');
        $sex = $request->param('sex');

        $userFind = $request->user;

        $userFind->avatar = $avatar;
        $userFind->nick_name = base64_encode($nick_name);
        $userFind->sex = $sex;
        $userFind->save();

        $this->success('success');

    }

}
