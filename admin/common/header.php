<?php //session_start();
include_once('../config/db.php');
if (!isset($_SESSION['user_id'])) {

  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Responsive Admin Dashboard Template">
  <meta name="keywords" content="admin,dashboard">
  <meta name="author" content="stacks">



  <title></title>


  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
  <link href="../assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
  <link href="../assets/plugins/pace/pace.css" rel="stylesheet">


  <link href="../assets/css/main.min.css" rel="stylesheet">
  <link href="../assets/css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
  



</head>

<body class="page-sidebar-collapsed">


  <div class="page-container">
    <div class="page-content">
      <div class="page-header">
        <nav class="navbar navbar-expand-lg d-flex justify-content-between">
          <div class="d-flex align-items-center header-title">
         
                      
            <h5 class="mb-0">Student List</h5>
          </div>

         
          <div class="d-flex align-items-center">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link profile-dropdown header-title" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION['name'] ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropDown">
                 
                  <a class="dropdown-item" href="logout.php">
                    <i data-feather="log-out"></i> Logout
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>