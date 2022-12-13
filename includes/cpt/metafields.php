<?php

class Car_Metabox {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts_styles') );
		add_action( 'admin_footer', array( $this, 'color_field_js' ) );

	}

	public function add_metabox() {

		add_meta_box( 'car_fields', __( 'Car Fields', 'car-fields' ), array( $this, 'render_metabox' ), 'car', 'advanced', 'default' );

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'car_nonce_action', 'car_nonce' );

		$car_color = get_post_meta( $post->ID, 'car_color', true );
		$car_fuel = get_post_meta( $post->ID, 'car_fuel', true );
		$car_power = get_post_meta( $post->ID, 'car_power', true );
		$car_price = get_post_meta( $post->ID, 'car_price', true );

		// Set default values.
		if ( empty( $car_color ) ) $car_color = '#fff';
		if ( empty( $car_fuel ) ) $car_fuel = 'Gasoline';
		if ( empty( $car_power ) ) $car_power = 0;
		if ( empty( $car_price ) ) $car_price = 0;

		ob_start();
		?>

		<table class="form-table">

			<tr>
				<th><label for="car_color" class="car_color_label"> <?php echo __( 'Color', 'car-color' ); ?> </label></th>
				<td>
					<input type="text" id="car_color" name="car_color" class="car_color_field" placeholder="<?php esc_attr__( '', 'car_color' ) ?>" value="<?php echo esc_attr__( $car_color ); ?>">
				</td>
			</tr>
			<tr>
				<th><label for="car_fuel" class="car_fuel_label"> <?php echo __( 'Fuel', 'car-fuel' ); ?> </label></th>
				<td>
					<select id="car_fuel" name="car_fuel">
						<option value="gasoline" <?php echo ($car_fuel === 'gasoline') ? 'selected' : ''; ?>>Gasoline</option>
						<option value="diesel" <?php echo ($car_fuel === 'diesel') ? 'selected' : ''; ?>>Diesel</option>
						<option value="electro" <?php echo ($car_fuel === 'electro') ? 'selected' : ''; ?>>Electro</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="car_power" class="car_power_label"> <?php echo __( 'Power', 'car-power' ); ?> </label></th>
				<td>
					<input type="number" id="car_power" name="car_power" class="car_power_field" placeholder="<?php esc_attr__( '', 'car_power' ) ?>" value="<?php echo esc_attr__( $car_power ); ?>">
				</td>
			</tr>
			<tr>
				<th><label for="car_price" class="car_price_label"> <?php echo __( 'Price', 'car-price' ); ?> </label></th>
				<td>
					<input type="number" id="car_price" name="car_price" class="car_price_field" placeholder="<?php esc_attr__( '', 'car_price' ) ?>" value="<?php echo esc_attr__( $car_price ); ?>">
				</td>
			</tr>

		</table>

		<?php

		echo ob_get_clean();

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['car_nonce'] ) ? $_POST['car_nonce'] : '';
		$nonce_action = 'car_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;

		// Sanitize user input.
		$car_color = isset( $_POST[ 'car_color' ] ) ? sanitize_text_field( $_POST[ 'car_color' ] ) : '';
		$car_fuel  = isset( $_POST[ 'car_fuel' ] ) ? sanitize_text_field( $_POST[ 'car_fuel' ] ) : '';
		$car_power = isset( $_POST[ 'car_power' ] ) ? sanitize_text_field( $_POST[ 'car_power' ] ) : '';
		$car_price = isset( $_POST[ 'car_price' ] ) ? sanitize_text_field( $_POST[ 'car_price' ] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'car_color', $car_color );
		update_post_meta( $post_id, 'car_fuel', $car_fuel );
		update_post_meta( $post_id, 'car_power', $car_power );
		update_post_meta( $post_id, 'car_price', $car_price );

	}

	public function load_scripts_styles() {

		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'admin-custom', get_template_directory_uri() . '/assets/js/admin/custom.js', array( 'jquery' ) );
		wp_enqueue_style( 'wp-color-picker' );

	}

	public function color_field_js() {

		// Print js only once per page
		if ( did_action( 'Car_Metabox_color_picker_js' ) >= 1 ) {
			return;
		}

		?>
		<script type="text/javascript">
            jQuery(document).ready(function($){
                $('#car_color').wpColorPicker();
            });
		</script>
		<?php
		do_action( 'Car_Metabox_color_picker_js', $this );

	}

}

new Car_Metabox;
