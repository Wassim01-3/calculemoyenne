<?php
// Récupération des notes depuis le formulaire
$iw_exam = (float)$_POST['iw_exam'];
$iw_ds1 = (float)$_POST['iw_ds1'];
$dm_exam = (float)$_POST['dm_exam'];
$dm_ds1 = (float)$_POST['dm_ds1'];
$ia_exam = (float)$_POST['ia_exam'];
$ia_ds1 = (float)$_POST['ia_ds1'];
$ad_dm_exam = (float)$_POST['ad_dm_exam'];
$ad_dm_ds1 = (float)$_POST['ad_dm_ds1'];
$itsf_exam = (float)$_POST['itsf_exam'];
$itsf_ds1 = (float)$_POST['itsf_ds1'];
$gp_exam = (float)$_POST['gp_exam'];
$gp_tp = (float)$_POST['gp_tp'];
$gp_ds1 = (float)$_POST['gp_ds1'];
$ibdc_exam = (float)$_POST['ibdc_exam'];
$ibdc_ds1 = (float)$_POST['ibdc_ds1'];
$lpbi_tp = (float)$_POST['lpbi_tp'];
$lpbi_ds1 = (float)$_POST['lpbi_ds1'];
$lpbi_ds2 = (float)$_POST['lpbi_ds2'];
$tad_td = (float)$_POST['tad_td'];
$tad_ds1 = (float)$_POST['tad_ds1'];
$tad_ds2 = (float)$_POST['tad_ds2'];
$iml_ds1 = (float)$_POST['iml_ds1'];
$iml_ds2 = (float)$_POST['iml_ds2'];
$lei_td = (float)$_POST['lei_td'];
$lei_ds1 = (float)$_POST['lei_ds1'];
$lei_ds2 = (float)$_POST['lei_ds2'];
$bc_ds1 = (float)$_POST['bc_ds1'];
$bc_ds2 = (float)$_POST['bc_ds2'];

// Formules de calcul des moyennes
function calculerMoyenneRestes($ds1, $exam) {
    return $ds1 * 0.3 + $exam * 0.7;
}

function calculerMoyenneGp($tp, $ds1, $exam) {
    return $tp * 0.1 + $ds1 * 0.2 + $exam * 0.7;
}

function calculerMoyenneDsDs($ds1, $ds2) {
    return $ds1 * 0.5 + $ds2 * 0.5;
}

function calculerMoyenneTdDs($td, $ds1, $ds2) {
    return $td * 0.2 + $ds1 * 0.4 + $ds2 * 0.4;
}

function calculerMoyenneLpbi($tp, $ds1, $ds2) {
    return $tp * 0.2 + $ds1 * 0.4 + $ds2 * 0.4;
}

// Calcul des moyennes
$iw_avg = calculerMoyenneRestes($iw_ds1, $iw_exam);
$dm_avg = calculerMoyenneRestes($dm_ds1, $dm_exam);
$ia_avg = calculerMoyenneRestes($ia_ds1, $ia_exam);
$ad_dm_avg = calculerMoyenneRestes($ad_dm_ds1, $ad_dm_exam);
$itsf_avg = calculerMoyenneRestes($itsf_ds1, $itsf_exam);
$gp_avg = calculerMoyenneGp($gp_tp, $gp_ds1, $gp_exam);
$ibdc_avg = calculerMoyenneRestes($ibdc_ds1, $ibdc_exam);
$lpbi_avg = calculerMoyenneLpbi($lpbi_tp, $lpbi_ds1, $lpbi_ds2);
$tad_avg = calculerMoyenneTdDs($tad_td, $tad_ds1, $tad_ds2);
$iml_avg = calculerMoyenneDsDs($iml_ds1, $iml_ds2);
$lei_avg = calculerMoyenneTdDs($lei_td, $lei_ds1, $lei_ds2);
$bc_avg = calculerMoyenneDsDs($bc_ds1, $bc_ds2);

// Coefficients
$coeffs = [1, 1, 1, 1, 1, 1.5, 1, 1.5, 1.5, 1.5, 1.5, 1.5];

// Moyennes des matières
$matieres = [$iw_avg, $dm_avg, $ia_avg, $ad_dm_avg, $itsf_avg, $gp_avg, $ibdc_avg, $lpbi_avg, $tad_avg, $iml_avg, $lei_avg, $bc_avg];

// Moyenne générale pondérée
$total_coeff = array_sum($coeffs);
$general_avg = 0;
foreach ($matieres as $index => $moyenne) {
    $general_avg += $moyenne * $coeffs[$index];
}
$general_avg /= $total_coeff;

// Crédits
$credits = [2, 2, 3, 2, 2, 3, 2, 3, 3, 3, 3, 3];
$total_credits = 0;
foreach ($matieres as $index => $moyenne) {
    if ($moyenne >= 10) {
        $total_credits += $credits[$index];
    }
}

// Affichage des résultats
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
    <title>Résultats Académiques</title>
</head>
<body>
    <h1>Résultats Académiques</h1>
    <table class="custom-table">
        <tr><th>Matière</th><th>Moyenne</th></tr>
        <?php
        $noms_matieres = [
            "Intégration Web", "Développement Mobile", "Intelligence Artificielle",
            "Analyse de données et Data Mining", "IT Security Fundamentals",
            "Gestion de Projet", "Introduction au Big Data et Cloud",
            "Langage de programmation évolué BI", "Techniques d’aide à la décision",
            "Initiation au Machine Learning", "Laws and Ethics of IT", "Business Computing"
        ];

        foreach ($matieres as $index => $moyenne) {
            echo "<tr><td>{$noms_matieres[$index]}</td><td>" . number_format($moyenne, 2) . "</td></tr>";
        }
        ?>
    </table>
    <div class="result-summary">
        <p><strong>Moyenne Générale :</strong> <?php echo number_format($general_avg, 2); ?></p>
        <?php if ($general_avg >= 10): ?>
            <img src="3-unscreen.gif" width="240" height="160" alt="Animation positive">
        <?php else: ?>
            <img src="2-unscreen.gif" width="240" height="160" alt="Animation négative">
        <?php endif; ?>
        <p><strong>Total des Crédits Obtenus :</strong> <?php echo $total_credits; ?></p>
    </div>
</body>
</html>
