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
    $gfi_td = (float)$_POST['gfi_td'];
    $gfi_exam = (float)$_POST['gfi_exam'];
    $gif_td = (float)$_POST['gif_td'];
    $gif_exam = (float)$_POST['gif_exam'];
    $ecoaf_td = (float)$_POST['ecoaf_td'];
    $ecoaf_exam = (float)$_POST['ecoaf_exam'];
    $gp_td = (float)$_POST['gp_td'];
    $gp_exam = (float)$_POST['gp_exam'];
    $ecf_td = (float)$_POST['ecf_td'];
    $ecf_exam = (float)$_POST['ecf_exam'];
    $af1_td = (float)$_POST['af1_td'];
    $af1_exam = (float)$_POST['af1_exam'];
    $dp2_td = (float)$_POST['dp2_td'];
    $dp2_exam = (float)$_POST['dp2_exam'];
    $gt_td = (float)$_POST['gt_td'];
    $gt_exam = (float)$_POST['gt_exam'];
    $fi_td = (float)$_POST['fi_td'];
    $fi_exam = (float)$_POST['fi_exam'];
    $eep_td = (float)$_POST['eep_td'];
    $eep_exam = (float)$_POST['eep_exam'];

    // Formule spécifique pour la matière Etudes de cas en Finance
    function calculerMoyenne($td, $exam, $isEcf = false) {
        if ($isEcf) {
            return $td * 0.5 + $exam * 0.5; // Formule spécifique pour Etudes de cas en Finance
        } else {
            return $td * 0.3 + $exam * 0.7; // Formule générale
        }
    }

    // Calcul des moyennes
    $gfi_avg = calculerMoyenne($gfi_td, $gfi_exam);
    $gif_avg = calculerMoyenne($gif_td, $gif_exam);
    $ecoaf_avg = calculerMoyenne($ecoaf_td, $ecoaf_exam);
    $gp_avg = calculerMoyenne($gp_td, $gp_exam);
    $ecf_avg = calculerMoyenne($ecf_td, $ecf_exam, true); // Calcul spécifique pour Etudes de cas en Finance
    $af1_avg = calculerMoyenne($af1_td, $af1_exam);
    $dp2_avg = calculerMoyenne($dp2_td, $dp2_exam);
    $gt_avg = calculerMoyenne($gt_td, $gt_exam);
    $fi_avg = calculerMoyenne($fi_td, $fi_exam);
    $eep_avg = calculerMoyenne($eep_td, $eep_exam);

    // Coefficients
    $coeffs = [1.5, 1, 2, 2, 2.5, 1, 1.5, 1.5, 2, 2]; 

    // Moyenne générale pondérée
    $total_coeff = array_sum($coeffs);
    $general_avg = (
        $gfi_avg * $coeffs[0] +
        $gif_avg * $coeffs[1] +
        $ecoaf_avg * $coeffs[2] +
        $gp_avg * $coeffs[3] +
        $ecf_avg * $coeffs[4] +
        $af1_avg * $coeffs[5] +
        $dp2_avg * $coeffs[6] +
        $gt_avg * $coeffs[7] +
        $fi_avg * $coeffs[8] +
        $eep_avg * $coeffs[9]
    ) / $total_coeff;

    // Crédits
    $credits = [3, 2, 4, 4, 5, 2, 3, 3, 4, 4];
    $total_credits = 0;
    $matieres = [$gfi_avg, $gif_avg, $ecoaf_avg, $gp_avg, $ecf_avg, $af1_avg, $dp2_avg, $gt_avg, $fi_avg, $eep_avg];
    foreach ($matieres as $index => $moyenne) {
        if ($moyenne >= 10) {
            $total_credits += $credits[$index];
        }
    }

    // Affichage des résultats
    echo '<h1>Résultats Académiques</h1>';
    echo '<table class="custom-table">';
    echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
    echo "<tr><td>Gestion Financière Internationale</td><td>" . number_format($gfi_avg, 2) . "</td></tr>";
    echo "<tr><td>Gestion des Institutions Financières</td><td>" . number_format($gif_avg, 2) . "</td></tr>";
    echo "<tr><td>Econométrie Appliquée à la Finance</td><td>" . number_format($ecoaf_avg, 2) . "</td></tr>";
    echo "<tr><td>Gestion de Portefeuille</td><td>" . number_format($gp_avg, 2) . "</td></tr>";
    echo "<tr><td>Études de cas en Finance</td><td>" . number_format($ecf_avg, 2) . "</td></tr>";
    echo "<tr><td>Anglais financier 1</td><td>" . number_format($af1_avg, 2) . "</td></tr>";
    echo "<tr><td>Développement personnel 2</td><td>" . number_format($dp2_avg, 2) . "</td></tr>";
    echo "<tr><td>Gestion de trésorerie</td><td>" . number_format($gt_avg, 2) . "</td></tr>";
    echo "<tr><td>Finance islamique</td><td>" . number_format($fi_avg, 2) . "</td></tr>";
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
