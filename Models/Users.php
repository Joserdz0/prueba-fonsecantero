<?php
class User
{
    private $id;
    public $name;
    public $password;
    private $status;    
    private $created_at;
    private $updated_at;
    //funcion para guardar usuarios
    public function save()
    {
        require (__DIR__ . '/../database/config.php');

        // Cifrar la contraseña antes de guardarla
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $status = 1;
        try {

            // Insertar los datos en la tabla User
            $sql = "INSERT INTO users (name, password, status) VALUES (:name, :password, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':status', $status);

            // Ejecutar la sentencia
            if ($stmt->execute()) {
                echo "Usuario guardado exitosamente.";
                // Obtener el ID del último usuario insertado
                $this->id = $pdo->lastInsertId();
            } else {
                echo "Error al guardar el usuario.";
            }
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
        $pdo = null;
    }
    public static function createSession($name,$password)
    {
        require (__DIR__ . '/../database/config.php');


        try {


            $sql = 'SELECT * FROM users WHERE name = :name';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $pdo = null;
                if ($user['status'] == 0) {
                    return json_encode(['status' => 0,'message' => 'USUARIO INACTIVO' ]);

                } else {
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['status'] = $user['status'];
                    //usuario activo
                    return json_encode(['status' => 1,'message' => 'USUARIO ACTIVO' ]);
                }
            } else {
                $pdo = null;
                return json_encode(['status' => 0,'message' => 'CONTRASENA Y/O USUARIO INCORRECTO' ]);

            }
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    /*
    public static function getById()
    {
        require (__DIR__ . '/../database/config.php');
        try {
            // ID que quieres buscar
            $id = 123;

            // Preparar la consulta SQL
            $stmt = $pdo->prepare('SELECT * FROM Users WHERE id = :id');
            // Enlazar el valor del ID al marcador de posición :id
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Procesar el resultado
                echo 'Elemento encontrado: ' . print_r($resultado, true);
            } else {
                echo 'No se encontró ningún elemento con ese ID.';
            }
        } catch (PDOException $e) {
            // Manejar errores
            echo "Error: " . $e->getMessage();
        }

        $pdo = null;
    }
    */
}
