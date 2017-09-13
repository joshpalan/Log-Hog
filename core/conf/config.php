<?php

$defaultConfig = array(
	'configVersion'	=> 1,
	'layoutVersion'	=> 1,
	'cssVersion'	=> 1,
	'themeVersion'	=> 1,
	'sendCrashInfoJS'	=> 'true',
	'sendCrashInfoPHP'	=> 'true',
	'themesEnabled'		=> 'true',
	'currentTheme'		=> 'Default',
	'sliceSize'		=> 500,
	'pollingRate'	=> 500,
	'buffer'		=> 500,
	'pollRefreshAll'	=> 120,
	'pollRefreshAllBool'	=> 'true',
	'pollForceTrue'		=> 60,
	'pollForceTrueBool'	=> 'true',
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
	'locationForStatus'	=> '',
	'locationForMonitor'	=> '',
	'bottomBarIndexShow'	=> 'true',
	'enablePollTimeLogging'	=> 'false',
	'popupSettingsArray'	=> array(
		'saveSettings'	=>	'true',
		'blankFolder'	=>	'true',
		'deleteLog'	=>	'true',
		'removeFolder'	=> 	'true',
		'versionCheck'	=> 'true'
		),
	'folderColorArrays'	=> array(
		'theme-default-1'	=> array( 
			'main' 		=> array('#2A912A',"#32CD32","#9ACD32","#556B2F","#6B8E23"),
			'highlight' => array('#FFFFFF'),
			'active'	=> array('#912A2C'),
			'highlightActive'	=> array('#FFDDFF')
			),
		'theme-default-2'	=> array(
			'main' 		=> array('#6B8E23',"#556B2F","#2E8B57","#3CB371","#8FBC8F"),
			'highlight' => array('#FFFFFF'),
			'active'	=> array('#912A2C'),
			'highlightActive'	=> array('#FFDDFF')
			),
		'theme-default-3'	=> array(
			'main' 		=> array('#228B22',"#008000","#006400"),
			'highlight' => array('#FFFFFF'),
			'active'	=> array('#912A2C'),
			'highlightActive'	=> array('#FFDDFF')
			),
		'theme-default-4'	=> array(
			'main' 		=> array('#2E8B57',"#20B2AA","#3CB371","#8FBC8F"),
			'highlight' => array('#FFFFFF'),
			'active'	=> array('#912A2C'),
			'highlightActive'	=> array('#FFDDFF')
			),
		'theme-default-5'	=> array(
			'main' 		=> array('#9ACD32',"#32CD32","#2A912A","#2E8B57","#9ACD32"),
			'highlight' => array('#FFFFFF'),
			'active'	=> array('#912A2C'),
			'highlightActive'	=> array('#FFDDFF')
			),
		),
	'backgroundColor'	=> "#292929",
	'mainFontColor'		=> '#FFFFFF',
	'backgroundHeaderColor'	=> "#222222",
	'watchList'		=> array(
		'/var/www/html/var/log/system.log'	        => '',
		'/var/log/hhvm/error.log'	=> '',
		'/var/log/apache2'			=> '.log$'
	)
);