<?php
/*
Model Car taxonomy
*/
?>

<?php get_header(); ?>
<?php $term = get_queried_object(); ?>

    <main>
        <section class="hero section-pb">
            <div class="container hero__container">
                <div class="hero__wrapper">
                    <h1 class="title title--light hero__title"><?php echo $term->name; ?></h1>
                    <div class="hero__description">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="article section-offset">
            <div class='container article__container'>
                <ul class='article__list'>
            <?php
            // Определение запроса
            $args = array(
                'post_type' => 'car',
                'modelcar' => $term->slug
            );
            $query = new WP_Query( $args );
            $ID = get_the_ID();

            if ($query->have_posts()) {


                while ( $query->have_posts() ) : $query->the_post(); ?>

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
                            <p class="category-card__description"><?php the_content(); ?></p>
                        </article>
                    </li>

                <?php endwhile;

            }
            wp_reset_postdata();

            ?>
                </ul>
            </div>


        </section>
    </main>


<?php
get_footer();