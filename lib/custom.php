<?php
/**
 * Custom functions
 */
function admin_bar_customize() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
        //$wp_admin_bar->remove_menu('wpseo-menu');
        //$wp_admin_bar->remove_menu('wp-admin-wordpress-social-login');
        //$wp_admin_bar->remove_menu('nginx-helper-purge-all');
}
add_action('wp_before_admin_bar_render', 'admin_bar_customize', 999);
function adjust_the_wp_menu() {
        //remove_submenu_page('options-general.php', 'options-permalink.php');
        //remove_submenu_page('options-general.php', 'options-writing.php');
        //remove_submenu_page('options-general.php', 'crayon_settings' );
}
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function block_subscribers_from_admin_dashboard() {
    if ( is_admin() && !current_user_can('edit_posts') &&
       ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
}
add_action( 'admin_init', 'block_subscribers_from_admin_dashboard' );
function disable_admin_bar_for_subscribers() {
        if( ! current_user_can('edit_posts') )
                add_filter('show_admin_bar', '__return_false');
}
add_action( 'after_setup_theme', 'disable_admin_bar_for_subscribers' );
function roots_theme_customizer( $wp_customize ) {
$wp_customize->add_section( 'roots_logo_section' , array(
    'title'       => __( 'Logo', 'roots' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );
$wp_customize->add_setting( 'roots_logo' );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'roots_logo', array(
    'label'    => __( 'Logo', 'roots' ),
    'section'  => 'roots_logo_section',
    'settings' => 'roots_logo',
) ) );
}
add_action('customize_register', 'roots_theme_customizer');
function ajax_login_init(){
    wp_register_script('ajax-login-script', get_template_directory_uri() . '/ajax-login.js', array('jquery') );
    wp_enqueue_script('ajax-login-script');


    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die();
}