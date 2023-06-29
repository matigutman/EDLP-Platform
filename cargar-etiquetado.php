<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ESTUDIANTES - APP DATA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <a href="logout">CERRAR SESIÓN</a>
        </a>

      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Etiquetador</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="cargar-etiquetado" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Nuevo
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cargar-etiquetado-import" class="nav-link">
              <i class="nav-icon fa fa-upload"></i>
              <p>
                Importar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cargar Etiquetado</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

               <div class="form-group">
                <label for="inputStatus">Partido</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Estudiantes vs Banfield - Torneo Reserva - 2021</option>
                  <option>Estudiantes vs Talleres - Torneo Reserva - 2021</option>
                  <option>Estudiantes vs Colón - Torneo Reserva - 2021</option>
                  <option>Estudiantes vs Lanús - Torneo Reserva - 2021</option>
                </select>
              </div>

               <div class="form-group">
                <label for="inputStatus">Tiempo</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Seleccione opción</option>
                  <option>Primer Tiempo</option>
                  <option>Segundo tiempo</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputName">Jugador Emisor</label>
                  <select id="inputStatus" class="form-control custom-select">
                  <option> Seleccione opción </option>
                  <option  value="1">Santiago Flores</option>
                  <option  value="1">Iñaki Ludueña</option>
                  <option  value="1">Franco Rodríguez</option>
                  <option  value="1">Bruno Valdés</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputStatus">Jugador Receptor</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Seleccione opción</option>
                  <option  value="1">Santiago Flores</option>
                  <option  value="1">Iñaki Ludueña</option>
                  <option  value="1">Franco Rodríguez</option>
                  <option  value="1">Bruno Valdés</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputStatus">Minuto y segundo</label>
                <input type="time" class="form-control">

              </div>
             
              <div class="form-group">
                <label for="inputStatus">Evento</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Seleccione opción</option>
                  <option>duelo</option>
                  <option>perdida</option>
                  <option>recuperacion</option>
                  <option>pase</option>
                  <option>pelota parada</option>
                  <option>tarjeta</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputStatus">Sub-Evento</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Seleccione opción</option>
                  <option>gambeta a favor</option>
                  <option>inteligente</option>
                  <option>lateral corto</option>
                </select>
              </div>
         
              <div class="form-group">
                <label for="inputStatus">Calificación</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Seleccione opción</option>
                  <option>bueno</option>
                  <option>malo</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputStatus">Coordenadas incial</label>
               <input type="text" name="coordenadas"  class="form-control ">
              </div>
              <div class="form-group">
                <label for="inputStatus">Coordenadas final</label>
               <input type="text" name="coordenadas"  class="form-control ">

              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Guardar" style="width: 100%;" class="btn btn-success">
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>ESTUDIANTES DE LA PLATA</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
