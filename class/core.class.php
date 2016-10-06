<?php

class Core {
	public $linkID;
	function __construct($linkID){ $this->linkID = $linkID; }

   public function new_mysql($sql) {
		$result = $this->linkID->query($sql) or die($this->linkID->error.__LINE__);
      return $result;
	}

	public function error() {
		// Generic error message
      	$template = "error.tpl";
      	$data = array();
      	$this->load_smarty($data,$template);
		die;
	}

	public function load_smarty($vars,$template) {
		// loads the PHP Smarty class
		require_once(PATH.'/libs/Smarty.class.php');
		$smarty=new Smarty();
		$smarty->setTemplateDir(PATH.'/templates/');
		$smarty->setCompileDir(PATH.'/templates_c/');
		$smarty->setConfigDir(PATH.'/configs/');
		$smarty->setCacheDir(PATH.'/cache/');
		if (is_array($vars)) {
			foreach ($vars as $key=>$value) {
				$smarty->assign($key,$value);
			}
		}
		$smarty->display($template);
	}

	public function activity_log($reservationID,$activity,$sql,$module) {
		$sql = $this->linkID->real_escape_string($sql);

		$date = date("Ymd H:i:s");
		$sql2 = "INSERT INTO `activity_log` (`date`,`uuname`,`reservationID`,`activity`,`sql`,`module`) VALUES
		('$date','$_SESSION[uuname]','$reservationID','$activity','$sql','$module')";

		$result = $this->new_mysql($sql2);
	}


	public function country_list($id) {
		// returns a list of counties from the AF database
		if ($id == "") {
			$option .= "<option selected value=\"\">--Select Country--</option>";
		}
		$sql = "
		SELECT
			`c`.`countryID`,
			`c`.`country`

		FROM
			`reserve`.`countries` c

		ORDER BY `c`.`country` ASC
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($id == $row['countryID']) {
				$option .= "<option selected value=\"$row[countryID]\">$row[country]</option>";
			} else {
            $option .= "<option value=\"$row[countryID]\">$row[country]</option>";
			}
		}
		return $option;
	}


	public function get_countries($id) {
		// older function redirecting to newer function now
		$option = $this->country_list($id);
		return $option;
    }

	public function clear_white($string) {
		$string = substr($string,1);
		return $string;
	}

	public function getMonthsInRange($startDate, $endDate) {
		$months = array();
		while (strtotime($startDate) <= strtotime($endDate)) {
			$months[] = array('year' => date('Y', strtotime($startDate)), 'month' => date('F', strtotime($startDate)), );
			$startDate = date('d M Y', strtotime($startDate.
			'+ 1 month'));
		}

		return $months;
	}

	
	public function get_states($id) {
		// returns a list of states
		$sql = "SELECT * FROM `state` ORDER BY `state` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $id) {
				$state .= "<option selected value=\"$row[state_abbr]\">$row[state_abbr]</option>";
			} else {
				$state .= "<option value=\"$row[state_abbr]\">$row[state_abbr]</option>";
			}
		}
		return $state;
	}


	public function profile($msg = "") {
		$sql = "SELECT * FROM `users` WHERE `uuname` = '$_SESSION[uuname]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$data['msg'] = $msg;
		$template = "profile.tpl";
		$this->load_smarty($data,$template);
	}

	public function saveprofile() {
		$sql = "SELECT `email` FROM `users` WHERE `uuname` != '$_SESSION[uuname]' AND `email` = '$_POST[email]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
		}
		if ($found == "1") {
			$msg = "<font color=red>Sorry, the email <b>$_POST[email]</b> is already registered.</font><br>";
			$this->profile($msg);
		} else {
			if ($_POST['uupass'] != "") {
				$uupass = " ,`uupass`  = '$_POST[uupass]'";
			}
			$sql2 = "UPDATE `users` SET `first` = '$_POST[first]', `last` = '$_POST[last]', `email` = '$_POST[email]' $uupass 
			WHERE `uuname` = '$_SESSION[uuname]'";
			$result2 = $this->new_mysql($sql2);
			if ($result2 == "TRUE") {
				$msg = "<font color=green>Your profile was updated.</font><br>";
				$this->profile($msg);
			} else {
				$msg = "<font color=red>Your profile failed to update.</font><br>";
				$this->profile($msg);
			}
		}
	}

	public function logout() {
		$data['msg'] = "<font color=green>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have been logged out. Loading...</font>";
		$this->load_smarty($data,'message.tpl');

		session_destroy();
		?>
	   	<script>
	   	setTimeout(function() {
	      window.location.replace('index.php')
	   	}
	   ,2000);

	   	</script>
		<?php
	}

	public function forgot_password() {
		$template = "forgot_password.tpl";
		$this->load_smarty($null,$template);
	}

	// Login form
	public function login($msg) {
		$data = array();
		if ($msg != "") {
			$data['msg'] = "$msg";	
		} else {
			$data['msg'] = "0";
		}
		$template = "login.tpl";
		$this->load_smarty($data,$template);
	}


	// User Dashboard
   public function dashboard() {
	   switch ($_SESSION['userType']) {
			case "admin":
			case "member":
   	   		$this->dashboard_admin();
      		break;
		}
	}


	public function get_settings() {
		// settings
      	$sql = "SELECT * FROM `settings` WHERE `id` = '1'";
      	$result = $this->new_mysql($sql);
      	$row = $result->fetch_assoc();

      	$sitename = $row['sitename'];
      	$siteurl = $row['siteurl'];
      	$site_email = $row['site_email'];
      	$base_path = $row['base_path'];
      	$authnet_login = $row['authnet_login'];
      	$authnet_key = $row['authnet_key'];
      	$authnet_testmode = $row['authnet_testmode'];
               
      	// email headers - This is fine tuned, please do not modify
      	$header = "MIME-Version: 1.0\r\n";
      	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
      	$header .= "From: $sitename <$site_email>\r\n";
      	$header .= "Reply-To: $sitename <$site_email>\r\n";
      	$header .= "X-Priority: 3\r\n";
      	$header .= "X-Mailer: PHP/" . phpversion()."\r\n";

      	$data = array();
      	$data[] = $sitename;
      	$data[] = $siteurl;
      	$data[] = $site_email;
      	$data[] = $header;
      	$data[] = $base_path;
      	$data[] = $authnet_login;
      	$data[] = $authnet_key;
      	$data[] = $authnet_testmode;


      return $data;
	}






}
// end class

?>
