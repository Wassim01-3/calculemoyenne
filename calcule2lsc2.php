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
$inter_exam = (float)$_POST['inter_exam'];
$inter_td = (float)$_POST['inter_td'];
$cont_exam = (float)$_POST['cont_exam'];
$cont_td = (float)$_POST['cont_td'];
$tva_exam = (float)$_POST['tva_exam'];
$tva_td = (float)$_POST['tva_td'];
$sta_ds1 = (float)$_POST['sta_ds1'];
$sta_ds2 = (float)$_POST['sta_ds2'];
$ang_exam = (float)$_POST['ang_exam'];
$ang_td = (float)$_POST['ang_td'];
$dev_exam = (float)$_POST['dev_exam'];
$dev_td = (float)$_POST['dev_td'];
$diag_exam = (float)$_POST['diag_exam'];
$diag_td = (float)$_POST['diag_td'];
$eva_exam = (float)$_POST['eva_exam'];
$eva_td = (float)$_POST['eva_td'];

// Formules pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

function calculerMoyenneMERS($ds1, $ds2) {
    return $ds1 * 0.5 + $ds2 * 0.5;
}

// Calcul des moyennes pour chaque matière
$inter_avg = calculerMoyenne($inter_td, $inter_exam);
$cont_avg = calculerMoyenne($cont_td, $cont_exam);
$tva_avg = calculerMoyenne($tva_td, $tva_exam);
$sta_avg = calculerMoyenneMERS($sta_ds1, $sta_ds2);
$ang_avg = calculerMoyenne($ang_td, $ang_exam);
$dev_avg = calculerMoyenne($dev_td, $dev_exam);
$diag_avg = calculerMoyenne($diag_td, $diag_exam);
$eva_avg = calculerMoyenne($eva_td, $eva_exam);

// Coefficients
$coeffs = [2.5, 2.5, 2.5, 2.5, 1, 1.5, 1.5, 1];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $inter_avg * $coeffs[0] +
    $cont_avg * $coeffs[1] +
    $tva_avg * $coeffs[2] +
    $sta_avg * $coeffs[3] +
    $ang_avg * $coeffs[4] +
    $dev_avg * $coeffs[5] +
    $diag_avg * $coeffs[6] +
    $eva_avg * $coeffs[7]
) / $total_coeff;

// Crédits
$credits = [5, 5, 5, 5, 2, 3, 3, 2];
$total_credits = 0;
$matieres = [$inter_avg, $cont_avg, $tva_avg, $sta_avg, $ang_avg, $dev_avg, $diag_avg, $eva_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Comptabilité Intermédiaire 2</td><td>" . number_format($inter_avg, 2) . "</td></tr>";
echo "<tr><td>Contrôle Interne</td><td>" . number_format($cont_avg, 2) . "</td></tr>";
echo "<tr><td>TVA et Droit de Consommation</td><td>" . number_format($tva_avg, 2) . "</td></tr>";
echo "<tr><td>Méthodologie d'Élaboration d'un Stage - MERS</td><td>" . number_format($sta_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais</td><td>" . number_format($ang_avg, 2) . "</td></tr>";
echo "<tr><td>Développement Personnel 1</td><td>" . number_format($dev_avg, 2) . "</td></tr>";
echo "<tr><td>Diagnostic Financier</td><td>" . number_format($diag_avg, 2) . "</td></tr>";
echo "<tr><td>Évaluation de l’Entreprise</td><td>" . number_format($eva_avg, 2) . "</td></tr>";
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
