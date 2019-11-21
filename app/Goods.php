<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $primaryKey='goods_id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['goods_name','goods_price','goods_num','goods_score','is_new','is_hot','is_best','is_up','goods_img','goods_imgs','goods_desc','brand_id','cate_id'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
