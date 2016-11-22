<?php
include $GLOBAL['path']."/class/admin.class.php";

class gis extends admin {

	public function sendgis() {
		$template = "send_gis_link.tpl";
		$data['contactID'] = $_GET['contactID'];
		$data['reservationID'] = $_GET['reservationID'];
		$data['bedID'] = $_GET['bedID'];

		$sql = "SELECT `first`,`last`,`email` FROM `reserve`.`contacts` WHERE `contactID` = '$_GET[contactID]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$this->load_smarty($data,$template);
	}


	public function processgis() {

		switch ($_POST['sendto']) {
			case "guest":
			$pw = $this->generate_link_pw();
			$sql = "UPDATE `beds` SET `gis_pw` = '$pw' WHERE `bedID` = '$_POST[bedID]'";
			$result = $this->new_mysql($sql);
			$this->email_gis($_POST['reservationID'],$_POST['contactID'],$_POST['bedID'],$pw);
			break;

			case "all":

			break;
		}

		print "<br>GIS link has been sent.<br>";
		print "<br><br>To return to your reservation click <a href=\"reservation_dashboard/$_POST[reservationID]/guests\">here</a>";


	}

	private function gis_message() {

		$msg = "
		Dear #guest_name#,<br><br>
		Thank you for choosing to travel with us for your upcoming vacation. The Guest Information System (GIS) link will take you to your personalized profile for this reservation. Click the following link or copy and paste the address into your web browser:<br>
<br>
<a href=\"#gis_url#\">#gis_url#</a>
		<br><br>
		Best Regards,<br>
		Aggressor Fleet<br>
		209 Hudson Trace<br>
		Augusta, GA 30907<br>
		USA<br>
		<br><br>

		Reservations:<br>
		info@aggressor.com<br>
		www.aggressor.com<br>
		800.348.2628 toll free USA/Canada<br>
		+1 706.993.2531 tel<br>
		<br><br>
		Aggressor Adventure Travel - Airline, hotel, resorts -  travel department<br>
		info@aggressortravel.comwww.aggressortravel.com<br>
		844.632.7413 toll free USA/Canada <br>
		+1.706.664.0052 tel<br>
		";
		return($msg);

	}

	private function email_gis($reservationID,$contactID,$bedID,$pw) {
		$sql = "SELECT `first`,`last`,`email` FROM `reserve`.`contacts` WHERE `contactID` = '$contactID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$first = $row['first'];
			$last = $row['last'];
			$email = $row['email'];
		}
		// change to SSL after certificate is done
		$gis_url = "https://gis.aggressorsafarilodge.com/gis/$reservationID/$contactID/$bedID/$pw";
		$guest_name = "$first $last";

		$message = $this->gis_message();
		$message = str_replace("#guest_name#",$guest_name,$message);
		$message = str_replace("#gis_url#",$gis_url,$message);

		$subj = "GIS Link for Aggressor Safarie Lodge : Conf # $reservationID";
		mail($email,$subj,$message,header_email);

		// To do - insert into history.
		$today = date("Ymd");
		$sql = "INSERT INTO `gis_history` (`reservationID`,`contactID`,`bedID`,`date`,`uuname`) VALUES
		('$reservationID','$contactID','$bedID','$today','$_SESSION[uuname]')";
		$result = $this->new_mysql($sql);
	}

	private function generate_link_pw() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

}
?>
