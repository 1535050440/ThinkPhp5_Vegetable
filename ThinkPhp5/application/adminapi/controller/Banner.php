<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/6/27
 * Time: 23:27
 */

namespace app\adminapi\controller;


use app\common\exception\ParamException;
use app\common\model\BannerModel;
use think\Request;

class Banner extends AdminApi
{
    /**
     * Banner列表
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function index(Request $request)
    {
        $list_rows = $request->param('list_rows')?:10;
        $page = $request->param('page')?:1;

        $bannerList = BannerModel::field('*')
            ->paginate($list_rows,false,['page'=>$page]);
        $this->success($bannerList);
    }

    /**
     * 添加
     * @param Request $request
     */
    public function add(Request $request)
    {
        $name = $request->param('name');

        BannerModel::create([
            'name' => $name,
            'add_time' => time()
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
        $name = $request->param('name');

        if (empty($id)) {
            throw new ParamException('参数不能为空');
        }
        $bannerFind = BannerModel::get($id);
        $bannerFind->name = $name;
        $bannerFind->save();

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
        $bannerFind = BannerModel::get($id);

        if (empty($bannerFind)) {
            throw new ParamException('参数错误');
        }

        $this->success($bannerFind);
    }




}
