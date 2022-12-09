<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Horas Extra
      </h1>
    </section>
    <!-- Main -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Fecha</th>
                  <th>ID Empleado</th>
                  <th>Nombre</th>
                  <th>No. de Horas</th>
                  <th>Pago/h</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, overtime.id AS otid, employees.employee_id AS empid FROM overtime LEFT JOIN employees ON employees.id=overtime.employee_id ORDER BY date_overtime DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('d M Y', strtotime($row['date_overtime']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['hours']."</td>
                          <td>".$row['rate']."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['otid']."'><i class='fa fa-edit'></i> </button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['otid']."'><i class='fa fa-trash'></i> </button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
                  
  <?php include 'includes/overtime_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'overtime_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      var time = response.hours;
      var split = time.split('.');
      var hour = split[0];
      var min = '.'+split[1];
      min = min * 60;
      console.log(min);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.otid').val(response.otid);
      $('#datepicker_edit').val(response.date_overtime);
      $('#overtime_date').html(response.date_overtime);
      $('#hours_edit').val(hour);
      $('#mins_edit').val(min);
      $('#rate_edit').val(response.rate);
    }
  });
}
</script>
</body>
</html>
