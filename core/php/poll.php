<?php
$baseUrl = "../../core/";
if(file_exists('../../local/layout.php'))
{
	$baseUrl = "../../local/";
	//there is custom information, use this
	require_once('../../local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}
require_once($baseUrl.'conf/config.php');
require_once('../../core/conf/config.php'); 
require_once('../../core/php/configStatic.php');

if(array_key_exists('enableSystemPrefShellOrPhp', $config))
{
	$enableSystemPrefShellOrPhp = $config['enableSystemPrefShellOrPhp'];
}
else
{
	$enableSystemPrefShellOrPhp = $defaultConfig['enableSystemPrefShellOrPhp'];
}
if(array_key_exists('logTrimOn', $config))
{
	$logTrimOn = $config['logTrimOn'];
}
else
{
	$logTrimOn = $defaultConfig['logTrimOn'];
}
if(array_key_exists('logSizeLimit', $config))
{
	$logSizeLimit = $config['logSizeLimit'];
}
else
{
	$logSizeLimit = $defaultConfig['logSizeLimit'];
}

$logSizeLimit = intval($logSizeLimit);

if(array_key_exists('logTrimMacBSD', $config))
{
	$logTrimMacBSD = $config['logTrimMacBSD'];
}
else
{
	$logTrimMacBSD = $defaultConfig['logTrimMacBSD'];
}
if(array_key_exists('logTrimType', $config))
{
	$logTrimType = $config['logTrimType'];
}
else
{
	$logTrimType = $defaultConfig['logTrimType'];
}
if(array_key_exists('TrimSize', $config))
{
	$TrimSize = $config['TrimSize'];
}
else
{
	$TrimSize = $defaultConfig['TrimSize'];
}
if(array_key_exists('enableLogging', $config))
{
	$enableLogging = $config['enableLogging'];
}
else
{
	$enableLogging = $defaultConfig['enableLogging'];
}
if(array_key_exists('buffer', $config))
{
	$buffer = $config['buffer'];
}
else
{
	$buffer = $defaultConfig['buffer'];
}

$modifier = "lines";

if($logTrimType == 'size')
{	
	$modifier = $TrimSize;
	if($TrimSize == "KB")
	{
		$logSizeLimit *= 1024;
	}
	elseif($TrimSize == "M")
	{
		$logSizeLimit *= (1000 * 1000);
	}
	elseif($TrimSize == "MB")
	{
		$logSizeLimit *= (1024 * 1024);
	}
	else
	{
		$logSizeLimit *= 1000;
	}

}

function tail($filename, $sliceSize, $shellOrPhp, $logTrimCheck, $logSizeLimit,$logTrimMacBSD,$logTrimType,$TrimSize,$buffer) 
{
	$filename = preg_replace('/([()"])/S', '$1', $filename);
	//echo $filename, "\n";
	if(filesize($filename) == 0)
	{
		$data =  "This file is empty. This should not be displayed.";
	}
	else
	{
		
		if($logTrimCheck == "true" || true)
		{
			$lineCount = shell_exec('wc -l < ' . $filename);
		}
		if($logTrimCheck == "true")
		{
			if($logTrimType == 'lines')
			{
				if($lineCount > ($logSizeLimit+$buffer))
				{
					if($logTrimMacBSD == "true")
					{
						shell_exec('sed -i "" "1,' . ($lineCount - $logSizeLimit) . 'd" ' . $filename);
					}
					else
					{
						shell_exec('sed -i "1,' . ($lineCount - $logSizeLimit) . 'd" ' . $filename);
					}
				}
			}
			elseif($logTrimType == 'size')
			{
				$maxForLoop = 0;
				//compair to trimsize value
				$trimFileBool = true;
				while ($trimFileBool && $maxForLoop != 10)
				{
					$filesizeForFile = shell_exec('wc -c < '.$filename);
					if($filesizeForFile > $logSizeLimit+$buffer)
					{
						if($filesizeForFile > (2*$logSizeLimit) && $maxForLoop < 2)
						{
							//use different method
							$lineCountForFile = shell_exec('wc -l < ' . $filename);
							$fileSizePerLine = $filesizeForFile/$lineCountForFile;
							$numOfLinesAllowed = $logSizeLimit/$fileSizePerLine;
							$numOfLinesAllowed *= 2;
							if($logTrimMacBSD == "true")
							{
								shell_exec('sed -i "" "1,' . round($lineCountForFile - $numOfLinesAllowed) . 'd" ' . $filename);
							}
							else
							{
								shell_exec('sed -i "1,' . round($lineCountForFile - $numOfLinesAllowed) . 'd" ' . $filename);
							}
						}
						else
						{
							//remove first line in file
							if($logTrimMacBSD == "true")
							{
								shell_exec('sed -i "" "1,2d" ' . $filename);
							}
							else
							{
								shell_exec('sed -i "1,2d" ' . $filename);
							}
						}
					}	
					else
					{
						$trimFileBool = false;
					}
					$maxForLoop++;
				}
			}
		}

		if($shellOrPhp == "true")
		{
			$data =  trim(tailCustom($filename, $sliceSize));
			
		}
		else
		{
			$data = trim(shell_exec('tail -n ' . $sliceSize . ' "' . $filename . '"'));
			if($data == "" || is_null($data))
			{
				$data = trim(tailCustom($filename, $sliceSize));
			}
		}

		if($data == "" || is_null($data))
		{
			$data = "Error - Maybe insufficient access to read file?";
		}

	}
	return $data;
}

/**
 * Slightly modified version of http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
 * @author Torleif Berger, Lorenzo Stanco
 * @link http://stackoverflow.com/a/15025877/995958
 * @license http://creativecommons.org/licenses/by/3.0/
 */
function tailCustom($filepath, $lines = 1, $adaptive = true) 
{

	// Open file
	$f = @fopen($filepath, "rb");
	if ($f === false) return false;

	// Sets buffer size, according to the number of lines to retrieve.
	// This gives a performance boost when reading a few lines from the file.
	if (!$adaptive) $buffer = 4096;
	else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

	// Jump to last character
	fseek($f, -1, SEEK_END);

	// Read it and adjust line number if necessary
	// (Otherwise the result would be wrong if file doesn't end with a blank line)
	if (fread($f, 1) != "\n") $lines -= 1;
	
	// Start reading
	$output = '';
	$chunk = '';

	// While we would like more
	while (ftell($f) > 0 && $lines >= 0) 
	{

		// Figure out how far back we should jump
		$seek = min(ftell($f), $buffer);

		// Do the jump (backwards, relative to where we are)
		fseek($f, -$seek, SEEK_CUR);

		// Read a chunk and prepend it to our output
		$output = ($chunk = fread($f, $seek)) . $output;

		// Jump back to where we started reading
		fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

		// Decrease our line counter
		$lines -= substr_count($chunk, "\n");

	}

	// While we have too many lines
	// (Because of buffer size we might have read too many)
	while ($lines++ < 0) 
	{

		// Find first newline and remove all text before that
		$output = substr($output, strpos($output, "\n") + 1);

	}

	// Close file and return
	fclose($f);
	return trim($output);

}

$response = array();

foreach($_POST['arrayToUpdate'] as $path) 
{
	if(file_exists($path))
	{
		if($enableLogging != "false")
		{
			$time_start = microtime(true);
		}
		$dataVar =  htmlentities(tail($path, $config['sliceSize'], $enableSystemPrefShellOrPhp, $logTrimOn, $logSizeLimit,$logTrimMacBSD,$logTrimType,$TrimSize,$buffer));

		if($enableLogging != "false")
		{

			$lineCount = "0";
			$filesizeForFile = "0";

			if($dataVar == "" || is_null($dataVar) || $dataVar == "Error - Maybe insufficient access to read file?")
			{
				$lineCount = "---";
				$filesizeForFile = "---";
			}
			else
			{	
				if($dataVar != "This file is empty. This should not be displayed.")
				{
					$filename = $path;
					$filename = preg_replace('/([()"])/S', '$1', $filename);
					$lineCount = shell_exec('wc -l < ' . $filename);
					$filesizeForFile = shell_exec('wc -c < '.$filename);
				}
			}
			$time_end = microtime(true);
			$time = $time_end - $time_start;
			$time *= 1000;
			$response[$path."dataForLoggingLogHog051620170928"] = " Limit: ".$logSizeLimit."(".($logSizeLimit+$buffer).") ".$modifier." | Line Count: ".$lineCount." | File Size: ".$filesizeForFile." | Time: ".round($time);
		}

		$response[$path] = $dataVar;
	}
}

echo json_encode($response);