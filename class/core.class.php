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
		require_once('libs/Smarty.class.php');
		$smarty=new Smarty();
		$smarty->setTemplateDir('templates/');
		$smarty->setCompileDir('templates_c/');
		$smarty->setConfigDir('configs/');
		$smarty->setCacheDir('cache/');
		if (is_array($vars)) {
			foreach ($vars as $key=>$value) {
				$smarty->assign($key,$value);
			}
		}
		$smarty->display($template);
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

	/*
	public function get_one_state($id) {
   		$sql = "SELECT * FROM `state` WHERE `id` = '$id'";
      	$result = $this->new_mysql($sql);
      	while ($row = $result->fetch_assoc()) {
      		$state .= "<option selected value=\"$row[id]\">$row[state]</option>";
      	}
		return $state;
	}
	*/

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
		$data[] = $identifier;
		$data[] = $api_username;
		$data[] = $api_password;

      return $data;
	}






}
// end class

?>
