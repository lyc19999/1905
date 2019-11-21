<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    public $primaryKey='cate_id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['cate_id','cate_name','cate_show','cate_nav_show','parent_id'];

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    public static function showType(){
        $cateInfo = Category::get();
        $cateInfo = self::list_level($cateInfo);
        return $cateInfo;
    }

    public static function list_level($cateInfo,$parent_id=0,$level=0){
        static $info =[];
        foreach ($cateInfo as $k => $v) {
            if($v['parent_id']==$parent_id){
                $v['level']=$level;
                // print_r($v);exit;
                $info[]=$v;//将循环的值不断赋值给静态变量
                //再次调用函数，循环使每个下一级的分类加一
                self::list_level($cateInfo,$v->cate_id,$level+1);
            }
        }

        return $info;

    }

    public static function showId(){
        $cateInfo = Category::get();
        $cateInfo = self::getCateId($cateInfo);
        return $cateInfo;
    }

    public static function getCateId($cateInfo,$parent_id=1){
        static $c_id=[];
        $c_id[$parent_id]=$parent_id;
        foreach($cateInfo as $k=>$v){
            if($v['parent_id']==$parent_id){
                $c_id[$v['cate_id']]=$v['cate_id'];
                self::getCateId($cateInfo,$v['cate_id']);
            }
        }
        return $c_id;
    }

}
