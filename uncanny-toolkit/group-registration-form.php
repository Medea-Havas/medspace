<style>
  /* CUSTOM SELECT */
  .custom-select {
    position: relative;
  }

  .custom-select select {
    display: none;
  }

  .hideToStudents {
    display: none;
  }

  .nooverflow .select-items {
    overflow: hidden;
  }

  .select-selected {
    background-color: white;
    font-size: 0.694rem;
  }

  .select-selected:after {
    position: absolute;
    content: "";
    top: 29px;
    right: 10px;
    width: 0;
    height: 0;
    border: 6px solid transparent;
    border-color: #3961ab transparent transparent transparent;
  }

  .select-selected.select-arrow-active:after {
    border-color: transparent transparent #3961ab transparent;
    top: 23px;
  }

  .select-items div,
  .select-selected {
    padding: .40rem .75rem;
    border: 1px solid transparent;
    cursor: pointer;
  }

  .select-items div {
    border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
    color: white;
  }

  .select-selected {
    border: 1px solid #3961ab;
    color: #3961ab;
  }

  .select-selected.placeholder {
    color: darkgray;
  }

  .select-items {
    border: 1px solid #3961ab;
    font-size: 0.694rem;
    max-height: 20rem;
    overflow-y: scroll;
    position: absolute;
    background-color: #79b0dd;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 99;
  }

  .select-hide {
    display: none;
  }

  .select-items div:hover,
  .same-as-selected {
    background-color: rgba(0, 0, 0, 0.1);
  }
