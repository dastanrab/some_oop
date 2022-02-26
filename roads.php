<?php
$roads=[['start'=>1,'end'=>2],['start'=>2,'end'=>5],['start'=>2,'end'=>3],['start'=>5,'end'=>6],['start'=>1,'end'=>4]];
$start=1;
$end=8;
$path=[];
$i=0;
function find_path($start,$i){
    global $end ,$path,$roads;
    $parent=$i;
    $i=0;
    array_push($path,$start);
    while ($i<count($roads)){
        if ($roads[$i]['start']==$start){
            if ($roads[$i]['end']==$end){
                array_push($path,$end);
                return ['end'=>$path];
               break;
            }
            else{
                $result=find_path($roads[$i]['end'],$i);
                if (isset($result['end'])){
                    return $result;
                    break;
                }
                else{
                    $i=$result['start'];

                }
            }
        }
        $i++;
    }
    unset($roads[$parent]);
    array_pop($path);
    $roads = array_values($roads);
    return ['start'=>0];
}
find_path($start,$i);
if (count($path)>0){
    echo 'road is :';
    echo "<br>";
    echo "<pre>";
    print_r($path);
    echo "</pre>";
}
else {
    echo 'no road exist!!!';
}
