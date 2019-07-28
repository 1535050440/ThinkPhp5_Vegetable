<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/28
 * Time: 0:13
 */

namespace app\userapi\controller\v1;


use app\common\exception\ParamException;
use app\common\model\SmsModel;
use app\common\model\UserModel;
use app\common\service\UserToken;
use app\userapi\controller\UserApi;
use think\Request;

class Register extends UserApi
{
    protected $no_need_token = [
        'register'
    ];
    /**
     * 用户注册
     * 手机号+code+yzm
     * @param Request $request
     * @throws ParamException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function register(Request $request)
    {
        $code = $request->param('code');
        $mobile = $request->param('mobile');
        $yzm = $request->param('yzm');

        if (empty($code)) {
            throw new ParamException('code不能为空');
        }

        if (empty($mobile)) {
            throw new ParamException('手机号不能为空');
        }

        if (empty($yzm)) {
            throw new ParamException('验证码不能为空');
        }

        $smsFind = SmsModel::where('mobile','=',$mobile)
            ->order('id desc')
            ->find();

        if (!$smsFind) {
            throw new ParamException('手机号输入错误！');
        }
        if ($smsFind->code != $code) {
            throw new ParamException('验证码输入错误，请重试！');
        }

        $userFind = new UserToken();
        $wxResult = $userFind->getWeChatOpenId($code);

        $open_id = $wxResult['openid'];

        $userFind = new UserModel();
        $result = $userFind->addUser($mobile,$open_id);


        $this->success($result);
    }

}
