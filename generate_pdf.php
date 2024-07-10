<?php
require_once('tcpdf/tcpdf.php');
require_once "db_connect.php";

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $sql = "SELECT * FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $car_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pdf = new TCPDF();
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('helvetica', '', 12, '', true);
        $pdf->SetHeaderData('', 0, 'Auto apraksts', '', array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->AddPage();

        if ($row['photo']) {
            $pdf->Image('photos/' . $row['photo'], 15, 40, 180, 90, '', '', '', false, 300, '', false, false, 1, false, false, false);
            $pdf->Ln(130);
        }

        $pdf->SetTextColor(0, 0, 0);
        $html = <<<EOD
        <h2>{$row['brand']} {$row['model']}</h2>
        <p><strong>Izlaiduma gads:</strong> {$row['year']}</p>
        <p><strong>Dzineja tilpums:</strong> {$row['engine']}</p>
        <p><strong>Degvielas tips:</strong> {$row['fueltype']}</p>
        <p><strong>Atrumkarba:</strong> {$row['gearbox']}</p>
        <p><strong>Virsbuves tips:</strong> {$row['cartype']}</p>
EOD;

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Auto_apraksts.pdf', 'I');
    } else {
        echo "No car found with the given ID.";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "No car ID specified.";
}
?>
