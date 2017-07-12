<?php

$defaultConfig = array(
	'sliceSize'		=> 500,
	'pollingRate'	=> 500,
	'buffer'		=> 500,
	'pausePoll'		=> 'false',
	'pauseOnNotFocus' => 'true',
	'autoCheckUpdate' => 'true',
	'autoCheckDaysUpdate'	=>	'7',
	'developmentTabEnabled' => 'false',
	'enableDevBranchDownload' => 'false',
	'enableSystemPrefShellOrPhp'	=> 'false',
	'rightClickMenuEnable'	=> 'true',
	'enableHtopLink'	=> 'false',
	'expSettingsAvail'	=> 'true',
	'truncateLog'	=> 'true',
	'popupWarnings'	=>	'all',
	'flashTitleUpdateLog'	=> 'false',
	'pollingRateType'	=> 'Milliseconds',
	'logTrimOn'	=> 'true',
	'logSizeLimit'	=>	2000,
	'logTrimMacBSD'	=> 'false',
	'baseUrlUpdate'	=> 'https://github.com/mreishman/Log-Hog/archive/',
	'logTrimType'	=>	'lines',
	'TrimSize'	=> 'K',
	'hideEmptyLog'	=> 'false',
	'groupByType'	=> 'folder',
	'currentFolderColorTheme'	=> 'theme-default-3',
	'groupByColorEnabled'	=> 'true',
	'enableLogging'	=> 'false',
	'dontNotifyVersion'	=> '0',
	'updateNoticeMeter'	=> 'every',
	'enablePollTimeLogging'	=> 'false',
	'popupSettingsArray'	=> array(
		'saveSettings'	=>	'true',
		'blankFolder'	=>	'true',
		'deleteLog'	=>	'true',
		'removeFolder'	=> 	'true',
		'versionCheck'	=> 'true'
		),
	'folderColorArrays'	=> array(
		'theme-default-1'	=> array('#2A912A',"#32CD32","#9ACD32","#556B2F","#6B8E23"),
		'theme-default-2'	=> array('#6B8E23',"#556B2F","#2E8B57","#3CB371","#8FBC8F"),
		'theme-default-3'	=> array('#228B22',"#008000","#006400"),
		'theme-default-4'	=> array('#2E8B57',"#20B2AA","#3CB371","#8FBC8F"),
		'theme-default-5'	=> array('#9ACD32',"#32CD32","#2A912A","#2E8B57","#9ACD32"),
		),
	'watchList'		=> array(
		'/var/www/html/var/log/system.log'	        => '',
		'/var/log/hhvm/error.log'	=> '',
		'/var/log/apache2'			=> '.log$'
	)
);