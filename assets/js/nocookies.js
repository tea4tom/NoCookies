
function enumerateFonts() {
	const list = [
		"Arial Black", "Comic Sans MS", "Courier New", 
		"Georgia", "Impact", "Lucida Console", "Lucida Sans Unicode", 
		"Tahoma", "Geneva", "New York", "Roboto", "Roboto Serif", 
		"Helvetica", "Helvetica Extra Light", "Times", "Ubuntu Monospace",
		"Ubuntu", "Cantarell", "Liberation Sans"
	];
	var d = new Detector();

	var jsonobj = "{";
	for (var itm in list) {
		jsonobj += "\"" + list[itm] +"\": \"" + d.detect(list[itm]).toString() +"\", " ;
	}
	jsonobj += " \"undefined\": \"unset\" }"
	
	return JSON.parse(jsonobj);
}

function enumeratePlugins() {

	var jsonobj = "{";
	var x=navigator.plugins.length; // store the total no of plugin stored 
	for(var i=0;i<x;i++)
	{
	  jsonobj += "\"" + i.toString() + "\": \"" + navigator.plugins[i].name + "\", "; 
	}
	jsonobj += " \"plugins_count\": " + x.toString() + " }"
	
	return JSON.parse(jsonobj);
}
function getOS() {
  const userAgent = window.navigator.userAgent,
      platform = window.navigator?.userAgentData?.platform || window.navigator.platform,
      macosPlatforms = ['macOS', 'Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
      windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
      iosPlatforms = ['iPhone', 'iPad', 'iPod'];
  let os = null;

  if (macosPlatforms.indexOf(platform) !== -1) {
    os = 'Mac OS';
  } else if (iosPlatforms.indexOf(platform) !== -1) {
    os = 'iOS';
  } else if (windowsPlatforms.indexOf(platform) !== -1) {
    os = 'Windows';
  } else if (/Android/.test(userAgent)) {
    os = 'Android';
  } else if (/Linux/.test(platform)) {
    os = 'Linux';
  }

  return os;
}

function getBrowserInfo() {
	// detect browser info
	var nVer = navigator.appVersion;
	var nAgt = navigator.userAgent;
	var browserName  = navigator.appName;
	var fullVersion  = ''+parseFloat(navigator.appVersion); 
	var majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;

	// In Opera, the true version is after "OPR" or after "Version"
	if ((verOffset=nAgt.indexOf("OPR"))!=-1) {
	 browserName = "Opera";
	 fullVersion = nAgt.substring(verOffset+4);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In MS Edge, the true version is after "Edg" in userAgent
	else if ((verOffset=nAgt.indexOf("Edg"))!=-1) {
	 browserName = "Microsoft Edge";
	 fullVersion = nAgt.substring(verOffset+4);
	}
	// In MSIE, the true version is after "MSIE" in userAgent
	else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	 browserName = "Microsoft Internet Explorer";
	 fullVersion = nAgt.substring(verOffset+5);
	}
	// In Chrome, the true version is after "Chrome" 
	else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	 browserName = "Chrome";
	 fullVersion = nAgt.substring(verOffset+7);
	}
	// In Safari, the true version is after "Safari" or after "Version" 
	else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	 browserName = "Safari";
	 fullVersion = nAgt.substring(verOffset+7);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In Firefox, the true version is after "Firefox" 
	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	 browserName = "Firefox";
	 fullVersion = nAgt.substring(verOffset+8);
	}
	// In most other browsers, "name/version" is at the end of userAgent 
	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
	          (verOffset=nAgt.lastIndexOf('/')) ) 
	{
	 browserName = nAgt.substring(nameOffset,verOffset);
	 fullVersion = nAgt.substring(verOffset+1);
	 if (browserName.toLowerCase()==browserName.toUpperCase()) {
	  browserName = navigator.appName;
	 }
	}
	// trim the fullVersion string at semicolon/space if present
	if ((ix=fullVersion.indexOf(";"))!=-1)
	   fullVersion=fullVersion.substring(0,ix);
	if ((ix=fullVersion.indexOf(" "))!=-1)
	   fullVersion=fullVersion.substring(0,ix);

	majorVersion = parseInt(''+fullVersion,10);
	if (isNaN(majorVersion)) {
	 fullVersion  = ''+parseFloat(navigator.appVersion); 
	 majorVersion = parseInt(navigator.appVersion,10);
	}

	return [browserName, fullVersion, majorVersion];
}

