<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $primaryKey='brand_id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['brand_name','brand_logo','brand_url','is_show'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'brand';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
