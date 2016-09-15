<?php
/**
 * Oxo Framework
 *
 * Flexible Framework for OXOSolutions Wordpress Themes
 *
 * This file includes and loads all objects and functions necessary for the oxo framework.
 *
 * @author		OXOSolutions
 * @copyright	(c) Copyright by OXOSolutions
 * @link		http://oxosolutions.com
 * @package 	OxoFramework
 * @since		Version 1.0
 */

define( 'OXO_FRAMEWORK_VERSION', '1');

/**
 * Load all needed framework functions that don't belong to a separate class
 */
require( 'oxo-functions.php' );

/**
 * Ajax Functions
 *
 * @since 3.8.0
 */
require_once ( 'ajax-functions.php' );

// Omit closing PHP tag to avoid "Headers already sent" issues.

/**
 * github-updater
 *
 */
require_once ( 'libs/github-updater/github-updater.php' );

// Omit closing PHP tag to avoid "Headers already sent" issues.
