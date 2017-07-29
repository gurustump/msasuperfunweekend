<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="search-input-container">
		<?php /* <label for="s" class="screen-reader-text"><?php _e('Search for:','bonestheme'); ?></label> */ ?>
		<input type="search" id="s" name="s" value="" placeholder="Enter search terms" />

		<button type="submit" id="searchsubmit" class="btn-search"><?php _e('Search','bonestheme'); ?></button>
	</div>
</form>