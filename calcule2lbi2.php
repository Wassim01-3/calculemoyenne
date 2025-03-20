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
    $anal_exam = (float)$_POST['anal_exam'];
    $anal_td = (float)$_POST['anal_td'];
    $anal_tp = (float)$_POST['anal_tp'];

    $prog_web_tp = (float)$_POST['prog_web_tp'];
    $prog_web_ds1 = (float)$_POST['prog_web_ds1'];
    $prog_web_ds2 = (float)$_POST['prog_web_ds2'];

    $gra_exam = (float)$_POST['gra_exam'];
    $gra_td = (float)$_POST['gra_td'];

    $agl_ds2 = (float)$_POST['agl_ds2'];
    $agl_ds1 = (float)$_POST['agl_ds1'];

    $arlog_exam = (float)$_POST['arlog_exam'];
    $arlog_td = (float)$_POST['arlog_td'];

    $bd_tp = (float)$_POST['bd_tp'];
    $bd_ds1 = (float)$_POST['bd_ds1'];
    $bd_ds2 = (float)$_POST['bd_ds2'];

    $mod_exam = (float)$_POST['mod_exam'];
    $mod_td = (float)$_POST['mod_td'];

    $poo_tp = (float)$_POST['poo_tp'];
    $poo_ds1 = (float)$_POST['poo_ds1'];
    $poo_ds2 = (float)$_POST['poo_ds2'];

    $dd_ds1 = (float)$_POST['dd_ds1'];
    $dd_ds2 = (float)$_POST['dd_ds2'];

    $ent_ds1 = (float)$_POST['ent_ds1'];
    $ent_ds2 = (float)$_POST['ent_ds2'];

    $lead_ds1 = (float)$_POST['lead_ds1'];
    $lead_ds2 = (float)$_POST['lead_ds2'];

    $dp_ds1 = (float)$_POST['dp_ds1'];
    $dp_ds2 = (float)$_POST['dp_ds2'];

    // Formules spécifiques pour chaque matière
    function calculerAnalyseFouilleDonnees($tp, $ds1, $exam) {
        return $tp * 0.1 + $ds1 * 0.2 + $exam * 0.7;
    }

    function calculerProgrammationWebOOAvancee($tp, $ds1, $ds2) {
        return $tp * 0.2 + $ds1 * 0.4 + $ds2 * 0.4;
    }

    function calculerTheorieGraphesEtAutres($td, $exam) {
        return $td * 0.3 + $exam * 0.7;
    }

    function calculerMatiereDS1DS2($ds1, $ds2) {
        return $ds1 * 0.5 + $ds2 * 0.5;
    }

    // Calcul des moyennes pour chaque matière
    $anal_avg = calculerAnalyseFouilleDonnees($anal_tp, $anal_td, $anal_exam);
    $prog_web_avg = calculerProgrammationWebOOAvancee($prog_web_tp, $prog_web_ds1, $prog_web_ds2);
    $gra_avg = calculerTheorieGraphesEtAutres($gra_td, $gra_exam);
    $agl_avg = calculerMatiereDS1DS2($agl_ds1, $agl_ds2);
    $arlog_avg = calculerTheorieGraphesEtAutres($arlog_td, $arlog_exam);
    $bd_avg = calculerMatiereDS1DS2($bd_ds1, $bd_ds2);
    $mod_avg = calculerTheorieGraphesEtAutres($mod_td, $mod_exam);
    $poo_avg = calculerProgrammationWebOOAvancee($poo_tp, $poo_ds1, $poo_ds2);
    $dd_avg = calculerMatiereDS1DS2($dd_ds1, $dd_ds2);
    $ent_avg = calculerMatiereDS1DS2($ent_ds1, $ent_ds2);
    $lead_avg = calculerMatiereDS1DS2($lead_ds1, $lead_ds2);
    $dp_avg = calculerMatiereDS1DS2($dp_ds1, $dp_ds2);

    // Coefficients des matières
    $coeffs = [1, 1, 2, 1, 1.5, 1, 1.5, 2, 1, 1, 1, 1];

    // Calcul de la moyenne générale pondérée
    $total_coeff = array_sum($coeffs);
    $general_avg = (
        $anal_avg * $coeffs[0] + $prog_web_avg * $coeffs[1] + $gra_avg * $coeffs[2] + $agl_avg * $coeffs[3] +
        $arlog_avg * $coeffs[4] + $bd_avg * $coeffs[5] + $mod_avg * $coeffs[6] + $poo_avg * $coeffs[7] +
        $dd_avg * $coeffs[8] + $ent_avg * $coeffs[9] + $lead_avg * $coeffs[10] + $dp_avg * $coeffs[11]
    ) / $total_coeff;

    // Crédits
    $credits = [2, 2, 4, 2, 3, 2, 3, 4, 2, 2, 2, 2];
    $total_credits = 0;
    $matieres = [$anal_avg, $prog_web_avg, $gra_avg, $agl_avg, $arlog_avg, $bd_avg, $mod_avg, $poo_avg, $dd_avg, $ent_avg, $lead_avg, $dp_avg];
    
    foreach ($matieres as $index => $moyenne) {
        if ($moyenne >= 10) {
            $total_credits += $credits[$index];
        }
    }

    // Affichage des résultats
    echo '<h1>Résultats Académiques</h1>';
    echo '<table class="custom-table">';
    echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
    echo "<tr><td>Analyse et fouille de données</td><td>" . number_format($anal_avg, 2) . "</td></tr>";
    echo "<tr><td>Programmation web 2</td><td>" . number_format($prog_web_avg, 2) . "</td></tr>";
    echo "<tr><td>Théorie des graphes et recherche opérationnelle</td><td>" . number_format($gra_avg, 2) . "</td></tr>";
    echo "<tr><td>Atelier de Génie Logiciel (AGL)</td><td>" . number_format($agl_avg, 2) . "</td></tr>";
    echo "<tr><td>Architecture Logicielle</td><td>" . number_format($arlog_avg, 2) . "</td></tr>";
    echo "<tr><td>SGBD</td><td>" . number_format($bd_avg, 2) . "</td></tr>";
    echo "<tr><td>Modélisation multidimensionnelle et entrepôt de données</td><td>" . number_format($mod_avg, 2) . "</td></tr>";
    echo "<tr><td>Programmation OO avancée</td><td>" . number_format($poo_avg, 2) . "</td></tr>";
    echo "<tr><td>Développement durable</td><td>" . number_format($dd_avg, 2) . "</td></tr>";
    echo "<tr><td>Entrepreneuriat</td><td>" . number_format($ent_avg, 2) . "</td></tr>";
    echo "<tr><td>LEADERSHIP</td><td>" . number_format($lead_avg, 2) . "</td></tr>";
    echo "<tr><td>Développement Personnel</td><td>" . number_format($dp_avg, 2) . "</td></tr>";
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
