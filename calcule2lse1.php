<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php
// Fonction pour convertir les virgules en points
function sanitize_input($input) {
    return number_format(floatval(str_replace(',', '.', $input)), 2);
}

// Récupération et conversion des notes
$met_ds1 = sanitize_input($_POST['met_ds1']);
$met_ds2 = sanitize_input($_POST['met_ds2']);

$cc_td = sanitize_input($_POST['cc_td']);
$cc_ds1 = sanitize_input($_POST['cc_ds1']);
$cc_ds2 = sanitize_input($_POST['cc_ds2']);

$comm_ds1 = sanitize_input($_POST['comm_ds1']);
$comm_exam = sanitize_input($_POST['comm_exam']);

$cul_ds1 = sanitize_input($_POST['cul_ds1']);
$cul_exam = sanitize_input($_POST['cul_exam']);

$mic_td = sanitize_input($_POST['mic_td']);
$mic_exam = sanitize_input($_POST['mic_exam']);

$mac_td = sanitize_input($_POST['mac_td']);
$mac_exam = sanitize_input($_POST['mac_exam']);

$hist_td = sanitize_input($_POST['hist_td']);
$hist_exam = sanitize_input($_POST['hist_exam']);

$fran_td = sanitize_input($_POST['fran_td']);
$fran_exam = sanitize_input($_POST['fran_exam']);

$ang_td = sanitize_input($_POST['ang_td']);
$ang_exam = sanitize_input($_POST['ang_exam']);

$stat_td = sanitize_input($_POST['stat_td']);
$stat_exam = sanitize_input($_POST['stat_exam']);

// Formules de calcul des moyennes
$met_avg = number_format($met_ds1 * 0.5 + $met_ds2 * 0.5, 2);
$cc_avg = number_format($cc_td * 0.2 + $cc_ds1 * 0.4 + $cc_ds2 * 0.4, 2);
$comm_avg = number_format($comm_ds1 * 0.3 + $comm_exam * 0.7, 2);
$cul_avg = number_format($cul_ds1 * 0.3 + $cul_exam * 0.7, 2);
$mic_avg = number_format($mic_td * 0.3 + $mic_exam * 0.7, 2);
$mac_avg = number_format($mac_td * 0.3 + $mac_exam * 0.7, 2);
$hist_avg = number_format($hist_td * 0.3 + $hist_exam * 0.7, 2);
$fran_avg = number_format($fran_td * 0.3 + $fran_exam * 0.7, 2);
$ang_avg = number_format($ang_td * 0.3 + $ang_exam * 0.7, 2);
$stat_avg = number_format($stat_td * 0.3 + $stat_exam * 0.7, 2);

// Vérification des crédits (≥10)
$met_credits = ($met_avg >= 10) ? 2 : 0;
$cc_credits = ($cc_avg >= 10) ? 3 : 0;
$mic_credits = ($mic_avg >= 10) ? 5 : 0;
$mac_credits = ($mac_avg >= 10) ? 4 : 0;
$hist_credits = ($hist_avg >= 10) ? 4 : 0;
$fran_credits = ($fran_avg >= 10) ? 1.5 : 0;
$ang_credits = ($ang_avg >= 10) ? 1.5 : 0;
$cul_credits = ($cul_avg >= 10) ? 2 : 0;
$comm_credits = ($comm_avg >= 10) ? 4 : 0;
$stat_credits = ($stat_avg >= 10) ? 3 : 0;

// Coefficients
$met_coeff = 1;
$cc_coeff = 1.5;
$mic_coeff = 2.5;
$mac_coeff = 2;
$hist_coeff = 2;
$fran_coeff = 0.75;
$ang_coeff = 0.75;
$cul_coeff = 1;
$comm_coeff = 2;
$stat_coeff = 1.5;

// Moyenne générale pondérée
$total_coeff = $met_coeff + $cc_coeff + $mic_coeff + $mac_coeff + $hist_coeff + $fran_coeff + $ang_coeff + $cul_coeff + $comm_coeff + $stat_coeff;

$general_avg = number_format((
    $met_avg * $met_coeff +
    $cc_avg * $cc_coeff +
    $mic_avg * $mic_coeff +
    $mac_avg * $mac_coeff +
    $hist_avg * $hist_coeff +
    $fran_avg * $fran_coeff +
    $ang_avg * $ang_coeff +
    $cul_avg * $cul_coeff +
    $comm_avg * $comm_coeff +
    $stat_avg * $stat_coeff
) / $total_coeff, 2);

// Total des crédits
$total_credits = $met_credits + $cc_credits + $mic_credits + $mac_credits + $hist_credits + $fran_credits + $ang_credits + $cul_credits + $comm_credits + $stat_credits;

// Affichage des résultats
echo '<h1>Résultats Académiques </h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Les métiers de l'économiste</td><td>$met_avg</td></tr>";
echo "<tr><td>Conférences carrières</td><td>$cc_avg</td></tr>";
echo "<tr><td>Microéconomie 2</td><td>$mic_avg</td></tr>";
echo "<tr><td>Macroeconomie 2</td><td>$mac_avg</td></tr>";
echo "<tr><td>Histoire des faits et de la pensée économique</td><td>$hist_avg</td></tr>";
echo "<tr><td>Français 3</td><td>$fran_avg</td></tr>";
echo "<tr><td>Anglais 3</td><td>$ang_avg</td></tr>";
echo "<tr><td>Culture entrepreneuriale</td><td>$cul_avg</td></tr>";
echo "<tr><td>Commerce et marchés extérieurs</td><td>$comm_avg</td></tr>";
echo "<tr><td>Statistique appliquée</td><td>$stat_avg</td></tr>";
echo '</table>';

echo '<div class="result-summary">';
echo "<p><strong>Moyenne Générale :</strong> $general_avg</p>";
if ($general_avg > 10) {
    echo "<img src='3-unscreen.gif' width='240' height='160' alt='Animation positive'>";
} else {
    echo "<img src='2-unscreen.gif' width='240' height='160' alt='Animation négative'>";
}
echo "<p><strong>Total des Crédits Obtenus :</strong> $total_credits</p>";
echo '</div>';
?>