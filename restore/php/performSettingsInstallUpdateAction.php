<?php
require_once('settingsInstallUpdate.php');
$action = $_POST['action'];
if($action == 'downloadFile')
{
	$boolUp = false;
	if(isset($_POST['update']))
	{
		if($_POST['update'] == true)
		{
			$boolUp = true;
		}
	}
	downloadFile($_POST['file'],$boolUp,$_POST['downloadFrom'],$_POST['downloadTo']);
	$response = true;
}
elseif($action == 'unzipFile')
{
	unzipFileAndSub($_POST['locationExtractFrom'],"",$_POST['locationExtractTo'],"../../");
	$response = true;
}
elseif($action == 'unzipUpdateAndReturnArray')
{
	$response = unzipFile();
}
elseif($action == 'removeZipFile')
{
	removeZipFile($_POST['fileToUnlink']);
	$response = true;
}
elseif($action == 'removeUnZippedFiles')
{
	$removeDir = true;
	if(isset($_POST['removeDir']))
	{
		$removeDir = $_POST['removeDir'];
	}
	rrmdir($_POST['locationOfFilesThatNeedToBeRemovedRecursivally']);
	$response = true;
}
elseif($action == 'removeDirUpdate')
{
	removeUnZippedFiles();
	$response = true;
}
elseif($action == 'verifyFileIsThere')
{
	$response = verifyFileIsThere($_POST['fileLocation'], $_POST['isThere']);
}
elseif($action == 'verifyDirIsThere')
{
	$response = verifyDirIsThere($_POST['dirLocation']);
}
elseif($action == 'checkIfDirIsEmpty')
{
	if (verifyDirIsEmpty($_POST['dir']))
	{
  		$response = true;
	}
	else
	{
  		$response = false;
	}
}
elseif($action == 'removeAllFilesFromLogHogExceptRestore')
{
	$files = scandir('../../');
	foreach ($files as $thing => $file)
	{
		if($file != "." && $file != ".." && $file != "restore")
		{
			$fileDir = '../../'.$file;
			if(is_dir($fileDir))
			{
				rrmdir($fileDir);
			}
			else
			{
				removeZipFile($fileDir);
			}
		}
	}
	$response = true;
}
elseif($action == "changeDirUnzipped")
{
	$files = scandir('../../restore/extracted/');
	foreach ($files as $thing => $file)
	{
		$fileDirNew = '../../'.$file;
		$fileDirOld = '../../restore/extracted/'.$file;
		rename($fileDirOld, $fileDirNew);
	}
	$response = true;
}
elseif($action == 'moveDirUnzipped')
{
	rename("../../Log-Hog-".$_POST['version'], "../../restore/extracted");
	$response = true; 
}
elseif($action == 'updateProgressFile')
{
	updateProgressFile($_POST['status'], $_POST['pathToFile'], $_POST['typeOfProgress'], $_POST['actionSave'], $_POST['percent']);

	$response = true;
}
else
{
	$response = "ACTION";
}
echo json_encode($response);