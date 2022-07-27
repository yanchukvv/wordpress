<?php


class Estate_Core {
	private static $instanse;

	public function __construct() {

		$this->hooks();

	}

	public function hooks() {

		add_action( 'init', [ $this, 'register_new_posts_types' ] );
		add_action( 'init', [ $this, 'register_taxonomy' ] );

	}
	public function register_taxonomy() {


		register_taxonomy( 'type', [ 'buildings' ], [
			'label'                 => '', // определяется параметром $labels->name
			'labels'                => [
				'name'              => 'Тип недвижимости',
				'singular_name'     => 'Тип недвижимости',
				'search_items'      => 'Найти Тип недвижимости',
				'all_items'         => 'Все Типы недвижимости',
				'view_item '        => 'Просмотреть Тип недвижимости',
				'parent_item'       => 'Родительский Тип недвижимости',
				'parent_item_colon' => 'Родительский Тип недвижимости:',
				'edit_item'         => 'Редактировать Тип недвижимости',
				'update_item'       => 'Обновить Тип недвижимости',
				'add_new_item'      => 'Новый Тип недвижимости',
				'new_item_name'     => 'Новый Тип недвижимости',
				'menu_name'         => 'Добавить Тип недвижимости',
				'back_to_items'     => '← Вернутся к Типу недвижимости',
			],
			'show_ui'               => true,
			'description'           => '', // описание таксономии
			'public'                => true,
			'hierarchical'          => false,
			'rewrite'               => true,
			'capabilities'          => array(),
			'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
			'show_in_rest'          => true, // добавить в REST API
			'rest_base'             => null, // $taxonomy
		] );
	}
	public function register_new_posts_types() {
		$labels["buildings"] = [
			'name'               => 'Строения',
			'singular_name'      => 'Строение',
			'menu_name'          => 'Строения',
			'name_admin_bar'     => 'Строения',
			'add_new'            => 'Добавить Строение',
			'add_new_item'       => 'Добавить Строение',
			'new_item'           => 'Новое Строение',
			'edit_item'          => 'Редактировать Строение',
			'view_item'          => 'Просмотреть Строение',
			'all_items'          => 'Все Строения',
			'search_items'       => 'Найти Строения',
			'parent_item_colon'  => 'Родительское Строение:',
			'not_found'          => 'Строения не найдены.',
			'not_found_in_trash' => 'Строения не найдены в корзине.',
		];
		$labels["cities"] = [
			'name'               => 'Города',
			'singular_name'      => 'Город',
			'menu_name'          => 'Города',
			'name_admin_bar'     => 'Города',
			'add_new'            => 'Добавить Город',
			'add_new_item'       => 'Добавить Город',
			'new_item'           => 'Новое Город',
			'edit_item'          => 'Редактировать Город',
			'view_item'          => 'Просмотреть Город',
			'all_items'          => 'Все Города',
			'search_items'       => 'Найти Города',
			'parent_item_colon'  => 'Родительское Город:',
			'not_found'          => 'Города не найдены.',
			'not_found_in_trash' => 'Города не найдены в корзине.',
		];

		foreach ($labels as $key => $label) {
			$args = [
				'labels'               => $label,
				'public'               => true,
				'publicly_queryable'   => true,
				'show_ui'              => true,
				'show_in_menu'         => true,
				'capability_type'      => 'post',
				'has_archive'          => true,
				'hierarchical'         => false,
				'menu_position'        => null,
				'menu_icon'            => 'dashicons-screenoptions',
				'supports'             => [
					'title',
					'editor',
					'custom-fields',
					'thumbnail'
				]
			];

			register_post_type($key, $args);
		}

	}

	public static function instance() {

		if ( is_null( self::$instanse ) ) {
			self::$instanse = new self();

		}

		return self::$instanse;
	}
}