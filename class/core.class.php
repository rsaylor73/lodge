<?php

if( !class_exists( 'Core')) {
class Core {
	public $linkID;
	function __construct($linkID){ $this->linkID = $linkID; }

   public function new_mysql($sql) {
		$result = $this->linkID->query($sql) or die($this->linkID->error.__LINE__);
      return $result;
	}

	private function error() {
      $template = "error.tpl";
      $data = array();
      $this->load_smarty($data,$template);
		die;
	}

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
			return "FALSE";
		}
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

		// will DB this most likely - RBS
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
		$err = $this->whitelist($module);
		if ($err == "1") {
			print "<br><font color=red>You do not have access to the $module method.</font><br>";
			die;
		}
		

		

		// load classes
		include_once("class/contacts.class.php");
		include_once("class/test.class.php");

		$contacts = new contacts();
		$test = new test();

		if (method_exists('Core', $module)) {
			$this->$module();
		}

		/*
		if (method_exists('Core', $module)) {
			$this->$module();
		} elseif (method_exists('contacts', $module)) {
			$contacts->$module();
		} else {
			//
		}
		*/


		/*
		if (method_exists('Core',$module)) {
			$this->$module();
		} elseif {
			// search the contacts class
			$contacts = new contacts();
			if (method_exists('contacts', $module)) {
				$contacts->$module();
			}
		} else {
			print "<br><font color=red>The $module method does not exist.</font><br>";
			die;
		}
		*/
	}





}
// end class
}
// end if
?>
