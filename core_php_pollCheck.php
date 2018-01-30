<?php
$baseModifier = "../../";
require_once($baseModifier.'local/layout.php');
$baseUrl = $baseModifier."local/".$currentSelectedTheme."/";
require_once($baseUrl.'conf/config.php');
require_once($baseModifier.'core/conf/config.php');
require_once('configStatic.php');
require_once('updateProgressFile.php');
require_once('commonFunctions.php');

$varsLoadLite = array("watchList");

foreach ($varsLoadLite as $varLoadLite)
{
	$$varLoadLite = $defaultConfig[$varLoadLite];
	if(array_key_exists($varLoadLite, $config))
	{
		$$varLoadLite = $config[$varLoadLite];
	}
}

$response = array();
$currentVersionPost = $configStatic["version"];
if(isset($_POST['currentVersion']))
{
	$currentVersionPost = $_POST['currentVersion'];
}

if($configStatic['version'] != $currentVersionPost)
{
	echo json_encode(false);
	exit();
}

if(array_key_exists('percent', $updateProgress) && ($updateProgress['percent'] != 0) && $updateProgress['percent'] != 100)
{
	echo json_encode("update in progress");
	exit();
}

foreach($watchList as $path => $filter)
{
	if(is_dir($path))
	{
		$path = preg_replace('/\/$/', '', $path);
		if(file_exists($path))
		{
			$scannedDir = scandir($path);
			if(!is_array($scannedDir))
			{
				$scannedDir = array($scannedDir);
			}
			$files = array_diff($scannedDir, array('..', '.'));
			if($files)
			{
				foreach($files as $k => $filename)
				{
					$fullPath = $path . DIRECTORY_SEPARATOR . $filename;
					if(preg_match('/' . $filter . '/S', $filename) && is_file($fullPath))
					{
						$response[$fullPath] = getFileSize($fullPath);
					}
				}
			}
		}
	}
	elseif(file_exists($path))
	{
		$response[$path] = getFileSize($path);
	}
}

echo json_encode($response);
exit();