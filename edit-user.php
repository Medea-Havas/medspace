<?php

/**
 * Template Name: Edit user
 *
 * @subpackage medea-medspace
 */

wp_head(); ?>
<?php
/* Get user info. */
global $current_user, $wp_roles;

/* Load the registration file. */
$error = array();

/* If profile was saved, update profile. */
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {
    /* Update user password. */
    if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
        if ($_POST['pass1'] == $_POST['pass2']) {
            wp_update_user(array( 'ID' => $current_user->ID, 'user_pass' => esc_attr($_POST['pass1']) ));
        } else {
            $error[] = 'Las contraseñas introducidas no coinciden. Tu contraseña no ha sido actualizada.';
        }
    }

    /* Update user information. */
    if (!empty($_POST['url'])) {
        wp_update_user(array( 'ID' => $current_user->ID, 'user_url' => esc_url($_POST['url']) ));
    }
    if (!empty($_POST['email'])) {
        if (!is_email(esc_attr($_POST['email']))) {
            $error[] = 'El email introducido no es válido, inténtalo de nuevo';
        } elseif(email_exists(esc_attr($_POST['email'])) != $current_user->ID) {
            $error[] = 'Este email ya está en uso por otro usuario, prueba uno diferente';
        } else {
            wp_update_user(array('ID' => $current_user->ID, 'user_email' => esc_attr($_POST['email'])));
        }
    }

    if (!empty($_POST['first-name'])) {
        update_user_meta($current_user->ID, 'first_name', esc_attr($_POST['first-name']));
    }
    if (!empty($_POST['last-name'])) {
        update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last-name']));
    }
    if (!empty($_POST['description'])) {
        update_user_meta($current_user->ID, 'description', esc_attr($_POST['description']));
    }

    if (count($error) == 0) {
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect(site_url() . '/usuario');
        exit;
    }
}

if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>">
  <div class="entry-content entry">
    <?php the_content(); ?>
    <?php if (!is_user_logged_in()) : ?>
    <p class="warning">
      <?php 'Debes estar autenticado para editar tu perfil'; ?>
    </p>
    <?php else : ?>
    <?php if (count($error) > 0) {
        echo '<p class="error">' . implode("<br />", $error) . '</p>';
    } ?>
    <section id="edit-user">
      <h1>Editar usuario</h1>
      <a class="gravatar" href="https://es.gravatar.com"
        target="_blank"><?= wp_kses_post(get_avatar($user_id, 150)) ?></a>
      <form method="post" id="adduser"
        action="<?php the_permalink(); ?>">
        <p class="form-username">
          <label for="first-name">Nombre</label>
          <input class="text-input" name="first-name" type="text" id="first-name"
            value="<?php the_author_meta('first_name', $current_user->ID); ?>" />
        </p>
        <p class="form-username">
          <label for="last-name">Apellidos</label>
          <input class="text-input" name="last-name" type="text" id="last-name"
            value="<?php the_author_meta('last_name', $current_user->ID); ?>" />
        </p>
        <p class="form-email">
          <label for="email">Email</label>
          <input class="text-input" name="email" type="text" id="email"
            value="<?php the_author_meta('user_email', $current_user->ID); ?>" />
        </p>
        <p class="form-password">
          <label for="pass1">Contraseña
          </label>
          <input class="text-input" name="pass1" type="password" id="pass1" />
        </p>
        <p class="form-password">
          <label for="pass2">Repetir contraseña</label>
          <input class="text-input" name="pass2" type="password" id="pass2" />
        </p>
        <div class="extra-info">
          <?php
        //action hook for plugin and extra fields
        do_action('edit_user_profile', $current_user);
        ?>
        </div>
        <p class="form-submit">
          <?php //echo $referer;?>
          <a class="button button-border"
            href="<?= get_site_url() ?>/usuario">Volver</a>
          <input name="updateuser" type="submit" id="updateuser" class="submit button" value="Actualizar" />
          <?php wp_nonce_field('update-user') ?>
          <input name="action" type="hidden" id="action" value="update-user" />
        </p>
      </form>
  </div>
</div>
</section>
<?php endif; ?>
</div>
</div>
</section>
<?php endwhile; ?>
<?php else: ?>
<p class="no-data">
  <?php 'No hay datos'; ?>
</p>
<?php endif;

wp_footer();
?>