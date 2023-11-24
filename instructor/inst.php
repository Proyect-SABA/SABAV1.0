<?php

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Pagina Principal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="../css/custom.css">

    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script>
        function buscar() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("aprendicesTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                var found = false;
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
</head>

<body>
<div class="wrapper">
    <div class="body-overlay"></div>
    <!-------sidebar--design------------>
    <div id="sidebar">
        <div class="sidebar-header">
            <h3><img src="img/logo.png" class="img-fluid" /><span>SABA</span></h3>
        </div>
        <ul class="list-unstyled component m-0">
            <li class="active">
                <a href="#"><i class="material-icons">manage_accounts</i>Panel de Instructor</a>
            </li>
            <li class="active">
                <a href="#" class="dashboard"><i class="material-icons">dashboard</i>dashboard </a>
            </li>
            <li class="dropdown">
                <a href="ControladorSeguimiento?accion=listarSeguimiento">
                    <i class="material-icons">person_outline</i>Seguimiento
                </a>
            </li>
            <li class="dropdown">
                <a href="/eventos/index.php">
                    <i class="material-icons">event</i>Eventos
                </a>
            </li>
            <li class="dropdown">
                <a href="ControladorNovedades?accion=listarNovedades" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="material-icons">notifications</i>Novedades
                </a>
            </li>
        </ul>
    </div>
    <!-------sidebar--design- close----------->
    <!-------page-content start----------->
    <div id="content">
        <!------top-navbar-start----------->
        <div class="top-navbar">
            <div class="xd-topbar">
                <div class="row">
                    <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                        <div class="xp-menubar">
                            <span class="material-icons text-white">signal_cellular_alt</span>
                        </div>
                    </div>
                    <!-- ... (código anterior) ... -->
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $(".xp-menubar").on('click', function () {
                                $("#sidebar").toggleClass('active');
                                $("#content").toggleClass('active');
                            });

                            $('.xp-menubar,.body-overlay').on('click', function () {
                                $("#sidebar,.body-overlay").toggleClass('show-nav');
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="xp-breadcrumbbar text-center">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!------top-navbar-end----------->
        <!------main-content-start----------->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                    <h2 class="ml-lg-2">dashboard</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <a href="Controlador?accion=add" class="btn btn-success">
                                        <i class="material-icons">&#xE147;</i>
                                        <span>Agregar</span>
                                    </a>
                                    <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                                        <i class="material-icons">&#xE15C;</i>
                                        <span>Eliminar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="hint-text">showing <b>5</b> out of <b>25</b></div>
                            <ul class="pagination">
                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                <li class="page-item "><a href="#" class="page-link">1</a></li>
                                <li class="page-item "><a href="#" class="page-link">2</a></li>
                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                <li class="page-item "><a href="#" class="page-link">4</a></li>
                                <li class="page-item "><a href="#" class="page-link">5</a></li>
                                <li class="page-item "><a href="#" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ... (código anterior) ... -->
            </div>
        </div>
        <!------main-content-end----------->
        <!----footer-design------------->
        <footer class="footer">
            <div class="

