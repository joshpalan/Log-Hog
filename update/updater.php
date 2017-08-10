<?php
$baseUrl = "../core/";
if(file_exists('../local/layout.php'))
{
	$baseUrl = "../local/";
	//there is custom information, use this
	require_once('../local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}
require_once($baseUrl.'conf/config.php');
require_once('../core/php/configStatic.php');
require_once('../core/php/updateProgressFile.php');
require_once('../core/php/settingsInstallUpdate.php'); 
require_once('../top/statusTest.php'); 

$noUpdateNeeded = true;
$versionToUpdate = "";

$versionToUpdateFirst = "";
$levelToUpdateFirst = 0;
$arrayOfVersions = array();

//find next version to update to
if($configStatic['newestVersion'] != $configStatic['version'])
{
	$noUpdateNeeded = false;
	foreach ($configStatic['versionList'] as $key => $value) {
		

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
			if(empty($arrayOfVersions))
			{
				$versionToUpdateFirst = $versionToUpdate;
				$levelToUpdateFirst = $levelOfUpdate;
			}
			array_push($arrayOfVersions, $versionToUpdate);
		}

	}
}

$versionToUpdate = $versionToUpdateFirst;
$levelOfUpdate = $levelToUpdateFirst;

if($levelOfUpdate == 0)
{
	$noUpdateNeeded = true;
}

if(!$noUpdateNeeded)
{

	$updateStatus = "";
	$updateAction = "";
	$requiredVars = "";

	//determin what step you're on
	if($updateProgress['currentStep'] == "Finished Updating to ")
	{
		//just starting update, switch to download
		$updateStatus = "Downloading Zip Files For ";
		$updateAction = "downloadFile";
		$requiredVars = $versionToUpdate;
	}
	elseif($updateProgress['currentStep'] == "Downloading Zip Files For ")
	{
		//just downloaded update, switch to unzipping
		$updateStatus = "Extracting Zip Files For ";
		$updateAction = "unzipFile";
	}
	elseif($updateProgress['currentStep'] == "Extracting Zip Files For ")
	{
		//just finished extracting, switch to removing zip file
		$updateStatus = "Running Update Script For ";
		$updateAction = "handOffToUpdate";
	}
	elseif($updateProgress['currentStep'] == "Finished Running Update Script")
	{
		//just finished runing update script, remove files 
		$updateStatus = "Removing Extracted Files";
		$updateAction = "removeUnZippedFiles";
	}
	elseif($updateProgress['currentStep'] == "Removing Extracted Files")
	{
		//just finished runing update script, remove files 
		$updateStatus = "Removing Zip File";
		$updateAction = "removeZipFile";
	}
	elseif($updateProgress['currentStep'] == "Removing Zip File")
	{
		//just finished runing update script, remove files 
		$updateStatus = "Finished Updating to ";
		$updateAction = "finishedUpdate";
		//change version in configStatic to updated version number

		$arrayForVersionList = "";
		$countOfArray = count($configStatic['versionList']);
		$i = 0;
		foreach ($configStatic['versionList'] as $key => $value) {
		  $i++;
		  $arrayForVersionList .= "'".$key."' => array(";
		  $countOfArraySub = count($value);
		  $j = 0;
		  foreach ($value as $keySub => $valueSub) 
		  {
		    $j++;
		    $arrayForVersionList .= "'".$keySub."' => '".$valueSub."'";
		    if($j != $countOfArraySub)
		    {
		      $arrayForVersionList .= ",";
		    }
		  }
		  $arrayForVersionList .= ")";
		  if($i != $countOfArray)
		  {
		    $arrayForVersionList .= ",";
		  }
		}

		$newInfoForConfig = "
		<?php

		$"."configStatic = array(
		  'version'   => '".$versionToUpdate."',
		  'lastCheck'   => '".date('m-d-Y')."',
		  'newestVersion' => '".$configStatic['newestVersion']."',
		  'versionList' => array(
		  ".$arrayForVersionList."
		  )
		);
		";

		file_put_contents("../core/php/configStatic.php", $newInfoForConfig);

	}
	else
	{
		//anything else will be passed to update script 
		$updateStatus = "Running Update Script For ";
		$updateAction = "handOffToUpdate";
	}
}
require_once('../core/php/updateProgressFileNext.php');
$newestVersionCheck = '"'.$configStatic['newestVersion'].'"';
$versionCheck = '"'.$configStatic['version'].'"';
?>

<!doctype html>
<head>
	<title>Log Hog | Updater</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>template/theme.css">
	<link rel="icon" type="image/png" href="../core/img/favicon.png" />
	<script src="../core/js/jquery.js"></script>
</head>
<body>


<div id="main">
	<div class="settingsHeader" style="text-align: center;" >
		<?php if ($configStatic['newestVersion'] == $versionToUpdate): ?>
			<h1>Updating to version <?php echo $versionToUpdate ; ?></h1>
		<?php else: ?>
			<h1>Updating to version <?php echo $versionToUpdate; ?> ... <?php echo $configStatic['newestVersion']; ?></h1>
		<?php endif; ?>
		<div id="menu" style="margin-right: auto; margin-left: auto; position: relative; display: none;">
			<a onclick="window.location.href = '../settings/update.php'">Back to Log-Hog</a>
		</div>
	</div>
	<div class="settingsDiv" >
		<div class="updatingDiv">
			<progress id="progressBar" value="0" max="100" style="width: 95%; margin-top: 10px; margin-bottom: 10px; margin-left: 2.5%;" ></progress>
			<p style="border-bottom: 1px solid white;"></p>
			<div id="innerDisplayUpdate" style="height: 300px; overflow: auto; max-height: 300px;">

			</div>
			<p style="border-bottom: 1px solid white;"></p>
			<div class="settingsHeader">
			Log Info
			</div>
			<div id="innerSettingsText" class="settingsDiv" style="height: 75px; overflow-y: scroll;" >
				<?php require_once('../core/php/updateProgressLog.php'); ?>
			</div>
		</div>
	</div>
</div>
</body>

<script src="../core/js/settings.js"></script>
<script type="text/javascript"> 
	var updateStatus = '<?php echo $updateStatus; ?>'
	var headerForUpdate = document.getElementById('headerForUpdate');
	var urlForSendMain = '../core/php/performSettingsInstallUpdateAction.php?format=json';
	var retryCount = 0;
	var verifyFileTimer;
	var versionToUpdateTo = "<?php echo $versionToUpdate; ?>";
	var percent = 0;
	var arrayOfFilesExtracted;
	var monitorLocation = "<?php echo $monitorStatus['withLogHog']?>";
	var lock = false;
	var settingsForBranchStuff = JSON.parse('<?php echo json_encode($configStatic);?>');
	var filteredArray = new Array();
	var preScripRunFileName = "";
	var preScriptCount = 1;
	var postScripRunFileName = "";
	var postScriptCount = 1;
	var fileCopyCount = 0;
	var arrayOfVersions = JSON.parse('<?php echo json_encode($arrayOfVersions);?>');
	<?php echo "var arrayOfVersionsCount = ".count($arrayOfVersions).";";?>
	var total = 100*arrayOfVersionsCount;

	$( document ).ready(function()
	{
		//pickNextAction();
	});

	function updateProgressBar(additonalPercent)
	{
		percent = percent + additonalPercent;
		document.getElementById('progressBar').value = percent/total*100;
		if(percent/total*100 > 100)
		{
			document.getElementById('progressBar').value = ((percent/total*100)-100);
		}
	}


	function updateText(text)
	{
		document.getElementById('innerSettingsText').innerHTML = "<p>"+text+"</p>"+document.getElementById('innerSettingsText').innerHTML;
	}

	function pickNextAction()
	{
		if(updateStatus == "Downloading Zip Files For ")
		{
			downloadBranch();
		}
		else if(updateStatus == "Extracting Zip Files For ")
		{
			//already downloaded, verify download then extract
			updateProgressBar(10);
			unzipBranch();
		}
		else if(updateStatus == 'preUpgrade Scripts')
		{
			updateProgressBar(20);
			preScriptRun();
		}
		else if(updateStatus == 'Copying Files')
		{

		}
		else if(updateStatus == 'postUpgrade Scripts')
		{

		}
		else if(updateStatus == 'postUpgrade Redirect')
		{

		}
		else if(updateStatus == "Removing Extracted Files")
		{
			//remove extracted files
		}
		else if(updateStatus == "Removing Zip File")
		{
			//remove zip
		}
	}

	function updateStatus(updateStatus, action)
	{

		var urlForSend = urlForSendMain;
		var data = {action: 'updateProgressFile', status: updateStatus, pathToFile: "../core/php/", typeOfProgress: "updateProgressFileNext.php", action: action, percent: (document.getElementById('progressBar').value)};
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: data,
			type: 'POST',
			complete: function()
			{
				
			}
		});	

		var data = {action: 'updateProgressFile', status: updateStatus, pathToFile: "../core/php/", typeOfProgress: "updateProgressFile.php", action: action, percent: (document.getElementById('progressBar').value)};
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: data,
			type: 'POST',
			complete: function()
			{
				
			}
		});	
	}

	function ajaxCheck()
	{
		var urlForSend = './updateCheck.php?format=json'
		var data = {status: updateStatus };
		$.ajax(
		{
			url: urlForSend,
			dataType: 'json',
			data: data,
			type: 'POST',
			success: function(data)
			{
				if(data == updateStatus)
				{
					clearInterval(timer);
					//saved, move on to next action
				}
		  	},
		});
	}

	function downloadBranch()
	{
		if(retryCount == 0)
		{
			updateText("Downloading Update");
		}
		else
		{
			updateText("Attempt "+(retryCount+1)+" of 3 for downloading Update");
		}
		var urlForSend = urlForSendMain;
		document.getElementById('innerDisplayUpdate').innerHTML = settingsForBranchStuff['versionList'][versionToUpdateTo]['releaseNotes']
		var data = {action: 'downloadFile', file: settingsForBranchStuff['versionList'][versionToUpdateTo]['branchName'],downloadFrom: 'Log-Hog/archive/', downloadTo: '../../update/downloads/updateFiles/updateFiles.zip'};
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: data,
			type: 'POST',
			complete: function()
			{
				//verify if downloaded
				updateText("Verifying Download");
				verifyFile('downloadLogHog', '../../update/downloads/updateFiles/updateFiles.zip');
			}
		});	

	}

	function unzipBranch()
	{
		//this builds array of file to copy (check if top is insalled for files copy)

		//
		if(retryCount == 0)
		{
			updateText("Unzipping Files");
		}
		else
		{
			updateText("Attempt "+(retryCount+1)+" of 3 for Unzipping Files");
		}
		var urlForSend = urlForSendMain;
		var dataSend = {action: 'unzipUpdateAndReturnArray'};
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: dataSend,
			type: 'POST',
			success: function(arrayOfFiles)
			{
				//verify if downloaded
				arrayOfFilesExtracted = arrayOfFiles;
				updateText("Verifying Unzipping");
				verifyFile('unzipUpdateAndReturnArray', '../../update/downloads/updateFiles/extracted/'+arrayOfFiles[0]);
			},
			failure: function(data)
			{
				retryCount++;
				unzipBranch();
			}
		});
	}

	function verifyFile(action, fileLocation,isThere = true)
	{
		verifyCount = 0;
		updateText('Verifying '+action+' with'+fileLocation);
		verifyFileTimer = setInterval(function(){verifyFilePoll(action,fileLocation,isThere);},6000);
	}

	function verifyFilePoll(action, fileLocation,isThere)
	{
		if(lock == false)
		{
			lock = true;
			updateText('verifying '+(verifyCount+1)+' of 10');
			var urlForSend = urlForSendMain;
			var data = {action: 'verifyFileIsThere', fileLocation: fileLocation, isThere: isThere , lastAction: action};
			(function(_data){
				$.ajax({
					url: urlForSend,
					dataType: 'json',
					data: data,
					type: 'POST',
					success: function(data)
					{
						verifyPostEnd(data, _data);
					},
					failure: function(data)
					{
						verifyPostEnd(data, _data);
					},
					complete: function()
					{
						lock = false;
					}
				});	
			}(data));
		}
	}

	function verifyPostEnd(verified, data)
	{
		if(verified == true)
		{
			clearInterval(verifyFileTimer);
			verifySucceded(data['lastAction']);
		}
		else
		{
			verifyCount++;
			if(verifyCount > 9)
			{
				clearInterval(verifyFileTimer);
				verifyFail(data['lastAction']);
			}
		}
	}

	function updateError()
	{
		clearInterval(dotsTimer);
		document.getElementById('innerSettingsText').innerHTML = "<p>An error occured while trying to download Monitor. </p>";
	}

	function verifyFail(action)
	{
		//failed? try again?
		retryCount++;
		if(retryCount >= 3)
		{
			//stop trying, give up :c
			updateError();
		}
		else
		{
			updateText("Could not verify action was executed");
			if(action == 'downloadLogHog')
			{
				downloadBranch();
			}
			else if(action == 'unzipUpdateAndReturnArray')
			{
				unzipUpdateAndReturnArray();
			}
			else if(action == 'removeDirUpdate')
			{
				removeExtractedDir();
			}
			else if(action == "removeZipFile")
			{
				removeDownloadedZip();
			}
		}
	}

	function verifySucceded(action)
	{
		//downloaded, extract
		retryCount = 0;
		updateText("Verified Action");
		if(action == 'downloadLogHog')
		{
			updateProgressBar(10);
			updateStatus("Extracting Zip Files For ", "unzipFile");
			unzipBranch();
		}
		else if(action == 'unzipUpdateAndReturnArray')
		{
			updateProgressBar(9);
			filterFilesFromArray();
		}
		else if(action == 'removeDirUpdate')
		{
			updateProgressBar(10);
			removeDownloadedZip();
		}
		else if(action == 'removeZipFile')
		{
			updateProgressBar(9);
			finishedUpdate();
		}
	}

	function preScriptRun()
	{
		updateText("Checking for pre upgrade scripts");
		if(preScriptCount != 1)
		{
			var totalCount = 0;
			var fileName = "pre-script-"+totalCount;
			while($.inArray(arrayOfFilesExtracted, fileName))
			{
				totalCount++;
			}
			updateProgressBar(((1/totalCount)*5));
		}
		var fileName = "pre-script-"+preScriptCount+".php";
		if($.inArray(arrayOfFilesExtracted, fileName) != "-1")
		{
			updateText("Running pre upgrade script "+preScriptCount);
			if(preScripRunFileName == "" || fileName == preScripRunFileName)
			{
				preScripRunFileName = fileName;
				preScriptCount++;
				ajaxForPreScriptRun(fileName);
			}
		}
		else
		{
			if(preScriptCount == 1)
			{
				updateText("No Pre Upgrade scripts.");
				updateProgressBar(5);
			}
			else
			{
				updateText("Finished running pre upgrade scripts");

				//wait for verify scripts
			}
			preScriptCount = 1;
			preScripRunFileName = "";
			//finished with pre scripts

			copyFilesFromArray();
		}
	}

	function ajaxForPreScriptRun(urlForSendMain)
	{
		var urlForSend = "../../update/downloads/updateFiles/extracted/"+urlForSendMain;
		var data = "";
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: data,
			type: 'POST',
			complete: function()
			{
				preScriptRun();
			}
		});	
	}

	function filterFilesFromArray()
	{
		filteredArray = new Array();
		for (var i = arrayOfFilesExtracted.length - 1; i >= 0; i--) 
		{
			var file = arrayOfFilesExtracted[i];
			var copyFile = true;
			if(file.startsWith("top_"))
			{
				copyFile = false;
				if(file == "top_statusTest.php" || monitorLocation == "true")
				{
					copyFile = true;
				}
			}
			else if(file.startsWith("pre-script-") || file.startsWith("post-script-"))
			{
				copyFile - false;
			}

			if(copyFile)
			{
				filteredArray.push(file);
			}
		}
		updateProgressBar(1);
		preScriptRun();
	}

	function copyFilesFromArray()
	{
		if(fileCopyCount > 0)
		{
			updateProgressBar(((1/filteredArray.length)*50));
		}
		for (var i = filteredArray.length - 1; i >= 0; i--) 
		{
			if(i == fileCopyCount)
			{
				updateText("Copying File "+(i+1)+" of "+filteredArray.length);
				fileCopyCount++;
				copyFileFromArrayAjax(filteredArray[i]);
			}
		}
		if(fileCopyCount == filteredArray.length)
		{
			//end of file copy stuff
		}
	}

	function copyFileFromArrayAjax(file)
	{
		updateText("File: "+file);
		//insert ajax call later
	}

	function postScriptRun()
	{
		updateText("Checking for post upgrade scripts");
		if(postScriptCount != 1)
		{
			var totalCount = 0;
			var fileName = "post-script-"+totalCount;
			while($.inArray(arrayOfFilesExtracted, fileName))
			{
				totalCount++;
			}
			updateProgressBar(((1/totalCount)*5));
		}
		var fileName = "post-script-"+postScriptCount+".php";
		if($.inArray(arrayOfFilesExtracted, fileName) != "-1")
		{
			updateText("Running post upgrade script "+postScriptCount);
			if(postScripRunFileName == "" || fileName == postScripRunFileName)
			{
				postScripRunFileName = fileName;
				postScriptCount++;
				ajaxForPostScriptRun(fileName);
			}
		}
		else
		{
			if(postScriptCount == 1)
			{
				updateText("No post Upgrade scripts.");
				updateProgressBar(5);
			}
			else
			{
				updateText("Finished running post upgrade scripts");
			}
			postScriptCount = 1;
			postScripRunFileName = "";
			//finished with pre scripts
			copyFilesFromArray();
		}
	}

	function ajaxForPostScriptRun(urlForSendMain)
	{
		var urlForSend = "../../update/downloads/updateFiles/extracted/"+urlForSendMain;
		var data = "";
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: data,
			type: 'POST',
			complete: function()
			{
				postScriptRun();
			}
		});	
	}

	function postScriptRedirect()
	{

	}

	function removeExtractedDir()
	{
		if(retryCount == 0)
		{
			updateText("Removing Extracted TMP Files");
		}
		else
		{
			updateText("Attempt "+(retryCount+1)+" of 3 for Removing Extracted TMP Files");
		}
		var urlForSend = urlForSendMain;
		var dataSend = {action: 'removeDirUpdate'};
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: dataSend,
			type: 'POST',
			success: function(data)
			{
				//verify if downloaded
				updateText("Verifying that TMP files were removed");
				verifyFile('removeDirUpdate', '../../update/downloads/updateFiles/extracted/', false);
			},
			failure: function(data)
			{
				retryCount++;
				removeExtractedDir();
			}
		});
	}

	function removeDownloadedZip()
	{
		if(retryCount == 0)
		{
			updateText("Removing Zip TMP File");
		}
		else
		{
			updateText("Attempt "+(retryCount+1)+" of 3 for Removing Zip TMP File");
		}
		var urlForSend = urlForSendMain;
		var dataSend = {action: 'removeZipFile', fileToUnlink: "../../update/downloads/updateFiles/updateFiles.zip"};
		$.ajax({
			url: urlForSend,
			dataType: 'json',
			data: dataSend,
			type: 'POST',
			success: function(data)
			{
				//verify if downloaded
				updateText("Verifying that TMP files were removed");
				verifyFile('removeZipFile', '../../update/downloads/updateFiles/extracted/', false);
			},
			failure: function(data)
			{
				retryCount++;
				removeExtractedDir();
			}
		});
	}

	function finishedUpdate()
	{
		//update version number

		//check if another version to update to next
	}
	
</script> 

<?php 
if($newestVersionCheck == $versionCheck)
{
	file_put_contents("../core/php/updateProgressLog.php", "<p> Loading update file list. </p>");
}
?>
</html>
