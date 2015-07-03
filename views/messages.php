<?php if ( isset( $message ) ) : ?>

<div class="message updated">
	<p><?php echo esc_html( $message ); ?></p>
</div>

<?php endif; ?>
<?php if ( isset( $error ) ) : ?>

<div class="message error">
	<p><?php echo esc_html( $error ); ?></p>
</div>

<?php endif; ?>