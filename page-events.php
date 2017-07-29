<?php
/*
 Template Name: Custom Events Index
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<header class="article-header">
								<h1 class="page-title"><?php the_title(); ?></h1>
							</header>
						<?php if ($post->post_content !== '') { ?>
							<section class="entry-content cf" itemprop="articleBody">
								<?php
									the_content();
								?>
							</section>
						<?php } ?>
						</article>
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
						<?php if (count($events_list) > 0) { ?>
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

					<?php // get_sidebar(); ?>

				</div>

			</div>


<?php get_footer(); ?>
