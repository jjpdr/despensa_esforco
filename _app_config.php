<?php
/**
 * @package Despesnsa Esforço v3.0 
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
		
	// Categoria
	'GET:categorias' => array('route' => 'Categoria.ListView'),
	'GET:categoria/(:num)' => array('route' => 'Categoria.SingleView', 'params' => array('id' => 1)),
	'GET:api/categorias' => array('route' => 'Categoria.Query'),
	'POST:api/categoria' => array('route' => 'Categoria.Create'),
	'GET:api/categoria/(:num)' => array('route' => 'Categoria.Read', 'params' => array('id' => 2)),
	'PUT:api/categoria/(:num)' => array('route' => 'Categoria.Update', 'params' => array('id' => 2)),
	'DELETE:api/categoria/(:num)' => array('route' => 'Categoria.Delete', 'params' => array('id' => 2)),
		
	// CompraAutomatica
	'GET:compraautomaticas' => array('route' => 'CompraAutomatica.ListView'),
	'GET:compraautomatica/(:num)' => array('route' => 'CompraAutomatica.SingleView', 'params' => array('id' => 1)),
	'GET:api/compraautomaticas' => array('route' => 'CompraAutomatica.Query'),
	'POST:api/compraautomatica' => array('route' => 'CompraAutomatica.Create'),
	'GET:api/compraautomatica/(:num)' => array('route' => 'CompraAutomatica.Read', 'params' => array('id' => 2)),
	'PUT:api/compraautomatica/(:num)' => array('route' => 'CompraAutomatica.Update', 'params' => array('id' => 2)),
	'DELETE:api/compraautomatica/(:num)' => array('route' => 'CompraAutomatica.Delete', 'params' => array('id' => 2)),
		
	// EnderecoEntrega
	'GET:enderecoentregas' => array('route' => 'EnderecoEntrega.ListView'),
	'GET:enderecoentrega/(:num)' => array('route' => 'EnderecoEntrega.SingleView', 'params' => array('id' => 1)),
	'GET:api/enderecoentregas' => array('route' => 'EnderecoEntrega.Query'),
	'POST:api/enderecoentrega' => array('route' => 'EnderecoEntrega.Create'),
	'GET:api/enderecoentrega/(:num)' => array('route' => 'EnderecoEntrega.Read', 'params' => array('id' => 2)),
	'PUT:api/enderecoentrega/(:num)' => array('route' => 'EnderecoEntrega.Update', 'params' => array('id' => 2)),
	'DELETE:api/enderecoentrega/(:num)' => array('route' => 'EnderecoEntrega.Delete', 'params' => array('id' => 2)),
		
	// MetodoPagamento
	'GET:metodopagamentos' => array('route' => 'MetodoPagamento.ListView'),
	'GET:metodopagamento/(:num)' => array('route' => 'MetodoPagamento.SingleView', 'params' => array('id' => 1)),
	'GET:api/metodopagamentos' => array('route' => 'MetodoPagamento.Query'),
	'POST:api/metodopagamento' => array('route' => 'MetodoPagamento.Create'),
	'GET:api/metodopagamento/(:num)' => array('route' => 'MetodoPagamento.Read', 'params' => array('id' => 2)),
	'PUT:api/metodopagamento/(:num)' => array('route' => 'MetodoPagamento.Update', 'params' => array('id' => 2)),
	'DELETE:api/metodopagamento/(:num)' => array('route' => 'MetodoPagamento.Delete', 'params' => array('id' => 2)),
		
	// Produto
	'GET:produtos' => array('route' => 'Produto.ListView'),
	'GET:produto/(:num)' => array('route' => 'Produto.SingleView', 'params' => array('id' => 1)),
	'GET:api/produtos' => array('route' => 'Produto.Query'),
	'POST:api/produto' => array('route' => 'Produto.Create'),
	'GET:api/produto/(:num)' => array('route' => 'Produto.Read', 'params' => array('id' => 2)),
	'PUT:api/produto/(:num)' => array('route' => 'Produto.Update', 'params' => array('id' => 2)),
	'DELETE:api/produto/(:num)' => array('route' => 'Produto.Delete', 'params' => array('id' => 2)),
		
	// SupermercadoFavorito
	'GET:supermercadofavoritos' => array('route' => 'SupermercadoFavorito.ListView'),
	'GET:supermercadofavorito/(:num)' => array('route' => 'SupermercadoFavorito.SingleView', 'params' => array('id' => 1)),
	'GET:api/supermercadofavoritos' => array('route' => 'SupermercadoFavorito.Query'),
	'POST:api/supermercadofavorito' => array('route' => 'SupermercadoFavorito.Create'),
	'GET:api/supermercadofavorito/(:num)' => array('route' => 'SupermercadoFavorito.Read', 'params' => array('id' => 2)),
	'PUT:api/supermercadofavorito/(:num)' => array('route' => 'SupermercadoFavorito.Update', 'params' => array('id' => 2)),
	'DELETE:api/supermercadofavorito/(:num)' => array('route' => 'SupermercadoFavorito.Delete', 'params' => array('id' => 2)),

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
?>