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
	
	$congre = new Obreiro;
	$sql = $congre->runQuery("SELECT ID, Nome, Funcao_Ministerial, Telefone FROM obreiro ORDER BY Nome ASC");
	$sql->execute(array(':Nome'=>$Nome, ':Funcao_Ministerial'=>$Funcao_Ministerial, ':Telefone'=>$Telefone));
	
	
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
	$this->Text(80,10,(utf8_decode('Convite')));
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
$pdf->Cell(100,5,"Nome",1, 0, "C", true);
$pdf->Cell(60,5,utf8_decode("Função"),1, 0, "C", true);
$pdf->Cell(30,5,"Telefone",1, 0, "C", true);
$pdf->Ln();

while ($row =$sql->fetch(PDO::FETCH_ASSOC)) {
	
	$pdf->Cell(100,5,utf8_decode($row['Nome']),1);
	$pdf->Cell(60,5,utf8_decode($row['Funcao_Ministerial']),1);
	$pdf->Cell(30,5,utf8_decode($row['Telefone']),1);
	$pdf->Ln();
}


$pdf->Output("relatorio-Obreiros.pdf", "I");
?>