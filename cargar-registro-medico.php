<?php 
  require_once('templates/head.php');
  require_once('classes/categories.class.php');
  require_once('classes/players.class.php');
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

  if(isset($_POST['add'])) {
    $description = trim($_POST['description']);
    $player = (int) $_POST['player'];
    if($player != 0) {
      $typeControl = (int) $_POST['typeControl'];
      $id_user = (int) $_POST['id_user'];

      $medicalRecords->save($player, $typeControl, $description, $id_user);
      $idMedicalRecord = $medicalRecords->getMaxId();

      if($typeControl == 3) { // LESION
        require_once('classes/medicalInjuries.class.php');
        $medicalInjuries = new medicalInjuries();

        $degree = (int) $_POST['degree'];
        $surface = (int) $_POST['surface'];
        $location = (int) $_POST['location'];
        $rating = (int) $_POST['rating'];
        $mechanism = (int) $_POST['mechanism'];
        $time_year = (int) $_POST['time_year'];
        $environment = (int) $_POST['environment'];
        $approach = (int) $_POST['approach'];

        $type_injurie_ligamentous = (int) $_POST['type_injurie_ligamentous'];
        $type_injurie_muscular = (int) $_POST['type_injurie_muscular'];
        $type_injurie_tendinous = (int) $_POST['type_injurie_tendinous'];
        $type_injurie_bone = (int) $_POST['type_injurie_bone'];

        $date_injury = trim($_POST['from-date']);

        $medicalInjuries->save($idMedicalRecord, $type_injurie_ligamentous, $type_injurie_muscular, $type_injurie_tendinous, $type_injurie_bone, $degree, $approach, $surface,  $environment, $time_year, $mechanism, $rating, $location, $date_injury);
      }

        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        if(isset($_SESSION['usuario'])) {
          $newFileName = 'ARCHIVO-JUGADOR-'.$player.'-'.date("Y-m-d H_i_s").'-'.$_SESSION['usuario'].'-'. md5(time()) . '.' . $fileExtension;
        } else {
          $newFileName = 'ARCHIVO-JUGADOR-'.$player.'-'.date("Y-m-d H_i_s").'-GUEST-'. md5(time()) . '.' . $fileExtension;
        }

          $uploadFileDir = 'files/';
          $dest_path = $uploadFileDir . $newFileName;
          if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $medicalRecords->setFile( $idMedicalRecord, $newFileName);
            $message ='File is successfully uploaded.';
          } else {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            echo $message;
            die("");
          }
        
      }


    } else {
      $message = '<div style="background-color: red; color: white; text-align: center">No se ha cargado el registro porque no se selecciono ningun jugador.</div>';
       echo $message;
    }
  }
