<?php
/**
 * The template for displaying single Portfolio items
 *
 * @package YourTheme
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-portfolio'); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="portfolio-meta">
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'portfolio_category');
                            if (!empty($terms) && !is_wp_error($terms)) {
                                echo '<p class="portfolio-category">' . __('Categories: ', 'portfolio-plugin');
                                foreach ($terms as $term) {
                                    echo '<span>' . esc_html($term->name) . '</span> ';
                                }
                                echo '</p>';
                            }
                            ?>
                            <p class="portfolio-author">
                                <?php echo __('Author: ', 'portfolio-plugin') . get_the_author(); ?>
                            </p>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="portfolio-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p><?php esc_html_e('Sorry, no portfolio items found.', 'portfolio-plugin'); ?></p>
        <?php
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>

<style>
    .site-main {
        min-height: 80svh;
        padding: 10%;
        /* background-color: wheat; */
    }
    
</style>