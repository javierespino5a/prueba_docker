@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detalle Proveedores</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Proveedores</a></li>
                            <li class="breadcrumb-item active">Reporte</li>
                        </ol>
                        <div class="card mb-4">
                                         
                           
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Reporte
                            </div>
                           
       
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>NOMBRE</th>
                                            <th>RFC</th>
                                            <th>DIRECCION</th>
                                            <TH>CONTACTO</TH>
                                            
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                                <td>{{$usuario->NOMBRE}}</td>
                                                <td>{{$usuario->RFC}}</td>
                                                <td>{{$usuario->DIRECCION}}</td>

                                                <td>{{$usuario->CONTACTO}}</td>
                                            
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>NOMBRE</th>
                                            <th>RFC</th>
                                            <th>DIRECCION</th>
                                            <TH>CONTACTO</TH> 
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
               
            </div>
        
    </body>
@stop
<script>


</script>