<?php
	require_once "upload_class.php";

	/**
	* 
	*/
	class UploadText extends Upload {
		protected $dir = "text";
		protected $mime_types = array("text/plain");
	}
?>