<?php

include $GLOBAL['path']."/class/resellers.class.php";


class admin extends resellers {

	public function savepermissions() {
		$sql = "SELECT * FROM `whitelist`";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$perm = "";

			// admin
			$i = "admin";
			$i .= $row['id'];
			$admin = $_POST[$i];
			if ($admin == "checked") {
				$perm .= "admin,";
			}

			// agent
			$i = "agent";
			$i .= $row['id'];
			$agent = $_POST[$i];
			if ($agent == "checked") {
				$perm .= "agent,";
			}

			// accounting
			$i = "accounting";
			$i .= $row['id'];
			$accounting = $_POST[$i];
			if ($accounting == "checked") {
				$perm .= "accounting,";
			}

			// clear end
			$perm = substr($perm,0,-1);

			$i = "description";
			$i .= $row['id'];
			$description = $_POST[$i];

			$sql = "UPDATE `whitelist` SET `access` = '$perm', `description` = '$description' WHERE `id` = '$row[id]'";
			print "SQL:<br>$sql<hr>";
		}
	}

	public function permissions() {
		$sql = "SELECT * FROM `whitelist`";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {

			$c1 = "";
			$c2 = "";
			$c3 = "";

			if (preg_match("/admin/i",$row['access'])) {
				$c1 = "checked";
			}
			if (preg_match("/agent/i",$row['access'])) {
				$c2 = "checked";
			}
			if (preg_match("/accounting/i",$row['access'])) {
				$c3 = "checked";
			}

			$html .= "<tr>
			<td>$row[method]</td>
			<td>
			<input type=\"checkbox\" name=\"admin$row[id]\" value=\"checked\" $c1> Admin&nbsp;&nbsp;
			<input type=\"checkbox\" name=\"agent$row[id]\" value=\"checked\" $c2> Agent&nbsp;&nbsp; 
			<input type=\"checkbox\" name=\"accounting$row[id]\" value=\"checked\" $c3> Accounting&nbsp;&nbsp;
			</td>
			</tr>
			<tr><td colspan=2><textarea name=\"description$row[id]\" cols=80 rows=2 placeholder=\"Description\">$row[description]</textarea><hr></td>
			</tr>
			";
		}
		$template = "permissions.tpl";
		$data['data'] = $html;
		$this->load_smarty($data,$template);
		
	}

	public function lodge($msg='') {
		// alias to managelodge
		$this->managelodge($msg);
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
		$sql = "UPDATE `locations` SET `name` = '$_POST[name]', `min_night_stay` = '$_POST[min_night_stay]', `agent_email` = '$_POST[agent_email]', `active` = '$_POST[active]', `inventory_start_date` = 
		'$_POST[inventory_start_date]', `auto_inventory` = '$_POST[auto_inventory]',`inventory_stop_date` = '$_POST[inventory_stop_date]'  WHERE `id` = '$_POST[id]'";
		$result = $this->new_mysql($sql);
      	if ($result == "TRUE") {
        	$this->managelodge('<font color=green>The location was updated.</font><br>');
      	} else {
        	$this->error();
      	}
	}

	public function load_locations() {
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

		$sql = "SELECT `type`,`id` FROM `roomtype` ORDER BY `type` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $type) {
				$opt .= "<option selected value=\"$row[id]\">$row[type]</option>";
			} else {
				$opt .= "<option value=\"$row[id]\">$row[type]</option>";
			}
		}

		$data['opt'] = $opt;
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
			$type = $row['type'];
		}

		if ($type == "0") {
			$opt .= "<option selected value=\"\">--Select--</option>";
		}
		$sql = "SELECT `type`,`id` FROM `roomtype` ORDER BY `type` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $type) {
				$opt .= "<option selected value=\"$row[id]\">$row[type]</option>";
			} else {
				$opt .= "<option value=\"$row[id]\">$row[type]</option>";
			}
		}

        $template = "editroom.tpl";
      	$data['name'] = $name;
      	$data['id'] = $_GET['id'];
		$data['id2'] = $_GET['id2'];
		$data['opt'] = $opt;
	    $this->load_smarty($data,$template);
	}

	public function updateroom() {
		if ($_POST['delete'] == "checked") {
			$sql = "DELETE FROM `rooms` WHERE `id` = '$_POST[id]'";
		} else {
			$sql = "UPDATE `rooms` SET `description` = '$_POST[description]', `beds` = '$_POST[beds]', `children` = '$_POST[children]', 
			`writeup` = '$_POST[writeup]', `type` = '$_POST[type]',
			`nightly_rate` = '$_POST[nightly_rate]' WHERE `id` = '$_POST[id]'";
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
		$sql = "INSERT INTO `rooms` (`locationID`,`description`,`beds`,`children`,`nightly_rate`,`type`,`writeup`) 
		VALUES ('$_POST[id]','$_POST[description]','$_POST[beds]','$_POST[children]','$_POST[nightly_rate]','$_POST[type]','$_POST[writeup]')";
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
			$output .= "<tr><td>$row[description]</td><td>$row[beds]</td><td>$row[children]</td><td>$$row[nightly_rate]</td><td><input type=\"button\" class=\"btn btn-primary\" 
			value=\"Edit\" onclick=\"document.location.href='editroom/$row[id]/$id'\"></td></tr>";
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
			<input type=\"button\" value=\"Delete\" onclick=\"if(confirm('You are about to delete $row[first] $row[last]. Click OK to delete the user or Cancel to abort.'))
			{document.location.href='deleteuser/$row[id]';}\" class=\"btn btn-danger\">
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
		UPDATE `users` SET `first` = '$_POST[first]', `last` = '$_POST[last]', `email` = '$_POST[email]', `uupass` = '$_POST[uupass]', `userType` = '$_POST[userType]', `active` = '$_POST[active]' 
		WHERE `id` = '$_POST[id]'
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
		$sql = "INSERT INTO `users` (`first`,`last`,`email`,`uuname`,`uupass`,`userType`,`active`,`date_created`) VALUES ('$_POST[first]','$_POST[last]','$_POST[email]','$_POST[uuname]',
		'$_POST[uupass]','$_POST[userType]','Yes','$today')";
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

	public function get_rates($roomID) {
		$sql = "SELECT `nightly_rate` FROM `rooms` WHERE `id` = '$roomID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$nightly_rate = $row['nightly_rate'];
		}
		return $nightly_rate;
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

		$child_map[0] = "Child1";
		$child_map[1] = "Child2";

		// Create inventory
		$sql = "SELECT * FROM `rooms` WHERE `locationID` = '$locationID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			for ($i=0; $i < $days; $i++) {
				$nightly_rate = $this->get_rates($row['id']);

				$sql2 = "INSERT INTO `inventory` (`locationID`,`roomID`,`date_code`,`nightly_rate`) VALUES ('$locationID','$row[id]','$end_date[$i]','$nightly_rate')";
				$sql3 = "SELECT * FROM `inventory` WHERE `locationID` = '$locationID' AND `roomID` = '$row[id]' AND `date_code` = '$end_date[$i]'";
				$result3 = $this->new_mysql($sql3);
				$test = "";
				$test = $result3->num_rows;
				if ($test == "") {
					// create inventory
					$result2 = $this->new_mysql($sql2);
					$inventoryID = $this->linkID->insert_id;
					// Adults
		         	for ($i2 = 0; $i2 < $row['beds']; $i2++) {
						$sql4 = "INSERT INTO `beds` (`inventoryID`,`status`,`name`,`type`) VALUES ('$inventoryID','avail','$bed_map[$i2]','adult')";
						$result4 = $this->new_mysql($sql4);
		         	}
					//Child
               		for ($i2 = 0; $i2 < $row['children']; $i2++) {
                  		$sql4 = "INSERT INTO `beds` (`inventoryID`,`status`,`name`,`type`) VALUES ('$inventoryID','avail','$child_map[$i2]','child')";
                  		$result4 = $this->new_mysql($sql4);
               		}
				}
			}
		}
		return "1";	
	}

	public function roomtypes() {
		$template = "roomtypes.tpl";
		$data['html'] = $this->list_room_types();
		$this->load_smarty($data,$template);
	}

	private function list_room_types() {
		// output the room types
		$sql = "SELECT * FROM `roomtype` ORDER BY `type` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td colspan=2><input type=\"text\" name=\"type_$row[id]\" value=\"$row[type]\" size=\"20\"></td></tr>";
			$found = "1";
		}
		if ($found == "1") {
			$html .= "<tr><td colspan=2><input type=\"submit\" value=\"Update\" class=\"btn btn-primary\"></td></tr>";
		}
		return $html;
	}

	public function saveroomtypes() {
		// update
		$sql = "SELECT * FROM `roomtype` ORDER BY `type` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$i = "type_";
			$i .= $row['id'];
			$type = $_POST[$i];
			$sql2 = "UPDATE `roomtype` SET `type` = '$type' WHERE `id` = '$row[id]'";
			$result2 = $this->new_mysql($sql2);
		}

		// insert new
		if ($_POST['roomtype'] != "") {
			$sql = "INSERT INTO `roomtype` (`type`) VALUES ('$_POST[roomtype]')";
			$result = $this->new_mysql($sql);
		}

		$data['msg'] = "<font color=green>The room types was updated.</font><br>";
		$template = "roomtypes.tpl";
		$data['html'] = $this->list_room_types();
		$this->load_smarty($data,$template);

	}

	public function line_items() {
		$template = "line_items.tpl";
		$data['html'] = $this->list_line_items();
		$this->load_smarty($data,$template);
	}

	private function list_line_items() {
		$sql = "SELECT * FROM `line_items` li ORDER BY `title` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>$row[title]</td><td>$$row[price]</td><td>
				<input type=\"button\" value=\"Edit\" class=\"btn btn-primary\" onclick=\"document.location.href='editlineitem/$row[id]'\">
				<input type=\"button\" value=\"Delete\" class=\"btn btn-danger\" onclick=\"document.location.href='deletelineitem/$row[id]'\">
				</td></tr>";
			$found = "1";
		}
		if ($found != "1") {
			$html .= "<tr><td colspan=3><font color=blue>There are no line items defined.</font></td></tr>";
		}
		return $html;
	}

	public function deletelineitem() {
		// check if already on a record
		$sql = "SELECT `line_item_id` FROM `line_item_billing` WHERE `line_item_id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$err = "1";
		}
		if ($err == "1") {
			$template = "line_items.tpl";
			$data['html'] = $this->list_line_items();
			$data['msg'] = "<font color=red>The line item can not be deleted because it is in use with a guest.</font>";
			$this->load_smarty($data,$template);
		} else {
			$sql = "DELETE FROM `line_items` WHERE `id` = '$_GET[id]'";
			$result = $this->new_mysql($sql);
			if ($result == "TRUE") {
				$data['msg'] = "<font color=green>The line item was deleted.</font>";	
			} else {
				$data['msg'] = "<font color=red>The line item failed to delete.</font>";
			}
			$data['html'] = $this->list_line_items();
			$template = "line_items.tpl";
			$this->load_smarty($data,$template);
		}

	}

	public function editlineitem() {
		$sql = "SELECT * FROM `line_items` WHERE `id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$template = "editlineitem.tpl";
		$this->load_smarty($data,$template);
	}

	public function updatelineitem() {
		$sql = "UPDATE `line_items` SET `title` = '$_POST[title]', `description` = '$_POST[description]', `price` = '$_POST[price]' WHERE `id` = '$_POST[id]'";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The line item was updated.</font>";	
		} else {
			$data['msg'] = "<font color=red>The line item failed to update.</font>";
		}
		$data['html'] = $this->list_line_items();
		$template = "line_items.tpl";
		$this->load_smarty($data,$template);
	}

	public function newlineitem() {
		$template = "newlineitem.tpl";
		$this->load_smarty($null,$template);
	}

	public function savelineitem() {
		$sql = "INSERT INTO `line_items` (`title`,`description`,`price`,`date_added`,`date_updated`,`userID`) VALUES
		('$_POST[title]','$_POST[description]','$_POST[price]','$today','$today','$_SESSION[id]')
		";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The line item was added.</font>";
		} else {
			$data['msg'] = "<font color=red>The line item failed to add.</font>";
		}
		$template = "line_items.tpl";
		$data['html'] = $this->list_line_items();
		$this->load_smarty($data,$template);
	}

	public function discounts() {
		$template = "discounts.tpl";
		$data['html'] = $this->list_discounts();
		$this->load_smarty($data,$template);
	}

	private function list_discounts() {
		$sql = "SELECT * FROM `general_discount_reason` ORDER BY `reason` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>$row[reason]</td><td>$row[show]</td><td>
			<input type=\"button\" value=\"Edit\" class=\"btn btn-primary\" onclick=\"document.location.href='editdiscount/$row[id]'\">
			</td></tr>";
		}
		return $html;
	}

	public function newdiscount() {
		$template = "newdiscount.tpl";
		$this->load_smarty($null,$template);
	}

	public function savenewdiscount() {
		$sql = "INSERT INTO `general_discount_reason` (`reason`,`show`) VALUES ('$_POST[reason]','Yes')";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The discount was added.</font>";
		} else {
			$data['msg'] = "<font color=red>The discount failed to add.</font>";
		}
		$data['html'] = $this->list_discounts();
		$template = "discounts.tpl";
		$this->load_smarty($data,$template);
	}

	public function editdiscount() {
		$sql = "SELECT * FROM `general_discount_reason` WHERE `id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$template = "editdiscount.tpl";
		$this->load_smarty($data,$template);
	}

	public function updatediscount() {
		$sql = "UPDATE `general_discount_reason` SET `reason` = '$_POST[reason]' , `show` = '$_POST[show]' WHERE `id` = '$_POST[id]'";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The discount was updated.</font>";
		} else {
			$data['msg'] = "<font color=red>The discount failed to update.</font>";
		}
		$data['html'] = $this->list_discounts();
		$template = "discounts.tpl";
		$this->load_smarty($data,$template);
	}



// end class
}