<html lang="en">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>
<?php
// Récupération des notes depuis le formulaire
$es_td = (float)$_POST['es_td'];
$es_exam = (float)$_POST['es_exam'];
$sif_td = (float)$_POST['sif_td'];
$sif_exam = (float)$_POST['sif_exam'];
$tfi_td = (float)$_POST['tfi_td'];
$tfi_exam = (float)$_POST['tfi_exam'];
$pfe_td = (float)$_POST['pfe_td'];
$pfe_exam = (float)$_POST['pfe_exam'];
$be_td = (float)$_POST['be_td'];
$be_exam = (float)$_POST['be_exam'];
$aep_td = (float)$_POST['aep_td'];
$aep_exam = (float)$_POST['aep_exam'];
$aci_td = (float)$_POST['aci_td'];
$aci_exam = (float)$_POST['aci_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];
$tli_td = (float)$_POST['tli_td'];
$tli_exam = (float)$_POST['tli_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$es_avg = calculerMoyenne($es_td, $es_exam);
$sif_avg = calculerMoyenne($sif_td, $sif_exam);
$tfi_avg = calculerMoyenne($tfi_td, $tfi_exam);
$pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
$be_avg = calculerMoyenne($be_td, $be_exam);
$aep_avg = calculerMoyenne($aep_td, $aep_exam);
$aci_avg = calculerMoyenne($aci_td, $aci_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);
$tli_avg = calculerMoyenne($tli_td, $tli_exam);

// Coefficients
$coeffs = [
    2.5, // Enquête et Sondage
    1.5, // Stratégies Internationales des Firmes
    2,   // Techniques Financières Internationales
    3,   // Élaboration et Validation du PFE
    1.5, // Business English
    1.5, // Analyse et Évaluation des Projets
    2,   // Assurance du Commerce International
    1.5, // Entreprise d’Entrainement Pédagogique
    1.5  // Transport et Logistique Internationale
];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $es_avg * $coeffs[0] +
    $sif_avg * $coeffs[1] +
    $tfi_avg * $coeffs[2] +
    $pfe_avg * $coeffs[3] +
    $be_avg * $coeffs[4] +
    $aep_avg * $coeffs[5] +
    $aci_avg * $coeffs[6] +
    $eep_avg * $coeffs[7] +
    $tli_avg * $coeffs[8]
) / $total_coeff;

// Crédits
$credits = [
    5, // Enquête et Sondage
    3, // Stratégies Internationales des Firmes
    4, // Techniques Financières Internationales
    6, // Élaboration et Validation du PFE
    3, // Business English
    3, // Analyse et Évaluation des Projets
    4, // Assurance du Commerce International
    3, // Entreprise d’Entrainement Pédagogique
    3  // Transport et Logistique Internationale
];

$total_credits = 0;
$matieres = [$es_avg, $sif_avg, $tfi_avg, $pfe_avg, $be_avg, $aep_avg, $aci_avg, $eep_avg, $tli_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Enquête et Sondage</td><td>" . number_format($es_avg, 2) . "</td></tr>";
echo "<tr><td>Stratégies Internationales des Firmes</td><td>" . number_format($sif_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques Financières Internationales</td><td>" . number_format($tfi_avg, 2) . "</td></tr>";
echo "<tr><td>Élaboration et Validation du PFE</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
echo "<tr><td>Business English</td><td>" . number_format($be_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse et Évaluation des Projets</td><td>" . number_format($aep_avg, 2) . "</td></tr>";
echo "<tr><td>Assurance du Commerce International</td><td>" . number_format($aci_avg, 2) . "</td></tr>";
echo "<tr><td>Entreprise d’Entrainement Pédagogique</td><td>" . number_format($eep_avg, 2) . "</td></tr>";
echo "<tr><td>Transport et Logistique Internationale</td><td>" . number_format($tli_avg, 2) . "</td></tr>";
echo '</table>';

echo '<div class="result-summary">';
echo "<p><strong>Moyenne Générale :</strong> " . number_format($general_avg, 2) . "</p>";
if ($general_avg >= 10) {
    echo "<img src='3-unscreen.gif' width='240' height='160' alt='Animation positive'>";
} else {
    echo "<img src='2-unscreen.gif' width='240' height='160' alt='Animation négative'>";
}
echo "<p><strong>Total des Crédits Obtenus :</strong> $total_credits</p>";
echo '</div>';
?>
