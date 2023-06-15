<?php
include("menu.php");
/*session_start();
include("conexion.php");*/
include("menu_recetas.php");

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
			INSERT INTO tbl_receta
            VALUES ('0','".$_POST["cliente"]."','".$_POST["edad"]."','".$_SESSION['sesnombre']."',(select CURRENT_TIMESTAMP()),'".$_POST['notes']."')";
        $result=mysqli_query($conexion,$sqlInsert);
        if(!$result){
            echo "Error no se puede ejecutar ".$sqlInsert." Error ".mysqli_error($conexion);
        }
        else {
            //echo "Se guardo satisfactoriamente el Orden";
        }

        $lastInsertId = mysqli_insert_id($conexion);
		for ($i = 0; $i < count($_POST['productName']); $i++) {
			$sqlInsertItem = "
			INSERT INTO tbl_receta_medicamento (receta_codigo, 
            receta_medicamento, 
            receta_dosis, 
            receta_unidad) 
			VALUES ('".$lastInsertId."', '".$_POST['productName'][$i]."', '".$_POST['dosis'][$i]."','".$_POST['unidad'][$i]."')";			
			
            $result2=mysqli_query($conexion,$sqlInsertItem);
		}
        if($result){
            if($result2){
                echo "<script>alert('Receta Creada Exitosamente!');</script>";
                echo "<script>window.open('buscar_recetas.php','_self');</script>";
            }
        }
        else{
            echo "Error no se puede ejecutar ".$sqlInsertItem." Error ".mysqli_error($conexion);
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
    <title>Receta Medica</title>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Librerias para Funcionalidades-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/receta.js"></script>
    <link rel="stylesheet" href="css/fac.css">

    <script type="text/javascript">
        function validar(){
            //alert("Voy a validar");
            
            if(document.getElementById("cliente").value==""){
                alert("Favor Ingresar el Nombre del Paciente");
                document.getElementById("cliente").focus();	
            }
            else if(document.getElementById("edad").value==""){
                alert("Favor Ingresar la Edad del Paciente");
                document.getElementById("edad").focus();	
            }
            else if(document.getElementById("productName_1").value==""){
                alert("Favor Ingresar el Nombre del Medicamento");
                document.getElementById("productName_1").focus();	
            }
            else if(document.getElementById("dosis_1").value==""){
                alert("Favor Ingresar la Dosis");
                document.getElementById("dosis_1").focus();	
            }
            else if(document.getElementById("unidad_1").value==""){
                alert("Favor Ingresar las Unidades");
                document.getElementById("unidad_1").focus();	
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

            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h2 class="title">Crear Receta Medica</h2>
                    </div>		    		
                </div>
                
                <input id="currency" type="hidden" value="L">
                
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 ">
                    
                    <div class="form-group">
                        <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre del Cliente" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="1" name="edad" id="edad" placeholder="Edad del Cliente"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="invoiceItem">	
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="30%">Medicamento</th>
                                <th width="15%">Dosis</th>
                                <!--<th width="10%">Cantidad</th>-->
                                <th width="10%">Unidad</th>
                                <!--<th width="10%">Total</th>-->
                            </tr>							
                            <tr>
                                <td><input class="itemRow" type="checkbox"></td>
                                <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                                <td><input type="text" name="dosis[]" id="dosis_1" class="form-control" autocomplete="off"></td>			
                               
                                <td><input type="number" name="unidad[]" id="unidad_1" class="form-control unidad" autocomplete="off"></td>
                                
                            </tr>						
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
                        <button class="btn btn-success" id="addRows" type="button">+ Agregar Mas</button>
                    </div>
                </div><br/>
                <div class="row">	
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-5" >
                        <h3>Notas: </h3>
                        <div class="form-group">
                            <textarea class="form-control txt" rows="3" name="notes" id="notes" placeholder="Notas"></textarea>
                        </div>
                        <br>

                        <div class="form-group">                            
                            <button name='invoice_btn' onClick="return validar();" class="btn btn-success submit_btn invoice-save-btm">Agendar Cita</button>
                        </div>
                    </span>
                </div>
                </div>
                <div class="clearfix"></div>
                </div>
            </form>			
        </div>
    </div>

</body>
</html>