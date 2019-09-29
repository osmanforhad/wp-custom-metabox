<?php


class metaclass {

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'cbx_add_custom_box' ) );
		add_action( 'save_post', array( $this, 'cbx_save_data' ) );

	}//end constructor

	/*adding meta box*/
	public function cbx_add_custom_box() {

		$screens = [ 'post', 'page' ];

		foreach ( $screens as $screen ) {

			add_meta_box(
				'cbx_box_id',
				'CBX custom meta box',
				array( $this, 'cbx_custom_meta_box_cb' ),
				$screen
			);
		}
	}//end meta box

	/*save data*/
	public function cbx_save_data( $post_id ) {

		if ( array_key_exists( 'cbx_field', $_POST ) ) {

			update_post_meta(
				$post_id,
				'_cbx_meta_key',
				$_POST['cbx_field']
			);

		}
	}//end save data

	/*retrive meta */
	public function cbx_custom_meta_box_cb( $post ) {

		$value = get_post_meta( $post->ID, '_cbx_meta_key', true );

		?>
        <label for="cbx_field">Description for this field</label>

        <select name="cbx_field" id="cbx_field" class="postbox">
            <option value="">Select Something</option>
            <option value="somethings"<?php selected( $value, 'somethings' ) ?>>Something</option>
            <option value="else" <?php selected( $value, 'else' ) ?>>Else</option>
        </select>

		<?php
	}//end retrive meta

}