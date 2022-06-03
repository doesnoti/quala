<?php
/*
 * Adds column widget.
*/
class Quala_Column_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'quala_column_widget', // Base ID
			esc_html__( 'Column Links', 'quala' ), // Name
			array( 'description' => esc_html__( 'Creates a column with a header and list of links', 'quala' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
		<div class="footer__links-column">
			<p class="text footer__links-title">
				<?php
				if ( !empty( $instance['quala_title'] ) ) {
					echo apply_filters('widget_column_title', $instance['quala_title']);
				}
				?>
			</p>
			<ul class="footer__list">
			<?php
			if ( isset($instance['quala_texts']) ) {
				for ($i = 0; $i < count($instance['quala_texts']); $i++) {
				?>
					<li class="footer__links-item">
						<a
							href="<?php echo $instance['quala_values'][$i]; ?>"
							class="link text text--c-contr"
						>
							<?php echo esc_html__($instance['quala_texts'][$i], 'quala'); ?>
						</a>
					</li>
				<?php
				}
			}
			?>
			</ul>
		</div>
		<?php
		echo $args['after_widget'];

		wp_enqueue_script('quala-widget-column-script', get_template_directory_uri() . '/widgets/quala-widget-column-script.js');
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset($instance['quala_title']) ? $instance['quala_title'] : '';
		$values = isset($instance['quala_values']) ? $instance['quala_values'] : array();
		$texts = isset($instance['quala_texts']) ? $instance['quala_texts'] : array();

		?>
		<label for="<?php echo esc_attr( $this->get_field_id( 'quala_title' ) ); ?>">
			<?php esc_html_e( 'Column title:', 'quala' ); ?>
		</label> 
		<input
			style="margin-bottom: 10px;"
			id="<?php echo esc_attr( $this->get_field_id( 'quala_title' ) ); ?>"
			name="<?php echo esc_attr( $this->get_field_name( 'quala_title' ) ); ?>"
			type="text"
			value="<?php echo esc_attr__( $title ); ?>"
		>

		<table
			class="quala_widget_link_list"
			width="100%"
			style="border-collapse: collapse;margin-bottom: 10px;"
		>
			<tbody>
				<tr>
					<td style="width: 50%; border: 1px solid #000;">
						<p class="title text--fz-18"><?php echo esc_html__('Enter the page to which the link leads', 'quala'); ?></p>
					</td>
					<td style="width: 50%; border: 1px solid #000;">
						<p class="title text--fz-18"><?php echo esc_html__('Enter link text', 'quala'); ?></p>
					</td>
				</tr>
				<?php
				if ( $texts ) :
					for ($i = 0; $i < count($texts); $i++) {
						?>
						<tr>
							<td>
								<input
									type="text"
									name="<?php echo $this->get_field_name('quala_values') ?>[]"
									value="<?php echo esc_attr__( $values[$i] ); ?>"
									placeholder="<?php echo esc_attr__('Link value', 'quala'); ?>"
								/>
							</td>
							<td>
								<input
									type="text"
									name="<?php echo $this->get_field_name('quala_texts') ?>[]"
									value="<?php echo esc_attr__( $texts[$i] ); ?>"
									placeholder="<?php echo esc_attr__('Link text', 'quala'); ?>"
									/>
							</td>
							<td>
								<button class="button remove-row">
									<?php echo esc_html__('Remove', 'quala'); ?>
								</button>
							</td>
						</tr>
						<?php
					}
				endif; ?>
				<template class="empty-row custom-repeter-text">
					<tr>
						<td>
							<input
								type="text"
								name="<?php echo $this->get_field_name('quala_values') ?>[]"
								placeholder="<?php echo esc_attr__('Link value', 'quala'); ?>"
							/>
						</td>
						<td>
							<input
								type="text"
								name="<?php echo $this->get_field_name('quala_texts') ?>[]"
								placeholder="<?php echo esc_attr__('Link text', 'quala'); ?>"
							/>
						</td>
						<td>
							<button class="button remove-row">
								<?php echo esc_html__('Remove', 'quala'); ?>
							</button>
						</td>
					</tr>
				</template>
			</tbody>
		</table>
		<button class="button add-row">
			<?php echo esc_html__('Add', 'quala'); ?>
		</button>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved. onclick="widgetColumnBtnsInit(event)"
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['quala_title'] = ( ! empty( $new_instance['quala_title'] ) ) ? sanitize_text_field( $new_instance['quala_title'] ) : '';

		if (!empty($new_instance['quala_texts'])) {
			for ($i = 0; $i < count($new_instance['quala_texts']); $i++) { 
				$instance['quala_texts'][$i] =
					( !empty($new_instance['quala_texts'][$i]) ) ?
					sanitize_text_field( $new_instance['quala_texts'][$i] ) :
					esc_html__('Empty', 'quala');
				$instance['quala_values'][$i] =
					( !empty( $new_instance['quala_values'][$i]) ) ?
					sanitize_text_field( $new_instance['quala_values'][$i] ) :
					'/';
			}
		}

		return $instance;
	}
}