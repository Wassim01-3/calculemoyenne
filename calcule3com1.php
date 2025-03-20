<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>
<?php
// Récupération des notes depuis le formulaire
$eco_td = (float)$_POST['eco_td'];
$eco_exam = (float)$_POST['eco_exam'];
$fi_td = (float)$_POST['fi_td'];
$fi_exam = (float)$_POST['fi_exam'];
$dci_td = (float)$_POST['dci_td'];
$dci_exam = (float)$_POST['dci_exam'];
$pc_td = (float)$_POST['pc_td'];
$pc_exam = (float)$_POST['pc_exam'];
$ecs_td = (float)$_POST['ecs_td'];
$ecs_exam = (float)$_POST['ecs_exam'];
$be_td = (float)$_POST['be_td'];
$be_exam = (float)$_POST['be_exam'];
$dp_td = (float)$_POST['dp_td'];
$dp_exam = (float)$_POST['dp_exam'];
$fso_td = (float)$_POST['fso_td'];
$fso_exam = (float)$_POST['fso_exam'];
$tci_td = (float)$_POST['tci_td'];
$tci_exam = (float)$_POST['tci_exam'];
$eep_td = (float)$_POST['eep_td'];
$eep_exam = (float)$_POST['eep_exam'];

// Fonction pour calculer les moyennes
function calculerMoyenne($td, $exam, $formula = 'standard') {
    if ($formula === 'special') {
        return $exam * 0.5 + $td * 0.5; // Formule spéciale pour Étude de cas dans la spécialité
    }
    return $td * 0.3 + $exam * 0.7; // Formule standard pour les autres matières
}

// Calcul des moyennes
$eco_avg = calculerMoyenne($eco_td, $eco_exam);
$fi_avg = calculerMoyenne($fi_td, $fi_exam);
$dci_avg = calculerMoyenne($dci_td, $dci_exam);
$pc_avg = calculerMoyenne($pc_td, $pc_exam);
$ecs_avg = calculerMoyenne($ecs_td, $ecs_exam, 'special');
$be_avg = calculerMoyenne($be_td, $be_exam);
$dp_avg = calculerMoyenne($dp_td, $dp_exam);
$fso_avg = calculerMoyenne($fso_td, $fso_exam);
$tci_avg = calculerMoyenne($tci_td, $tci_exam);
$eep_avg = calculerMoyenne($eep_td, $eep_exam);

// Coefficients
$coeffs = [2, 1.5, 1, 2, 2.5, 1, 1.5, 2, 1.5, 1.5];

// Crédits
$credits = [4, 3, 2, 4, 5, 2, 3, 4, 3, 3];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = (
    $eco_avg * $coeffs[0] +
    $fi_avg * $coeffs[1] +
    $dci_avg * $coeffs[2] +
    $pc_avg * $coeffs[3] +
    $ecs_avg * $coeffs[4] +
    $be_avg * $coeffs[5] +
    $dp_avg * $coeffs[6] +
    $fso_avg * $coeffs[7] +
    $tci_avg * $coeffs[8] +
    $eep_avg * $coeffs[9]
) / $total_coeff;

// Calcul des crédits obtenus
$total_credits = 0;
$matieres = [$eco_avg, $fi_avg, $dci_avg, $pc_avg, $ecs_avg, $be_avg, $dp_avg, $fso_avg, $tci_avg, $eep_avg];
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
echo "<tr><td>Finance internationale</td><td>" . number_format($fi_avg, 2) . "</td></tr>";
echo "<tr><td>Droit du commerce international</td><td>" . number_format($dci_avg, 2) . "</td></tr>";
echo "<tr><td>Politiques commerciales</td><td>" . number_format($pc_avg, 2) . "</td></tr>";
echo "<tr><td>Étude de cas dans la spécialité</td><td>" . number_format($ecs_avg, 2) . "</td></tr>";
echo "<tr><td>Business English</td><td>" . number_format($be_avg, 2) . "</td></tr>";
echo "<tr><td>Développement personnel</td><td>" . number_format($dp_avg, 2) . "</td></tr>";
echo "<tr><td>Financement et sécurisation des opérations Import et Export</td><td>" . number_format($fso_avg, 2) . "</td></tr>";
echo "<tr><td>Technique du commerce international</td><td>" . number_format($tci_avg, 2) . "</td></tr>";
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
