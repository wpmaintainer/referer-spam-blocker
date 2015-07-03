<form method="post" action="" class="rsb-add" id="rsb-add">

	<p>
		<label for="rsb-domain">
			<strong>Add Domain Keyword:</strong>
		</label>
		<input type="text" id="rsb-domain" name="rsb[domain]" value="" placeholder="e.g. some-domain">

		<label for="rsb-note">
			<strong>Note(s):</strong>
		</label>
		<input id="rsb-note" name="rsb[note]" value="" size="30">

		<?php wp_nonce_field( 'rsb-add', 'rsb-nonce' ); ?>

		<input type="submit" value="Add Domain/Keyword" class="button button-primary">
	</p>
	<div style="margin:1em 0;padding:1em;background:#f8f8f8;border:1px solid #e9e9e9;max-width:70%">
		<strong>Note:</strong><br>
		This plugin will look for the domain keyword in the domain name that is referring to your website.
		So, a keyword of "social" will match all sites with the word "social" in the domain. It's best to 
		be as specific as possible.
	</div>

</form>

<script type="text/javascript">
jQuery( document ).ready(function($){

	$( '#rsb-add' ).submit(function(){
		if ( $( '#rsb-domain' ).val() == '' )
		{
			alert( 'You must enter a domain/keyword' );
			return false;
		}
	});

});
</script>