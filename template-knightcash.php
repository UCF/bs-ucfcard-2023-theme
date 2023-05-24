<?php
/**
 * Template Name: Knight Cash
 * Template Post Type: page, post
 */
?>
<?php get_header(); the_post(); the_content()?>

<?php
//Fetch Knight Cash ACF Fields
$map_background = get_field('left_side_background');
$left_title = get_field('left_title');
$left_subtitle = get_field('left_subtitle');
$google_maps_api_key = get_field('google_maps_api_key');

?>

<div class="container-fluid bg-inverse-t-2">
	<div id="map-row" class="row">

		<!-- Map Section Left -->
		<div class="col col-12 col-md-6 px-0 d-flex flex-column text-center justify-content-center align-content-center text-inverse">
			<div class="media-background-container d-flex flex-column py-5 px-4 h-100 justify-content-center">
				<div class="media-background">
					<img src="<?php echo esc_url( $map_background['url'] ); ?>" alt="<?php echo esc_attr( $map_background['alt'] ); ?>" class=" media-background object-fit-cover hover-child" data-object-fit="cover">
				</div>
				<div class="align-self-center justify-content-center">
					<?php if ($left_title) {?>
						<h2 class="font-condensed d-block mb-3"><?php echo $left_title ?></h2>
					<?php }?>
					<?php if ($left_subtitle) {?>
						<p class="w-md-75 m-auto"><strong><?php echo $left_subtitle ?></strong></p>
					<?php }?>


				</div>
				<div class="category-popup" style="display: none;">
					<div class="outer">
						<div class="inner">
							<?php
							$map_categories = get_field( 'map_categories' );
							$location_counter = 1;
							foreach ( $map_categories as $map_category ) { ?>
								<div class="category-container pt-5" style="display: none;" data-category="<?php echo str_replace( '--', '-', str_replace( '&', '', str_replace( ' ', '-', strtolower( $map_category['name'] ) ) ) ); ?>">

									<div class="category-title h4 font-condensed text-left ml-3"><?php echo $map_category['name']; ?></div>

									<div class="divider ml-3"></div>

									<ul class="list-group mb-2">
										<?php
										$map_locations = $map_category['locations'];
										$m_c = 1;
										aasort( $map_locations, 'name' );

										if ( $map_locations ) {
											foreach ( $map_locations as $location ) {
												if ( $m_c % 2 == 0 ) { ?>
													<li class="second list-unstyled text-inverse list-group-item">
												<?php } else { ?>
													<li class="list-unstyled text-inverse list-group-item">
												<?php } ?>
												<a href="#" class="location-link text-inverse" data-location-num="<?php echo $location_counter; ?>"><?php echo $location['name']; ?></a>
												</li>
												<?php $location_counter++; $m_c++; }
										}
										?>
									</ul>
									<div class="clear"></div>
									<a href="#" class="map-back font-condensed h6 text-left ml-3">Back</a>
								</div>
							<?php }
							?>
							<div class="clear"></div>
						</div>

					</div>

				</div>

				<div id="cat-link-container" class="outer">

					<div class="inner">

						<div class="map-filters">

							<h3>Select a Category</h3>
							<div class="divider"></div>
							<div class="filter-container">
								<?php
								$cat_counter = 1;
								foreach ( $map_categories as $map_category ) { ?>
									<div style="position: absolute; opacity: 0; left: -5000px">
										<img src="<?php echo $map_category['background_image']; ?>" />
									</div>
									<a href="#" data-category-bg="<?php echo $map_category['background_image']; ?>" data-category-num="<?php echo $cat_counter; ?>" data-category="<?php echo str_replace( '--', '-', str_replace( '&', '', str_replace( ' ', '-', strtolower( $map_category['name'] ) ) ) ); ?>" class="cta-btn btn btn-primary btn-sm mt-1"><?php echo $map_category['name']; ?></a>
									<?php $cat_counter++; /* Increase Category Counter */ }
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Map Section Right -->
		<div class="col col-12 col-md-6 px-0 d-flex flex-column">
			<div id="alt-map"></div>
		</div>
	</div>
</div>


<!-- Map JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript"> var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
<script type="text/javascript" src="/static/js/infobubble.js"></script>
<script type="text/javascript" src="<?php echo $google_maps_api_key ?>"></script>

