<div class="wrap">

	<h2>Manage Blocked Referring Domains</h2>


	<form method="post" action="">
		
		<?php wp_nonce_field( 'rsb-delete', 'rsb-nonce' ); ?>

		<p>
			<span class="alignright">
				Thank you for using Referer Spam Blocker by WP Maintainer.
				<a href="https://wpmaintainer.com/checkout/?promo=10offrsb" target="_blank">Get 10% off</a> our service today! 
			</span>
			<input type="submit" class="button button-primary" value="Delete Selected" onclick="
				return confirm( 'Are you sure you want to delete the selected entries?' );
			">
		</p>

		<table class="widefat fixed">
		<thead>
		<tr>
			<th scope="col" class="manage-column check-column" id="cb"><input type="checkbox"></th>
			<th>Domain/Keyword</th>
			<th>Notes</th>
		</tr>
		</thead>
		<tbody>
		
		<?php $alt = false; foreach ( Referer_Spam_Blocker::get_domains() as $domain => $desc ) : ?>

		<tr class="<?php if ( $alt ) echo 'alternate'; ?>">
			<th class="check-column" scope="row">
				<input type="checkbox" name="rsb[]" value="<?php echo esc_attr( $domain ); ?>">
			</th>
			<td>
				<?php echo esc_html( $domain ); ?>
				<div class="row-actions">
					<a href="<?php echo esc_url( self::get_admin_url( array( 'item' => $domain ) ) ); ?>">
						Delete
					</a>
				</div>
			</td>
			<td>
				<em><?php echo esc_html( $desc ); ?></em>
			</td>
		</tr>

		<?php $alt = !$alt; endforeach; ?>

		</tbody>
		</table>
		
		<p>
			<input type="submit" class="button button-primary alignright" value="Delete Selected" onclick="
				return confirm( 'Are you sure you want to delete the selected entries?' );
			">
		</p>

	</form>

</div>