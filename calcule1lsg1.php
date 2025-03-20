<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php
// Récupération des notes depuis le formulaire
$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];

$inf_td = (float)$_POST['inf_td'];
$inf_exam = (float)$_POST['inf_exam'];

$pg_td = (float)$_POST['pg_td'];
$pg_exam = (float)$_POST['pg_exam'];

$compta_td = (float)$_POST['compta_td'];
$compta_exam = (float)$_POST['compta_exam'];

$mic_td = (float)$_POST['mic_td'];
$mic_exam = (float)$_POST['mic_exam'];

$math_td = (float)$_POST['math_td'];
$math_exam = (float)$_POST['math_exam'];

$dr_td = (float)$_POST['dr_td'];
$dr_exam = (float)$_POST['dr_exam'];

$fin_td = (float)$_POST['fin_td'];
$fin_exam = (float)$_POST['fin_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$inf_avg = calculerMoyenne($inf_td, $inf_exam);
$pg_avg = calculerMoyenne($pg_td, $pg_exam);
$compta_avg = calculerMoyenne($compta_td, $compta_exam);
$mic_avg = calculerMoyenne($mic_td, $mic_exam);
$math_avg = calculerMoyenne($math_td, $math_exam);
$dr_avg = calculerMoyenne($dr_td, $dr_exam);
$fin_avg = calculerMoyenne($fin_td, $fin_exam);

// Coefficients
$coeffs = [
    1, 1.5, 2.5, 2.5, 2.5, 2.5, 1, 1.5
];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $ang_avg * $coeffs[0] +
    $inf_avg * $coeffs[1] +
    $pg_avg * $coeffs[2] +
    $compta_avg * $coeffs[3] +
    $mic_avg * $coeffs[4] +
    $math_avg * $coeffs[5] +
    $dr_avg * $coeffs[6] +
    $fin_avg * $coeffs[7]
) / $total_coeff;

// Crédits
$credits = [
    2, 3, 5, 5, 5, 5, 2, 3
];
$total_credits = 0;
$matieres = [$ang_avg, $inf_avg, $pg_avg, $compta_avg, $mic_avg, $math_avg, $dr_avg, $fin_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Anglais 1</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Produits Microsoft</td><td>" . number_format($inf_avg, 2) . "</td></tr>";
echo "<tr><td>Principes de Gestion</td><td>" . number_format($pg_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité Financière 1</td><td>" . number_format($compta_avg, 2) . "</td></tr>";
echo "<tr><td>Microéconomie</td><td>" . number_format($mic_avg, 2) . "</td></tr>";
echo "<tr><td>Mathématiques 1</td><td>" . number_format($math_avg, 2) . "</td></tr>";
echo "<tr><td>Introduction au Droit</td><td>" . number_format($dr_avg, 2) . "</td></tr>";
echo "<tr><td>Mathématiques Financières</td><td>" . number_format($fin_avg, 2) . "</td></tr>";
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
