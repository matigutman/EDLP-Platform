<?php 
  require_once('classes/players.class.php');
  $players = new players();

  if(isset($_GET['delete'])) {
    $delete = (int) $_GET['delete'];

    $players->delete($delete);
    Header('Location: jugadores');
  }

  require_once('templates/head.php');
  require_once('classes/categories.class.php');
  require_once('classes/positions.class.php');
  require_once('classes/status.class.php');

  $categories = new categories();
  $positions = new positions();
  $status = new status();

  if(isset($_POST['status'])) {

    $player = trim($_POST['player']);
    $category = (int) $_POST['category'];
    $position = (int) $_POST['position'];
    $statusAux = (int) $_POST['status'];
    $date_birth = trim($_POST['date']);

    $players->save($player, $category, $position, $date_birth, $statusAux);
  } 

  $categoriesCollection = $categories->get();
  $positionsCollection = $positions->get();
  $statusCollection = $status->get();
  $playersCollection = $players->get();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Jugadores</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
          <form action="" method="POST">
              <input type="hidden" name="status" value="1">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                      <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jugador:</label><br>
                                    <input type="text" style="width: 100%;" required name="player">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Fecha de nacimiento:</label><br>
                                    <input type="date" style="width: 100%;" required name="date">
                                </div>
                            </div>

                            <div class="col-2">
                                  <div class="form-group">
                                      <label>Categoria:</label>
                                      <select class="select2" required style="width: 100%;" tabindex="-1" aria-hidden="true" name="category">
                                        <option selected="" value="">Todas</option>
                                        <?php 
                                          foreach($categoriesCollection as $category) {
                                              echo '<option value="'.$category['id'].'">'.utf8_encode($category['name']).'</option>';
                                          }
                                        ?>
                                      </select>
                                     </div>
                              </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Posición:</label>
                                        <select class="select2" required style="width: 100%;" tabindex="-1" aria-hidden="true" name="position">
                                           <option selected="" value="">Todas</option>
                                           <?php 
                                              foreach($positionsCollection as $position) {
                                                echo '<option value="'.$position['id'].'">'.utf8_encode($position['name']).'</option>'; 
                                              }
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div>    

                               <div class="col-2">
                                    <div class="form-group">
                                        <label>Estado:</label>
                                        <select class="select2" required style="width: 100%;" tabindex="-1" aria-hidden="true" name="status">
                                           <option selected="" value="">Todas</option>
                                           <?php 
                                              foreach($statusCollection as $sta) {
                                                echo '<option value="'.$sta['id'].'">'.utf8_encode($sta['name']).'</option>'; 
                                              }
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div>                         
                            </div>
                            <div class="row">                      
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="submit" class="btn btn-block btn-primary btn-lg" value="Agregar">
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
                    <th>Nacimiento</th>
                    <th>Categoría</th>
                    <th>Posición</th>
                    <th>Registros</th>
                    <th style="width: 7%;">Editar</th>
                    <th style="width: 7%;">Eliminar</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach ($playersCollection as $player) {
                        $player['name'] = htmlentities($player['name']);
                        $total = $player['count_effort_records'] + $player['count_rutinario_records'] + $player['count_recuperacion_records'] + $player['count_lesion_records'] + $player['count_readaptacion_records'] + $player['count_kinesica_records'] + $player['count_nutricional_records'] + $player['count_hidratacion_records'];
                        echo '<tr>
                          <td><a href="perfil-jugador-medico?id='.$player['id'].'">'.utf8_encode($player['name']).'</a></td>
                          <td>'.$player['date_birth'].'</td>
                          <td>'.$player['category_name'].'</td>
                          <td>'.$player['position_name'].'</td>
                          <td><a href="perfil-jugador-medico?id='.$player['id'].'">'.$total.'</a></td>
                          <td><a href="jugadores-edit?id='.$player['id'].'"><span class="badge badge-warning">Editar</span></a></td>
                          <td><a href="jugadores?delete='.$player['id'].'"><span class="badge badge-danger">Borrar</span></a></td>
                        

                        </tr>'; 
                          }
                        ?>                  
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th>Jugador</th>
                    <th>Nacimiento</th>
                    <th>Categoría</th>
                    <th>Posición</th>
                    <th>Registros</th>
                    <th style="width: 7%;">Editar</th>
                    <th style="width: 7%;">Eliminar</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
      </div>
 <?php require_once('templates/footer.php'); ?>
