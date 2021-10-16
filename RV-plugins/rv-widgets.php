<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}
//Wiget Personalizado 1 RV-Mostrar Posts de las categorías

class RV_MOSTRAR_CAT extends WP_Widget {

	function __construct() {
		parent::__construct(
			'rv_mostrar_cat', // Base ID
			esc_html__( 'RV-Mostrar Posts de las categorías', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Muestra una categoría determinada en la página de inicio', 'text_domain' ), ) // Args
		);
	}

	
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
	        $cat_a_mostrar = $instance['cat_a_mostrar'];
            $cat = (int)$cat_a_mostrar;

            $post_desc = $instance['post_desc'];
        ?>
        <div class="container franja-superior" >
                <div class="row">
                    <div class="col linea-categoria2">
                        <div class="elemento">
                            <span class ="instagram" id="mostrar-texto"><p class="instagram">@rendezvousmagazinel</p></span>
                            <span class="linea"></span>
                        </div>
                        <span class="categoria">
                            <p class="nombre-categoria"><a class="link-categoria" href="<?php  echo get_category_link( $cat ); ?>"><?php echo get_cat_name($cat) ?></a></p>
                        </span>
                    </div>
                </div>
        </div>
        <section class="post">
            <div class="container">
                <div class="row mt-5" style="display: flex;justify-content: center;">
                <?php 
                    $args = array(
                        'posts_per_page' => 2,
                        'cat' => $cat 
                    );
                    $negocios2 = new WP_Query($args);
                ?>
                <?php if ($negocios2->have_posts()) : while($negocios2->have_posts()): $negocios2->the_post();  ?>
                    <div class="col-5 col-md-4 col-lg-4">
                        <div class="card mb-3 bg-body rounded" style="border: none;">
                            <?php the_post_thumbnail('destacada', array('class' => 'img-fluidcard-img-top rounded-top'));?>
                            <div class="card-body">
                                <h5 class="card-title categoy-title"><a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-md-4 col-lg-4">
                        <div class="card mb-3 bg-body rounded" style="border: none;">
                            <div class="card-body">
                                <h5 class="card-title categoy-title"><a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            </div>
                            <?php the_post_thumbnail('destacada', array('class' => 'img-fluidcard-img-top rounded-top'));?>
                        </div>
                    </div>
                    <div class="col-5 col-md-4 col-lg-4">
                        <div class="card mb-3 bg-body rounded" style="border: none;">
                            <?php the_post_thumbnail('destacada', array('class' => 'img-fluidcard-img-top rounded-top'));?>
                            <div class="card-body">
                                <h5 class="card-title categoy-title"><a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata();?>
                    <?php else : ?>
                        <p><?php _e( 'Todavia no hay publicaciones' ); ?></p>
                    <?php endif; ?>
                    <?php   wp_link_pages();?>
                </div>
            </div>
        </section>
        <?php
		echo $args['after_widget'];
	}

	public function form( $instance) {
		$cat_a_mostrar = !empty($instance['cat_a_mostrar']) ? $instance['cat_a_mostrar']: esc_html__('Coloque el "ID" de la categoría a mostrar','categoriarv');?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat_a_mostrar')) ?>">
                <?php esc_attr_e('Coloque el "ID" de la categoría a mostrar', 'categoriarv'); ?>
            </label>
            <input class="widefat" 
            id="<?php echo esc_attr($this->get_field_id('cat_a_mostrar')); ?>" 
            name="<?php echo esc_attr($this->get_field_name('cat_a_mostrar')); ?>"
            type="number"
            value="<?php echo esc_attr( $cat_a_mostrar ); ?>">
            
        </p>
        <?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['cat_a_mostrar'] = ( ! empty( $new_instance['cat_a_mostrar'] ) ) ? sanitize_text_field( $new_instance['cat_a_mostrar'] ) : '';
		return $instance;
	}

}
function registrar_rv_plugin_mostrar_cat() {
    register_widget( 'RV_MOSTRAR_CAT' );
}
add_action( 'widgets_init', 'registrar_rv_plugin_mostrar_cat' );


//Widget Personalizado 2 Muestra un texto debajo del titulo

class SUBTITULO_RV extends WP_Widget{


    function __construct() {
		parent::__construct(
			'subtitle_widget_rv', 
			esc_html__( 'RV-Subtitulo', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Muestra un texto debajo del titulo', 'text_domain' ), ) 
		);
	}

    public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

        $subtitulo = $instance['subtitulo_rv']


        ?>
        
        <p class="subtitle text-center mt-1"><?php echo $subtitulo ?></p>
        <?php 
	}

