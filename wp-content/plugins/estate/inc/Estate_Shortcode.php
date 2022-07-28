<?php

class Estate_Shortcode {
	public function __construct() {

		add_shortcode( 'estate_form', [ $this, 'estate_form' ] );
	}

	public function estate_form() {
		wp_enqueue_script( 'estate-script' );
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'estate-script-ajax' );

		ob_start();
		?>
        <h3>Добавить объект</h3>
        <form action="POST" id="estate-form" class="needs-validation estate-form" novalidate>

			<?php
			foreach ( $this->fields() as $key => $value ): ?>
				<?php Form_Core::fields_form( $key, $value ); ?>
			<?php endforeach; ?>

            <button
                    type="submit"
                    class="button submit-estate btn btn-primary"
                    name="send_estate">
                Добавить строение
            </button>

        </form>
		<?php
		return ob_get_clean();
	}

	public function fields() {

		return apply_filters(
			'estate_fields',
			[
				'estate_title'            => [
					'type'        => 'text',
					'label'       => 'Название',
					'required'    => true,
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Это обязательное поле. Укажите название',
				],
				'estate_type'             => [
					'type'        => 'select',
					'label'       => 'Тип объекта',
					'options'     => $this->get_field_terms(),
					'required'    => true,
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Выберите тип объекта',
				],
				'estate_city'             => [
					'type'        => 'select',
					'label'       => 'Город объекта',
					'options'     => $this->get_field_city(),
					'required'    => true,
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Выберите город объекта',
				],
				'estate_ploshhad'         => [
					'type'        => 'text',
					'label'       => 'Площадь объекта',
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Укажите площадь объекта',
				],
				'estate_stoimost'         => [
					'type'        => 'text',
					'label'       => 'Стоимость объекта',
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Укажите стоимость объекта',
				],
				'estate_adres'            => [
					'type'        => 'text',
					'label'       => 'Адрес объекта',
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Укажите адрес объекта',
				],
				'estate_zhilaya_ploshhad' => [
					'type'        => 'text',
					'label'       => 'Жилая площадь',
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Укажите площадь',
				],
				'estate_etazh'            => [
					'type'        => 'text',
					'label'       => 'Этаж',
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control" ),
					'description' => 'Укажите этаж',
				],
				'estate_descriptions'     => [
					'type'              => 'wysiwyg_editor',
					'label'             => 'Описание объекта',
					'class'             => array( "form-group" ),
					'input_class'       => array( "form-control" ),
					'description'       => 'Добавьте описание объекта',
					'custom_attributes' => [
						'wpautop'          => 1,
						'media_buttons'    => 0,
						'textarea_rows'    => 3,
						'tabindex'         => 0,
						'editor_css'       => '<style></style>',
						'editor_class'     => 'form-field',
						'teeny'            => 1,
						'dfw'              => 0,
						'tinymce'          => 1,
						'quicktags'        => 0,
						'drag_drop_upload' => 0,
					],
					'value'             => '',
				],
				'estate_thumbnail'        => [
					'type'        => 'file',
					'class'       => array( "form-group" ),
					'input_class' => array( "form-control-file" ),
					'label'       => 'Миниатюра объекта',
				],

			]
		);

	}

	public function get_field_terms() {

		$terms = get_terms(
			[
				'taxonomy'   => [ 'type' ],
				'orderby'    => 'id',
				'order'      => 'ASC',
				'hide_empty' => false,
			]
		);

		$field_terms = [];

		foreach ( $terms as $term ) {
			$field_terms[ $term->slug ] = $term->name;
		}

		return $field_terms;
	}

	public function get_field_city() {
		$cities = get_posts( array(
			'numberposts'      => - 1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'cities',
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		) );

		$field_city = [];

		foreach ( $cities as $city ) {
			$field_city[ $city->ID ] = $city->post_title;
		}

		return $field_city;
	}


}