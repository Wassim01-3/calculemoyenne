<html lang="en">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$rh_td = (float)$_POST['rh_td'];
$rh_exam = (float)$_POST['rh_exam'];
$diag_td = (float)$_POST['diag_td'];
$diag_exam = (float)$_POST['diag_exam'];
$gp_td = (float)$_POST['gp_td'];
$gp_exam = (float)$_POST['gp_exam'];
$sta_ds1 = (float)$_POST['sta_ds1'];
$sta_ds2 = (float)$_POST['sta_ds2'];
$ang_td = (float)$_POST['ang_td'];
$ang_exam = (float)$_POST['ang_exam'];
$dev_td = (float)$_POST['dev_td'];
$dev_exam = (float)$_POST['dev_exam'];
$marc_td = (float)$_POST['marc_td'];
$marc_exam = (float)$_POST['marc_exam'];
$bus_td = (float)$_POST['bus_td'];
$bus_exam = (float)$_POST['bus_exam'];

// Formule unique pour le calcul des moyennes sauf pour "Méthodologie d'Elaboration d'un rapport de stage"
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Formule spécifique pour "Méthodologie d'Elaboration d'un rapport de stage"
function calculerMoyenneStage($ds1, $ds2) {
    return $ds1 * 0.5 + $ds2 * 0.5;
}

// Calcul des moyennes
$rh_avg = calculerMoyenne($rh_td, $rh_exam);
$diag_avg = calculerMoyenne($diag_td, $diag_exam);
$gp_avg = calculerMoyenne($gp_td, $gp_exam);
$sta_avg = calculerMoyenneStage($sta_ds1, $sta_ds2);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$dev_avg = calculerMoyenne($dev_td, $dev_exam);
$marc_avg = calculerMoyenne($marc_td, $marc_exam);
$bus_avg = calculerMoyenne($bus_td, $bus_exam);

// Coefficients
$coeffs = [2.5, 2.5, 2.5, 2.5, 1, 1.5, 1.5, 1];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $rh_avg * $coeffs[0] +
    $diag_avg * $coeffs[1] +
    $gp_avg * $coeffs[2] +
    $sta_avg * $coeffs[3] +
    $ang_avg * $coeffs[4] +
    $dev_avg * $coeffs[5] +
    $marc_avg * $coeffs[6] +
    $bus_avg * $coeffs[7]
) / $total_coeff;

// Crédits
$credits = [5, 5, 5, 5, 2, 3, 3, 2];
$total_credits = 0;
$matieres = [$rh_avg, $diag_avg, $gp_avg, $sta_avg, $ang_avg, $dev_avg, $marc_avg, $bus_avg];

foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Fondamentaux de la GRH</td><td>" . number_format($rh_avg, 2) . "</td></tr>";
echo "<tr><td>Diagnostic Financier</td><td>" . number_format($diag_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de la production</td><td>" . number_format($gp_avg, 2) . "</td></tr>";
echo "<tr><td>Méthodologie d'Elaboration d'un rapport de stage</td><td>" . number_format($sta_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Développement personnel</td><td>" . number_format($dev_avg, 2) . "</td></tr>";
echo "<tr><td>Marchés de capitaux et instruments financiers</td><td>" . number_format($marc_avg, 2) . "</td></tr>";
echo "<tr><td>E-Business</td><td>" . number_format($bus_avg, 2) . "</td></tr>";
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
