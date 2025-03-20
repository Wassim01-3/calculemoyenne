<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>

<?php
// Récupération des notes depuis le formulaire
$ifrs_td = (float)$_POST['ifrs_td'];
$ifrs_exam = (float)$_POST['ifrs_exam'];
$audit_td = (float)$_POST['audit_td'];
$audit_exam = (float)$_POST['audit_exam'];
$df_td = (float)$_POST['df_td'];
$df_exam = (float)$_POST['df_exam'];
$pfe_td = (float)$_POST['pfe_td'];
$pfe_exam = (float)$_POST['pfe_exam'];
$aac_td = (float)$_POST['aac_td'];
$aac_exam = (float)$_POST['aac_exam'];
$lc_td = (float)$_POST['lc_td'];
$lc_exam = (float)$_POST['lc_exam'];
$tac_td = (float)$_POST['tac_td'];
$tac_exam = (float)$_POST['tac_exam'];
$caf_td = (float)$_POST['caf_td'];
$caf_exam = (float)$_POST['caf_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$ifrs_avg = calculerMoyenne($ifrs_td, $ifrs_exam);
$audit_avg = calculerMoyenne($audit_td, $audit_exam);
$df_avg = calculerMoyenne($df_td, $df_exam);
$pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
$aac_avg = calculerMoyenne($aac_td, $aac_exam);
$lc_avg = calculerMoyenne($lc_td, $lc_exam);
$tac_avg = calculerMoyenne($tac_td, $tac_exam);
$caf_avg = calculerMoyenne($caf_td, $caf_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [3, 2.5, 2.5, 2.5, 1, 1.5, 1, 1, 1];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $ifrs_avg * $coeffs[0] + $audit_avg * $coeffs[1] + $df_avg * $coeffs[2] + 
    $pfe_avg * $coeffs[3] + $aac_avg * $coeffs[4] + $lc_avg * $coeffs[5] + 
    $tac_avg * $coeffs[6] + $caf_avg * $coeffs[7] + $eep_avg * $coeffs[8]
) / $total_coeff;

// Crédits
$credits = [6, 5, 5, 5, 2, 3, 2, 2, 2];
$total_credits = 0;
$matieres = [$ifrs_avg, $audit_avg, $df_avg, $pfe_avg, $aac_avg, $lc_avg, $tac_avg, $caf_avg, $eep_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Comptabilité internationale: IFRS</td><td>" . number_format($ifrs_avg, 2) . "</td></tr>";
echo "<tr><td>Audit</td><td>" . number_format($audit_avg, 2) . "</td></tr>";
echo "<tr><td>Décisions financières</td><td>" . number_format($df_avg, 2) . "</td></tr>";
echo "<tr><td>Projet de fin d'études (PFE)</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais appliqué à la comptabilité 2</td><td>" . number_format($aac_avg, 2) . "</td></tr>";
echo "<tr><td>Logiciel de comptabilité</td><td>" . number_format($lc_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques d’analyse de la conjoncture</td><td>" . number_format($tac_avg, 2) . "</td></tr>";
echo "<tr><td>Contentieux et avantages fiscaux</td><td>" . number_format($caf_avg, 2) . "</td></tr>";
echo "<tr><td>Entreprise d’Entrainement Pédagogique</td><td>" . number_format($eep_avg, 2) . "</td></tr>";
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
