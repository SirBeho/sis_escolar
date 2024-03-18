<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetTitle("Ventas");
$pdf->SetFont('Arial', 'B', 12);
$id = $_GET['v'];
$idcliente = $_GET['cl'];
$config = mysqli_query($conexion, "SELECT * FROM configuracion");
$datos = mysqli_fetch_assoc($config);
$clientes = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $idcliente");
$datosC = mysqli_fetch_assoc($clientes);
$ventas = mysqli_query($conexion, "SELECT d.*, p.codproducto, p.descripcion FROM detalle_venta d INNER JOIN producto p ON d.id_producto = p.codproducto WHERE d.id_venta = $id");
$pdf->Cell(195, 5, utf8_decode($datos['nombre']), 0, 1, 'C');
$pdf->Ln(13);

$pdf->image("../../assets/img/logo.png", 180, 10, 30, 30, 'PNG');


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(80, 5, "Datos ", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5, $datos['telefono'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, utf8_decode("Dirección: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5, utf8_decode($datos['direccion']), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5, "Correo: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5, utf8_decode($datos['email']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 5,"Fecha: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5,('2022-07-26'), 0, 1, 'L');



$pdf->Ln(10);






$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Datos del cliente", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(90, 5, utf8_decode('Nombre'), 0, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Id alumno'), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode('Usuario'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(90, 5, utf8_decode($datosC['nombre']), 0, 0, 'L');
$pdf->Cell(50, 5, utf8_decode($datosC['telefono']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($datosC['direccion']), 0, 1, 'L');
$pdf->Ln(10);










$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Detalle de la Factura", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(60, 5, utf8_decode('Descripción'), 0, 0, 'L');
$pdf->Cell(50, 5, 'Cant.', 0, 0, 'L');
$pdf->Cell(50, 5, 'Precio', 0, 0, 'L');
$pdf->Cell(25, 5, 'Sub Total.', 0, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$total = 0.00;
$desc = 0.00;
while ($row = mysqli_fetch_assoc($ventas)) {
    $pdf->Cell(60, 5, $row['descripcion'], 0, 0, 'L');
    $pdf->Cell(50, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->Cell(50, 5, $row['precio'], 0, 0, 'L');
    $sub_total = $row['total'];
    $total = $total + $sub_total;
    $desc = $desc + $row['descuento'];
    $pdf->Cell(25, 5, number_format($sub_total, 2, '.', ','), 0, 1, 'L');
	
	
}
if ($desc >=0){
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, 'Descuento Total', 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(180, 5, number_format($desc, 2, '.', ','), 0, 1, 'R');
} else {
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, 'Recargo Total', 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(180, 5, number_format(($desc * -1), 2, '.', ','), 0, 1, 'R');
}
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, 'Total Pagar', 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(180, 5, number_format($total, 2, '.', ','), 0, 1, 'R');


$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(200, 5, "Gracias por preferirnos para la fomentacion de la eduacion ", 0, 1, 'C');





$pdf->Output("ventas.pdf", "I");

?>