<?php
/**
 * The template for displaying the Search Form
 * Used by get_search_form()
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <div class="row">
  	<div class="small-12 column">
  		<label for="search"><h6 class="screen-reader-text"><?php _e('Search for', 'guts'); ?>:</h6></label>
  	</div>
  </div>
  <div class="row collapse">
    <div class="small-9 column">
		<input id="search" type="search" class="search-field" placeholder="Search..." value="" name="s" title="Search for:" />
    </div>
    <div class="small-3 column">
	  <input type="submit" class="search-submit button postfix radius" value="Go" />
    </div>
  </div>
</form>