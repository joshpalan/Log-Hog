<?php


function updateMainProgressLogFile($dotsTime)
{

	require_once('configStatic.php');
	require_once('updateProgressFileNext.php');

	require_once('verifyWriteStatus.php');
	checkForUpdate($_SERVER['REQUEST_URI']);

	$dots = "";
	while($dotsTime > 0.1)
	{
		$dots .= " .";
		$dotsTime -= 0.1;
	}
	$versionToUpdate = "";

	//find next version to update to
	if(!empty($configStatic))
	{

		foreach ($configStatic['versionList'] as $key => $value) 
		{
			$version = explode('.', $configStatic['version']);
			$newestVersion = explode('.', $key);

			$levelOfUpdate = 0; // 0 is no updated, 1 is minor update and 2 is major update

			$newestVersionCount = count($newestVersion);
			$versionCount = count($version);

			for($i = 0; $i < $newestVersionCount; $i++)
			{
				if($i < $versionCount)
				{
					if($i == 0)
					{
						if($newestVersion[$i] > $version[$i])
						{
							$levelOfUpdate = 3;
							$versionToUpdate = $key;
							break;
						}
						elseif($newestVersion[$i] < $version[$i])
						{
							break;
						}
					}
					elseif($i == 1)
					{
						if($newestVersion[$i] > $version[$i])
						{
							$levelOfUpdate = 2;
							$versionToUpdate = $key;
							break;
						}
						elseif($newestVersion[$i] < $version[$i])
						{
							break;
						}
					}
					else
					{
						if($newestVersion[$i] > $version[$i])
						{
							$levelOfUpdate = 1;
							$versionToUpdate = $key;
							break;
						}
						elseif($newestVersion[$i] < $version[$i])
						{
							break;
						}
					}
				}
				else
				{
					$levelOfUpdate = 1;
					$versionToUpdate = $key;
					break;
				}
			}

			if($levelOfUpdate != 0)
			{
				break;
			}

		}
	}
	

	if(!empty($configStatic))
	{
		$varForHeaderTwo = '"'.$versionToUpdate.'"';
		$stringToFindHeadTwo = "$"."versionToUpdate";
	}
	else
	{
		$varForHeaderTwo = '"New Version"';
		$stringToFindHeadTwo = "$"."versionToUpdate";
	}
	$dots .= "</p>";
	$varForHeader = '"'.$updateProgress['currentStep'].'"';
	
	$stringToFindHead = "$"."updateProgress['currentStep']";
	
	$headerFileContents = file_get_contents("updateProgressLogHead.php");
	$headerFileContents = str_replace('id="headerForUpdate"', "", $headerFileContents);
	$headerFileContents = str_replace($stringToFindHead, $varForHeader , $headerFileContents);
	$headerFileContents = str_replace($stringToFindHeadTwo, $varForHeaderTwo , $headerFileContents);
	$headerFileContents = str_replace('.</p>', $dots, $headerFileContents);
	$mainFileContents = file_get_contents("updateProgressLog.php");
	$mainFileContents = $headerFileContents.$mainFileContents;
	file_put_contents("updateProgressLog.php", $mainFileContents);
}

function updateHeadProgressLogFile($message)
{

}

function updateProgressFile($status, $pathToFile, $typeOfProgress, $action)
{
	$writtenTextTofile = "<?php
	$"."updateProgress = array(
  	'currentStep'   => '".$status."',
  	'action' => '".$action."'
	);
	?>
	";

	$fileToPutContent = $pathToFile.$typeOfProgress;

	file_put_contents($fileToPutContent, $writtenTextTofile);
}

function downloadFile($file = null, $update = true, $downloadFrom = 'Log-Hog/archive/', $downloadTo = '../../update/downloads/updateFiles/updateFiles.zip')
{
	require_once('configStatic.php');
	if($update == true)
	{
		$arrayForFile = $configStatic['versionList'];
		$arrayForFile = $arrayForFile[$file];
		$file = $arrayForFile['branchName'];
	}
	if($file == null)
	{
		$file = $POST_['file'];
	}
	file_put_contents($downloadTo, 
	file_get_contents("https://github.com/mreishman/".$downloadFrom.$file.".zip")
	);
}

function unzipFile($locationExtractTo = '../../update/downloads/updateFiles/extracted/', $locationExtractFrom = '../../update/downloads/updateFiles/updateFiles.zip')
{


	mkdir($locationExtractTo);
	$zip = new ZipArchive;
	$path = $locationExtractFrom;
	$res = $zip->open($path);
	$arrayOfExtensions = array('.php','.js','.css','.html','.png','.jpg','.jpeg','.gif');
	if ($res === TRUE) {
	  for($i = 0; $i < $zip->numFiles; $i++) {
	        $filename = $zip->getNameIndex($i);
	        $fileinfo = pathinfo($filename);
	        if (strposa($fileinfo['basename'], $arrayOfExtensions, 1)) 
	        {
	          copy("zip://".$path."#".$filename, $locationExtractTo.$fileinfo['basename']);
	        }
	    }                   
	    $zip->close();  
	}
}

function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

function removeZipFile($fileToUnlink = "../../update/downloads/updateFiles/updateFiles.zip")
{
	unlink($fileToUnlink);
}


function removeUnZippedFiles($locationOfFilesThatNeedToBeRemovedRecursivally = '../../update/downloads/updateFiles/extracted', $removeDirectory = true)
{
	$files = glob($locationOfFilesThatNeedToBeRemovedRecursivally."/*"); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
	    unlink($file); // delete file
	}
	if($removeDirectory)
	{
		removeDirectory();
	}
}

function removeDirectory($directory = "../../update/downloads/updateFiles/extracted/")
{
	if(is_dir($directory))
	{
		rmdir($directory);
	}
}

function verifyFileIsThere($file, $notInvert = true)
{
	if(is_file($file))
	{
		if($notInvert == false || $notInvert == "false")
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		if($notInvert == false || $notInvert == "false")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}

function verifyDirIsThere($file)
{
	if(is_dir($file))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function verifyDirIsEmpty($dir) 
{
  if (!is_readable($dir)) return NULL; 
  return (count(scandir($dir)) == 2);
}

function handOffToUpdate()
{
	require_once('../../update/downloads/updateFiles/extracted/updateScript.php');
}

function finishedUpdate()
{
	//nothing!
}

?>