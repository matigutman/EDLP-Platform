<?php 
  require_once('templates/head.php');
  require_once('classes/categories.class.php');
  require_once('classes/players.class.php');
  require_once('classes/positions.class.php');
  require_once('classes/medicalTypeControl.class.php');
  require_once('classes/medicalRecords.class.php');
  require_once('classes/status.class.php');

  $categories = new categories();
  $players = new players();
  $medicalTypeControl = new medicalTypeControl();
  $medicalRecords = new medicalRecords();

  $categoriesCollection = $categories->get();
  $playersCollection = $players->get();
  $medicalTypeControl = $medicalTypeControl->get();

  if(isset($_POST[''])) {

  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cargar Registro</h1>
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
              <h2>Básicos</h2>

               <div class="form-group">
                <label for="inputEstimatedDuration">Jugador</label>
                <select name="player" class="form-control">
                  <option> Seleccione opción </option>
                  <?php 
                      foreach($playersCollection as $player) {
                        echo '<option  value="'.$player['id'].'">'.utf8_encode($player['name']).'</option>';
                      }
                    ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Peso</label>
                <input type="number" name="weight" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Talla</label>
                 <input type="number" name="height" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Talla sentado</label>
                 <input type="number" name="sitting_carving" class="form-control">
              </div>

               <h2>DIAMETROS </h2>

               <div class="form-group">
                <label for="inputEstimatedDuration">Biacromial</label>
                <input type="number" name="biacromial" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Tórax Transverso</label>
                <input type="number" name="transverse_thorax" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Tórax Anteroposterior</label>
                <input type="number" name="anteroposterior_thorax" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration"></label>
                <input type="number" name="bi_iliocrestide" class="form-control">Bi-iliocrestídeo
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Humeral (biepicondilar)</label>
                <input type="number" name="humeral" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Femoral (biepicondilar)</label>
                <input type="number" name="femoral" class="form-control">
              </div>

               <h2>PERIMETROS </h2>

              <div class="form-group">
                <label for="inputEstimatedDuration">Cabeza</label>
                <input type="number" name="head" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Brazo Relajado</label>
                <input type="number" name="relaxed_arm" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Brazo Flexionado en Tensión</label>
                <input type="number" name="arm_flexed_in_tension" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Antebrazo</label>
                <input type="number" name="forearm" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Tórax Mesoesternal</label>
                <input type="number" name="midsternal_thorax" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Cintura (mínima)</label>
                <input type="number" name="waist" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Caderas (máxima)</label>
                <input type="number" name="hips" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Muslo (superior)</label>
                <input type="number" name="upper_thigh" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Muslo (medial)</label>
                <input type="number" name="thigh_medial" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Pantorrilla (máxima)</label>
                <input type="number" name="max_calf" class="form-control">
              </div>

               <h2>PLIEGUES </h2>
               <div class="form-group">
                <label for="inputEstimatedDuration">Triceps</label>
                <input type="number" name="triceps" class="form-control">
              </div>
               <div class="form-group">
                <label for="inputEstimatedDuration">Subescapular</label>
                <input type="number" name="subscapularis" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Supraespinal</label>
                <input type="number" name="supraspinal" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Abdominal</label>
                <input type="number" name="abdominal" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Muslo (medial)</label>
                <input type="number" name="thigh_medial" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Pantorrilla</label>
                <input type="number" name="calf" class="form-control">
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
 <?php require_once('templates/footer.php'); ?>