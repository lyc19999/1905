<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $primaryKey='admin_id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['admin_name','admin_tel','admin_pwd','admin_head','admin_sex','admin_email','admin_time'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
