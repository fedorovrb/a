<?
require_once 'application/config/DbConnect.php';

class MyPaginationWidget
{
    public static function pagination()
    {
        DbConnect::connect();
        // Переменная хранит число сообщений выводимых на станице 
         $num = 3; 
        // Извлекаем из URL текущую страницу 
        if(isset($_GET['page']))
        {
             $page = $_GET['page'];
        }
        else $page = 1;
        // Определяем общее число сообщений в базе данных 
        $result = mysql_query("SELECT COUNT(*) FROM Users"); 
        $posts =  mysql_fetch_row($result); 
       
        // Находим общее число страниц 
        $total = intval(($posts[0] - 1) / $num) + 1;   
        // Определяем начало сообщений для текущей страницы 
        $page = intval($page); 
        // Если значение $page меньше единицы или отрицательно 
        // переходим на первую страницу 
            // А если слишком большое, то переходим на последнюю 
        if(empty($page) or $page < 0) $page = 1; 
        if($page > $total) $page = $total; 
        // Вычисляем начиная к какого номера 
        // следует выводить сообщения 
        $start = $page * $num - $num; 
        // Выбираем $num сообщений начиная с номера $start 
        $result = mysql_query("SELECT * FROM Users LIMIT $start, $num"); 
        // В цикле переносим результаты запроса в массив $postrow 
        while ( $postrow = mysql_fetch_array($result))       
        {
       
         echo $postrow[0];
         echo $postrow[1];
         echo $postrow[2];
        }
        
       
        
        // Проверяем нужны ли стрелки назад 
        if ($page != 1) $pervpage = '<a href= ?page=1><<</a> 
                               <a href= ?page='. ($page - 1) .'><</a> '; 
        // Проверяем нужны ли стрелки вперед 
        if ($page != $total) $nextpage = ' <a href= ?page='. ($page + 1) .'>></a> 
                                   <a href= ?page=' .$total. '>>></a>'; 

// Находим две ближайшие станицы с обоих краев, если они есть 
if($page - 2 > 0) $page2left = ' <a href= ?page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
if($page - 1 > 0) $page1left = '<a href= ?page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
if($page + 2 <= $total) $page2right = ' | <a href= ?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
if($page + 1 <= $total) $page1right = ' | <a href= ?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню 
echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; 

            
    }
}