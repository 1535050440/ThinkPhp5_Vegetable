<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/10
 * Time: 23:52
 */

namespace app\userapi\controller\v1;


use app\common\exception\ParamException;
use app\common\model\CategoryModel;
use app\common\model\ProductModel;
use app\common\model\ThemeModel;
use app\common\model\ThemeProductModel;
use app\userapi\controller\UserApi;
use think\Request;

class Product extends UserApi
{
    protected $no_need_token = [
        'getProductList'
    ];

    /**
     * @param Request $request
     * @throws \think\exception\DbException
     * @deng      2019/7/30    23:17
     */
    public function getProductList(Request $request)
    {
        $categoryId = $request->param('categoryId');
        $listRows = $request->param('listRows')?:10;
        $page = $request->param('page')?:1;

        $paramArray = [
            'categoryId' => $categoryId,
        ];
        $result = ProductModel::getProductList($listRows, $page, $paramArray);

        $this->success($result);
    }

    /**
     * 单个商品展示
     * @param Request $request
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getProductFind(Request $request)
    {
        $id = $request->param('id');

        $productFind = ProductModel::getProductFind($id);

        $this->success($productFind);
    }



}
