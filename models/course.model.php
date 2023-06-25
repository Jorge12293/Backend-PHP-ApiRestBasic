<?php 
    require_once "./config/connection.php";
    class ModelCourse {

        static public function listCourses(){
            $stmt = Connection::connect()->prepare("SELECT * FROM courses");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            $stmt->closeCursor();
            return $results;
        }

        static public function findCourseById($idCourse){
            $stmt = Connection::connect()->prepare("SELECT * FROM courses where id = $idCourse");
            $stmt->execute();
            $results = $stmt->fetchAll();
            $stmt->closeCursor();
            return $results;
        }

        static public function createCourse(array $data) {
            $stmt = Connection::connect()->prepare("INSERT INTO courses (
                title, description, instructor, image, price, create_at, update_at, id_user_create
            ) VALUES (
                :title, :description, :instructor, :image, :price, :create_at, :update_at, :id_user_create
            )");

            $stmt->bindParam(":title",$data["title"],PDO::PARAM_STR); 
            $stmt->bindParam(":description",$data["description"],PDO::PARAM_STR); 
            $stmt->bindParam(":instructor",$data["instructor"],PDO::PARAM_STR); 
            $stmt->bindParam(":image",$data["image"],PDO::PARAM_STR); 
            $stmt->bindParam(":price",$data["price"],PDO::PARAM_STR); 
            $stmt->bindParam(":create_at",$data["create_at"],PDO::PARAM_STR); 
            $stmt->bindParam(":update_at",$data["update_at"],PDO::PARAM_STR); 
            $stmt->bindParam(":id_user_create",$data["id_user_create"],PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
               return "Error al ejecutar la consulta: " . implode(" - ", $stmt->errorInfo());
            }
    
        }

    }
?>