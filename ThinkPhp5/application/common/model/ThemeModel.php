<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/9
 * Time: 23:55
 */

namespace app\common\model;


class ThemeModel extends BaseModel
{
    protected $name = 'theme';

    protected $hidden = [
        'delete_time',
        'update_time',
        'head_img_id',
        'top_img_id'
    ];

    /**
     * 一对一管理查询belongsTo
     * @return \think\model\relation\BelongsTo
     */
    public function headImg()
    {
        return $this->belongsTo('ImageModel', 'head_img_id', 'id');
    }

    /**
     * 一对一管理查询belongsTo
     * @return \think\model\relation\BelongsTo
     */
    public function topImg()
    {
        return $this->belongsTo('ImageModel', 'top_img_id', 'id');
    }
    public function products()
    {
        return $this->hasMany('ProductModel','img_id','id');
    }
    public function themeProduct()
    {
        return $this->belongsTo('ThemeProductModel','theme_id','id');
    }

    /**
     * 获取未删除的主题列表
     * @param int $list_rows
     * @param int $page
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function getThemeList($list_rows = 10,$page = 1)
    {
        return self::with('headImg,topImg')
            ->where('delete_time','=',null)
            ->paginate($list_rows,false,['page'=>$page]);
    }

    /**
     * @param $id
     * @param int $list_rows
     * @param int $page
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public static function getThemeProductList($id, $list_rows = 10,$page = 1)
    {
        $query = ThemeProductModel::alias('a')
            ->join('product b','a.product_id = b.id','left');

        $result = $query->paginate($list_rows,false,['page'=>$page]);

        return $result;
    }

}
