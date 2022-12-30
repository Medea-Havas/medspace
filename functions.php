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
add_action('personal_options_update', 'extra_profile_fields_update');
add_action('edit_user_profile_update', 'extra_profile_fields_update');

// Remove admin bar

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');

// Upload file sizes
@ini_set('upload_max_size', '256M');
@ini_set('post_max_size', '256M');
@ini_set('max_execution_time', '300');

// User redirect
function custom_login_redirect($redirect_to, $request, $user)
{
    if (isset($user->roles) && is_array($user->roles)) {
        //check for admins
        if (in_array('administrator', $user->roles)) {
            // redirect them to the default place
            return site_url('/wp-admin');
        }
        if (in_array('group_leader', $user->roles)) {
            return site_url('/gestion-grupo');
        }
        return site_url('/usuario');
    }
    return site_url();
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);

function user_last_login($user_login, $user)
{
    update_user_meta($user->ID, 'lastaccessdate', date('Y-m-d H:i:s'));
    update_user_meta($user->ID, 'lastaccessip', $_SERVER['REMOTE_ADDR']);
}
add_action('wp_login', 'user_last_login', 10, 2);

// Different menu for Group Leaders
function my_wp_nav_menu_args($args = '')
{
    $user = wp_get_current_user();
    $args['menu'] = 4;
    if (isset($user->roles) && is_array($user->roles) && in_array('group_leader', $user->roles)) {
        $args['menu'] = 16;
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');

// Date shortcode
function wpb_date_today($atts)
{
    extract(shortcode_atts(array(
            'format' => ''
        ), $atts));

    $months = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
    $month = $months[date('n')-1];
    $date = date('j') . ' de ' . $month . ' del ' . date('Y');

    return $date;
}
add_shortcode('date-today', 'wpb_date_today');

// QR Code shortcode
function adri_qr_code($atts)
{
    // Attributes
    $atts = shortcode_atts(
        [
        'domain' => '',
        'expnum' => '',
        'certnum' => '',
        'city' => '',
        'hours' => '',
        'tutor' => '',
        'creds' => '',
        ],
        $atts,
        'img'
    );

    $courseID = isset($_GET['course_id']) ? $_GET['course_id'] : '';
    $previewID = isset($_GET['preview_id']) ? $_GET['preview_id'] : '';

    $currentUser = wp_get_current_user();
    $userData = new stdClass();

    $userData->userId = $currentUser->ID;
    $userData->certificateId = get_post()->ID;
    $userData->certificateDate = date('d-m-Y');
    $userData->expnum = $atts['expnum'];
    $userData->certnum = $atts['certnum'];
    $userData->city = $atts['city'];
    $userData->hours = $atts['hours'];
    $userData->tutor = $atts['tutor'];
    $userData->creds = $atts['creds'];

    if ($courseID != '') {
        $userData->courseId = $courseID;
    } elseif ($previewID != '') {
        $userData->courseId = $previewID;
    }

    $userDataToJson = json_encode($userData, JSON_UNESCAPED_UNICODE);
    $encodedData = getEncodedUser($userDataToJson);

    $domain = site_url();
    if ($atts['domain'] != '') {
        $domain = $atts['domain'];
    }
    if ($encodedData != '') {
        $return = '<img src="https://chart.googleapis.com/chart?cht=qr&chs=100x100&chld=L&chl=' . $domain . '?data=' . $encodedData . '">';
    // $return = '<p style="font-size:8px">CourseId: ' . $courseID . ' - ' . $encodedData . '</p><img src="https://chart.googleapis.com/chart?cht=qr&chs=100x100&chld=L&chl=' . $domain . '?data=' . $encodedData . '">';
    } else {
        $return = '<p>Error, no encoded data.</p>';
    }
    return $return;
}
add_shortcode('qr-code', 'adri_qr_code');

function getEncodedUser($userData)
{
    $res = '';
    // Store a string into the variable which
    // need to be Encrypted
    $simple_string = $userData;

    // Display the original string
    $res .= 'Original string: ' . $simple_string . '\n';

    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "medspace22";

    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt(
        $simple_string,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    // return $res;
    return $encryption;
}

// Learndash Next Lesson Link shortcode
function ld_next_lesson_link($course_id = null)
{
    global $post;
    $user = _wp_get_current_user();

    if (is_null($course_id)) {
        $course_id = learndash_get_course_id($post);
    }

    if (!$course_id || !isset($user->ID)) {
        // User Not Logged In OR No Course Identified
        return false;
    }

    $lessons = learndash_get_lesson_list($course_id);
    // Defaults to first lesson
    $lesson_id = $lessons[0];

    if (!$lessons) {
        // No Lesson
        return false;
    }

    // If user has progress, stablishes next lesson
    $user_course_progress = get_user_meta($user->ID, '_sfwd-course_progress', true);

    if (isset($user_course_progress[$course_id])) {
        $course_progress = $user_course_progress[$course_id];
        $completed = isset($course_progress['completed']) ? $course_progress['completed'] : 0;
        $total = isset($course_progress['total']) ? $course_progress['total'] : 0;
        $lessons = array_keys($course_progress['lessons']);

        if ($total) {
            $lesson_id = $completed < $total ? $lessons[$completed] : $lessons[0];
        }
    }

    if (!$lesson_id) {
        // No Lesson ID
        return false;
    }

    if ('sfwd-lessons' != get_post_type($lesson_id)) {
        // ID not for a Learndash Lesson
        return false;
    }

    $link = get_post_permalink($lesson_id);
    return $link;
}

function shortcode_ld_next_lesson_link($atts, $content = 'Next Lesson')
{
    extract(shortcode_atts(array(
        'course_id' => null,
        'class' => 'learndash-next-lesson'
    ), $atts));
    $url = ld_next_lesson_link($course_id);
    if ($url) {
        return '' . $url . '';
    }
    return false;
}
add_shortcode('ld_next_lesson_link', 'shortcode_ld_next_lesson_link');

// User header shortcode
function user_header_shortcode($atts)
{
    extract(shortcode_atts(array(
            'format' => ''
        ), $atts));

    $user = _wp_get_current_user();

    return '
        <div class="header-user">
            <a href="' . site_url() . '/usuario" class="user">
                <p>' . $user->first_name . '</p>
                <img src="' . get_avatar_url($user->id) . '">
            </a>
            <a class="logout" href="' . site_url() . '/wp-login.php?action=logout&redirect_to=' . site_url() . '">Salir</a>
        </div>
    ';
}
add_shortcode('user_header', 'user_header_shortcode');

?>