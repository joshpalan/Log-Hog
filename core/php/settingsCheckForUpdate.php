<?php

file_put_contents("../../update/downloads/versionCheck/versionCheck.zip", 
file_get_contents("https://github.com/mreishman/Log-Hog/archive/versionCheck.zip")
);
mkdir("../../update/downloads/versionCheck/extracted/");
$zip = new ZipArchive;
$path = "../../update/downloads/versionCheck/versionCheck.zip";
$res = $zip->open($path);
if ($res === TRUE) {
  for($i = 0; $i < $zip->numFiles; $i++) {
  		echo $i;
  		echo "   --    ";
        $filename = $zip->getNameIndex($i);
        echo $filename;
        echo "   --    ";
        $fileinfo = pathinfo($filename);
        echo $fileinfo['basename'];
        echo "   --    ";
        copy("zip://".$path."#".$filename, "../../update/downloads/versionCheck/extracted/".$fileinfo['basename']);
    }                   
    $zip->close();  
}

unlink("../../update/downloads/versionCheck/versionCheck.zip");
//require_once('../../update/downloads/versionCheck/extracted/versionsCheckFile.php');

//write new info to version file in core/php/configStatic.php

$files = glob("../../update/downloads/versionCheck/extracted/*"); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}


rmdir("../../update/downloads/versionCheck/extracted/");

//header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>