<html lang="en">
<head>
    <meta name="google-adsense-account" content="ca-pub-5006802001974928">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calcule.css">
</head>
</html>

<?php


// Récupération des notes depuis le formulaire
$poo_td = $_POST['poo_td'];
$poo_ds1 = $_POST['poo_ds1'];
$poo_ds2 = $_POST['poo_ds2'];

$pw1_tp = $_POST['pw1_tp'];
$pw1_ds1 = $_POST['pw1_ds1'];
$pw1_ds2 = $_POST['pw1_ds2'];

$coo_exam = $_POST['coo_exam'];
$coo_ds1 = $_POST['coo_ds1'];

$bd_exam = $_POST['bd_exam'];
$bd_ds1 = $_POST['bd_ds1'];

$stat_exam = $_POST['stat_exam'];
$stat_ds1 = $_POST['stat_ds1'];

$ia_exam = $_POST['ia_exam'];
$ia_ds1 = $_POST['ia_ds1'];

$md_td = $_POST['md_td'];
$md_ds1 = $_POST['md_ds1'];
$md_ds2 = $_POST['md_ds2'];

$eco_exam = $_POST['eco_exam'];
$eco_ds1 = $_POST['eco_ds1'];

$gp_td = $_POST['gp_td'];
$gp_ds1 = $_POST['gp_ds1'];
$gp_ds2 = $_POST['gp_ds2'];

$apy_ds1 = $_POST['apy_ds1'];
$apy_ds2 = $_POST['apy_ds2'];

$eth_td = $_POST['eth_td'];
$eth_ds1 = $_POST['eth_ds1'];
$eth_ds2 = $_POST['eth_ds2'];

$ppp_ds1 = $_POST['ppp_ds1'];
$ppp_ds2 = $_POST['ppp_ds2'];

// Formules de calcul des moyennes
$poo_avg = $poo_ds1 * 0.4 + $poo_ds2 * 0.4 + $poo_td * 0.2;
$pw1_avg = $pw1_tp * 0.2 + $pw1_ds1 * 0.4 + $pw1_ds2 * 0.4;
$coo_avg = $coo_ds1 * 0.3 + $coo_exam * 0.7;
$bd_avg = $bd_ds1 * 0.3 + $bd_exam * 0.7;
$stat_avg = $stat_ds1 * 0.3 + $stat_exam * 0.7;
$ia_avg = $ia_ds1 * 0.3 + $ia_exam * 0.7;
$md_avg = $md_ds1 * 0.4 + $md_ds2 * 0.4 + $md_td * 0.2;
$eco_avg = $eco_ds1 * 0.3 + $eco_exam * 0.7;
$gp_avg = $gp_ds1 * 0.4 + $gp_ds2 * 0.4 + $gp_td * 0.2;
$apy_avg = $apy_ds1 * 0.5 + $apy_ds2 * 0.5;
$eth_avg = $eth_ds1 * 0.4 + $eth_ds2 * 0.4 + $eth_td * 0.2;
$ppp_avg = $ppp_ds1 * 0.5 + $ppp_ds2 * 0.5;

// Vérification des crédits (≥10)
$poo_credits = ($poo_avg >= 10) ? 3 : 0;
$pw1_credits = ($pw1_avg >= 10) ? 2 : 0;
$coo_credits = ($coo_avg >= 10) ? 2 : 0;
$bd_credits = ($bd_avg >= 10) ? 3 : 0;
$stat_credits = ($stat_avg >= 10) ? 2 : 0;
$ia_credits = ($ia_avg >= 10) ? 2 : 0;
$md_credits = ($md_avg >= 10) ? 2 : 0;
$eco_credits = ($eco_avg >= 10) ? 2 : 0;
$gp_credits = ($gp_avg >= 10) ? 4 : 0;
$apy_credits = ($apy_avg >= 10) ? 2 : 0;
$eth_credits = ($eth_avg >= 10) ? 2 : 0;
$ppp_credits = ($ppp_avg >= 10) ? 4 : 0;

// Coefficients
$poo_coeff = 1.5;
$pw1_coeff = 1;
$coo_coeff = 1;
$bd_coeff = 1.5;
$stat_coeff = 1;
$ia_coeff = 1;
$md_coeff = 1;
$eco_coeff = 1;
$gp_coeff = 2;
$apy_coeff = 1;
$eth_coeff = 1;
$ppp_coeff = 2;

// Moyenne générale pondérée
$total_coeff = $poo_coeff + $pw1_coeff + $coo_coeff + $bd_coeff + $stat_coeff + $ia_coeff + $md_coeff + $eco_coeff + $gp_coeff + $apy_coeff + $eth_coeff + $ppp_coeff;
$general_avg = ($poo_avg * $poo_coeff + $pw1_avg * $pw1_coeff + $coo_avg * $coo_coeff + $bd_avg * $bd_coeff + $stat_avg * $stat_coeff + $ia_avg * $ia_coeff + $md_avg * $md_coeff + $eco_avg * $eco_coeff + $gp_avg * $gp_coeff + $apy_avg * $apy_coeff + $eth_avg * $eth_coeff + $ppp_avg * $ppp_coeff) / $total_coeff;

// Total des crédits
$total_credits = $poo_credits + $pw1_credits + $coo_credits + $bd_credits + $stat_credits + $ia_credits + $md_credits + $eco_credits + $gp_credits + $apy_credits + $eth_credits + $ppp_credits;

// Affichage des résultats
echo '<h1>Résultats Académiques</h1>';

echo '<table class="custom-table">';
echo '<tr><th>Matière</th><th>Moyenne</th></tr>';
echo "<tr><td>Programmation OO</td><td>" . number_format($poo_avg, 2) . "</td></tr>";
echo "<tr><td>Programmation Web 1</td><td>" . number_format($pw1_avg, 2) . "</td></tr>";
echo "<tr><td>Conception OO des Systèmes d'information</td><td>" . number_format($coo_avg, 2) . "</td></tr>";
echo "<tr><td>Bases de données</td><td>" . number_format($bd_avg, 2) . "</td></tr>";
echo "<tr><td>Statistiques inférentielles</td><td>" . number_format($stat_avg, 2) . "</td></tr>";
echo "<tr><td>Fondements de l’IA</td><td>" . number_format($ia_avg, 2) . "</td></tr>";
echo "<tr><td>Marketing Digital</td><td>" . number_format($md_avg, 2) . "</td></tr>";
echo "<tr><td>Economie Numérique</td><td>" . number_format($eco_avg, 2) . "</td></tr>";
echo "<tr><td>Gestion de la Production</td><td>" . number_format($gp_avg, 2) . "</td></tr>";
echo "<tr><td>Atelier Python</td><td>" . number_format($apy_avg, 2) . "</td></tr>";
echo "<tr><td>Ethique et lois des IT</td><td>" . number_format($eth_avg, 2) . "</td></tr>";
echo "<tr><td>Projet Professionnel Personnel (PPP)</td><td>" . number_format($ppp_avg, 2) . "</td></tr>";
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
