<?php

class Estate_Shortcode {
	public function __construct() {

		add_shortcode( 'estate_form', [ $this, 'estate_form' ] );
	}

	public function estate_form() {

		ob_start();
		?>
        <form action="POST" id="event-form" class="event-form">

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
			'afcp_fields',
			[
				'estate_title'            => [
					'type'        => 'text',
					'label'       => 'Название',
					'required'    => true,
					'description' => 'Это обязательное поле. Укажите название',
				],
				'estate_topics'           => [
					'type'        => 'select',
					'label'       => 'Категория мероприятия',
					'input_class' => [ 'select' ],
					'options'     => $this->get_field_terms(),
					'required'    => true,
					'description' => 'Выберите тим здания',
				],
				'estate_ploshhad'         => [
					'type'        => 'text',
					'label'       => 'Площадь',
					'description' => 'Укажите площадь',
				],
				'estate_stoimost'         => [
					'type'        => 'text',
					'label'       => 'Стоимость',
					'description' => 'Укажите стоимость',
				],
				'estate_adres'            => [
					'type'        => 'text',
					'label'       => 'Адрес',
					'description' => 'Укажите стоимость',
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
					'label'             => 'Описание строения',
					'description'       => 'Добавьте описание строения',
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
					'label' => 'Миниатюра строения',
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


}