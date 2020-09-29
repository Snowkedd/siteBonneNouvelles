<?php
	# Prise du temps actuel au début du script
	$time_start = microtime(true);

	# Variables globales du site
	define('CHEMIN_VUES','views/');
    define('EMAIL','jeanluc.collinet@ipl.be');
	$date = date("j/m/Y");
	
	# Require des classes automatisé
	function chargerClasse($classe) {
		require 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); 

	# Ecrire ici le header de toutes pages HTML
	require_once(CHEMIN_VUES . 'header.php');
	
	# Ecrire ici le menu du site de toutes pages HTML
	require_once(CHEMIN_VUES . 'menu.php');

	# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...
	$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
	# Quelle action est demandée ?
/**
 * @return GeneseController
 */
function callGenese()
{
    require_once('controllers/GeneseController.php');
    $controller = new GeneseController();
    return $controller;
}

/**
 * @return LivresController
 */
function callLivres()
{
    require_once('controllers/LivresController.php');
    $controller = new LivresController();
    return $controller;
}

/**
 * @return ContactController
 */
function callContact()
{
    require_once('controllers/ContactController.php');
    $controller = new ContactController();
    return $controller;
}

/**
 * @return AccueilController
 */
function callAccueil()
{
    require_once('controllers/AccueilController.php');
    $controller = new AccueilController();
    return $controller;
}

switch($action) {
		case 'genese':
			$controller = callGenese();
            break;
		case 'livres':
			$controller = callLivres();
            break;
		case 'contact':
			$controller = callContact();
            break;	
		default: # Par défaut, le contrôleur de l'accueil est sélectionné
			$controller = callAccueil();
            break;
	}
	# Exécution du contrôleur correspondant à l'action demandée
	$controller->run();
	
	# Ecrire ici le footer du site de toutes pages HTML
	require_once(CHEMIN_VUES . 'footer.php');

?>