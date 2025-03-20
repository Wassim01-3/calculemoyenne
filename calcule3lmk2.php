<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="calcule.css"> 
</head> 
<body>
<?php
// Récupération des notes depuis le formulaire
$sd_td = (float)$_POST['sd_td'];
$sd_exam = (float)$_POST['sd_exam'];
$cm_td = (float)$_POST['cm_td'];
$cm_exam = (float)$_POST['cm_exam'];
$adm_td = (float)$_POST['adm_td'];
$adm_exam = (float)$_POST['adm_exam'];
$pfe_td = (float)$_POST['pfe_td'];
$pfe_exam = (float)$_POST['pfe_exam'];
$aam_td = (float)$_POST['aam_td'];
$aam_exam = (float)$_POST['aam_exam'];
$olam_td = (float)$_POST['olam_td'];
$olam_exam = (float)$_POST['olam_exam'];
$mar_td = (float)$_POST['mar_td'];
$mar_exam = (float)$_POST['mar_exam'];
$wm_td = (float)$_POST['wm_td'];
$wm_exam = (float)$_POST['wm_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$sd_avg = calculerMoyenne($sd_td, $sd_exam);
$cm_avg = calculerMoyenne($cm_td, $cm_exam);
$adm_avg = calculerMoyenne($adm_td, $adm_exam);
$pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
$aam_avg = calculerMoyenne($aam_td, $aam_exam);
$olam_avg = calculerMoyenne($olam_td, $olam_exam);
$mar_avg = calculerMoyenne($mar_td, $mar_exam);
$wm_avg = calculerMoyenne($wm_td, $wm_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [2.5, 2, 2, 2.5, 1, 1.5, 2, 1.5, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $sd_avg * $coeffs[0] +
    $cm_avg * $coeffs[1] +
    $adm_avg * $coeffs[2] +
    $pfe_avg * $coeffs[3] +
    $aam_avg * $coeffs[4] +
    $olam_avg * $coeffs[5] +
    $mar_avg * $coeffs[6] +
    $wm_avg * $coeffs[7] +
    $eep_avg * $coeffs[8]
) / $total_coeff;

// Crédits
$credits = [5, 4, 4, 5, 2, 3, 4, 3, 3];
$total_credits = 0;
$matieres = [$sd_avg, $cm_avg, $adm_avg, $pfe_avg, $aam_avg, $olam_avg, $mar_avg, $wm_avg, $eep_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Stratégies de distribution</td><td>" . number_format($sd_avg, 2) . "</td></tr>";
echo "<tr><td>Communication marketing</td><td>" . number_format($cm_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse des données marketing</td><td>" . number_format($adm_avg, 2) . "</td></tr>";
echo "<tr><td>Projet de fin d'études (PFE)</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais appliqué au marketing 2</td><td>" . number_format($aam_avg, 2) . "</td></tr>";
echo "<tr><td>Outils et logiciels appliqués au marketing</td><td>" . number_format($olam_avg, 2) . "</td></tr>";
echo "<tr><td>Marchandising</td><td>" . number_format($mar_avg, 2) . "</td></tr>";
echo "<tr><td>Webmarketing</td><td>" . number_format($wm_avg, 2) . "</td></tr>";
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
