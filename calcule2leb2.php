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
    $bd_tp = (float)$_POST['bd_tp'];
    $bd_ds1 = (float)$_POST['bd_ds1'];
    $bd_ds2 = (float)$_POST['bd_ds2'];

    $prog_web_tp = (float)$_POST['prog_web_tp'];
    $prog_web_ds1 = (float)$_POST['prog_web_ds1'];
    $prog_web_ds2 = (float)$_POST['prog_web_ds2'];

    $poo_tp = (float)$_POST['poo_tp'];
    $poo_ds1 = (float)$_POST['poo_ds1'];
    $poo_ds2 = (float)$_POST['poo_ds2'];

    $dd_ds1 = (float)$_POST['dd_ds1'];
    $dd_ds2 = (float)$_POST['dd_ds2'];

    $ent_ds1 = (float)$_POST['ent_ds1'];
    $ent_ds2 = (float)$_POST['ent_ds2'];

    $bc_ds1 = (float)$_POST['bc_ds1'];
    $bc_ds2 = (float)$_POST['bc_ds2'];

    $dp_ds1 = (float)$_POST['dp_ds1'];
    $dp_ds2 = (float)$_POST['dp_ds2'];

    $rech_exam = (float)$_POST['rech_exam'];
    $rech_ds1 = (float)$_POST['rech_ds1'];

    $it_exam = (float)$_POST['it_exam'];
    $it_ds1 = (float)$_POST['it_ds1'];

    $conc_exam = (float)$_POST['conc_exam'];
    $conc_ds1 = (float)$_POST['conc_ds1'];

    $dw_exam = (float)$_POST['dw_exam'];
    $dw_ds1 = (float)$_POST['dw_ds1'];

    $agl_exam = (float)$_POST['agl_exam'];
    $agl_ds1 = (float)$_POST['agl_ds1'];

    $crm_exam = (float)$_POST['crm_exam'];
    $crm_ds1 = (float)$_POST['crm_ds1'];

    // Formules spécifiques
    function calculerMoyenneSGBD($tp, $ds1, $ds2) {
        return $tp * 0.2 + $ds1 * 0.4 + $ds2 * 0.4;
    }

    function calculerMoyenneDS($ds1, $ds2) {
        return $ds1 * 0.5 + $ds2 * 0.5;
    }

    function calculerMoyenneExam($ds1, $exam) {
        return $ds1 * 0.3 + $exam * 0.7;
    }

    // Calcul des moyennes
    $bd_avg = calculerMoyenneSGBD($bd_tp, $bd_ds1, $bd_ds2);
    $prog_web_avg = calculerMoyenneSGBD($prog_web_tp, $prog_web_ds1, $prog_web_ds2);
    $poo_avg = calculerMoyenneSGBD($poo_tp, $poo_ds1, $poo_ds2);

    $dd_avg = calculerMoyenneDS($dd_ds1, $dd_ds2);
    $ent_avg = calculerMoyenneDS($ent_ds1, $ent_ds2);
    $bc_avg = calculerMoyenneDS($bc_ds1, $bc_ds2);
    $dp_avg = calculerMoyenneDS($dp_ds1, $dp_ds2);

    $rech_avg = calculerMoyenneExam($rech_ds1, $rech_exam);
    $it_avg = calculerMoyenneExam($it_ds1, $it_exam);
    $conc_avg = calculerMoyenneExam($conc_ds1, $conc_exam);
    $dw_avg = calculerMoyenneExam($dw_ds1, $dw_exam);
    $agl_avg = calculerMoyenneExam($agl_ds1, $agl_exam);
    $crm_avg = calculerMoyenneExam($crm_ds1, $crm_exam);

    // Coefficients et crédits
    $coeffs = [1.5, 1, 2, 1, 1, 1, 1, 1, 1, 1.5, 1, 1.5, 1];
    $credits = [3, 2, 4, 2, 2, 2, 2, 2, 2, 3, 2, 3, 2];

    // Moyenne générale pondérée
    $matieres = [$bd_avg, $prog_web_avg, $poo_avg, $dd_avg, $ent_avg, $bc_avg, $dp_avg, $rech_avg, $it_avg, $conc_avg, $dw_avg, $agl_avg, $crm_avg];
    $total_coeff = array_sum($coeffs);
    $general_avg = 0;
    $total_credits = 0;

    foreach ($matieres as $index => $moyenne) {
        $general_avg += $moyenne * $coeffs[$index];
        if ($moyenne >= 10) {
            $total_credits += $credits[$index];
        }
    }

    $general_avg /= $total_coeff;

    // Affichage des résultats
    echo '<h1>Résultats Académiques</h1>';
    echo '<table class="custom-table">';
    echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
    $noms_matieres = [
        'SGBD / D.B.M.S', 'Programmation Web 2', 'Programmation OO avancée',
        'Développement Durable', 'Entrepreneuriat', 'Business Communication',
        'Développement Personnel', 'Recherche Opérationnelle', 'IT Management',
        'Conception TB et Scoring', 'Data Warehouse', 'Génie logiciel et outils d’AGL',
        'E-Customer Relationship Management'
    ];

    foreach ($matieres as $index => $moyenne) {
        echo "<tr><td>{$noms_matieres[$index]}</td><td>" . number_format($moyenne, 2) . "</td></tr>";
    }
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
