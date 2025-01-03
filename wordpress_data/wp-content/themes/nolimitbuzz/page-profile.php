<?php
/* Template Name: Profile Page */

get_header();



// Get the current user
$current_user = wp_get_current_user();
?>

<?php
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(home_url('/profile')));
    exit;
}
?>

<div class="profile-page">
    <div class="container">
        <h1>Profile Information</h1>

        <?php if (is_user_logged_in()) : ?>
            <div class="user-profile">
                <h2><?php echo esc_html($current_user->display_name); ?></h2>
                <p><strong>Email:</strong> <?php echo esc_html($current_user->user_email); ?></p>
                <p><strong>Username:</strong> <?php echo esc_html($current_user->user_login); ?></p>

                <?php
                // Fetch ACF fields if available
                $profile_picture = get_field('profile_picture', 'user_' . $current_user->ID);
                $bio = get_field('bio', 'user_' . $current_user->ID);

                if ($profile_picture) :
                    ?>
                    <div class="profile-picture">
                        <img src="<?php echo esc_url($profile_picture['url']); ?>" alt="<?php echo esc_attr($profile_picture['alt']); ?>">
                    </div>
                <?php endif; ?>

                <?php if ($bio) : ?>
                    <p><strong>Bio:</strong> <?php echo esc_html($bio); ?></p>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <p>You need to log in to view your profile information.</p>
        <?php endif; ?>
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
</style>