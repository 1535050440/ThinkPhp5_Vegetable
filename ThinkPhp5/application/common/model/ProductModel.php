<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/7/10
 * Time: 0:05
 */

namespace app\common\model;


class ProductModel extends BaseModel
{
    protected $name = 'product';

    protected $hidden = [
//        'img_id',
        'update_time',
        'category_id',
    ];
    /**
     * 商品图片
     * @return \think\model\relation\BelongsTo
     */
    public function img()
    {
        return $this->belongsTo('ImageModel', 'img_id', 'id');
    }

    public function productImage()
    {
        return $this->hasMany('ProductImageModel','product_id','id');
    }

    /**
     * @param $id
     * @return array|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getProductFind($id)
    {
        return self::with(['img','productImage.img'])
            ->where('id','=',$id)
            ->find();


    }
}
