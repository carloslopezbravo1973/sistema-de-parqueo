<?php include('app/config.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-image: url('public/imagenes/piso.jpg');
    background-repeat: no-repeat;
    z-index: -3;
    background-size: 100vw 100vh">

<nav class="navbar navbar-expand-lg navbar-light bg-ligh navbar-dark bg-dark ">
    
    <div class="container-fluid">
        
    <img src="<?php echo $URL;?>/public/imagenes/auto1.png" width="20" height="30" alt="" loading="lazy">

    <a class="navbar-brand" href="#">"Sistema de Parqueo"</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link active" href="#">Acerca De...</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Programacion
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Mensuales</a></li>
            <li><a class="dropdown-item" href="#">Diarias</a></li>
            <li><a class="dropdown-item" href="#">Fichas</a></li>
          </ul>
        </li>
        <li class="nav-item active">
          <a class="nav-link active" href="#" tabindex="-1" aria-disabled="true">Contactenos...</a>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      </form>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ingresar
        </button>
    </div>
  </div>
</nav>

<!-- Button trigger modal -->

<br></br>
<br></br>
<div class="container">
    <div class="row">
                                  <?php
                                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1' ");
                                    $query_mapeos->execute();
                                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($mapeos as $mapeo){
                                        $id_map = $mapeo['id_map'];
                                        $nro_espacio = $mapeo['nro_espacio'];
                                        $estado_espacio = $mapeo['estado_espacio'];
                                        if ($estado_espacio == "LIBRE"){ ?>
                                              <div class="col">
                                                  <center>
                                                  <h4><?php echo $nro_espacio;?></h4>
                                                  <button class="btn btn-success" style="width: 100%;height: 114px">
                                                      <p><?php echo $estado_espacio;?></p>
                                                  </button>
                                                  </center>
                                              </div>
                                        <?php
                                        }
                                        if ($estado_espacio == "OCUPADO"){ ?>
                                          <div class="col">
                                            <center>
                                              <h4><?php echo $nro_espacio;?></h4>
                                              <button class="btn btn-info">
                                                <img src="<?php echo $URL;?>/public/imagenes/auto1.png" width="60px" alt="">
                                              </button>
                                              <p><?php echo $estado_espacio;?></p>
                                            </center>
                                          </div>
                                          <?php
                                        }
                                        ?>  
                                        
                                    <?php
                                    }
                                    ?>    
    </div>
</div>

    <script src="public/js/jquery-3.5.1.min.js"></script>
    <script src="public/js/jquery-3.5.1.slim.min.js"></script>
    <script src="public/js/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inicio de Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Usuario/Email</label>
                            <input type="text" id="usuario" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" id="password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-body" id="respuesta">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_ingresar">Ingresar</button>
            </div>
        </div>
    </div>
</div>




<script>

    $('#btn_ingresar').click(function () {
        login();
    });

    $('#password').keypress(function (e) {
        if(e.width == 13){
            login();
        }
    });

    function login() {
        var usuario = $('#usuario').val();
        var password_user = $('#password').val();

        if(usuario == ""){
            alert('Debe Introducir su Usuario...');
            $('#usuario').focus();
        }else if(password_user == ""){
            alert('Debe Introducir su Contraseña...');
            $('#password').focus();
        }else{
            var url = 'login/controller_login.php'
            $.post(url,{usuario:usuario, password_user:password_user},function (datos) {
                $('#respuesta').html(datos);
            });
        }
    }

</script>

