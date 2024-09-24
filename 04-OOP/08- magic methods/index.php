<?php

/** __sleep &&  __wakeup  173 */

// class MyData{
//     public $data = [1,2,3,4,5];
//     public $connection = 'data connect from database';
//     public function __sleep()
//     {
//         $this->connection = null;
//         return['data'];
//     }
//     public function __wakeup()
//     {
//         $this->connection = 'wakeup data  from magic methods';
//         return ['data'];
//     }
// }
// $data = new MyData;
// // echo $data->data[0];
// echo $data->connection."<br>";
// //var_dump(serialize($data))."<br>";
// //var_dump(unserialize($data))."<br>";

/** __sleep &&  __wakeup  174 */

// class MyClass{
//     public function __call($name, $arguments)
//     {
//         echo "call method $name with arguments: ".implode(',',$arguments);
//     }

//     public static function __callStatic($name, $arguments)
//     {
//         echo "call method $name with arguments: ".implode(',',$arguments);
//     }

// }
// $obj = new MyClass;
// echo $obj->MyInfo('data','name')."<br>";
// echo $obj::MyData('data','name')."<br>";


/** __get &&  __set  175 */

// class MyClass{
//     //public $name = 'data';
//     public function __get($name)
//     {
//         echo "I donot have ".$name." prop <br>";
//     }

//     public function __set($name, $value){
//         echo $name." = ".$value;
//     }
// }

// $obj = new MyClass;
// echo $obj->name=" Ahmed "."<br>";
// echo $obj->name."<br>";


/** __isset &&  __unset  176 */
// class MyClass{
//     private $names = ['php'=>'v8.3'];
//     public function __isset($prop){
//         return isset($this->names[$prop])?$this->names[$prop]:false;
//     }
//     public function __unset($prop){
//         unset($this->names[$prop]);
//     }
// }
// $obj = new MyClass;
// var_dump( isset($obj->php))."<br>";
// unset($obj->php);
// var_dump( isset($obj->php));

/** __toString &&  __invoke  177 */

// class MyClass{
//     public function __toString(){
//         return "This Class is show some data";
//     }
//     public function __invoke($arg){
//         return "This Class is invoke with arg: ".$arg;
//     }
// }
// $obj = new MyClass;
// echo $obj .'<br>';
// echo $obj('My Information');

/** __clone &&  clone  178 */

// class MyClass
// {
//     public function __construct(    public $name = 'php')
//     {
        
//     }
//     public function info()
//     {
//         return 'information';
//     }
//     public function __clone()
//     {
//          $this->name =   'php';
//     }
// }
// $obj = new MyClass('PHP');
// echo $obj->info() . '<br>';
// $obj->name = 'Zeinab'. '<br>';
// $obj2 = clone $obj;
// // echo $obj2->info() . '<br>';
// echo $obj2->name . '<br>';

/**  __set_state  179 */

class MyClass
{
    public $name;
    public static function __set_state($prop)
    {
        $obj = new MyClass;
        $obj->name = $prop['name']." new value ";
        return $obj;
    }
}
$obj = new MyClass('PHP');
$obj->name = "Ahmed";
echo $obj->name;
$new_obj = var_export($obj,true);
echo'<br>';
eval('$restore='.$new_obj.';');
echo $restore->name . '<br>';