    public function form( $instance ) {
		$subtitulo = ! empty( $instance['subtitulo_rv'] ) ? $instance['subtitulo_rv'] : esc_html__( '', 'rv_subtitulo' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'subtitulo_rv' ) ); ?>">
            <?php esc_attr_e( 'Agrega un texto', 'rv_subtitulo' ); ?>
        </label> 
		<input class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'subtitulo_rv' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'subtitulo_rv' ) ); ?>" 
        type="text" value="<?php echo esc_attr( $subtitulo ); ?>">
		</p>
		<?php 
	}


    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['subtitulo_rv'] = ( ! empty( $new_instance['subtitulo_rv'] ) ) ? sanitize_text_field( $new_instance['subtitulo_rv'] ) : '';

		return $instance;
	}

}
function registrar_rv_plugin_subtitulo() {
    register_widget( 'SUBTITULO_RV' );
}
add_action( 'widgets_init', 'registrar_rv_plugin_subtitulo' );


//Wiget Personalizado #3 Coloca post en una página deseada

class Page_RV extends WP_Widget{

    function __construct() {
		parent::__construct(
			'page_widget_rv', 
			esc_html__( 'RV-Page content', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Coloca post en una página deseada', 'text_domain' ), ) 
		);
	}

    public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
	        $cat_a_mostrar = $instance['cat_a_mostrar'];
            $cat = (int)$cat_a_mostrar;

            $post_desc = $instance['post_desc'];
        ?>
        <section class="post">
            <div class="container">
                <?php 
                    $args = array(
                        'posts_per_page' => 1,
                        'cat' => $cat,
                        'tag' => $post_desc  
                    );
                    $negocios = new WP_Query($args);
                ?>
                <?php if ($negocios->have_posts()) : while($negocios->have_posts()): $negocios->the_post();  ?>
                <div class="row">
                    <div class="col">
                        <div class="card mb-3 card-principal" style="border: none;">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <p class="card-text"><?php the_excerpt(); ?></p>
                                        <p class="card-text"><small class="text-muted">Por: <?php the_author();?> - <?php the_date(); ?> </small></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php the_post_thumbnail('destacada1', array('class' => 'img-fluid'));?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata();?>
                <?php else : ?>
                    <p><?php _e( 'Aún no hay ningún post destacado' ); ?></p>
                <?php endif; ?>
                <div class="row">
                    <div class="col mb-3 mt-4">
                        <div class="line-dashed"></div>
                    </div>
                </div>
                <div class="row">
                <?php 
                    $args = array(
                        'posts_per_page' => 12,
                        'cat' => $cat 
                    );
                    $negocios2 = new WP_Query($args);
                ?>
                <?php if ($negocios2->have_posts()) : while($negocios2->have_posts()): $negocios2->the_post();  ?>
                    <div class="col-sm-2 col-md-5 col-lg-3">
                        <div class="card mb-3 bg-body rounded" style="border: none;">
                            <?php the_post_thumbnail('destacada', array('class' => 'img-fluidcard-img-top rounded-top'));?>
                            <div class="card-body">
                                <h5 class="card-title categoy-title"><a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <p class="card-text Author"><small class="text-muted"><i>Por: <?php the_author();?></i></small></p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata();?>
                    <?php else : ?>
                        <p><?php _e( 'Todavia no hay publicaciones' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
		echo $args['after_widget'];
	}

	public function form( $instance) {
		$cat_a_mostrar = !empty($instance['cat_a_mostrar']) ? $instance['cat_a_mostrar']: esc_html__('Coloque el "ID" de la categoría a mostrar','categoriarv');
        $post_desc = !empty($instance['post_desc']) ? $instance['post_desc']: esc_html__('Coloque el "SLUG" de la categoría a mostrar','postrv');?>
        <p>
        <p><?php echo $post_desc ?></p>
            <label for="<?php echo esc_attr($this->get_field_id('post_desc')) ?>">
                <?php esc_attr_e('Coloque el "SLUG" de la categoría a mostrar', 'postrv'); ?>
            </label>
            <input class="widefat" 
            id="<?php echo esc_attr($this->get_field_id('post_desc')); ?>" 
            name="<?php echo esc_attr($this->get_field_name('post_desc')); ?>"
            type="Text"
            value="<?php echo esc_attr( $post_desc ); ?>">

            <label for="<?php echo esc_attr($this->get_field_id('cat_a_mostrar')) ?>">
                <?php esc_attr_e('Coloque el "ID" de la categoría a mostrar', 'categoriarv'); ?>
            </label>
            <input class="widefat" 
            id="<?php echo esc_attr($this->get_field_id('cat_a_mostrar')); ?>" 
            name="<?php echo esc_attr($this->get_field_name('cat_a_mostrar')); ?>"
            type="number"
            value="<?php echo esc_attr( $cat_a_mostrar ); ?>">
            
        </p>
        
        <?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['cat_a_mostrar'] = ( ! empty( $new_instance['cat_a_mostrar'] ) ) ? sanitize_text_field( $new_instance['cat_a_mostrar'] ) : '';
        $instance['post_desc'] = ( ! empty( $new_instance['post_desc'] ) ) ? sanitize_text_field( $new_instance['post_desc'] ) : 'postrv';
		return $instance;
	}

}

function page_rv_plugin_subtitulo() {
    register_widget( 'Page_RV' );
}
add_action( 'widgets_init', 'page_rv_plugin_subtitulo' );


?>