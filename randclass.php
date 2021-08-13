<!DOCTYPE html>
<html>
<body>

<?php
class z {

    public $parent=array();
    public $child=array();


}
class a extends rand {
    public $kid=array();
    public $arr=array();
    function p()
    {
        return $this->kid;

    }
    function kfinder($rr,z $Z){

        foreach ($rr as $key => $value)
        {
            array_push($Z->parent,$key);
            if (gettype($value)=="array") {
                $Z->child=new z;
                array_push($Z->child->parent,"this is parent ".$key);
                $this->kfinder($value, $Z->child  );
            }
        }
         return $Z;
    }
}
class rand  {


    /**
     * @var array
     */

   public $kid;


    function randmaker($j,$a): array
    {
        $arr=array();
        $i=0;
        $e=0;


        while ($e<$a){

            while($i<=$j)
            {
                $rand=rand(10,100);
                $arr[$i]=$rand;
                $i++;
            }
            array_push($this->kid,$arr);
            $i=0;
            $e++;

        }


        return $this->kid;

    }
}
$rates = [
    'Excellent' => 5,
    'Good' => 4,
    'OK' => 3,
    'Bad' => ['benz' => 5,
        'volvo' => ['sos' => 55,
            'yas'=>5],
        'jack' => 3],
    'Very Bad' => 1
];
$x= new a();
$x->randmaker(5,6);
$y=new z;
echo json_encode($x->kfinder($rates,$y));




?>

</body>
</html>
