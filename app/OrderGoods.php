<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    public $primaryKey='id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['goods_id','goods_name','goods_price','buy_number','goods_img','create_time','update_time','is_del','order_id','user_id'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'order_goods';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
