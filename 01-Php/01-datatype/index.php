<?php
/* Part 1 */
    echo"welcome to php";
    echo "<br>";

    //Data Type (String)
    $a="Welcome To PHP";
    echo $a;
    echo "<br>";

    //Data Type (Integer)
    $b=10;
    echo $b;
    echo "<br>";

    //Data Type (Boolean) => ( true=1 , false=0)
    $c=true;
    echo $c;
    echo "<br>";

    //Data Type (Null)
    $d=null;
    echo $d;
    echo "<br>";

    //Data Type (Float OR Double)
    $e=10.5;
    echo $e;
    echo "<br>";
    echo"<hr>";
?>


<?php
/* Part 2 , Resource concept*/
// Data Type (Array)
//          0       1        2
$f=array("apple","banana","orange");
echo $f[0];
echo "<br>";
// echo $f; //error
$a=10;
$g=["apple","banana",$a,'integer'=>$b,[
    "Zeinab",//0
    "Tanta",//1
    [//2
        "Tanta University",//0
        "main"=>"Value"
    ]
]];
echo $g['integer'];
echo "<br>";
echo $g[3][2][0];
echo "<br>";

//Data Type (Resource Class)
$h= new stdClass;
$h ->name ="PHP";
$h ->age =20;
echo $h->name;
echo "<br>";
echo $h->age;
echo "<br>";
echo $g[3][2]['main'];
echo "<br>";
echo"<hr>";
/*______________________________________________ */
?>
<?php
/*Part 3 */
$a ="PHP";
$b = 20; 
$c = 10.5;
$d = true;
$e = array("apple","banana");
$f = NULL;
$z = new stdClass;
$z->name="Zeinab";
$z->age=20;
echo"<pre>";
var_dump($a,$b,$c,$d,$e,$f,$z);
echo"</pre>";
$h = (bool) "10";
var_dump($h);

?>