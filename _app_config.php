<?php
/**
 * @package W2O
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Feria
	'GET:ferias' => array('route' => 'Feria.ListView'),
	'GET:feria/(:num)' => array('route' => 'Feria.SingleView', 'params' => array('id' => 1)),
	'GET:api/ferias' => array('route' => 'Feria.Query'),
	'POST:api/feria' => array('route' => 'Feria.Create'),
	'GET:api/feria/(:num)' => array('route' => 'Feria.Read', 'params' => array('id' => 2)),
	'PUT:api/feria/(:num)' => array('route' => 'Feria.Update', 'params' => array('id' => 2)),
	'DELETE:api/feria/(:num)' => array('route' => 'Feria.Delete', 'params' => array('id' => 2)),
		
	// Gradehoraria
	'GET:gradeshorarias' => array('route' => 'Gradehoraria.ListView'),
	'GET:gradehoraria/(:num)' => array('route' => 'Gradehoraria.SingleView', 'params' => array('id' => 1)),
	'GET:api/gradeshorarias' => array('route' => 'Gradehoraria.Query'),
	'POST:api/gradehoraria' => array('route' => 'Gradehoraria.Create'),
	'GET:api/gradehoraria/(:num)' => array('route' => 'Gradehoraria.Read', 'params' => array('id' => 2)),
	'PUT:api/gradehoraria/(:num)' => array('route' => 'Gradehoraria.Update', 'params' => array('id' => 2)),
	'DELETE:api/gradehoraria/(:num)' => array('route' => 'Gradehoraria.Delete', 'params' => array('id' => 2)),
		
	// Materia
	'GET:materias' => array('route' => 'Materia.ListView'),
	'GET:materia/(:num)' => array('route' => 'Materia.SingleView', 'params' => array('id' => 1)),
	'GET:api/materias' => array('route' => 'Materia.Query'),
	'POST:api/materia' => array('route' => 'Materia.Create'),
	'GET:api/materia/(:num)' => array('route' => 'Materia.Read', 'params' => array('id' => 2)),
	'PUT:api/materia/(:num)' => array('route' => 'Materia.Update', 'params' => array('id' => 2)),
	'DELETE:api/materia/(:num)' => array('route' => 'Materia.Delete', 'params' => array('id' => 2)),
		
	// Professor
	'GET:professores' => array('route' => 'Professor.ListView'),
	'GET:professor/(:num)' => array('route' => 'Professor.SingleView', 'params' => array('id' => 1)),
	'GET:api/professores' => array('route' => 'Professor.Query'),
	'POST:api/professor' => array('route' => 'Professor.Create'),
	'GET:api/professor/(:num)' => array('route' => 'Professor.Read', 'params' => array('id' => 2)),
	'PUT:api/professor/(:num)' => array('route' => 'Professor.Update', 'params' => array('id' => 2)),
	'DELETE:api/professor/(:num)' => array('route' => 'Professor.Delete', 'params' => array('id' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Feria","FK__professor",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Gradehoraria","FK_gradehoraria_materia",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Professor","FK_professor_materia",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>