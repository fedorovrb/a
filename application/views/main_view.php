<?
/*echo "Сортировать по <a href = '/main/sortbyname'>Имени </a><a href = '/main/sortbyemail'> E-mail</a>";
while($row = mysql_fetch_array($data))
{
    echo $row[1].'<br>';
    echo $row[2].'<br>';
    echo $row[3].'<br>';
    if ($row[4] != NULL)
    echo "<img src = 'http://localhost/application/images/".$row[4]."' width = 320 height = 260><br><br>";
}
*/
    ?>
<form enctype = "multipart/form-data" action = "/main/post" method="post">
<input type = "text" name = "name" placeholder = "Имя пользователя"><br><br>
<input type = "text" name = "email" placeholder = "E-mail"><br><br>
<textarea placeholder = "Текст задачи" rows = "10" cols = "40" name = "task"></textarea><br><br>
<input type = "file" name = "myfile"><br><br>
<button>Предварительный <br>просмотр</button>
<input type = "submit" value = "Отправить" >
</form>


<?


while ( $postrow = mysql_fetch_array($result))       
        {
       
         echo $postrow[0];
         echo $postrow[1];
         echo $postrow[2];
        }
        
       
        
        // Проверяем нужны ли стрелки назад 
        if ($page != 1) $pervpage = '<a href= /main/index/?page=1><<</a> 
                               <a href= /main/index/?page='. ($page - 1) .'><</a> '; 
        // Проверяем нужны ли стрелки вперед 
        if ($page != $total) $nextpage = ' <a href= /main/index/?page='. ($page + 1) .'>></a> 
                                   <a href= /main/index/?page=' .$total. '>>></a>'; 

// Находим две ближайшие станицы с обоих краев, если они есть 
if($page - 2 > 0) $page2left = ' <a href= /main/index/?page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
if($page - 1 > 0) $page1left = '<a href= /main/index/?page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
if($page + 2 <= $total) $page2right = ' | <a href= /main/index/?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
if($page + 1 <= $total) $page1right = ' | <a href= /main/index/?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню 
echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; 