<script type="text/javascript">

	jQuery(document).ready( function($) {

		/* Category Fade BG Image Effect */
		$('.filter-container .cta-btn').on( 'hover', function() {

			$category_bg = $(this).data( 'category-bg' );

			$('#side-by-side-map .left-side').css( { 'background' : 'url(' + $category_bg + ')', 'background-size' : 'cover', 'background-position' : 'center' } );

		} );

		$('.faq-link').on( 'click', function(evt) {
			evt.preventDefault();

			if ( $(this).hasClass( 'active' ) ) {
				$(this).parent().find( '.faq-info' ).slideUp( 300 );
				$(this).removeClass( 'active' );
			} else {
				$('.faq-link.active').removeClass( 'active' ).parent().find( '.faq-info' ).slideUp( 300 );
				$(this).addClass( 'active' );
				$(this).parent().find( '.faq-info' ).slideDown( 300 );
			}

		} );

		$('.filter-container .cta-btn').on( 'click', function(evt) {
			evt.preventDefault();

			$category = $(this).data( 'category' );
			$cat_number = $(this).data( 'category-num' );
			$current_window_width = $(window).width();

			$('#cat-link-container').hide();
			$('.category-popup').fadeIn( 500 );
			$('.category-container[data-category="' + $category + '"]').show();

			if ( $current_window_width < 960 ) {
				$('#side-by-side-map .left-side').css( { padding : 0 } );
			}


		} );

		$('.map-back').on( 'click', function(evt) {
			evt.preventDefault();

			$current_window_width = $(window).width();

			$('#cat-link-container').show();
			$('.category-popup').hide();
			$('.category-container').hide();

			if ( $current_window_width < 960 ) {
				$('#side-by-side-map .left-side').css( { padding : '50px 0' } );
			}

		} );

		$(document).bind('gform_post_render', function() {
			$("#newsletter-form .gform_heading").detach().prependTo('.gform_footer').wrap('<div class="disclaimer-msg"></div>');
		});

		$("#newsletter-form .gform_heading").detach().prependTo('.gform_footer').wrap('<div class="disclaimer-msg"></div>');

		$(document).bind('gform_confirmation_loaded', function(event, formId){
			$('.newsletter-heading').remove();
			//$('#newsletter-success').fadeIn( 500 );
		});

		$('.location-link').on( 'click', function(evt) {
			$current_window_width = $(window).width();

			evt.preventDefault();

			if ( $current_window_width < 960 ) {

				/* Get Location Number */
				$location_num = $(this).data( 'location-num' );

				if ( !$(this).hasClass( 'active' ) ) {

					/* Close Other Location */
					$('.location-link.active').removeClass( 'active' );
					$('.info-container.active').slideUp( 300, function() {
						$(this).removeClass( 'active' );
					});

					/* Open Location */
					$('.info-container[data-location-num="' + $location_num + '"]').slideDown( 300, function() {
						$(this).addClass( 'active' );
					} );

					$(this).addClass( 'active' );

				} else {

					$(this).removeClass( 'active' );
					$('.info-container.active').slideUp( 300, function() {
						$(this).removeClass( 'active' );
					});

				}

			}

		} );

	});

</script>

