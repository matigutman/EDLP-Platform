<?php 
  require_once('classes/training.class.php');
  $training = new training();


  if(isset($_GET['date'])) {
    $date = trim($_GET['date']);

    if($date != '') {
      if(isset($_GET['delete'])) {
        $id_delete = (int) $_GET['delete'];
        if($id_delete > 0) {
          $training->deleteEffort($date, $id_delete);
          Header('Location: ?date='.$date);
        }
      }


     $playersCollection = $training->getByDate($date);
    } else {
       Header('Location: entrenamientos'); 
    }
  } else {
    Header('Location: entrenamientos'); 
  }

  require_once('templates/head.php');
  require_once('classes/categories.class.php');
  require_once('classes/positions.class.php');
  require_once('classes/status.class.php');

  $categories = new categories();
  $positions = new positions();
  $status = new status();


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Entrenamiento - <?php echo $date; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <section>

            <div class="card">
              <div class="card-header">
   
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Jugador</th>
                    <th>Puntaje</th>
                    <th>Duracion</th>
                    <th>UA</th>            
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach ($playersCollection as $t) { 
                        $t['name'] = htmlentities($t['name']);
                        echo '<tr>
                          <td><a href="perfil-jugador-medico?id='.$t['player_id'].'">'.utf8_encode($t['name']).'</a></td>
                          <td>'.$t['effort'].'</td>            
                          <td>'.$t['duration'].'</td>';

                          $carga = $t['effort'] * $t['duration'];            
                         echo '<td>'.$carga.'</td>';
                         echo '<td><a href="?date='.$date.'&delete='.$t['effort_id'].'">BORRAR</td>';
                        echo '</tr>';
                      }
                    ?>                  
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th>Jugador</th>
                    <th>Puntaje</th>
                    <th>Duracion</th>
                    <th>UA</th>
                   </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
      </div>
 <?php require_once('templates/footer.php'); ?>
