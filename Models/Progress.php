<?php
class Progress
{
    private $id;
    public $name;
    public $color;
    private $status;
    private $created_at;
    private $updated_at;
    public static function All()
    {
        require (__DIR__ . '/../database/config.php');
        try {

            $sql = "SELECT * FROM progress";

            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;

            return $resultados;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $pdo = null;
    }
}
