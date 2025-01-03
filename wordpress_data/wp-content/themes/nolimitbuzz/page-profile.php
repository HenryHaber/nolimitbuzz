<?php
/* Template Name: Profile Page */

get_header();



// Get the current user
// $current_user = wp_get_current_user();
$member_name = isset($_GET['member']) ? sanitize_text_field($_GET['member']) : null;

$args = array(
    'post_type' => 'team-member',
    'title' => $member_name, // Use the title to query
    'posts_per_page' => 1, // Limit to one result
);
$member_query = new WP_Query($args);

?>

<?php

?>

<div class="profile-page">
    <div class="container">
        <h1>Profile Information</h1>

        <?php 

            if ($member_query->have_posts()) :
                $member_query->the_post(); // Set up the post data
                ?>
                <div class="user-profile">
                    <h2><?php the_title(); ?></h2>  <!-- Member Name -->

                    <?php 
                    $linkedinProfile = get_field('linkedin_profile'); // Example ACF Field
                    $position = get_field('position');
                    $profile_picture = get_field('profile_picture');
                    if ($profile_picture) :
                        ?>
                        <div class="profile-picture">
                            <img style="height: 200px; width: 200px ;"   src="<?php echo esc_url($profile_picture['url']); ?>" alt="<?php echo esc_attr($profile_picture['alt']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if ($position) : ?>
                        <p><strong>Position:</strong> <?php echo esc_html($position); ?></p>
                    <?php endif; ?>

                    <?php if ($linkedinProfile) : ?>
                        <a href="<?php echo esc_url($linkedinProfile); ?>" target="_blank" rel="noopener noreferrer">
                <img style="height: 50px; width: 50px" src="<?php echo get_stylesheet_directory_uri(); ?>/images/linkedin.svg" alt="LinkedIn Profile" class="linkedin-icon"> 
            </a>
                    <?php endif; ?>

                    <?php the_content(); ?> <!-- Member Bio if using the content editor --> 
                </div>
            <?php else : ?>
                <p>Member not found.</p> 
            <?php endif;
            wp_reset_postdata(); // Reset the post data

        ?>
    </div>
</div>

<?php get_footer(); ?>

<style>
    .profile-page{
        min-height: 80vh;
        padding: 10%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .profile-picture {
    border-radius: 1%;
    object-fit: 'contain';
    object-position: center;
    overflow: hidden;
    justify-content: center;
}
</style>