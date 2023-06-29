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
          <img src="dist/img/user5-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Antropometría</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="cargar-registro-antropometrico" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Nueva visita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="buscar-antropometria" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Buscar
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
          <div class="col-sm-12">
            <h1 style="text-align: center;">Buscador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
          <form action="" method="POST">
              <input type="hidden" name="filter" value="1">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                      <div class="row">

                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Jugadores:</label>
                                        <select class="select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true" name="category">
                                          <option selected="" value="0">Todas</option>
                                          <option  value="1">Santiago Flores</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Categorias:</label>
                                        <select class="select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="subcategory">
                                          <option selected="" value="0">Todas</option>
                                          <option  value="1">Reserva</option>
                                          <option  value="2">4ta</option>
                                          <option  value="3">5ta</option>
                                          <option  value="4">6ta</option>
                                          <option  value="5">7ta</option>
                                          <option  value="6">8va</option>
                                          <option  value="7">9na</option>
                                        </select>
                                       </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Posición:</label>
                                        <select class="select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="subsubcategory">>
                                           <option selected="" value="0">Todas</option>
                                           <option  value="1">Arquero</option>
                                           <option  value="2">Defendor</option>
                                           <option  value="3">Volante</option>
                                           <option  value="4">Delantero</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Estado:</label>
                                        <select class="select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="order">
                                            <option  value="date">Todos</option>
                                            <option  value="relevance">Lesionado</option>
                                            <option  value="relevance">En recuperación</option>
                                            <option  value="relevance">Disponible para jugar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Contenido:</label>
                                            <div class="input-group input-group-lg">
                                                <input type="search" name="content" class="form-control form-control-lg" placeholder="Buscar...">
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="submit" class="btn btn-block btn-primary btn-lg" value="Buscar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Resultados</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Jugador</th>
                    <th>Categoría</th>
                    <th>Posición</th>
                    <th>Estado</th>
                    <th>Registros antropométricos</th>
                  </tr>
                  </thead>
                  <tbody>
  
                  
                  <tr>
                    <td><a href="perfil-jugador-medico">Iñaki Ludueña</a></td>
                    <td>Reserva</td>
                    <td>Arquero</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>16</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Franco Rodríguez</a></td>
                    <td>Reserva</td>
                    <td>Defensor</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>24</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Santiago Flores</a></td>
                    <td>Reserva</td>
                    <td>Defensor</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>9</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Santiago Núñez</a></td>
                    <td>Reserva</td>
                    <td>Defensor</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>7</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Bruno Valdés</a></td>
                    <td>Reserva</td>
                    <td>Defensor</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Franco Romero</a></td>
                    <td>Reserva</td>
                    <td>Volante</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>24</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Deian Verón</a></td>
                    <td>Reserva</td>
                    <td>Volante</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Gonzalo Piñero</a></td>
                    <td>Reserva</td>
                    <td>Volante</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Julián Ascacíbar</a></td>
                    <td>Reserva</td>
                    <td>Volante</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td><a href="perfil-jugador-medico">Aaron Spetale</a></td>
                    <td>Reserva</td>
                    <td>Delantero</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>7</td>
                  </tr>
                <tr>
                    <td><a href="perfil-jugador-medico">Agustín Palavecino</a></td>
                    <td>Reserva</td>
                    <td>Delantero</td>
                    <td><span class="badge badge-success">DISPONIBLE PARA JUGAR</span></td>
                    <td>10</td>
                  </tr></tbody>
                 <tfoot>
                  <tr>
                    <th>Jugador</th>
                    <th>Categoría</th>
                    <th>Posición</th>
                    <th>Estado</th>
                    <th>Registros antropométricos</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>


        </section>
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
