<?php
class BinaryNode {

    public $data;
    public $left;
    public $right;

    public function __construct(string $data = NULL) {
        $this->data = $data;
        $this->left = NULL;
        $this->right = NULL;
    }

    /**
     * Adds child nodes
     */
    public function addChildren($left, $right) {
        $this->left = $left;
        $this->right = $right;
    }

}
class BinaryTree {
    private $root = null;

    public function __construct() {
        $this->root = null;
    }

    /**
     * Method to check if the tree is empty
     */
    public function isEmpty() {
        return $this->root === null;
    }

    /**
     * Method to insert elements in to the binary tree
     */
    public function insert($data) {
        $node = new BinaryNode($data);
        if ($this->isEmpty()) { // this is the root node
            $this->root = $node;
            return true;
        } else {
            return $this->insertNode($node, $this->root);
        }
    }

    /**
     * Method to recursively add nodes to the binary tree
     */
    private function insertNode($node, $current) {
        $added = false;
        while($added === false) {
            if ($node->data < $current->data) {
                if($current->left === null) {
                    $current->addChildren($node, $current->right);
                    $added = $node;
                    break;
                } else {
                    $current = $current->left;
                    return $this->insertNode($node, $current);
                }

            }
            elseif ($node->data > $current->data) {
                if($current->right === null) {
                    $current->addChildren($current->left, $node);
                    $added = $node;
                    break;
                } else {
                    $current = $current->right;
                    return $this->insertNode($node, $current);
                }
            } else {
                echo 'its exist';
                break;
            }
        }
        return $added;
    }

    /**
     * Method to retrieve a node from the binary tree
     */
    public function retrieve($node) {
        if ($this->isEmpty()) { // this is the root node
            return false;
        }
        if ($node->data === $this->root->data) {
            return $this->root;
        } else {
            $current = $this->root;
            return $this->retrieveNode($node, $current);
        }
    }

    /**
     * Method to recursively add nodes to a binary tree
     */
    private function retrieveNode($node, $current) {
        $exists = false;
        while($exists === false) {
            if ($node->data < $current->data) {
                if ($current->left === null) {
                    break;
                }
                elseif($node->data == $current->left->data) {
                    $exists = $current->left;
                    break;
                }
                else {
                    $current = $current->left;
                    return $this->retrieveNode($node, $current);
                }

            }
            elseif ($node->data > $current->data) {
                if ($current->right === null) {
                    break;
                }
                elseif($node->data == $current->right->data) {
                    $exists = $current->right;
                    break;
                } else {
                    $current = $current->right;
                    return $this->retrieveNode($node, $current);
                }
            }
        }
        return $exists;
    }

    /**
     * Method to convert the binary tree to an array and print it out
     */
    public function printTree() {

    }

    private function findParent($child, $current) {
        $parent = false;
        while ($parent === false) {
            if ($child->data < $current->data) {
                if ($child->data === $current->left->data) {
                    $parent = $current;
                    break;
                } else {
                    return $this->findParent($child, $current->left);
                    break;
                }
            }
            elseif ($child->data > $current->data) {
                if ($child->data === $current->right->data) {
                    $parent = $current;
                    break;
                } else {
                    return $this->findParent($child, $current->right);
                    break;
                }
            } else {
                break;
            }
        }
        return $parent;
    }



    /**
     * Method to remove an element from the binary tree
     */
    public function removeElement($elem) {
        if ($this->isEmpty()) {
            return false;
        }

        $node = $this->retrieve($elem);

        if (!$node) {
            return false;
        }

        //Case one remove the root
        if ($elem->data === $this->root->data) {
            // find the largest value in the left sub tree
            $current = $this->root->left;
            while($current->right != null) {
                $current = $current->right;
                continue;
            }
            // set this node to be the root
            $current->left = $this->root->left;
            $current->right = $this->root->right;

            $parent = $this->findParent($current, $this->root);
            $parent->right = $current->left;

            $this->root = $current;
            return true;
        }
        // case two we are removing a leaf node
        if ($node->left === null and $node->right === null) {
            $parent = $this->findParent($node, $this->root);
            if ($parent->left->data && $node->data === $parent->left->data) {
                $parent->left = null;
                return true;
            }
            elseif ($parent->right->data && $node->data === $parent->right->data) {
                $parent->right = null;
                return true;

            }
            return $parent;
        }
    }

