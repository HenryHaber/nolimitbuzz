<?php
/**
 * Plugin Name: Portfolio Custom Post Type
 * Description: A plugin to create a custom post type called Portfolio.
 * Version: 1.0
 * Author: Oramabo Emmanuel
 */

 function register_portfolio_post_type() {
    $args = [
        'labels' => [
            'name' => __('Portfolio', 'portfolio-plugin'),
            'singular_name' => __('Portfolio', 'portfolio-plugin'),
            'add_new' => __('Add Portfolio', 'portfolio-plugin'),
            'add_new_item' => __('Add New Portfolio', 'portfolio-plugin'),
            'edit_item' => __('Edit Portfolio', 'portfolio-plugin'),
            'new_item' => __('New Portfolio', 'portfolio-plugin'),
            'view_item' => __('View Portfolio', 'portfolio-plugin'),
            'search_items' => __('Search Portfolios', 'portfolio-plugin'),
            'not_found' => __('No Portfolios found', 'portfolio-plugin'),
            'not_found_in_trash' => __('No Portfolios found in Trash', 'portfolio-plugin'),
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'portfolio'],
    ];
    register_post_type('portfolio', $args);

    // Register Custom Taxonomy: Portfolio Category
    $taxonomy_args = [
        'labels' => [
            'name' => __('Portfolio Categories', 'portfolio-plugin'),
            'singular_name' => __('Portfolio Category', 'portfolio-plugin'),
        ],
        'hierarchical' => true,
        'public' => true,
        'rewrite' => ['slug' => 'portfolio-category'],
    ];
    register_taxonomy('portfolio_category', 'portfolio', $taxonomy_args);
}
add_action('init', 'register_portfolio_post_type');


// Portfolio Shortcode
function portfolio_shortcode() {
    $terms = get_terms(['taxonomy' => 'portfolio_category', 'hide_empty' => true]);

    $output = '<div class="portfolio-grid">';

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            // $output .= '<h2>' . esc_html($term->name) . '</h2>';

            $query = new WP_Query([
                'post_type' => 'portfolio',
                'tax_query' => [
                    [
                        'taxonomy' => 'portfolio_category',
                        'field' => 'slug',
                        'terms' => $term->slug,
                    ],
                ],
            ]);

            if ($query->have_posts()) {
                $output .= '<div class="grid-container">';
                while ($query->have_posts()) {
                    $query->the_post();
                    $output .= '<div class="grid-item">';
                    $output .= '<h4 class="portfolio-text"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
                    if (has_post_thumbnail()) {
                        $output .= get_the_post_thumbnail(get_the_ID(), 'medium');
                    }
                    $output .= '</div>';
                }
                $output .= '</div>';
                wp_reset_postdata();
            } else {
                $output .= '<p>' . __('No portfolio items found.', 'portfolio-plugin') . '</p>';
            }
        }
    } else {
        $output .= '<p>' . __('No portfolio categories found.', 'portfolio-plugin') . '</p>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('portfolio', 'portfolio_shortcode');
