<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.voimada.com
 * @since      1.0.0
 *
 * @package    VoimadaRestAPI
 * @subpackage VoimadaRestAPI/admin/partials
 */

$security_key = sanitize_text_field(substr(base64_encode(SECURE_AUTH_KEY), 0, 30));

?>
<style>
	input#myInput {
		background: transparent;
		border: 2px solid #e0e0e0;
		height: 50px;
		width: 100%;
		/* max-width: 380px; */
		padding: 10px;
		box-shadow: none;
	}

	button {
		background: #00c9b7;
		border: none;
		height: 50px;
		width: 60px;
		margin-left: -5px;
		margin-top: -51px;
		float: right;
		position: absolute;
		right: 0;
		cursor: pointer;
	}

	button span {
		color: #fff;
	}

	.api_wrapper {
		display: table;
		margin: auto;
		float: none;
		width: 510px;
		margin-top: 200px;
		position: relative;
		box-sizing: border-box;
		border: 3px solid #dcdcdc;
		border-radius: 5px;
	}

	.content {
		padding: 35px;
	}

	.field {
		position: relative;
		margin-bottom: 45px;
	}

	h1 {
		margin-bottom: 40px;
	}

	strong {
		padding-bottom: 10px;
		display: block;
	}

	.desc {
		padding-bottom: 15px;
	}
</style>
<div class="api_wrapper">
	<div class="content">
		<h1>Authentication code</h1>
		<p class="desc">Click on the button to copy the authentication code from the text field.</p>

		<strong>API Authentication:</strong>

		<div class="field">

			<input type="text" value="<?php echo $security_key ?>" id="myInput">
			<button><span class="dashicons dashicons-admin-page"></span></button>
		</div>

		<strong>API Endpoint:</strong>

		<div class="field">

			<input type="text" value="<?php echo get_site_url() ?>/wp-json/voimada_api/v1/post/?secret_key=<?php echo $security_key; ?>" id="myInput">
			<button><span class="dashicons dashicons-admin-page"></span></button>
		</div>
	</div>
</div>
<script>
	jQuery('.api_wrapper button').click(function() {

		var input = jQuery(this).prev('input').select();


		jQuery(input).focus();
		jQuery(input).select();
		document.execCommand('copy');
	});
</script>