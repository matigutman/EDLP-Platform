<?php 
  if(isset($_GET['id'])) {
  	$id = (int) $_GET['id'];
  	if($id == 0) {
  		Header('Location: jugadores');
  	}
  }

  require_once('classes/categories.class.php');
  require_once('classes/medicalNutrition.class.php');
  require_once('classes/medicalRecords.class.php');
  require_once('classes/players.class.php');
  require_once('classes/positions.class.php');
  require_once('classes/status.class.php');

  $categories = new categories();
  $positions = new positions();
  $players = new players();
  $status = new status();

  $val = $players->getById($id);

  $categoriesCollection = $categories->get();
  $positionsCollection = $positions->get();
  $statusCollection = $status->get();


  if(isset($_POST['player'])) {

      $player = (int) $_POST['player'];
      if($player != 0) {
        $date_birth = trim($_POST['date_birth']);
        $name = trim($_POST['name']);
        $position = (int) $_POST['position'];
	    $category = (int) $_POST['category'];
        $state = (int) $_POST['state'];


        $players->update($player, $date_birth, $name, $position, $state, $category);

        Header('Location: jugadores-edit?id='.$id);
      } 
    }

    require_once('templates/head.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Jugador</h1>
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
              <input type="hidden" name="player" value="<?php echo $val['id']; ?>">
              <div class="form-group">
                <label for="inputEstimatedDuration">Nombre</label>
                <?php $val['name'] = htmlentities($val['name']); ?>
                <input type="text" value="<?php echo utf8_encode($val['name']); ?>" name="name" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Fecha de nacimiento</label>
                <input type="date" value="<?php echo $val['date_birth']; ?>" name="date_birth" class="form-control">
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Posición</label>
                 <select name="position" class="form-control">
                 	<?php foreach($positionsCollection as $pos) { ?>
                  		<option value="<?php echo $pos['id']; ?>" <?php if($pos['id'] == $val['position']) { echo ' selected="selected" '; } ?>><?php echo utf8_encode($pos['name']); ?></option>
      		       	<?php } ?>
                 </select>
              </div>

             <div class="form-group">
                <label for="inputEstimatedDuration">Categoria</label>
                 <select name="category" class="form-control">
                 	<?php foreach($categoriesCollection as $cat) { ?>
                  		<option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $val['category']) { echo ' selected="selected" '; } ?>><?php echo utf8_encode($cat['name']); ?></option>
      		       	<?php } ?>
                 </select>
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Estado</label>
                 <select name="state" class="form-control">
                 	<?php foreach($statusCollection as $sta) { ?>
                  		<option value="<?php echo $sta['id']; ?>" <?php if($sta['id'] == $val['status']) { echo ' selected="selected" '; } ?>><?php echo utf8_encode($sta['name']); ?></option>
      		       	<?php } ?>
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