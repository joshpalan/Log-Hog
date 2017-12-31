<?php
$baseModifier = "../../";
require_once($baseModifier.'local/layout.php');
$baseUrl = $baseModifier."local/".$currentSelectedTheme."/";
require_once($baseUrl.'conf/config.php');
require_once($baseModifier.'core/conf/config.php');
require_once('configStatic.php');
require_once('commonFunctions.php');

$modifier = "lines";
$enableSystemPrefShellOrPhp = $defaultConfig['enableSystemPrefShellOrPhp'];
$logTrimOn = $defaultConfig['logTrimOn'];
$logSizeLimit = $defaultConfig['logSizeLimit'];
$logTrimMacBSD = $defaultConfig['logTrimMacBSD'];
$logTrimType = $defaultConfig['logTrimType'];
$TrimSize = $defaultConfig['TrimSize'];
$enableLogging = $defaultConfig['enableLogging'];
$buffer = $defaultConfig['buffer'];

if(array_key_exists('enableSystemPrefShellOrPhp', $config))
{
	$enableSystemPrefShellOrPhp = $config['enableSystemPrefShellOrPhp'];
}
if(array_key_exists('logTrimOn', $config))
{
	$logTrimOn = $config['logTrimOn'];
}
if(array_key_exists('logSizeLimit', $config))
{
	$logSizeLimit = $config['logSizeLimit'];
}
if(array_key_exists('logTrimMacBSD', $config))
{
	$logTrimMacBSD = $config['logTrimMacBSD'];
}
if(array_key_exists('logTrimType', $config))
{
	$logTrimType = $config['logTrimType'];
}
if(array_key_exists('TrimSize', $config))
{
	$TrimSize = $config['TrimSize'];
}
if(array_key_exists('enableLogging', $config))
{
	$enableLogging = $config['enableLogging'];
}
if(array_key_exists('buffer', $config))
{
	$buffer = $config['buffer'];
}

$logSizeLimit = intval($logSizeLimit);

if($logTrimType == 'size')
{
	$modifier = $TrimSize;
	$logSizeLimit = convertToSize($TrimSize, $logSizeLimit);
}

$response = array();
foreach($_POST['arrayToUpdate'] as $path)
{
	try
	{
		if($enableLogging != "false")
		{
			$time_start = microtime(true);
		}

		$filename = preg_replace('/([()"])/S', '$1', $path);
		if(!is_readable($filename))
		{
			$dataVar = "Error - File is not Readable";
		}
		elseif(filesize($filename) === 0)
		{
			$dataVar = "This file is empty. This should not be displayed.";
		}
		else
		{
			$dataVar =  tail($filename, $config['sliceSize'], $enableSystemPrefShellOrPhp, $logTrimOn, $logSizeLimit,$logTrimMacBSD,$logTrimType,$buffer);
		}
		$dataVar = htmlentities($dataVar);

		if($enableLogging != "false")
		{
			$lineCount = "0";
			$filesizeForFile = "0";
			if($dataVar === "" || is_null($dataVar) || $dataVar === "Error - Maybe insufficient access to read file?" || $dataVar === "Error - File is not Readable")
			{
				$lineCount = "---";
				$filesizeForFile = "---";
			}
			elseif($dataVar !== "This file is empty. This should not be displayed.")
			{
				$lineCount = shell_exec('wc -l < ' . $filename);
				$filesizeForFile = shell_exec('wc -c < '.$filename);
			}

			$time = (microtime(true) - $time_start)*1000;
			$response[$path."dataForLoggingLogHog051620170928"] = " Limit: ".$logSizeLimit."(".($logSizeLimit+$buffer).") ".$modifier." | Line Count: ".$lineCount." | File Size: ".$filesizeForFile." | Time: ".round($time);
		}
		$response[$path] = $dataVar;
	}
	catch (Exception $e)
	{
		$response[$path] = "Error - Maybe insufficient access to read file?";
		$response[$path."dataForLoggingLogHog051620170928"] = " Limit: ".$logSizeLimit."(".($logSizeLimit+$buffer).") ".$modifier." | Line Count: --- | File Size: --- | Time: ---";
	}
}
echo json_encode($response);