<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
layout_page_header( lang_get( 'ZipFiles' ) );
layout_page_begin( 'config_page.php' );
print_manage_menu();
?>
<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" > 
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
		<?php echo lang_get( 'ZipFiles' ) . ': ' . lang_get( 'plugin_format_config' )?>
	</h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive"> 
<table class="table table-bordered table-condensed table-striped"> 
<tr  >
<td class="category" colspan="3">

</td>
</tr>

<tr >
<td class="category" width="60%">
<?php echo lang_get( 'zip_attachments' )?>
</td>
<td class="center" width="20%">
<label><input type="radio" name='zip_attachments' value="1" <?php echo( ON == plugin_config_get( 'zip_attachments' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'yes_zip' )?></label>
<label><input type="radio" name='zip_attachments' value="0" <?php echo( OFF == plugin_config_get( 'zip_attachments' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'no_zip' )?></label>
</td>
</tr> 

<tr  >
<td class="category">
<?php echo lang_get( 'zip_attachments_included_extensions' ) ?>
</td>
<td class="center">
<input type="text" size="25" maxlength="100" name="zip_attachments_included_extensions" value="<?php echo plugin_config_get( 'zip_attachments_included_extensions'  )?>"/>
</td>
</tr> 

<tr  >
<td class="category">
<?php echo lang_get( 'zip_attachments_minimum_size' ) ?>
</td>
<td class="center">
<input type="number" size="6" maxlength="10" name="zip_attachments_minimum_size" value="<?php echo plugin_config_get( 'zip_attachments_minimum_size'  )?>"/>
</td>
</tr> 

<tr  >
<td class="category">
<?php echo lang_get( 'zip_attachments_minimum_compress_ratio' ) ?>
</td>
<td class="center">
<input type="text" size="2" maxlength="2" name="zip_attachments_minimum_compress_ratio" value="<?php echo plugin_config_get( 'zip_attachments_minimum_compress_ratio'  )?>"/>
</td>
</tr> 

<tr>
<td class="center" colspan="3">
<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
</td>
</tr>

</table>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
<?php
layout_page_end();