<?php
// Librairie FPDF qui permet la génération de documents PDF
require('./assets/php/fpdf/fpdf.php');


// Header personnalisé pour notre PDF avec logo de l'entreprise et un titre choisi
class PDF extends FPDF
{
    public $logo;
    public $title;
    public $comment;

    public function setCustomTitle($title){
        $this->title = $title;
    }

    public function setCustomComment($comment){
        $this->comment = $comment;
    }

    public function setCustomLogo($logo){
        $this->logo = $logo;
    }

    function Header()
    {
        // Logo
        $this->Image($this->logo,10,6,30);
        $this->SetFont('Arial','B',15);
        // Centrage du titre
        $this->Cell(40);
        // Titre
        $this->MultiCell(0,10,encode_special_chars($this->title));
        // Saut de ligne
        $this->Ln(40);
    }
}

// Gère l'affichage des caractères spéciaux de manière correcte dans le PDF
function encode_special_chars($txt){
    return iconv('utf-8', 'cp1252', $txt);
}

//Génération du PDF avec le titre et commentaire choisi
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-type: application/pdf');
    http_response_code(200);

    // Contenu du PDF
    $title = !empty($_POST['title']) ? $_POST['title'] : '';
    $comment = !empty($_POST['comment']) ? $_POST['comment'] : '';
    $logo = "./assets/img/logo.jpg";
    
    //Génération du PDF
    $pdf = new PDF();
    $pdf->setCustomTitle($title);
    $pdf->setCustomComment($comment);
    $pdf->setCustomLogo($logo);

    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->MultiCell(0, 8, encode_special_chars($comment));

    return $pdf->Output('exemple.pdf', 'D');
}

http_response_code(405);
exit();
?>