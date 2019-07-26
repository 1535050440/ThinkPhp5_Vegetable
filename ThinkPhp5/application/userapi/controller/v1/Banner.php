<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/6/23
 * Time: 22:27
 */

namespace app\userapi\controller\v1;


use app\common\exception\ParamException;
use app\common\model\BannerModel;
use app\userapi\controller\UserApi;
use think\facade\Log;
use think\Request;

class Banner extends UserApi
{
    protected $no_need_token = [
        'getBannerList',
    ];


    /**
     * @param Request $request
     * @throws ParamException
     * @throws \think\exception\DbException
     */
    public function getBannerList(Request $request)
    {
        $id = $request->param('id');
        if (empty($id)) {
            throw new ParamException('参数错误');
        }

        $getBanner = BannerModel::getBannerById($id);

        $this->success($getBanner);

    }
}
