<?php

include $GLOBAL['path']."/class/reports.class.php";

class loader extends reports {

	public $linkID;
	function __construct($linkID){ $this->linkID = $linkID; }

	// check login system
	public function check_login() {
		$sql = "SELECT * FROM `users` WHERE `users`.`uuname` = '$_SESSION[uuname]' AND `users`.`uupass` = '$_SESSION[uupass]' AND `users`.`active` = 'Yes'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
      	$found = "1";
			// update session data
			foreach ($row as $key=>$value) {
				$_SESSION[$key] = $value;
			}
		}
      	if ($found == "1") {
      		return "TRUE";
		} else {
			$remote_addr = $_SERVER['REMOTE_ADDR'];
			if ($remote_addr == "98.142.222.28") { // Server IP of the virtual host
				return "TRUE";
			} else {
				return "FALSE";
			}
		}
	}

	public function check_access($type) {

		$remote_addr = $_SERVER['REMOTE_ADDR'];
		if ($remote_addr == "98.142.222.28") { // Server IP of the virtual host
			// bypass the access
			$type = "admin";
		} else {

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

	public function whitelist($string) {
		// list of methods load_module is allowed to pass
		$sql = "SELECT `method` FROM `whitelist`";
		$result = $this->new_mysql($sql);
		$data = array();
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key1=>$value1) {
				$data[] = $value1;
			}
		}
		$err = "1";
      	foreach ($data as $value) {
        	if ($value == $string) {
				$err = "0";
				// check access
				$sql2 = "SELECT `access` FROM `whitelist` WHERE `method` = '$string'";
				$result2 = $this->new_mysql($sql2);
				while ($row2 = $result2->fetch_assoc()) {
					$access = $row2['access'];
					$access_required = explode(",",$access);
				}
		      	$this->check_access($access_required);
			}
		}
		return $err;
	}

	public function load_module($module) {
		// The method is checked in the classes below and if found the method is executed
		// This is simular to Laravel's route system
		$err = $this->whitelist($module);
		if ($err == "1") {
			print "<br><font color=red>You do not have access to the $module method.</font><br>";
			die;
		}
		

		if (method_exists('Core',$module)) {
			$this->$module();
		} elseif (method_exists('contacts',$module)) {
			$this->$module();
		} elseif (method_exists('reports',$module)) {
			$this->$module();
		} elseif (method_exists('reservations',$module)) {
			$this->$module();
		} elseif (method_exists('resellers',$module)) {
			$this->$module();
		} elseif (method_exists('gis',$module)) {
			$this->$module();
		} elseif (method_exists('admin',$module)) {
			$this->$module();
		} else {
			print "<br><font color=red>The $module method does not exist.</font><br>";
			die;
		}
	}

// end class	
}
