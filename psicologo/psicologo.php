<?php

?>
<!DOCTYPE html>

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

    <!--sidebar--design-->
    <div id="sidebar">
        <div class="sidebar-header">
            <h3><img src="img/logo.png" class="img-fluid" /><span>SABA</span></h3>
        </div>
        <ul class="list-unstyled component m-0">
            <li class="active">
                <a href="#"><i class="material-icons">manage_accounts</i>Panel de Psicologo</a>
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
                <a href="ControladorEvento?accion=listarEvento">
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

    <!--page-content start-->
    <div id="content">
        <!--top-navbar-start-->
        <div class="top-navbar">
            <div class="xd-topbar">
                <!-- ... (content omitted for brevity) ... -->
            </div>
        </div>
        <!--top-navbar-end-->

        <!--main-content-start-->
        <div class="main-content">
            <!-- ... (content omitted for brevity) ... -->
        </div>
        <!--main-content-end-->

        <!--footer-design-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="footer-in">
                    <p class="mb-0">&copy 2023 Vishweb Design. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>

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
</body>

</html>

