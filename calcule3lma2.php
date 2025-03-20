<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$mi_td = (float)$_POST['mi_td'];
$mi_exam = (float)$_POST['mi_exam'];
$mtdsi_td = (float)$_POST['mtdsi_td'];
$mtdsi_exam = (float)$_POST['mtdsi_exam'];
$ms_td = (float)$_POST['ms_td'];
$ms_exam = (float)$_POST['ms_exam'];
$cg_td = (float)$_POST['cg_td'];
$cg_exam = (float)$_POST['cg_exam'];
$pfe_td = (float)$_POST['pfe_td'];
$pfe_exam = (float)$_POST['pfe_exam'];
$aam2_td = (float)$_POST['aam2_td'];
$aam2_exam = (float)$_POST['aam2_exam'];
$gpa_td = (float)$_POST['gpa_td'];
$gpa_exam = (float)$_POST['gpa_exam'];
$bg_td = (float)$_POST['bg_td'];
$bg_exam = (float)$_POST['bg_exam'];
$tad_td = (float)$_POST['tad_td'];
$tad_exam = (float)$_POST['tad_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Formule unique pour le calcul des moyennes
function calculerMoyenne($td, $exam) {
    return $td * 0.3 + $exam * 0.7;
}

// Calcul des moyennes
$mi_avg = calculerMoyenne($mi_td, $mi_exam);
$mtdsi_avg = calculerMoyenne($mtdsi_td, $mtdsi_exam);
$ms_avg = calculerMoyenne($ms_td, $ms_exam);
$cg_avg = calculerMoyenne($cg_td, $cg_exam);
$pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
$aam2_avg = calculerMoyenne($aam2_td, $aam2_exam);
$gpa_avg = calculerMoyenne($gpa_td, $gpa_exam);
$bg_avg = calculerMoyenne($bg_td, $bg_exam);
$tad_avg = calculerMoyenne($tad_td, $tad_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [1, 1.5, 2.5, 2.5, 2.5, 1, 1.5, 1, 1.5, 1];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $mi_avg * $coeffs[0] +
    $mtdsi_avg * $coeffs[1] +
    $ms_avg * $coeffs[2] +
    $cg_avg * $coeffs[3] +
    $pfe_avg * $coeffs[4] +
    $aam2_avg * $coeffs[5] +
    $gpa_avg * $coeffs[6] +
    $bg_avg * $coeffs[7] +
    $tad_avg * $coeffs[8] +
    $eep_avg * $coeffs[9]
) / $total_coeff;

// Crédits
$credits = [2, 3, 5, 5, 5, 2, 3, 2, 3, 2];
$total_credits = 0;
$matieres = [
    $mi_avg, $mtdsi_avg, $ms_avg, $cg_avg, $pfe_avg,
    $aam2_avg, $gpa_avg, $bg_avg, $tad_avg, $eep_avg
];

foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Management de l'innovation et entrepreneuriat</td><td>" . number_format($mi_avg, 2) . "</td></tr>";
echo "<tr><td>Management de la transformation digitale et systèmes d'information</td><td>" . number_format($mtdsi_avg, 2) . "</td></tr>";
echo "<tr><td>Management stratégique</td><td>" . number_format($ms_avg, 2) . "</td></tr>";
echo "<tr><td>Contrôle de gestion</td><td>" . number_format($cg_avg, 2) . "</td></tr>";
echo "<tr><td>Projet de fin d'études (PFE)</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
echo "<tr><td>Anglais appliqué au management 2</td><td>" . number_format($aam2_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de projet assisté par ordinateurs</td><td>" . number_format($gpa_avg, 2) . "</td></tr>";
echo "<tr><td>Business Game</td><td>" . number_format($bg_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques d’aide à la décision</td><td>" . number_format($tad_avg, 2) . "</td></tr>";
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
