<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php

// Récupération des notes depuis le formulaire
$algo_exam = $_POST['algo_exam'];
$algo_td = $_POST['algo_td'];
$algo_tp = $_POST['algo_tp'];

$exp_exam = $_POST['exp_exam'];
$exp_ds1 = $_POST['exp_ds1'];

$log_exam = $_POST['log_exam'];
$log_ds1 = $_POST['log_ds1'];

$anal_exam = $_POST['anal_exam'];
$anal_ds1 = $_POST['anal_ds1'];

$stat_exam = $_POST['stat_exam'];
$stat_ds1 = $_POST['stat_ds1'];

$pg_exam = $_POST['pg_exam'];
$pg_ds1 = $_POST['pg_ds1'];

$compta_ds1 = $_POST['compta_ds1'];
$compta_exam = $_POST['compta_exam'];

$dev_tp = $_POST['dev_tp'];
$dev_ds1 = $_POST['dev_ds1'];
$dev_ds2 = $_POST['dev_ds2'];

$org_ds1 = $_POST['org_ds1'];
$org_ds2 = $_POST['org_ds2'];

$num_ds1 = $_POST['num_ds1'];
$num_ds2 = $_POST['num_ds2'];

$bus_ds1 = $_POST['bus_ds1'];
$bus_ds2 = $_POST['bus_ds2'];

$eco_ds1 = $_POST['eco_ds1'];
$eco_ds2 = $_POST['eco_ds2'];

// Formules de calcul des moyennes
$algo_avg = $algo_td * 0.1 + $algo_tp * 0.2 + $algo_exam * 0.7;
$exp_avg = $exp_ds1 * 0.3 + $exp_exam * 0.7;
$log_avg = $log_ds1 * 0.3 + $log_exam * 0.7;
$anal_avg = $anal_ds1 * 0.3 + $anal_exam * 0.7;
$stat_avg = $stat_ds1 * 0.3 + $stat_exam * 0.7;
$pg_avg = $pg_ds1 * 0.3 + $pg_exam * 0.7;
$compta_avg = $compta_ds1 * 0.3 + $compta_exam * 0.7;
$dev_avg = $dev_tp * 0.2 + $dev_ds1 * 0.4 + $dev_ds2 * 0.4;
$org_avg = $org_ds1 * 0.5 + $org_ds2 * 0.5;
$num_avg = $num_ds1 * 0.5 + $num_ds2 * 0.5;
$bus_avg = $bus_ds1 * 0.5 + $bus_ds2 * 0.5;
$eco_avg = $eco_ds1 * 0.5 + $eco_ds2 * 0.5;

// Crédits accordés pour chaque matière
$algo_credits = ($algo_avg >= 10) ? 3 * 2 : 0;
$exp_credits = ($exp_avg >= 10) ? 1 * 2 : 0;
$log_credits = ($log_avg >= 10) ? 1 * 2 : 0;
$anal_credits = ($anal_avg >= 10) ? 1 * 2 : 0;
$stat_credits = ($stat_avg >= 10) ? 1 * 2 : 0;
$pg_credits = ($pg_avg >= 10) ? 1 * 2 : 0;
$compta_credits = ($compta_avg >= 10) ? 1 * 2 : 0;
$dev_credits = ($dev_avg >= 10) ? 2 * 2 : 0;
$org_credits = ($org_avg >= 10) ? 1 * 2 : 0;
$num_credits = ($num_avg >= 10) ? 1 * 2 : 0;
$bus_credits = ($bus_avg >= 10) ? 1 * 2 : 0;
$eco_credits = ($eco_avg >= 10) ? 1 * 2 : 0;

// Coefficients des matières
$algo_coeff = 3;
$exp_coeff = 1;
$log_coeff = 1;
$anal_coeff = 1;
$stat_coeff = 1;
$pg_coeff = 1;
$compta_coeff = 1;
$dev_coeff = 2;
$org_coeff = 1;
$num_coeff = 1;
$bus_coeff = 1;
$eco_coeff = 1;

// Moyenne générale pondérée
$total_coeff = $algo_coeff + $exp_coeff + $log_coeff + $anal_coeff + $stat_coeff + $pg_coeff + $compta_coeff + $dev_coeff + $org_coeff + $num_coeff + $bus_coeff + $eco_coeff;
$general_avg = ($algo_avg * $algo_coeff + $exp_avg * $exp_coeff + $log_avg * $log_coeff + $anal_avg * $anal_coeff + $stat_avg * $stat_coeff + $pg_avg * $pg_coeff + $compta_avg * $compta_coeff + $dev_avg * $dev_coeff + $org_avg * $org_coeff + $num_avg * $num_coeff + $bus_avg * $bus_coeff + $eco_avg * $eco_coeff) / $total_coeff;

// Total des crédits
$total_credits = $algo_credits + $exp_credits + $log_credits + $anal_credits + $stat_credits + $pg_credits + $compta_credits + $dev_credits + $org_credits + $num_credits + $bus_credits + $eco_credits;

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Algorithmique et structure de données 1</td><td>" . number_format($algo_avg, 2) . "</td></tr>";
echo "<tr><td>Systèmes d’exploitation</td><td>" . number_format($exp_avg, 2) . "</td></tr>";
echo "<tr><td>Systèmes logiques et architecture des ordinateurs</td><td>" . number_format($log_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse</td><td>" . number_format($anal_avg, 2) . "</td></tr>";
echo "<tr><td>Statistiques et Probabilité</td><td>" . number_format($stat_avg, 2) . "</td></tr>";
echo "<tr><td>Principes de Gestion</td><td>" . number_format($pg_avg, 2) . "</td></tr>";
echo "<tr><td>Comptabilité générale</td><td>" . number_format($compta_avg, 2) . "</td></tr>";
echo "<tr><td>Développement IHM</td><td>" . number_format($dev_avg, 2) . "</td></tr>";
echo "<tr><td>Organisation de l’Entreprise</td><td>" . number_format($org_avg, 2) . "</td></tr>";
echo "<tr><td>Compétences Numériques</td><td>" . number_format($num_avg, 2) . "</td></tr>";
echo "<tr><td>Business Communication</td><td>" . number_format($bus_avg, 2) . "</td></tr>";
echo "<tr><td>Culture d’entreprise</td><td>" . number_format($eco_avg, 2) . "</td></tr>";
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