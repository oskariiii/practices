<?php

function bubbleSort($arr)
{
    $count = count($arr);       //统计出数组的长度
    for ($i = 1; $i < $count; $i++) {       //控制需要排序的轮数，该例子共需要比较10轮
        for ($j = 0; $j < $count - $i; $j++) {  //控制每一轮需要比较的次数，每轮选出最大的一个值放在最后
            if ($arr[$j] > $arr[$j+1]) {
                $temp = $arr[$j];           //通过$temp介质把大的值放在后面
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
    return $arr;       //返回最终结果
}


$arrtest=[12,43,54,33,23,14,44,53,10,3,56]; //测试数组
$res=bubbleSort($arrtest);
var_dump(json_encode($res));
