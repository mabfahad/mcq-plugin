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

function se_mcq_load_textdomain() {
	load_plugin_textdomain( 'se-mcq', false, plugin_dir_path( __FILE__ ) . "languages/" );
}
add_action( 'plugins_loaded', 'se_mcq_load_textdomain' );
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

/**
 * Add a sidebar.
 */
function quiz_sidebar() {
    register_sidebar( array(
        'name'          => __( 'Quizzes', 'se-mcq' ),
        'id'            => 'quizz-sidebar',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'se-mcq' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'quiz_sidebar' );