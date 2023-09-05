<?php
// authenticate
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
// Read results
$f_zip_attachments = gpc_get_int( 'zip_attachments', ON );
$f_zip_attachments_included_extensions = gpc_get_string( strtolower( 'zip_attachments_included_extensions', 'txt,csv' ) );
$f_zip_attachments_minimum_size = gpc_get_int( 'zip_attachments_minimum_size', 1024 );
$f_zip_attachments_minimum_compress_ratio = gpc_get_int( 'zip_attachments_minimum_compress_ratio', 40 );
// update results
plugin_config_set( 'zip_attachments', $f_zip_attachments );
plugin_config_set( 'zip_attachments_included_extensions', $f_zip_attachments_included_extensions );
plugin_config_set( 'zip_attachments_minimum_size', $f_zip_attachments_minimum_size );
plugin_config_set( 'zip_attachments_minimum_compress_ratio', $f_zip_attachments_minimum_compress_ratio );
// redirect
print_successful_redirect( plugin_page( 'config',TRUE ) );