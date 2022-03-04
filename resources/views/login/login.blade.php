<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Inicio de sesión</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="{{ asset('js/jquery3.5.1.min.js') }}" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
    {!! csrf_field() !!}
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Inicio de Sesión</h3></div>
                                    <div class="card-body">
                                            <div class="form-group">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                                <input class="form-control py-4" name="email" id="email"  placeholder="Enter email address" />
                                            </div>  
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                <input class="form-control py-4" name="password" id="password" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Recordar contraseña</label>
                                                </div>
                                            </div>
                                            <div class="form-group  align-items-center  " style="text-align: center;">
                                                
                                                <button type="submit" onclick="logueo()" class="btn btn-primary">Ingresar</button>
                                               
                                            </div>
                                            <label class="" for="" id="mostrar"></label>

                                        
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Si no tiene Usuario comuniquese con su soporte tecnico</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; TICUL 2021</div>
                            <div>
                                <a href="#">Aviso de privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
        function logueo()
{
 
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },        type: "POST",
                
                data: {'email':document.getElementsByName("email")[0].value, 'password':document.getElementsByName("password")[0].value},                 
                url:"{{url('/logeo')}}" ,
                dataType: 'html',
                success: function(data) {
                 
                 if($.isEmptyObject(data))
                      {
                        document.getElementById("mostrar").innerHTML = "Contraseña incorrecta, veririque sus datos";
                      }
                      else{
                        var url = 'inicio' 
        window.location.href = url; 
                          alert("correcto");
                      }
                }
            });
}
</script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
