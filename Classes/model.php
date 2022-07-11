<?php
include_once('db_conn.php');
class DataController extends Dbconn{

    protected function create($query,$array)
    {

        try{
            $insert = $this->connection()->prepare($query);
        
            if($insert->execute($array)){

                return "inserted successful";
        
            }else{

                return "not inserted";
            }
        
        
            }catch(PDOException $e){
        
            return "Insert error message".$e->getMessage();
        
        
            }
        
    }

    protected function read($query,$array)
    {
        try{
            $stmt = $this->connection()->prepare($query);
			$stmt->execute($array);
			$result = $stmt->fetchAll();

			return $result;

        }catch(PDOException $e){

            return "select error message".$e->getMessage();

        }
    }

    protected function readByPagination($page,$dbTable)
    {
        try{

            $perPage = 3;

    // Calculate Total pages
    $stmt = $this->connection()->query("SELECT count(*) FROM $dbTable");
    $total_results = $stmt->fetchColumn();
    $total_pages = ceil($total_results / $perPage);

    // Current page
    $pages = isset($page) ? $page : 1;
    $starting_limit = ($pages - 1) * $perPage;

    // Query to fetch post
    $query = "SELECT * FROM $dbTable ORDER BY id DESC LIMIT $starting_limit,$perPage";

    // Fetch all post for current page
    $post = $this->connection()->query($query)->fetchAll();

    
    $pagination = [

        'total_pages' => $total_pages,
        'page' => $pages,

    ];

    $res = [];
    $res['posts'] = $post;
    $res['paginator'] = $pagination;
    return $res;

        
            
            }catch(PDOException $e){
            
                echo $e->getMessage();
            
            }
            
    }
    protected function readById($id)
    {
        try{
            $sql = "SELECT * FROM post WHERE id = ?";

			$stmt = $this->connection()->prepare($sql);
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();

			return $result;

        }catch(PDOException $e){

            return "select error message".$e->getMessage();

        }
    }
    protected function update()
    {
        
    }

    protected function delete($id)
    {
        try{
            $sql = "DELETE FROM comments WHERE id = ?";

			$stmt = $this->connection()->prepare($sql);
			if($stmt->execute([$id])){
			
                return "deleted";

            }
			

        }catch(PDOException $e){

            return "select error message".$e->getMessage();

        }
    }

}

?>