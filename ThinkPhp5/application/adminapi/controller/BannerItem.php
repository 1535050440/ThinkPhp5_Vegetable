<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/6/28
 * Time: 23:52
 */

namespace app\adminapi\controller;


use app\common\exception\ParamException;
use app\common\model\BannerItemModel;
use app\common\model\BannerModel;
use think\Request;

class BannerItem extends AdminApi
{
    /**
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function index(Request $request)
    {
        $id = $request->param('id');

        $bannerList = BannerModel::getBanner($id);

        $this->success($bannerList);
    }

    /**
     * 添加
     * @param Request $request
     */
    public function add(Request $request)
    {
        $from = $request->param('from');
        $path = $request->param('path');

        BannerItemModel::create([
            'from' =>$from,
            'path' =>$path
        ]);

        $this->success();
    }

    /**
     * 修改
     * @param Request $request
     * @throws ParamException
     */
    public function update(Request $request)
    {
        $id = $request->param('id');
        $from = $request->param('from');
        $path = $request->param('path');

        $bannerItemFind =  BannerItemModel::get($id);
        if (empty($id)) {
            throw new ParamException('参数错误');
        }

        $bannerItemFind->from = $from;
        $bannerItemFind->path = $path;
        $bannerItemFind->save();

        $this->success();
    }

    /**
     * 删除
     * @param Request $request
     * @throws ParamException
     */
    public function delete(Request $request)
    {
        $id = $request->param('id');

        $bannerItemFind =  BannerItemModel::get($id);
        if (empty($id)) {
            throw new ParamException('参数错误');
        }

        $bannerItemFind->delete_time = time();
        $bannerItemFind->save();

        $this->success();
    }
}
