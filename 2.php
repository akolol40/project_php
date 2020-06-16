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

  var_dump($xml);

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

     
            
      foreach ($n->Свойства as $value)
      {
        $name = $n->attributes()->Название;
        foreach ($value as $keys => $np)
        {
         $connect->query("INSERT INTO `a_property` (`Товар`, `Значение`, `Свойства`) VALUES ('{$name}', '{$np}', '{$keys}');");
        }
      }
        
      
  }
  
  

}

//importXml(__DIR__ .'/1.xml');








function exportXml($a, $b)
{
  $file = fopen("2.xml", "w");
  $text_mass = [];

  $xmlstr = file_get_contents($a, 'r') or die("не удалось открыть файл");
  $connect =  new mysqli('localhost','root','root','test_samson','3306');
  if ($connect->connect_errno)
  {
     echo "error";
     exit;
  }



  $xml = new SimpleXMLElement($xmlstr);  

  $result = $connect->query("SELECT * FROM `a_category`");

  $test = $result->fetch_row();

  //var_dump($test);   
  $test = $result->fetch_all();
  //$test[$keys][2]


  $index=0; 
  foreach ($test as $keys => $number)
  {

    if  ($test[$keys][1]===$b)
    {
      $text_mass[$index] = $test[$keys][2];
      $result =  $connect->query("SELECT * FROM `test_samson`.`a_product` WHERE `ид` = {$test[$keys][0]}");
      $val = $result->fetch_row();
      $result = $connect->query("SELECT * FROM `a_ price`");
      $price_list= $result->fetch_all();
      foreach ($price_list as $price => $number)
      {

       if ($price_list[$price][0]===$test[$keys][0])
       {
      //  echo  "<br> Название: ", $val[2], " Цена: ", $price_list[$price][2], " Цена - Тип: ", $price_list[$price][1];
        $text_mass[$index+1] = $val[2]; 
        $text_mass[$index+2] = $price_list[$price][2];
        $text_mass[$index+3] = $price_list[$price][1];

        

        $result = $connect->query("SELECT * FROM `a_property` ORDER BY `Товар` DESC");
        $property_list= $result->fetch_all();
        
        foreach ($property_list as $n => $property)
        {
          if ($property_list[$n][0]===$val[2])
          {
           // echo "<br>" ,$property[2]," ",$property[1];
           $text_mass[$index+4] = $property[2];
           $text_mass[$index+5] = $property[1];
           $text = '<?xml version="1.0" encoding="UTF-8"?>
           <Товары>
             <Товар Код="'.$b.' Название="'.$text_mass[$index+1].'">
               <Цена Тип="'.$text_mass[$index+3].'">'.$text_mass[$index+2].'</Цена>
               <Цена Тип="'.$text_mass[$index+3].'">'.$text_mass[$index+2].'</Цена>
                 <Свойства>
                   <'.$text_mass[$index+4].'>'.$text_mass[$index+5].'</'.$text_mass[$index+4].'>
                   <'.$text_mass[$index+4].'>'.$text_mass[$index+5].'</'.$text_mass[$index+4].'>
               </Свойства>
               <Разделы>
                   <Раздел>'.$text_mass[$index].'</Раздел>
               </Разделы>
             </Товар>      
           <Товары>';
          }
        }
       } 
      }
    }
  }

  fwrite($file, $text);

  fclose($file);
}


exportXml(__DIR__ .'/1.xml',"201");



?>