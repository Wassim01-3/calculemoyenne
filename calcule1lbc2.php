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

$res_exam = $_POST['res_exam'];
$res_ds1 = $_POST['res_ds1'];

$si_exam = $_POST['si_exam'];
$si_ds1 = $_POST['si_ds1'];

$log_exam = $_POST['log_exam'];
$log_ds1 = $_POST['log_ds1'];

$gebr_exam = $_POST['gebr_exam'];
$gebr_ds1 = $_POST['gebr_ds1'];

$sic_exam = $_POST['sic_exam'];
$sic_ds1 = $_POST['sic_ds1'];

$gf_exam = $_POST['gf_exam'];
$gf_ds1 = $_POST['gf_ds1'];

$ihm_tp = $_POST['ihm_tp'];
$ihm_ds1 = $_POST['ihm_ds1'];
$ihm_ds2 = $_POST['ihm_ds2'];

$ci_ds1 = $_POST['ci_ds1'];
$ci_ds2 = $_POST['ci_ds2'];

$bus_td = $_POST['bus_td'];
$bus_ds1 = $_POST['bus_ds1'];
$bus_ds2 = $_POST['bus_ds2'];

$cre_td = $_POST['cre_td'];
$cre_ds1 = $_POST['cre_ds1'];
$cre_ds2 = $_POST['cre_ds2'];

// Formules de calcul des moyennes
$algo_avg = $algo_td * 0.1 + $algo_tp * 0.2 + $algo_exam * 0.7;
$res_avg = $res_ds1 * 0.3 + $res_exam * 0.7;
$si_avg = $si_ds1 * 0.3 + $si_exam * 0.7;
$log_avg = $log_ds1 * 0.3 + $log_exam * 0.7;
$gebr_avg = $gebr_ds1 * 0.3 + $gebr_exam * 0.7;
$sic_avg = $sic_ds1 * 0.3 + $sic_exam * 0.7;
$gf_avg = $gf_ds1 * 0.3 + $gf_exam * 0.7;
$ihm_avg = $ihm_tp * 0.2 + $ihm_ds1 * 0.4 + $ihm_ds2 * 0.4;
$ci_avg = $ci_ds1 * 0.5 + $ci_ds2 * 0.5;
$bus_avg = $bus_td * 0.2 + $bus_ds1 * 0.4 + $bus_ds2 * 0.4;
$cre_avg = $cre_td * 0.2 + $cre_ds1 * 0.4 + $cre_ds2 * 0.4;

// Crédits accordés pour chaque matière (coefficient * 2)
$algo_credits = ($algo_avg >= 10) ? 3 * 2 : 0;
$res_credits = ($res_avg >= 10) ? 1 * 2 : 0;
$si_credits = ($si_avg >= 10) ? 1 * 2 : 0;
$log_credits = ($log_avg >= 10) ? 1 * 2 : 0;
$gebr_credits = ($gebr_avg >= 10) ? 1 * 2 : 0;
$sic_credits = ($sic_avg >= 10) ? 1 * 2 : 0;
$gf_credits = ($gf_avg >= 10) ? 1 * 2 : 0;
$ihm_credits = ($ihm_avg >= 10) ? 2 * 2 : 0;
$ci_credits = ($ci_avg >= 10) ? 1 * 2 : 0;
$bus_credits = ($bus_avg >= 10) ? 1 * 2 : 0;
$cre_credits = ($cre_avg >= 10) ? 1 * 2 : 0;

// Coefficients des matières
$total_coeff = 3 + 1 + 1 + 1 + 1 + 1 + 1 + 2 + 1 + 1 + 1;

// Moyenne générale pondérée
$general_avg = ($algo_avg * 3 + $res_avg * 1 + $si_avg * 1 + $log_avg * 1 + $gebr_avg * 1 + $sic_avg * 1 + $gf_avg * 1 + $ihm_avg * 2 + $ci_avg * 1 + $bus_avg * 1 + $cre_avg * 1) / $total_coeff;

// Total des crédits
$total_credits = $algo_credits + $res_credits + $si_credits + $log_credits + $gebr_credits + $sic_credits + $gf_credits + $ihm_credits + $ci_credits + $bus_credits + $cre_credits;

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Algorithmique et structure de données 2</td><td>" . number_format($algo_avg, 2) . "</td></tr>";
echo "<tr><td>Fondements de réseaux</td><td>" . number_format($res_avg, 2) . "</td></tr>";
echo "<tr><td>Introduction aux systèmes d’information</td><td>" . number_format($si_avg, 2) . "</td></tr>";
echo "<tr><td>Logique mathématique</td><td>" . number_format($log_avg, 2) . "</td></tr>";
echo "<tr><td>Algèbre</td><td>" . number_format($gebr_avg, 2) . "</td></tr>";
echo "<tr><td>Le système d’information comptable</td><td>" . number_format($sic_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion financière</td><td>" . number_format($gf_avg, 2) . "</td></tr>";
echo "<tr><td>Framework IHM</td><td>" . number_format($ihm_avg, 2) . "</td></tr>";
echo "<tr><td>Contrôle Interne</td><td>" . number_format($ci_avg, 2) . "</td></tr>";
echo "<tr><td>Business Communication 2</td><td>" . number_format($bus_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques de Créativité</td><td>" . number_format($cre_avg, 2) . "</td></tr>";
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
