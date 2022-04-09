<?php
/**
 * Plugin Name:       SE MCQ
 * Plugin URI:        https://mcq.org
 * Description:       This plugin automatically generates mcq for learners
 * Version:           1.0.0
 * Author:            Md Abdullah Al Fahad
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       se-mcq
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-semcq-activator.php
 */
register_activation_hook( __FILE__, 'activate_semcq' );
function activate_semcq() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/SemcqActivator.php';
    SemcqActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-semcq-deactivator.php
 */
register_deactivation_hook( __FILE__, 'deactivate_semcq' );
function deactivate_semcq() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/SemcqDeactivator.php';
    SemcqDeactivator::deactivate();
}

// Autoload files load
$classes = glob(plugin_dir_path( __FILE__ ).'autoload/*.php');
if ($classes) {
	foreach ($classes as $class) {
		require_once $class;
	}
}

// Class files load
$classes = glob(plugin_dir_path( __FILE__ ).'classes/*.php');
if ($classes) {
	foreach ($classes as $class) {
		require_once $class;
	}
}

// API files load
$classes = glob(plugin_dir_path( __FILE__ ).'apis/*.php');
if ($classes) {
	foreach ($classes as $class) {
		require_once $class;
	}
}




/**
 * Quiz Widget Init
 */


function quizwidget_register(){
	register_widget('QuizWidget');
}
add_action('widgets_init','quizwidget_register');