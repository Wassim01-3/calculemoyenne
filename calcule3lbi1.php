<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
    <title>Résultats Académiques</title>
</head>
<body>
<?php
// Récupération des notes depuis le formulaire
$tp_exam = (float)$_POST['tp_exam'];
$tp_ds1 = (float)$_POST['tp_ds1'];

$ftd_exam = (float)$_POST['ftd_exam'];
$ftd_ds1 = (float)$_POST['ftd_ds1'];

$ibdc_exam = (float)$_POST['ibdc_exam'];
$ibdc_ds1 = (float)$_POST['ibdc_ds1'];

$dm_ds1 = (float)$_POST['dm_ds1'];
$dm_ds2 = (float)$_POST['dm_ds2'];

$gti_exam = (float)$_POST['gti_exam'];
$gti_ds1 = (float)$_POST['gti_ds1'];

$fsi_exam = (float)$_POST['fsi_exam'];
$fsi_ds1 = (float)$_POST['fsi_ds1'];

$lpbi_exam = (float)$_POST['lpbi_exam'];
$lpbi_ds1 = (float)$_POST['lpbi_ds1'];

$ctbs_ds1 = (float)$_POST['ctbs_ds1'];
$ctbs_ds2 = (float)$_POST['ctbs_ds2'];

$tad_td = (float)$_POST['tad_td'];
$tad_ds1 = (float)$_POST['tad_ds1'];
$tad_ds2 = (float)$_POST['tad_ds2'];

$pse_ds1 = (float)$_POST['pse_ds1'];
$pse_ds2 = (float)$_POST['pse_ds2'];

$gp_tp = (float)$_POST['gp_tp'];
$gp_ds1 = (float)$_POST['gp_ds1'];
$gp_ds2 = (float)$_POST['gp_ds2'];

$psoma_ds1 = (float)$_POST['psoma_ds1'];
$psoma_ds2 = (float)$_POST['psoma_ds2'];

// Fonction de calcul des moyennes
function calculerMoyenne($notes, $coeffs) {
    $somme = 0;
    $total_coeff = 0;
    foreach ($notes as $index => $note) {
        $somme += $note * $coeffs[$index];
        $total_coeff += $coeffs[$index];
    }
    return $total_coeff ? $somme / $total_coeff : 0;
}

// Calcul des moyennes par matière
$tp_avg = calculerMoyenne([$tp_exam, $tp_ds1], [0.7, 0.3]);
$ftd_avg = calculerMoyenne([$ftd_exam, $ftd_ds1], [0.7, 0.3]);
$ibdc_avg = calculerMoyenne([$ibdc_exam, $ibdc_ds1], [0.7, 0.3]);
$dm_avg = calculerMoyenne([$dm_ds1, $dm_ds2], [0.5, 0.5]);
$gti_avg = calculerMoyenne([$gti_exam, $gti_ds1], [0.7, 0.3]);
$fsi_avg = calculerMoyenne([$fsi_exam, $fsi_ds1], [0.7, 0.3]);
$lpbi_avg = calculerMoyenne([$lpbi_exam, $lpbi_ds1], [0.7, 0.3]);
$ctbs_avg = calculerMoyenne([$ctbs_ds1, $ctbs_ds2], [0.5, 0.5]);
$tad_avg = calculerMoyenne([$tad_td, $tad_ds1, $tad_ds2], [0.2, 0.4, 0.4]);
$pse_avg = calculerMoyenne([$pse_ds1, $pse_ds2], [0.5, 0.5]);
$gp_avg = calculerMoyenne([$gp_tp, $gp_ds1, $gp_ds2], [0.2, 0.4, 0.4]);
$psoma_avg = calculerMoyenne([$psoma_ds1, $psoma_ds2], [0.5, 0.5]);

// Calcul de la moyenne générale pondérée
$moyennes = [$tp_avg, $ftd_avg, $ibdc_avg, $dm_avg, $gti_avg, $fsi_avg, $lpbi_avg, $ctbs_avg, $tad_avg, $pse_avg, $gp_avg, $psoma_avg];
$coeffs = [2, 2, 2, 1.5, 2, 2, 2, 1.5, 2, 1.5, 2, 1];
$total_coeff = array_sum($coeffs);
$general_avg = calculerMoyenne($moyennes, $coeffs);

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';
echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Techniques de prévision</td><td>" . number_format($tp_avg, 2) . "</td></tr>";
echo "<tr><td>Fondements de la théorie de décision</td><td>" . number_format($ftd_avg, 2) . "</td></tr>";
echo "<tr><td>Introduction au Big Data et Cloud</td><td>" . number_format($ibdc_avg, 2) . "</td></tr>";
echo "<tr><td>Développement Mobile</td><td>" . number_format($dm_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de la technologie de l’information</td><td>" . number_format($gti_avg, 2) . "</td></tr>";
echo "<tr><td>Fondamentaux de la sécurité IT</td><td>" . number_format($fsi_avg, 2) . "</td></tr>";
echo "<tr><td>Langages de Programmation évolués – BI</td><td>" . number_format($lpbi_avg, 2) . "</td></tr>";
echo "<tr><td>Conception TB et scoring</td><td>" . number_format($ctbs_avg, 2) . "</td></tr>";
echo "<tr><td>Techniques d’aide à la décision</td><td>" . number_format($tad_avg, 2) . "</td></tr>";
echo "<tr><td>PSE – Politique et Stratégie d’Entreprise</td><td>" . number_format($pse_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de Projet</td><td>" . number_format($gp_avg, 2) . "</td></tr>";
echo "<tr><td>Psychology and sociology for online media applications</td><td>" . number_format($psoma_avg, 2) . "</td></tr>";
echo '</table>';

// Résumé des résultats
echo '<div class="result-summary">';
echo "<p><strong>Moyenne Générale :</strong> " . number_format($general_avg, 2) . "</p>";
if ($general_avg >= 10) {
    echo "<img src='3-unscreen.gif' width='240' height='160' alt='Animation positive'>";
} else {
    echo "<img src='2-unscreen.gif' width='240' height='160' alt='Animation négative'>";
}
echo '</div>';
?>
</body>
</html>
