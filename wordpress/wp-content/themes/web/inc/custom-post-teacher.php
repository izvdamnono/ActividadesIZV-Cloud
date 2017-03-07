<?php

    function reg_post_type_travel() {
        
        //Los tres primeros elementos son predeterminados
        //Este array permite indicar a  WP que ventanas se muestran en su editor
        $supports   = array(
            'title', //post title
            'editor', //post content
            'author', //post author
            'thumbnail', // Aparece la interfaz para la seleccion de miniatura
            'excerpt', // Aparece la interfaz para agregar un nuevo excerpt
            'custom-fields', //Aparece la interfaz para los campos personalizados
            'comments',  //Aparece la interfaz para poder habilitar los comentarios pero no los habilita
            'revisions', //post revision
            'post-formats' //Aparece la interfaz de los distintos tipos de formatos de posts
        );
        
        //Registramos los labels de la interfaz de usuario de la parte de la administracion del post
        $labels     = array(
        
            'name' =>           _x('Profesores', 'plural'),
            'singular_name' =>  _x('Profesor', 'singular'),
            'menu_name' =>      _x('Profesores', 'admin menu'),
            'name_admin_bar' => _x('Profesor', 'admin bar'),
            'add_new' =>        _x('Añadir Nueva', 'add new'),
            //Acciones
            'add_new_item' =>   __('Add new teacher', 'web'),
            'new_item' =>       __('New teacher', 'web'),
            'edit_item' =>      __('Edit teacher', 'web'),
            'view_item' =>      __('See teacher', 'web'),
            'all_items' =>      __('Alls our teacher', 'web'),
            'search_items' =>   __('Search teacher', 'web'),
            'not_found' =>      __('No teachers found', 'web')
        );
        
        /*
            El array $args nos permite redefinir algunos aspectos del tipo de post. En este caso
            el tipo de post no es jerárquico(no tiene hijos), un slug para el permalink titulado
            excursions y una posicion en el menu lateral izquierdo del admin area justo debajo del
            menu de post
        */
        $args = array(
            
            'supports'      =>   $supports,
            'labels'        =>   $labels,
            //Caracteristicas de nuestro post personalizado
            'public'        =>   true,
            //Permite que el post aparezca en el loop
            'query_var'     =>  true,
            'rewrite'       =>  array('slug' => 'teachers'),
            'has_archive'   => true,
            'hierarchical'  => false,
            'menu_position' => 5,
			// This is where we add taxonomies to our CPT
        	//'taxonomies'    => array( 'category', 'post_tag' )

        );
        
        register_post_type('izv_teachers', $args);
    }

    add_action('init', 'reg_post_type_travel');

    function teacher_add_meta_box() {
        
        $screens = array('izv_teachers');
        
        //Para cada pantalla de edicion del custom post type...
        foreach ( $screens as $screen ) {
            
            /**
            *   1. Id de la caja de HTML
            *   2. Titulo de la caja
            *      El segundo parametro de la funcion indica el campo de la traduccion dentro
            *      del archivo mo y po
            *   3. Funcion que pinta el contenido de la caja HTML
            *   4. $screen es cada una de las paginas que tiene nuestro post personalizado
            *   5. La posicion de la caja (Debajo del editor)
            */
            add_meta_box(
                'teacher_sectionid',
                __('Detalles del Profesor', 'teacher_textdomain'),
                'teacher_meta_box_callback',
                $screen/*,
                'normal'*/
            );
        }
    }

    add_action( 'add_meta_boxes', 'teacher_add_meta_box');

    function teacher_meta_box_callback($post) {
        
        //Añadimos el campo 'nonce'
        wp_nonce_field( 'teacher_save_meta_box_data', 'teacher_meta_box_nonce');
        
        /*
        *   Usamos get_post_meta() para recoger los valores existentes
        *   en la BBDD y se lo asignamos en el form al campo correspondiente
		*   El true solo nos devuelve el campo especificado, si no existe nos devuelve un array
        */
        
        $value1 = get_post_meta( $post->ID, 'teacher_name', true);
        $value2 = get_post_meta( $post->ID, 'teacher_departament', true);
        $value3 = get_post_meta( $post->ID, 'teacher_image', true);
		
		/*
		*	Dibujamos los campos del formulario HTML que iran en el metabox
		*
		*/
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<td><label for="teacher_name">';
		_e( 'Name', 'web' );
		echo '</label></td>';
		echo '<td><input type="text" id="teacher_name" name="teacher_name" value="'.esc_attr($value1).'"/></td>';
		
		echo '<tr>';
		echo '<td><label for="teacher_departament">';
		_e( 'Departmanent', 'web' );
		echo '</label></td>';
		echo '<td><input type="text" name="teacher_departament" name="excursteacher_departamention_from" value="'.esc_attr($value2).'" size="25"/></td>';
		echo '</tr>';
		
		echo '<tr>';
		echo '<td><label for="teacher_image">'.__("Teacher image", 'web').'</label></td>';
	    echo '<td><input type="text" name="teacher_image" id="teacher_image" class="meta-image regular-text" value="'.$value3.'">';
	    echo '<input type="button" class="button image-upload" value="Browse"></td>';
	    echo '</tr>';
	    
	    echo '<tr>';
	    echo '<td><div class="image-preview"><img src="'.$value3.'" style="max-width: 250px;"></div></td>';
	    echo '</tr>';
	    
	    ?>
	    
	    <script>
            jQuery(document).ready(function ($) {
            
            	// Instantiates the variable that holds the media library frame.
            	var meta_image_frame;
            	// Runs when the image button is clicked.
            	$('.image-upload').click(function (e) {
            		e.preventDefault();
            		var meta_image = $(this).parent().children('.meta-image');
            
            		// If the frame already exists, re-open it.
            		if (meta_image_frame) {
            			meta_image_frame.open();
            			return;
            		}
            		// Sets up the media library frame
            		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            			title: meta_image.title,
            			button: {
            				text: meta_image.button
            			}
            		});
            		// Runs when an image is selected.
            		meta_image_frame.on('select', function () {
            			// Grabs the attachment selection and creates a JSON representation of the model.
            			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            			// Sends the attachment URL to our custom image input field.
            			meta_image.val(media_attachment.url);
            		});
            		// Opens the media library frame.
            		meta_image_frame.open();
            	});
            });
        </script>
	    
	    <?php
		echo '</table>';
    }

	/**
	* Cuando se actualice el post, salvar nuestros datos personalizados.
	*
	* @param int $post_id Es el ID del post que se guarda
	*/
    function teacher_save_meta_box_data( $post_id ) {
        /*
			Si no existe el campo oculto nonce que se encarga de comprobar que las peticiones
			provengan de nuestro servidor nos salimos de la funcion
		*/
        if ( !isset( $_POST['teacher_meta_box_nonce']) ){
			return;
		}
		
		//Si ha fallado la verificacion del campo nonce nos salimos
		/*
			La funcion wp_verify_nonce se encarga de comprobar si el campo nonce tiene asociada
			esta función para actualizar los datos de nuestros custom post fields
		*/
		if ( !wp_verify_nonce($_POST['teacher_meta_box_nonce'], 'teacher_save_meta_box_data')) {
			return;
		}
		
		/*
			Comprobamos si está definida la constante DOING_AUTOSAVE y si su valor es true
			nos salimos 
			Dicha constante es utilizada por la funcion wp_autosave() de WP que salva un post
			enviado con XHR
		*/
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return;
		}
		
		//Comprobamos los permisos de usuario para que solo se almacenen los campos si este tiene permiso
		if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
			
			if( !current_user_can('edit_page', $post_id) ) {
				return;
			}
		}
		else 
		{
			if( !current_user_can('edit_post', $post_id) ) {
				return;
			}	
		}
		
		//Comprobamos que existan los campos personalizados, que tengan valor
		if (!isset( $_POST['teacher_name']) && !isset( $_POST['teacher_departament']) &&
			!isset( $_POST['teacher_image']) ) {
			
			return;
		}
		
		/*
			Saneamos los valores que haya podido introducir el usuario para evitar la inyeccion de codigo
		*/
		$teacher_name 		    = sanitize_text_field($_POST['teacher_name']);
		$teacher_departament 	= sanitize_text_field($_POST['teacher_departament']);
		$teacher_image          = $_POST['teacher_image'];
		
		//Actualizamos en la BBDD
		update_post_meta( $post_id, 'teacher_name', $teacher_name );
		update_post_meta( $post_id, 'teacher_departament', $teacher_departament );
		update_post_meta( $post_id, 'teacher_image', $teacher_image );
    }

	add_action( 'save_post', 'teacher_save_meta_box_data');

	/*	
		Habilitar categorias y tags en el custom post type
	*/
	function allow_post_type_cats(){
		
		register_taxonomy_for_object_type('category', 'izv_teachers');
	}
	add_action('init', 'allow_post_type_cats');


	function allow_post_type_tag(){
		
		register_taxonomy_for_object_type('post_tag', 'izv_teachers');
	}
	add_action('init', 'allow_post_type_tag');


?>