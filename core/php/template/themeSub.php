<?php
foreach ($scanned_directory as $key):
		if($key != ".DS_Store"):
			require_once("../core/Themes/".$key."/defaultSetting.php");?>
			<div style="width: 600px; height: 400px; display: inline-block; background-color: grey; border: 1px solid white; margin: 20px;">
				<div class="settingsHeader" style="margin: 0px;">
					<?php echo $key;?>
					<div class="settingsHeaderButtons">
						<?php if($key !== $currentTheme): ?>
							<a class="linkSmall" onclick="saveAndVerifyMain('themeMainSelection-<?php echo $key;?>');" >Select</a>
						<?php else: ?>
							<a class="linkSmall" onclick="saveAndVerifyMain('themeMainSelection-<?php echo $key;?>');" >Reset / Update</a>
							<a class="linkSmallHover"> Selected </a>
						<?php endif;?>
					</div>
				</div>
				<span id="loadingSpinner-<?php echo $key;?>">
					<img src="<?php echo $baseUrl;?>/img/loading.gif" style="position: relative; height: 60px; top: 170px; left: 270px;" >
				</span>
				<span id="htmlContent-<?php echo $key;?>" style="display: none;">
					<?php echo generateExampleIndex($key);?>
				</span>
				<span style="display: none;">
					<script type="text/javascript">
						$( document ).ready(function()
						{
						   document.getElementById("loadingSpinner-<?php echo $key;?>").style.display = "none";
						   document.getElementById("htmlContent-<?php echo $key;?>").style.display = "block";
						});
					</script>
					<form action="../core/php/settingsSave.php" method="post" id="themeMainSelection-<?php echo $key;?>">
						<input type="hidden" name="loadingBarVersion" value="<?php echo $loadingBarVersionDefault;?>">
						<input type="hidden" name="currentTheme" value="<?php echo $key?>">
						<input type="hidden" name="backgroundColor" value="<?php echo $backgroundColorDefault;?>" >
						<input type="hidden" name="mainFontColor" value="<?php echo $mainFontColorDefault;?>" >
						<input type="hidden" name="backgroundHeaderColor" value="<?php echo $backgroundHeaderColorDefault;?>" >
						<input type="hidden" name="logFontColor" value="<?php echo $logFontColorDefault;?>">
						<?php
							$tmpcurrentFolderColorTheme = $currentFolderColorTheme;
							$currentFolderColorTheme = $currentFolderColorThemeDefault;
							$tmpfolderColorArrays = $folderColorArrays;
							$folderColorArrays = $folderColorArraysDefault;
							include('innerFolderGroupColor.php');
							$folderColorArrays = $tmpfolderColorArrays;
							$currentFolderColorTheme = $tmpcurrentFolderColorTheme;
						?>
					</form>
				</span>
			</div>
		<?php endif;
	endforeach;