function clearPIDConfirmation() {
	$("#profile_id_confirmation").html('');
}

// global
var ncsc;

// Shorthand for $( document ).ready()
$(function() {
    // get the canvas element (Todo: append canvas to document if it does not exist)
	var c = document.getElementById("nclogo");
	var ctx = c.getContext("2d");

	// create a logo
	ctx.beginPath();
	ctx.arc(95, 50, 40, 0, 2 * Math.PI);
	ctx.lineWidth = 10;
	ctx.strokeStyle = "white";
	ctx.stroke();

	const grad=ctx.createRadialGradient(150,75,15,150,75,150);
	grad.addColorStop(0,"lightblue");
	grad.addColorStop(0.3,"pink");
	grad.addColorStop(1,"darkblue"); 

	ctx.fillStyle = grad;

	ctx.font = "24px Arial";
	ctx.fillText("noCookies", 10, 50);

	// save the image data in PNG format and create MD5 hash
	var imgdata = c.toDataURL("image/png");
	var logoDataSize = imgdata.length;

	// locate a 3d context offscreen and compile webgl data
	

	// get common browser info
	browserdetails = getBrowserInfo();

	// create nocookie fingerprint object
	ncsc = {
		os: getOS(),
		browserid: browserdetails[0],
		browserver: browserdetails[1],
		browserverm: browserdetails[2],
		navappname: navigator.appName,
		navua: navigator.userAgent,
		logohash: md5(imgdata),
		logosize: imgdata.length,
		swrect: {
			colourdepth: screen.colorDepth,
			pixeldepth: screen.pixelDepth,
			pixelratio: window.devicePixelRatio,
			avail: { x: screen.availWidth, y: screen.availHeight },
			resolution: { x: window.screen.width * window.devicePixelRatio, y: window.screen.height * window.devicePixelRatio },
			size: { x: window.screen.width, y: window.screen.height }
		},
		fontsqry: enumerateFonts(),
		plugins:enumeratePlugins()
	};

	document.getElementById("debug_object_string").innerHTML = "<pre>" + JSON.stringify(ncsc, null, 2) + "</pre>";

	// post fingerprint to server
	$.ajax({
        url : "assets/php/nocookies.php",
        type: 'POST',
        data : { ncdata : encodeURIComponent(JSON.stringify(ncsc))},
        dataType :'json',
        success:function(data) 
        {
            console.log(data);

            //var profile = JSON.parse(data);
			var lastvisit = (data.lastping == 0 ? "never" : new Date(data.lastping * 1000).toLocaleString());

            $("#sessionprofile").html('<p>Hi <strong>' + data.profileid + '</strong><br><span style="font-size: 11px">You last visited at: ' + lastvisit + '</span></p>');
			$("#sessionprofile").show();
			$("#profileidstr").val(data.profileid);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            console.log(errorThrown);
        },
	});
	

});

$("#updateprofileid").on("click", function() {
	event.preventDefault();
	$.ajax({
        url : "assets/php/nocookies.php",
        type: 'POST',
        data : { ncdata : encodeURIComponent(JSON.stringify(ncsc)), newid : $("#profileidstr").val() },
        dataType :'json',
        success:function(data) 
        {
            console.log(data);

            //var profile = JSON.parse(data);
			var lastvisit = (data.lastping == 0 ? "never" : new Date(data.lastping * 1000).toLocaleString());

            $("#sessionprofile").html('<p>Hi <strong>' + data.profileid + '</strong><br><span style="font-size: 11px">You last visited at: ' + lastvisit + '</span></p>');
			$("#sessionprofile").show();

			$("#profile_id_confirmation").html('New profile ID saved: ' + data.profileid);
			window.setTimeout(clearPIDConfirmation, 2500);

        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            console.log(errorThrown);
        },
	});
});
