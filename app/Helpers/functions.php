<?php 

function PR($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
function VD($obj)
{
	echo '<pre>';
	var_dump($obj);
	echo '</pre>';
}

/**
 * 获取无线级分类列表
 */
function noLimitCategory($array,$pid = 0,$level = 0)
{
    static $arr=array();
    foreach($array as $val){
        if($val['pid'] == $pid){
            $val['level'] = $level;
            $arr[]=$val;
            noLimitCategory($array,$val['id'],$level+1);
        }
    }
    return $arr;
}

function genTree($items,$id='id',$pid='pid',$son = 'child'){
    $tree = array(); //格式化的树
    $tmpMap = array();  //临时扁平数据
     
    foreach ($items as $item) {
        $tmpMap[$item[$id]] = $item;
    }
     
    foreach ($items as $item) {
        if (isset($tmpMap[$item[$pid]])) {
            $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
        } else {
            $tree[] = &$tmpMap[$item[$id]];
        }
    }
    unset($tmpMap);
    return $tree;
}