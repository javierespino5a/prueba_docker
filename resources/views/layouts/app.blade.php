<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TICUL 2021</title>
        <link href=" {{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}"  rel="stylesheet" />
        <link href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}"  rel="stylesheet" />
        <link href="{{ asset('css/datatables/buttons.dataTables.min.css') }}"  rel="stylesheet" />
        <link href="{{ asset('css//datatables/select.bootstrap4.min.css') }}"  rel="stylesheet" />


        
        <script src="{{ asset('js/jquery3.5.1.min.js') }}" crossorigin="anonymous"></script>


    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/inicio') }}">TICUL 2021</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <a style="color: white;" href="">{{ session()->get('user') }}</a>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        
                        <div class="dropdown-divider"></div>
                        <form action="{{url('/logeos')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn dropdown-item btn-primary">Cerrar sesión</button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="{{ url('/inicio') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Inicio
                            </a>
                            <?php
  $mysqli = new mysqli('162.241.2.113', 'javibirt_javier', 'javierespinosa', 'javibirt_registros');
  //$mysqli = new mysqli('192.168.29.94', 'root', 'srvsedesol', '');
    $mysqli->set_charset("utf8");
     

$query = $mysqli -> query ("SELECT * FROM cat_permisos where ID_ROL=".session()->get('rol'));

while ($valores = mysqli_fetch_assoc($query)) {
  echo '<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts'.$valores['ID_PERMISO'].'" aria-expanded="false" aria-controls="collapseLayouts">
  <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
 '.$valores['DESCRIPCION'].'
  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a> <div class="collapse" id="collapseLayouts'.$valores['ID_PERMISO'].'" aria-labelledby="headingFOUR" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">  ';
$query2 = $mysqli -> query ("SELECT * FROM tbl_permisos_vistas INNER JOIN cat_vistas ON tbl_permisos_vistas.ID_VISTA=cat_vistas.ID_VISTA  where ID_PERMISO=".$valores['ID_PERMISO']);

while ($valores2 = mysqli_fetch_assoc($query2)) {

    ECHO '    <a class="nav-link" href="'.$valores2['URL'].'">
    <div class="sb-nav-link-icon"><i class="'.$valores2['ICONO'].'"></i></div>
    '.$valores2['DESCRIPCION'].'
</a> ';
}
ECHO '</nav>              
                           
                                
</div>';
}

?>
                           
                    </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logueado en:</div>
                        TICUL 2021
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
            <main>
            @yield('content')

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; TICUL 2021</div>
                            <div>
                                <a href="#">Aviso de privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>

        <script src=" {{ asset('js/scripts.js') }}"></script>
        <script src=" {{ asset('js/all.min.js') }}"></script>
         <script src=" {{ asset('js/Chart.min.js') }}"></script>
         <script src=" {{ asset('js/jquery.dataTables.min.js') }}"></script>



      

        
<!--
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
-->       
<script src=" {{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
<script src=" {{ asset('js/datatables/buttons.flash.min.js') }}"></script>
<script src=" {{ asset('js/datatables/jszip.min.js') }}"></script>
<script src=" {{ asset('js/datatables/pdfmake.min.js') }}"></script>
<script src=" {{ asset('js/datatables/vfs_fonts.js') }}"></script>
<script src=" {{ asset('js/datatables/buttons.html5.min.js') }}"></script>
<script src=" {{ asset('js/datatables/buttons.print.min.js') }}"></script>
<script src=" {{ asset('js/datatables/dataTables.select.min.js') }}"></script>







        <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-pie-demo.js') }}"></script>
    </body>

</html>
