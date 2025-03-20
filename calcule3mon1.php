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
$eco_td = (float)$_POST['eco_td'];
$eco_exam = (float)$_POST['eco_exam'];
$eba_td = (float)$_POST['eba_td'];
$eba_exam = (float)$_POST['eba_exam'];
$dif_td = (float)$_POST['dif_td'];
$dif_exam = (float)$_POST['dif_exam'];
$mm_td = (float)$_POST['mm_td'];
$mm_exam = (float)$_POST['mm_exam'];
$ecs_td = (float)$_POST['ecs_td'];
$ecs_exam = (float)$_POST['ecs_exam'];
$dp_td = (float)$_POST['dp_td'];
$dp_exam = (float)$_POST['dp_exam'];
$be_td = (float)$_POST['be_td'];
$be_exam = (float)$_POST['be_exam'];
$attb_td = (float)$_POST['attb_td'];
$attb_exam = (float)$_POST['attb_exam'];
$gt_td = (float)$_POST['gt_td'];
$gt_exam = (float)$_POST['gt_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Formules pour le calcul des moyennes
function calculerMoyenne($td, $exam, $special = false) {
    if ($special) {
        return $td * 0.5 + $exam * 0.5; // Formule spéciale pour Étude de cas dans la spécialité
    }
    return $td * 0.3 + $exam * 0.7; // Formule générale
}

// Calcul des moyennes
$eco_avg = calculerMoyenne($eco_td, $eco_exam);
$eba_avg = calculerMoyenne($eba_td, $eba_exam);
$dif_avg = calculerMoyenne($dif_td, $dif_exam);
$mm_avg = calculerMoyenne($mm_td, $mm_exam);
$ecs_avg = calculerMoyenne($ecs_td, $ecs_exam, true); // Formule spéciale
$dp_avg = calculerMoyenne($dp_td, $dp_exam);
$be_avg = calculerMoyenne($be_td, $be_exam);
$attb_avg = calculerMoyenne($attb_td, $attb_exam);
$gt_avg = calculerMoyenne($gt_td, $gt_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [2, 1.5, 1, 2, 2.5, 1.5, 1, 2, 1.5, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $eco_avg * $coeffs[0] +
    $eba_avg * $coeffs[1] +
    $dif_avg * $coeffs[2] +
    $mm_avg * $coeffs[3] +
    $ecs_avg * $coeffs[4] +
    $dp_avg * $coeffs[5] +
    $be_avg * $coeffs[6] +
    $attb_avg * $coeffs[7] +
    $gt_avg * $coeffs[8] +
    $eep_avg * $coeffs[9]
) / $total_coeff;

// Crédits
$credits = [4, 3, 2, 4, 5, 3, 2, 4, 3, 3];
$total_credits = 0;
$matieres = [$eco_avg, $eba_avg, $dif_avg, $mm_avg, $ecs_avg, $dp_avg, $be_avg, $attb_avg, $gt_avg, $eep_avg];

foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Initiation à l'économétrie</td><td>" . number_format($eco_avg, 2) . "</td></tr>";
echo "<tr><td>Économie de la banque et de l'assurance</td><td>" . number_format($eba_avg, 2) . "</td></tr>";
echo "<tr><td>Droit des institutions financières</td><td>" . number_format($dif_avg, 2) . "</td></tr>";
echo "<tr><td>Macroéconomie monétaire</td><td>" . number_format($mm_avg, 2) . "</td></tr>";
echo "<tr><td>Étude de cas dans la spécialité</td><td>" . number_format($ecs_avg, 2) . "</td></tr>";
echo "<tr><td>Développement personnel</td><td>" . number_format($dp_avg, 2) . "</td></tr>";
echo "<tr><td>Business English</td><td>" . number_format($be_avg, 2) . "</td></tr>";
echo "<tr><td>Analyse Technique et Trading Boursier</td><td>" . number_format($attb_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de trésorerie</td><td>" . number_format($gt_avg, 2) . "</td></tr>";
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
