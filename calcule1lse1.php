<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php

// Récupération des notes depuis le formulaire
$pe_td = (float)$_POST['pe_td'];
$pe_exam = (float)$_POST['pe_exam'];

$pg_td = (float)$_POST['pg_td'];
$pg_exam = (float)$_POST['pg_exam'];

$compta_td = (float)$_POST['compta_td'];
$compta_exam = (float)$_POST['compta_exam'];

$anal_td = (float)$_POST['anal_td'];
$anal_exam = (float)$_POST['anal_exam'];

$stat_td = (float)$_POST['stat_td'];
$stat_exam = (float)$_POST['stat_exam'];

$fran_td = (float)$_POST['fran_td'];
$fran_exam = (float)$_POST['fran_exam'];

$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];

$inf_td = (float)$_POST['inf_td'];
$inf_exam = (float)$_POST['inf_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$pe_avg = calculerMoyenne($pe_td, $pe_exam);
$pg_avg = calculerMoyenne($pg_td, $pg_exam);
$compta_avg = calculerMoyenne($compta_td, $compta_exam);
$anal_avg = calculerMoyenne($anal_td, $anal_exam);
$stat_avg = calculerMoyenne($stat_td, $stat_exam);
$fran_avg = calculerMoyenne($fran_td, $fran_exam);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$inf_avg = calculerMoyenne($inf_td, $inf_exam);

// Coefficients
$fran_coeff = 0.75;
$ang_coeff = 0.75;
$inf_coeff = 1;
$other_coeff = 2.5;

// Crédits
$fran_credits = ($fran_avg >= 10) ? 1.5 : 0;
$ang_credits = ($ang_avg >= 10) ? 1.5 : 0;
$inf_credits = ($inf_avg >= 10) ? 2 : 0;
$other_credits = function($avg) {
    return ($avg >= 10) ? 5 : 0;
};

// Moyenne générale pondérée
$total_coeff = $fran_coeff + $ang_coeff + $inf_coeff + $other_coeff * 5;
$general_avg = (
    $fran_avg * $fran_coeff +
    $ang_avg * $ang_coeff +
    $inf_avg * $inf_coeff +
    $pe_avg * $other_coeff +
    $pg_avg * $other_coeff +
    $compta_avg * $other_coeff +
    $anal_avg * $other_coeff +
    $stat_avg * $other_coeff
) / $total_coeff;

// Total des crédits
$total_credits = $fran_credits + $ang_credits + $inf_credits +
    $other_credits($pe_avg) +
    $other_credits($pg_avg) +
    $other_credits($compta_avg) +
    $other_credits($anal_avg) +
    $other_credits($stat_avg);

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Principes d'économie</td><td>" . number_format($pe_avg, 2) . "</td></tr>";
echo "<tr><td>Principes de gestion</td><td>" . number_format($pg_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité financière 1</td><td>" . number_format($compta_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse</td><td>" . number_format($anal_avg, 2) . "</td></tr>";
echo "<tr><td>Statistique descriptive</td><td>" . number_format($stat_avg, 2) . "</td></tr>";
echo "<tr><td>Français</td><td>" . number_format($fran_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Produits Microsoft</td><td>" . number_format($inf_avg, 2) . "</td></tr>";
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