<?php
if(!defined('ABSPATH')) exit();
if(!defined('CSINFO_ENABLE_LOGGING')) define('CSINFO_ENABLE_LOGGING', true);
class CSInfo_Loader{
	// generic functions, used in both front/back-ends
	var $generic_files = array();

	// admin files
	var $admin_files = array(
		'classes/CSInfo_Template.class.php',
		'classes/CSInfo_Admin.class.php',
	);

	// frontend files
	var $frontend_files = array();

	function __construct(){
		// initialize our failsafe
		$all_files_loaded = true; // we're going to trip this in our foreach...

		$all_files = array($this->generic_files, $this->admin_files, $this->frontend_files); // we refer to each section as a brach

		foreach($all_files as $branch):
			foreach($branch as $file):
				if(!$this->requireFile($file)):
					$all_files_loaded = false;
					$this->log(sprintf('Couldn\'t load file: %s', $file));
				else:
					// do nothing, we're cool, the file loaded ok
				endif;
			endforeach;
		endforeach;

		// and now we proceed or bail based on if our failsafe is still true
		if($all_files_loaded):
			// this is where we load all of our stuff i guess.
			// maybe we'll make a decision quickly about whether they're on the front or back end...
		else:
			// for some reason, we didn't get all files.
			// we should handle that accordingly. the ideal
			// thing is to just bail out, and maybe try to clean
			// any mess from the #fail
		endif;
	}

	function requireFile($file){
		// this directory, plus a slash, plus the file name
		$target_file = CSINFO_DIR . '/' . $file;
		if(file_exists($target_file)):
			require_once($target_file);
			return true;
		else:
			$this->log('Unable to locate file: ' . $target_file);
			return false;
		endif;
	}

	function log($msg){
		if(CSINFO_ENABLE_LOGGING){
			error_log(sprintf('%s (%s)', $msg, __FILE__));
		}
	}
}
?>