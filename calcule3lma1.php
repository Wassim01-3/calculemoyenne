<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
<body>
    <?php
    // Récupération des notes depuis le formulaire
    $to_td = (float)$_POST['to_td'];
    $to_exam = (float)$_POST['to_exam'];
    $aq_td = (float)$_POST['aq_td'];
    $aq_exam = (float)$_POST['aq_exam'];
    $mp_td = (float)$_POST['mp_td'];
    $mp_exam = (float)$_POST['mp_exam'];
    $mq_td = (float)$_POST['mq_td'];
    $mq_exam = (float)$_POST['mq_exam'];
    $ecm_td = (float)$_POST['ecm_td'];
    $ecm_exam = (float)$_POST['ecm_exam'];
    $aam1_td = (float)$_POST['aam1_td'];
    $aam1_exam = (float)$_POST['aam1_exam'];
    $dp2_td = (float)$_POST['dp2_td'];
    $dp2_exam = (float)$_POST['dp2_exam'];
    $mi_td = (float)$_POST['mi_td'];
    $mi_exam = (float)$_POST['mi_exam'];
    $eep_td = (float)$_POST['eep_td'];
    $eep_exam = (float)$_POST['eep_exam'];
    $msg_td = (float)$_POST['msg_td'];
    $msg_exam = (float)$_POST['msg_exam'];

    // Fonction de calcul des moyennes
    function calculerMoyenne($td, $exam, $isEcm = false) {
        if ($isEcm) {
            return $td * 0.5 + $exam * 0.5;  // Cas particulier pour Etude de cas en management
        }
        return $td * 0.3 + $exam * 0.7; // Formule générale
    }

    // Calcul des moyennes pour chaque matière
    $to_avg = calculerMoyenne($to_td, $to_exam);
    $aq_avg = calculerMoyenne($aq_td, $aq_exam);
    $mp_avg = calculerMoyenne($mp_td, $mp_exam);
    $mq_avg = calculerMoyenne($mq_td, $mq_exam);
    $ecm_avg = calculerMoyenne($ecm_td, $ecm_exam, true);  // ECM a une formule différente
    $aam1_avg = calculerMoyenne($aam1_td, $aam1_exam);
    $dp2_avg = calculerMoyenne($dp2_td, $dp2_exam);
    $mi_avg = calculerMoyenne($mi_td, $mi_exam);
    $eep_avg = calculerMoyenne($eep_td, $eep_exam);
    $msg_avg = calculerMoyenne($msg_td, $msg_exam);

    // Coefficients
    $coeffs = [2, 2.5, 1.5, 1.5, 2.5, 1, 1.5, 1.5, 1, 1];

    // Moyenne générale pondérée
    $total_coeff = array_sum($coeffs);
    $general_avg = (
        $to_avg * $coeffs[0] + $aq_avg * $coeffs[1] + $mp_avg * $coeffs[2] + $mq_avg * $coeffs[3] +
        $ecm_avg * $coeffs[4] + $aam1_avg * $coeffs[5] + $dp2_avg * $coeffs[6] + $mi_avg * $coeffs[7] +
        $eep_avg * $coeffs[8] + $msg_avg * $coeffs[9]
    ) / $total_coeff;

    // Crédits
    $credits = [4, 5, 3, 3, 5, 2, 3, 3, 2, 2];
    $total_credits = 0;
    $matieres = [$to_avg, $aq_avg, $mp_avg, $mq_avg, $ecm_avg, $aam1_avg, $dp2_avg, $mi_avg, $eep_avg, $msg_avg];
    foreach ($matieres as $index => $moyenne) {
        if ($moyenne >= 10) {
            $total_credits += $credits[$index];
        }
    }

    // Affichage des résultats
    echo '<h1>Résultats Académiques</h1>';
    echo '<table class="custom-table">';
    echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
    echo "<tr><td>Théorie des organisations</td><td>" . number_format($to_avg, 2) . "</td></tr>";
    echo "<tr><td>Analyses quantitatives et qualitatives</td><td>" . number_format($aq_avg, 2) . "</td></tr>";
    echo "<tr><td>Management de projet</td><td>" . number_format($mp_avg, 2) . "</td></tr>";
    echo "<tr><td>Management de la qualité et certification</td><td>" . number_format($mq_avg, 2) . "</td></tr>";
    echo "<tr><td>Etude de cas en management</td><td>" . number_format($ecm_avg, 2) . "</td></tr>";
    echo "<tr><td>Anglais appliqué au management 1</td><td>" . number_format($aam1_avg, 2) . "</td></tr>";
    echo "<tr><td>Développement personnel 2</td><td>" . number_format($dp2_avg, 2) . "</td></tr>";
    echo "<tr><td>Management International</td><td>" . number_format($mi_avg, 2) . "</td></tr>";
    echo "<tr><td>Entreprise d’Entrainement Pédagogique</td><td>" . number_format($eep_avg, 2) . "</td></tr>";
    echo "<tr><td>Méthodes Scientifiques de Gestion</td><td>" . number_format($msg_avg, 2) . "</td></tr>";
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
