<?php
/**
 * Activamos los soportes del tema, 
 * formatos de post, la imagen del header y el fondo del sitio, 
 * la imagen destacada y el menu dinamico del Back-end
 */ 
$get_options = get_option( 'data_admin_support_format' ) ? get_option( 'data_admin_support_format' ) : array();
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$formats_check = array();
foreach ( $formats as $format ){
    $formats_check[] = $get_options[$format]==1 ? $format : "";
}

add_theme_support( 'post-formats', $formats_check );

add_theme_support( 'custom-header' );

add_theme_support( 'custom-background' );

add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-logo' );

function teaching_register_nav_menu() {
	register_nav_menu( 'primary', 'Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'teaching_register_nav_menu' );

/**
 * 
 * USUARIOS
 * 
 */ 
$skills = array("1", "2", "3", "4");
function extra_profile_skills($user) {
    ?>
    <h3>Skills del usuario</h3>
    <table class="form-table">
        <?php
        global $skills;
        foreach ($skills as $skill_key => $skill_value) {
            ?>
            <tr>
                <th>
                    <label for="skill_<?= $skill_key ?>_name">Nombre de la Skill <?= $skill_value ?></label><br><br>
                    <label for="skill_<?= $skill_key ?>_value">Valor de la Skill <?= $skill_value ?></label>
                </th>
                <td>
                    <input type="text" name="skill_<?= $skill_key ?>_name" id="skill_<?= $skill_key ?>_name" value="<?php echo esc_attr(get_the_author_meta("skill_" . $skill_key . "_name", $user->ID)) ?>" class="regular-text"/> <br/>
                    <span class="description">Nombre de su skill <?= $skill_value ?></span><br>
                    <input type="number" name="skill_<?= $skill_key ?>_value" id="skill_<?= $skill_key ?>_value" value="<?php echo esc_attr(get_the_author_meta("skill_" . $skill_key . "_value", $user->ID)) ?>" class="regular-text" max="100" min="0"/> <br/>
                    <span class="description">Introduzca el valor de su skill <?= $skill_value ?></span>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}

add_action('show_user_profile', 'extra_profile_skills');
add_action('edit_user_profile', 'extra_profile_skills');

function save_extra_profile_skills($user_id) {
    global $skills;
    foreach ($skills as $skill_key => $skill_value) {
        update_usermeta($user_id, "skill_" . $skill_key . "_name", $_POST["skill_" . $skill_key . "_name"]);
        update_usermeta($user_id, "skill_" . $skill_key . "_value", $_POST["skill_" . $skill_key . "_value"]);
    }
}

add_action('personal_options_update', 'save_extra_profile_skills');
add_action('edit_user_profile_update', 'save_extra_profile_skills');

//Deshabilita la proteccion de etiquetas html para la biografia de los usuarios
remove_filter('pre_user_description', 'wp_filter_kses');
