<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', array(75, 200));
$pdf->image("logo.png", 55, 10, 18, 18, 'PNG');

//---------------------------------------------------------

$bloque1 = <<<EOF


<table style="font-size:7px; text-align:center; font-weight: bold;">

	<tr>
		
		<td style="width:160px; padding:00px; img: ">
	        <div>
			<br>
		SISTEMA ESCOLAR
		<br>
			</div>

		</td>

	</tr>






</table>






<table style="font-size:5px; text-align:">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				<b>Fecha:</b> $fecha

				<br>
				<b>Correo:</b> SistemaEscolar0@gmail.com
				
				<br>
				<b>Instagram:</b> Sistemaescolar0

				<br>
				<b>Dirección:</b> Villa olga Av. Benito juarez 46 

				<br>
				<b>Teléfono:</b> 809-489-6112

				<br>
				<b>Factura:</b> #.$valorVenta

				<br><br>
			</div>

		</td>

	</tr>


</table>




<table style="font-size:6px; text-align:center">

	<br>
------------------------------------------------------------------------------<br>
				<b>ATENDIDO POR</b> <br>
------------------------------------------------------------------------------

<table style="width:100px; font-size:6px; text-align:">




<tr>
	     
		<td style="width:150px; text-align:center">
		<br> <b></b> $respuestaVendedor[nombre] <br> 
		
		</td>

	</tr>
</table>





<table style="font-size:6px; text-align:center">

	<br><br>
------------------------------------------------------------------------------<br>
				<b>DATOS CLIENTES</b> <br>
------------------------------------------------------------------------------

<table style="width:100px; font-size:6px; text-align:">




<tr>
	     
		<td style="width:150px; text-align:center">
		<br> <b></b> $respuestaCliente[nombre] <br> 
		
		</td>

	</tr>
</table>







<table style="font-size:6px; text-align:center">

<br><br>					
				
------------------------------------------------------------------------------<br>
				<b>DATOS DE SERVICIOS</b> <br>
------------------------------------------------------------------------------

<table style="width:200px; font-size:6px; text-align:right">




<tr>
	     
		<td style="width:180px; text-align:left">
		<br> <b>cant &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; precio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sub total</b> <br> 
		
		</td>

	</tr>
</table>

</table>





EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF



<table style="font-size:6px;text-align:center">
	



	
	<tr>
	
		<td style="width:185px; text-align:right">
		$item[descripcion] 
		</td>

	</tr>
	
         

	<tr>
	     
		<td style="width:180px; text-align:left">
		$item[cantidad]  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ $valorUnitario  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:6px; text-align:right; ">
<br><br><br>
			<br>
			<br>
	<tr>
	        
		<td style="width:135px;">
			 <b>Total:</b> 
		</td>

		<td style="width:50px; font-size:5px">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:135px;">
			 <b>Descuento:</b>
		</td>

		<td style="width:50px; font-size:5px">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:190px;">
			 ---------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:135px;">
			<b> TOTAL PAGAR:</b>
		</td>

		<td style="width:50px; font-size:5px">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:center; font-weight: bold;">
			<br>
			<br>
			<br>
			<br>
			<br>
			Muchas gracias por preferirnos!
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
ob_end_clean();
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();
?>