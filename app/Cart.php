<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $primaryKey='c_id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['goods_id','buy_number','user_id','add_time','add_price','is_del'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
