<?php
/**
 * Retail Theme Customizer
 *
 * @package Retail
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 */
function retail_customize_register( $wp_customize ) {
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	$wp_customize->add_setting(
		'hi_color',
		array(
			'default'			=> '#d64e52',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'hi_color',
			array( 
				'label'      => esc_html__( 'Highlight/Link Color', 'retail' ),
				'settings'   => 'hi_color',
				'section'    => 'colors',
			)
		)
	);

	$wp_customize->add_section(
		'layout_options',
		array(
			'title'		=> esc_html__( 'Layout Options', 'retail' ),
			'priority'	=> 26,
		)
	);

	$wp_customize->add_setting(
		'layout_boxed',
		array(
			'default'			=> 0,
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
			'layout_boxed',
			array(
				'settings'		=> 'layout_boxed',
				'section'		=> 'layout_options',
				'label'			=> esc_html__( 'Enable Boxed Layout', 'retail' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_setting(
		'container_width',
		array(
			'default'			=> '1920',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
			'container_width',
			array(
				'settings'		=> 'container_width',
				'section'		=> 'layout_options',
				'label'			=> esc_html__( 'Container Width', 'retail' ),
				'type'       	=> 'number',
				'input_attrs' => array(
                'min'   => 1120,
                'max'   => 2560,
                'step'  => 1,
            ),
			)
	);


	$wp_customize->add_setting(
		'header_layout',
		array(
			'default' => '1',
			'sanitize_callback' => 'retail_sanitize_radio_select'
		)
	);
	$wp_customize->add_control(
		new Retail_Image_Radio_Control(
		$wp_customize,
		'header_layout',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Menu Position', 'retail' ),
			'section' => 'layout_options',
			'settings' => 'header_layout',
			'choices' => array(
				'1' => get_template_directory_uri() . '/images/header-layout-2.png',
				'2' => get_template_directory_uri() . '/images/header-layout-1.png',
				)
			)
		)
	);

	$wp_customize->add_setting(
		'grid_layout',
		array(
			'default' => 'masonry',
			'sanitize_callback' => 'retail_sanitize_radio_select'
		)
	);
	$wp_customize->add_control(
		new Retail_Image_Radio_Control(
		$wp_customize,
		'grid_layout',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Blog - Grid Layout', 'retail' ),
			'section' => 'layout_options',
			'settings' => 'grid_layout',
			'choices' => array(
				'masonry' => get_template_directory_uri() . '/images/masonry-layout.png',
				'1' => get_template_directory_uri() . '/images/mag-layout-1.png',
				'2' => get_template_directory_uri() . '/images/mag-layout-2.png',
				'21' => get_template_directory_uri() . '/images/mag-layout-2-1.png',
				'211' => get_template_directory_uri() . '/images/mag-layout-2-1-1.png',
				'3' => get_template_directory_uri() . '/images/mag-layout-3.png',
				'31' => get_template_directory_uri() . '/images/mag-layout-3-1.png',
				'311' => get_template_directory_uri() . '/images/mag-layout-3-1-1.png',
				'4' => get_template_directory_uri() . '/images/mag-layout-4.png',
				'41' => get_template_directory_uri() . '/images/mag-layout-4-1.png',
				'411' => get_template_directory_uri() . '/images/mag-layout-4-1-1.png',
				'412' => get_template_directory_uri() . '/images/mag-layout-4-1-2.png',
				)
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar_position',
		array(
			'default'			=> 'right',
			'sanitize_callback'	=> 'retail_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'sidebar_position',
		array(
			'label'		=> esc_html__( 'Sidebar Position', 'retail' ),
			'type'		=> 'select',
			'section'	=> 'layout_options',
			'choices'	=> array(
				'left'	=> esc_html__( 'Left', 'retail' ),
				'right'	=> esc_html__( 'Right', 'retail' ),
			),
		)
	);





	$wp_customize->add_section(
		'homepage_options',
		array(
			'title'		=> esc_html__( 'Homepage Sections', 'retail' ),
			'description'		=> esc_html__( 'You should first select a Static Homepage if you have not already done so. See: "Homepage Settings"', 'retail' ),
			'priority'	=> 27,
		)
	);

	$wp_customize->add_setting(
		'woo_home_enable',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
			'woo_home_enable',
			array(
				'settings'		=> 'woo_home_enable',
				'section'		=> 'homepage_options',
				'label'			=> esc_html__( 'Activate Sortable Sections', 'retail' ),
				'description'	=> esc_html__( 'Requires WooCommerce Plugin.', 'retail' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_setting(
		'woo_home[tabs]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'retail_sanitize_woo_tabs',
			'transport'         => 'refresh',
			'capability'        => 'manage_options',
		)
	);

	$woo_home_choices = array();
	$woo_home_tabs = retail_woo_home_tabs();
	foreach( $woo_home_tabs as $key => $val ){
		$woo_home_choices[$key] = $val['label'];
	}
	$wp_customize->add_control(
		new Retail_Sortable_Checkboxes(
			$wp_customize,
			'woo_home',
			array(
				'section'     => 'homepage_options',
				'settings'    => 'woo_home[tabs]',
				'label'       => esc_html__( 'Homepage Sections', 'retail' ),
				'description' => esc_html__( 'Check the box to display. Sortable: drag and drop into your preferred order.', 'retail' ),
				'choices'     => $woo_home_choices,
			)
		)
	);

	// Section - Go Pro
	$wp_customize->add_section( 'go_pro_sec' , array(
		'title'      => esc_html__( 'Go Pro', 'retail' ),
		'priority'   => 1,
		'description' => esc_html__( 'Upgrade to Retail Pro for even more cool features and customization options.', 'retail' ),
	) );
	$wp_customize->add_control(
		new Retail_Customize_Extra_Control(
			$wp_customize,
			'go_pro',
			array(
				'section'   => 'go_pro_sec',
				'type'      => 'pro-link',
				'label'		=> esc_html__( 'Go Pro', 'retail' ),
				'url'		=> 'https://uxlthemes.com/theme/retail-pro/',
				'priority'	=> 10
			)
		)
	);

}
add_action('customize_register', 'retail_customize_register');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function retail_customize_preview_js() {
	wp_enqueue_script('retail_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '1.0', true );
}
add_action('customize_preview_init', 'retail_customize_preview_js');


function retail_customizer_script() {
	wp_enqueue_script('retail-customizer-script', get_template_directory_uri() .'/functions/js/customizer-scripts.js', array("jquery","jquery-ui-draggable"),'', true  );
	wp_enqueue_script('retail-sortable-checkbox', get_template_directory_uri() . '/functions/js/retail-sortable-checkbox.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );
	wp_enqueue_style('retail-feather', get_template_directory_uri() .'/css/feather.css');
	wp_enqueue_style('retail-customizer-style', get_template_directory_uri() .'/functions/css/customizer-style.css');	
}
add_action('customize_controls_enqueue_scripts', 'retail_customizer_script');


if( class_exists('WP_Customize_Control') ):

class Retail_Image_Radio_Control extends WP_Customize_Control {

	public function render_content() {

		if ( empty( $this->choices ) )
			return;

		$name = '_customize-radio-' . $this->id;

		?>
		<style>
			#retail-img-container-<?php echo $this->id; ?> .retail-radio-img-img {
			border: 2px solid transparent;
			cursor: pointer;
			margin: 0 4px 4px 0;
			}
			#retail-img-container-<?php echo $this->id; ?> .retail-radio-img-selected {
			border: 2px solid #0085BA;
			margin: 0 4px 4px 0;
			}
			input[type=checkbox]:before {
			content: '';
			margin: -3px 0 0 -4px;
			}
		</style>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if ( $this->description ) {
			echo '<span class="customize-control-description">' . esc_html( $this->description ) . '</span>';
		}
		?>
		<ul class="controls" id='retail-img-container-<?php echo $this->id; ?>'>
		<?php
		foreach ( $this->choices as $value => $label ) :
			$class = ($this->value() == $value)?'retail-radio-img-selected retail-radio-img-img':'retail-radio-img-img';
			?>
			<li style="display: inline;">
				<label>
					<input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_html( $class ); ?>' />
				</label>
			</li>
			<?php
			endforeach;
		?>
		</ul>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.controls#retail-img-container-<?php echo $this->id; ?> li img').click(function(){
					$('.controls#retail-img-container-<?php echo $this->id; ?> li').each(function(){
						$(this).find('img').removeClass ('retail-radio-img-selected') ;
				});
				$(this).addClass ('retail-radio-img-selected') ;
				});
			});
		</script>
	<?php
	}
}


class Retail_Customize_Extra_Control extends WP_Customize_Control {
	public $settings = 'blogname';
	public $description = '';
	public $url = '';
	public $group = '';

	public function render_content() {
		switch ( $this->type ) {
			default:

			case 'extra':
				echo '<p style="margin-top:40px;">' . sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'More options available', 'retail' )
						) . '</p>';
				echo '<p class="description" style="margin-top:5px;">' . $this->description . '</p>';
				break;

			case 'docs':
				echo sprintf(
							'<a href="%1$s" class="button-primary" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'Documentation', 'retail' )
						);
				break;

			case 'pro-link':
				echo sprintf(
							'<a href="%1$s" class="button-primary" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'Go Pro', 'retail' )
						);
				break;
					
			case 'line' :
				echo '<hr />';
				break;
		}
	}
}


/**
 * Sortable multi check boxes custom control.
 * @since 0.1.0
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2015, Genbu Media
 * @license https://www.gnu.org/licenses/gpl-2.0.html
 */
class Retail_Sortable_Checkboxes extends WP_Customize_Control {
	/**
	 * Control Type
	 */
	public $type = 'retail-multicheck-sortable';
	/**
	 * Enqueue Scripts
	 */
	public function enqueue() {
		wp_enqueue_style( 'retail-customize' );
		wp_enqueue_script( 'retail-customize' );
	}
	/**
	 * Render Settings
	 */
	public function render_content() {
		/* if no choices, bail. */
		if ( empty( $this->choices ) ){
			return;
		} ?>

		<?php if ( !empty( $this->label ) ){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php } // add label if needed. ?>

		<?php if ( !empty( $this->description ) ){ ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php } // add desc if needed. ?>

		<?php
		/* Data */
		$values = explode( ',', $this->value() );
		$choices = $this->choices;
		/* If values exist, use it. */
		$options = array();
		if( $values ){
			/* get individual item */
			foreach( $values as $value ){
				/* separate item with option */
				$value = explode( ':', $value );
				/* build the array. remove options not listed on choices. */
				if ( array_key_exists( $value[0], $choices ) ){
					$options[$value[0]] = $value[1] ? '1' : '0'; 
				}
			}
		}
		/* if there's new options (not saved yet), add it in the end. */
		foreach( $choices as $key => $val ){
			/* if not exist, add it in the end. */
			if ( ! array_key_exists( $key, $options ) ){
				$options[$key] = '0'; // use zero to deactivate as default for new items.
			}
		}
		?>

		<ul class="retail-multicheck-sortable-list">

			<?php foreach ( $options as $key => $value ){ ?>

				<li>
					<label>
						<input name="<?php echo esc_attr( $key ); ?>" class="retail-multicheck-sortable-item" type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( $value ); ?> /> 
						<?php echo esc_html( $choices[$key] ); ?>
					</label>
					<i class="dashicons dashicons-menu retail-multicheck-sortable-handle"></i>
				</li>

			<?php } // end choices. ?>

				<li class="retail-hideme">
					<input type="hidden" class="retail-multicheck-sortable" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				</li>

		</ul>


	<?php
	}
}


endif;


/**
 * Sanitization functions
 */

function retail_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


function retail_sanitize_radio_select( $input, $setting ) {
	// Ensuring that the input is a slug.
	$input = sanitize_key( $input );
	// Get the list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it, else, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


function retail_sanitize_woo_tabs( $input ){

	/* Var */
	$output = array();

	/* Get valid tabs */
	$valid_tabs = retail_woo_home_tabs();

	/* Make array */
	$tabs = explode( ',', $input );

	/* Bail. */
	if( ! $tabs ){
		return null;
	}

	/* Loop and verify */
	foreach( $tabs as $tab ){

		/* Separate tab and status */
		$tab = explode( ':', $tab );

		if( isset( $tab[0] ) && isset( $tab[1] ) ){
			if( array_key_exists( $tab[0], $valid_tabs ) ){
				$status = $tab[1] ? '1' : '0';
				$output[] = trim( $tab[0] . ':' . $status );
			}
		}

	}

	return trim( esc_attr( implode( ',', $output ) ) );
}