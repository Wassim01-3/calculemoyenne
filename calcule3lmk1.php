<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
    <title>Résultats Académiques</title>
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$gpp_td = (float)$_POST['gpp_td'];
$gpp_exam = (float)$_POST['gpp_exam'];
$sm_td = (float)$_POST['sm_td'];
$sm_exam = (float)$_POST['sm_exam'];
$rm_td = (float)$_POST['rm_td'];
$rm_exam = (float)$_POST['rm_exam'];
$acc_td = (float)$_POST['acc_td'];
$acc_exam = (float)$_POST['acc_exam'];
$ecm_td = (float)$_POST['ecm_td'];
$ecm_exam = (float)$_POST['ecm_exam'];
$aam_td = (float)$_POST['aam_td'];
$aam_exam = (float)$_POST['aam_exam'];
$dp2_td = (float)$_POST['dp2_td'];
$dp2_exam = (float)$_POST['dp2_exam'];
$mi_td = (float)$_POST['mi_td'];
$mi_exam = (float)$_POST['mi_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];
$td_td = (float)$_POST['td_td'];
$td_exam = (float)$_POST['td_exam'];

// Formule pour le calcul des moyennes
function calculerMoyenne($td, $exam, $isSpecial = false) {
    return $isSpecial ? $td * 0.5 + $exam * 0.5 : $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$gpp_avg = calculerMoyenne($gpp_td, $gpp_exam);
$sm_avg = calculerMoyenne($sm_td, $sm_exam);
$rm_avg = calculerMoyenne($rm_td, $rm_exam);
$acc_avg = calculerMoyenne($acc_td, $acc_exam);
$ecm_avg = calculerMoyenne($ecm_td, $ecm_exam, true); // Formule spéciale
$aam_avg = calculerMoyenne($aam_td, $aam_exam);
$dp2_avg = calculerMoyenne($dp2_td, $dp2_exam);
$mi_avg = calculerMoyenne($mi_td, $mi_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);
$td_avg = calculerMoyenne($td_td, $td_exam);

// Coefficients
$coeffs = [1, 1.5, 2, 2, 2.5, 1, 1.5, 2, 1.5, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $gpp_avg * $coeffs[0] +
    $sm_avg * $coeffs[1] +
    $rm_avg * $coeffs[2] +
    $acc_avg * $coeffs[3] +
    $ecm_avg * $coeffs[4] +
    $aam_avg * $coeffs[5] +
    $dp2_avg * $coeffs[6] +
    $mi_avg * $coeffs[7] +
    $eep_avg * $coeffs[8] +
    $td_avg * $coeffs[9]
) / $total_coeff;

// Crédits
$credits = [2, 3, 4, 4, 5, 2, 3, 4, 3, 3];
$total_credits = 0;

$matieres = [$gpp_avg, $sm_avg, $rm_avg, $acc_avg, $ecm_avg, $aam_avg, $dp2_avg, $mi_avg, $eep_avg, $td_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Gestion des prix et des produits</td><td>" . number_format($gpp_avg, 2) . "</td></tr>";
echo "<tr><td>Stratégie marketing</td><td>" . number_format($sm_avg, 2) . "</td></tr>";
echo "<tr><td>Recherche marketing</td><td>" . number_format($rm_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse du comportement du consommateur</td><td>" . number_format($acc_avg, 2) . "</td></tr>";
echo "<tr><td>Études de cas en marketing</td><td>" . number_format($ecm_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais appliqué au marketing 1</td><td>" . number_format($aam_avg, 2) . "</td></tr>";
echo "<tr><td>Développement personnel 2</td><td>" . number_format($dp2_avg, 2) . "</td></tr>";
echo "<tr><td>Marketing international</td><td>" . number_format($mi_avg, 2) . "</td></tr>";
echo "<tr><td>Entreprise d’Entrainement Pédagogique</td><td>" . number_format($eep_avg, 2) . "</td></tr>";
echo "<tr><td>Théorie de la décision</td><td>" . number_format($td_avg, 2) . "</td></tr>";
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
