<html lang="fr">
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
$tp_td = (float)$_POST['tp_td'];
$tp_exam = (float)$_POST['tp_exam'];
$to_td = (float)$_POST['to_td'];
$to_exam = (float)$_POST['to_exam'];
$ro_td = (float)$_POST['ro_td'];
$ro_exam = (float)$_POST['ro_exam'];
$ecs_td = (float)$_POST['ecs_td'];
$ecs_exam = (float)$_POST['ecs_exam'];
$be_td = (float)$_POST['be_td'];
$be_exam = (float)$_POST['be_exam'];
$dp_td = (float)$_POST['dp_td'];
$dp_exam = (float)$_POST['dp_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];
$fo_td = (float)$_POST['fo_td'];
$fo_exam = (float)$_POST['fo_exam'];
$ols_td = (float)$_POST['ols_td'];
$ols_exam = (float)$_POST['ols_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam, $isEcs = false) {
    if ($isEcs) {
        // Formule spécifique pour "Étude de cas dans la spécialité"
        return $td * 0.5 + $exam * 0.5;
    } else {
        // Formule générale
        return $td * 0.3 + $exam * 0.7;
    }
}

// Calcul des moyennes
$eco_avg = calculerMoyenne($eco_td, $eco_exam);
$tp_avg = calculerMoyenne($tp_td, $tp_exam);
$to_avg = calculerMoyenne($to_td, $to_exam);
$ro_avg = calculerMoyenne($ro_td, $ro_exam);
$ecs_avg = calculerMoyenne($ecs_td, $ecs_exam, true);  // Spécifique pour ECS
$be_avg = calculerMoyenne($be_td, $be_exam);
$dp_avg = calculerMoyenne($dp_td, $dp_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);
$fo_avg = calculerMoyenne($fo_td, $fo_exam);
$ols_avg = calculerMoyenne($ols_td, $ols_exam);

// Coefficients
$coeffs = [2, 1.5, 1, 2, 2.5, 1, 1.5, 1.5, 2, 1.5];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $eco_avg * $coeffs[0] + 
    $tp_avg * $coeffs[1] + 
    $to_avg * $coeffs[2] + 
    $ro_avg * $coeffs[3] + 
    $ecs_avg * $coeffs[4] + 
    $be_avg * $coeffs[5] + 
    $dp_avg * $coeffs[6] + 
    $eep_avg * $coeffs[7] + 
    $fo_avg * $coeffs[8] + 
    $ols_avg * $coeffs[9]
) / $total_coeff;

// Crédits
$credits = [4, 3, 2, 4, 5, 2, 3, 3, 4, 3];
$total_credits = 0;
$matieres = [$eco_avg, $tp_avg, $to_avg, $ro_avg, $ecs_avg, $be_avg, $dp_avg, $eep_avg, $fo_avg, $ols_avg];
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Initiation à l'Econométrie</td><td>" . number_format($eco_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques de prévision</td><td>" . number_format($tp_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques d'optimisation</td><td>" . number_format($to_avg, 2) . "</td></tr>";
echo "<tr><td>Recherches opérationnelles</td><td>" . number_format($ro_avg, 2) . "</td></tr>";
echo "<tr><td>Étude de cas dans la spécialité</td><td>" . number_format($ecs_avg, 2) . "</td></tr>";
echo "<tr><td>Business English</td><td>" . number_format($be_avg, 2) . "</td></tr>";
echo "<tr><td>Développement personnel</td><td>" . number_format($dp_avg, 2) . "</td></tr>";
echo "<tr><td>Entreprise d'Entrainement Pédagogique</td><td>" . number_format($eep_avg, 2) . "</td></tr>";
echo "<tr><td>Fondements et outils de l'ingénierie économique</td><td>" . number_format($fo_avg, 2) . "</td></tr>";
echo "<tr><td>Outils et logiciels statistiques</td><td>" . number_format($ols_avg, 2) . "</td></tr>";
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
