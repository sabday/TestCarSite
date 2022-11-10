<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cryptotheme
 */

get_header();
?>

    <section class="s-hero">
        <div class="s-hero__wrapper hero-offset">
            <div class="section-container">
                <h2 class="s-hero__title main-title"><?php esc_html_e( '404 page not found', 'cryptotheme' ); ?></h2>
            </div>
        </div>
    </section>
    <section class="s-text s-text--left blockchain section-offset">
        <div class="section-container center-text">
            <div class="s-text__description main-text">
                <h2><a href="<?php echo home_url(); ?>" class="button">Home</a></h2>
            </div>
        </div>
    </section>

<?php
get_footer();
