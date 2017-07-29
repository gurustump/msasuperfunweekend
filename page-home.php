<?php
/*
 Template Name: Custom Home Page
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>
			<div class="subheader">
				<?php $headerGalleryMeta = get_post_meta(get_the_ID(), '_gurustump_page_index_gallery', true);
				/*echo '<pre>';
				print_r( $headerGalleryMeta);
				echo '</pre>';*/
				if ($headerGalleryMeta) { ?>
				<ul class="rotating-gallery SUBHEAD_CAROUSEL">
					<?php $headerGalleryCounter = 0;
					foreach ($headerGalleryMeta as $key => $image) {
						$imageSrc = wp_get_attachment_image_src($key, 'extra-large');
						?>
						<li<?php echo $headerGalleryCounter == 0 ? ' class="active"' : ''; ?> style="background-image:url(<?php echo $imageSrc[0]; ?>)">
							<?php /* <img src="<?php echo $imageSrc[0]; ?>" /> */ ?>
						</li>
						<?php $headerGalleryCounter++; ?>
					<?php }; ?>
				</ul>
				<?php } ?>
				<a class="scroll-subheader SCROLL_SUBHEAD" href="#">Scroll</a>
			</div>
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php if ($post->post_content !== '') { ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<section class="entry-content cf" itemprop="articleBody">
								<?php
									the_content();
								?>
							</section>
						</article>
						<?php } ?>
						<?php endwhile; else : ?>
						<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
							</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
							</footer>
						</article>
						<?php endif; ?>
						
						<?php $events_list = tribe_get_events(array(
							'orderby'		=> 'date',
							'order'			=> 'ASC'
						)); ?>
						<?php /* <pre>
						<?php print_r($events_list); ?>
						</pre> */ ?>
						<?php if (count($events_list) > 0) { ?>
						<h2 class="h1 section-heading">Superfun Events</h2>
						<ul class="events-list">
							<?php foreach($events_list as $event) { ?>
							<li>
								<h3>
									<a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a>
								</h3>
								<div class="event-date"><?php echo tribe_events_event_schedule_details( $event->ID, '<span>', '</span>' ); ?></div>
								<div class="event-venue">
									<div class="event-venue-title"><?php echo tribe_get_venue($event->ID); ?></div>
									<?php echo tribe_get_full_address($event->ID); ?>
									<?php if ( tribe_show_google_map_link($event->ID) && tribe_get_venue_id($event->ID)) : ?>
										<?php echo tribe_get_map_link_html($event->ID); ?>
									<?php endif; ?>
								</div>
								<div class="excerpt"><?php echo $event->post_excerpt; ?></div>
								<?php /* <pre>
								<?php print_r($event); ?>
								</pre> */ ?>
							</li>
							<?php } ?>
						</ul>
						<?php } ?>

					</main>
				</div>
			</div>
<?php get_footer(); ?>
<?php // tribe_events ?>