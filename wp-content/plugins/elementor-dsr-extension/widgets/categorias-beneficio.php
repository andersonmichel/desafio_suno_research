<?php
use Elementor\Core\Schemes;

/**
 * Elementor DSR Extension Categorias Benefício Widget.
 *
 * Widget that inserts a list of benefício categories.
 *
 * @since 1.0.0
 */
class Elementor_DSR_Extension_Categorias_Beneficio_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Categorias Benefício widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'categorias_beneficio';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Categorias Benefício widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Categorias Benefício';
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Categorias Benefício widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'far fa-list-alt';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Categorias Benefício widget belongs to.
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
	 * Register Categorias Benefício widget controls.
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
				'placeholder' => 'Categorias',
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
	 * Render Categorias Benefício widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$titulo = ( '' == trim( $settings['titulo'] ) ) ? 'Categorias' : trim( $settings['titulo'] );

		$count = $settings['mostrar_numero_resultados']    == 'yes' ? '1' : '0';

		$cat_args = array(
			'taxonomy'     => 'categoria_beneficio',
			'orderby'      => 'name',
			'hide_empty'   => 0,
			'show_count'   => $count,
		);

		$terms = get_terms( $cat_args );

		$active_categoria = 0;
		if( isset( $_GET['categoria'] ) ){
			$active_categoria = (int) $_GET['categoria'];
		}

		echo "<h5 class='elementor-heading-title' >{$titulo}</h5>";

		echo "<ul class='dsr-wrapper-buttons'>";

		$count_all = 0;

		if($count){
			foreach( $terms as $term ){
				$count_all += $term->count;
			}
		}

		$btn_all_text = "todas";
		if($count) $btn_all_text .= ' (' . $count_all . ')';

		$btn_all_class = "";
		$btn_all_style = "";
		if( 0 == $active_categoria ){
			$btn_all_class = " active";
			$btn_all_style = "background: #3a559f; border-color: #3a559f; color: #ffffff;";
		} 

		echo "<li><button class='dsr-btn dsr-btn-all{$btn_all_class}' data-categoria='' data-cor='#3a559f' style='{$btn_all_style}'>{$btn_all_text}</button></li>";


		foreach( $terms as $term ){

			$name = $term->name;
			if( $count ) $name .= ' (' . $term->count . ')';
			$cor = get_term_meta( $term->term_id, 'cor', true );

			$btn_class = ""; 
			$btn_style = "color: {$cor}; border-color: {$cor};";
			if( $term->term_id == $active_categoria ){ 
				$btn_class = " active"; 
				$btn_style = "background: {$cor}; border-color: {$cor}; color: #ffffff;"; 
			}

			echo "<li><button class='dsr-btn dsr-btn-categoria-{$term->term_id}{$btn_class}' data-categoria='{$term->term_id}' data-cor='{$cor}' style='{$btn_style}'>{$name}</button></li>";
		}

		echo "</ul>";

	}

}