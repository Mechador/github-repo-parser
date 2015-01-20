<?php

  //Парсер для создания списка всех репозиториев на конкретном хабе на github
  include('simple_html_dom.php'); 
  $arrayWith = array();
  
//Создаем массив, который наполняется полным списком страниц для парсинга.
   for ($i = 1; $i<=16; $i++) {
	$text="https://github.com/coderiver?page=$i";
	array_push($arrayWith, $text);
  }
  
//собственно парсим
foreach($arrayWith as $value) {
	$zn= $value;
    $html = file_get_html($zn);
    //$html = file_get_html($zn, NULL, NULL, NULL, NULL, NULL, NULL, NULL, false);
	//Такая бадяга, помогает когда в HTML есть пустые места или теги с комментариями, которые серьезно стопорят парсер
	foreach($html->find('h3.repo-list-name a') as $element) {
		$element = 'https://github.com/coderiver/' . $element->plaintext .'.zip/archive/master.zip<br>' ; 
		echo str_replace(" ","",$element);
    }
   
}
?>