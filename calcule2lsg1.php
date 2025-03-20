<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$manag_td = (float)$_POST['manag_td'];
$manag_exam = (float)$_POST['manag_exam'];

$compta_td = (float)$_POST['compta_td'];
$compta_exam = (float)$_POST['compta_exam'];

$mark_td = (float)$_POST['mark_td'];
$mark_exam = (float)$_POST['mark_exam'];

$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];

$cult_td = (float)$_POST['cult_td'];
$cult_exam = (float)$_POST['cult_exam'];

$conf_ds1 = (float)$_POST['conf_ds1'];
$conf_ds2 = (float)$_POST['conf_ds2'];

$stat_td = (float)$_POST['stat_td'];
$stat_exam = (float)$_POST['stat_exam'];

$fisc_td = (float)$_POST['fisc_td'];
$fisc_exam = (float)$_POST['fisc_exam'];

// Fonction pour calculer les moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

function calculerMoyenneConf($ds1, $ds2) {
    return $ds1 * 0.5 + $ds2 * 0.5;
}

// Calcul des moyennes
$manag_avg = calculerMoyenne($manag_td, $manag_exam);
$compta_avg = calculerMoyenne($compta_td, $compta_exam);
$mark_avg = calculerMoyenne($mark_td, $mark_exam);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$cult_avg = calculerMoyenne($cult_td, $cult_exam);
$conf_avg = calculerMoyenneConf($conf_ds1, $conf_ds2);
$stat_avg = calculerMoyenne($stat_td, $stat_exam);
$fisc_avg = calculerMoyenne($fisc_td, $fisc_exam);

// Coefficients
$coeffs = [2.5, 2.5, 2.5, 1, 1.5, 2.5, 1, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $manag_avg * $coeffs[0] +
    $compta_avg * $coeffs[1] +
    $mark_avg * $coeffs[2] +
    $ang_avg * $coeffs[3] +
    $cult_avg * $coeffs[4] +
    $conf_avg * $coeffs[5] +
    $stat_avg * $coeffs[6] +
    $fisc_avg * $coeffs[7]
) / $total_coeff;

// Crédits
$credits = [5, 5, 5, 2, 3, 5, 2, 3];
$total_credits = 0;
$matieres = [$manag_avg, $compta_avg, $mark_avg, $ang_avg, $cult_avg, $conf_avg, $stat_avg, $fisc_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Fondamentaux du Management</td><td>" . number_format($manag_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité de gestion</td><td>" . number_format($compta_avg, 2) . "</td></tr>";
echo "<tr><td>Fondamentaux du Marketing</td><td>" . number_format($mark_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Culture d'entreprise</td><td>" . number_format($cult_avg, 2) . "</td></tr>";
echo "<tr><td>Conférence et journées thématiques</td><td>" . number_format($conf_avg, 2) . "</td></tr>";
echo "<tr><td>Statistique Inférentielle</td><td>" . number_format($stat_avg, 2) . "</td></tr>";
echo "<tr><td>Fiscalité</td><td>" . number_format($fisc_avg, 2) . "</td></tr>";
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
