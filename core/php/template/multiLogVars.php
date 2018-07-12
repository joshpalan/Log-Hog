<form id="settingsMultiLogVars">
	<div class="settingsHeader">
	Multi-Log Settings
		<div class="settingsHeaderButtons">
			<?php echo addResetButton("settingsMultiLogVars"); ?>
			<a class="linkSmall" onclick="saveAndVerifyMain('settingsMultiLogVars');" >Save Changes</a>
		</div>
	</div>
	<div class="settingsDiv" >
		<ul class="settingsUl">
			<li>
				<span class="settingsBuffer"> Log Layout</span>
				<?php $arrayOfwindowConfigOptions = array();
				for ($i=0; $i < 3; $i++)
				{
					for ($j=0; $j < 3; $j++)
					{
						array_push($arrayOfwindowConfigOptions, "".($i+1)."x".($j+1));
					}
				}
				?>
				<div class="selectDiv">
					<select name="windowConfig">
						<?php foreach ($arrayOfwindowConfigOptions as $value)
						{
							$stringToEcho = "<option ";
							if($value === $windowConfig)
							{
								$stringToEcho .= " selected ";
							}
							$stringToEcho .= " value=\"".$value."\"> ".$value."</option>";
							echo $stringToEcho;
						}
						?>
					</select>
				</div>
			</li>
			<li>
				<span class="settingsBuffer"> Enable tmp Multilog (button in menu): </span>
				<div class="selectDiv">
					<select name="multiLogOnIndex">
						<option <?php if($multiLogOnIndex === 'true'){echo "selected";} ?> value="true">True</option>
						<option <?php if($multiLogOnIndex === 'false'){echo "selected";} ?> value="false">False</option>
					</select>
				</div>
			</li>
		</ul>
	</div>
</form>