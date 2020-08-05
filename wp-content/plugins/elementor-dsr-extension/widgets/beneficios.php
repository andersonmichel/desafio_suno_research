<?php
use Elementor\Core\Schemes;

/**
 * Elementor DSR Extension Categorias Benefício Widget.
 *
 * Widget that inserts a list of benefício categories.
 *
 * @since 1.0.0
 */
class Elementor_DSR_Extension_Beneficios_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Benefícios widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'beneficios';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Benefícios widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Benefícios';
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Benefícios widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'far fa-sticky-note';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Benefícios widget belongs to.
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
	 * Register Benefícios widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'conteudo_tab',
			[
				'label' => 'Layout',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => 'Número de resultados',
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'3' => '3',
					'6' => '6',
					'9' => '9',
					'12' => '12',
				],
				'default' => '3',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_size',
				'exclude' => [ 'custom' ],
				'default' => 'medium',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'consulta_tab',
			[
				'label' => 'Consulta',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => 'Ordenar por',
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'id' => 'ID',
					'date' => 'Data',
					'title' => 'Título',
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'label' => 'Ordem',
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'asc' => 'ASC',
					'desc' => 'DESC',
				],
				'default' => 'desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'paginacao_tab',
			[
				'label' => 'Paginação',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'paginacao',
			[
				'label' => 'Paginação',
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ajax' => 'Ajax',
					'numeros' => 'Números',
					'none' => 'Nenhuma',
				],
				'default' => 'ajax',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Benefícios widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$args = $this->dsr_get_args( $settings );
	
		$loop = new WP_Query( $args ); 

		?>

			<div class="dsr-beneficios-container" data-colunas="">
					<?php
						while ( $loop->have_posts() ) { $loop->the_post();
							
							$thumb 		      = get_the_post_thumbnail_url( get_the_ID() ); 
							$logo_empresa     = get_post_meta( get_the_ID(), 'beneficio_logo_empresa', true );
							$logo_empresa_url = wp_get_attachment_url( $logo_empresa );
							$url_empresa      = get_post_meta( get_the_ID(), 'beneficio_url_empresa', true );
							$desconto 	      = get_post_meta( get_the_ID(), 'beneficio_desconto', true );

							?>
								<div class="single">
									<div class="thumb" style="background-image: url(<?php echo $thumb; ?>)">

									<?php if( $desconto ){ ?>
										<div class="desconto">
											<?php echo $desconto; ?>%<br /> 
											<span>OFF</span>
										</div>
									<?php } ?>
								</div>

								<?php if( $logo_empresa_url ){ ?>
									<img class="logo" src="<?php echo $logo_empresa_url; ?>" />
								<?php } ?>

									<div class="text">
										<h3><?php the_title(); ?></h3>
										<a class="url_empresa" href="#"><?php echo $url_empresa; ?></a>
										<?php $content = apply_filters( 'the_content', get_the_content() ); ?>
										<?php the_content(); ?>
									</div>
								</div>

							<?php 
						}
					?>
			</div>

			<div class="dsr-beneficios-paginacao" data-mode="<?php echo $settings['paginacao']; ?>" data-limit="<?php echo $settings['posts_per_page']; ?>" data-orderby="<?php echo $settings['orderby']; ?>" data-order="<?php echo $settings['order']; ?>">
				
				<?php if( 'ajax' == $settings['paginacao'] ){ ?>

					<a href="javascript:void(0);" class="dsr-btn-carregar-mais">
						<i class="far fa-plus-square"></i>
						Carregar mais
					</a>
					
				<?php }elseif( 'numeros' == $settings['paginacao'] ){ ?>
				
					<div class="numeros">
						<?php
							echo paginate_links( array(
								'current' => max( 1, $this->get_number_page() ),
								'total' => $loop->max_num_pages
							));
						?>
					</div>
				<?php } ?>
			</div>

			<div class="dsr-loading-spinner" style="display: none">
				<img src="<?php echo site_url() ?>/wp-content/plugins/elementor-dsr-extension/dist/img/loading-spinner.gif" width="130">
			</div>

		<?php
		wp_reset_postdata(); 
		
	}

	/**
	 * Get Args for Query
	 * 
	 */
	function dsr_get_args( $settings ){

		// Get number page
		$paged = $this->get_number_page();

		// Query args
		$args = array(  
			'post_type' => 'beneficio',
			'post_status' => 'publish',
			'posts_per_page' => $settings['posts_per_page'], 
			'orderby' => $settings['orderby'], 
			'order' => $settings['order'], 
			'paged' => $paged,
		);

		// Get Tax Queries
		$tax_query = array( 'relation' => 'AND' );
		if( isset( $_GET['categoria'] ) ){
			$categoria = (int) $_GET['categoria'];
			$tax_query[] = array(
				'taxonomy' => 'categoria_beneficio',
				'field' => 'term_id',
				'terms' => $categoria,
				'operator' => 'IN',
			);
		}
		if( isset( $_GET['local_'] ) ){
			$local = (int) $_GET['local_'];
			$tax_query[] = array(
				'taxonomy' => 'local',
				'field' => 'term_id',
				'terms' => $local,
				'operator' => 'IN',
			);
		}

		// Merge Tax Queries
		if( count( $tax_query ) > 0 ){
			$args['tax_query'] = $tax_query;
		}

		return $args;
	}

	/**
	 * Get Number Page 
	 * 
	 */
	function get_number_page(){

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		return $paged;
	}

}