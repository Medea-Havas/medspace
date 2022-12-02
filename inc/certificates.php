<?php

/**
 * Template Name: Certificates
 *
 * @subpackage astra-child
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="{{ site.charset }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= wp_head() ?>
</head>
<?php
// Store the cipher method
$ciphering = "AES-128-CTR";

// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

$dataToDecrypt = $_GET['data'];

if (!isset($dataToDecrypt)) {
    exit('No hay datos');
}

// Non-NULL Initialization Vector for decryption
$decryption_iv = '1234567891011121';

// Store the decryption key
$decryption_key = "medspace22";

// Use openssl_decrypt() function to decrypt the data
$decryption = openssl_decrypt(
    $dataToDecrypt,
    $ciphering,
    $decryption_key,
    $options,
    $decryption_iv
);
$decryptionToJSON = json_decode($decryption, true);
$userId = $decryptionToJSON['userId'];
$user = get_userdata($userId);
$course = get_post($decryptionToJSON['courseId']);
$date = $decryptionToJSON['certificateDate'];
$expnum = $decryptionToJSON['expnum'];
$certnum = $decryptionToJSON['certnum'];
$city = $decryptionToJSON['city'];
$creds = $decryptionToJSON['creds'];
$hours = $decryptionToJSON['hours'];
$tutor = $decryptionToJSON['tutor'];
$lessons = learndash_get_course_lessons_list($decryptionToJSON['courseId']);
//echo '<pre>' . json_encode(json_decode($decryption), JSON_PRETTY_PRINT) . '</pre>';
?>

<body id="certificates">
  <?= do_shortcode('[elementor-template id="431"]') ?>
  <div class="container">
    <div class="headings-wrapper">
      <h1>Secretaría Técnica de Programas<br>de Formación Médica Continuada</h1>
      <h2>Certificado del programa</h2>
    </div>
    <div class="info-block-wrapper">
      <div class="info-block">
        <p class="label">Curso:</p>
        <p class="info"><?= $course->post_title ?></p>
      </div>
      <div class="info-block">
        <p class="label">Acreditado por:</p>
        <p class="info">Comisión Formación Continuada Profesiones Sanitarias. Comunidad de Madrid</p>
      </div>
      <div class="info-block">
        <p class="label">Alumno:</p>
        <p class="info"><?= $user->display_name ?></p>
      </div>
      <div class="info-block">
        <p class="label">NIF:</p>
        <p class="info">
          <?= get_user_meta($user->id, 'dni')[0] ?>
        </p>
      </div>
      <div class="info-block">
        <p class="label">Fecha de emisión:</p>
        <p class="info"><?= $date ?></p>
      </div>
      <div class="info-block">
        <p class="label">Número de expediente:</p>
        <p class="info"><?= $expnum ?></p>
      </div>
      <div class="info-block">
        <p class="label">Número de certificado:</p>
        <p class="info"><?= $certnum ?></p>
      </div>
      <div class="info-block">
        <p class="label">Ciudad:</p>
        <p class="info"><?= $city ?></p>
      </div>
      <div class="info-block">
        <p class="label">Nº de créditos:</p>
        <p class="info"><?= $creds ?> créditos</p>
      </div>
      <div class="info-block">
        <p class="label">Nº de horas:</p>
        <p class="info"><?= $hours ?> horas</p>
      </div>
      <div class="info-block">
        <p class="label">Tutor/es:</p>
        <p class="info"><?= $tutor ?></p>
      </div>
    </div>
    <div class="info-block-wrapper-content">
      <div class="info-block-contents">
        <p class="label">Contenidos:</p>
        <div class="lessons">
          <?php foreach ($lessons as $lesson) { ?>
          <div class="lesson">
            <p class="lesson-title">
              <?= $lesson['post']->post_title ?>
            </p>
            <p class="lesson-info">
              <?= get_post_meta($lesson['post']->ID, '_learndash_course_grid_short_description', true) ?>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</body>
<?= wp_footer() ?>

</html>