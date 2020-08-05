<?php
use Elementor\Core\Schemes;

/**
 * Elementor DSR Extension Locais de Cobertura Widget.
 *
 * Widget that inserts a list of benefício categories.
 *
 * @since 1.0.0
 */
class Elementor_DSR_Extension_Locais_de_Cobertura_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Locais de Cobertura widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'locais_cobertura';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Locais de Cobertura widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Locais de Cobertura';
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Locais de Cobertura widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'far fa-map';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Locais de Cobertura widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'elementor-dsr-extension' ];
	}

	/**
	 * Register Locais de Cobertura widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Layout',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'titulo',
			[
				'label' => 'Título',
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => 'Locais de cobertura',
			]
		);

		$this->add_control(
			'mostrar_numero_resultados',
			[
				'label' => 'Mostrar número de resultados',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label' => __( 'Blend Mode', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Locais de Cobertura widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$titulo = ( '' == trim( $settings['titulo'] ) ) ? 'Locais de cobertura' : trim( $settings['titulo'] );

		$count = $settings['mostrar_numero_resultados']    == 'yes' ? '1' : '0';

		$cat_args = array(
			'taxonomy'     => 'local',
			'orderby'      => 'name',
			'hide_empty'   => 0,
			'show_count'   => $count,
			'orderby' 	   => 'id'	
		);

		$terms = get_terms( $cat_args );

		$active_local = 0;
		if( isset( $_GET['local_'] ) ){
			$active_local = (int) $_GET['local_'];
		}

		echo "<h5 class='elementor-heading-title' >{$titulo}</h5>";

		echo "<select class='dsr-sel-locais'>";
		echo "<option value=''>-- Selecione uma opção --</option>";

		foreach( $terms as $term ){
			$name = $term->name;
			if($count) $name .= ' (' . $term->count . ')';
			$cor = get_term_meta( $term->term_id, 'cor', true );
			$selected = "";
			if( $active_local == $term->term_id ) $selected = 'selected="selected"';

			echo "<option value='{$term->term_id}' {$selected} >{$name}</option>";
		}

		echo "</select>";

	}

}