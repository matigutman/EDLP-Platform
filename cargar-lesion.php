<?php 
  require_once('templates/head.php');
  require_once('classes/players.class.php');
  require_once('classes/medicalTypeControl.class.php');
  require_once('classes/medicalRecords.class.php');
  require_once('classes/status.class.php');

  $players = new players();
  $medicalTypeControl = new medicalTypeControl();
  $medicalRecords = new medicalRecords();

  $playersCollection = $players->get();
  $medicalTypeControl = $medicalTypeControl->get();

  if(isset($_POST['add'])) {
      $player = trim($_POST['player']);
      $category = trim($_POST['category']);
      $type_injuries = trim($_POST['type_injuries']);
      $degree = trim($_POST['degree']);
      $treatment = trim($_POST['treatment']);
      $surface = trim($_POST['surface']);
      $date_injury = trim($_POST['date_injury']);

      $medicalRecords->save($player, $category, $type_injuries, $degree, $treatment, $surface, $date_injury);
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cargar Lesión</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
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
    <label for="inputStatus">Categoria</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Reserva</option>
      <option>Primera</option>
      <option>Cuarta</option>
      <option>Quinta</option>
      <option>Sexta</option>
      <option>Septima</option>
      <option>Octava</option>
      <option>Novena</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputName">Jugador</label>
    <select id="inputStatus" class="form-control custom-select">
      <option>Seleccione opción</option>
      <?php 
        foreach($playersCollection as $player) {
          echo '<option value="'.$player['id'].'">'.$player['name'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Tipo de Lesión</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Ósea</option>
      <option>Articular</option>
      <option>Ligamentaria</option>
      <option>Muscular</option>
      <option>Tendinosa</option>
      <option>Infecciosa</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Región General</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Cabeza</option>
      <option>Cara</option>
      <option>Columna</option>
      <option>Miembro Inferior</option>
      <option>Miembro Superior</option>
      <option>Pelvis</option>
      <option>Tórax</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Región Específica</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Antebrazo</option>
      <option>Brazo</option>
      <option>Cadera</option>
      <option>Cervical</option>
      <option>Codo</option>
      <option>Cóxis</option>
      <option>Esternón</option>
      <option>Hombro</option>
      <option>Lumbar</option>
      <option>Mano</option>
      <option>Muñeca</option>
      <option>Muslo</option>
      <option>Parrilla costal</option>
      <option>Pelvis</option>
      <option>Pie</option>
      <option>Pierna</option>
      <option>Rodilla</option>
      <option>Sacro</option>
      <option>Tobillo</option>
      <option>Torácica</option>
    </select>
  <div class="form-group">
    <label for="inputStatus">Estructura Afectada</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Astrágalo</option>
      <option>Calcaneo</option>
      <option>Clavícula</option>
      <option>Columna Cervical (C1-C7)</option>
      <option>Columna Lumbar (L1-L5) </option>
      <option>Columna Torácica (T1-T12)</option>
      <option>Costilla</option>
      <option>Cóxis</option>
      <option>Cúbito</option>
      <option>Escápula</option>
      <option>Esternón</option>
      <option>Falanges de Pie</option>
      <option>Falanges mano</option>
      <option>Fémur</option>
      <option>Frontal</option>
      <option>Huesos del Carpo</option>
      <option>Huesos Mediopié</option>
      <option>Húmero</option>
      <option>Ilión</option>
      <option>Isquión</option>
      <option>Maciso Facial</option>
      <option>Metacarpianos</option>
      <option>Metatarsianos</option>
      <option>Occipital</option>
      <option>Parietal</option>
      <option>Peroné</option>
      <option>Pubis</option>
      <option>Radio</option>
      <option>Rótula</option>
      <option>Sacro</option>
      <option>Temporal</option>
      <option>Tibia</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Lateralidad</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Derecha</option>
      <option>Izquierda</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Clasificación</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Fractura Abierta</option>
      <option>Fractura Articular</option>
      <option>Fractura Cerrada</option>
      <option>Fractura extra-articular</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Mecanismo</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Abordado</option>
      <option>Abordando</option>
      <option>Bloqueado</option>
      <option>Cabezazo</option>
      <option>Cayendo</option>
      <option>Colisión</option>
      <option>Corriendo/sprint</option>
      <option>Dribbling</option>
      <option>Girando</option>
      <option>Golpeado</option>
      <option>Golpeado por el balón</option>
      <option>Otro mecanismo agudo</option>
      <option>Pasando</option>
      <option>Pateando</option>
      <option>Saltando</option>
      <option>Sobreuso</option>
      <option>Stretching</option>
      <option>Uso de brazo/codo</option>
    </select>
  </div>
  <div class="form-group">
    <label for="inputStatus">Momento del Año</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Período competitivo</option>
      <option>Período precompetitivo</option>
      <option>Post competitivo</option>
    </select>
  </div>
   <div class="form-group">
    <label for="inputStatus">Ocasión</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Entrada en calor de partido</option>
      <option>Entrenamiento</option>
      <option>Gimnasio</option>
      <option>Otro</option>
      <option>Partido</option>
      <option>Partido amistoso</option>
      <option>Selección Nacional</option>
      <option>Tiempo de ocio</option>
    </select>
  </div>
   <div class="form-group">
    <label for="inputStatus">Abordaje</label>
    <select id="inputStatus" class="form-control custom-select">
      <option selected disabled>Seleccione opción</option>
      <option>Quirurgico</option>
      <option>Conservador</option>
    </select>
  </div>
<div class="form-group">
    <label for="inputStatus">Observaciones</label>
    <textarea rows="2" cols="15" placeholder="Observaciones"></textarea>


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
