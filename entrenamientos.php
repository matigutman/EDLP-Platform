<?php 
  require_once('classes/training.class.php');
  $training = new training();

  if(isset($_GET['delete'])) {
    $delete = (int) $_GET['delete'];

    $training->delete($delete);
    Header('Location: entrenamientos');
  }

  require_once('templates/head.php');
  require_once('classes/categories.class.php');
  require_once('classes/positions.class.php');
  require_once('classes/status.class.php');

  $categories = new categories();
  $positions = new positions();
  $status = new status();

  if(isset($_POST['status'])) {
    $date = trim($_POST['from-date']);


      if($date != '') {
        $date_injury_filter = explode("/", $date);
        $day_date_injury = $date_injury_filter[0];
        $month_date_injury = $date_injury_filter[1];
        $year_date_injury = $date_injury_filter[2];

        $date = $year_date_injury.'-'.$month_date_injury.'-'.$day_date_injury;

      }

    $duration = (int) $_POST['duration'];
    if($training->exist($date)) {
      $training->update($date, $duration);
    } else {
      $training->save($date, $duration);
    }
  } 

  $trainingCollect = $training->get();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Entrenamientos</h1>
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

                            <div class="col-4">
                                  <div class="form-group">
                  <label for="from-date">Fecha</label> Formato: (DD/MM/AAAA)
                  <div class="input-group date" id="from-date" data-target-input="nearest">
                    <input type="text" name="from-date" required class="form-control datetimepicker-input" data-target="#from-date" placeholder="DD/MM/AAAA">
                    <div class="input-group-append" data-target="#from-date" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Duración (minutos)</label>
                                        <input  style="width: 100%;" type="text" name="duration">
                                    </div>
                                </div>    
                                <div class="col-4">
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
                    <th>Fecha</th>
                    <th>Duración</th>
                    <th>Participantes</th>
                    <th style="width: 7%;">Acción</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach ($trainingCollect as $t) { 
                        echo '<tr>
                          <td><a href="detalle-entrenamiento?date='.$t['date'].'">'.utf8_encode($t['date']).'</a></td>
                          <td>'.$t['duration'].'</td>
                          <td>'.$t['cantidad_participantes'].'</td>
                          
                         
                          <td><a href="entrenamientos?delete='.$t['id'].'"><span class="badge badge-danger">Borrar</span></a></td>
                        </tr>';
                      }
                    ?>                  
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th>Fecha</th>
                    <th>Duración</th>
                    <th>Participantes</th>
                    <th style="width: 7%;">Acción</th>
                   </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
      </div>
 <?php require_once('templates/footer.php'); ?>