    public function size() {

    }
}
class jsonDB{
public string $path;
public array $table=[];
public array $keys=[];
public function __construct(string $path='')
{
    if ($path!='' and is_dir(__DIR__.'/'.$path)){
        $this->path=__DIR__.'/'.$path;
    }
    else{
     $this->path=__DIR__;
    }

}
public function insert(string $table,array $data){
    if (file_exists($this->path.'/'.$table.'.'.'json')){
        $dd=file_get_contents($this->path.'/'.$table.'.'.'json');

        $arr=json_decode($dd,true);
        if (isset($arr[$table])){
            $keys=array_keys($arr[$table]['c']);
            if (isset($arr[$table]['data'])){

            }
            else{
                $arr[$table]['data']=[];
            }
            $fields=[];
            foreach ($data as $key=>$value){
               if ( isset($arr[$table]['c'][$key]) and $value!=''){
                   array_push($fields,[$key=>$value]);
               }
               elseif (isset($arr[$table]['c'][$key]) and isset($arr[$table]['c'][$key]['default'])){
                 //  $arr[$table]['data']=[$arr[$table]['c'][$key]['default']];
                   array_push($fields,[$arr[$table]['c'][$key]['default']]);
               }

            }
            array_push($arr[$table]['data'],$fields);
            array_push($this->keys,array_key_last($arr[$table]['data']));
            if (isset($arr[$table]['keys'])){
                $data=unserialize($arr[$table]['keys']);
                $data->insert(array_key_last($arr[$table]['data']));
                $arr[$table]['keys']=serialize($data);
            }
            else{
                $test=new BinaryTree();
                $test->insert(array_key_last($arr[$table]['data']));
                $arr[$table]['keys']=serialize($test);
            }
            file_put_contents($this->path.'/'.$table.'.'.'json',json_encode($arr));

            return 'data added';
        }
        else{
            foreach ($data as $key=>$value){
                if ($value != null){
                    $arr[$table]['c'][$key]=['nullable'=>false,'default'=>$value];
                }
                else{
                    $arr[$table]['c'][$key]=['nullable'=>true];
                }

            }
            file_put_contents($this->path.'/'.$table.'.'.'json',json_encode($arr));
            return 'its done!';
        }
    }
    else{
        $f = fopen($this->path.'/'.$table.'.'.'json', 'wb');
        if ($f){
            return 'created!';
        }
        else{
            return 'error in create!';
        }
    }
}
public function delete(string $table,int $id){
    $dd=file_get_contents($this->path.'/'.$table.'.'.'json');
    $arr=json_decode($dd,true);
    foreach ($this->keys as $key=>$value){
        if ($id == $value){
            unset($arr[$table]['data'][$value]);
            unset($this->keys[$key]);
            file_put_contents($this->path.'/'.$table.'.'.'json',json_encode($arr));
            return 'ok';
        }
    }
    return 'false';
}
public function keys(string $table){
    if (file_exists($this->path.'/'.$table.'.'.'json')) {
        $dd = file_get_contents($this->path . '/' . $table . '.' . 'json');
        $arr = json_decode($dd, true);
        $data = unserialize($arr[$table]['keys']);
        return $data;
    }

    else{
            return 'create keys first!';
    }
}
}
$test=new jsonDB('db_files');
//$test->insert('users',['name'=>'salman','last_name'=>'rajabi']);
//$test->insert('users',['name'=>'salman','last_name'=>'rajabi']);
//$test->insert('users',['name'=>'sajjad','last_name'=>'ahmadi']);
//$test->insert('users',['name'=>'ali','last_name'=>'yazdani']);
//$test->insert('users',['name'=>'mahdi','last_name'=>'naseri']);
//echo $test->delete('users',0);
print_r($test->keys('users'));
//echo "<br>";
//print_r($test->keys);