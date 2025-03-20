<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>
    <?php
    // Récupération des notes depuis le formulaire
    $ca_td = (float)$_POST['ca_td'];
    $ca_exam = (float)$_POST['ca_exam'];
    $ccpef_td = (float)$_POST['ccpef_td'];
    $ccpef_exam = (float)$_POST['ccpef_exam'];
    $cg_td = (float)$_POST['cg_td'];
    $cg_exam = (float)$_POST['cg_exam'];
    $ecc_td = (float)$_POST['ecc_td'];
    $ecc_exam = (float)$_POST['ecc_exam'];
    $aac1_td = (float)$_POST['aac1_td'];
    $aac1_exam = (float)$_POST['aac1_exam'];
    $dp2_td = (float)$_POST['dp2_td'];
    $dp2_exam = (float)$_POST['dp2_exam'];
    $cs_td = (float)$_POST['cs_td'];
    $cs_exam = (float)$_POST['cs_exam'];
    $ocsi_td = (float)$_POST['ocsi_td'];
    $ocsi_exam = (float)$_POST['ocsi_exam'];
    $eep_td = (float)$_POST['eep_td'];
    $eep_exam = (float)$_POST['eep_exam'];

    // Formule pour le calcul des moyennes
    function calculerMoyenne($td, $exam, $isSpecial = false) {
        if ($isSpecial) {
            return $td * 0.5 + $exam * 0.5; // Formule spéciale pour "Étude de cas en comptabilité"
        }
        return $td * 0.3 + $exam * 0.7; // Formule générale
    }

    // Calcul des moyennes
    $ca_avg = calculerMoyenne($ca_td, $ca_exam);
    $ccpef_avg = calculerMoyenne($ccpef_td, $ccpef_exam);
    $cg_avg = calculerMoyenne($cg_td, $cg_exam);
    $ecc_avg = calculerMoyenne($ecc_td, $ecc_exam, true); // Spécial pour "Étude de cas en comptabilité"
    $aac1_avg = calculerMoyenne($aac1_td, $aac1_exam);
    $dp2_avg = calculerMoyenne($dp2_td, $dp2_exam);
    $cs_avg = calculerMoyenne($cs_td, $cs_exam);
    $ocsi_avg = calculerMoyenne($ocsi_td, $ocsi_exam);
    $eep_avg = calculerMoyenne($eep_td, $eep_exam);

    // Coefficients
    $coeffs = [3, 2.5, 2.5, 2.5, 1, 1.5, 1, 1, 1];

    // Moyenne générale pondérée
    $total_coeff = array_sum($coeffs);
    $general_avg = (
        $ca_avg * $coeffs[0] + 
        $ccpef_avg * $coeffs[1] + 
        $cg_avg * $coeffs[2] + 
        $ecc_avg * $coeffs[3] + 
        $aac1_avg * $coeffs[4] + 
        $dp2_avg * $coeffs[5] + 
        $cs_avg * $coeffs[6] + 
        $ocsi_avg * $coeffs[7] + 
        $eep_avg * $coeffs[8]
    ) / $total_coeff;

    // Crédits
    $credits = [6, 5, 5, 5, 2, 3, 2, 2, 2];
    $total_credits = 0;
    $matieres = [$ca_avg, $ccpef_avg, $cg_avg, $ecc_avg, $aac1_avg, $dp2_avg, $cs_avg, $ocsi_avg, $eep_avg];

    foreach ($matieres as $index => $moyenne) {
        if ($moyenne >= 10) {
            $total_credits += $credits[$index];
        }
    }

    // Affichage des résultats
    echo '<h1>Résultats Académiques</h1>';
    echo '<table class="custom-table">';
    echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
    echo "<tr><td>Comptabilité avancée</td><td>" . number_format($ca_avg, 2) . "</td></tr>";
    echo "<tr><td>Cadre conceptuel et présentation des états financiers</td><td>" . number_format($ccpef_avg, 2) . "</td></tr>";
    echo "<tr><td>Contrôle de gestion</td><td>" . number_format($cg_avg, 2) . "</td></tr>";
    echo "<tr><td>Étude de cas en comptabilité</td><td>" . number_format($ecc_avg, 2) . "</td></tr>";
    echo "<tr><td>Anglais appliqué à la comptabilité 1</td><td>" . number_format($aac1_avg, 2) . "</td></tr>";
    echo "<tr><td>Développement personnel 2</td><td>" . number_format($dp2_avg, 2) . "</td></tr>";
    echo "<tr><td>Comptabilité sectorielle</td><td>" . number_format($cs_avg, 2) . "</td></tr>";
    echo "<tr><td>Organisation comptable et systèmes d’information</td><td>" . number_format($ocsi_avg, 2) . "</td></tr>";
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
