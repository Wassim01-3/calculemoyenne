<html lang="en">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>
<?php 
// Récupération des notes depuis le formulaire
$es_td = (float)$_POST['es_td'];
$es_exam = (float)$_POST['es_exam'];
$tfa_td = (float)$_POST['tfa_td'];
$tfa_exam = (float)$_POST['tfa_exam'];
$fi_td = (float)$_POST['fi_td'];
$fi_exam = (float)$_POST['fi_exam'];
$pfe_td = (float)$_POST['pfe_td'];
$pfe_exam = (float)$_POST['pfe_exam'];
$be_td = (float)$_POST['be_td'];
$be_exam = (float)$_POST['be_exam'];
$aep_td = (float)$_POST['aep_td'];
$aep_exam = (float)$_POST['aep_exam'];
$grb_td = (float)$_POST['grb_td'];
$grb_exam = (float)$_POST['grb_exam'];
$mpbf_td = (float)$_POST['mpbf_td'];
$mpbf_exam = (float)$_POST['mpbf_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$es_avg = calculerMoyenne($es_td, $es_exam);
$tfa_avg = calculerMoyenne($tfa_td, $tfa_exam);
$fi_avg = calculerMoyenne($fi_td, $fi_exam);
$pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
$be_avg = calculerMoyenne($be_td, $be_exam);
$aep_avg = calculerMoyenne($aep_td, $aep_exam);
$grb_avg = calculerMoyenne($grb_td, $grb_exam);
$mpbf_avg = calculerMoyenne($mpbf_td, $mpbf_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [2.5, 2, 1.5, 3, 1, 1.5, 2, 1.5, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $es_avg * $coeffs[0] + 
    $tfa_avg * $coeffs[1] + 
    $fi_avg * $coeffs[2] + 
    $pfe_avg * $coeffs[3] + 
    $be_avg * $coeffs[4] + 
    $aep_avg * $coeffs[5] + 
    $grb_avg * $coeffs[6] + 
    $mpbf_avg * $coeffs[7] + 
    $eep_avg * $coeffs[8]
) / $total_coeff;

// Crédits
$credits = [5, 4, 3, 6, 2, 3, 4, 3, 3];
$total_credits = 0;
$matieres = [$es_avg, $tfa_avg, $fi_avg, $pfe_avg, $be_avg, $aep_avg, $grb_avg, $mpbf_avg, $eep_avg];

foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Enquête et sondage</td><td>" . number_format($es_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques financières actuarielles</td><td>" . number_format($tfa_avg, 2) . "</td></tr>";
echo "<tr><td>Finance internationale</td><td>" . number_format($fi_avg, 2) . "</td></tr>";
echo "<tr><td>Élaboration et validation du PFE</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
echo "<tr><td>Business English</td><td>" . number_format($be_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse et évaluation des projets</td><td>" . number_format($aep_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion des risques bancaires</td><td>" . number_format($grb_avg, 2) . "</td></tr>";
echo "<tr><td>Marketing des produits bancaires et financiers</td><td>" . number_format($mpbf_avg, 2) . "</td></tr>";
echo "<tr><td>Entreprise d’Entrainement Pédagogique</td><td>" . number_format($eep_avg, 2) . "</td></tr>";
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
</body>
</html>
