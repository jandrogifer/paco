<?php
session_start();
require('/var/www/html/fpdf/fpdf.php');






class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Factura de Compra', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, 'Gracias por su compra - Tienda Online', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Datos de la factura
$pdf->Cell(0, 10, 'Fecha: ' . date("d/m/Y"), 0, 1);
$pdf->Cell(0, 10, 'Cliente: ' . ($_SESSION['nombre'] ?? 'Usuario Anonimo'), 0, 1);
$pdf->Ln(5);

// Encabezado de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, 'Producto', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Cell(30, 10, 'Subtotal', 1);
$pdf->Ln();

// Productos
$pdf->SetFont('Arial', '', 12);
$total = 0;

if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $subtotal = $producto['cantidad'] * 2.50;
        $total += $subtotal;
        $pdf->Cell(100, 10, mb_convert_encoding($producto['nombre'], 'ISO-8859-1', 'UTF-8'), 1);
        $pdf->Cell(30, 10, $producto['cantidad'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($subtotal, 2) . ' €', 1, 1, 'C');
    }
} else {
    $pdf->Cell(160, 10, 'No hay productos en el carrito', 1, 1, 'C');
}

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(130, 10, 'Total a Pagar:', 1);
$pdf->Cell(30, 10, number_format($total, 2) . ' €', 1, 1, 'C');

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'IBAN: ES12 3456 7890 1234 5678 9012', 0, 1);
$pdf->Cell(0, 10, 'Gracias por su compra.AMEGO', 0, 1);

$pdf->Output('D', 'factura.pdf'); // Descargar PDF
exit();
?>