?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Nueva visita</h1><br>            
          </div>
        </div>
      </div>
    </section>

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
              <form method="POST" action="" name="formAlta" enctype="multipart/form-data">
                <input type="hidden" name="add" value="1">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['user']['id'] ?>">


                <div class="form-group">
                  <label for="category">Categoría</label>
                  <select id="inputCategory" name="category" class="form-control custom-select" required>
                    <option selected value="0">Seleccione opción</option>
                    <?php 
                      foreach($categoriesCollection as $cate) {
                        echo '<option  value="'.$cate['id'].'">'.utf8_encode($cate['name']).'</option>';
                      }
                    ?>
                  </select>
                  <br>
                  <a id="linkPlayerProfile" target="_blank" href="">Ficha de Jugador</a>
                </div>


   
                <div class="form-group">
                  <label for="player">Jugador</label>
                  <select id="inputPlayer" name="player" class="form-control custom-select" required>
                    <option selected value="0">Seleccione categoria</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="typeControl">Tipo de control</label>

                  <input type="hidden" name="">


                  <select id="typeControl" name="typeControl" class="form-control custom-select" required>
                    <option selected disabled>Seleccione opción</option>
                    <?php 
                      foreach($medicalTypeControl as $typeControl) {
                        echo '<option  value="'.$typeControl['id'].'">'.utf8_encode($typeControl['name']).'</option>';
                      }
                    ?>
                  </select>
                </div>

                <div id="lesionData" style="display: none;">
                  
                  <div class="form-group">
                    <label for="type_injurie_ligamentous">Tipo de Lesión</label>
                    <select name="type_injurie_ligamentous" class="custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Ósea</option>
                      <option value="2">Articular</option>
                      <option value="3">Ligamentaria</option>
                      <option value="4">Muscular</option>
                      <option value="5">Tendinosa</option>
                      <option value="6">Infecciosa</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="type_injurie_muscular">Región General</label>
                    <select name="type_injurie_muscular" class="custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Cabeza</option>
                      <option value="2">Cara</option>
                      <option value="3">Columna</option>
                      <option value="4">Miembro Inferior</option>
                      <option value="5">Miembro Superior</option>
                      <option value="6">Pélvis</option>
                      <option value="7">Tórax</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="type_injurie_bone">Región Específica</label>
                    <select name="type_injurie_bone" class="custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Antebrazo</option>
                      <option value="2">Brazo</option>
                      <option value="3">Cadera</option>
                      <option value="4">Cervical</option>
                      <option value="5">Codo</option>
                      <option value="6">Cóxis</option>
                      <option value="7">Esternón</option>
                      <option value="8">Hombro</option>
                      <option value="9">Lumbar</option>
                      <option value="10">Mano</option>
                      <option value="11">Muñeca</option>
                      <option value="12">Muslo</option>
                      <option value="13">Parrilla costal</option>
                      <option value="14">Pelvis</option>
                      <option value="15">Pie</option>
                      <option value="16">Pierna</option>
                      <option value="17">Rodilla</option>
                      <option value="18">Sacro</option>
                      <option value="19">Tobillo</option>
                      <option value="20">Huesos propios nariz</option>
                      <option value="21">Témporo-Mandibular</option>
                      <option value="22">Acromio-Clavicular</option>
                      <option value="23">Esterno-Clavicular</option>
                      <option value="24">Gleno-Humeral (Hombro)</option>
                      <option value="25">Húmero-Radial (Cúpula)</option>
                      <option value="26">Húmero-Cubital (Codo)</option>
                      <option value="27">Radio-Cubital Proximal</option>
                      <option value="28">Radio-Cubital Distal</option>
                      <option value="29">Radio-Carpiana (Muñeca)</option>
                      <option value="30">Intercarpiana (Carpo)</option>
                      <option value="31">Carpo-Metacarpiana</option>
                      <option value="32">Metacarpo falángica</option>
                      <option value="33">Interfalángica F1-F2</option>
                      <option value="34">Interfalángica F2-F3</option>
                      <option value="35">Coxo-Femoral</option>
                      <option value="36">Fémoro-Tibial (Rodilla)</option>
                      <option value="37">Patelo-Femoral (Rótula)</option>
                      <option value="38">Tibio-Peronea Proximal</option>
                      <option value="39">Tibio-Peronea Distal (Sindesmosis)</option>
                      <option value="40">Tibio-Astragalina (Tobillo)</option>
                      <option value="41">Astrágalo-Calcánea (Subastragalina)</option>
                      <option value="42">Mediotarsiana</option>
                      <option value="43">Tarso-Metatarsiana</option>
                      <option value="44">Metatarso-Falángica</option>
                      <option value="45">Interfalángica F1-F2</option>
                      <option value="46">Interfalángica F2-F3</option>
                      <option value="47">Sacro-Ilíaca</option>
                      <option value="48">Pubis</option>
                      <option value="49">Cervical</option>
                      <option value="50">Torácica</option>
                      <option value="51">Lumbar</option>
                      <option value="52">Sacro-Coxígea</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="type_injurie_tendinous">Estructura Afectada</label>
                    <select name="type_injurie_tendinous" class="custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Frontal</option>
                      <option value="2">Parietal</option>
                      <option value="3">Temporal</option>
                      <option value="4">Occipital</option>
                      <option value="5">Macizo facial</option>
                      <option value="6">Esternón</option>
                      <option value="7">Costillas</option>
                      <option value="8">Clavícula</option>
                      <option value="9">Escápula</option>
                      <option value="10">Húmero</option>
                      <option value="11">Cúbito</option>
                      <option value="12">Radio</option>
                      <option value="13">Huesos del Carpo</option>
                      <option value="14">Metacarpianos</option>
                      <option value="15">Falanges mano</option>
                      <option value="16">Fémur</option>
                      <option value="17">Tibia</option>
                      <option value="18">Rótula</option>
                      <option value="19">Peroné</option>
                      <option value="20">Astrágalo</option>
                      <option value="21">Calcaneo</option>
                      <option value="22">Huesos mediopié</option>
                      <option value="23">Metatarsianos</option>
                      <option value="24">Falanges de pie</option>
                      <option value="25">Pubis</option>
                      <option value="26">Isquión</option>
                      <option value="27">Ilión</option>
                      <option value="28">Columna Cervical (C1-C7)</option>
                      <option value="29">Columna Torácica (T1-T12)</option>
                      <option value="30">Columna Lumbar (L1-L5)</option>
                      <option value="31">Sacro</option>
                      <option value="32">Cóxis</option>
                      <option value="33">Ligamentaria</option>
                      <option value="34">Capsular</option>
                      <option value="35">Labrum</option>
                      <option value="36">Cartilago</option>
                      <option value="37">Líquido sinovial</option>
                      <option value="38">Bursa</option>
                      <option value="39">Recto anterior (Muslo grupo anterior)</option>
                      <option value="40">Vasto interno (Muslo grupo anterior)</option>
                      <option value="41">Vasto externo (Muslo grupo anterior)</option>
                      <option value="42">Crural (Muslo grupo anterior)</option>
                      <option value="43">Aductor menor (Muslo grupo interno)</option>
                      <option value="44">Aductor medio (Muslo grupo interno)</option>
                      <option value="45">Aductor mayor (Muslo grupo interno)</option>
                      <option value="46">Recto interno (Muslo grupo internol)</option>
                      <option value="47">Obturador interno (Cadera)</option>
                      <option value="48">Obturador externo (Cadera)</option>
                      <option value="49">Semimembranoso (Muslo grupo posterior)</option>
                      <option value="50">Semitendinoso (Muslo grupo posterior)</option>
                      <option value="51">Bíceps crural (Muslo grupo posterior)</option>
                      <option value="52">Sóleo (Pierna grupo posterior)</option>
                      <option value="53">Gemelo interno (Pierna grupo posterior)</option>
                      <option value="54">Manguito rotador (Hombro)</option>
                      <option value="55">Biceps braquial (Brazo)</option>
                      <option value="56">Triceps braquial (Brazo)</option>
                      <option value="57">Epicondilitis (Codo)</option>
                      <option value="58">Epitrocleitis (Codo)</option>
                      <option value="59">De Quervain (Muñeca)</option>
                      <option value="60">Extensores (Muñeca)</option>
                      <option value="61">Flexores (Muñeca)</option>
                      <option value="62">Cuadricipital (Rodilla)</option>
                      <option value="63">Rotiliano (Rodilla)</option>
                      <option value="64">Aquileano (Tobillo)</option>
                      <option value="65">Peroneos laterales (Tobillo)</option>
                      
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="location">Localización</label>
                    <select name="location" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Unión miotendinosa proximal</option>
                      <option value="2">Séptum central</option>
                      <option value="3">Unión miotendinosa periférica</option>
                      <option value="4">Unión mioaponeurótica superficial</option>
                      <option value="5">Unión mioaponeurótica profunda</option>
                      <option value="6">Unión miotendinosa distal</option>
                      <option value="7">Tendón proximal</option>
                      <option value="8">Tendón distal</option>
                      <option value="9">Unión miotendinosa central sin compromiso del tendon</option>
                      <option value="10">Unión miotendinosa central con compromiso del tendon</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="degree">Lateralidad</label>
                    <select name="degree" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Derecha</option>
                      <option value="2">Izquierda</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="rating">Clasificación</label>
                    <select name="rating" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Fractura abierta</option>
                      <option value="2">Fractura articular</option>
                      <option value="3">Fractura cerrada</option>
                      <option value="4">Fractura extra-articular</option>
                      <option value="5">Fractura por stress</option>
                      <option value="6">Leve</option>
                      <option value="7">Moderada</option>
                      <option value="8">Severa</option>
                      <option value="9">Grado 0</option>
                      <option value="10">Grado 1</option>
                      <option value="11">Grado 2</option>
                      <option value="12">Grado 3</option>
                      <option value="13">Aguda</option>
                      <option value="14">Crónica</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="mechanism">Mecanismo</label>
                    <select name="mechanism" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Abordado</option>
                      <option value="2">Abordando</option>
                      <option value="3">Bloqueado</option>
                      <option value="4">Cabezazo</option>
                      <option value="5">Cayendo</option>
                      <option value="6">Colisión</option>
                      <option value="7">Corriendo/sprint</option>
                      <option value="8">Dribbling</option>
                      <option value="9">Girando</option>
                      <option value="10">Golpeado</option>
                      <option value="11">Golpeado por el balón</option>
                      <option value="12">Otro mecanismo agudo</option>
                      <option value="13">Pasando</option>
                      <option value="14">Pateando</option>
                      <option value="15">Saltando</option>
                      <option value="16">Sobreuso</option>
                      <option value="17">Stretching</option>
                      <option value="18">Uso de brazo/codo</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="time_year">Momento del Año</label>
                    <select name="time_year" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Período competitivo</option>
                      <option value="2">Período precompetitivo</option>
                      <option value="3">Post competitivo</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="environment">Ocasión</label>
                    <select name="environment" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Entrada en calor de partido</option>
                      <option value="2">Entrenamiento</option>
                      <option value="3">Gimnasio</option>
                      <option value="4">Otro</option>
                      <option value="5">Partido</option>
                      <option value="6">Partido amistoso</option>
                      <option value="7">Selección nacional</option>
                      <option value="8">Tiempo de ocio</option>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="surface">Superficie</label>
                    <select name="surface" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Cesped</option>
                      <option value="2">Sintético</option>
                    </select>
                  </div>
  
                   <div class="form-group">
                    <label for="approach">Abordaje</label>
                    <select name="approach" class="form-control custom-select">
                      <option value="0" selected>Seleccione opción</option>
                      <option value="1">Conservador</option>
                      <option value="2">Quirúrgico</option>
                    </select>
                  </div>

                <div class="form-group">
  <label for="from-date">Fecha de Lesión</label> Formato: (DD/MM/AAAA)
  <div class="input-group">
    <input type="date" name="from-date" required class="form-control" placeholder="DD/MM/AAAA">
    <div class="input-group-append">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="to-date">Fecha de Alta Estimada</label> Formato: (DD/MM/AAAA)
  <div class="input-group date" id="to-date" data-target-input="nearest">
    <input type="date" name="to-date" required class="form-control" data-target="#to-date" placeholder="DD/MM/AAAA" min="<?php echo date('Y-m-d'); ?>">
    <div class="input-group-append" data-target="#to-date" data-toggle="datetimepicker">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</div>


                <div class="form-group">
                    <label for="uploadedFile">Archivo</label>
                    <input type="file" name="uploadedFile" class="form-control custom-select" />
                  </div>

                <div class="form-group">
                  <label for="description">Observación</label>
                  <textarea class="form-control" name="description" required></textarea>
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

  <script type="text/javascript">
  
  $( document ).ready(function() {

    $('#inputCategory').on('change', function(event){
        event.preventDefault();
        var categoryFilter = $(this).val();

        $.ajax({
            url : 'ajax.php',
            type : 'POST',
            data : {
                    categoryFilter : categoryFilter,
                    action: 'CargarJugadoresPorCategoria'
                },
            success : function(show){
              $('#inputPlayer').html(show);
            }
        });                 
    });

   $('#inputPlayer').change(function() {
      var id = $(this).val();
      var name = $(this).text();
      $('#linkPlayerProfile').attr('href', 'perfil-jugador-medico?id='+id); 
      $('#linkPlayerProfile').attr('href', 'perfil-jugador-medico?id='+id); 
    });

    $(function () {
      //Date picker
        $('#date_injury').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    });

    $( "#typeControl" ).change(function() {
      var dato = $(this).val();
      if(dato == 3) { //LESION
        $("#lesionData").fadeIn();
      } else {
        $("#lesionData").fadeOut();
      }
    });

    $( "#sendButton" ).click(function() { 
      document.formAlta.submit();
    });

  });
   
</script>