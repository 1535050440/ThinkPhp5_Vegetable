<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/9
 * Time: 23:30
 */

namespace app\userapi\controller\v1;


use app\common\model\CategoryModel;
use app\userapi\controller\UserApi;
use think\Request;

class Category extends UserApi
{
    protected $no_need_token = [
        'getCategory'
    ];
    /**
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function getCategory(Request $request)
    {
        $list_rows = $request->param('list_rows')?:10;
        $page = $request->param('page')?:1;

        $categoryModel = CategoryModel::getCategoryList($list_rows,$page);

        $this->success($categoryModel);

    }
}
