<div class="wrap">

	<h2>Manage Blocked Referring Domains</h2>

	<?php include dirname( __FILE__ ) . '/messages.php'; ?>

	<p>
		<span class="">
			Thank you for using Referer Spam Blocker by WP Maintainer.
			<a class="button button-primary" href="https://wpmaintainer.com/checkout/?promo=10offrsb" target="_blank">Get 10% Off Today &rarr;</a>
		</span>
	</p>

	<?php include dirname( __FILE__ ) . '/admin-add-item.php'; ?>

	<?php if ( count( Referer_Spam_Blocker::get_domains() ) > 0 ) : ?>

	<form method="post" action="">
		
		<?php wp_nonce_field( 'rsb-delete', 'rsb-nonce' ); ?>

		<?php include dirname( __FILE__ ) . '/admin-part-delete.php'; ?>
		

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
				<input type="checkbox" name="rsb-delete[]" value="<?php echo esc_attr( $domain ); ?>">
			</th>
			<td>
				<?php echo esc_html( $domain ); ?>
				<div class="row-actions">
					<span class="trash"><a 
						href="<?php echo esc_url( self::get_admin_url( array( 'rsb-delete' => $domain ) ) ); ?>" onclick="
							return confirm( 'Are you sure?' );
						">
						Delete
					</a></span>
				</div>
			</td>
			<td>
				<em><?php echo esc_html( $desc ); ?></em>
			</td>
		</tr>

		<?php $alt = !$alt; endforeach; ?>

		</tbody>
		</table>
		
		<?php include dirname( __FILE__ ) . '/admin-part-delete.php'; ?>

	</form>

	<?php else : ?>

	<div class="updated" style="border-color: #888;"><p>You have no domains/keywords. Add one above or <a href="<?php 
		echo esc_url( self::get_admin_url( array( 'rsb-update' => 1 ) ) );
	?>">Reset Default Domain Keywords</a></p></div>

	<?php endif; ?>

	<center>
		<p>
			<a class="button button-primary" href="https://wpmaintainer.com/checkout/?promo=10offrsb" target="_blank">Get 10% Off WP Maintainer Today &rarr;</a>
		</p>
	</center>

</div>