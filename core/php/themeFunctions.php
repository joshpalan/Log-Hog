<?php

function generateExampleIndex($type, $top)
{
	//header
	$html = "<div id=\"menu\" style=\"position: relative; \">
		<div class=\"menuImageDiv\">
			<img id=\"pauseImage\" class=\"menuImage\" src=\"../core/Themes/".$type."/img/Pause.png\" height=\"30px\">
		</div>
		<div class=\"menuImageDiv\">
			<img id=\"refreshImage\" class=\"menuImage\" src=\"../core/Themes/".$type."/img/Refresh.png\" height=\"30px\">
		</div>
		<div  class=\"menuImageDiv\">
			<img id=\"deleteImage\" class=\"menuImage\" src=\"../core/Themes/".$type."/img/trashCanMulti.png\" height=\"30px\">
		</div>";
	if($top)
	{
		$html .= "<div class=\"menuImageDiv\">
				<img id=\"taskmanagerImage\" class=\"menuImage\" src=\"../core/Themes/".$type."/img/task-manager.png\" height=\"30px\">
			</div>";
	}
	$html .= "<div class=\"menuImageDiv\">
			<img data-id=\"1\" id=\"gear\" class=\"menuImage\" src=\"../core/Themes/".$type."/img/Gear.png\" height=\"30px\">
			 		</div>
					<div class=\"menuImage\" style=\"display: inline-block; cursor: pointer; \" \">gS</div>
			
			<a style=\"background-color: #2E8B57\" class=\"varwwwhtmlvarlogauthnetcimlogButton active\" >server_hhvm.log</a>
		
			<a style=\"background-color: #2E8B57\" class=\"varwwwhtmlvarlogauthnetcimachlogButton\" \">server_system.log</a>
		
			<a style=\"background-color: #20B2AA\" class=\"varlogapache2errorlogButton\" \">error.log</a>
		
			<a style=\"background-color: #3CB371\" class=\"varlogalternativeslogButton\"\">alternatives.log</a>
		</div>";


	//LOG
	$html .= "<div id=\"main\" style=\"height: 251px; position: inherit; background-color: #292929;\">
		<div id=\"log\"><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000028] [] BootStats: servers started done, took 2ms wall, 4ms cpu, 1 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000029] [] all servers started</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000030] [] BootStats: all done, took 188ms wall, 188ms cpu, 137 MB RSS total</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000031] [] BootStats: ExecutionContext = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000032] [] BootStats: ExtensionRegistry::moduleInit = 118ms wall, 120ms cpu, 7 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000033] [] BootStats: PageletServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000034] [] BootStats: Process::InitProcessStatics = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000035] [] BootStats: Stream::RegisterCoreWrappers = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000036] [] BootStats: TOTAL = 188ms wall, 188ms cpu, 137 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000037] [] BootStats: XboxServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000038] [] BootStats: apc_load = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000039] [] BootStats: enable_numa = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000040] [] BootStats: extra_process_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000041] [] BootStats: extra_process_init_concurrent_wait = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000042] [] BootStats: g_vmProcessInit = 36ms wall, 36ms cpu, 5 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000043] [] BootStats: loading static content = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000044] [] BootStats: mapping self = 23ms wall, 24ms cpu, 121 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000045] [] BootStats: onig_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000046] [] BootStats: pagein_self = 23ms wall, 24ms cpu, 121 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000047] [] BootStats: pcre_reinit = 2ms wall, 4ms cpu, -1 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000048] [] BootStats: pthread_init = 4ms wall, 0ms cpu, 3 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000049] [] BootStats: rds::requestExit = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000050] [] BootStats: servers started = 2ms wall, 4ms cpu, 1 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000051] [] BootStats: timezone_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000052] [] BootStats: warmup = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000053] [] BootStats: xenon = 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Mon Sep  4 16:05:04 2017] [hphp] [1035:7f37b432b180:0:000054] [] BootStats: xmlInitParser = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:06:06 2017] [hphp] [1035:7f37913ff700:2:000001] [] Finished singleJitRequest 1</div><div>[Mon Sep  4 16:06:07 2017] [hphp] [1035:7f379a7ff700:7:000001] [] Finished singleJitRequest 2</div><div>[Mon Sep  4 16:06:09 2017] [hphp] [1035:7f37883ff700:2:000001] [] Finished singleJitRequest 3</div><div>[Mon Sep  4 16:06:09 2017] [hphp] [1035:7f378cbff700:2:000001] [] Finished singleJitRequest 4</div><div>[Mon Sep  4 16:06:32 2017] [hphp] [1035:7f377f3ff700:2:000001] [] Finished singleJitRequest 5</div><div>[Mon Sep  4 16:06:32 2017] [hphp] [1035:7f3783bff700:2:000001] [] Finished singleJitRequest 6</div><div>[Mon Sep  4 16:06:32 2017] [hphp] [1035:7f37913ff700:3:000001] [] Finished singleJitRequest 7</div><div>[Mon Sep  4 16:06:37 2017] [hphp] [1035:7f379a7ff700:8:000001] [] Finished singleJitRequest 8</div><div>[Mon Sep  4 16:06:45 2017] [hphp] [1035:7f378cbff700:4:000001] [] Finished singleJitRequest 9</div><div>[Mon Sep  4 16:06:56 2017] [hphp] [1035:7f377f3ff700:3:000001] [] Finished singleJitRequest 10</div><div>[Mon Sep  4 16:06:56 2017] [hphp] [1035:7f37717ff700:2:000001] [] Finished singleJitRequest 11</div><div>[Mon Sep  4 16:06:56 2017] [hphp] [1035:7f3783bff700:3:000001] [] Finished singleJitRequest 12</div><div>[Mon Sep  4 16:07:04 2017] [hphp] [1035:7f37883ff700:4:000001] [] Finished singleJitRequest 13</div><div>[Mon Sep  4 16:07:05 2017] [hphp] [1035:7f379a7ff700:9:000001] [] Finished singleJitRequest 14</div><div>[Mon Sep  4 16:07:06 2017] [hphp] [1035:7f378cbff700:5:000001] [] Finished singleJitRequest 15</div><div>[Mon Sep  4 16:07:06 2017] [hphp] [1035:7f37913ff700:5:000001] [] Finished singleJitRequest 16</div><div>[Mon Sep  4 16:07:09 2017] [hphp] [1035:7f3783bff700:4:000001] [] Finished singleJitRequest 17</div><div>[Mon Sep  4 16:07:09 2017] [hphp] [1035:7f377f3ff700:4:000001] [] Finished singleJitRequest 18</div><div>[Mon Sep  4 16:07:17 2017] [hphp] [1035:7f37717ff700:3:000001] [] Finished singleJitRequest 19</div><div>[Mon Sep  4 16:07:19 2017] [hphp] [1035:7f37883ff700:5:000001] [] Finished singleJitRequest 20</div><div>[Mon Sep  4 16:07:20 2017] [hphp] [1035:7f379a7ff700:10:000001] [] Finished singleJitRequest 21</div><div>[Mon Sep  4 16:07:20 2017] [hphp] [1035:7f378cbff700:6:000001] [] Finished singleJitRequest 22</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000001] [] BootStats: mapping self...</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000002] [] BootStats: mapping self block done, took 59ms wall, 60ms cpu, 121 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000003] [] BootStats: pagein_self done, took 59ms wall, 60ms cpu, 121 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000004] [] BootStats: loading static content...</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000005] [] BootStats: loading static content block done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000006] [] BootStats: pthread_init done, took 4ms wall, 0ms cpu, 3 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000007] [] BootStats: Process::InitProcessStatics done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000008] [] BootStats: timezone_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000009] [] BootStats: xenon done, took 0ms wall, 4ms cpu, 1 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000010] [] BootStats: pcre_reinit done, took 2ms wall, 0ms cpu, -1 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000011] [] BootStats: onig_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000012] [] BootStats: xmlInitParser done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000013] [] BootStats: g_vmProcessInit done, took 37ms wall, 40ms cpu, 5 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000014] [] BootStats: PageletServer::Restart done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000015] [] BootStats: XboxServer::Restart done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000016] [] BootStats: Stream::RegisterCoreWrappers done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000017] [] BootStats: ExtensionRegistry::moduleInit done, took 113ms wall, 112ms cpu, 8 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000018] [] BootStats: extra_process_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000019] [] BootStats: apc_load done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000020] [] BootStats: rds::requestExit done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000021] [] BootStats: ExecutionContext done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000022] [] BootStats: extra_process_init_concurrent_wait done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000023] [] Warming up</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000024] [] BootStats: warmup done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000025] [] BootStats: enable_numa done, took 0ms wall, 0ms cpu, -1 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000026] [] page server started</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000027] [] admin server started</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000028] [] BootStats: servers started done, took 2ms wall, 4ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000029] [] all servers started</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000030] [] BootStats: all done, took 222ms wall, 220ms cpu, 137 MB RSS total</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000031] [] BootStats: ExecutionContext = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000032] [] BootStats: ExtensionRegistry::moduleInit = 113ms wall, 112ms cpu, 8 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000033] [] BootStats: PageletServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000034] [] BootStats: Process::InitProcessStatics = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000035] [] BootStats: Stream::RegisterCoreWrappers = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000036] [] BootStats: TOTAL = 222ms wall, 220ms cpu, 137 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000037] [] BootStats: XboxServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000038] [] BootStats: apc_load = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000039] [] BootStats: enable_numa = 0ms wall, 0ms cpu, -1 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000040] [] BootStats: extra_process_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000041] [] BootStats: extra_process_init_concurrent_wait = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000042] [] BootStats: g_vmProcessInit = 37ms wall, 40ms cpu, 5 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000043] [] BootStats: loading static content = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000044] [] BootStats: mapping self = 59ms wall, 60ms cpu, 121 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000045] [] BootStats: onig_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000046] [] BootStats: pagein_self = 59ms wall, 60ms cpu, 121 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000047] [] BootStats: pcre_reinit = 2ms wall, 0ms cpu, -1 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000048] [] BootStats: pthread_init = 4ms wall, 0ms cpu, 3 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000049] [] BootStats: rds::requestExit = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000050] [] BootStats: servers started = 2ms wall, 4ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000051] [] BootStats: timezone_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000052] [] BootStats: warmup = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000053] [] BootStats: xenon = 0ms wall, 4ms cpu, 1 MB RSS</div><div>[Mon Sep  4 16:33:43 2017] [hphp] [1591:7fa2ba9e6180:0:000054] [] BootStats: xmlInitParser = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Mon Sep  4 16:36:10 2017] [hphp] [1591:7fa2a0fff700:6:000001] [] Finished singleJitRequest 1</div><div>[Mon Sep  4 16:37:06 2017] [hphp] [1591:7fa2a07ff700:7:000001] [] Finished singleJitRequest 2</div><div>[Mon Sep  4 16:37:06 2017] [hphp] [1591:7fa2a0fff700:7:000001] [] Finished singleJitRequest 3</div><div>[Mon Sep  4 16:37:09 2017] [hphp] [1591:7fa2a07ff700:8:000001] [] Finished singleJitRequest 4</div><div>[Mon Sep  4 16:37:09 2017] [hphp] [1591:7fa2a0fff700:8:000001] [] Finished singleJitRequest 5</div><div>[Mon Sep  4 16:38:06 2017] [hphp] [1591:7fa2a07ff700:9:000001] [] Finished singleJitRequest 6</div><div>[Mon Sep  4 16:38:06 2017] [hphp] [1591:7fa2a0fff700:9:000001] [] Finished singleJitRequest 7</div><div>[Mon Sep  4 16:38:09 2017] [hphp] [1591:7fa2a07ff700:10:000001] [] Finished singleJitRequest 8</div><div>[Mon Sep  4 16:38:09 2017] [hphp] [1591:7fa2a0fff700:10:000001] [] Finished singleJitRequest 9</div><div>[Mon Sep  4 16:39:06 2017] [hphp] [1591:7fa2a07ff700:11:000001] [] Finished singleJitRequest 10</div><div>[Mon Sep  4 16:39:06 2017] [hphp] [1591:7fa2a0fff700:11:000001] [] Finished singleJitRequest 11</div><div>[Mon Sep  4 16:39:09 2017] [hphp] [1591:7fa2a07ff700:12:000001] [] Finished singleJitRequest 12</div><div>[Mon Sep  4 16:39:09 2017] [hphp] [1591:7fa2a0fff700:12:000001] [] Finished singleJitRequest 13</div><div>[Mon Sep  4 16:40:06 2017] [hphp] [1591:7fa2a07ff700:13:000001] [] Finished singleJitRequest 14</div><div>[Mon Sep  4 16:40:06 2017] [hphp] [1591:7fa2a0fff700:13:000001] [] Finished singleJitRequest 15</div><div>[Mon Sep  4 16:40:09 2017] [hphp] [1591:7fa2a07ff700:14:000001] [] Finished singleJitRequest 16</div><div>[Mon Sep  4 16:40:09 2017] [hphp] [1591:7fa2a0fff700:14:000001] [] Finished singleJitRequest 17</div><div>[Mon Sep  4 16:41:06 2017] [hphp] [1591:7fa2a07ff700:15:000001] [] Finished singleJitRequest 18</div><div>[Mon Sep  4 16:41:06 2017] [hphp] [1591:7fa2a0fff700:15:000001] [] Finished singleJitRequest 19</div><div>[Mon Sep  4 16:41:09 2017] [hphp] [1591:7fa2a07ff700:16:000001] [] Finished singleJitRequest 20</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [1591:7fa2a1fff700:0:000001] [] Page server stopped</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [1591:7fa2a1fff700:0:000002] [] Page server stopped</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [1591:7fa2a1fff700:0:000003] [] Page server stopped</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000001] [] BootStats: mapping self...</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000002] [] BootStats: mapping self block done, took 23ms wall, 20ms cpu, 121 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000003] [] BootStats: pagein_self done, took 23ms wall, 20ms cpu, 121 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000004] [] BootStats: loading static content...</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000005] [] BootStats: loading static content block done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000006] [] BootStats: pthread_init done, took 2ms wall, 4ms cpu, 3 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000007] [] BootStats: Process::InitProcessStatics done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000008] [] BootStats: timezone_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000009] [] BootStats: xenon done, took 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000010] [] BootStats: pcre_reinit done, took 2ms wall, 4ms cpu, -1 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000011] [] BootStats: onig_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:12 2017] [hphp] [21920:7fad049da180:0:000012] [] BootStats: xmlInitParser done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000013] [] BootStats: g_vmProcessInit done, took 33ms wall, 32ms cpu, 5 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000014] [] BootStats: PageletServer::Restart done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000015] [] BootStats: XboxServer::Restart done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000016] [] BootStats: Stream::RegisterCoreWrappers done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000017] [] BootStats: ExtensionRegistry::moduleInit done, took 111ms wall, 112ms cpu, 7 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000018] [] BootStats: extra_process_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000019] [] BootStats: apc_load done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000020] [] BootStats: rds::requestExit done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000021] [] BootStats: ExecutionContext done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000022] [] BootStats: extra_process_init_concurrent_wait done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000023] [] Warming up</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000024] [] BootStats: warmup done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000025] [] BootStats: enable_numa done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000026] [] page server started</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000027] [] admin server started</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000028] [] BootStats: servers started done, took 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000029] [] all servers started</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000030] [] BootStats: all done, took 175ms wall, 172ms cpu, 137 MB RSS total</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000031] [] BootStats: ExecutionContext = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000032] [] BootStats: ExtensionRegistry::moduleInit = 111ms wall, 112ms cpu, 7 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000033] [] BootStats: PageletServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000034] [] BootStats: Process::InitProcessStatics = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000035] [] BootStats: Stream::RegisterCoreWrappers = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000036] [] BootStats: TOTAL = 175ms wall, 172ms cpu, 137 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000037] [] BootStats: XboxServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000038] [] BootStats: apc_load = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000039] [] BootStats: enable_numa = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000040] [] BootStats: extra_process_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000041] [] BootStats: extra_process_init_concurrent_wait = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000042] [] BootStats: g_vmProcessInit = 33ms wall, 32ms cpu, 5 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000043] [] BootStats: loading static content = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000044] [] BootStats: mapping self = 23ms wall, 20ms cpu, 121 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000045] [] BootStats: onig_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000046] [] BootStats: pagein_self = 23ms wall, 20ms cpu, 121 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000047] [] BootStats: pcre_reinit = 2ms wall, 4ms cpu, -1 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000048] [] BootStats: pthread_init = 2ms wall, 4ms cpu, 3 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000049] [] BootStats: rds::requestExit = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000050] [] BootStats: servers started = 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000051] [] BootStats: timezone_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000052] [] BootStats: warmup = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000053] [] BootStats: xenon = 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Tue Sep  5 09:09:13 2017] [hphp] [21920:7fad049da180:0:000054] [] BootStats: xmlInitParser = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 09:11:10 2017] [hphp] [21920:7face0bff700:5:000001] [] Finished singleJitRequest 1</div><div>[Tue Sep  5 09:11:11 2017] [hphp] [21920:7faceafff700:4:000001] [] Finished singleJitRequest 2</div><div>[Tue Sep  5 09:11:36 2017] [hphp] [21920:7face0bff700:6:000001] [] Finished singleJitRequest 3</div><div>[Tue Sep  5 09:11:36 2017] [hphp] [21920:7faceafff700:5:000001] [] Finished singleJitRequest 4</div><div>[Tue Sep  5 09:11:36 2017] [hphp] [21920:7face03ff700:5:000001] [] Finished singleJitRequest 5</div><div>[Tue Sep  5 09:11:48 2017] [hphp] [21920:7face0bff700:7:000001] [] Finished singleJitRequest 6</div><div>[Tue Sep  5 09:11:48 2017] [hphp] [21920:7faceafff700:6:000001] [] Finished singleJitRequest 7</div><div>[Tue Sep  5 09:11:52 2017] [hphp] [21920:7face03ff700:6:000001] [] Finished singleJitRequest 8</div><div>[Tue Sep  5 09:11:52 2017] [hphp] [21920:7face0bff700:8:000001] [] Finished singleJitRequest 9</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000001] [] BootStats: mapping self...</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000002] [] BootStats: mapping self block done, took 25ms wall, 24ms cpu, 121 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000003] [] BootStats: pagein_self done, took 25ms wall, 24ms cpu, 121 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000004] [] BootStats: loading static content...</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000005] [] BootStats: loading static content block done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000006] [] BootStats: pthread_init done, took 4ms wall, 4ms cpu, 3 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000007] [] BootStats: Process::InitProcessStatics done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000008] [] BootStats: timezone_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000009] [] BootStats: xenon done, took 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000010] [] BootStats: pcre_reinit done, took 2ms wall, 0ms cpu, -1 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000011] [] BootStats: onig_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000012] [] BootStats: xmlInitParser done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000013] [] BootStats: g_vmProcessInit done, took 32ms wall, 32ms cpu, 5 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000014] [] BootStats: PageletServer::Restart done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000015] [] BootStats: XboxServer::Restart done, took 0ms wall, 4ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000016] [] BootStats: Stream::RegisterCoreWrappers done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000017] [] BootStats: ExtensionRegistry::moduleInit done, took 109ms wall, 108ms cpu, 7 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000018] [] BootStats: extra_process_init done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000019] [] BootStats: apc_load done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000020] [] BootStats: rds::requestExit done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000021] [] BootStats: ExecutionContext done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000022] [] BootStats: extra_process_init_concurrent_wait done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000023] [] Warming up</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000024] [] BootStats: warmup done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000025] [] BootStats: enable_numa done, took 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000026] [] page server started</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000027] [] admin server started</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000028] [] BootStats: servers started done, took 82ms wall, 84ms cpu, 5 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000029] [] all servers started</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000030] [] BootStats: all done, took 258ms wall, 256ms cpu, 141 MB RSS total</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000031] [] BootStats: ExecutionContext = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000032] [] BootStats: ExtensionRegistry::moduleInit = 109ms wall, 108ms cpu, 7 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000033] [] BootStats: PageletServer::Restart = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000034] [] BootStats: Process::InitProcessStatics = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000035] [] BootStats: Stream::RegisterCoreWrappers = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000036] [] BootStats: TOTAL = 258ms wall, 256ms cpu, 141 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000037] [] BootStats: XboxServer::Restart = 0ms wall, 4ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000038] [] BootStats: apc_load = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000039] [] BootStats: enable_numa = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000040] [] BootStats: extra_process_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000041] [] BootStats: extra_process_init_concurrent_wait = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000042] [] BootStats: g_vmProcessInit = 32ms wall, 32ms cpu, 5 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000043] [] BootStats: loading static content = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000044] [] BootStats: mapping self = 25ms wall, 24ms cpu, 121 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000045] [] BootStats: onig_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000046] [] BootStats: pagein_self = 25ms wall, 24ms cpu, 121 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000047] [] BootStats: pcre_reinit = 2ms wall, 0ms cpu, -1 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000048] [] BootStats: pthread_init = 4ms wall, 4ms cpu, 3 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000049] [] BootStats: rds::requestExit = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000050] [] BootStats: servers started = 82ms wall, 84ms cpu, 5 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000051] [] BootStats: timezone_init = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000052] [] BootStats: warmup = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000053] [] BootStats: xenon = 0ms wall, 0ms cpu, 1 MB RSS</div><div>[Tue Sep  5 11:49:49 2017] [hphp] [30052:7f1da7574180:0:000054] [] BootStats: xmlInitParser = 0ms wall, 0ms cpu, 0 MB RSS</div><div>[Tue Sep  5 11:50:12 2017] [hphp] [30052:7f1d8dbff700:8:000001] [] Finished singleJitRequest 1</div><div>[Tue Sep  5 11:50:12 2017] [hphp] [30052:7f1d843ff700:5:000001] [] Finished singleJitRequest 2</div><div>[Tue Sep  5 11:50:12 2017] [hphp] [30052:7f1d8dbff700:9:000001] [] Finished singleJitRequest 3</div><div>[Tue Sep  5 11:50:13 2017] [hphp] [30052:7f1d843ff700:6:000001] [] Finished singleJitRequest 4</div><div>[Tue Sep  5 11:50:13 2017] [hphp] [30052:7f1d8dbff700:10:000001] [] Finished singleJitRequest 5</div><div>[Tue Sep  5 11:50:13 2017] [hphp] [30052:7f1d843ff700:7:000001] [] Finished singleJitRequest 6</div><div>[Tue Sep  5 11:50:13 2017] [hphp] [30052:7f1d8dbff700:11:000001] [] Finished singleJitRequest 7</div><div>[Tue Sep  5 11:50:13 2017] [hphp] [30052:7f1d843ff700:8:000001] [] Finished singleJitRequest 8</div><div>[Tue Sep  5 11:50:14 2017] [hphp] [30052:7f1d8dbff700:12:000001] [] Finished singleJitRequest 9</div><div>[Tue Sep  5 11:50:14 2017] [hphp] [30052:7f1d843ff700:9:000001] [] Finished singleJitRequest 10</div><div>[Tue Sep  5 11:50:14 2017] [hphp] [30052:7f1d8dbff700:13:000001] [] Finished singleJitRequest 11</div><div>[Tue Sep  5 11:50:14 2017] [hphp] [30052:7f1d843ff700:10:000001] [] Finished singleJitRequest 12</div><div>[Tue Sep  5 11:50:15 2017] [hphp] [30052:7f1d8dbff700:14:000001] [] Finished singleJitRequest 13</div><div>[Tue Sep  5 11:50:15 2017] [hphp] [30052:7f1d843ff700:11:000001] [] Finished singleJitRequest 14</div><div>[Tue Sep  5 11:50:16 2017] [hphp] [30052:7f1d8dbff700:15:000001] [] Finished singleJitRequest 15</div><div>[Tue Sep  5 11:50:16 2017] [hphp] [30052:7f1d843ff700:12:000001] [] Finished singleJitRequest 16</div><div>[Tue Sep  5 11:50:16 2017] [hphp] [30052:7f1d8dbff700:16:000001] [] Finished singleJitRequest 17</div><div>[Tue Sep  5 11:50:16 2017] [hphp] [30052:7f1d843ff700:13:000001] [] Finished singleJitRequest 18</div><div>[Tue Sep  5 11:50:16 2017] [hphp] [30052:7f1d8dbff700:17:000001] [] Finished singleJitRequest 19</div><div>[Tue Sep  5 11:50:17 2017] [hphp] [30052:7f1d843ff700:14:000001] [] Finished singleJitRequest 20</div></div>
</div>";
	
	//Footer

	//bottom: 26px; 

	$html .= "<div style=\" position: relative;  \" id=\"titleContainer\"><div id=\"title\">/var/log/hhvm/error.log</div>&nbsp;&nbsp;<div style=\"display: inline-block; float: right;\"><a class=\"linkSmall\" >Clear Log</a><a class=\"linkSmall\" >Delete Log</a></div></div>";

		return $html;
}

?>