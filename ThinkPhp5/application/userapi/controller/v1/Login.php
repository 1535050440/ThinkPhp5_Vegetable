<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/24
 * Time: 20:00
 */

namespace app\userapi\controller\v1;


use app\common\exception\ParamException;
use app\common\model\SmsModel;
use app\common\model\UserModel;
use app\common\service\UserToken;
use app\userapi\controller\UserApi;
use think\facade\Config;
use think\Request;

class Login extends UserApi
{
    protected $no_need_token = [
        'login',
        'sendSms',
        'register'
    ];

    /**
     * 用户登陆
     * @param Request $request
     * @throws ParamException
     */
    public function login(Request $request)
    {
        $code = $request->param('code');

        if (empty($code)) {
            throw new ParamException('code参数不能为空');
        }

        $userFind = new UserToken();
        $wxResult = $userFind->getUserToken($code);


        print_r($wxResult);exit;

    }

    /**
     * 点击发送短信验证码
     * @param Request $request
     * @throws ParamException
     */
    public function sendSms(Request $request)
    {
        $a = Config('sms.accessKeyId');
        print_r($a);exit;
        $mobile = trim($request->param('mobile'));

        if (empty($mobile)) {
            throw new ParamException('手机号格式错误');
        }


        $addSendSms = SmsModel::addSendSms($mobile);
        print_r($addSendSms);

    }

    /**
     * 用户注册
     * 手机号+code+yzm
     * @param Request $request
     * @throws ParamException
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

        $userFind = new UserToken();
        $wxResult = $userFind->getWeChatOpenId($code);

        $open_id = $wxResult['openid'];

        $userFind = new UserModel();
        $result = $userFind->addUser($mobile,$open_id);


        $this->success($result);
    }

}
