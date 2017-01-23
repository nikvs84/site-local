<?php
	require_once "upload_class.php";

	class UploadImage extends Upload {
		protected $dir = "images";
		protected $mime_types = array("image/png", "image/jpeg", "image/gif");
	}
?>