<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php
// Récupération des notes depuis le formulaire
$pg_td = (float)$_POST['pg_td'];
$pg_exam = (float)$_POST['pg_exam'];

$compta_td = (float)$_POST['compta_td'];
$compta_exam = (float)$_POST['compta_exam'];

$math_td = (float)$_POST['math_td'];
$math_exam = (float)$_POST['math_exam'];

$stat_td = (float)$_POST['stat_td'];
$stat_exam = (float)$_POST['stat_exam'];

$mac_td = (float)$_POST['mac_td'];
$mac_exam = (float)$_POST['mac_exam'];

$dr_td = (float)$_POST['dr_td'];
$dr_exam = (float)$_POST['dr_exam'];

$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];

$info_td = (float)$_POST['info_td'];
$info_exam = (float)$_POST['info_exam'];

// Formule unique pour le calcul des moyennes 
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$pg_avg = calculerMoyenne($pg_td, $pg_exam);
$compta_avg = calculerMoyenne($compta_td, $compta_exam);
$math_avg = calculerMoyenne($math_td, $math_exam);
$stat_avg = calculerMoyenne($stat_td, $stat_exam);
$mac_avg = calculerMoyenne($mac_td, $mac_exam);
$dr_avg = calculerMoyenne($dr_td, $dr_exam);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$info_avg = calculerMoyenne($info_td, $info_exam);

// Coefficients
$coeffs = [
    2.5, 2.5, 2.5, 2.5, 1.5, 1, 1, 1.5
];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $pg_avg * $coeffs[0] +
    $compta_avg * $coeffs[1] +
    $math_avg * $coeffs[2] +
    $stat_avg * $coeffs[3] +
    $mac_avg * $coeffs[4] +
    $dr_avg * $coeffs[5] +
    $ang_avg * $coeffs[6] +
    $info_avg * $coeffs[7]
) / $total_coeff;

// Crédits
$credits = [
    5, 5, 5, 5, 3, 2, 2, 3
];
$total_credits = 0;
$matieres = [$pg_avg, $compta_avg, $math_avg, $stat_avg, $mac_avg, $dr_avg, $ang_avg, $info_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Principes de Gestion</td><td>" . number_format($pg_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité Financière 2</td><td>" . number_format($compta_avg, 2) . "</td></tr>";
echo "<tr><td>Mathématique 2</td><td>" . number_format($math_avg, 2) . "</td></tr>";
echo "<tr><td>Statistique Descriptive et Calculs de Probabilité</td><td>" . number_format($stat_avg, 2) . "</td></tr>";
echo "<tr><td>Macroéconomie</td><td>" . number_format($mac_avg, 2) . "</td></tr>";
echo "<tr><td>Droit des Sociétés Commerciales</td><td>" . number_format($dr_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais 2</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Internet et Web</td><td>" . number_format($info_avg, 2) . "</td></tr>";
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
