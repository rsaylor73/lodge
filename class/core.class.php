<?php

if( !class_exists( 'Core')) {
class Core {
	public $linkID;
	function __construct($linkID){ $this->linkID = $linkID; }

   public function new_mysql($sql) {
		$result = $this->linkID->query($sql) or die($this->linkID->error.__LINE__);
      return $result;
	}

	// gets a list of states
	public function get_states($id) {
		$sql = "SELECT * FROM `state` ORDER BY `state` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $id) {
				$state .= "<option selected value=\"$row[id]\">$row[state]</option>";
			} else {
				$state .= "<option value=\"$row[id]\">$row[state]</option>";
			}
		}
		return $state;
	}

	public function get_one_state($id) {
   	$sql = "SELECT * FROM `state` WHERE `id` = '$id'";
      $result = $this->new_mysql($sql);
      while ($row = $result->fetch_assoc()) {
      	$state .= "<option selected value=\"$row[id]\">$row[state]</option>";
      }
		return $state;
	}

	// check login system
	public function check_login() {
		$sql = "SELECT `users`.`id` FROM `users` WHERE `users`.`uuname` = '$_SESSION[uuname]' AND `users`.`uupass` = '$_SESSION[uupass]' AND `users`.`active` = 'Yes'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
      	$found = "1";
		}
      if ($found == "1") {
      	return "TRUE";
		} else {
			return "FALSE";
		}
	}

	public function navigation() {
		$sql = "SELECT * FROM `users` WHERE `id` = '$_SESSION[id]' AND `active` = 'Yes'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$userType = $row['userType'];
		}
		if ($userType != "") {
			$data['access'] = $userType; // crew, agent, admin
			$template = "navigation.tpl";
			$this->load_smarty($data,$template);
		}

	}

	public function check_access($type) {
		/* This function checks if the user has access to the module. Each module will define the access and send to this method */
		foreach ($type as $value) {
			if ($_SESSION['userType'] == $value) {
				$ok = "1";
			}
		}
		if ($ok != "1") {
			print "<br><br><font color=red>Sorry, but you do not have access to the requestion action.</font><br><br>";
			die;
		}
	}

	/*
		General note about check_access : You define an array and pass the possible user access types. IE you could pass admin and accounting then that module would
		be allowed to be accessed from those user types.

	*/

	public function users() {
		$access_required[] = "admin";
		$this->check_access($access_required);

		$template = "users.tpl";
		$data = array();
		$this->load_smarty($data,$template);

	}

	public function addnewuser() {
      $access_required[] = "admin";
      $this->check_access($access_required);

      $template = "addnewuser.tpl";
      $data = array();
      $this->load_smarty($data,$template);
	}

	public function load_smarty($vars,$template) {
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
}
// end if
?>
