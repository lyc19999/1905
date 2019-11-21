<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey='order_id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['order_no','order_amount','pay_status','pay_type','order_status','order_talk','create_time','update_time','is_del','user_id'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
