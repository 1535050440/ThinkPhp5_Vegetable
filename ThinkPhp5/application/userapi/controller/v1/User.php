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
        echo 22;exit;

    }

}
