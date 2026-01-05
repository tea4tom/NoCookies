<?php

/* IMPORTANT:
	Don't forget to enter your own database connection information on the first line!
*/
// initialise nocookies DB       VVVVVVVV           VVVVVVVVV          VVVVVV
$db = new mysqli("localhost","_YOURDBUSERNAME_","_YOURDBPASSWORD_","_YOURDBNAME_");
// Check connection
if ($db -> connect_errno) {
	echo "Failed to connect to MySQL: " . $db -> connect_error;
	exit();
}

$db->query("INSERT INTO `nc_debugs` (`log`) VALUES ('nocookies PHP initialised.')");

if(!isset($includeheader)) {
	// process post commands
	$db->query("INSERT INTO `nc_debugs` (`log`) VALUES ('Detected NOT a include.')");

	if(isset($_POST["ncdata"])) {
		$dbdata = "POST: " .$_POST['ncdata'];
		$db->query("INSERT INTO `nc_debugs` (`log`) VALUES ('POST variable found.')");
		$s = $db->prepare("INSERT INTO `nc_debugs` (`log`) VALUES (?)");
		$s->bind_param("s", $dbdata);
		$s->execute();
		$s->close();

		// page is loading and providing some client side data for the session
		$check = json_decode(urldecode($_POST["ncdata"]), true);

		$dbdata = "CHECK_LHASH: " .$check['logohash'];
		$db->query();
		$s = $db->prepare("INSERT INTO `nc_debugs` (`log`) VALUES (?)");
		$s->bind_param("s", $dbdata);
		$s->execute();
		$s->close();

		$s = $db->prepare("SELECT * FROM `nc_sessions` WHERE `logohash` = ? AND `logosize` = ?");
		$s->bind_param("si", $check["logohash"], intval($check["logosize"]));

		/* $s = $db->prepare("SELECT * FROM `nc_sessions` WHERE `os` = ? AND `browserid` = ? AND `browserver` = ? AND `browserverm` = ? AND `browserapp` = ? AND `browserua` = ? AND `logohash` = ? AND `logosize` = ?");
		$s->bind_param("ssiisssi", $check["os"], $check["browserid"], floatval($check["browserver"]), floatval($check["browserverm"]), $check["navappname"], $check["navua"], $check["logohash"], intval($check["logosize"])); */

		$s->execute();
		$r = $s->get_result();
		$rows = [];
		$dx = 0;
		while($row = $r->fetch_assoc()) {
			$rows[] = $row;
			$dx++;
		}
		$s->close();

		$db->query("INSERT INTO `nc_debugs` (`log`) VALUES ('nocookies found ' .$dx .' records.')");

		if($dx == 0) {
			// Create a random session identity
			$db->query("INSERT INTO `nc_debugs` (`log`) VALUES (' - Creating a new session ID.')");
			$digits = 4;
			$sessionidstr = "Guest_" .rand(pow(10, $digits-1), pow(10, $digits)-1);
			$sessionping = time();
			// Create a new session record
			$s = $db->prepare("INSERT INTO `nc_sessions` (`sessionid`, `ping`, `sessionblob`, `os`, `browserid`, `browserver`, `browserverm`, `browserapp`, `browserua`, `logohash`, `logosize`, `colourdepth`, `pixeldepth`, `pixelratio`, `rxavail`, `ryavail`, `rxres`, `ryres`, `rxsize`, `rysize`, `fonts`, `plugins`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$s->bind_param("sisssiisssiiiiiiiiiiss", $sessionidstr, $sessionping, $_POST["ncdata"], $check["os"], $check["browserid"], floatval($check["browserver"]), floatval($check["browserverm"]), $check["navappname"], $check["navua"], $check["logohash"], intval($check["logosize"]), intval($check["swrect"]["colourdepth"]), intval($check["swrect"]["pixeldepth"]), intval($check["swrect"]["pixelratio"]), intval($check["swrect"]["avail"]["x"]), intval($check["swrect"]["avail"]["y"]), intval($check["swrect"]["resolution"]["x"]), intval($check["swrect"]["resolution"]["y"]), intval($check["swrect"]["size"]["x"]), intval($check["swrect"]["size"]["y"]), json_encode($check["fontsqry"]), json_encode($check["plugins"]));
			$s->execute();
			$serr - $s->error + " " + $db->error;
			$s->close();
			exit("{ \"profileid\": \"" .$sessionidstr ." *\", \"lastping\": 0, \"num_rows\": 0, \"err\": \"" .$serr ."\" }");
		} else {
			$db->query("INSERT INTO `nc_debugs` (`log`) VALUES (' - Returning a known session')");
			$newid = (isset($_POST["newid"]) ? $_POST["newid"] : $rows[0]["sessionid"]);
			$lastping = $rows[0]["ping"];
			$newping = time();
			$s = $db->prepare("UPDATE `nc_sessions` SET `sessionid` = ?, `ping` = ? WHERE `idx` = ? LIMIT 1");
			$s->bind_param("sii", $newid, $newping, $rows[0]["idx"]);
			$s->execute();
			$s->close();
			exit("{ \"profileid\": \"" .$newid ."\", \"lastping\": " .$lastping .", \"num_rows\": " .$dx ." }");
		}
	}

} else {
	// include in file code
}

?>