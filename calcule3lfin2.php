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
    $ifm_td = (float)$_POST['ifm_td'];
    $ifm_exam = (float)$_POST['ifm_exam'];
    $pfe_td = (float)$_POST['pfe_td'];
    $pfe_exam = (float)$_POST['pfe_exam'];
    $cg_td = (float)$_POST['cg_td'];
    $cg_exam = (float)$_POST['cg_exam'];
    $pfe2_td = (float)$_POST['pfe_td'];
    $pfe2_exam = (float)$_POST['pfe_exam'];
    $af_td = (float)$_POST['af_td'];
    $af_exam = (float)$_POST['af_exam'];
    $lr_td = (float)$_POST['lr_td'];
    $lr_exam = (float)$_POST['lr_exam'];
    $at_td = (float)$_POST['at_td'];
    $at_exam = (float)$_POST['at_exam'];
    $tp_td = (float)$_POST['tp_td'];
    $tp_exam = (float)$_POST['tp_exam'];
    $eep_td = (float)$_POST['eep_td'];
    $eep_exam = (float)$_POST['eep_exam'];

    // Formule unique pour le calcul des moyennes
    function calculerMoyenne($td, $exam) {
        return $td * 0.3 + $exam * 0.7;
    }

    // Calcul des moyennes
    $ifm_avg = calculerMoyenne($ifm_td, $ifm_exam);
    $pfe_avg = calculerMoyenne($pfe_td, $pfe_exam);
    $cg_avg = calculerMoyenne($cg_td, $cg_exam);
    $pfe2_avg = calculerMoyenne($pfe2_td, $pfe2_exam);
    $af_avg = calculerMoyenne($af_td, $af_exam);
    $lr_avg = calculerMoyenne($lr_td, $lr_exam);
    $at_avg = calculerMoyenne($at_td, $at_exam);
    $tp_avg = calculerMoyenne($tp_td, $tp_exam);
    $eep_avg = calculerMoyenne($eep_td, $eep_exam);

    // Coefficients
    $coeffs = [2.5, 2, 2, 2.5, 1, 1.5, 1.5, 2, 2];

    // Moyenne générale pondérée
    $total_coeff = array_sum($coeffs);
    $general_avg = (
        $ifm_avg * $coeffs[0] +
        $pfe_avg * $coeffs[1] +
        $cg_avg * $coeffs[2] +
        $pfe2_avg * $coeffs[3] +
        $af_avg * $coeffs[4] +
        $lr_avg * $coeffs[5] +
        $at_avg * $coeffs[6] +
        $tp_avg * $coeffs[7] +
        $eep_avg * $coeffs[8]
    ) / $total_coeff;

    // Crédits
    $credits = [5, 4, 4, 5, 2, 3, 3, 4, 4];
    $total_credits = 0;
    $matieres = [
        $ifm_avg, $pfe_avg, $cg_avg, $pfe2_avg, $af_avg, $lr_avg, $at_avg, $tp_avg, $eep_avg
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
    echo "<tr><td>Ingénierie Financière et Montages Financiers</td><td>" . number_format($ifm_avg, 2) . "</td></tr>";
    echo "<tr><td>Politiques Financières de l’entreprise</td><td>" . number_format($pfe_avg, 2) . "</td></tr>";
    echo "<tr><td>Contrôle de Gestion</td><td>" . number_format($cg_avg, 2) . "</td></tr>";
    echo "<tr><td>Projet de fin d'études</td><td>" . number_format($pfe2_avg, 2) . "</td></tr>";
    echo "<tr><td>Anglais financier 2</td><td>" . number_format($af_avg, 2) . "</td></tr>";
    echo "<tr><td>Introduction au logiciel R</td><td>" . number_format($lr_avg, 2) . "</td></tr>";
    echo "<tr><td>Analyse technique et trading boursier</td><td>" . number_format($at_avg, 2) . "</td></tr>";
    echo "<tr><td>Techniques de prévision</td><td>" . number_format($tp_avg, 2) . "</td></tr>";
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
