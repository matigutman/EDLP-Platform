<?php 
  if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
  
    if($id > 0) {

        require_once('classes/efforts.class.php');
        require_once('classes/medicalRecords.class.php');
        require_once('classes/players.class.php');


        $efforts = new efforts();
        $medicalRecords = new medicalRecords();
        $players = new players();
        
        $effortsCollect = $efforts->getByPlayer($id);
        $medicalRecordsCollect = $medicalRecords->getByPlayer($id);
        $meditalNutritionCollect = $medicalRecords->getNutritionByPlayer($id);
        $meditalHydrationCollect = $medicalRecords->getHydrationByPlayer($id);

        $player = $players->getById($id);

    } else {
      Header('Location: buscar');
    }
  } else {
    Header('Location: buscar');
  }
  require_once('templates/head.php');

?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil de Jugador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-danger card-outline">
              <div class="card-body box-profile">
                <div class="text-center">

                 <?php if(file_exists("dist/img/EDLP/jugadores/".$player['photo'])) { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/img/EDLP/jugadores/<?php echo $player['photo']; ?>"
                               alt="User profile picture">
                          <?php } else { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/favicon.png"
                               alt="User profile picture">
                          <?php } ?>
                </div>
                <?php $player['name'] = htmlentities($player['name']); ?>
                <h3 class="profile-username text-center"><?php echo utf8_encode($player['name']); ?></h3>
                <p class="text-muted text-center"><?php echo utf8_encode($player['category_name']); ?> - <?php echo utf8_encode($player['position_name']); ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Registros Médicos</b> <a class="float-right"><?php echo count($medicalRecordsCollect); ?></a>
                    <br>
                    <b>Registros Esfuerzo</b> <a class="float-right"><?php echo count($effortsCollect); ?></a>
                    <br>
                    <b>Registros Nutrición</b> <a class="float-right"><?php echo count($meditalNutritionCollect); ?></a>
                    <br>
                    <b>Registros Hidratación</b> <a class="float-right"><?php echo count($meditalHydrationCollect); ?></a>
                    <hr>
                    <b>Registros TOTAL</b> <a class="float-right"><?php echo count($meditalHydrationCollect) + count($medicalRecordsCollect) + count($effortsCollect) + count($meditalNutritionCollect); ?></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <?php foreach ($meditalHydrationCollect as $nutrition) { 

                      $date_array = explode(" ", $nutrition['date_medical']);

                         if(isset($date_array[0])) {
                          $date_datetime = strtotime($date_array[0]);
                          $date_year = date('Y', $date_datetime);
                          $date_month = date('m', $date_datetime);
                          $date_day = date('d', $date_datetime);
                        }

                        $nutrition['name'] = htmlentities($nutrition['name']);
                      ?>
                        <div class="post clearfix">
                        <div class="user-block">
                             <?php if(file_exists("dist/img/EDLP/jugadores/".$player['photo'])) { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/img/EDLP/jugadores/<?php echo $player['photo']; ?>"
                               alt="User profile picture">
                          <?php } else { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/favicon.png"
                               alt="User profile picture">
                          <?php } ?>
                          <span class="username">
                            <a href="#"><?php echo utf8_encode($nutrition['name']); ?></a> 
                            <small class="badge badge-info"><i class="fa-regular fa-bottle-water"></i> Hidratación </small>
                          </span>
                          <span class="description" style="color: red;">
                            <?php echo $nutrition['user_name']; ?> | <?php echo $date_day; ?>/<?php echo $date_month; ?>/<?php echo $date_year; ?> <?php echo $date_array[1]; ?>
                          </span>
                        </div>
                       

       
                        <p>
                          <b>DETALLE DE HIDRATACION</b><br>                
        
                          Altura: <?php echo $nutrition['height']; ?> <br>
                          DU: <?php echo $nutrition['du']; ?> <br>
                          Resultado: <?php echo $nutrition['result']; ?> <br>
                          
                          
                        </p>
                      

                      <?php if(!empty($nutrition['file'])) { ?>
                        <a href="files/<?php echo $nutrition['file']; ?>" target="_blank"> 
                          <i class="fas fa-download"></i> Descargar archivo
                        </a>
                      <?php } ?>
                      </div>
                    <?php } ?>

                    <?php foreach ($meditalNutritionCollect as $nutrition) { 

                       $nutrition['name'] = htmlentities($nutrition['name']);

                      $date_array = explode(" ", $nutrition['date_medical']);

                         if(isset($date_array[0])) {
                          $date_datetime = strtotime($date_array[0]);
                          $date_year = date('Y', $date_datetime);
                          $date_month = date('m', $date_datetime);
                          $date_day = date('d', $date_datetime);
                        }
                      ?>
                        <div class="post clearfix">
                        <div class="user-block">
                             <?php if(file_exists("dist/img/EDLP/jugadores/".$player['photo'])) { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/img/EDLP/jugadores/<?php echo $player['photo']; ?>"
                               alt="User profile picture">
                          <?php } else { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/favicon.png"
                               alt="User profile picture">
                          <?php } ?>
                          <span class="username">
                            <a href="#"><?php echo utf8_encode($nutrition['name']); ?></a> 
                            <small class="badge badge-info"><i class="fa-thin fa-apple-whole"></i> Nutrición </small>
                          </span>
                          <span class="description" style="color: red;">
                            <?php echo $nutrition['user_name']; ?> | <?php echo $date_day; ?>/<?php echo $date_month; ?>/<?php echo $date_year; ?> <?php echo $date_array[1]; ?>
                          </span>
                        </div>
                              
                        <p>
                          <b>DETALLE DE MEDICION</b><br>                
        
                          Peso: <?php echo $nutrition['weight']; ?> <br>
                          Altura: <?php echo $nutrition['height']; ?> <br>
                          ZP: <?php echo $nutrition['zp']; ?> <br>
                          *KG_GR: <?php echo $nutrition['kg_gr']; ?> <br>
                          *KG_MM: <?php echo $nutrition['kg_mm']; ?> <br>
                          *KG_OSEA: <?php echo $nutrition['kg_osea']; ?> <br>
                          *IMO: <?php echo $nutrition['imo']; ?> <br>
                          *OBJETIVO: <?php echo $nutrition['target']; ?> <br>
                          
                          
                        </p>
                      

                      <?php if(!empty($nutrition['file'])) { ?>
                        <a href="files/<?php echo $nutrition['file']; ?>" target="_blank"> 
                          <i class="fas fa-download"></i> Descargar archivo
                        </a>
                      <?php } ?>
                      </div>
                    <?php } ?>
                    <?php 
                      foreach ($effortsCollect as $effort) { 
                        if(isset($effort['date'])) {
                          $date_array = explode(" ", $effort['date']);

                          $date_effort_datetime = strtotime($date_array[0]);
                          $date_effort_year = date('Y', $date_effort_datetime);
                          $date_effort_month = date('m', $date_effort_datetime);
                          $date_effort_day = date('d', $date_effort_datetime);
                        }

                        if(isset($effort['date_effort'])) {
                          $date_array_aux = explode(" ", $effort['date_effort']);

                          $date_effort_datetime_aux = strtotime($date_array_aux[0]);
                          $date_effort_year_aux = date('Y', $date_effort_datetime_aux);
                          $date_effort_month_aux = date('m', $date_effort_datetime_aux);
                          $date_effort_day_aux = date('d', $date_effort_datetime_aux);
                        }

                        $effort['name'] = htmlentities($effort['name']);
                      ?>

                      <!-- Post -->
                      <div class="post clearfix">
                        <div class="user-block">
                          <?php if(file_exists("dist/img/EDLP/jugadores/".$player['photo'])) { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/img/EDLP/jugadores/<?php echo $player['photo']; ?>"
                               alt="User profile picture">
                          <?php } else { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/favicon.png"
                               alt="User profile picture">
                          <?php } ?>
                          <span class="username">
                            <a href="#"><?php echo utf8_encode($effort['name']); ?></a> 
                            <small class="badge badge-secondary">
                              <i class="fas fa-star-of-life"></i> Percepción  de esfuerzo
                            </small>
                          </span>
                          <span class="description" style="color: red;">
                            Cargado por el jugador | <?php echo $date_effort_day; ?>/<?php echo $date_effort_month; ?>/<?php echo $date_effort_year; ?> <?php echo $date_array[1]; ?>
                          </span>
                        </div>
                        <p>
                          <b>DETALLE DEL ESFUERZO</b><br>
                          Fecha esfuerzo: <?php echo $date_effort_day_aux; ?>/<?php echo $date_effort_month_aux; ?>/<?php echo $date_effort_year_aux; ?><br>
                          Esfuerzo: <?php echo $effort['effort']; ?> <br>
                        </p>
                      </div>

                    <?php } ?>
                    <?php foreach ($medicalRecordsCollect as $medicalRecord) { ?>
                      <?php
                        if(isset($medicalRecord['date_injury'])) {
                          $date_injury_datetime = strtotime($medicalRecord['date_injury']);
                          $date_injury_year = date('Y', $date_injury_datetime);
                          $date_injury_month = date('m', $date_injury_datetime);
                          $date_injury_day = date('d', $date_injury_datetime);
                        }

                        $medicalRecord['name'] = htmlentities($medicalRecord['name']);

                        $date_array = explode(" ", $medicalRecord['date_medical']);

                         if(isset($date_array[0])) {
                          $date_datetime = strtotime($date_array[0]);
                          $date_year = date('Y', $date_datetime);
                          $date_month = date('m', $date_datetime);
                          $date_day = date('d', $date_datetime);
                        }
                      ?>
                      <!-- Post -->
                      <div class="post clearfix">
                        <div class="user-block">
                             <?php if(file_exists("dist/img/EDLP/jugadores/".$player['photo'])) { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/img/EDLP/jugadores/<?php echo $player['photo']; ?>"
                               alt="User profile picture">
                          <?php } else { ?>
                            <img class="profile-user-img img-fluid img-circle" src="dist/favicon.png"
                               alt="User profile picture">
                          <?php } ?>
                          <span class="username">
                            <a href="#"><?php echo utf8_encode($medicalRecord['name']); ?></a> 
                            <small class="badge badge-<?php echo utf8_encode($medicalRecord['color_label']); ?>"><i class="fas fa-star-of-life"></i> <?php echo utf8_encode($medicalRecord['type_control_name']); ?></small>
                          </span>
                          <span class="description" style="color: red;">
                            <?php echo $medicalRecord['user_name']; ?> | <?php echo $date_day; ?>/<?php echo $date_month; ?>/<?php echo $date_year; ?> <?php echo $date_array[1]; ?>
                          </span>
                        </div>
                        <p>
                          <b>DESCRIPCIÓN VISITA</b><br>
                          <?php echo $medicalRecord['description']; ?>
                        </p>

       

                      <?php if(isset($medicalRecord['date_injury'])) { ?>
                        <p>
                          <b>DETALLE DE LESIÓN</b><br>                
                          Fecha: <?php echo $date_injury_day; ?>/<?php echo $date_injury_month; ?>/<?php echo $date_injury_year; ?> <br>
                          
                          Abordaje: <?php 
                            if($medicalRecord['approach'] == 1) {
                              echo 'Conservador';
                            } else {
                              echo 'Quirurgico';
                            }
                           ?> <br>

                          Superficie: 
                          <?php 
                            if($medicalRecord['surface'] == 1) {
                              echo 'Cesped';
                            } else {
                              echo 'Sintético';
                            }
                           ?>
                          <br>

                          Tipo de lesión: 
                          <?php 
                            if($medicalRecord['type_injurie_ligamentous'] == 1) {
                              echo 'Ósea';
                            } 
                              
                            if($medicalRecord['type_injurie_ligamentous'] == 2) {
                              echo 'Articular';
                            } 

                            if($medicalRecord['type_injurie_ligamentous'] == 3) {
                              echo 'Ligamentaria';
                            } 

                             if($medicalRecord['type_injurie_ligamentous'] == 4) {
                              echo 'Muscular';
                            } 

                            if($medicalRecord['type_injurie_ligamentous'] == 5) {
                              echo 'Tendinosa';
                            } 

                             if($medicalRecord['type_injurie_ligamentous'] == 6) {
                              echo 'Infecciosa';
                            } 
                            
                           ?> <br> 

                           Región General: 
                           <?php 
                            if($medicalRecord['type_injurie_muscular'] == 1) {
                              echo 'Cabeza';
                            } 
                              
                            if($medicalRecord['type_injurie_muscular'] == 2) {
                              echo 'Cara';
                            } 

                            if($medicalRecord['type_injurie_muscular'] == 3) {
                              echo 'Columna';
                            } 

                             if($medicalRecord['type_injurie_muscular'] == 4) {
                              echo 'Miembro Inferior';
                            } 

                            if($medicalRecord['type_injurie_muscular'] == 5) {
                              echo 'Miembro Superior';
                            } 

                             if($medicalRecord['type_injurie_muscular'] == 6) {
                              echo 'Pélvis';
                            } 

                            if($medicalRecord['type_injurie_muscular'] == 7) {
                              echo 'Tórax';
                            } 
                            
                           ?> <br> 

                           Región Específica:
                           <?php 
                            if($medicalRecord['type_injurie_bone'] == 1) {
                              echo 'Antebrazo';
                            } 
                              
                            if($medicalRecord['type_injurie_bone'] == 2) {
                              echo 'Brazo';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 3) {
                              echo 'Cadera';
                            } 

                             if($medicalRecord['type_injurie_bone'] == 4) {
                              echo 'Cervical';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 5) {
                              echo 'Codo';
                            } 

                             if($medicalRecord['type_injurie_bone'] == 6) {
                              echo 'Cóxis';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 7) {
                              echo 'Esternón';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 8) {
                              echo 'Hombro';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 9) {
                              echo 'Lumbar';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 10) {
                              echo 'Mano';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 11) {
                              echo 'Muñeca';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 12) {
                              echo 'Muslo';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 13) {
                              echo 'Parrilla costal';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 14) {
                              echo 'Pelvis';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 15) {
                              echo 'Pie';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 16) {
                              echo 'Pierna';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 17) {
                              echo 'Rodilla';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 18) {
                              echo 'Sacro';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 19) {
                              echo 'Tobillo';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 20) {
                              echo 'Huesos propios nariz';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 21) {
                              echo 'Témporo-Mandibular';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 22) {
                              echo 'Acromio-Clavicular';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 23) {
                              echo 'Esterno-Clavicular';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 24) {
                              echo 'Gleno-Humeral (Hombro)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 25) {
                              echo 'Húmero-Radial (Cúpula)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 26) {
                              echo 'Húmero-Cubital (Codo)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 27) {
                              echo 'Radio-Cubital Proximal';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 28) {
                              echo 'Radio-Cubital Distal';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 29) {
                              echo 'Radio-Carpiana (Muñeca)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 30) {
                              echo 'Intercarpiana (Carpo)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 31) {
                              echo 'Carpo-Metacarpiana';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 32) {
                              echo 'Metacarpo falángica';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 33) {
                              echo 'Interfalángica F1-F2';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 34) {
                              echo 'Interfalángica F2-F3';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 35) {
                              echo 'Coxo-Femoral';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 36) {
                              echo 'Fémoro-Tibial (Rodilla)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 37) {
                              echo 'Patelo-Femoral (Rótula)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 38) {
                              echo 'Tibio-Peronea Proximal';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 39) {
                              echo 'Tibio-Peronea Distal (Sindesmosis)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 40) {
                              echo 'Tibio-Astragalina (Tobillo)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 41) {
                              echo 'Astrágalo-Calcánea (Subastragalina)';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 42) {
                              echo 'Mediotarsiana';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 43) {
                              echo 'Tarso-Metatarsiana';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 44) {
                              echo 'Metatarso-Falángica';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 45) {
                              echo 'Interfalángica F1-F2';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 46) {
                              echo 'Interfalángica F2-F3';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 47) {
                              echo 'Sacro-Ilíaca';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 48) {
                              echo 'Pubis';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 49) {
                              echo 'Cervical';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 50) {
                              echo 'Torácica';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 51) {
                              echo 'Lumbar';
                            } 

                            if($medicalRecord['type_injurie_bone'] == 52) {
                              echo 'Sacro-Coxígea';
                            } 

                           ?> <br> 

                           Estructura Afectada:
                           <?php 
                            if($medicalRecord['type_injurie_tendinous'] == 1) {
                              echo 'Frontal';
                            } 
                              
                            if($medicalRecord['type_injurie_tendinous'] == 2) {
                              echo 'Parietal';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 3) {
                              echo 'Temporal';
                            } 

                             if($medicalRecord['type_injurie_tendinous'] == 4) {
                              echo 'Occipital';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 5) {
                              echo 'Macizo facial';
                            } 

                             if($medicalRecord['type_injurie_tendinous'] == 6) {
                              echo 'Esternón';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 7) {
                              echo 'Costillas';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 8) {
                              echo 'Clavícula';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 9) {
                              echo 'Escápula';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 10) {
                              echo 'Húmero';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 11) {
                              echo 'Cúbito';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 12) {
                              echo 'Radio';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 13) {
                              echo 'Huesos del Carpo';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 14) {
                              echo 'Metacarpianos';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 15) {
                              echo 'Falanges mano';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 16) {
                              echo 'Fémur';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 17) {
                              echo 'Tibia';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 18) {
                              echo 'Rótula';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 19) {
                              echo 'Peroné';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 20) {
                              echo 'Astrágalo';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 21) {
                              echo 'Calcaneo';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 22) {
                              echo 'Huesos mediopié';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 23) {
                              echo 'Metatarsianos';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 24) {
                              echo 'Falanges de pie';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 25) {
                              echo 'Pubis';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 26) {
                              echo 'Isquión';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 27) {
                              echo 'Ilión';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 28) {
                              echo 'Columna Cervical (C1-C7)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 29) {
                              echo 'Columna Torácica (T1-T12)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 30) {
                              echo 'Columna Lumbar (L1-L5)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 31) {
                              echo 'Sacro';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 32) {
                              echo 'Cóxis';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 33) {
                              echo 'Ligamentaria';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 34) {
                              echo 'Capsular';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 35) {
                              echo 'Labrum';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 36) {
                              echo 'Cartilago';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 37) {
                              echo 'Líquido sinovial';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 38) {
                              echo 'Bursa';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 39) {
                              echo 'Recto anterior (Muslo grupo anterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 40) {
                              echo 'Vasto interno (Muslo grupo anterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 41) {
                              echo 'Vasto externo (Muslo grupo anterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 42) {
                              echo 'Crural (Muslo grupo anterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 43) {
                              echo 'Aductor menor (Muslo grupo interno)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 44) {
                              echo 'Aductor medio (Muslo grupo interno)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 45) {
                              echo 'Aductor mayor (Muslo grupo interno)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 46) {
                              echo 'Recto interno (Muslo grupo internol)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 47) {
                              echo 'Obturador interno (Cadera)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 48) {
                              echo 'Obturador externo (Cadera)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 49) {
                              echo 'Semimembranoso (Muslo grupo posterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 50) {
                              echo 'Semitendinoso (Muslo grupo posterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 51) {
                              echo 'Bíceps crural (Muslo grupo posterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 52) {
                              echo 'Sóleo (Pierna grupo posterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 53) {
                              echo 'Gemelo interno (Pierna grupo posterior)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 54) {
                              echo 'Manguito rotador (Hombro)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 55) {
                              echo 'Biceps braquial (Brazo)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 56) {
                              echo 'Triceps braquial (Brazo)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 57) {
                              echo 'Epicondilitis (Codo)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 58) {
                              echo 'Epitrocleitis (Codo)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 59) {
                              echo 'De Quervain (Muñeca)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 60) {
                              echo 'Extensores (Muñeca)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 61) {
                              echo 'Flexores (Muñeca)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 62) {
                              echo 'Cuadricipital (Rodilla)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 63) {
                              echo 'Rotiliano (Rodilla)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 64) {
                              echo 'Aquileano (Tobillo)';
                            } 

                            if($medicalRecord['type_injurie_tendinous'] == 65) {
                              echo 'Peroneos laterales (Tobillo)';
                            } 

                           ?> <br>

                           Localización:
                           <?php 
                            if($medicalRecord['location'] == 1) {
                              echo 'Unión miotendinosa proximal';
                            } 
                              
                            if($medicalRecord['location'] == 2) {
                              echo 'Séptum central';
                            } 

                            if($medicalRecord['location'] == 3) {
                              echo 'Unión miotendinosa periférica';
                            } 

                             if($medicalRecord['location'] == 4) {
                              echo 'Unión mioaponeurótica superficial';
                            } 

                            if($medicalRecord['location'] == 5) {
                              echo 'Unión mioaponeurótica profunda';
                            } 

                             if($medicalRecord['location'] == 6) {
                              echo 'Unión miotendinosa distal';

                            }

                            if($medicalRecord['location'] == 7) {
                              echo 'Tendón proximal';

                            }

                            if($medicalRecord['location'] == 8) {
                              echo 'Tendón distal';

                            }

                            if($medicalRecord['location'] == 9) {
                              echo 'Unión miotendinosa central sin compromiso del tendon';

                            }

                            if($medicalRecord['location'] == 10) {
                              echo 'Unión miotendinosa central con compromiso del tendon';

                            }

                               ?> <br>

                                Lateralidad:
                           <?php 
                            if($medicalRecord['degree'] == 1) {
                              echo 'Derecha';
                            } 
                              
                            if($medicalRecord['degree'] == 2) {
                              echo 'Izquierda';
                            } 

                            ?> <br>

                             Clasificación:
                           <?php 
                            if($medicalRecord['rating'] == 1) {
                              echo 'Fractura abierta';
                            } 
                              
                            if($medicalRecord['rating'] == 2) {
                              echo 'Fractura articular';
                            } 

                            if($medicalRecord['rating'] == 3) {
                              echo 'Fractura cerrada';
                            } 

                             if($medicalRecord['rating'] == 4) {
                              echo 'Fractura extra-articular';
                            } 

                            if($medicalRecord['rating'] == 5) {
                              echo 'Fractura por stress';
                            } 

                             if($medicalRecord['rating'] == 6) {
                              echo 'Leve';

                            }

                            if($medicalRecord['rating'] == 7) {
                              echo 'Moderada';

                            }

                            if($medicalRecord['rating'] == 8) {
                              echo 'Severa';

                            }

                            if($medicalRecord['rating'] == 9) {
                              echo 'Grado 0';

                            }

                            if($medicalRecord['rating'] == 10) {
                              echo 'Grado 1';

                            }

                            if($medicalRecord['rating'] == 11) {
                              echo 'Grado 2';

                            }

                            if($medicalRecord['rating'] == 12) {
                              echo 'Grado 3';

                            }

                            if($medicalRecord['rating'] == 13) {
                              echo 'Aguda';

                            }

                            if($medicalRecord['rating'] == 14) {
                              echo 'Crónica';

                            }

                               ?> <br>

                                  Mecanismo:
                           <?php 
                            if($medicalRecord['mechanism'] == 1) {
                              echo 'Abordado';
                            } 
                              
                            if($medicalRecord['mechanism'] == 2) {
                              echo 'Abordando';
                            } 

                            if($medicalRecord['mechanism'] == 3) {
                              echo 'Bloqueado';
                            } 

                             if($medicalRecord['mechanism'] == 4) {
                              echo 'Cabezazo';
                            } 

                            if($medicalRecord['mechanism'] == 5) {
                              echo 'Cayendo';
                            } 

                             if($medicalRecord['mechanism'] == 6) {
                              echo 'Colisión';

                            }

                            if($medicalRecord['mechanism'] == 7) {
                              echo 'Corriendo/sprint';

                            }

                            if($medicalRecord['mechanism'] == 8) {
                              echo 'Dribbling';

                            }

                            if($medicalRecord['mechanism'] == 9) {
                              echo 'Girando';

                            }

                            if($medicalRecord['mechanism'] == 10) {
                              echo 'Golpeado';

                            }

                            if($medicalRecord['mechanism'] == 11) {
                              echo 'Golpeado por el balón';

                            }

                            if($medicalRecord['mechanism'] == 12) {
                              echo 'Otro mecanismo agudo';

                            }

                            if($medicalRecord['mechanism'] == 13) {
                              echo 'Pasando';

                            }

                            if($medicalRecord['mechanism'] == 14) {
                              echo 'Pateando';

                            }

                            if($medicalRecord['mechanism'] == 15) {
                              echo 'Saltando';

                            }

                            if($medicalRecord['mechanism'] == 16) {
                              echo 'Sobreuso';

                            }

                            if($medicalRecord['mechanism'] == 17) {
                              echo 'Stretching';

                            }

                            if($medicalRecord['mechanism'] == 18) {
                              echo 'Uso de brazo/codo';

                            }

                               ?> <br>

                               Momento del año:
                           <?php 
                            if($medicalRecord['time_year'] == 1) {
                              echo 'Período competitivo';
                            } 
                              
                            if($medicalRecord['time_year'] == 2) {
                              echo 'Período precompetitivo';
                            } 

                            if($medicalRecord['time_year'] == 3) {
                              echo 'Post competitivo';

                               }

                               ?> <br>

                                Ocasión:
                           <?php 
                            if($medicalRecord['environment'] == 1) {
                              echo 'Entrada en calor de partido';
                            } 
                              
                            if($medicalRecord['environment'] == 2) {
                              echo 'Entrenamiento';
                            } 

                            if($medicalRecord['environment'] == 3) {
                              echo 'Gimnasio';
                            } 

                             if($medicalRecord['environment'] == 4) {
                              echo 'Otro';
                            } 

                            if($medicalRecord['environment'] == 5) {
                              echo 'Partido';
                            } 

                             if($medicalRecord['environment'] == 6) {
                              echo 'Partido amistoso';

                            }

                            if($medicalRecord['environment'] == 7) {
                              echo 'Selección nacional';

                            }

                            if($medicalRecord['environment'] == 8) {
                              echo 'Tiempo de ocio';

                            }

                            ?> <br>

                      <?php if(!empty($medicalRecord['file'])) { ?>
                        <a href="files/<?php echo $medicalRecord['file']; ?>" target="_blank"> 
                          <i class="fas fa-download"></i> Descargar archivo
                        </a>
                      <?php } ?>
                      </div>
                    <?php  } ?>
                  </div>
                </div>
              </div> <!-- /.container-fluid -->
            </div>
          </div>
        </section>
      </div>
 <?php require_once('templates/footer.php'); ?>
 </div>
 <?php } ?>