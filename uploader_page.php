<?php require_once('inc-main.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Simple File Uploader and  Explorer</title>
<link rel="shortcut icon" href="icon.png" type="image/png" />
<link rel="stylesheet" href="css/dropzone.css">
<link rel="stylesheet" href="css/style.css">
<link href='//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' rel='stylesheet'>
<script type='text/javascript' src='//code.jquery.com/jquery-1.10.2.min.js'></script>
<script type='text/javascript' src='//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<!-- DROPZONE -->
      <script src="js/dropzone.js"></script>
      <script>
         $(document).ready(function(){

             "use strict";

             Dropzone.options.myAwesomeDropzone = {

                 autoProcessQueue: true,
                 uploadMultiple: false,
                 parallelUploads: 1000000,
                 maxFiles: 1000000,
				 acceptedFiles: '',
				 dictInvalidFileType: 'File type is not supported.',
				 maxFilesize: 2000,
				 dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",

                 // Dropzone settings
                 init: function() {
                     var myDropzone = this;

                     this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                         e.preventDefault();
                         e.stopPropagation();
                         myDropzone.processQueue();
                     });
                     this.on("sendingmultiple", function() {
                     });
                     this.on("successmultiple", function(files, response) {
                     });
                     this.on("errormultiple", function(files, response) {
                     });
                 }

             };



         });


      </script>

  </head>

  <body>

  <div class="container">
    <div class="row">

			<div class="panel panel-default">
				<div class="panel-heading"><strong>Upload files</strong> <small> </small></div>
                <form id="my-awesome-dropzone" class="dropzone" action="upload.php" enctype="multipart/form-data" style="margin:0px;">
					<!-- Drop Zone -->
					<div class="dropzone-previews"></div>
                </form>
			</div>




	</div>
</div>
<footer>
<div class="panel-body">
<a class="pull-right small text-muted" href="http://www.nelliwinne.net" target="_blank">Develped By Nelliwinne</a>
</div>
</footer>
<!-- /container -->



  </body>
</html>
