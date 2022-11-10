<?php

add_theme_support( 'custom-logo' );//Add custom logo

add_theme_support( 'post-thumbnails' );

add_action('after_setup_theme', function(){
    register_nav_menus( array(
        'main_menu' => __( 'Primary menu', 'crea' ),
        'foot_menu' => __( 'Footer menu', 'crea' ),
    ) );
});

add_theme_support( 'menus' );

function car_post_type()
{
    register_post_type('car',
        array(
            'labels'      => array(
                'name'          => __('Car'),
                'singular_name' => __('Car'),
            ),
            'menu_icon'   => 'dashicons-info',
            'supports' => array('title','editor','thumbnail','post-formats','excerpt','custom-fields'),
            'public'      => true,
            'has_archive' => true,
        )
    );

    register_taxonomy(
        'modelcar',
        'car',
        array(
            'label' => __( 'Model Car' ),
            //'rewrite' => array( 'slug' => 'genre' ),
            'hierarchical' => true,
        )
    );

    register_taxonomy(
        'countrycar',
        'car',
        array(
            'label' => __( 'Country Car' ),
            //'rewrite' => array( 'slug' => 'genre' ),
            'hierarchical' => true,
        )
    );
}

add_action('init', 'car_post_type');

// подключаем функцию активации мета блока (my_extra_fields)
add_action('admin_init', 'car_fields', 1);

function car_fields() {
    add_meta_box( 'extra_fields', 'More Params', 'car_fields_box_func', 'car', 'normal', 'high'  );
}

// код блока
function car_fields_box_func( $post ){
    ?>

    <p><label><input name="extra[colcar]" type="color"  value="<?php echo get_post_meta($post->ID, 'colcar', 1); ?>"> Color</label></p>

    <p><select name="extra[fuel]" />
        <?php $sel_v = get_post_meta($post->ID, 'fuel', 1); ?>
        <option value="0">----</option>
        <option value="1" <?php selected( $sel_v, '1' )?> >petrol</option>
        <option value="2" <?php selected( $sel_v, '2' )?> >gas</option>
        <option value="3" <?php selected( $sel_v, '3' )?> >diesel fuel</option>
        </select> Make a choice</p>
    <p>

    <p><label><input type="number" name="extra[power]" value="<?php echo get_post_meta($post->ID, 'power', 1); ?>" style="width:50%" /> Power</label></p>

    <p><label><input type="number" name="extra[price]" value="<?php echo get_post_meta($post->ID, 'price', 1); ?>" style="width:50%" /> Price</label></p>

    <?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'car_fields_update', 0);

/* Сохраняем данные, при сохранении поста */
function car_fields_update( $post_id ){
    // базовая проверка
    if (
        empty( $_POST['extra'] )
        //|| ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
        || wp_is_post_autosave( $post_id )
        || wp_is_post_revision( $post_id )
    )
        return false;

    // Все ОК! Теперь, нужно сохранить/удалить данные
    $_POST['extra'] = array_map( 'sanitize_text_field', $_POST['extra'] );
    foreach( $_POST['extra'] as $key => $value ){
        if( empty($value) ){
            delete_post_meta( $post_id, $key ); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta( $post_id, $key, $value ); // add_post_meta() работает автоматически
    }

    return $post_id;
}

add_action( 'customize_register', 'true_customizer_init' );

function true_customizer_init( $wp_customize ) {
    $wp_customize->add_section(
        'true_foot_copy_text',
        array(
		'sanitize_callback'  => 'true_sanitize_copyright',
		// 'sanitize_callback'  => 'sanitize_text_field', // да, можно сразу так
		'validate_callback' => 'true_validate_copyright',
	)
);

}

//Settings Theme

add_action( 'customize_register', 'customizer_init' );
add_action( 'customize_preview_init', 'customizer_js_file' );
//add_action( 'wp_head', 'customizer_style_tag' );

function customizer_init( WP_Customize_Manager $wp_customize ){

    // как обновлять превью сайта:
    // 'refresh'     - перезагрузкой фрейма (можно полностью отказаться от JavaScript)
    // 'postMessage' - отправкой AJAX запроса
    $transport = 'postMessage';

    // Секция
    if( $section = 'display_options' ){

        $wp_customize->add_section( $section, [
            'title'     => 'Header Settings',
            'priority'  => 200,                   // приоритет расположения
            'description' => 'Settings Header (Phone)', // описание не обязательное
        ] );


        // настройка
        $setting = 'header_phone';

        $wp_customize->add_setting( $setting, [
            'default'            => '000-123-45-67',
            'sanitize_callback'  => 'sanitize_text_field',
            'transport'          => $transport
        ] );

        $wp_customize->add_control( $setting, [
            'section'  => 'display_options', // id секции
            'label'    => 'Input Number Phone',
            'type'     => 'text' // текстовое поле
        ] );

    }
}

function customizer_js_file(){
    wp_enqueue_script( 'theme-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', [ 'jquery', 'customize-preview' ], null, true );
}


add_shortcode( 'carlist', 'carlist_func' );

function carlist_func(){
?>
<div class='container article__container'>
    <ul class='article__list'>
<?php

$args = array(
    'post_type'      => 'car',
    'post_status'    => 'publish',
    //'posts_per_page' => - 1,
);
$size = array(325, 189);
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
while ( $query->have_posts() ) {
$query->the_post();
// Ваш код по выводу поста
?>
        <?php $ID = get_the_ID(); ?>

    <?php
    ?>

            <li class='article__item'>
                <article class="category-card">
                    <a href="<?php the_permalink(); ?>">
                    <div class="category-card__img">
                        <img src="<?php the_post_thumbnail_url( $size ); ?>" alt="Car" width="325" height="189">
                    </div>
                    </a>
                    <h3 class="subtitle category-card__title">
                        <?php
                        $cur_terms = get_the_terms( $ID, 'modelcar' );
                        if( is_array( $cur_terms ) ){
                            foreach( $cur_terms as $cur_term ){
                                echo '<a href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
                            }
                        }
                        ?>
                    </h3>
                    <?php
                    $cur_terms = get_the_terms( $ID, 'countrycar' );
                    if( is_array( $cur_terms ) ){
                        foreach( $cur_terms as $cur_term ){
                            echo '<a href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
                        }
                    }
                    ?>
                    <p><?php echo get_post_meta($ID, 'price', true) ?></p>
                </article>
            </li>
<?php
}
} else {
echo 'Not Found!';
}

wp_reset_postdata();
?>
</ul>
    </div>
<?php

}

add_filter( 'single_template', function( $template ) {

    global $post;

    if ( $post->post_type === 'car' ) {

        $locate_template = locate_template( "single-car.php" );

        if ( ! empty( $locate_template ) ) {

            $template = $locate_template;
        }
    }

    return $template;

} );

?>
