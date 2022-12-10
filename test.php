<?php
// Connexion à la BDD (à personnaliser)
require('config.php');
//$link = mysqli_connect('localhost','login','mot_de_passe','nom_base');
// Si base de données en UTF-8, utiliser la fonction utf8_decode pour tous les champs de texte à afficher

// Appel de la librairie FPDF
include('fpdf/fpdf.php');

// Création de la class PDF
class PDF extends FPDF {
	// Header
	function Header() {
		// Logo : 8 >position à gauche du document (en mm), 2 >position en haut du document, 80 >largeur de l'image en mm). La hauteur est calculée automatiquement.
		$this->Image('logo_agence.png',8,2);
		// Saut de ligne 20 mm
		$this->Ln(20);

		// Titre gras (B) police Helbetica de 11
		$this->SetFont('Helvetica','B',11);
		// fond de couleur gris (valeurs en RGB)
		$this->setFillColor(230,230,230);
 		// position du coin supérieur gauche par rapport à la marge gauche (mm)
		$this->SetX(70);
		// Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok	
		$this->Cell(60,8,'PERSONNE INVITEES',0,1,'C',1);
		// Saut de ligne 10 mm
		$this->Ln(10);		
	}
	// Footer
	function Footer() {
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Helvetica','I',9);
		// Numéro de page, centré (C)
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}


// On active la classe une fois pour toutes les pages suivantes
// Format portrait (>P) ou paysage (>L), en mm (ou en points > pts), A4 (ou A5, etc.)
$pdf = new PDF('P','mm','A4');

// Nouvelle page A4 (incluant ici logo, titre et pied de page)
$pdf->AddPage();
// Polices par défaut : Helvetica taille 9
$pdf->SetFont('Helvetica','',9);
// Couleur par défaut : noir
$pdf->SetTextColor(0);
// Compteur de pages {nb}
$pdf->AliasNbPages();


// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
function entete_table($position_entete) {
	global $pdf;
	$pdf->SetDrawColor(183); // Couleur du fond RVB
	$pdf->SetFillColor(221); // Couleur des filets RVB
	$pdf->SetTextColor(0); // Couleur du texte noir
	$pdf->SetY($position_entete);
	// position de colonne 1 (10mm à gauche)	
	$pdf->SetX(30);
	$pdf->Cell(40,8,'First Name',1,0,'C',1);	// 40 >largeur colonne, 8 >hauteur colonne
	// position de la colonne 2 (70 = 30+40)
	$pdf->SetX(70); 
	$pdf->Cell(40,8,'Last Name',1,0,'C',1);
	// position de la colonne 3 (110 = 70+40)
	$pdf->SetX(110); 
	$pdf->Cell(30,8,'Phone',1,0,'C',1);
	// position de la colonne 3 (170 = 110+30)
	$pdf->SetX(140); 
	$pdf->Cell(30,8,'Invite By',1,0,'C',1);
	$pdf->Ln(); // Retour à la ligne
}
// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (60 mm)
$position_entete = 50;
// police des caractères
$pdf->SetFont('Helvetica','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
entete_table($position_entete);


$position_detail = 58; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)
$requete = "SELECT * FROM personne";
$result = mysqli_query($conn, $requete);
while ($data_visit = mysqli_fetch_array($result)) {
	// position abcisse de la colonne 1 (10mm du bord)
	$pdf->SetY($position_detail);
	$pdf->SetX(30);
	$pdf->MultiCell(40,8,utf8_decode($data_visit['firstname']),1,'C');
    // position abcisse de la colonne 2 (70 = 10 + 60)	
	$pdf->SetY($position_detail);
	$pdf->SetX(70); 
	$pdf->MultiCell(40,8,utf8_decode($data_visit['lastname']),1,'C');
	// position abcisse de la colonne 3 (110 = 70+ 40)
	$pdf->SetY($position_detail);
	$pdf->SetX(110); 
	$pdf->MultiCell(30,8,$data_visit['phone'],1,'C');
	// position abcisse de la colonne 4 (170 = 110+ 30)
	$pdf->SetY($position_detail);
	$pdf->SetX(140); 
	$pdf->MultiCell(30,8,$data_visit['invitedby'],1,'C');

	// on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)	
	$position_detail += 8; 
}
mysqli_free_result($result);



$pdf->Output('test.pdf','I'); // affichage à l'écran
// Ou export sur le serveur
// $pdf->Output('F', '../test.pdf');
?>
