<?php 
echo "Задание №1";
function findSimple($a, $b)
{
  $mass = [];
  $k=0; 
  for ($i=$a; $i<$b; $i++)
  {
    if ($i < 2) continue;
    $flag = TRUE;
    for ($j=2; $j<$i-1; $j++)
      if (($i % $j)==0)
      {
        $flag = FALSE;
      break;
      }
      if ($flag) 
      {
        $mass[$k] = $i;
        $k++;
      }
  }
  return $mass;
}


$newmass=findSimple(1,7);

for ($i=0; $i<count($newmass); $i++)
    echo "<br>", $newmass[$i];

echo "<br>==========================";

echo "<br>Задание №2";
echo "<br>";
function createTrapeze($a)
{

 $count = 0;
 $char = array("a","b","c");
 $newarr=[
     ["a" => 0, "b" => 2, "c" => 3],
     ["a" => 1, "b" => 2, "c" => 3]
    ];
 if (count($a)%3 != 0) exit(0);
 foreach ($newarr as $value => &$Keys)
 {
   foreach ($char as $charset)
   {
    $Keys[$charset] = $a[$count];
    $count++;
   }
 }
 return $newarr;
}

$mass=[4,4,1,4,5,6];

$mymass=createTrapeze($mass);

print_r($mymass);
echo "<br>==========================";

echo "<br>Задание №3";
echo "<br>";

function squareTrapeze($a)
{
  $c = ["s"=> 0];
  foreach ($a as $value => &$Keys)
  {
    $Keys = array_merge($Keys,$c);
    $Keys["s"] = ($Keys["a"] + $Keys["b"])*$Keys["c"]/2;

  }
  return $a;
}

$trap = squareTrapeze($mymass);

var_dump($trap);

echo "<br>==========================";

echo "<br>Задание №4";
echo "<br>";

function getSizeForLimit($a, $b)
{
  $temp_arr=[];
  foreach ($a as $value => $Keys)
  {
    if ($Keys["s"] <= $b)
       $temp_arr[$value] = $Keys["s"];
  }
  return $temp_arr;
}

var_dump(getSizeForLimit([['s' => 10], ['s' => 5], ['s' => 2], ['s' => 4]], 3));

echo "<br>==========================";

echo "<br>Задание №5";
echo "<br>";

$mass=["a"=>8,"b"=> 2, "c" => 3, "e" => 4];
function getMin($a)
{
  rsort($a);
  foreach ($a as $value)
    $min = $value;
  return $min;
}

echo getMin($mass);

echo "<br>==========================";

echo "<br>Задание №6";
echo "<br>";

function printTrapeze($a)
{
  echo '<table border="1">';  
  echo "<tr>";
  echo '<th>Размеры'. '</th>';
   foreach ($a as $value){
     if ($value["s"]%2 != 0)
     echo "<td> <strong> {$value["s"]} </strong>"."</td>";
   else  echo "<td> {$value["s"]}"."</td>";

  }
  echo "</tr>";
  echo '</table>';
}

printTrapeze($trap);

echo "<br>==========================";

echo "<br>Задание №7";
echo "<br>";

class BaseMath
{
  public 
    function exp1($a, $b, $c)
    {
      return $a*($b^$c);
    }
    function exp2($a, $b, $c)
    {
      return ($a/$b)^$c;
    }
    function getValue(){
      return 0;
    }
}

class Math extends BaseMath{
  public 
    function getValue()
    {
      echo "Exp1 = ", $this->exp1(1,2,3), "<br>";
      echo "Exp2 = ", $this->exp2(1,2,3);
    }
}

$main = new Math();
$main->getValue();




echo "<br>==========================";

echo "<br>Задание №8";
echo "<br>";

class F1 extends BaseMath
{
   public $f = 0;
   function __construct($a, $b, $c)
   {
     $this->$f = ($this->exp1($a,$b,$c)+(($this->exp2($a,$c,$b))%3)^min($a,$b,$c));
   }
   function getValue() {
    echo $this->$f;
   }
}

$Result = new F1(1,2,3);

$Result->getValue();
