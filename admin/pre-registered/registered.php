<?php 
session_start();
// Include the database connection file
require_once("../../assets/config.php");

// Fetch data in descending order (lastest entry first)
$result = mysqli_query($conn, "SELECT * FROM studentregister ORDER BY id DESC");
$result = mysqli_query($conn, "SELECT * FROM studentregister");

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PRE-REGISTERED</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome 6.7.2 -->
  <link rel="stylesheet" href="../plugins/fontawesome-free-6.7.2/css/all.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="../dist/img/ibicci-logo.png" alt="ibicci-logo Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IBICCI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/ibicci-logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="../dashboard.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-ticket-alt"></i>
                  <p class="px-2">
                    STUDENTS
                    <i class="right fas fa-chevron-circle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a
                      href="../student-module/bsit.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSIT</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/bscs.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSCS</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/bssw.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSSW</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/bscrim.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSCRIM</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/beed.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BEED</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a
                      href="../student-module/bsn.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSN</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/bsm.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSM</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/bsed-math.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSED-MATH</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../student-module/bsed-english.html"
                      class="nav-link text-bold"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSED-ENGLISH</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="../instructor-module/instructor.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>INSTRUCTOR</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../schedule-module/schedule.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-week"></i>
                  <p>SCHEDULES</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="../pre-registered/registered.php" class="nav-link active">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>PRE-REGISTERED</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../notice/notice.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>NOTICE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../public-notice/publicnotice.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>PUBLIC NOTICE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../reports/reports.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>REPORTS</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="../inbox/inbox.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>INBOX</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../logout.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>LOGOUT</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>INCOMING 1ST YEAR COLLEGE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pre-Registered</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Newly Incoming</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Student Type</th>
                    <th style="width: 200px">Student</th>
                    <th>Address</th>
                    <th>Program</th>
                    <th>Previous Track</th>
                    <th>Previous School</th>
                    <th style="width: 60px">Buttons</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                              // Fetch the next row of a result set as an associative array
                              while ($res = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$res['studenttype']."</td>";
                                echo "<td>" . $res['firstname'] . " " . $res['middlename'] . " " . $res['lastname'] . "</td>";
                                echo "<td>".$res['address']."</td>";	
                                echo "<td>".$res['gradecourse']."</td>";
                                echo "<td>".$res['majortrack']."</td>";
                                echo "<td>".$res['lastschoolattend']."</td>";
                                echo "<td><a href=\"approved.php?id=$res[id]\" style=\"width: 100px;\" class=\"btn btn-success btn-sm\">Approved</a>
                                <a href=\"dissaproved.php?id=$res[id]\" style=\"width: 100px;\" class=\"btn btn-danger btn-sm\">Dissaproved</a>
                                <a  href=\"view.php?id=$res[id]\" class=\"btn btn-primary btn-sm\" style=\"width: 98px;\">View Requirements</a> 
                                <a  href=\"parent.php?id=$res[id]\" class=\"btn btn-primary btn-sm\" style=\"width: 98px;\">Parent Information</a>
                                <a href=\"delete.php?id=$res[id]\" class=\"btn btn-danger btn-sm\" style=\"width: 98px;\ onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                                echo "</tr>";
                              }
                              ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Student Type</th>
                    <th>Student</th>
                    <th>Address</th>
                    <th>Program</th>
                    <th>Previous Track </th>
                    <th>Previous School </th>
                    <th style="width: 60px">Buttons</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true, 
    });
  });
</script>
</body>
</html>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>