</style>
<?php
$id = get_the_ID();
$post = get_post($id); ?>
<p class="section-name">Bienvenido</p>
<h1><?= $post->post_title ?>
</h1>
<div class="course-info">
  <div class="course-info-top">
    <?= get_the_post_thumbnail($id, 'large') ?>
    <div class="description">
      <?= get_post_meta($id, '_learndash_course_grid_short_description')[0] ?>
    </div>
  </div>
  <div class="course-info-bottom">
    <form id="uncanny_group_signup_registration_form" class="uncanny_group_signup_form" action="" method="POST">
      <div class="form-fields">
        <div class="form-field">
          <label
            for="uncanny_group_signup_user_first"><?php esc_html_e('First Name', 'uncanny-pro-toolkit'); ?></label><br />
          <input name="uncanny_group_signup_user_first" id="uncanny_group_signup_user_first"
            placeholder="<?php esc_html_e('First Name', 'uncanny-pro-toolkit'); ?>"
            value="<?php if (isset($_POST['uncanny_group_signup_user_first'])) {
                echo sanitize_text_field($_POST['uncanny_group_signup_user_first']);
            } ?>" class="required" type="text" required />
        </div>
        <div class="form-field">
          <label
            for="uncanny_group_signup_user_last"><?php esc_html_e('Last Name', 'uncanny-pro-toolkit'); ?></label><br />
          <input name="uncanny_group_signup_user_last" id="uncanny_group_signup_user_last"
            placeholder="<?php esc_html_e('Last Name', 'uncanny-pro-toolkit'); ?>"
            value="<?php if (isset($_POST['uncanny_group_signup_user_last'])) {
                echo sanitize_text_field($_POST['uncanny_group_signup_user_last']);
            } ?>" class="required" type="text" required />
        </div>
        <div class="form-field">
          <label
            for="uncanny_group_signup_user_email"><?php esc_html_e('Email', 'uncanny-pro-toolkit'); ?></label><br />
          <input name="uncanny_group_signup_user_email" id="uncanny_group_signup_user_email"
            placeholder="<?php esc_html_e('Email', 'uncanny-pro-toolkit'); ?>"
            value="<?php if (isset($_POST['uncanny_group_signup_user_email'])) {
                echo sanitize_text_field($_POST['uncanny_group_signup_user_email']);
            } ?>" class="required" type="email" required />
        </div>
        <div class="form-field">
          <label for="uncanny_group_signup_user_phone">Teléfono</label><br />
          <input name="uncanny_group_signup_user_phone" id="uncanny_group_signup_user_phone" placeholder="Teléfono"
            value="<?php if (isset($_POST['uncanny_group_signup_user_phone'])) {
                echo sanitize_text_field($_POST['uncanny_group_signup_user_phone']);
            } ?>" class="required" type="tel" required />
        </div>
        <div class="form-field">
          <label for="uncanny_group_signup_user_dni">DNI/NIE</label><br />
          <input name="uncanny_group_signup_user_dni" id="uncanny_group_signup_user_dni" placeholder="DNI/NIE" value="<?php if (isset($_POST['uncanny_group_signup_user_dni'])) {
              echo sanitize_text_field($_POST['uncanny_group_signup_user_dni']);
          } ?>" class="required" type="text" required />
        </div>
        <div class="form-field">
          <label for="uncanny_group_signup_user_workplace">Centro de trabajo</label><br />
          <input name="uncanny_group_signup_user_workplace" id="uncanny_group_signup_user_workplace"
            placeholder="Centro de trabajo" value="<?php if (isset($_POST['uncanny_group_signup_user_workplace'])) {
                echo sanitize_text_field($_POST['uncanny_group_signup_user_workplace']);
            } ?>" class="required" type="text" required />
        </div>
        <div class="custom-select form-field">
          <label for="uncanny_group_signup_user_specialty">Especialidad</label><br />
          <select name="uncanny_group_signup_user_specialty" id="uncanny_group_signup_user_specialty" class="required"
            placeholder="Especialidad" required>
            <option name="">Especialidad</option>
            <option name="">-- MEDICINA --</option>
            <option name="Alergología">Alergología</option>
            <option name="Análisis clínicos">Análisis clínicos</option>
            <option name="Anatomía patológica">Anatomía patológica</option>
            <option name="Anestesiología y reanimación">Anestesiología y reanimación</option>
            <option name="Angiología y cirugía vascular">Angiología y cirugía vascular</option>
            <option name="Aparato digestivo">Aparato digestivo</option>
            <option name="Bioquímica clínica">Bioquímica clínica</option>
            <option name="Cardiología">Cardiología</option>
            <option name="Cirugía cardiovascular">Cirugía cardiovascular</option>
            <option name="Cirugía general y del aparato digestivo">Cirugía general y del aparato digestivo</option>
            <option name="Cirugía oral y maxilofacial">Cirugía oral y maxilofacial</option>
            <option name="Cirugía ortopédica y traumatología">Cirugía ortopédica y traumatología</option>
            <option name="Cirugía pediátrica">Cirugía pediátrica</option>
            <option name="Cirugía plástica estética y reparadora">Cirugía plástica estética y reparadora</option>
            <option name="Cirugía torácica">Cirugía torácica</option>
            <option name="Dermatología médico-quirúrgica">Dermatología médico-quirúrgica</option>
            <option name="Endocrinología y nutrición">Endocrinología y nutrición</option>
            <option name="Farmacología clínica">Farmacología clínica</option>
            <option name="Geriatría">Geriatría</option>
            <option name="Hematología y hemoterapia">Hematología y hemoterapia</option>
            <option name="Inmunología">Inmunología</option>
            <option name="Medicina de urgencias y emergencias">Medicina de urgencias y emergencias</option>
            <option name="Medicina del trabajo">Medicina del trabajo</option>
            <option name="Medicina legal y forense">Medicina legal y forense</option>
            <option name="Medicina familiar y comunitaria">Medicina familiar y comunitaria</option>
            <option name="Medicina física y rehabilitación">Medicina física y rehabilitación</option>
            <option name="Medicina intensiva">Medicina intensiva</option>
            <option name="Medicina interna">Medicina interna</option>
            <option name="Medicina nuclear">Medicina nuclear</option>
            <option name="Medicina preventiva y salud pública">Medicina preventiva y salud pública</option>
            <option name="Microbiología y parasitología">Microbiología y parasitología</option>
            <option name="Nefrología">Nefrología</option>
            <option name="Neumología">Neumología</option>
            <option name="Neurocirugía">Neurocirugía</option>
            <option name="Neurofisiología clínica">Neurofisiología clínica</option>
            <option name="Neurología">Neurología</option>
            <option name="Obstetricia y ginecología">Obstetricia y ginecología</option>
            <option name="">-- ENFERMERÍA --</option>
            <option name="Enfermería de salud mental">Enfermería de salud mental</option>
            <option name="Enfermería del trabajo">Enfermería del trabajo</option>
            <option name="Enfermería en cuidados médico-quirúrgicos">Enfermería en cuidados médico-quirúrgicos</option>
            <option name="Enfermería familiar y comunitaria">Enfermería familiar y comunitaria</option>
            <option name="Enfermería geriátrica">Enfermería geriátrica</option>
            <option name="Enfermería obstétrico-ginecológica (matrona)">Enfermería obstétrico-ginecológica (matrona)
            </option>
            <option name="Enfermería pediátrica">Enfermería pediátrica</option>
            <option name="">-- AUXILIAR DE ENFERMERÍA --</option>
            <option name="AE - Enfermería de salud mental">Enfermería de salud mental</option>
            <option name="AE - Enfermería del trabajo">Enfermería del trabajo</option>
            <option name="AE - Enfermería en cuidados médico-quirúrgicos">Enfermería en cuidados médico-quirúrgicos
            </option>
            <option name="AE - Enfermería familiar y comunitaria">Enfermería familiar y comunitaria</option>
            <option name="AE - Enfermería geriátrica">Enfermería geriátrica</option>
            <option name="AE - Enfermería obstétrico-ginecológica (matrona)">Enfermería obstétrico-ginecológica
              (matrona)
            </option>
            <option name="AE - Enfermería pediátrica">Enfermería pediátrica</option>
            <option name="">-- FARMACIA --</option>
            <option name="F - Análisis clínicos">Análisis clínicos</option>
            <option name="F - Bioquímica clínica">Bioquímica clínica</option>
            <option name="F - Micro y parasitología">Micro y parasitología</option>
            <option name="F - Inmunología">Inmunología</option>
            <option name="F - Radiofarmacia">Radiofarmacia</option>
            <option name="F - Farmacia comunitaria">Farmacia comunitaria</option>
            <option name="F - Farmacia galénica e industrial">Farmacia galénica e industrial</option>
            <option name="F - Farmacia hospitalaria">Farmacia hospitalaria</option>
            <option name="">-- AUXILIAR FARMACIA --</option>
            <option name="AF - Análisis clínicos">Análisis clínicos</option>
            <option name="AF - Bioquímica clínica">Bioquímica clínica</option>
            <option name="AF - Micro y parasitología">Micro y parasitología</option>
            <option name="AF - Inmunología">Inmunología</option>
            <option name="AF - Radiofarmacia">Radiofarmacia</option>
            <option name="AF - Farmacia comunitaria">Farmacia comunitaria</option>
            <option name="AF - Farmacia galénica e industrial">Farmacia galénica e industrial</option>
            <option name="AF - Farmacia hospitalaria">Farmacia hospitalaria</option>
          </select>
        </div>
        <div class="custom-select form-field nooverflow">
          <label for="uncanny_group_signup_user_student">¿Eres estudiante?</label><br />
          <select name="uncanny_group_signup_user_student" id="uncanny_group_signup_user_student" class="required"
            placeholder="¿Eres estudiante?" required>
            <option name="">¿Eres estudiante?</option>
            <option name="Sí">Sí</option>
            <option name="No">No</option>
          </select>
        </div>
        <div class="custom-select form-field hideToStudents">
          <label for="uncanny_group_signup_user_province">Provincia donde está colegiado</label><br />
          <select name="uncanny_group_signup_user_province" id="uncanny_group_signup_user_province" class="required"
            placeholder="Provincia donde está colegiado">
            <option name="">Provincia donde está colegiado</option>
            <option name="01-Álava">01-Álava</option>
            <option name="02-Albacete">02-Albacete</option>
            <option name="03-Alicante">03-Alicante</option>
            <option name="04-Almería">04-Almería</option>
            <option name="05-Ávila">05-Ávila</option>
            <option name="06-Badajoz">06-Badajoz</option>
            <option name="07-Baleares">07-Baleares</option>
            <option name="08-Barcelona">08-Barcelona</option>
            <option name="09-Burgos">09-Burgos</option>
            <option name="10-Cáceres">10-Cáceres</option>
            <option name="11-Cádiz">11-Cádiz</option>
            <option name="12-Castellón">12-Castellón</option>
            <option name="13-Ciudad Real">13-Ciudad Real</option>
            <option name="14-Córdoba">14-Córdoba</option>
            <option name="15-A Coruña">15-A Coruña</option>
            <option name="16-Cuenca">16-Cuenca</option>
            <option name="17-Girona">17-Girona</option>
            <option name="18-Granada">18-Granada</option>
            <option name="19-Guadalajara">19-Guadalajara</option>
            <option name="20-Gipuzkoa">20-Gipuzkoa</option>
            <option name="21-Huelva">21-Huelva</option>
            <option name="22-Huesca">22-Huesca</option>
            <option name="23-Jaén">23-Jaén</option>
            <option name="24-León">24-León</option>
            <option name="25-Lleida">25-Lleida</option>
            <option name="26-La Rioja">26-La Rioja</option>
            <option name="27-Lugo">27-Lugo</option>
            <option name="28-Madrid">28-Madrid</option>
            <option name="29-Málaga">29-Málaga</option>
            <option name="30-Murcia">30-Murcia</option>
            <option name="31-Navarra">31-Navarra</option>
            <option name="32-Ourense">32-Ourense</option>
            <option name="33-Asturias">33-Asturias</option>
            <option name="34-Palencia">34-Palencia</option>
            <option name="35-Las">35-Las Palmas</option>
            <option name="36-Pontevedra">36-Pontevedra</option>
            <option name="37-Salamanca">37-Salamanca</option>
            <option name="38-Santa Cruz de Tenerife">38-Santa Cruz de Tenerife</option>
            <option name="39-Cantabria">39-Cantabria</option>
            <option name="40-Segovia">40-Segovia</option>
            <option name="41-Sevilla">41-Sevilla</option>
            <option name="42-Soria">42-Soria</option>
            <option name="43-Tarragona">43-Tarragona</option>
            <option name="44-Teruel">44-Teruel</option>
            <option name="45-Toledo">45-Toledo</option>
            <option name="46-Valencia">46-Valencia</option>
            <option name="47-Valladolid">47-Valladolid</option>
            <option name="48-Vizcaya">48-Vizcaya</option>
            <option name="49-Zamora">49-Zamora</option>
            <option name="50-Zaragoza">50-Zaragoza</option>
            <option name="51-Ceuta">51-Ceuta</option>
            <option name="52-Melilla">52-Melilla</option>
          </select>
        </div>
        <div class="form-field hideToStudents">
          <label for="uncanny_group_signup_user_colnum">Número de colegiado<sup>(1)</sup></label><br />
          <input name="uncanny_group_signup_user_colnum" id="uncanny_group_signup_user_colnum" pattern="[0-9]{5}"
            placeholder="Número de colegiado" value="<?php if (isset($_POST['uncanny_group_signup_user_colnum'])) {
                echo sanitize_text_field($_POST['uncanny_group_signup_user_colnum']);
            } ?>" class="required" type="number" />
        </div>
        <div class="form-field">
          <label
            for="password"><?php esc_html_e('Password', 'uncanny-pro-toolkit'); ?></label><br />
          <input name="uncanny_group_signup_user_pass" id="password" class="required"
            placeholder="<?php esc_html_e('Password', 'uncanny-pro-toolkit'); ?>"
            type="password" required />
        </div>
        <div class="form-field">
          <label
            for="password_again"><?php esc_html_e('Confirm Password', 'uncanny-pro-toolkit'); ?></label><br />
          <input name="uncanny_group_signup_user_pass_confirm" id="password_again" class="required"
            placeholder="<?php esc_html_e('Confirm Password', 'uncanny-pro-toolkit'); ?>"
            type="password" required />
        </div>
        <div class="form-field full-width">
          <input id="uncanny_group_signup_user_legal" type="checkbox" name="uncanny_group_signup_user_legal"> <label
            for="uncanny_group_signup_user_legal">He leído y acepto el <a
              href="<?= site_url() ?>/terminos-uso"
              target="_blank">aviso legal</a> y la <a
              href="<?= site_url() ?>/politica-privacidad"
              target="_blank">política de privacidad</a></label>
          <p class="hideToStudents">(1) Si su número de colegiado sólo tiene 4 cifras, deberá añadir un 0 al principio
          </p>
        </div>
        <input name="uncanny_group_signup_user_createddate" id="uncanny_group_signup_user_createddate"
          value="<?= date("Y-m-d H:i:s"); ?>"
          type="hidden" />
        <input name="uncanny_group_signup_user_createdip" id="uncanny_group_signup_user_createdip"
          value="<?= $_SERVER['REMOTE_ADDR'] ?>"
          type="hidden" />
        <input name="uncanny_group_signup_user_login" id="uncanny_group_signup_user_login" value="" type="hidden" />
      </div>
      <div class="hidden-fields">
        <input type="hidden" name="uncanny_group_signup_register_nonce"
          value="<?php echo wp_create_nonce('uncanny_group_signup-register-nonce'); ?>" />
        <input type="hidden" name="gid"
          value="<?php echo get_the_ID(); ?>" />
        <input type="hidden" name="group_id"
          value="<?php echo get_the_ID(); ?>" />
        <input type="hidden" name="key"
          value="<?php echo crypt(get_the_ID(), 'uncanny-group'); ?>" />
      </div>
      <div class="buttons">
        <input type="submit" class="btn btn-default"
          value="<?php esc_html_e('Register Your Account', 'uncanny-pro-toolkit'); ?>" />
      </div>
    </form>
  </div>
