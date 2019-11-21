<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wang extends Model
{
     public $primaryKey='w_id';
        /**
         * 可以被批量赋值的属性.
         *
         * @var array
         */
        protected $fillable = ['w_id','w_name','w_url','w_lei','w_logo','w_man','w_desc','w_status'];

        /**
         * 关联到模型的数据表
         *
         * @var string
         */
        protected $table = 'wang';

        /**
         * 表明模型是否应该被打上时间戳
         *
         * @var bool
         */
        public $timestamps = false;
}
