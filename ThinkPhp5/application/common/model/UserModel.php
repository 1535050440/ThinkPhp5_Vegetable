<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/24
 * Time: 22:52
 */

namespace app\common\model;


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
                'invite_code' => rand(1000,9999)
            ]);
        }
        if (empty($userFind->mobile)) {
            $userFind->mobile = $mobile;
            $userFind->save();
        }

        return $userFind;
    }

}
