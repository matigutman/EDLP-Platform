<?php 
  require_once('templates/head.php');
  require_once('classes/access.class.php');

  $access = new access();
  $accesData = $access->get();  

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Buscador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <section>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Accesos al sistema</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Dia</th>
                    <th>Cantidad de accesos</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach ($accesData as $access) {
                        echo '<tr>
                          <td>'.utf8_encode($access['user']).'</td>
                          <td>'.$access['date'].'</td>
                          <td>'.$access['count'].'</td>
                        </tr>';
                      }
                    ?>                  
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th>Usuario</th>
                    <th>Dia</th>
                    <th>Cantidad de accesos</th>
                   </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
      </div>
 <?php require_once('templates/footer.php'); ?>
