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

		$data['output'] = $this->list_users(); // gets data

		$this->load_smarty($data,$template);

	}

	public function list_users() {
      $access_required[] = "admin";
      $this->check_access($access_required);

		$sql = "SELECT * FROM `users` ORDER BY `active`, `last`,`first`";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$output .= "<tr><td>$row[first] $row[last]</td><td>$row[userType]</td><td>$row[active]</td><td>
				<input type=\"button\" value=\"Edit\" onclick=\"document.location.href='edituser/$row[id]'\" class=\"btn btn-primary\">&nbsp;
				<input type=\"button\" value=\"Delete\" onclick=\"if(confirm('You are about to delete $row[first] $row[last]. Click OK to delete the user or Cancel to abort.')){document.location.href='deleteuser/$row[id]';}\" class=\"btn btn-danger\">

				</td></tr>";
		}
		return $output;

	}

	public function deleteuser() {
      $access_required[] = "admin";
      $this->check_access($access_required);

		// check if they are trying to delete them self
		if ($_SESSION['id'] != $_GET['id']) {
			$sql = "DELETE FROM `users` WHERE `id` = '$_GET[id]'";
	      $result = $this->new_mysql($sql);
   	   if ($result == "TRUE") {
      	   $msg = "<font color=green>The user was deleted.</font><br>";
	      } else {
   	      $msg = "<font color=red>The user failed to delete.</font><br>";
	      }
		} else {
			$msg = "<font color=red>Really, you are trying to delete yourself?</font><br>";
		}
      $data['msg'] = $msg;
      $data['output'] = $this->list_users(); // gets data
      $template = "users.tpl";
      $this->load_smarty($data,$template);

	}

	public function edituser() {
      $access_required[] = "admin";
      $this->check_access($access_required);

		$sql = "SELECT * FROM `users` WHERE `id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}

		$template = "edituser.tpl";
		$this->load_smarty($data,$template);

	}

	public function updateuser() {
      $access_required[] = "admin";
      $this->check_access($access_required);

		$sql = "
		UPDATE `users` SET `first` = '$_POST[first]', `last` = '$_POST[last]', `email` = '$_POST[email]', `uupass` = '$_POST[uupass]', `userType` = '$_POST[userType]', `active` = '$_POST[active]' WHERE `id` = '$_POST[id]'
		";
      $result = $this->new_mysql($sql);
      if ($result == "TRUE") {
         $msg = "<font color=green>The user was updated.</font><br>";
      } else {
         $msg = "<font color=red>The user failed to update.</font><br>";
      }
      $data['msg'] = $msg;
      $data['output'] = $this->list_users(); // gets data
      $template = "users.tpl";
      $this->load_smarty($data,$template);

	}

	public function addnewuser() {
      $access_required[] = "admin";
      $this->check_access($access_required);

      $template = "addnewuser.tpl";
      $data = array();
      $this->load_smarty($data,$template);
	}

	public function saveuser() {
      $access_required[] = "admin";
      $this->check_access($access_required);

		$today = date("Ymd");
		$sql = "INSERT INTO `users` (`first`,`last`,`email`,`uuname`,`uupass`,`userType`,`active`,`date_created`) VALUES ('$_POST[first]','$_POST[last]','$_POST[email]','$_POST[uuname]','$_POST[uupass]','$_POST[userType]','Yes','$today')";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$msg = "<font color=green>The user was created.</font><br>";
		} else {
			$msg = "<font color=red>The user failed to create.</font><br>";
		}
		$data['msg'] = $msg;
      $data['output'] = $this->list_users(); // gets data
		$template = "users.tpl";
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