</div>
<script>
  // Username
  var randNums = ("" + Math.random()).substring(2, 5);
  var userName = ['', ''];
  var name = document.getElementById('uncanny_group_signup_user_first').value.split(' ')[0];
  var lastName = document.getElementById('uncanny_group_signup_user_last').value.split(' ')[0];
  if (name != '' && lastName != '') {
    userName[0] = name.toLowerCase();
    userName[0] = userName[0].charAt(0).toUpperCase() + userName[0].slice(1);
    userName[1] = lastName.toLowerCase();
    userName[1] = userName[1].charAt(0).toUpperCase() + userName[1].slice(1);
    document.getElementById('uncanny_group_signup_user_login').value = userName[0] + userName[1] + randNums;
  }
  document.getElementById('uncanny_group_signup_user_first').addEventListener("focusout", function(e) {
    userName[0] = e.target.value.split(' ')[0].toLowerCase();
    userName[0] = userName[0].charAt(0).toUpperCase() + userName[0].slice(1);
    document.getElementById('uncanny_group_signup_user_login').value = userName[0] + userName[1] + randNums;
  });
  document.getElementById('uncanny_group_signup_user_last').addEventListener("focusout", function(e) {
    userName[1] = e.target.value.split(' ')[0].toLowerCase();
    userName[1] = userName[1].charAt(0).toUpperCase() + userName[1].slice(1);
    document.getElementById('uncanny_group_signup_user_login').value = userName[0] + userName[1] + randNums;
  });
  // Custom select
  var x, i, j, l, ll, selElmnt, a, b, c;
  x = document.getElementsByClassName("custom-select");
  l = x.length;
  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    a = document.createElement("div");
    a.setAttribute("class", "select-selected placeholder");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    b = document.createElement("div");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
      c = document.createElement("div");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
      e.stopPropagation();
      closeAllSelect(this);
      var val = e.target.innerHTML;
      if (!val.startsWith('-') && !val.startsWith('Especialidad') && !val.startsWith(
          'Provincia donde está actualmente colegiado') && !val.startsWith(
          'Provincia donde se colegió por primera vez') && !val.startsWith('¿Eres estudiante?')) {
        this.classList.remove('placeholder');
      } else {
        this.classList.add('placeholder');
      }
      if (this.parentElement.classList.contains('nooverflow')) {
        var hidden = document.getElementsByClassName('hideToStudents');
        if (val.startsWith('No')) {
          // Not student
          for (var i = 0; i < hidden.length; i++) {
            hidden[i].style.display = 'block';
          }
        } else {
          // Not student
          for (var i = 0; i < hidden.length; i++) {
            hidden[i].style.display = 'none';
          }
        }
      }
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
  }

  function closeAllSelect(elmnt) {
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  document.addEventListener("click", closeAllSelect);
  //
</script>