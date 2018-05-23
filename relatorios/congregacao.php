<?php

//include connection file 
include_once('../libs/fpdf.php');
require_once("../session.php");
    require_once('../init.php');
    
	$auth_user = new User();
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	
	$congre = new Congregation;
	$sql = $congre->runQuery("SELECT id, con_name, con_lider, con_adress FROM congregation ORDER BY ID DESC");
	$sql->execute(array(':con_name'=>$con_name, ':con_lider'=>$con_lider, ':con_adress'=>$con_adress));
	
	
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../img/logo.png',10,2,25);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
	$this->Text(80,10,(utf8_decode('Relatório das Congregações')));
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);

$pdf->SetFillColor(24, 83, 242);
$pdf->Cell(30,5,"Igreja",1, 0, "C", true);
$pdf->Cell(40,5,"Dirigente",1, 0, "C", true);
$pdf->Cell(120,5,utf8_decode("Endereço"),1, 0, "C", true);
$pdf->Ln();

while ($row =$sql->fetch(PDO::FETCH_ASSOC)) {
	
	$pdf->Cell(30,5,utf8_decode($row['con_name']),1);
	$pdf->Cell(40,5,utf8_decode($row['con_lider']),1);
	$pdf->Cell(120,5,utf8_decode($row['con_adress']),1);
	$pdf->Ln();
}


$pdf->Output("relatorio-igrejas.pdf", "I");
?>