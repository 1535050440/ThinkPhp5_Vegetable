<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/24
 * Time: 22:52
 */

namespace app\common\model;

use app\common\exception\ParamException;

/**
 * Class UserModel
 * @package app\common\model
 * @method static UserModel get($id)
 */
class UserModel extends BaseModel
{
    protected $name = 'user';

    /**
     * 检查当前openid是否存在，不存在新增用户
     * @param $open_id
     * @return UserModel|array|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function addUserOpenID($open_id)
    {
        $userFind = self::where('open_id','=',$open_id)
            ->find();

        if (!$userFind) {
            //  不存在，新增一条
            $userFind = self::create([
                'open_id' => $open_id,
                'add_time' => time()
            ]);
        }

        return $userFind;

    }

    public function addUser($mobile,$open_id)
    {
        $userFind = self::where('open_id','=',$open_id)
            ->find();

        if (!$userFind) {
            //  不存在，新增一条
            $userFind = self::create([
                'open_id' => $open_id,
                'add_time' => time(),
                'nick_name' => base64_encode(mobile_change($mobile)),
                'invite_code' => rand(1000,9999)
            ]);
        }
        if (empty($userFind->mobile)) {
            $userFind->mobile = $mobile;
            $userFind->save();
        }

        return $userFind;
    }

    /**
     * 用户签到
     * @return UserSignModel
     * @throws ParamException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function addSign()
    {
        $time_day = strtotime(date('Y-m-d'));
        $status = UserSignModel::where('user_id','=',$this->id)
            ->where('add_time','>=',$time_day)
            ->find();
        if ($status) {
            throw new ParamException('今日已签，请勿重复签到！');
        }

        $data = [
            'user_id' => $this->id,
            'add_time' => time(),
        ];

        return UserSignModel::create($data);
    }

}
