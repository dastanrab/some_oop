<?php
class animal{
    public string $name;
    public string $food;
    public string $skin;
    public array $animals=[];
    function get_animal(object $animal){
        if (empty($this->animals)){
            array_push($this->animals,$animal);
            return 'first';
        }
        else{
            $same=[];
            foreach ($this->animals as $anim){
                if ($animal->food==$anim->food){
                    array_push($same,$anim->name);
                }
                if ($animal->skin==$anim->skin){
                    array_push($same,$anim->name);
                }

            }
            if (empty($same)){
                array_push($this->animals,$animal);
                return 'add';
            }

            else{
                return $same;
            }
        }

    }
}

$cat=new animal();
$cat->name='cat';
$cat->food='meat';
$cat->skin='fur';
$bird= new animal();
$bird->name='hen';
$bird->food='seeds';
$bird->skin='wings';
$animal=new animal();
print_r($animal->get_animal($cat));
print_r($animal->get_animal($bird));
print_r($animal->get_animal($cat));
