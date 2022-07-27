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
        <form action="POST" id="estate-form" class="estate-form">

			<?php
			foreach ( $this->fields() as $key => $value ):
				Form_Core::fields_form( $key, $value );
			endforeach;
			?>

            <button
                    type="submit"
                    class="button submit-estate"
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
					'description' => 'Это обязательное поле. Укажите название',
				],
				'estate_type'           => [
					'type'        => 'select',
					'label'       => 'Тип объекта',
					'input_class' => [ 'select' ],
					'options'     => $this->get_field_terms(),
					'required'    => true,
					'description' => 'Выберите тип объекта',
				],
				'estate_city'           => [
					'type'        => 'select',
					'label'       => 'Город объекта',
					'input_class' => [ 'select' ],
					'options'     => $this->get_field_city(),
					'required'    => true,
					'description' => 'Выберите город объекта',
				],
				'estate_ploshhad'         => [
					'type'        => 'text',
					'label'       => 'Площадь объекта',
					'description' => 'Укажите площадь объекта',
				],
				'estate_stoimost'         => [
					'type'        => 'text',
					'label'       => 'Стоимость объекта',
					'description' => 'Укажите стоимость объекта',
				],
				'estate_adres'            => [
					'type'        => 'text',
					'label'       => 'Адрес объекта',
					'description' => 'Укажите адрес объекта',
				],
				'estate_zhilaya_ploshhad' => [
					'type'        => 'text',
					'label'       => 'Жилая площадь',
					'description' => 'Укажите площадь',
				],
				'estate_etazh'            => [
					'type'        => 'text',
					'label'       => 'Этаж',
					'description' => 'Укажите этаж',
				],
				'estate_descriptions'     => [
					'type'              => 'wysiwyg_editor',
					'label'             => 'Описание объекта',
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
					'type'  => 'file',
					'label' => 'Миниатюра объекта',
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

    public function get_field_city(){
	    $cities = get_posts( array(
		    'numberposts' => -1,
		    'orderby'     => 'date',
		    'order'       => 'DESC',
		    'post_type'   => 'cities',
		    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	    ) );

	    $field_city = [];

	    foreach ( $cities as $city ) {
		    $field_city[ $city->ID ] = $city->post_title;
	    }

	    return $field_city;
    }


}