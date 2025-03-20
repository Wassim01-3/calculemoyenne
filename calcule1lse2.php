<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php


// Récupération des notes depuis le formulaire
$micro_td = (float)$_POST['micro_td'];
$micro_exam = (float)$_POST['micro_exam'];

$macro_td = (float)$_POST['macro_td'];
$macro_exam = (float)$_POST['macro_exam'];

$compta_td = (float)$_POST['compta_td'];
$compta_exam = (float)$_POST['compta_exam'];

$algebre_td = (float)$_POST['algebre_td'];
$algebre_exam = (float)$_POST['algebre_exam'];

$droit_td = (float)$_POST['droit_td'];
$droit_exam = (float)$_POST['droit_exam'];

$fran_td = (float)$_POST['fran_td'];
$fran_exam = (float)$_POST['fran_exam'];

$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];

$web_td = (float)$_POST['web_td'];
$web_exam = (float)$_POST['web_exam'];

// Formule unique pour le calcul des moyennes 
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$micro_avg = calculerMoyenne($micro_td, $micro_exam);
$macro_avg = calculerMoyenne($macro_td, $macro_exam);
$compta_avg = calculerMoyenne($compta_td, $compta_exam);
$algebre_avg = calculerMoyenne($algebre_td, $algebre_exam);
$droit_avg = calculerMoyenne($droit_td, $droit_exam);
$fran_avg = calculerMoyenne($fran_td, $fran_exam);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$web_avg = calculerMoyenne($web_td, $web_exam);

// Coefficients
$coeffs = [
    3, 2.5, 2.5, 2.5, 2, 0.75, 0.75, 1
];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $micro_avg * $coeffs[0] +
    $macro_avg * $coeffs[1] +
    $compta_avg * $coeffs[2] +
    $algebre_avg * $coeffs[3] +
    $droit_avg * $coeffs[4] +
    $fran_avg * $coeffs[5] +
    $ang_avg * $coeffs[6] +
    $web_avg * $coeffs[7]
) / $total_coeff;

// Crédits
$credits = [
    6, 5, 5, 5, 4, 1.5, 1.5, 2
];
$total_credits = 0;
$matieres = [$micro_avg, $macro_avg, $compta_avg, $algebre_avg, $droit_avg, $fran_avg, $ang_avg, $web_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Microéconomie 1</td><td>" . number_format($micro_avg, 2) . "</td></tr>";
echo "<tr><td>Macroéconomie 1</td><td>" . number_format($macro_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité Financière 2</td><td>" . number_format($compta_avg, 2) . "</td></tr>";
echo "<tr><td>Algèbre</td><td>" . number_format($algebre_avg, 2) . "</td></tr>";
echo "<tr><td>Principes de Droit</td><td>" . number_format($droit_avg, 2) . "</td></tr>";
echo "<tr><td>Français 2</td><td>" . number_format($fran_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais 2</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Internet et Web</td><td>" . number_format($web_avg, 2) . "</td></tr>";
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