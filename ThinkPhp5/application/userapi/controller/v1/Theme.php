<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/9
 * Time: 23:55
 */

namespace app\userapi\controller\v1;


use app\common\model\ThemeModel;
use app\userapi\controller\UserApi;
use think\Request;

class Theme extends UserApi
{
    protected $no_need_token = [
        'getThemeList'
    ];

    /**
     * 获取主题
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function getThemeList(Request $request)
    {
        $list_rows = $request->param('list_rows')?:10;
        $page = $request->param('page')?:1;

        $themeModel = ThemeModel::getThemeList($list_rows,$page);
        $this->success($themeModel);
    }

    /**
     * 查询当前主题下的商品列表
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function getThemeProductList(Request $request)
    {
        $id = $request->param('id');
        $list_rows = $request->param('list_rows')?:10;
        $page = $request->param('page')?:1;

        $themeModel = ThemeModel::getThemeProductList($id, $list_rows,$page);
        $this->success($themeModel);

    }

}
