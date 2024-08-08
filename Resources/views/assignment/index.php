<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FonseCantero</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .ellipsis {
      max-width: 150px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .material-icons {
      vertical-align: middle !important;
    }

    .btn {
      padding: 2px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary d-flex justify-content-between px-5">
    <a class="navbar-brand text-white" href="<?php echo baseurl('/') ?>">Fonsecantero</a>
    <a class="nav-link" href="<?php echo baseurl('/session/logout') ?>"><i class="material-icons" style="color: white;">logout</i></a>

  </nav>
  <section class="vh-80 gradient-custom-2">
    <div class="container py-5 h-100">

      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="col-md-12 col-xl-10">

          <div class="card mask-custom">
            <div class="card-body p-4 text-white">
              <div class="col-12 d-flex justify-content-end">
                <a href="<?php echo baseurl('/assignment/create') ?>" class="btn btn-primary"><i class="material-icons">add</i>CREAR TAREA</a>
              </div>
              <div class="text-center pt-3 pb-2">
                <h2 class="my-4 text-info">To - Do</h2>
              </div>

              <table class="table text-white mb-0">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TITULO</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCIONES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($assignments as $key => $assignment) {
                  ?>
                    <tr class="fw-normal">
                      <th>
                        <span class="ms-2"> <?php echo $assignment['id']; ?></span>
                      </th>
                      <td class="align-middle">
                        <span><?php echo $assignment['title']; ?></span>
                      </td>
                      <td class="align-middle ellipsis">
                        <span><?php echo $assignment['description']; ?></span>
                      </td>
                      <td class="align-middle">
                        <h6 class="mb-0"><span class="badge" style="background-color: <?php echo $progress[$assignment['progress_id']]['color']; ?>;"><?php echo $progress[$assignment['progress_id']]['name']; ?></span></h6>
                      </td>
                      <td class=" align-middle">
                        <a href="<?php echo baseurl('/assignment/show?id=' . $assignment['id']) ?>" class="btn btn-primary"><i class="material-icons">visibility</i></a>
                        <a href="<?php echo baseurl('/assignment/edit?id=' . $assignment['id']) ?>" class="btn btn-primary"><i class="material-icons">edit</i></a>
                        <a href="<?php echo baseurl('/assignment/delete?id=' . $assignment['id']) ?>" class="btn btn-primary"><i class="material-icons">delete</i></a>


                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>


            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>