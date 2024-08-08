<?php
class AssignmentController
{

    public static function index()
    {
        require_once(__DIR__ . '/../Models/Assignments.php');
        require_once(__DIR__ . '/../Models/Progress.php');

        $assignments = Assignment::All();
        $progressOriginal = Progress::All();
        $progress = [];
        foreach ($progressOriginal as $key => $value) {
            $progress[strval($value['id'])] = $value;
        }
        require_once(__DIR__ . '/../Resources/views/assignment/index.php');
    }
    public static function show()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $valid_id = filter_var($id, FILTER_VALIDATE_INT);


        // Verificar validaciones
        if ($valid_id === false) {
        } else {
            require_once(__DIR__ . '/../Models/Assignments.php');
            require_once(__DIR__ . '/../Models/Progress.php');
            $edit = 0;
            $assignment = Assignment::getById($valid_id);
            if (count($assignment) != 0) {
                $progressOriginal = Progress::All();
                $progress = [];
                foreach ($progressOriginal as $key => $value) {
                    $progress[strval($value['id'])] = $value;
                }
                $assignment = $assignment[0];
                require_once(__DIR__ . '/../Resources/views/assignment/show.php');
            } else {
                header("Location: " . baseurl('/'));
                exit();
            }
        }
    }
    public static function create($error = '')
    {
        require_once(__DIR__ . '/../Resources/views/assignment/create.php');
    }
    public static function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = isset($_POST['title']) ? $_POST['title'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;

            if (empty($title) || empty($description)) {
                header("Location: " . baseurl('/'));
                exit();
            }

            require_once(__DIR__ . '/../Models/Assignments.php');
            $tarea = new Assignment();
            $tarea->title = $title;
            $tarea->description = $description;
            $status = json_decode($tarea->save(), true);

            self::create($status['message']);
        } else {
            header("Location: " . baseurl('/'));
            exit();
        }
    }
    public static function edit($error = "", $id_error = 0)
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $valid_id = filter_var($id, FILTER_VALIDATE_INT);


        // Verificar validaciones
        if ($valid_id === false && $id_error == 0) {
            echo $id_error;
            header("Location: " . baseurl('/'));
            exit();
        } else {
            require_once(__DIR__ . '/../Models/Assignments.php');
            require_once(__DIR__ . '/../Models/Progress.php');
            $edit = 1;
            if ($id_error != 0) {
                $valid_id = $id_error;
            }
            $assignment = Assignment::getById($valid_id);
            if (count($assignment) != 0) {
                $progressOriginal = Progress::All();
                $progress = [];
                foreach ($progressOriginal as $key => $value) {
                    $progress[strval($value['id'])] = $value;
                }
                $assignment = $assignment[0];
                require_once(__DIR__ . '/../Resources/views/assignment/edit.php');
            } else {
                //header("Location: " . baseurl('/'));
                //exit();
            }
        }
    }
    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $title = isset($_POST['title']) ? $_POST['title'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $progress_id = isset($_POST['progress_id']) ? $_POST['progress_id'] : null;

            if (empty($title) || empty($description) || empty($progress_id) || empty($id)) {
                header("Location: " . baseurl('/'));
                exit();
            }

            require_once(__DIR__ . '/../Models/Assignments.php');
            $status = json_decode(Assignment::Update($id, $title, $description, $progress_id), true);
            self::edit($status['message'], $id);
        } else {
            header("Location: " . baseurl('/'));
            exit();
        }
    }
    public static function delete()
    {
        require_once(__DIR__ . '/../Models/Assignments.php');
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $valid_id = filter_var($id, FILTER_VALIDATE_INT);


        // Verificar validaciones
        if ($valid_id === false) {
        } else {
            $assignments = Assignment::Delete($valid_id);
        }
        header("Location: " . baseurl('/'));
        exit();
    }
}
