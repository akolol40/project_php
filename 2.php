<?php 
  echo "Задание №1";
  function convertString($a, $b)
  {
    $position = strripos($a,$b);
    $pos_2 = stripos($a,$b);
    if ($position >= 0 && $pos_2 > 0 && $position!= $pos_2) 
    {
      $temp_str = $a;
      for ($i=$pos_2; $i<strlen($b)+$pos_2; $i++)
      {
        $temp_str[$i] = " ";
      }
      $pos_2 = stripos($temp_str,$b);
      $count = 0;
      $b = strrev($b);
      for ($i=$pos_2; $i<strlen($b)+$pos_2; $i++)
      {
        $a[$i] = $b[$count];
        $count++;
      }
    } 
     else echo "<br>Строка либо имеет  < 1 подстроки, либо не имеет {$b}/br>";
    
     return  $a;
  }

  echo "<br>Результат: " , convertString("my name is macalka macalka macalka name name name ", "name");

  echo "<br>==========================";


  echo "<br>Задание №2</br>"; 
  function mySortForKey($a, $b)
  {
    $flag = TRUE;
    $array_index = [];
    foreach ($a as $value => $mp)
     foreach ($mp as $val => $n_keys)
       {
         if ($val !== $b)
         {
           $flag = false;
           $array_index[$value] = $value;
         }
         else
          $flag = TRUE;
       }

       if ($flag)
       {
        foreach ($a as $value => $keys)
        {
         $mass[$value] = $keys[$b];
        }

        asort($mass);
 
        $vs = 0;
        foreach ($mass as $value)
        {
          $a[$vs][$b] = $value;
          $vs++;
        }

        foreach ($a as $massv => &$ksa)
          $ksa = array_filter($ksa);
        
      return $a;
    }
    else 
     throw new Exception(var_dump($array_index));
    }

  try 
  {
    var_export(mySortForKey([['a'=>2,'b'=>1],['a'=>1,'b'=>-1],['a'=>1,'b'=>0],['a'=>2,'ba'=> 0] , ['a'=>2,'ba'=> -1], ['a'=>2,'ba'=> 8]], "ba"));
    echo "<br>";
    var_export(mySortForKey([['a'=>2,'b'=>11],['a'=>1,'b'=>3]], "b"));
    echo "<br>";
    var_export(mySortForKey([['a'=>2,'b'=>1],['a'=>1,'b'=>-1],['a'=>1,'b'=>0],['a'=>2,'ba'=> 0] , ['a'=>2,'ba'=> -1], ['a'=>2,'ba'=> 8]], "test"));
  } catch(Exception $name) {
    echo $name->getMessage();
  }

  echo "<br>==========================";
  echo "<br>Задание №3</br>"; 






function importXml($a)
{
  $xmlstr = file_get_contents($a, 'r') or die("не удалось открыть файл");
  $connect =  new mysqli('localhost','root','root','test_samson','3306');
  if ($connect->connect_errno)
  {
     echo "error";
     exit;
  }

  $xml = new SimpleXMLElement($xmlstr);

  
  
  $count = -1;
  foreach ($xml->Товар->Цена as $n)
    $count++;



  
  foreach ($xml->Товар as $n)
  {
    
    $code = $n->attributes()->Код;
    $name = $n->attributes()->Название;
    
    foreach ($n->Разделы->Раздел as $test)
    {
      $connect->query("INSERT INTO `a_product` (`ид`, `код`, `название`) VALUES (NULL, '{$code}', '{$name}');");
      $id = $connect->insert_id;
      $connect->query("INSERT INTO `a_category` (`ид`, `код`, `название`) VALUES ('{$id}', '{$code}', '{$test}');");
    }



    if ($connect->error) 
     echo $connect->error;
      


      for ($i=0; $i<=$count; $i++)
      {
        $base = $n->Цена[$i]->attributes();
        $coin = (double)$n->Цена[$i];
        $connect->query("INSERT INTO `a_ price` (`Товар`, `Тип`, `Цена`) VALUES ('{$id}', '{$base}', '{$coin}');");    
      }
            
 
  }


}

importXml(__DIR__ .'/1.xml');



?>