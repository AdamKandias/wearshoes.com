<?php
require_once 'authorization.php';
require_once '../utils/fpdf/fpdf.php';
require_once '../db/database.php';
$db = new Database();

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(280, 10, 'DATA PRODUCTS', 0, 0, 'C');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(-43, 10, 'Exported at: ' . date("d-m-Y"), 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(80, 7, 'NAME', 1, 0, 'C');
$pdf->Cell(22, 7, 'CATEGORY', 1, 0, 'C');
$pdf->Cell(15, 7, 'PRICE', 1, 0, 'C');
$pdf->Cell(70, 7, 'COLOR', 1, 0, 'C');
$pdf->Cell(50, 7, 'SIZE', 1, 0, 'C');
$pdf->Cell(16, 7, 'WEIGHT', 1, 0, 'C');
$pdf->Cell(14, 7, 'STOCK', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$products = $db->fetchAllProductsWithoutImages();
foreach ($products as $product) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(80, 6, $product->name, 1, 0);
    $pdf->Cell(22, 6, $product->category, 1, 0);
    $pdf->Cell(15, 6, "$" . number_format($product->price / 100, 2, '.', ','), 1, 0);
    $pdf->Cell(70, 6, $product->color, 1, 0);
    $pdf->Cell(50, 6, $product->size, 1, 0);
    $pdf->Cell(16, 6, $product->weight . " gr", 1, 0);
    $pdf->Cell(14, 6, $product->quantity, 1, 1);
}

$pdf->Output();
