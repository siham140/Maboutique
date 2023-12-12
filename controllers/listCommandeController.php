<?php
include "./model/commandes.php";

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$date_creation = date("d-m-Y H:i:s"); // Date et heure actuelles
    $statut = "en attente"; // Statut initial de la commande
$commandes = new Commande();
$commandes = $commandes->listCommandes();
// if (isset($_POST['submit'])) {
//     require('../vendor/autoload.php');
//     $spreadsheet = new Spreadsheet();

//     $s = $spreadsheet->createSheet();
//     $s = $spreadsheet->getActiveSheet();

//     $s->setCellValue('A1', "#");
//     $s->setCellValue('B1', "Date de creation");
//     $s->setCellValue('C1', "Status");
//     $s->setCellValue('D1', "Total");
//     $s->getColumnDimension('A')->setWidth(20, 'pt');
//     $s->getColumnDimension('B')->setWidth(150, 'pt');
//     $s->getColumnDimension('C')->setWidth(60, 'pt');
//     $s->getColumnDimension('D')->setWidth(45, 'pt');
//     $i = 2;
//     foreach ($commandes as $commande) {
//         $s->setCellValue('A' . $i, $commande['id']);
//         $s->setCellValue('B' . $i, $commande['date_creation']);
//         $s->setCellValue('C' . $i, $commande['statut']);
//         $s->setCellValue('D' . $i, $commande['total']);
//         $i++;
//     }

//     $writer = new Xlsx($spreadsheet);
//     $writer->save('world.xlsx')};

if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
}
else{
include "./views/admin/commandes.php";
}



