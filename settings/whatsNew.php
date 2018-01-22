<?php
require_once('../core/php/commonFunctions.php');
setCookieRedirect();
$currentSelectedTheme = returnCurrentSelectedTheme();
$baseUrl = "../local/".$currentSelectedTheme."/";
$localURL = $baseUrl;
require_once($baseUrl.'conf/config.php');
require_once('../core/conf/config.php');
require_once('../core/php/configStatic.php');
require_once('../core/php/updateCheck.php');
require_once('../core/php/loadVars.php');
?>
<!doctype html>
<head>
	<title>Settings | Main</title>
	<?php echo loadCSS($baseUrl, $cssVersion);?>
	<link href="../core/template/lightbox.css" rel="stylesheet" type="text/css" />
	<link rel="icon" type="image/png" href="../core/img/favicon.png" />
	<script src="../core/js/jquery.js"></script>
	<script src="../core/js/lightbox-2.6.min.js"></script>
</head>
<body>

<?php require_once('header2.php');?>	

	<div id="main" > 
		<h1 style="width: 100%; text-align: center;  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; " >You are on version <?php echo $configStatic['version'];?>!</h1>
		<div class="settingsDiv" >
			<table width="100%;">
				<tr>
					<td width="25%" >
					</td>
					<td width="75%">
					</td>
				</tr>

				<tr>
				<td>
				</td>
				<td>
				</td>
				</tr>



				<tr>
				<th colspan="2" style="padding: 10px">
					<h1>3.4</h1>
				</th>
				</tr>


				<tr>
				<td>
					<ul>
						<li>
							Content filter for logs! (search and highlight content of logs)
						</li>
						<li>
							Save custom themes!
						</li>
					</ul>
				</td>
				<td>
					<a href="../core/img/3.4-1.png" data-lightbox="3.4" ><img src="../core/img/3.4-1.png" style="width: 45%;"></a>
					<a href="../core/img/3.4-2.png" data-lightbox="3.4" ><img src="../core/img/3.4-2.png" style="width: 45%;"></a>
				</td>
				</tr>



				<tr>
				<th colspan="2" style="border-top: 1px solid white; padding: 10px">
					<h1>3.3</h1>
				</th>
				</tr>




				<tr>
				<td>
					<ul>
						<li>
							New ocean theme!
						</li>
						<li>
							Notification count
						</li>
						<li>
							Clear all notifications button
						</li>
						<li>
							Last line shown on name hover
						</li>
					</ul>
				</td>
				<td>
					<a href="../core/img/3.3-1.png" data-lightbox="3.3" ><img src="../core/img/3.3-1.png" style="width: 45%;"></a>
					<a href="../core/img/3.3-3.png" data-lightbox="3.3" ><img src="../core/img/3.3-3.png" style="width: 45%;"></a>
					<br>
					<a href="../core/img/3.3-4.png" data-lightbox="3.3" ><img src="../core/img/3.3-4.png" style="width: 45%;"></a>
				</td>
				</tr>



				<tr>
				<th colspan="2" style="border-top: 1px solid white; padding: 10px">
					<h1>3.2</h1>
				</th>
				</tr>


				<tr>
				<td>
					<b>SeleniumMonitor</b>
					<ul>
						<li>
						Monitor your selenium grid, and run new tests from a web interface
						</li>
					</ul>
					<br>
					<b>Title Filter</b>
					<ul>
						<li>
							Filter logs by title / path.
						</li>
					</ul>
					<br>
					<b>Config file versions</b>
					<ul>
						<li>
							Restore versions of config.
						</li>
					</ul>
				</td>
				<td>
					<a href="../core/img/3.2-1.png" data-lightbox="3.2" ><img src="../core/img/3.2-1.png" style="width: 45%;"></a>
					<a href="../core/img/3.2-2.png" data-lightbox="3.2" ><img src="../core/img/3.2-2.png" style="width: 45%;"></a>
					<br>
					<a href="../core/img/3.2-3.png" data-lightbox="3.2" ><img src="../core/img/3.2-3.png" style="width: 45%;"></a>
					<a href="../core/img/3.2-4.png" data-lightbox="3.2" ><img src="../core/img/3.2-4.png" style="width: 45%;"></a>
				</td>
				</tr>



				<tr>
				<th colspan="2" style="border-top: 1px solid white; padding: 10px">
					<h1>3.1</h1>
				</th>
				</tr>


				<tr>
				<td>
					<b>Search!</b>
					<ul>
						<li>
						Run visual grep's from the new search addon
						</li>
					</ul>
				</td>
				<td>
					<a href="../core/img/3.1-1.png" data-lightbox="3.1" ><img src="../core/img/3.1-1.png" style="width: 45%;"></a>
					<a href="../core/img/3.1-2.png" data-lightbox="3.1" ><img src="../core/img/3.1-2.png" style="width: 45%;"></a>
				</td>
				</tr>


				<tr>
				<th colspan="2" style="border-top: 1px solid white; padding: 10px">
					<h1>3.0</h1>
				</th>
				</tr>

				<!-- 3.0 -->


				<tr>
				<td>
					<b>Themes!</b>
					<ul>
						<li>
						Change how Log-Hog looks by going to settings, then themes
						</li>
						<li>
						3 new main themes
						</li>
						<li>
						New customizability of the current and new themes. 
						</li>
					</ul>
				</td>
				<td>
					<a href="../core/img/3.0-1.png" data-lightbox="3.0" ><img src="../core/img/3.0-1.png" style="width: 45%;"></a>
					<a href="../core/img/3.0-2.png" data-lightbox="3.0" ><img src="../core/img/3.0-2.png" style="width: 45%;"></a>
					<br>
					<a href="../core/img/3.0-3.png" data-lightbox="3.0" ><img src="../core/img/3.0-3.png" style="width: 45%;"></a>
					<a href="../core/img/3.0-4.png" data-lightbox="3.0" ><img src="../core/img/3.0-4.png" style="width: 45%;"></a>
				</td>
				</tr>


				<tr>
				<th colspan="2" style="border-top: 1px solid white; padding: 10px">
					<h1>2.3</h1>
				</th>
				</tr>
				<!-- 2.3 -->

				<tr>
				<td>
					<b>Monitor</b>
					<ul>
						<li>
						CPU usage
						</li>
						<li>
						Ram / swap usage
						</li>
						<li>
						Disk usage / IO
						</li>
						<li>
						PHP User time used / system time used
						</li>
						<li>
						Network Interface receive / transmit
						</li>
						<li>
						Shows list of processes
						</li>
					</ul>
				</td>
				<td>
					<a href="../core/img/2.3-1.png" data-lightbox="2.3" ><img src="../core/img/2.3-1.png" style="width: 45%;"></a>
					<a href="../core/img/2.3-2.png" data-lightbox="2.3" ><img src="../core/img/2.3-2.png" style="width: 45%;"></a>
				</td>
				</tr>


				<!-- 2.2 -->




				<!-- 2.1 -->



				<!-- 2.0 -->

			</table>
	
		</div>
	</div>
</body>