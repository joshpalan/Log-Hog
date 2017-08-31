var offsetHeight = 0;
if(document.getElementById("menu"))
{
	offsetHeight += document.getElementById("menu").offsetHeight;
}
if(document.getElementById("menu2"))
{
	offsetHeight += document.getElementById("menu2").offsetHeight;
}
var heightOfMain = window.innerHeight - offsetHeight;
var heightOfMainStyle = "height:";
heightOfMainStyle += heightOfMain;
heightOfMainStyle += "px";
document.getElementById("main").setAttribute("style",heightOfMainStyle);
var idForm = "";
var countForVerifySave = 0;
var pollCheckForUpdate;
var data;
var idForFormMain;

function saveAndVerifyMain(idForForm)
{
	idForFormMain = idForForm;
	idForm = "#"+idForForm;
	displayLoadingPopup(); //displayLoadingPopup is defined in popup.html
	data = $(idForm).serializeArray();
	$.ajax({
            type: "post",
            url: "../core/php/settingsSaveAjax.php",
            data: data,
            complete: function () {
              //verify saved
              verifySaveTimer();
            }
          });

}

function verifySaveTimer()
{
	countForVerifySave = 0;
	pollCheckForUpdate = setInterval(timerVerifySave,3000);
}

function timerVerifySave()
{
	countForVerifySave++;
	if(countForVerifySave < 20)
	{
		var urlForSend = "../core/php/saveCheck.php?format=json";
		$.ajax(
		{
			url: urlForSend,
			dataType: "json",
			data: data,
			type: "POST",
			success: function(data)
			{
				if(data === true)
				{
					clearInterval(pollCheckForUpdate);
					saveVerified();
				}
			},
		});
	}
	else
	{
		clearInterval(pollCheckForUpdate);
		saveError();
	}
}

function saveVerified()
{
	if(idForFormMain === "settingsMainVars")
	{
		refreshSettingsMainVar();
	}
	else if(idForFormMain === "settingsMenuVars")
	{
		refreshSettingsMenuVar();
	}
	else if(idForFormMain === "settingsMainWatch")
	{
		refreshSettingsWatchList();
	}

	document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class='settingsHeader' >Saved Changes!</div><br><br><div style='width:100%;text-align:center;'> <img src='../core/img/greenCheck.png' height='50' width='50'> </div>";
	fadeOutPopup();
}

function saveError()
{
	document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class='settingsHeader' >Error</div><br><br><div style='width:100%;text-align:center;'> An Error Occured While Saving... </div>";
	fadeOutPopup();
}

function fadeOutPopup()
{
	setTimeout(hidePopup, 1000);
}