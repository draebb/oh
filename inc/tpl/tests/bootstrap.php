<?php
define( 'TPL_DIR', dirname(__FILE__) . '/../src' );


/**
 * Removes directory recursively.
 *
 * Copied from http://www.php.net/manual/en/function.rmdir.php#98622
 *
 * @param $dir string
 */
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			}
		} 
		reset($objects);
		rmdir($dir);
	}
}


/**
 * Writes file.
 *
 * @param $name string
 * @param $content string
 */
function write_file( $file_name, $content ) {
	$file = fopen( $file_name, 'w' );
	fwrite( $file, $content);
	fclose( $file );
}
