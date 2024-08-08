<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FonseCantero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
  <body>
  <div id="login">
        <h3 class="text-center text-white pt-5">&nbsp;</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="<?php echo baseurl('/session/init')?>" method="post">
                            <h3 class="text-center text-primary">INICIAR SESION</h3>
                            <div class="form-group">
                                <label for="name" class="text-primary">Usuario:</label><br>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-primary">Constraseña:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <p class="text-primary"><?php echo $error;?></p>
                            <div class="form-group mt-5">
                                <input type="submit" name="submit" class="btn btn-primary btn-md" value="ENVIAR">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="<?php echo baseurl('/session/create')?>" class="text-primary">Crear cuenta</a>
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