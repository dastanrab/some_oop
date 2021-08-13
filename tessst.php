
<?php
class y {
    public $name;
    public $massage;
    public $x;
public function amessage($massage): x
{
    $this->massage=$massage;
    $this->x=new x($this->name.$this->massage);
    return $this->x;

}
    public function bmessage($massage): x
    {
        $this->massage=$massage;
        $this->x=new x($this->massage.$this->name);
        return $this->x;

    }
public function get()
{

    return $this->name;

}
}
class x extends y  {
    public $name;
    public function __construct($name) {
        $this->name = $name;

    }
}
$test = new x("hassan key maker");
echo $test->bmessage("bye bye ")
    ->amessage(" its time ")
    ->amessage(" to fuck yourself")
    ->get();


