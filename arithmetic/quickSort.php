<?php
/**
 * Notes: 快速排序 升序
 * User: Frankie
 * Date: 2019/7/10/0010
 * Time: 11:21
 * @param $arr
 * @return array
 */
function quickSortDesc($arr)
{
    $count = count($arr);   //统计出数组的长度
    if ($count <= 1) { // 如果个数为空或者1，则原样返回数组
        return $arr;
    }
    $index = $arr[0]; // 把第一个元素作为标记
    $left = [];    //定义一个左空数组
    $right = [];    //定义一个有空数组
    for ($i = 1; $i < $count; $i++) {   //从数组的第二数开始与第一个标记元素作比较
        if ($arr[$i] < $index) {        //如果小于第一个标记元素则放进left数组
            $left[] = $arr[$i];
        } else {                        //如果大于第一个标记元素则放进right数组
            $right[] = $arr[$i];
        }
    }
    $left  = quickSortDesc($left);      //把left数组再看成一个新参数，再递归调用，执行以上的排序
    $right = quickSortDesc($right);     //把right数组再看成一个新参数，再递归调用，执行以上的排序
    return array_merge($left, [$arr[0]], $right);   //最后把每一次的左数组、标记元素、右数组拼接成一个新数组
}

$arrtest=[12,43,54,33,23,14,44,53,10,3,56]; //测试数组
$res=quickSortDesc($arrtest);
var_dump(json_encode($res));


/**
 * Notes: 快速排序 降序
 * User: Frankie
 * Date: 2019/7/10/0010
 * Time: 11:21
 * @param $arr
 * @return array
 */
function quickSortAsc($arr)
{
    $count = count($arr);   //统计出数组的长度
    if ($count <= 1) { // 如果个数为空或者1，则原样返回数组
        return $arr;
    }
    $index = $arr[0]; // 把第一个元素作为标记
    $left = [];    //定义一个左空数组
    $right = [];    //定义一个有空数组
    for ($i = 1; $i < $count; $i++) {   //从数组的第二数开始与第一个标记元素作比较
        if ($arr[$i] < $index) {        //如果小于第一个标记元素则放进left数组
            $right[] = $arr[$i];
        } else {                        //如果大于第一个标记元素则放进right数组
            $left[] = $arr[$i];
        }
    }
    $left  = quickSortAsc($left);      //把left数组再看成一个新参数，再递归调用，执行以上的排序
    $right = quickSortAsc($right);     //把right数组再看成一个新参数，再递归调用，执行以上的排序
    return array_merge($left, [$arr[0]], $right);   //最后把每一次的左数组、标记元素、右数组拼接成一个新数组
}

$arrtest=[12,43,54,33,23,14,44,53,10,3,56]; //测试数组
$res=quickSortAsc($arrtest);
var_dump(json_encode($res));