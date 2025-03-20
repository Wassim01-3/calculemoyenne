<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
    <title>Résultats Académiques</title>
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$inter_td = (float)$_POST['inter_td'];
$inter_exam = (float)$_POST['inter_exam'];
$compt_td = (float)$_POST['compt_td'];
$compt_exam = (float)$_POST['compt_exam'];
$irp_td = (float)$_POST['irp_td'];
$irp_exam = (float)$_POST['irp_exam'];
$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];
$cult_td = (float)$_POST['cult_td'];
$cult_exam = (float)$_POST['cult_exam'];
$conf_ds1 = (float)$_POST['conf_ds1'];
$conf_ds2 = (float)$_POST['conf_ds2'];
$dr_td = (float)$_POST['dr_td'];
$dr_exam = (float)$_POST['dr_exam'];
$tr_td = (float)$_POST['tr_td'];
$tr_exam = (float)$_POST['tr_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes pour toutes les matières sauf "Conférences et journées thématiques"
$inter_avg = calculerMoyenne($inter_td, $inter_exam);
$compt_avg = calculerMoyenne($compt_td, $compt_exam);
$irp_avg = calculerMoyenne($irp_td, $irp_exam);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$cult_avg = calculerMoyenne($cult_td, $cult_exam);
$dr_avg = calculerMoyenne($dr_td, $dr_exam);
$tr_avg = calculerMoyenne($tr_td, $tr_exam);

// Calcul spécial pour "Conférences et journées thématiques"
$conf_avg = $conf_ds1 * 0.5 + $conf_ds2 * 0.5;

// Coefficients
$coeffs = [2.5, 2.5, 2.5, 1, 1.5, 2.5, 1, 1.5];

// Moyennes des matières
$matieres = [$inter_avg, $compt_avg, $irp_avg, $ang_avg, $cult_avg, $conf_avg, $dr_avg, $tr_avg];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = 0;
foreach ($matieres as $index => $moyenne) {
    $general_avg += $moyenne * $coeffs[$index];
}
$general_avg /= $total_coeff;

// Crédits
$credits = [5, 5, 5, 2, 3, 5, 2, 3];
$total_credits = 0;
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Comptabilité Intermédiaire 1</td><td>" . number_format($inter_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité de Gestion</td><td>" . number_format($compt_avg, 2) . "</td></tr>";
echo "<tr><td>IRPP/IS</td><td>" . number_format($irp_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Culture d'entreprise</td><td>" . number_format($cult_avg, 2) . "</td></tr>";
echo "<tr><td>Conférences et journées thématiques</td><td>" . number_format($conf_avg, 2) . "</td></tr>";
echo "<tr><td>Droit privé des affaires</td><td>" . number_format($dr_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de trésorerie</td><td>" . number_format($tr_avg, 2) . "</td></tr>";
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
