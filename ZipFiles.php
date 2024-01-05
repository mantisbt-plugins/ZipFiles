<?php
# Copyright (c) 2023 Cas Nuy (cas@nuy.info)

# Zip export for MantisBT is free software: 
# you can redistribute it and/or modify it under the terms of the GNU
# General Public License as published by the Free Software Foundation, 
# either version 2 of the License, or (at your option) any later version.
#
# Zip export plugin for MantisBT is distributed in the hope 
# that it will be useful, but WITHOUT ANY WARRANTY; without even the 
# implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
# See the GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Zip export plugin for MantisBT.  
# If not, see <http://www.gnu.org/licenses/>.

class ZipFilesPlugin extends MantisPlugin {
    
    function register() {
        $this->name = plugin_lang_get("title");
        $this->description = plugin_lang_get("description");

        $this->version = "2.01";
        $this->requires = array(
			"MantisCore" => "2.0.0"
        );

        $this->author = "Cas Nuy";
        $this->contact = "cas-at-nuy.info";
        $this->url ="https://github.com/mantisbt-plugins/ZipFiles";
		$this->page		   = 'config';
    }
    
    function init() {
		event_declare('EVENT_ZIP_FILES');
	 	plugin_event_hook( 'EVENT_ZIP_FILES', 'include_zip_action' );
    }
    
	function include_zip_action($p_event, &$t_file) {
		$t_zip_attachments = plugin_config_get( 'zip_attachments' );
		if ( $t_zip_attachments == 1 && extension_loaded( 'zip' ) ) {
			$t_zip_attachments_included_extensions = explode( ",", plugin_config_get( 'zip_attachments_included_extensions' ) );
			$t_zip_attachments_minimum_size = plugin_config_get( 'zip_attachments_minimum_size' ) ;
			$t_zip_attachments_minimum_compress_ratio = plugin_config_get( 'zip_attachments_minimum_compress_ratio' ) ;
			if ( $t_file['size'] > $t_zip_attachments_minimum_size ) {
				$t_extension = strtolower( pathinfo( $t_file['name'] , PATHINFO_EXTENSION ) );
				if ( in_array( $t_extension , $t_zip_attachments_included_extensions ) ) {
					$t_orgsize_attachment = filesize( $t_file['tmp_name'] );
					$t_new_filename  = $t_file['tmp_name'].".zip";
					$zip = new ZipArchive();
					$zip->open( $t_new_filename, ZIPARCHIVE::CREATE );
					$zip->addFile( $t_file['tmp_name'] );
					$zip->close();
					$t_zipsize_attachment = filesize( $t_new_filename );
					$t_actual_zip_ratio = ( 100 - ( $t_zipsize_attachment / $t_orgsize_attachment * 100 ) );
					if ( $t_actual_zip_ratio >= $t_zip_attachments_minimum_compress_ratio ){
						$t_file['name'] 	.=".zip";
						$t_file['tmp_name'] .=".zip";
						$t_file['size'] 	= $t_zipsize_attachment;
					}
				}
			}
		}
		return $t_file;
	}

	function config() {
		return array(
			'zip_attachments'							=> ON,
			'zip_attachments_included_extensions'		=> 'txt,csv',
			'zip_attachments_minimum_size'				=> 1024,
			'zip_attachments_minimum_compress_ratio'	=> 40,
			);
	}

}