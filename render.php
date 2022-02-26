<?php
class test{
    public string $name;
    public string $age;
    public function __construct(string $name,int $age)
    {
        $this->name=$name;
        $this->age=$age;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_age(){
        return $this->age;
    }
}
$test=new test('salman',27);
$var=['data'=>$test];
$data=file_get_contents('data.txt');
function render(string $data,array $var){
    $i=0;
    $pos=array();
    $start=0;
    $end=0;
    $str='';
    while($i<strlen($data)){
        if ($data[$i]=='{'){
            $data[$i]=' ';
            $start=$i;
            $i++;
            while($i<strlen($data)){
                if ($data[$i]!='}'){

                    $end=$i;
                    $str.=$data[$i];
                }
                else{
                    $data[$i]=' ';
                    array_push($pos,[$start,$end,$str]);
                    $str='';
                    $start=0;
                    $end=0;
                    break;
                }
                $i++;
            }
        }
        $i++;
    }
    $j=0;
    foreach ($pos as $p){
        $d=explode(".",$p[2]);
        if (method_exists($var[$d[0]],$d[1])){
            $data=str_replace($d[0].".".$d[1],call_user_func(array($var[$d[0]], $d[1])),$data);
        }
        else{
            $data=str_replace($d[0].".".$d[1],'error',$data);
        }
        $j++;
    }
    return $data;
}
echo render($data,$var);



