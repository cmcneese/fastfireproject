<?php
/**
 * Custom Customizer Controls.
 *
 * @package bizberg
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Bizberg_Customize_Section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { 

		$pro_link = $this->get_pro_link(); 

		if( !empty( $pro_link ) ){ ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<a href="<?php echo esc_url( $pro_link ); ?>" class="button button-secondary alignright button-red" target="_blank">
					<?php esc_html_e( 'Upgrade To PRO', 'bizberg' ); ?>	
				</a>

			</li>

			<?php 
		
		}

	}

	function get_pro_link(){

		$theme = wp_get_theme();

		switch ( $theme->get( 'TextDomain' ) ) {

			case 'bizberg':
			case 'happy-wedding-day':
			case 'ngo-charity-fundraising':
			case 'building-construction-architecture':
			case 'education-business':
			case 'green-eco-planet':
				return 'https://cyclonethemes.com/downloads/bizberg-pro/';
				break;

			case 'dr-life-saver':
				return 'https://cyclonethemes.com/downloads/dr-life-saver-pro/';
				break;

			case 'pizza-hub':
				return 'https://cyclonethemes.com/downloads/pizza-hub-pro/';
				break;

			case 'professional-education-consultancy':
				return 'https://cyclonethemes.com/downloads/professional-education-consultancy-pro/';
				break;
			
			default:
				return false;
				break;
		}

	}

}
