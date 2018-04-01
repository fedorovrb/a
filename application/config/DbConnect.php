<?
class DbConnect
{
        public static function connect()
        {
                $host = "localhost";
                $user = "root";
                $password = "";
                $database = "test1";
    

           $link = mysql_connect($host, $user, $password) 
            or die("Ошибка " . mysql_error($link));
            
           $db = mysql_select_db($database, $link);
            
           mysql_set_charset("utf-8");
        }
}