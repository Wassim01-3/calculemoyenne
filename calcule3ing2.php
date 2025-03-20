<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
    <title>Résultats Académiques</title>
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$es_td = (float)$_POST['es_td'];
$es_exam = (float)$_POST['es_exam'];
$ac_td = (float)$_POST['ac_td'];
$ac_exam = (float)$_POST['ac_exam'];
$mgr_td = (float)$_POST['mgr_td'];
$mgr_exam = (float)$_POST['mgr_exam'];
$pfe_td = (float)$_POST['pfe_td'];
$pfe_exam = (float)$_POST['pfe_exam'];
$be_td = (float)$_POST['be_td'];
$be_exam = (float)$_POST['be_exam'];
$aep_td = (float)$_POST['aep_td'];
$aep_exam = (float)$_POST['aep_exam'];
$est_td = (float)$_POST['est_td'];
$est_exam = (float)$_POST['est_exam'];
$gp_td = (float)$_POST['gp_td'];
$gp_exam = (float)$_POST['gp_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$es_avg = calculerMoyenne($es_td, $es_exam);
$ac_avg = calculerMoyenne($ac_td, $ac_exam);
$mgr_avg = calculerMoyenne($mgr_td, $mgr_exam);
$pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
$be_avg = calculerMoyenne($be_td, $be_exam);
$aep_avg = calculerMoyenne($aep_td, $aep_exam);
$est_avg = calculerMoyenne($est_td, $est_exam);
$gp_avg = calculerMoyenne($gp_td, $gp_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [2.5, 1.5, 2, 3, 1, 1.5, 2, 1.5, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $es_avg * $coeffs[0] +
    $ac_avg * $coeffs[1] +
    $mgr_avg * $coeffs[2] +
    $pfe_avg * $coeffs[3] +
    $be_avg * $coeffs[4] +
    $aep_avg * $coeffs[5] +
    $est_avg * $coeffs[6] +
    $gp_avg * $coeffs[7] +
    $eep_avg * $coeffs[8]
) / $total_coeff;

// Crédits
$credits = [5, 3, 4, 6, 2, 3, 4, 3, 3];
$total_credits = 0;
$matieres = [$es_avg, $ac_avg, $mgr_avg, $pfe_avg, $be_avg, $aep_avg, $est_avg, $gp_avg, $eep_avg];

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
echo "<tr><td>Analyse de la conjoncture</td><td>" . number_format($ac_avg, 2) . "</td></tr>";
echo "<tr><td>Méthodes de gestion des risques</td><td>" . number_format($mgr_avg, 2) . "</td></tr>";
echo "<tr><td>Élaboration et validation du PFE</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
echo "<tr><td>Business English</td><td>" . number_format($be_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse et évaluation des projets</td><td>" . number_format($aep_avg, 2) . "</td></tr>";
echo "<tr><td>Économétrie des séries temporelles</td><td>" . number_format($est_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de portefeuille</td><td>" . number_format($gp_avg, 2) . "</td></tr>";
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
