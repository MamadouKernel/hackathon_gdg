<?php


$session = session_id();
if (empty($session)) {
    session_start();
}

$root = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR;
define('chemin', $root);

include chemin.'core/DB_connect.php';
$db = new DATABASE();

include chemin.'apps/projet.php';
$projets = new PROJET($db);

include chemin.'apps/votant.php';
$votant = new VOTANT($db);

include chemin.'apps/vote.php';
$votes = new VOTE($db);



require chemin . 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader([chemin . 'template', chemin . 'view']);
$twig = new \Twig\Environment($loader, [
    //'cache' => chemin.'caches',
]);

//use Twig\Extra\String\StringExtension;

if (isset($_GET['logout']) and $_GET['logout'] == true) {
    unset($_SESSION['Users']);
    session_destroy();
    ?>
    <script>
        setTimeout(function () {
            window.location.href = '/'
        }, 0)
    </script>
<?php }
?>