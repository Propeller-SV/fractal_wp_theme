<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group input-group-md">
		<span class="btn input-group-addon">
			<a href="javascript:{}" onclick="document.getElementById('searchform').submit()"><i class="glyphicon glyphicon-search"></i></a>
			<noscript>
				<button type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</noscript>
		</span>
		<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search', 'fractal' ); ?>"/>
	</div>
</form>