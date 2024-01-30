<?php
/**
 * Template Name: Departments Media Buttons
 * Template Post Type: page, post
 */
get_header();
the_post();
?>

	<article class="<?php echo esc_attr( $post->post_status ); ?> post-list-item">
		<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">

			<?php if (!empty(get_the_content())) : ?>
				<!-- Main Content Area -->
				<div class="row">
					<div class="col-12">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- ACF Repeater Fields -->
			<?php if( have_rows('form_items') ): ?>
				<div class="row">
					<?php while( have_rows('form_items') ): the_row();
						$text = get_sub_field('text');
						$link = get_sub_field('link');
						$image = get_sub_field('image');
						$overlay_color = get_sub_field('overlay_color');
						?>

						<div class="mb-4 col-md-6 col-lg-4">
							<a class="media-background-container gtm-section-links-cards d-block w-100 h-100 px-4 pt-5 pb-4 hover-parent text-secondary hover-text-inverse text-decoration-none" href="<?php echo esc_url($link); ?>">
								<img decoding="async" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="media-background object-fit-cover hover-child hover-child-scale-up" data-object-fit="cover">

								<div class="media-background object-fit-cover bg-primary-t-1 hover-child hover-child-hide fade" style="background-color:<?php echo esc_attr($overlay_color); ?>;"></div>
								<div class="media-background object-fit-cover bg-inverse-t-3 hover-child hover-child-show fade" data-object-fit="cover"></div>

								<h3 class="h4 text-uppercase mt-5 mb-3"><?php echo esc_html($text); ?></h3>
								<span class="fa fa-2x fa-chevron-down hover-child hover-child-show fade mt-5 mb-3" aria-hidden="true"></span>
							</a>
						</div>

					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</article>

<?php get_footer(); ?>
