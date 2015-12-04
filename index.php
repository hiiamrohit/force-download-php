<?php

function forceDownload($file) {
 //Check file exist or not
  if (file_exists($file)) {
     if(ini_get('zlib.output_compression')) { 
     	// required for IE
                ini_set('zlib.output_compression', 'Off');  
        }

        // Get mine type of file.
   $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
   $mimeType = finfo_file($finfo, $file) . "\n";
   finfo_close($finfo);
        header('Expires: 0');
        header('Pragma: public'); 
        header('Cache-Control: private',false);
        header('Content-Type:'.$mimeType);
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Length: '.filesize($file));
        header('Connection: close');
        readfile($file);
        exit;
  } else {
   return "File does not exist";
  }
}



if(isset($_REQUEST['file']) && !empty($_REQUEST['file'])) {
   forceDownload($_REQUEST['file']); 
}



?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Force download script in php</title>
</head>
<body>
<h3>Force download script in php</h3>
<form action="" method="post">
<input type="hidden" name="file" value="download/panda.jpg">
<button type="submit">Force Download</button>
</form>
</body>
</html>
