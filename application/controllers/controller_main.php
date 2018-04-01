<?
require_once 'application/core/controller.php';

class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Main_Model();
        $this->view = new View();
    }
    
	function action_index()
	{	
        DbConnect::connect();
        $num = 2; 
        // Извлекаем из URL текущую страницу 
         if(!empty($_GET['page'])) $page = $_GET['page'];
            else $page = 0;  
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
        
         
            //$data = $this->model->get_data($page);
		    $this->view->generate('main_view.php', $result, $total, $page);
	}
    
    function action_post()
    {
            $name = $_POST['name'];
            $task = $_POST['task'];
            $email = $_POST['email']; 
            
            if(is_uploaded_file($_FILES["myfile"]["tmp_name"]))
            {
                $filesDir = 'application/images/';
                move_uploaded_file($_FILES["myfile"]["tmp_name"], "$filesDir".$_FILES["myfile"]["name"]) or die('saas');
                $name_of_image = $_FILES["myfile"]["name"];
                $this->model->user_data($name, $email, $task, $name_of_image);
            } 
            
            else $this->model->user_data($name, $email, $task);
            
        header("Location: ../main/");
    }
    
    function action_sortbyname()
    {
        $data = $this->model->sort_by_name();;
        $this->view->generate('main_view.php', $data);
    }
    
     function action_sortbyemail()
    {
        $data =  $this->model->sort_by_email();
        $this->view->generate('main_view.php', $data);
    }
    
    
    
}