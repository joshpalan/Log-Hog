<?php
$baseURLToMain =  baseURL();

$baseUrl = $baseURLToMain."core/";
if(file_exists('local/layout.php'))
{
	$baseUrl = $baseURLToMain."local/";
	//there is custom information, use this
	require_once($baseURLToMain.'local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}
require_once($baseUrl.'conf/config.php');
require_once($baseURLToMain.'core/conf/config.php');
require_once($baseURLToMain.'core/php/configStatic.php');
require_once($baseURLToMain.'core/php/loadVars.php');

$windowDisplayConfig = explode("x", $windowConfig);

?>
<style type="text/css">

.log, #firstLoad
{
	color: <?php echo $logFontColor; ?>;
}

.highlight
{
	background-color: <?php echo $highlightColorBG; ?>;
	color: <?php echo $highlightColorFont; ?>;
}

.newLine
{
	background-color: <?php echo $highlightNewColorBG; ?>;
	color: <?php echo $highlightNewColorFont; ?>;
}

<?php if($logMenuLocation === "top"):

/* nothing changes */

elseif($logMenuLocation === "bottom"): ?>

#menu
{
	bottom: 0;
}

<?php elseif($logMenuLocation === "left"): ?>

#menu
{
	bottom: 0;
	width: 200px;
	max-height: none;
}

#main
{
	padding-left: 200px;
}

#menu a
{
	display: block;
}

<?php elseif($logMenuLocation === "right"): ?>

#menu
{
	bottom: 0;
	right: 0;
	width: 200px;
	max-height: none;
}

#main
{
	padding-right: 200px;
}

#menu a
{
	display: block;
}

<?php endif; ?>

</style>
