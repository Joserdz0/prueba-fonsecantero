<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FonseCantero</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary d-flex justify-content-between px-5">
        <a class="navbar-brand text-white" href="<?php echo baseurl('/') ?>">Fonsecantero</a>
        <a class="nav-link" href="<?php echo baseurl('/session/logout') ?>"><i class="material-icons" style="color: white;">logout</i></a>

    </nav>
    <div id="login">
        <h3 class="text-center text-white pt-5">&nbsp;</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                            <h3 class="text-center text-primary">TAREA <?php echo $valid_id; ?></h3>
                            <div class="form-group">
                                <label for="title" class="text-primary">Titulo:</label><br>
                                <input <?php echo ($edit == 1) ? '' : 'disabled' ?> type="text" name="title" id="title" class="form-control" value="<?php echo $assignment['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="text-primary">Descripcion:</label>
                                <textarea <?php echo ($edit == 1) ? '' : 'disabled' ?> name="description" id="description" rows="3" class="form-control" required><?php echo $assignment['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status" class="text-primary">Estatus:</label>
                                <select class="form-control" id="status" name="status" <?php echo ($edit == 1) ? '' : 'disabled' ?>>

                                    <?php
                                    foreach ($progress as $key => $value) {
                            

                                    ?>
                                        <option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $assignment['progress_id']) ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <?php if ($edit == 1) {
                            ?>
                                <div class="form-group mt-5">
                                    <input type="submit" name="submit" class="btn btn-primary btn-md" value="CREAR">
                                </div>
                            <?php
                            }
                            ?>
                            <div id="register-link" class="text-right">
                                <a href="<?php echo baseurl('/') ?>" class="text-primary"><- Volver a Inicio</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>