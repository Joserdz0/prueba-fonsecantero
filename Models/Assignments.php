<?php
class Assignment
{
    private $id;
    public $title;
    public $description;
    public $user_id;
    public $progress_id;
    private $status;
    private $created_at;
    private $updated_at;
    // Método para verificar si un ID existe en una tabla
    private function existsInTable($table, $id)
    {
        require(__DIR__ . '/../database/config.php');
        $sql = "SELECT COUNT(*) FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function save()
    {
        require(__DIR__ . '/../database/config.php');


        try {
            $user_id = $_SESSION['id'];
            $progress_id = 1;
            $status = 1;
            $sql = "INSERT INTO assignments (title, description, user_id, progress_id, status) 
            VALUES (:title, :description, :user_id, :progress_id, :status)";

            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':progress_id', $progress_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                // Obtener el ID del último tarea insertado
                $this->id = $pdo->lastInsertId();
                $pdo = null;
                return json_encode(['status' => 1,'message' => "TAREA GUARDADA EXITOSAMENTE."]);

            } else {
                $pdo = null;
                return json_encode(['status' => 0,'message' => "ERROR AL GUARDAR LA TAREA."]);
    
            }
        } catch (PDOException $e) {
            $pdo = null;
            return json_encode(['status' => 0,'message' =>  "ERROR EN LA CONEXIÓN: " . $e->getMessage()]);
           
        }
    }
    public static function Update($id,$title,$description,$progress_id)
    {
        require(__DIR__ . '/../database/config.php');
        try {

            $stmt = $pdo->prepare("UPDATE assignments SET title = :title,description = :description,progress_id = :progress_id WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':progress_id', $progress_id, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            if ($stmt->rowCount()) {
                $pdo = null;
                return json_encode(['status' => 0,'message' => "REGISTRO ACTUALIZADO CORRECTAMENTE."]);
            } else {
                $pdo = null;

                return json_encode(['status' => 0,'message' => "NO SE ACTUALIZÓ."]);
            }
        } catch (PDOException $e) {
            return json_encode(['status' => 0,'message' => "Error: " . $e->getMessage()]);
        }

        $pdo = null;
    }
    public static function getById($id)
    {
        require(__DIR__ . '/../database/config.php');
        try {

            $sql = "SELECT * FROM assignments WHERE id = :valor AND status = 1";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':valor', $id, PDO::PARAM_INT);

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            return $resultados;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $pdo = null;
    }
    public static function All()
    {
        require(__DIR__ . '/../database/config.php');
        try {

            $sql = "SELECT * FROM assignments WHERE user_id = :valor AND status = 1";

            $stmt = $pdo->prepare($sql);

            $user_id = $_SESSION['id'];
            $stmt->bindParam(':valor', $user_id, PDO::PARAM_STR);

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            return $resultados;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $pdo = null;
    }
    public static function Delete($id)
    {
        require(__DIR__ . '/../database/config.php');
        try {
            session_start();
            $user_id = $_SESSION['id'];

            $stmt = $pdo->prepare("UPDATE assignments SET status = 0 WHERE id = :id AND user_id = :user_id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            if ($stmt->rowCount()) {
                $pdo = null;
                echo "Registro actualizado correctamente.";
            } else {
                $pdo = null;

                echo "No se encontró el registro o no se pudo actualizar.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $pdo = null;
    }
}
