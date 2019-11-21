<?php
function aa(){
    echo 123;
}

function find($find,$parent_id){
    static $info = [];
    foreach($find as $k=>$v){
        if($v['parent_id']==$parent_id){
            $info[] = $v['cate_id'];
            find($find,$v['cate_id']);
        }
    }
    return $info;
}
