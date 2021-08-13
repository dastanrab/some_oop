<!DOCTYPE html>
<html lang="en">
<body>

<?php
class Fruit extends animal {
    public $name;


    function __construct($name) {
        $this->name = $name;
    }
    function name(){
        return $this->name;

    }


}
class animal {
    public $name;
    public $fruit;
    public $color="red";
  

  function __construct($name) {
      $this->name = $name;
  }
  function name(){
      return $this->name;

  }
  function color(){
      return $this->name;
  }
  function eat(fruit $fruit) {
      $fruit=$fruit->name();
      return $this->fruit=$fruit;
  }
}
$apple = new fruit("Apple");
$sheep = new animal("sheep");
echo $sheep->name();
echo "</br>";
echo $sheep->eat($apple);
echo "</br>";
echo $sheep->color();
echo "</br>";
echo $apple->color();
?>

</body>
</html>
