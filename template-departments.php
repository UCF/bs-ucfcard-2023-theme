<?php
/**
 * Template Name: Departments
 * Template Post Type: page, post
 */
?>
<?php get_header(); the_post(); ?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<?php
	//Fetch Department ACF Fields
	$staff_image = get_field('staff_faculty_id_image');
	$staff_overlay = get_field('staff_faculty_overlay_text');
	$badge_image = get_field('badge_image');
	$badge_overlay = get_field('badge_overlay_text');
	$staff_content = get_field('staff_faculty_content');
	$badge_content = get_field('badge_content');
	?>

	<div class="container">
		<div class="row">
			<?php if( $staff_image ): ?>
				<div class="mb-4 col-md-6 col-lg-4" id="staffToggle">

					<a class="media-background-container gtm-section-links-cards d-block w-100 h-100 px-4 pt-5 pb-4 hover-parent text-secondary hover-text-inverse text-decoration-none" href="#staffForm" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">

						<img src="<?php echo esc_url( $staff_image['url'] ); ?>" alt="<?php echo esc_attr( $staff_image['alt'] ); ?>" class=" media-background object-fit-cover hover-child hover-child-scale-up" data-object-fit="cover">

						<div class="media-background object-fit-cover bg-inverse-t-3 hover-child hover-child-show fade" data-object-fit="cover"></div>

						<h3 class="h5 text-uppercase mt-5 mb-3"><?php echo $staff_overlay; ?></h3>

						<span class="fa fa-2x fa-chevron-down hover-child hover-child-show fade mt-5 mb-3" aria-hidden="true"></span>

					</a>

				</div>
			<?php endif; ?>

			<?php if( $badge_image ): ?>
				<div class="mb-4 col-md-6 col-lg-4" id="badgeToggle">

					<a class="media-background-container gtm-section-links-cards d-block w-100 h-100 px-4 pt-5 pb-4 hover-parent text-secondary hover-text-inverse text-decoration-none" href="#staffForm" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">

						<img src="<?php echo esc_url( $badge_image['url'] ); ?>" alt="<?php echo esc_attr( $badge_image['alt'] ); ?>" class=" media-background object-fit-cover hover-child hover-child-scale-up" data-object-fit="cover">

						<div class="media-background object-fit-cover bg-inverse-t-3 hover-child hover-child-show fade" data-object-fit="cover"></div>

						<h3 class="h5 text-uppercase mt-5 mb-3"><?php echo $badge_overlay; ?></h3>

						<span class="fa fa-2x fa-chevron-down hover-child hover-child-show fade mt-5 mb-3" aria-hidden="true"></span>

					</a>

				</div>
			<?php endif; ?>
		</div>
		<div class="row mt-4">
			<div class="col-md-12">
				<div class="collapse" id="staffForm">
					<form>
						<?php echo $staff_content; ?>
					</form>
				</div>
				<div class="collapse" id="badgeForm">
					<form>
						<?php echo $badge_content; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</article>

<?php get_footer(); ?>
