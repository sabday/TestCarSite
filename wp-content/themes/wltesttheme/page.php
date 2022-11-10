<?php get_header(); ?>
    <main>
        <section class="hero section-pb">
            <div class="container hero__container">
                <div class="hero__wrapper">
                    <h1 class="title title--light hero__title">Lorem ipsum </h1>
                    <div class="hero__description">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="article section-offset">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!-- Начало .singlecont -->

            <article class="singlecont">

                <div class="cont">
                    <?php the_content(); ?>
                </div>

                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>

        </section>
    </main>
<?php get_footer(); ?>