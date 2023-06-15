<?php
//include("menu.php");
/*session_start();
include("conexion.php");*/
include("menu_facturas.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

$accion=isset($_POST["accion"])?$_POST["accion"]:"";

if($accion=="guardar"){
    //echo "<script>alert('Informacion Guardada Exitosamente!');</script>";

    $sqlInsert = "
			INSERT INTO factura_orden 
            
			VALUES ('0','".$_SESSION["sesuser"]."',(select CURRENT_TIMESTAMP()),'".$_POST['cedula']."', 
            '".$_POST['cliente']."', '".$_POST['address']."', '".$_POST['subTotal']."', '".$_POST['taxAmount']."', '".$_POST['taxRate']."', '".$_POST['totalAftertax']."', '".$_POST['amountPaid']."', '".$_POST['amountDue']."', '".$_POST['notes']."','PENDIENTE','','')";
        $result=mysqli_query($conexion,$sqlInsert);
        if(!$result){
            echo "Error no se puede ejecutar ".$sqlInsert." Error ".mysqli_error($conexion);
        }
        else {
            //echo "Se guardo satisfactoriamente el Orden";
        }

        $lastInsertId = mysqli_insert_id($conexion);
		for ($i = 0; $i < count($_POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO factura_orden_producto (order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount) 
			VALUES ('".$lastInsertId."', '".$_POST['productCode'][$i]."', '".$_POST['productName'][$i]."', '".$_POST['quantity'][$i]."', '".$_POST['price'][$i]."', '".$_POST['total'][$i]."')";			
			
            $result2=mysqli_query($conexion,$sqlInsertItem);
		}
        if($result){
            if($result2){
                echo "<script>alert('Factura Guardada Exitosamente!');</script>";
                echo "<script>window.open('buscar_factura.php','_self');</script>";
            }
        }
        else{
            echo "Error no se puede ejecutar ".$sqlInsertItem." Error ".mysqli_error($conexion);
        }
    }
/********************************************************************************************************/

	/*$nombre=mysqli_real_escape_string($conexion,$_REQUEST["txtnombre"]);
	$ape1=mysqli_real_escape_string($conexion,$_REQUEST["txtape1"]);

	$sql="insert into tbl_empleado values('".$_POST["txtcedula"]."','".$nombre."','".$ape1."','".$_POST["txtape2"]."','".$_POST["dfechai"]."','".$_POST["dnac"]."','".$_POST["cmbestadoc"]."','".$_POST["txtobser"]."','".$_POST["txtcorreo"]."','".$_POST["cmbarea"]."','".$_POST["txtgradoa"]."','".$_POST["cmbgenero"]."','".$_POST["cmbestado"]."','".$_POST["txttelefono"]."','".$_POST["txtcelular"]."','0','0')";

	//echo "<br>".$sql;
	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Informacion Guardada Exitosamente!');</script>";
	}
	else{
		echo "Error no se puede ejecutar ".$sql." Error ".mysqli_error($conexion);
	}*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturar</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Librerias para Funcionalidades-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/invoice.js"></script>
    <link rel="stylesheet" href="css/fac.css">

    <script type="text/javascript">
        function validar(){
            //alert("Voy a validar");
            
            if(document.getElementById("cliente").value==""){
                alert("Favor Ingresar el Nombre del Cliente");
                document.getElementById("cliente").focus();	
            }
            else if(document.getElementById("cedula").value==""){
                alert("Favor Ingresar una Cedula del Cliente");
                document.getElementById("cedula").focus();	
            }
            else if(document.getElementById("productCode_1").value==""){
                alert("Favor Ingresar el Codigo del Producto o Servicio");
                document.getElementById("productCode_1").focus();	
            }
            else if(document.getElementById("productName_1").value==""){
                alert("Favor Ingresar el Nombre del Producto o Servicio");
                document.getElementById("productName_1").focus();	
            }
            else if(document.getElementById("quantity_1").value==""){
                alert("Favor Ingresar la Cantidad");
                document.getElementById("quantity_1").focus();	
            }
            else if(document.getElementById("price_1").value==""){
                alert("Favor Ingresar el Precio");
                document.getElementById("price_1").focus();	
            }
            else if(document.getElementById("taxRate").value==""){
                alert("Favor Ingresar el % de la Tasa de Impuesto");
                document.getElementById("taxRate").focus();	
            }
            /*else if(document.getElementById("amountPaid").value==""){
                alert("Favor Ingresar la cantidad con la que el Cliente Pagara");
                document.getElementById("amountPaid").focus();
            }*/
            
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
                        <a href="main.php"><img src="img/home.png"/></a>
                        <h2 class="title">Crear Factura</h2>
                    </div>		    		
                </div>
                
                <input id="currency" type="hidden" value="L">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="form-group">
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula del Cliente" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre del Cliente" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="address" id="address" placeholder="Su direccion"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="invoiceItem">	
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="15%">Prod. No</th>
                                <th width="38%">Nombre Producto</th>
                                <th width="15%">Cantidad</th>
                                <th width="15%">Precio</th>								
                                <th width="15%">Total</th>
                            </tr>							
                            <tr>
                                <td><input class="itemRow" type="checkbox"></td>
                                <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                                <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>			
                                <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                                <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                                <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                            </tr>						
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
                        <button class="btn btn-success" id="addRows" type="button">+ Agregar Más</button>
                    </div>
                </div>
                <div class="row">	
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <h3>Notas: </h3>
                        <div class="form-group">
                            <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <!--<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                            <input data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar Factura" class="btn btn-success submit_btn invoice-save-btm">						-->
                            <button name='invoice_btn' onClick="return validar();" class="btn btn-success submit_btn invoice-save-btm">Guardar Factura</button>
                        </div>
                        
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <span class="form-inline">
                        <div class="form-group">
                            <label>Subtotal: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon currency">L</div>
                                <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tasa Impuesto: &nbsp;</label>
                            <div class="input-group">
                                <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tasa de Impuestos">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Monto Impuesto: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon currency">L</div>
                                <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto de Impuesto" readonly>
                            </div>
                        </div>							
                        <div class="form-group">
                            <label>Total: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon currency">L</div>
                                <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pagara: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon currency">L</div>
                                <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Cantidad pagada">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cantidad a deber: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon currency">L</div>
                                <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Cantidad debida" readonly>
                            </div>
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