<script type="text/javascript">

	function initializeGoogleMap() {
		var templatedir = '<?php echo bloginfo('template_directory'); ?>';

		//Latitude/Longitude
		var ll1 = new google.maps.LatLng( 28.602877, -81.203267 );

		//Set up Map Style
		var mapstyle = [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility" : "off"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}];
		var SPRY_MAP_STYLE = 'spry_style';

		//Map Settings
		var mapOptions = {
			center: ll1,
			zoom: 15,
			scrollwheel: false,
			streetViewControl: false,
			mapTypeControl: false,
			panControl: false,
			mapTypeId: SPRY_MAP_STYLE,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE,
				position: google.maps.ControlPosition.LEFT_CENTER,
			};

			//Activate Map
			var map = new google.maps.Map(document.getElementById('alt-map'), mapOptions);

			//Activate map style
			var mapType = new google.maps.StyledMapType(mapstyle, {name:"Spry"});
			map.mapTypes.set(SPRY_MAP_STYLE, mapType);

			//Markers
			var markerIcon = new google.maps.MarkerImage(
				templatedir + '/images/map-pin.png',
				new google.maps.Size(87, 103)
			);

			var cashMarkerIcon = new google.maps.MarkerImage(
				templatedir + '/images/map-cash-pin.png',
				new google.maps.Size(34, 48)
			);

			var foodMarkerIcon = new google.maps.MarkerImage(
				templatedir + '/images/map-food-pin.png',
				new google.maps.Size(33, 47)
			);

			var storeMarkerIcon = new google.maps.MarkerImage(
				templatedir + '/images/map-store-pin.png',
				new google.maps.Size(34, 48)
			);

			//Info Boxes JSON
			var IB_defaults = {
				map: map,
				shadowstyle: 0,
				padding: 0,
				backgroundColor: 'rgb(255,255,255)',
				borderRadius: 0,
				maxWidth: 224,
				borderWidth: 0,
				hideCloseButton: true,
				animation: null,
				disableAutoPan: true,
				pixelOffset: new google.maps.Size(-350, 0),
			};

			var global_markers_array = [];
			var markers_array = [];

			var toggleVisibility = function(show, markers) {

				for (var i = 0, length = markers.length; i < length; i++) {
					markers[i].setVisible(show);
				}

			}

			// google.maps.event.addListener( map, 'zoom_changed', function() {
			// 	jQuery('#alt-map').addClass( 'lock-zoom' );
			//    } );

			<?php

			$map_categories = get_field( 'map_categories' );
			$location_counter = 1;
			$category_counter = 1;

			foreach ( $map_categories as $map_category ) {
			$map_locations = $map_category['locations'];
			aasort( $map_locations, 'name' );
			?>

			var markers_array_<?php echo $category_counter; ?> = [];

			<?php if ( $map_locations ) {
			foreach ( $map_locations as $location ) {

			if ( $location['latitude'] && $location['longitude'] ) { ?>

			var ll_<?php echo $location_counter; ?> = new google.maps.LatLng(<?php echo $location['latitude']; ?>, <?php echo $location['longitude']; ?>);

			<?php

			/* Determine Map Icon */
			switch ( $map_category['icon'] ) {

			case 'store': ?>
			var usedIcon = storeMarkerIcon;
			<?php break;

			case 'food': ?>
			var usedIcon = foodMarkerIcon;
			<?php break;

			case 'cash': ?>
			var usedIcon = cashMarkerIcon;
			<?php break;
			}

			?>

			<?php if ( $category_counter == 1 ) { ?>

			var markerOBJ = {
				position: ll_<?php echo $location_counter; ?>,
				map: map,
				title: "<?php echo $location['name']; ?>",
				icon: usedIcon,
				visible: true
			}

			<?php } else { ?>

			var markerOBJ = {
				position: ll_<?php echo $location_counter; ?>,
				map: map,
				title: "<?php echo $location['name']; ?>",
				icon: usedIcon,
				visible: false
			}

			<?php } ?>

			//Map Marker
			var marker_<?php echo $location_counter; ?>  = new google.maps.Marker( markerOBJ );

			/* Establish Info Bubble Object */
			var InfoWindow_<?php echo $location_counter; ?> = new InfoBubble( IB_defaults );

			/* Push InfoWindow To Global Markers Array */
			global_markers_array.push( InfoWindow_<?php echo $location_counter; ?> );

			/* Push InfoWindow To Current Category Markers Array */
			markers_array.push( marker_<?php echo $location_counter; ?> );
			markers_array_<?php echo $category_counter; ?>.push( marker_<?php echo $location_counter; ?> );

			var the_html = '<div class="info-box-wrapper" style="padding: 20px;">';
			the_html += '<div class="home-pin">';
			the_html += '<div class="inner">';
			the_html += '<div class="body" style="padding: 0;">';
			the_html += "<div class='location-name'><?php echo $location['name']; ?></div>";
			the_html += "<div class='location-category'><?php echo $map_category['name']; ?></div>";
			the_html += '</div>';
			the_html += '</div>';
			the_html += '</div>';
			the_html += '</div>';


			/* Create Info Bubble */
			InfoWindow_<?php echo $location_counter; ?>.setContent( the_html );

			InfoWindow_<?php echo $location_counter; ?>.setMinHeight( 100 );

			/* Add Map Marker Event Listener */
			google.maps.event.addListener(marker_<?php echo $location_counter; ?>, 'click', function() {
				for (i = 0; i < global_markers_array.length; i++) {
					global_markers_array[i].close();
				}
				map.panTo(ll_<?php echo $location_counter; ?>);
				if ( map.getZoom() < 17 ) {
					map.setZoom( 17 );
				}
				InfoWindow_<?php echo $location_counter; ?>.open( map, marker_<?php echo $location_counter; ?> );
			});

			/* Category Click */
			jQuery('.location-link[data-location-num="<?php echo $location_counter; ?>"]').on( 'click', function(evt) {
			evt.preventDefault();
			for (i = 0; i < global_markers_array.length; i++) {
				global_markers_array[i].close();
			}
			map.panTo(ll_<?php echo $location_counter; ?>);
			if ( map.getZoom() < 17 ) {
				map.setZoom( 17 );
			}
			InfoWindow_<?php echo $location_counter; ?>.open(map, marker_<?php echo $location_counter; ?>);
		} );

		<?php }

		$location_counter++; }
		} ?>

		jQuery('.filter-container .cta-btn[data-category-num="<?php echo $category_counter; ?>"]').on( 'click', function() {

			/* Close Info Windows */
			for (i = 0; i < global_markers_array.length; i++) {
				global_markers_array[i].close();
			}

			/* Hide All */
			toggleVisibility( false, markers_array );

			/* Show New Markers */
			toggleVisibility( true, markers_array_<?php echo $category_counter; ?> );

		} );

		<?php $category_counter++; /* Increase Category Counter */

		} ?>

	}

		//Initialize Google Map
		google.maps.event.addDomListener(window, 'load', initializeGoogleMap);

</script>


<?php get_footer(); ?>
