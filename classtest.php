<?php
class Model
{
    public $greet;
    public $name;
    function __construct($greet)
    {
        $greet=$greet();
        $this->greet = $greet;
        return $this->greet;
    }
    function set($name){

        $this->name=$name;
        return ($this->greet)($this->name);

    }

}
$greet=function($n)
{
    echo $n;

};


$test = new Model($greet);
echo $test->set('salman rajabi');

?>
