<?php 
session_start();
include '../assets/config.php'; 

// Total students
$res_students = mysqli_query($conn, "SELECT COUNT(*) AS total FROM student");
$totalStudents = mysqli_fetch_assoc($res_students)['total'];

// Total instructors
 $res_instructors = mysqli_query($conn, "SELECT COUNT(*) AS total FROM studentregister");
 $totalInstructors = mysqli_fetch_assoc($res_instructors)['total'];

// Total notices
 $res_notice = mysqli_query($conn, "SELECT COUNT(*) AS total FROM notice");
 $totalnotice = mysqli_fetch_assoc($res_notice)['total'];

// Total pre-registered
 $res_messages = mysqli_query($conn, "SELECT COUNT(*) AS total FROM messages");
 $totalmessages = mysqli_fetch_assoc($res_messages)['total'];

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IBICCI COLLEGE MS</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <!-- Font Awesome 6.7.2 -->
    <link rel="stylesheet" href="plugins/fontawesome-free-6.7.2/css/all.min.css" />
    <!-- Ionicons -->
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <!-- Tempusdominus Bootstrap 4 -->
    <link
      rel="stylesheet"
      href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
    />
    <!-- iCheck -->
    <link
      rel="stylesheet"
      href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link
      rel="stylesheet"
      href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
    />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css" />

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />

    <link rel="stylesheet" href="style.css" />
  </head>
 
  <body
    class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"
  >
    <div class="wrapper">
      <!-- Preloader -->
      <div
        class="preloader flex-column justify-content-center align-items-center"
      >
        <img
          class="animation__shake"
          src="dist/img/ibicci-logo.png"
          alt="AdminLTELogo"
          height="460"
          width="460"
        />
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="navbar-search"
              href="#"
              role="button"
            >
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input
                    class="form-control form-control-navbar"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button
                      class="btn btn-navbar"
                      type="button"
                      data-widget="navbar-search"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>

          <!-- Messages Dropdown Menu -->
         
          <!-- Notifications Dropdown Menu -->
         
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="control-sidebar"
              data-controlsidebar-slide="true"
              href="#"
              role="button"
            >
              <i class="fas fa-th-large"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard.php" class="brand-link">
          <img
            src="dist/img/ibicci-logo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />
          <span class="brand-text font-weight-light">IBICCI</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="./dist/img/ibicci-logo.png"
                class="img-circle elevation-2"
                alt="User Image"
              />
            </div>
            <div class="info">
              <a href="change_password.php" class="d-block">Admin Account</a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input
                class="form-control form-control-sidebar"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
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
              <li class="nav-item menu-open">
                <a href="dashboard.php" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
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
                    <a href="student-module/bsit.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSIT</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/bscs.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSCS</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/bssw.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSSW</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/bscrim.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSCRIM</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/beed.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BEED</p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="student-module/bsn.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSN</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/bsm.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSM</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/bsed-math.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSED-MATH</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student-module/bsed-english.html" class="nav-link text-bold">
                      <i class="far fa-circle nav-icon"></i>
                      <p>BSED-ENGLISH</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="instructor-module/instructor.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                    INSTRUCTOR
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="schedule-module/schedule.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-week"></i>
                  <p>
                    SCHEDULES
                  </p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="pre-registered/registered.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                   
                    PRE-REGISTERED
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="notice/notice.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                    NOTICE
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="public-notice/publicnotice.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                    PUBLIC NOTICE
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reports/reports.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                    REPORTS
                  </p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="inbox/inbox.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                    INBOX
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>
                    LOGOUT
                  </p>
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
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div>
              <!-- /.col 
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
              </div> 
              -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= $totalStudents ?></h3>
                    <p>STUDENTS APPROVED</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= $totalInstructors ?></h3>
                    <p>STUDENTS PRE-REGISTERED
                  </div>
                  <div class="icon">
                    <i class="fas fa-bell"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?= $totalnotice ?></h3>
                    <p>NOTICE</p>
                  </div>
                  <div class="icon">
       
                    <i class="fas fa-chalkboard-teacher"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= $totalmessages ?></h3>
                    <p>INBOX</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-clock"></i>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= $totalStudents ?></h3>
                    <p>STUDENTS APPROVED</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= $totalInstructors ?></h3>
                    <p>STUDENTS PRE-REGISTERED
                  </div>
                  <div class="icon">
                    <i class="fas fa-bell"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?= $totalnotice ?></h3>
                    <p>NOTICE</p>
                  </div>
                  <div class="icon">
       
                    <i class="fas fa-chalkboard-teacher"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= $totalmessages ?></h3>
                    <p>INBOX</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-clock"></i>
                  </div>
                </div>
              </div>
            </div>


            <!-- Main row -->
           
                    <!--
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        
                        <span class="text-bold text-lg">820</span>
                        <span>Visitors Over Time</span> 
                        
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i> 12.5%
                        </span>
                        <span class="text-muted">Since last week</span>
                      </p>
                    </div>
                    -->
                    <!-- /.d-flex -->

                   
                      </span>
                    </div>
                  </div>
                </div>

                <!-- /.card -->
              </section>
              <!-- right col (We are only adding the ID to make the widgets sortable)-->

              
              <!-- right col -->
            </div>
            <!-- /.row (main row) -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!--
      <footer class="main-footer">
        <strong
          >Copyright &copy; 2014-2021
          <a href="https://adminlte.io">AdminLTE.io</a>.</strong
        >
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>
      -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE dashboard/Line Graph demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard3.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--   <script src="main.js"></script> --> 
  </body>
</html>
<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>