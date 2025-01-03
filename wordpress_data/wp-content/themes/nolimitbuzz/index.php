<?php
/**
 * Template Name: Frontpage
 * Description: Custom responsive frontpage for the theme.
 */

get_header();
?>



<div class="frontpage">
    <section class="hero">
        <div class="container">
            <h1><?php bloginfo('name'); ?></h1>
            <p><?php bloginfo('description'); ?></p>
            <a href="#about" class="btn-primary">Learn More</a>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
        </div>
    </section>

    <section>
    <h2>Our Team</h2>
    <div class="team-grid">
        <?php
        // Query team members
        $query = new WP_Query([
            'post_type' => 'team-member',
            'posts_per_page' => -1,
        ]);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                // Retrieve ACF fields
                $linkedinProfile = get_field('linkedin_profile');
                $position = get_field('position');
                $profile_picture = get_field('profile_picture');

                // Build the URL for the /profile page
                $profile_url = home_url('/profile') . '?member=' . get_the_ID();
                ?>
                <div class="team-member">
                    <a href="<?php echo esc_url($profile_url); ?>" class="team-member-link">
                        <?php 
                        // Display profile picture if available
                        if ($profile_picture) {
                            echo '<div class="profile-picture">';
                            echo '<img src="' . esc_url($profile_picture['url']) . '" alt="' . esc_attr($profile_picture['alt']) .'">';
                            echo '</div>';
                        }
                        ?>
                        <span class="team-member-name"><?php the_title(); ?></span>
                        <?php if ($position) : ?>
                            <p><?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p><?php esc_html_e('No team members found.', 'my-theme'); ?></p>
        <?php
        endif;
        ?>
    </div>
</section>


    <section class="portfolio">
        <div class="container">
            <h2>Our Portfolio</h2>
            <?php
             echo do_shortcode('[portfolio]'); ?>
        </div>
    </section>

    <section class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <?php echo do_shortcode('[contact-form-7 id="356af25" title="Contact form 1"]'); ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>

<style>
/* Frontpage Styles */
.frontpage {
    font-family: Arial, sans-serif;
}

section{
    text-align: center;
}

.about{
    min-height: 80svh;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.hero {
    background: #eee;
    color: #000;
    text-align: center;
    padding: 4rem 2rem;
    height: 60svh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;;
}

.hero .btn-primary {
    background: #0073aa;
    color: #fff;
    padding: 0.8rem 2rem;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
    margin-top: 1rem;
}

.about, .portfolio, .contact {
    padding: 2rem 1rem;
    text-align: center;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%; /* Circular image */
    overflow: hidden;
    margin-bottom: 15px;
    justify-content: center;
    background-color: #0073aa;
}

.profile-picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.contact {
    background:rgb(28, 27, 27);
    padding: 3rem 1rem;
    color: #fff;
}

.team-grid {
    display: flex;
    flex-direction: row;
    grid-template-columns: repeat(minmax(250px, 4fr));
    gap: 40px;
    margin: 40px 0;
    text-align: center;
    justify-content: center;

}

.team-member {
    text-align: center;
    padding: 30px;
    gap: 1px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 300px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    justify-items: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}


.team-member-photo img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 15px;
}

.team-member-name {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

.team-member-bio {
    font-size: 1rem;
    color: #666;
}

</style>