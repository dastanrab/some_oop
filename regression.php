<?php

class regression
{
    public array $x;
    public array $y;
    public $x_sum;
    public $y_sum;
    public $x_avg;
    public $y_avg;
    public $B1;
    public $B0;
    public array $err;
    public function __construct(array $x,array $y)
    {
        if (count($x)==count($y)){
            $this->x=$x;
            $this->y=$y;
            return $this;
        }
        else{
            $this->err='طول ارایه ها باید برابر باشد';
            return $this;
        }
    }
    public function avg(){
        if (!empty($this->y)  or !empty($this->x)){
            for ($i=0;$i<count($this->x);$i++){
                $this->x_sum+=$this->x[$i];
                $this->y_sum+=$this->y[$i];
            }
            $this->x_avg=($this->x_sum/count($this->x));
            $this->y_avg=($this->y_sum/count($this->y));
            return $this;
        }
    }
    public function B1(){
        $sum_s=0;
        $sum_m=0;
        for ($i=0;$i<count($this->x);$i++){
            $sum_m+=(($this->x[$i]-$this->x_avg)*($this->y[$i]-$this->y_avg));
            $sum_s+=(($this->x[$i]-$this->x_avg)*($this->x[$i]-$this->x_avg));
        }
        $this->B1=($sum_s/$sum_m);
        return $this;
    }
    public function B0(){
        $this->B0=($this->y_avg-($this->B1*$this->x_avg));
        return $this;
    }
    public function predict($x){

       return $this->B0+($this->B1*$x);

    }

}
$test=new regression([2,4,6],[3,5,7]);
//y=B0+B1(X)+err
echo $test->avg()->B1()->B0()->predict(8);
