<?php
include("menu.php");
/*session_start();
include("conexion.php");*/
include("menu_servicios.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

$sql="select curdate()as hoy";
$result=mysqli_query($conexion,$sql);

while($row=mysqli_fetch_assoc($result)){
	$valor=$row["hoy"];
}

$accion=isset($_POST["accion"])?$_POST["accion"]:"";

if($accion=="guardar"){
    //echo "<script>alert('Vamos a Agendar!');</script>";
    $sqlInsert = "
				UPDATE tbl_cita 
				SET cita_estado='ATENDIDO'
				WHERE cita_codigo = '".$_GET['update_id']."'";		
			$result=mysqli_query($conexion, $sqlInsert);
            if(!$result){
                echo "Error no se puede ejecutar ".$sqlInsert." Error ".mysqli_error($conexion);
            }
            else{
                
            }
    
    $sql = "
			INSERT INTO tbl_cirugia
            VALUES ('0','".$_GET['update_id']."',
            (select CURRENT_TIMESTAMP()),
            '".$_POST['resultado']."',
            '".$_POST['notes']."',
            '".$_SESSION['sesnombre']."')";
        $result=mysqli_query($conexion,$sql);
        if($result){
            echo "<script>alert('Operacion Realizada Exitosamente!');</script>";
            echo "<script>window.open('cirugia.php','_self');</script>";
        }
        else {
            echo "Error no se puede ejecutar ".$sql." Error ".mysqli_error($conexion);
        }
        
}
/********************************************************************************************************/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atender Cirugia</title>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <script type="text/javascript">
        function validar(){
            //alert("Voy a validar");
            
            if(document.getElementById("resultado").value==""){
                alert("Favor Ingresar el Resultado del Paciente");
                document.getElementById("resultado").focus();
            }
            else if(document.getElementById("notes").value==""){
                alert("Favor Ingresar la Nota para Paciente");
                document.getElementById("notes").focus();
            }
    //-----------------------------------------------------------------
            else{
                if(document.getElementById("accion").value==""){
                    //alert("Guardar en BD");
                    document.getElementById("accion").value="guardar";
                }
                return true;
            }
            return false;
            //break; return ;
        }
    </script>

</head>

<body>

    <div class="container content-invoice">
        <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate> 
            
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>" placeholder="Accion">

            <a href="cirugia.php"><img src="img/back.png"/></a>

            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h2 class="title">Atender Operacion</h2>
                    </div>		    		
                </div>
                
                <div class="row">	
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-5 pull-left">
                        <h3>Notas: </h3>
                        <div class="form-group">
                            <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="row">	
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-5 pull-right">
                        <h3>Resultado: </h3>
                        <div class="form-group">
                            

                            <input type="text" class="form-control" name="resultado" id="resultado" placeholder="Resultado" autocomplete="off">
                        </div>
                        <br>
                        <div class="form-group">
                        </div>
                    </div>
                </div>

                <div class="row">	
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-5 pull-center">
                        <div class="form-group"><br/><br/><br/><br/><br/>
                            <button name='invoice_btn' onClick="return validar();" class="btn btn-success submit_btn invoice-save-btm">Terminar Operacion</button>
                        </div>
                        <br>
                    </div>
                </div>


                <div class="clearfix"></div>
            </div>
        </form>			
    </div>
    </div>

</body>
</html>