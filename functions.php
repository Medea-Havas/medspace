<?php

/**
 * Medea MedSpace Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Medea MedSpace
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_MEDEA_MEDSPACE_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{
    wp_enqueue_style('medea-medspace-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_MEDEA_MEDSPACE_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

/**
 * Medea admin theme
 */
function medspace_admin_color_scheme()
{
    //Get the theme directory
    $theme_dir = get_stylesheet_directory_uri();

    //MedSpace
    wp_admin_css_color(
        'medspace',
        __('MedSpace'),
        $theme_dir . '/medspace.css',
        array('#2f2940', '#fff', '#c44186', '#c44186')
    );
}
add_action('admin_init', 'medspace_admin_color_scheme');

/**
 * Extra user fields
 */
add_action('show_user_profile', 'extra_profile_fields');
add_action('edit_user_profile', 'extra_profile_fields');

function extra_profile_fields($user)
{ ?>

<h3>Información extra del perfil</h3>
<label for="sector">DNI/NIE</label>
<input type="text" name="dni" id="dni"
    value="<?php echo esc_attr(get_the_author_meta('dni', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="workplace">Centro de trabajo</label>
<input type="text" name="workplace" id="workplace"
    value="<?php echo esc_attr(get_the_author_meta('workplace', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="specialty">Especialidad</label>
<input type="text" name="specialty" id="specialty"
    value="<?php echo esc_attr(get_the_author_meta('specialty', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="student">¿Eres estudiante?</label>
<input type="text" name="student" id="student"
    value="<?php echo esc_attr(get_the_author_meta('student', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="province1">Provincia donde está colegiado</label>
<input type="text" name="province" id="province"
    value="<?php echo esc_attr(get_the_author_meta('province', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="colnum">Número de colegiado</label>
<input type="text" name="colnum" id="colnum"
    value="<?php echo esc_attr(get_the_author_meta('colnum', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="createddate">Fecha de creación</label>
<input type="text" name="createddate" id="createddate" disabled
    value="<?php echo esc_attr(get_the_author_meta('createddate', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="createdip">IP de creación</label>
<input type="text" name="createdip" id="createdip" disabled
    value="<?php echo esc_attr(get_the_author_meta('createdip', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="createddate">Fecha de último acceso</label>
<input type="text" name="lastaccessdate" id="lastaccessdate" disabled
    value="<?php echo esc_attr(get_the_author_meta('lastaccessdate', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<label for="lastaccessip">IP de último acceso</label>
<input type="text" name="lastaccessip" id="lastaccessip" disabled
    value="<?php echo esc_attr(get_the_author_meta('lastaccessip', $user->ID)); ?>"
    class="regular-text" /><br /><br />
<?php }

add_action('personal_options_update', 'extra_profile_fields_update');
add_action('edit_user_profile_update', 'extra_profile_fields_update');

function extra_profile_fields_update($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    update_user_meta($user_id, 'dni', $_POST['dni']);
    update_user_meta($user_id, 'workplace', ucwords(strtolower($_POST['workplace'])));
    update_user_meta($user_id, 'specialty', ucwords(strtolower($_POST['specialty'])));
    update_user_meta($user_id, 'student', $_POST['student']);
    update_user_meta($user_id, 'province', ucwords(strtolower($_POST['province'])));
    update_user_meta($user_id, 'colnum', ucwords(strtolower($_POST['colnum'])));
}

// Remove admin bar
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

// Upload file sizes
@ini_set('upload_max_size', '256M');
@ini_set('post_max_size', '256M');
@ini_set('max_execution_time', '300');

function custom_login_redirect()
{
    $roles = (array) wp_get_current_user()->roles;
    if (! in_array('administrator', $roles)) {
        return site_url('/usuario');
    }
    return;
}

add_filter('login_redirect', 'custom_login_redirect');

function user_last_login( $user_login, $user ) {
    update_user_meta( $user->ID, 'lastaccessdate', date('Y-m-d H:i:s') );
    update_user_meta( $user->ID, 'lastaccessip', $_SERVER['REMOTE_ADDR'] );
}
add_action( 'wp_login', 'user_last_login', 10, 2 );
?>