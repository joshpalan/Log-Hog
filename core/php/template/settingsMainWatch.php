<?php

$defaultTrashCanIcon = generateImage(
	$arrayOfImages["trashCanSideBar"],
	array(
		"height"		=>	"25px"
	)
);

$defaultRedErrorIcon = generateImage(
	$arrayOfImages["redWarning"],
	array(
		"width"			=>	"25px"
	)
);

$defaultYellowErrorIcon = generateImage(
	$arrayOfImages["yellowWarning"],
	array(
		"width"			=>	"25px"
	)
);

$defaultFolderIcon = generateImage(
	$arrayOfImages["folderIcon"],
	array(
		"width"			=>	"25px"
	)
);

$defaultFileIcon = generateImage(
	$arrayOfImages["fileIcon"],
	array(
		"width"			=>	"25px"
	)
);

$defaultFolderNRIcon = generateImage(
	$arrayOfImages["folderIconNR"],
	array(
		"width"			=>	"25px"
	)
);

$defaultFileNRIcon = generateImage(
	$arrayOfImages["fileIconNR"],
	array(
		"width"			=>	"25px"
	)
);

$defaultFolderNWIcon = generateImage(
	$arrayOfImages["folderIconNW"],
	array(
		"width"			=>	"25px"
	)
);

$defaultFileNWIcon = generateImage(
	$arrayOfImages["fileIconNW"],
	array(
		"width"			=>	"25px"
	)
);

?>

<form onsubmit="checkWatchList()" id="settingsMainWatch" >
	<div class="settingsHeader">
		WatchList
		<div class="settingsHeaderButtons">
			<a onclick="resetWatchListVars();" id="settingsMainWatchResetButton" style="display: none;" class="linkSmall" > Reset Current Changes</a>
			<a class="linkSmall" onclick="saveAndVerifyMain('settingsMainWatch');" >Save Changes</a>
		</div>
	</div>
	<div class="settingsDiv" >
		<span id="loadingSpan">
			<h1 id="progressBarMainInfoWatchList" style="margin-right: auto; margin-left: auto; width: 100%; text-align: center;  margin-top: 100px; font-size: 150%;" >Loading...</h1>
			<div id="divForProgressBarWatchList" style="width: 80%; height: 100px; margin-left: auto; margin-right: auto; margin-top: -15px; margin-bottom: -15px;">
				<div <?php echo $loadingBarStyle; ?> class="ldBar label-center" id="progressBarWatchList" data-value="0" style="width: 100%; height: 100%; margin: auto;"></div>
			</div>
			<h3 id="progressBarSubInfoWatchList" style="margin-right: auto; margin-left: auto; width: 100%; text-align: center;  margin-top: 10px; font-size: 150%;" >Loading Javascript</h3>
		</span>
		<ul class="settingsUl uniqueClassForAppendSettingsMainWatchNew" style=" -webkit-padding-start: 0;" >
		</ul>
	</div>
	<div id="hidden" style="display: none">
		<input id="numberOfRows" type="text" name="numberOfRows" value="0">
	</div>
</form>
<div class="settingsHeader" id="watchKey" >
	Key
</div>
<div class="settingsDiv" >
	<ul class="settingsUl">
		<li>
			<?php echo $defaultRedErrorIcon; ?>
			 - File / Folder not found! &nbsp; &nbsp; &nbsp;
			<?php echo $defaultYellowErrorIcon; ?>
			 - Unknown
		</li>
		<li>
			<?php echo $defaultFileIcon; ?>
			 - File &nbsp; &nbsp; &nbsp;
			<?php echo $defaultFileNRIcon; ?>
			 - File Not Readable &nbsp; &nbsp; &nbsp;
			<?php echo $defaultFolderNWIcon; ?>
			 - File Not Writeable
		</li>
		<li>
			<?php echo $defaultFolderIcon; ?>
			 - Folder &nbsp; &nbsp; &nbsp;
			<?php echo $defaultFolderNRIcon; ?>
			 - Folder Not Readable &nbsp; &nbsp; &nbsp;
			<?php echo $defaultFileNWIcon; ?>
			 - Folder Not Writeable &nbsp; &nbsp; &nbsp;
		</li>
		<li>
			f - file &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
			d - directory &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
			u - unknown / file not found &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
			r - readable &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
			w - writeable &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
			x - executable
		</li>
	</ul>
</div>
<div id="storage">
	<div class="saveBlock">
		<?php echo generateSaveBlock(array(), $defaultTrashCanIcon, $arrayOfImages); ?>
	</div>
</div>
<div id="fileFolderDropdown" style="width: 600px; background-color: #444; border: 1px solid white; z-index: 120; position: fixed;"  >
</div>
<script type="text/javascript">
	var defaultTrashCanIcon 				= <?php echo json_encode($defaultTrashCanIcon); ?>;
	var icons = {};
	icons["defaultRedErrorIcon"]				= <?php echo json_encode($defaultRedErrorIcon); ?>;
	icons["defaultYellowErrorIcon "]				= <?php echo json_encode($defaultYellowErrorIcon); ?>;
	icons["defaultFolderIcon"] 					= <?php echo json_encode($defaultFolderIcon); ?>;
	icons["defaultFileIcon"] 					= <?php echo json_encode($defaultFileIcon); ?>;
	icons["defaultFolderNRIcon"] 				= <?php echo json_encode($defaultFolderNRIcon); ?>;
	icons["defaultFileNRIcon"] 					= <?php echo json_encode($defaultFileNRIcon); ?>;
	icons["defaultFolderNWIcon"] 				= <?php echo json_encode($defaultFolderNWIcon); ?>;
	icons["defaultFileNWIcon"] 					= <?php echo json_encode($defaultFileNWIcon); ?>;
	var defaultdefaultNewAddAlertEnabled 	= "<?php echo $defaultNewAddAlertEnabled; ?>";
	var defaultNewAddAutoDeleteFiles 		= "<?php echo $defaultNewAddAutoDeleteFiles; ?>";
	var defaultNewAddExcludeTrim 			= "<?php echo $defaultNewAddExcludeTrim; ?>";
	var defaultNewAddPattern 				= "<?php echo $defaultNewAddPattern;?>";
	var defaultNewAddRecursive 				= "<?php echo $defaultNewAddRecursive;?>";
	var defaultNewPathFile 					= "<?php echo $defaultNewPathFile; ?>";
	var defaultNewPathFolder				= "<?php echo $defaultNewPathFolder;?>";
	var defaultNewPathOther 				= "<?php echo $defaultNewPathOther;?>";
	var sortTypeFileFolderPopup				= "<?php echo $sortTypeFileFolderPopup; ?>";
</script>