@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detalle Articulos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Articulos</a></li>
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
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>ID_CATEGORIA</th>
                                            
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                                <td>{{$usuario->ID_ARTICULO}}</td>
                                                <td>{{$usuario->ID_CATEGORIA}}</td>
                                                <td>{{$usuario->DESCRIPCION}}</td>

                                            
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>ID_CATEGORIA</th> 
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