<?php 
  require_once('templates/head.php');
  require_once('classes/categories.class.php');
  require_once('classes/medicalHydration.class.php');
  require_once('classes/medicalRecords.class.php');
  require_once('classes/players.class.php');
  require_once('classes/positions.class.php');
  require_once('classes/status.class.php');

  $players = new players();
  $medicalRecords = new medicalRecords();
  $medicalHydration = new medicalHydration();
  $playerListCollection = $players->get();


  if(isset($_POST['player'])) {
    
      $player = (int) $_POST['player'];
      if($player != 0) {
        $type_control = 8;
        $du = trim($_POST['du']);
        $height = trim($_POST['height']);
        $result = trim($_POST['result']);


        $id_user = $_SESSION['id'];
        $description = 'El usuario '.$_SESSION['name'].' ha registro una medición de hidratacion.';

        $medicalRecords->save($player, $type_control, $description, $id_user);

        $id_medical_record = $medicalRecords->getMaxId();

        $medicalHydration->save($id_medical_record, $height, $du, $result);
      } else {
       $message = '<div style="background-color: red; color: white; text-align: center">No se ha cargado el registro porque no se selecciono ningun jugador.</div>';
       echo $message;
      }
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nuevo test de hidratacion</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Detalle</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
               <form action="" method="POST">
               <div class="form-group">
                <label for="inputEstimatedDuration">Jugador</label>
                <select name="player" class="form-control">
                  <option selected="" value="">Seleccione jugador</option>
                  <?php 
                    foreach($playerListCollection as $player) {
                      $player['name'] = htmlentities($player['name']);
                      if(isset($_POST['player'])) {
                          if($_POST['player'] == $player['id']) {
                              echo '<option selected="selected" value="'.$player['id'].'">'.utf8_encode($player['name']).'</option>';
                          } else {
                              echo '<option value="'.$player['id'].'">'.utf8_encode($player['name']).'</option>';  
                              }
                      } else {
                        echo '<option value="'.$player['id'].'">'.utf8_encode($player['name']).'</option>';
                      }
                    }
                  ?>      
                </select>
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Peso</label>
                <input  name="height" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">D. U</label>
                 <input type="text" name="du" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Resultado</label>
                 <select name="result">
                  <option value="Hidratado">Hidratado</option>
                  <option value="Deshidratado">Deshidratado</option>
                  <option value="Sobrehitratado">Sobrehitratado</option>
                  </select>
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
       </form>

    </section>
    <!-- /.content -->
  </div>
 <?php require_once('templates/footer.php'); ?>