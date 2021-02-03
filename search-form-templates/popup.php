<form role="search" id="quicksearch" action="<?php echo home_url( '/' ) ?>" >
	<div class="search-box">
		<input name="s" id="s" placeholder="Поиск по сайту..." type="text" autocomplete="off" required>
		<button type="submit"><span class="far fa-search"></span></button>
		<input type="hidden" name="post_type" value="post" />
	</div>
</form>