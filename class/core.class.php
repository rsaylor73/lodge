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
			print "<br><font color=red>You have called the program incorrectly.</font><br>";
			die;
		}
		if (method_exists('Core',$module)) {
			$this->$module();
		} else {
			print "<br><font color=red>You have called the program incorrectly.</font><br>";
			die;
		}
	}

	// Create one week of inventory
	public function create_inventory($locationID,$start_date,$days) {

		$date = strtotime($start_date);
		$date = strtotime("-1 day", $date);
		$start_date = date("Ymd", $date);

		for ($i=0; $i < $days; $i++) {
			$date = strtotime($start_date);
			$date = strtotime("+1 day", $date);
			$end_date[] = date("Ymd", $date);
			$start_date = date("Ymd", $date);
		}

		$bed_map[0] = "A";
		$bed_map[1] = "B";
		$bed_map[2] = "C";
		$bed_map[3] = "D";

		// Create inventory
		$sql = "SELECT * FROM `rooms` WHERE `locationID` = '$locationID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			for ($i=0; $i < $days; $i++) {
				$sql2 = "INSERT INTO `inventory` (`locationID`,`roomID`,`date_code`) VALUES ('$locationID','$row[id]','$end_date[$i]')";
				$sql3 = "SELECT * FROM `inventory` WHERE `locationID` = '$locationID' AND `roomID` = '$row[id]' AND `date_code` = '$end_date[$i]'";
				$result3 = $this->new_mysql($sql3);
				$test = "";
				$test = $result3->num_rows;
				if ($test == "") {
					// create inventory
					$result2 = $this->new_mysql($sql2);
					$inventoryID = $this->linkID->insert_id;
		         for ($i2 = 0; $i2 < $row['beds']; $i2++) {
						$sql4 = "INSERT INTO `beds` (`inventoryID`,`status`,`name`) VALUES ('$inventoryID','avail','$bed_map[$i2]')";
						$result4 = $this->new_mysql($sql4);
		         }

				}
			}
		}
		return "1";	

	}

	public function newreservation() {
      $template = "newreservation.tpl";
      $data = array();
      $data['msg'] = $msg;

		$options = "<option value=\"\" selected>Select Lodge</option>";
		$sql = "SELECT `id`,`name` FROM `locations` WHERE `active` = 'Yes'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[id]\">$row[name]</option>";
		}
		$data['lodge'] = $options;

		for ($i=1; $i < 30; $i++) {
			$pax .= "<option value=\"$i\">$i</option>";
		}
		$data['pax'] = $pax;

      $this->load_smarty($data,$template);

	}

	public function quick_search($day) {
      $sql = "
      SELECT
         COUNT(`b`.`status`) AS 'total_beds'
            
      FROM     
         `inventory` i, `beds` b
               
      WHERE 
         `i`.`locationID` = '$_POST[lodge]'
         AND `i`.`date_code` BETWEEN '$day' AND '$day'
         AND `i`.`inventoryID` = `b`.`inventoryID`
         AND `b`.`status` = 'avail'

      GROUP BY `b`.`status`
         
      HAVING total_beds >= '$_POST[pax]'
      ";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
		}
		if ($found == "1") {
			$color = "#E0F8E0";
		} else {
			$color= "#F5D0A9";
		}
		return $color;

	}

	public function searchinventory() {

		$start_date = str_replace("-","",$_POST['start_date']);
		$end_date = str_replace("-","",$_POST['end_date']);

		$sql = "
		SELECT
			COUNT(`b`.`status`) AS 'total_beds'

		FROM
			`inventory` i, `beds` b

		WHERE
			`i`.`locationID` = '$_POST[lodge]'
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
			AND `i`.`inventoryID` = `b`.`inventoryID`
			AND `b`.`status` = 'avail'

		GROUP BY `b`.`status`

		HAVING total_beds >= '$_POST[pax]'
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
			// build calendar to show # rooms available for each day
	      $this->load_smarty($null,'reservations_header.tpl');

			$months = $this->getMonthsInRange($_POST['start_date'],$_POST['end_date']);
			print "<table class=\"table\">
			<tr>";
			foreach ($months as $key=>$value) {
					$counter++;
					$year = $value['year'];
					$month = $value['month'];

					echo "<td>" . $this->calendar_table("$month $year") . "</td>";
					if ($counter > 3) {
						print "</tr><tr>";
						$counter = "0";
				}
			}
			print "</tr></table>";
			// ajax
			print '
			</div>
			<div class="row">
			<div class="col-md-6">
			<h2><a href="lodge">Available Rooms</a></h2>


			</div>
			';


			// end ajax
         $this->load_smarty($null,'reservations_footer.tpl');


		}
		if ($found != "1") {
			// display search form if no inventory found
	      $options = "<option value=\"\" selected>Select Lodge</option>";
   	   $sql = "SELECT `id`,`name` FROM `locations` WHERE `active` = 'Yes'";
	      $result = $this->new_mysql($sql);
   	   while ($row = $result->fetch_assoc()) {
				if ($_POST['lodge'] == $row['id']) {
					$options .= "<option selected value=\"$row[id]\">$row[name]</option>";
				} else {
		         $options .= "<option value=\"$row[id]\">$row[name]</option>";
				}
   	   }
	      $data['lodge'] = $options;

	      for ($i=1; $i < 30; $i++) {
				if ($_POST['pax'] == $i) {
					$pax .= "<option selected value=\"$i\">$i</option>";
				} else {
		         $pax .= "<option value=\"$i\">$i</option>";
				}
	      }
	      $data['pax'] = $pax;
			$data['start_date'] = $_POST['start_date'];
			$data['end_date'] = $_POST['end_date'];

			$data['msg'] = "<font color=red><br>Sorry, we did not locate any inventory that matched your search criteria.</b></font><br>";
	      $template = "newreservation.tpl";
	      $this->load_smarty($data,$template);
		}

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


	/*
	Credit for this function goes to Ray Paseur (McLean, VA) from expert-exchange.com
	*/
	public function calendar_table($date='Today') {
	    $dateobj           = new DateTime($date);
	    $month             = new DateTime($dateobj->format('Y-m-01'));
	    $caption           = $month->format("F Y");
	    $first_day_number  = $month->format("w");
   	 $last_day_of_month = $month->format("t");
		 $the_month 		  = $month->format("m");
       $the_year          = $month->format("Y");
	    $day_counter       = 0;

	    // USE HEREDOC NOTATION TO START THE HTML DOCUMENT
	    $html  = '
		<style type="text/css">
		caption { text-align:left; }
		th,td   { text-align:right; width:14%; padding-right:0.2em; }
		th      { color:gray;    border:1px solid silver;    }
		td      { color:dimgray; border:1px solid gainsboro; }
		td.nul  {                border:1px solid white;     }
		</style>

		<table>
		<caption>'.$caption.'</caption>
		<tr class="cal">
		<th abbr="Sunday">    S </th>
		<th abbr="Monday">    M </th>
		<th abbr="Tuesday">   T </th>
		<th abbr="Wednesday"> W </th>
		<th abbr="Thursday">  T </th>
		<th abbr="Friday">    F </th>
		<th abbr="Saturday">  S </th>
		</tr>
		';

	    // THE FIRST ROW MAY HAVE DAYS THAT ARE NOT PART OF THIS MONTH
	    $html .= '<tr>';
	    while ($day_counter < $first_day_number)
	    {
	        $html .= '<td class="nul">&nbsp;</td>';
   	     $day_counter++;
	    }

	    // THE DAYS OF THE MONTH
   	 $mday = 1;
	    while ($mday <= $last_day_of_month)
   	 {
	        // THE DAYS OF THE WEEK
   	     while ($day_counter < 7)
      	  {
					$x = "";
					if ($mday < 10) {
						$x = "0";
					}
					$day = $the_year.$the_month.$x.$mday;
					$color = $this->quick_search($day);

               $html .= "<td bgcolor=$color>$mday</td>";
         	   //$html .= "<td bgcolor=green>$the_month $x$mday $the_year</td>";
	            $day_counter++;
   	         $mday++;
      	      if ($mday > $last_day_of_month) break 2;
	        }

	        $html .= '</tr>';
   	     $html .= '<tr>';
      	  $day_counter = 0;
	    }

	    // THE LAST ROW MAY HAVE DAYS THAT ARE NOT PART OF THIS MONTH
   	 while ($day_counter < 7)
	    {
   	     $html .= '<td class="nul">&nbsp;</td>';
      	  $day_counter++;
	    }

	    $html .= '</tr>';
	    $html .= '</table>';

	    return $html;
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

	public function managelodge($msg='') {
		$template = "lodge.tpl";
      $data = array();
		$data['msg'] = $msg;

		// load locations
		$output = $this->load_locations();
		$data['output'] = $output;
      $this->load_smarty($data,$template);

	}

	public function addlodge() {
      $template = "newlodge.tpl";
      $data = array();


      $this->load_smarty($data,$template);

   }

	public function savelodge() {
		$sql = "INSERT INTO `locations` (`name`,`min_night_stay`,`agent_email`) VALUES ('$_POST[name]','$_POST[min_night_stay]','$_POST[agent_email]')";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$this->managelodge('<font color=green>The location was saved.</font><br>');
		} else {
			$this->error();
		}
	}

	public function editlodge() {

		$sql = "SELECT * FROM `locations` WHERE `id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		$data = array();
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
      $template = "editlodge.tpl";
      $this->load_smarty($data,$template);

	}

	public function updatelodge() {
	
		if ($_POST['active'] == "") {
			$_POST['active'] = "No";
		}
		if ($_POST['auto_inventory'] == "") {
			$_POST['auto_inventory'] = "Off";
		}
	
		$sql = "UPDATE `locations` SET `name` = '$_POST[name]', `min_night_stay` = '$_POST[min_night_stay]', `agent_email` = '$_POST[agent_email]', `active` = '$_POST[active]', `inventory_start_date` = '$_POST[inventory_start_date]',
		`auto_inventory` = '$_POST[auto_inventory]'  WHERE `id` = '$_POST[id]'";
		$result = $this->new_mysql($sql);
      if ($result == "TRUE") {
         $this->managelodge('<font color=green>The location was updated.</font><br>');
      } else {
         $this->error();
      }
	}

	private function load_locations() {
		$sql = "SELECT * FROM `locations` ORDER BY `active` ASC, `name` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$output .= "<tr><td>$row[name]</td><td>$row[active]</td><td>
			<input type=\"button\" value=\"Edit\" class=\"btn btn-primary\" onclick=\"document.location.href='editlodge/$row[id]'\">&nbsp;
			<input type=\"button\" value=\"Rooms\" class=\"btn btn-warning\" onclick=\"document.location.href='managerooms/$row[id]'\">

		</td></tr>";
		}
		return $output;
	}

	public function managerooms() {
		$sql = "SELECT `name` FROM `locations` WHERE `id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$name = $row['name'];
		}

		$template = "managerooms.tpl";
		$data = array();
		$data['name'] = $name;
		$data['id'] = $_GET['id'];
      $data['output'] = $this->listrooms($_GET['id']);

      $this->load_smarty($data,$template);

	}

	public function newroom() {
      $sql = "SELECT `name` FROM `locations` WHERE `id` = '$_GET[id]'";
      $result = $this->new_mysql($sql);
      while ($row = $result->fetch_assoc()) {
         $name = $row['name'];
      }

      $template = "newroom.tpl";
      $data = array();
      $data['name'] = $name;
      $data['id'] = $_GET['id'];

      $this->load_smarty($data,$template);
	}

	public function editroom() {
      $data = array();
      $sql = "SELECT `name` FROM `locations` WHERE `id` = '$_GET[id2]'";
      $result = $this->new_mysql($sql);
      while ($row = $result->fetch_assoc()) {
         $name = $row['name'];
      }  
		$sql = "SELECT * FROM `rooms` WHERE `id` = '$_GET[id]'";
      $result = $this->new_mysql($sql);
      while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
      
      $template = "editroom.tpl";
      $data['name'] = $name;
      $data['id'] = $_GET['id'];
		$data['id2'] = $_GET['id2'];

      $this->load_smarty($data,$template);


	}

	public function updateroom() {
		if ($_POST['delete'] == "checked") {
			$sql = "DELETE FROM `rooms` WHERE `id` = '$_POST[id]'";
		} else {
			$sql = "UPDATE `rooms` SET `description` = '$_POST[description]', `min_pax` = '$_POST[min_pax]', `beds` = '$_POST[beds]', `nightly_rate` = '$_POST[nightly_rate]' WHERE `id` = '$_POST[id]'";
		}
      $result = $this->new_mysql($sql);
      if ($result == "TRUE") {
         $_GET['id'] = $_POST['id2'];
         $sql = "SELECT `name` FROM `locations` WHERE `id` = '$_GET[id]'";
         $result = $this->new_mysql($sql);
         while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
         }

         $template = "managerooms.tpl";
         $data = array();
         $data['name'] = $name;
         $data['id'] = $_GET['id'];
         $data['output'] = $this->listrooms($_GET['id']);
         $data['msg'] = "<br><font color=green>The room was updated.</font><br>";
         $this->load_smarty($data,$template);
      } else {
         $this->error();
      }

	}

	public function saveroom() {
		$sql = "INSERT INTO `rooms` (`locationID`,`description`,`min_pax`,`beds`,`nightly_rate`) VALUES ('$_POST[id]','$_POST[description]','$_POST[min_pax]','$_POST[beds]','$_POST[nightly_rate]')";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$_GET['id'] = $_POST['id'];
	      $sql = "SELECT `name` FROM `locations` WHERE `id` = '$_GET[id]'";
	      $result = $this->new_mysql($sql);
   	   while ($row = $result->fetch_assoc()) {
      	   $name = $row['name'];
	      }

	      $template = "managerooms.tpl";
   	   $data = array();
      	$data['name'] = $name;
	      $data['id'] = $_GET['id'];
			$data['output'] = $this->listrooms($_GET['id']);
			$data['msg'] = "<br><font color=green>The room was added.</font><br>";
	      $this->load_smarty($data,$template);
		} else {
         $this->error();
		}
	}

	public function listrooms($id) {
		$sql = "SELECT * FROM `rooms` WHERE `locationID` = '$id'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$output .= "<tr><td>$row[description]</td><td>$row[beds]</td><td>$row[min_pax]</td><td>$row[nightly_rate]</td><td><input type=\"button\" class=\"btn btn-primary\" value=\"Edit\" onclick=\"document.location.href='editroom/$row[id]/$id'\"></td></tr>";
			for ($i=0; $i < $row['beds']; $i++) {
				switch ($i) {
					case "0":
					$loc = "A";
					break;

					case "1":
					$loc = "B";
					break;

					default:
					$loc = "Unknown";
					break;
				}
				$output .= "<tr><td>&nbsp;</td><td colspan=4><i class=\"fa fa-bed\"></i> Bed $loc</td></tr>";
			}
		}
		return $output;
	}

	public function users() {
		$template = "users.tpl";
		$data = array();

		$data['output'] = $this->list_users(); // gets data

		$this->load_smarty($data,$template);

	}

	public function list_users() {
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
      $template = "addnewuser.tpl";
      $data = array();
      $this->load_smarty($data,$template);
	}

	public function saveuser() {
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
