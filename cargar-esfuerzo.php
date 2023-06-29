
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

        <link rel="icon" href="dist/favicon.png">

        <!-- daterange picker -->
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css" >

    </head>
    <body class="hold-transition sidebar-mini">
      <div class="wrapper">
  
<?php 
  require_once('classes/efforts.class.php');
  require_once('classes/players.class.php');

  $efforts = new efforts();
  $players = new players();
  $playersCollection = $players->get();

  if(isset($_GET['player_id'])) {
    $player_id = (int) $_GET['player_id'];
  } else {
    $player_id = 0;
  }

  if(isset($_POST['add'])) {
    $effort = (int) $_POST['effort'];
    $player = (int) $_POST['player'];
    $date_effort = trim($_POST['from-date']);
    
    if($date_effort != '') {
      $date_injury_filter = explode("/", $date_effort);
      $day_date_injury = $date_injury_filter[0];
      $month_date_injury = $date_injury_filter[1];
      $year_date_injury = $date_injury_filter[2];

      $date_effort = $year_date_injury.'-'.$month_date_injury.'-'.$day_date_injury;

    }
    
    $efforts->save($player, $date_effort, $effort);

    Header('Location: gracias-esfuerzo');
  }

  
?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Carga de esfuerzo</h1><br>            
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">


          <div class="card card-secondary">
 <div class="card card-outline card-danger">
        <div class="card-header text-center">
          <a href="#" class="h1">
            <img src="dist/img/EDLP/edlp_logo.png" />
          </a>
        </div>
            <div class="card-body">
              <form method="POST" action="" name="formAlta" enctype="multipart/form-data">
                <input type="hidden" name="add" value="1">
                <div class="form-group">
                  <label for="player">Jugador</label>
                  <select id="inputStatus" name="player" class="form-control custom-select" required>
                    <option selected value="0">Seleccione opción</option>
                    <?php 
                      foreach($playersCollection as $player) {

                        $player['name'] = htmlentities($player['name']);
                        
                        if($player['id'] == $player_id) {
                          echo '<option  value="'.$player['id'].'"  selected="selected">'.utf8_encode($player['name']).'</option>';
                        } else {
                          echo '<option  value="'.$player['id'].'">'.utf8_encode($player['name']).'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="from-date">Fecha esfuerzo</label> Formato: (DD/MM/AAAA)
                  <div class="input-group date" id="from-date" data-target-input="nearest">
                    <input type="text" name="from-date" required class="form-control datetimepicker-input" data-target="#from-date" placeholder="DD/MM/AAAA">
                    <div class="input-group-append" data-target="#from-date" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>


                
                <div class="form-group">
                	<label for="description">Esfuerzo</label>
                	<div class="col-sm-12">
                    <select class="form-control custom-select" name="effort" required>
                      <option value="0">Selecciona una opción </option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
        					</div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <!-- Default box -->
                    <div class="card collapsed collapsed-card">
                      <div class="card-header">
                        <h3 class="card-title">Tabla de referencia de esfuerzo</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body" style="display: block;">
                        <img src="dist/img/PSE.png" style="width: 100%;">
                      </div>
  
                    </div>
                    <!-- /.card -->
                  </div>
                </div>


                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Guardar" id="sendButton" style="width: 100%;" class="btn btn-success">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php require_once('templates/footer.php'); ?>

