<?php

class Estate_Ajax {

	public function __construct() {

		add_action( 'wp_ajax_created_estate', [ $this, 'callback' ] );
		add_action( 'wp_ajax_nopriv_created_estate', [ $this, 'callback' ] );
	}


	public function callback() {


		check_ajax_referer( 'estate-nonce', 'nonce' );

		$this->validation();

		$this->validation_thumbnail();

		$data = [
			'post_type'    => 'buildings',
			'post_status'  => 'publish',
			'post_title'   => sanitize_text_field( $_POST['estate_title'] ),
			'post_content' => wp_kses_post( $_POST['estate_descriptions'] ),
			'meta_input'   => [
				'ploshhad'         => sanitize_text_field( $_POST['estate_ploshhad'] ),
				'stoimost'         => sanitize_text_field( $_POST['estate_stoimost'] ),
				'adres'            => sanitize_text_field( $_POST['estate_adres'] ),
				'zhilaya_ploshhad' => sanitize_text_field( $_POST['estate_zhilaya_ploshhad'] ),
				'etazh'            => sanitize_text_field( $_POST['estate_etazh'] ),
				'_gorod'           => sanitize_text_field( $_POST['estate_city'] ),
				'gorod'            => sanitize_text_field( $_POST['estate_city'] ),
			],
			'tax_input'    => [
				'type' => $_POST['estate_type'],
			],
		];

		$post_id = wp_insert_post( $data );

		$this->upload_thumbnail( $post_id );

		$this->set_term( $post_id, $data['tax_input'] );

		$this->success( 'Объект `' . get_the_title( $post_id ) . '` успешно добавлен' );

		wp_die();
	}


	public function upload_thumbnail( $post_id ) {

		if ( empty( $_FILES ) ) {
			return;
		}

		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		add_filter(
			'upload_mimes',
			function ( $mimes ) {

				return [
					'jpg|jpeg|jpe' => 'image/jpeg',
					'png'          => 'image/png',
				];
			}
		);

		$attachment_id = media_handle_upload( 'estate_thumbnail', $post_id );

		if ( is_wp_error( $attachment_id ) ) {
			$response_message = 'Ошибка загрузки файла `' . $_FILES['estate_thumbnail']['name'] . '`: ' . $attachment_id->get_error_message();
			$this->error( $response_message );
		}

		set_post_thumbnail( $post_id, $attachment_id );

	}


	public function set_term( $post_id, $data ) {

		foreach ( $data as $key => $value ) {
			wp_set_object_terms( $post_id, $value, $key );
		}
	}


	public function validation() {

		$error = [];

		$required = [
			'estate_title' => 'Это обязательное поле.',
			'estate_type'  => 'Это обязательное поле.',
			'estate_city'  => 'Это обязательное поле.',

		];

		foreach ( $required as $key => $item ) {

			if ( empty( $_POST[ $key ] ) || ! isset( $_POST[ $key ] ) ) {
				$error[ $key ] = $item;
			}
		}

		if ( $error ) {
			$this->error( $error );
		}
	}


	public function validation_thumbnail() {

		if ( ! empty( $_FILES ) ) {
			$size     = getimagesize( $_FILES['estate_thumbnail']['tmp_name'] );
			$max_size = 800;

			if ( $size[0] > $max_size || $size[1] > $max_size ) {
				$image_message = 'Изображение не может быть больше ' . $max_size . 'рх в высоту или ширину';
				$this->remove_image( $image_message );
			}

		}

	}


	public function success( $message ) {

		wp_send_json_success(
			[
				'response' => 'SUCCESS',
				'message'  => $message,
			]
		);

	}


	public function error( $message ) {

		wp_send_json_error(
			[
				'response' => 'ERROR',
				'message'  => $message,
			]
		);

	}


	public function remove_image( $image_message ) {

		unlink( $_FILES['estate_thumbnail']['tmp_name'] );

		$this->error( $image_message );;
	}
}