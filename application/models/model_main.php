<?

require_once 'application/config/DbConnect.php';
require_once 'application/core/model.php';

class Main_Model extends Model
{
    //добавляет задачу в бд
    public function user_data($name, $email, $task, $name_of_image)
    {      
        DbConnect::connect();
        mysql_query("INSERT INTO Users(name, email, task, name_of_image) VALUES('$name', '$email', '$task', '$name_of_image')") or die(mysql_error());
    }
    public function get_data($page)
    {
       // DbConnect::connect();
        //return mysql_query("SELECT * FROM Users");
        
    }
    
    public function sort_by_name()
    {
        DbConnect::connect();
        return mysql_query("SELECT * FROM `Users` ORDER BY `Users`.`name` DESC");
    }
    public function sort_by_email()
    {
        DbConnect::connect();
        return mysql_query("SELECT * FROM `Users` ORDER BY `Users`.`email` DESC");
    }
}
