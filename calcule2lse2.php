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
$ecointer_exam = (float)$_POST['ecointer_exam'];
$ecointer_td = (float)$_POST['ecointer_td'];
$ecoind_exam = (float)$_POST['ecoind_exam'];
$ecoind_td = (float)$_POST['ecoind_td'];
$ecomon_exam = (float)$_POST['ecomon_exam'];
$ecomon_td = (float)$_POST['ecomon_td'];
$stat_exam = (float)$_POST['stat_exam'];
$stat_td = (float)$_POST['stat_td'];
$meto_ds1 = (float)$_POST['meto_ds1'];
$meto_ds2 = (float)$_POST['meto_ds2'];
$ang_exam = (float)$_POST['ang_exam'];
$ang_td = (float)$_POST['ang_td'];
$bus_exam = (float)$_POST['bus_exam'];
$bus_td = (float)$_POST['bus_td'];
$conj_exam = (float)$_POST['conj_exam'];
$conj_td = (float)$_POST['conj_td'];
$mar_exam = (float)$_POST['mar_exam'];
$mar_td = (float)$_POST['mar_td'];

// Formules de calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

function calculerMethodeMoyenne($ds1, $ds2) {
    return $ds1 * 0.5 + $ds2 * 0.5;
}

// Calcul des moyennes
$ecointer_avg = calculerMoyenne($ecointer_td, $ecointer_exam);
$ecoind_avg = calculerMoyenne($ecoind_td, $ecoind_exam);
$ecomon_avg = calculerMoyenne($ecomon_td, $ecomon_exam);
$stat_avg = calculerMoyenne($stat_td, $stat_exam);
$meto_avg = calculerMethodeMoyenne($meto_ds1, $meto_ds2);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$bus_avg = calculerMoyenne($bus_td, $bus_exam);
$conj_avg = calculerMoyenne($conj_td, $conj_exam);
$mar_avg = calculerMoyenne($mar_td, $mar_exam);

// Coefficients et crédits
$coeffs = [1.5, 1.5, 2, 2, 2, 1, 1.5, 2, 1.5];
$credits = [3, 3, 4, 4, 4, 2, 3, 4, 3];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $ecointer_avg * $coeffs[0] +
    $ecoind_avg * $coeffs[1] +
    $ecomon_avg * $coeffs[2] +
    $stat_avg * $coeffs[3] +
    $meto_avg * $coeffs[4] +
    $ang_avg * $coeffs[5] +
    $bus_avg * $coeffs[6] +
    $conj_avg * $coeffs[7] +
    $mar_avg * $coeffs[8]
) / $total_coeff;

// Calcul des crédits obtenus
$total_credits = 0;
$matieres = [$ecointer_avg, $ecoind_avg, $ecomon_avg, $stat_avg, $meto_avg, $ang_avg, $bus_avg, $conj_avg, $mar_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Économie Internationale</td><td>" . number_format($ecointer_avg, 2) . "</td></tr>";
echo "<tr><td>Économie Industrielle</td><td>" . number_format($ecoind_avg, 2) . "</td></tr>";
echo "<tr><td>Économie Monétaire</td><td>" . number_format($ecomon_avg, 2) . "</td></tr>";
echo "<tr><td>Statistique Inférentielle</td><td>" . number_format($stat_avg, 2) . "</td></tr>";
echo "<tr><td>Méthodologie d'élaboration d'un rapport de stage</td><td>" . number_format($meto_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Business Model</td><td>" . number_format($bus_avg, 2) . "</td></tr>";
echo "<tr><td>Conjoncture et Cycles Économiques</td><td>" . number_format($conj_avg, 2) . "</td></tr>";
echo "<tr><td>Marchés Financiers et Évaluation des Actifs Financiers</td><td>" . number_format($mar_avg, 2) . "</td></tr>";
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
