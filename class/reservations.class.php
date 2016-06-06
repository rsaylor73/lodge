<?php
include $GLOBAL['path']."/class/money.class.php";

class reservations extends money {

	public function newreservation() {


      	$template = "newreservation.tpl";
      	$data = array();
      	$data['msg'] = $msg;
      	//if ($_POST['lodge'] != "") {
			$options = "<option value=\"\" selected>Select Lodge</option>";
		//}

		$sql = "SELECT `id`,`name` FROM `locations` WHERE `active` = 'Yes'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $_POST['lodge']) {
				$s = "selected";
			} else {
				$s = "";
			}
			$options .= "<option $s value=\"$row[id]\">$row[name]</option>";
		}
		$data['lodge'] = $options;

		for ($i=1; $i < 30; $i++) {
			if ($i == $_POST['pax']) {
				$s2 = "selected";
			} else {
				$s2 = "";
			}
			$pax .= "<option $s2 value=\"$i\">$i</option>";
		}
		$data['pax'] = $pax;

		// send GET data
		$data['post_pax'] = $_POST['pax'];
		$data['post_start_date'] = $_POST['start_date'];
		$data['post_children'] = $_POST['children'];
		$data['post_tents'] = $_POST['tents2'];
		$data['post_nights'] = $_POST['nights'];
		$data['childage1'] = $_POST['childage1_form'];
		$data['childage2'] = $_POST['childage2_form'];


		$sql = "SELECT * FROM `roomtype` ORDER BY `type` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $_POST['type']) {
				$type .= "<option selected value=\"$row[id]\">$row[type]</option>";
			} else {
				$type .= "<option value=\"$row[id]\">$row[type]</option>";
			}
		}
		$data['type'] = $type;
	    $this->load_smarty($data,$template);
	}

	public function quick_search($day) {

		if ($_POST['type'] != "") {
			$type = "AND `r`.`type` = '$_POST[type]'";
		}


		$sql = "
		SELECT 
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds'

		FROM 
			`inventory` i, `rooms` r

		LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'


		WHERE 
			`i`.`locationID` = '$_POST[lodge]' 
			AND `i`.`date_code` BETWEEN '$day' AND '$day'
			AND `i`.`roomID` = `r`.`id`
			$type

		HAVING 
			total_adult_beds >= '$_POST[pax]' AND total_child_beds >= '$_POST[children]'

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

		/*
		print "<pre>";
		print_r($_POST);
		print "</pre>";
		*/

		$start_date = str_replace("-","",$_POST['start_date']);
		$end_date = str_replace("-","",$_POST['end_date']);

		$sql = "SELECT `name`,`min_night_stay` FROM `locations` WHERE `id` = '$_POST[lodge]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$data['name'] = $row['name'];
			$data['min_night_stay'] = $row['min_night_stay'];
		}

		if ($_POST['type'] != "") {
			$type = "AND `r`.`type` = '$_POST[type]'";
		}

		$pax = $_POST['pax'] * $_POST['tents'];

		$sql = "
		SELECT 
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds'

		FROM 
			`inventory` i

		LEFT JOIN `beds` a ON 
			`i`.`inventoryID` = `a`.`inventoryID` 
			AND `a`.`type` = 'adult' 
			AND `a`.`status` = 'avail'

		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'


		WHERE 
			`i`.`locationID` = '$_POST[lodge]' 
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date' 

		HAVING 
			total_adult_beds >= '$pax' AND total_child_beds >= '$_POST[children]'
		";

		$result = $this->new_mysql($sql);

		print "<h2>Calendar Day Snapshot</h2>";

		while ($row = $result->fetch_assoc()) {
			$found = "1";
			// build calendar to show # rooms available for each day
	     	//$this->load_smarty($data,'reservations_header.tpl');

			$months = $this->getMonthsInRange($_POST['start_date'],$_POST['end_date']);

			print "<table class=\"table\">
			<tr>";
			foreach ($months as $key=>$value) {
					$counter++;
					$year = $value['year'];
					$month = $value['month'];

					echo "<td>" . $this->calendar_table("$month $year") . "</td>";
					if ($counter > 2) {
						print "</tr><tr>";
						$counter = "0";
				}
			}
			print "</tr></table>";

			print '
			</div>
			';

			// end ajax
         	//$this->load_smarty($null,'reservations_footer.tpl');
		}
	}

	public function get_tent_data($day) {
    	$sql = "
      	SELECT
        	`inventory`.`inventoryID`,
        	`rooms`.`description`,
        	`rooms`.`beds`,
        	`rooms`.`nightly_rate`,
        	`beds`.`name`,
        	`beds`.`bedID`,
        	DATE_FORMAT(`inventory`.`date_code`, '%m/%d/%Y') AS 'date',
			`beds`.`status`

      	FROM
        	`inventory`,`beds`,`rooms`

      	WHERE
        	`inventory`.`locationID` = '$_GET[lodge]'
        	AND `inventory`.`date_code` = '$day'
        	AND `inventory`.`inventoryID` = `beds`.`inventoryID`
        	AND `inventory`.`roomID` = `rooms`.`id`
		";

      	$result = $this->new_mysql($sql);
      	while ($row = $result->fetch_assoc()) {
        	if ($row['min_pax'] == "1") {
            	$guest = "<font color=blue><b>S</b></font>";
         	} else {
            	$guest = "<font color=green><b>C</b></font>";
         	}
			if ($row['status'] != "avail") {
            	$html .= "<tr><td>$row[description]</td><td><i class=\"fa fa-bed\"></i> $row[name]</td><td><i class=\"fa fa-user\"></i> $guest</td><td>$$row[nightly_rate]</td>
            	<td><center><i class=\"fa fa-exclamation-triangle text-danger\"><br>Sold Out</i></center></td></tr>
            	";	
			} else {
	        	$html .= "<tr><td>$row[description]</td><td><i class=\"fa fa-bed\"></i> $row[name]</td><td><i class=\"fa fa-user\"></i> $guest</td><td>$$row[nightly_rate]</td>
   	      		<td><input data-toggle=\"toggle\" name=\"book_$row[bedID]\" type=\"checkbox\" value=\"On\"></td></tr>
      	   		";
			}
			$date = $row['date'];
      	}
		$data[0] = $html;
		$data[1] = $date;
		return $data;
	}

	public function generate_reservationID() {
		$today = date("Ymd");
		$sql = "INSERT INTO `reservations` (`date_created`,`userID`,`active`) VALUES ('$today','$_SESSION[id]','Yes')";
		$result = $this->new_mysql($sql);
		$reservationID = $this->linkID->insert_id;
		return $reservationID;
	}

	public function togglebeds() {
		$ok = "0";
		$fail = "0";

		if ($_SESSION['reservationID'] == "") {
			// get new reservation
			$reservationID = $this->generate_reservationID();
			$_SESSION['reservationID'] = $reservationID;
		}

		foreach ($_POST as $key=>$value) {
			if (preg_match("/^book/i",$key)) {
				$bookID = substr($key,5);
				$sql = "UPDATE `beds` SET `reservationID` = '$_SESSION[reservationID]', `status` = 'agent_hold' WHERE `bedID` = '$bookID'";
				$result = $this->new_mysql($sql);
				if ($result == "TRUE") {
					$ok++;
				} else {
					$fail++;
				}
			}
		}

		$template = "tentbooked.tpl";
		$data['ok'] = $ok;
		$data['fail'] = $fail;
		$data['lodge'] = $_POST['lodge'];
		$data['pax'] = $_POST['pax'];
		$data['start_date'] = $_POST['start_date'];
		$data['end_date'] = $_POST['end_date'];
		$data['reservationID'] = $_SESSION['reservationID'];

      	$this->load_smarty($data,$template);
	}

	public function child_age_map($value) {
		switch ($value) {
			case "1":
			$display = "0-6 years";
			break;
			case "2":
			$display = "7-15 years";
			break;
			case "3":
			$display = "16+ years";
			break;
		}
		return $display;
	}

	public function child_age_fee($value) {
		switch ($value) {
			case "1":
				$fee = "0"; // 0%
			break;

			case "2":
				$fee = "2"; // 50%
			break;

			case "3":
				$fee = "1"; // 100%
			break;
		}
		return $fee;
	}

	private function movetent() {
		$reservationID = $_GET['reservationID'];

		$sql = "SELECT `child1_age`,`child2_age` FROM `reservations` WHERE `reservationID` = '$reservationID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$child1_age = $row['child1_age'];
			$child2_age = $row['child2_age'];
		}	

		// get data from reservation
		$start_date = $this->get_reservation_dates($reservationID,'ASC','reports');
		$end_date 	= $this->get_reservation_dates($reservationID,'DESC','reports');
		$nights		= $this->get_reservation_nights($reservationID);
		//$nights2 	= $nights - 1;
		$end_date2 	= date("Ymd", strtotime($start_date ."+ $nights days"));

		$sql = "
		SELECT
			`b`.`name`,
			`i`.`locationID`

		FROM
			`reservations` r,
			`beds` b,
			`inventory` i

		WHERE
			`r`.`reservationID` = '$reservationID'
			AND `b`.`reservationID` = `r`.`reservationID`
			AND `b`.`inventoryID` = `i`.`inventoryID`

		GROUP BY `b`.`name`
		";
		$adults = "0";
		$children = "0";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$locationID = $row['locationID'];
			if (($row['name'] != "Child1") && ($row['name'] != "Child2")) {
				$adults++;
			}
			if (($row['name'] == "Child1") or ($row['name'] == "Child2")) {
				$children++;
			}
		}


    	$template = "move.tpl";
      	$data = array();
		
		if ($children == "0") {
			//
			$child_sql = "AND total_child_beds = '0'";
		} else {
			$child_sql = "AND total_child_beds >= '$children'";
		}

		$sql = "
		SELECT
			`r`.`id`,
			`r`.`description`,
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds',
			`r`.`nightly_rate`,
			`r`.`beds` AS 'adult',
			`r`.`children`,
			`a`.`status` AS 'adult_status',
			`c`.`status` AS 'child_status'

		FROM
			`inventory` i, `rooms` r

		LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'

		WHERE
			`i`.`locationID` = '$locationID' 
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
			AND `i`.`roomID` = `r`.`id`
			$type

		GROUP BY `r`.`description`

		HAVING total_adult_beds >= '$adults' $child_sql
		";

		$data['nights'] = $nights;
		$data['adults'] = $adults;
		$data['children'] = $children;
		$data['start_date2'] = date("m/d/Y",strtotime($start_date));
		$data['end_date2'] = date("m/d/Y",strtotime($end_date2));
		$data['tents'] = '1';
		$data['reservationID'] = $reservationID;
		$data['lodge'] = $locationID;
		$data['start_date'] = $start_date;
		$data['pax'] = $adults;
		$data['tentID'] = $_GET['tentID'];
		$data['childage1'] = $this->child_age_map($child1_age);
		$data['childage2'] = $this->child_age_map($child2_age);
		$data['childage1_form'] = $child1_age;
		$data['childage2_form'] = $child2_age;

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['adult_status'] == "avail") {
				$total = $row['nightly_rate'] * $nights;

				if ($_POST['childage1'] != "") {
					$fee = $this->child_age_fee($_POST['childage1']);
					$child_fee = (($row['nightly_rate'] / 2) / $fee) * $nights;
				}
				$total = $total + $child_fee;

				if ($_POST['childage2'] != "") {
					$fee = $this->child_age_fee($_POST['childage2']);
					$child_fee = (($row['nightly_rate'] / 2) / $fee) * $nights;
				}
				$total = $total + $child_fee;


				$html .= "<tr><td>$row[description]</td><td>$$total</td><td>$row[adult]</td><td>$row[children]</td><td> 
				<input data-toggle=\"toggle\" name=\"roomID$row[id]\" type=\"checkbox\" value=\"On\" onchange=\"checkboxes()\">
				</td></tr>";	
				$found = "1";
				$counter++;
			}
		}

		if ($counter < $_POST['tents']) {
			$data['msg'] = "<br><font color=red>Sorry, you indicated you need <b>$_POST[tents]</b> tents but only $counter tents are available.</font><br>";
			$stop = "1";
		}

		if ($found != "1") {
			$data['msg'] = "<br><font color=red>Sorry, there are no rooms available for the duration and number of guests you have selected.</font><br>";
		}

		if ($stop != "1") {
			$data['btn'] = "<div id=\"booknow\" style=\"display:none\"><input type=\"submit\" value=\"Move Tent\" class=\"btn btn-success\"></div>";
		}

		$data['html'] = $html;

	    $this->load_smarty($data,$template);

	}

	public function movenow() {

		foreach ($_POST as $key=>$value) {
			if (preg_match("/roomID/i",$key)) {
				$roomID = str_replace('roomID','',$key);
			}
		}

		$sql = "
		SELECT
			`i`.*,
			`b`.*

		FROM
			`beds` b,
			`inventory` i

		WHERE
			`b`.`reservationID` = '$_POST[reservationID]'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`roomID` = '$_POST[tentID]'

		ORDER BY `i`.`date_code` ASC
		";

		// get data from old tent
		$cid = array();

		$counter = "0";
		$dates = array();
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$counter++;
			$dates[] = $row['date_code'];
			$name = $row['name'];
			$cid[$name] = $row['contactID'];
		}

		$start_date = reset($dates);
		$end_date = end($dates);

		$sql = "
		SELECT
			`i`.*,
			`b`.*

		FROM
			`beds` b,
			`inventory` i

		WHERE
			`b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
			AND `i`.`roomID` = '$roomID'
			AND `b`.`reservationID` = ''
			AND `b`.`status` = 'avail'

		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$counter2++;

		}
		if (($counter > 0) && ($counter == $counter2)) {
			//print "Looks good!<br>";
			// Update new inventory

			$sql2 = "
			UPDATE `beds`,`inventory`

			SET
				`beds`.`reservationID` = '$_POST[reservationID]',
				`beds`.`status` = 'booked',
				`beds`.`contactID` = CASE
					WHEN `beds`.`name` = 'A' THEN '".$cid['A']."'
					WHEN `beds`.`name` = 'B' THEN '".$cid['B']."'
					WHEN `beds`.`name` = 'Child1' THEN '".$cid['Child1']."'
					WHEN `beds`.`name` = 'Child2' THEN '".$cid['Child2']."'
				END

			WHERE
				`beds`.`inventoryID` = `inventory`.`inventoryID`
				AND `inventory`.`date_code` BETWEEN '$start_date' AND '$end_date'
				AND `inventory`.`roomID` = '$roomID'
				AND `beds`.`reservationID` = ''
				AND `beds`.`status` = 'avail'
			";

			$result2 = $this->new_mysql($sql2);

			$sql3 = "
			UPDATE `beds`,`inventory`

			SET
				`beds`.`reservationID` = '',
				`beds`.`status` = 'avail',
				`beds`.`contactID` = ''

			WHERE
			`beds`.`reservationID` = '$_POST[reservationID]'
			AND `beds`.`inventoryID` = `inventory`.`inventoryID`
			AND `inventory`.`roomID` = '$_POST[tentID]'
			";
			$result3 = $this->new_mysql($sql3);
			$data['reservationID'] = $_POST['reservationID'];
			$data['msg'] = "<br><font color=green>The tent was successfully moved.</font><br>";
			$template = "movenowsuccess.tpl";
			$this->load_smarty($data,$template);



		} else {
			$template = "error.tpl";
			$data['msg'] = "<font color=red>The inventory you wanted to move to is no longer available.</font><br><br>";
			$this->load_smarty($data,$template);
		}

	}

	public function viewtent() {

		$nights2 = $_POST['nights'] - 1;
		$nights = $_POST['nights'];

		$start_date = str_replace("-","",$_POST['start_date']);
		$end_date = date("Ymd", strtotime($start_date ."+ $nights2 days"));

		$nights2 = $_POST['nights'];
		$end_date2 = date("Ymd", strtotime($start_date ."+ $nights2 days"));


    	$template = "viewtent.tpl";
      	$data = array();
		foreach ($_POST as $key=>$value) {
			$form_html .= "<input type=\"hidden\" name=\"$key\" value=\"$value\">\n";
		}

		$data['form_html'] = $form_html;

		$adults = $_POST['pax'] * $nights;
		if ($_POST['children'] > 0) {
			$children = $_POST['children'] * $nights;
		} else {
			$children = "0";
		}

		if ($_POST['tents'] > 1) {
			$adults = $adults / $_POST['tents'];
			$children = $children / $_POST['tents'];

		}

		
		if ($_POST['children'] == "0") {
			//
			$child_sql = "AND total_child_beds = '0'";
		} else {
			$child_sql = "AND total_child_beds >= '$children'";
		}

		if ($_POST['type'] != "") {
			$type = "AND `r`.`type` = '$_POST[type]'";
		}

		$sql = "
		SELECT
			`r`.`id`,
			`r`.`description`,
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds',
			`r`.`nightly_rate`,
			`r`.`beds` AS 'adult',
			`r`.`children`,
			`a`.`status` AS 'adult_status',
			`c`.`status` AS 'child_status'

		FROM
			`inventory` i, `rooms` r

		LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'

		WHERE
			`i`.`locationID` = '$_POST[lodge]' 
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
			AND `i`.`roomID` = `r`.`id`
			$type

		GROUP BY `r`.`description`

		HAVING total_adult_beds >= '$adults' $child_sql
		";

		/*
		print "<br>SQL:<br>$sql<hr>";
		print "<pre>";
		print_r($_POST);
		print "</pre>";
		*/

		$data['nights'] = $_POST['nights'];
		$data['adults'] = $_POST['pax'];
		$data['children'] = $_POST['children'];
		$data['start_date2'] = date("m/d/Y",strtotime($start_date));
		$data['end_date2'] = date("m/d/Y",strtotime($end_date2));
		$data['tents'] = $_POST['tents'];
		$data['lodge'] = $_POST['lodge'];
		$data['start_date'] = $_POST['start_date'];
		$data['pax'] = $_POST['pax'];
		$data['type'] = $_POST['type'];
		$data['childage1'] = $this->child_age_map($_POST['childage1']);
		$data['childage2'] = $this->child_age_map($_POST['childage2']);
		$data['childage1_form'] = $_POST['childage1'];
		$data['childage2_form'] = $_POST['childage2'];


		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['adult_status'] == "avail") {
				$total = $row['nightly_rate'] * $nights;

				if ($_POST['childage1'] != "") {
					$fee = $this->child_age_fee($_POST['childage1']);
					$child_fee = (($row['nightly_rate'] / 2) / $fee) * $nights;
				}
				$total = $total + $child_fee;

				if ($_POST['childage2'] != "") {
					$fee = $this->child_age_fee($_POST['childage2']);
					$child_fee = (($row['nightly_rate'] / 2) / $fee) * $nights;
				}
				$total = $total + $child_fee;


				$html .= "<tr><td>$row[description]</td><td>$$total</td><td>$row[adult]</td><td>$row[children]</td><td> 
				<input data-toggle=\"toggle\" name=\"roomID$row[id]\" type=\"checkbox\" value=\"On\" onchange=\"checkboxes()\">
				</td></tr>";	
				$found = "1";
				$counter++;
			}
		}

		if ($counter < $_POST['tents']) {
			$data['msg'] = "<br><font color=red>Sorry, you indicated you need <b>$_POST[tents]</b> tents but only $counter tents are available.</font><br>";
			$stop = "1";
		}

		if ($found != "1") {
			$data['msg'] = "<br><font color=red>Sorry, there are no rooms available for the duration and number of guests you have selected.</font><br>";
		}

		if ($stop != "1") {
			$data['btn'] = "<div id=\"booknow\" style=\"display:none\"><input type=\"submit\" value=\"Book Reservation\" class=\"btn btn-success\"></div>";
		}

		$data['html'] = $html;

	    $this->load_smarty($data,$template);
	}

	public function reservenow() {

		$nights2 = $_POST['nights'] - 1;

		$start_date = str_replace("-","",$_POST['start_date']);
		$end_date = date("Ymd", strtotime($start_date ."+ $nights2 days"));

		foreach ($_POST as $key=>$value) {
			if (preg_match("/roomID/i", $key)) {
				$len = strlen($key);
				$len2 = $len - 6;
				$value2 = substr($key, 6,$len2);

				$sql = "
				SELECT 
					`a`.`bedID`,
					`a`.`status`

				FROM 
					`inventory` i, `rooms` r 

				LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` 

				WHERE 
	        		`i`.`locationID` = '$_POST[lodge]' 
   	      			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
      	   			AND `i`.`roomID` = `r`.`id`
         			AND `r`.`id` = '$value2'
				";

				$result = $this->new_mysql($sql);
				while ($row = $result->fetch_assoc()) {
					if ($row['status'] != "avail") {
						$err = "1";
					}
				}
			}
		}
		if ($err != "1") {
			$reservationID = $this->generate_reservationID();
			$sql = "UPDATE `reservations` r SET `r`.`child1_age` = '$_POST[childage1_form]', `r`.`child2_age` = '$_POST[childage2_form]' WHERE `r`.`reservationID` = '$reservationID'";
			$result = $this->new_mysql($sql);
			foreach ($_POST as $key=>$value) {
				if (preg_match("/roomID/i", $key)) {
					$len = strlen($key);
					$len2 = $len - 6;
					$value2 = substr($key, 6,$len2);
					//print "Test: $value2<br>";

					$sql = "
					SELECT 
						`a`.`bedID`,
						`a`.`status`

					FROM 
						`inventory` i, `rooms` r 

					LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` 

					WHERE 
	        			`i`.`locationID` = '$_POST[lodge]' 
   	      				AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
      	   				AND `i`.`roomID` = `r`.`id`
         				AND `r`.`id` = '$value2'
					";
					$result = $this->new_mysql($sql);
					while ($row = $result->fetch_assoc()) {
						$sql3 = "UPDATE `beds` SET `reservationID` = '$reservationID', `status` = 'agent_hold' WHERE `bedID` = '$row[bedID]'";
						$result3 = $this->new_mysql($sql3);
					}
				}
			}

			print "<br><font color=green>The reservation <b>$reservationID</b> has been booked. Please wait loading...<br>Click <a href=\"reservation_dashboard/$reservationID/details\">here</a> 
			if the page does not load.<br></font>";
			print "<meta http-equiv=\"refresh\" content=\"3; url=reservation_dashboard/$reservationID/details\">";

		} else {
			print "<br><font color=red>One or more tents are no longer available. Please re-start your search.</font><br>";
			$template = "footer.tpl";
			$this->load_smarty($null,$template);
			die;
		}
	}

	public function reservenow_single() {
		/* Historic - no longer used */
    	foreach ($_POST as $key=>$value) {
       		if (preg_match("/data/i",$key)) {
            	$temp = explode("_",$key);
            	$dates[] = $temp[1];
         	}
      	}
	    asort($dates);
    	foreach ($dates as $value) {
        	$nights++;
         	$in_dates .= "'$value',";
      	}
      	$in_dates = substr($in_dates,0,-1);
      	$adults = $_POST['pax'] * $nights;
      	if ($_POST['children'] > 0) {
        	$children = $_POST['children'] * $nights;
      	} else {
        	$children = "0";
      	}

	    $sql = "
      	SELECT
        	`r`.`id`,
         	`r`.`description`,
         	COUNT(`a`.`status`) AS 'total_adult_beds',
         	COUNT(`c`.`status`) AS 'total_child_beds',
         	`r`.`nightly_rate`

      	FROM
        	`inventory` i, `rooms` r

      	LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
      	LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'

      	WHERE
        	`i`.`locationID` = '$_POST[lodge]' 
         	AND `i`.`date_code` IN($in_dates)
         	AND `i`.`roomID` = `r`.`id`
			AND `r`.`id` = '$_POST[roomID]'

      	GROUP BY `r`.`description`

      	HAVING total_adult_beds >= '$adults' AND total_child_beds >= '$children'
      	";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			// Let's get a reservation number
			$reservationID = $this->generate_reservationID();

			// Adult
			$sql2 = "
			SELECT 
				`a`.`bedID`

			FROM 
				`inventory` i, `rooms` r 

			LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail' 

			WHERE 
	        	`i`.`locationID` = '$_POST[lodge]' 
   	      		AND `i`.`date_code` IN($in_dates)
      	   		AND `i`.`roomID` = `r`.`id`
         		AND `r`.`id` = '$_POST[roomID]'
			";

			$result2 = $this->new_mysql($sql2);
         	while ($row2 = $result2->fetch_assoc()) {
				$sql3 = "UPDATE `beds` SET `reservationID` = '$reservationID', `status` = 'agent_hold' WHERE `bedID` = '$row2[bedID]'";
				$result3 = $this->new_mysql($sql3);
			}

			// Child
         	$sql2 = "
         	SELECT 
            	`c`.`bedID`

         	FROM 
            	`inventory` i, `rooms` r 
      
			LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail' 

         	WHERE 
            	`i`.`locationID` = '$_POST[lodge]' 
            	AND `i`.`date_code` IN($in_dates)
            	AND `i`.`roomID` = `r`.`id`
            	AND `r`.`id` = '$_POST[roomID]'
         	";

         	$result2 = $this->new_mysql($sql2);
				while ($row2 = $result2->fetch_assoc()) {
            	$sql3 = "UPDATE `beds` SET `reservationID` = '$reservationID', `status` = 'agent_hold' WHERE `bedID` = '$row2[bedID]'";
            	$result3 = $this->new_mysql($sql3);
         	}

			print "<br><font color=green>The reservation <b>$reservationID</b> has been booked. Please wait loading...<br>Click <a href=\"reservation_dashboard/$reservationID/details\">here</a> 
			if the page does not load.<br></font>";
			print "<meta http-equiv=\"refresh\" content=\"3; url=reservation_dashboard/$reservationID/details\">";
			$ok = "1";
		}
		if ($ok != "1") {
			print "<br><font color=red>Sorry, but the dates you selected are no longer available.</font><br>";
		}
	}

	public function completereservation() {
		$sql = "UPDATE `reservations` SET `complete` = 'Yes' WHERE `reservationID` = '$_SESSION[reservationID]'";
		$result = $this->new_mysql($sql);
		$reservationID = $_SESSION['reservationID'];
		$_SESSION['reservationID'] = "";
		$_GET['reservationID'] = $reservationID;

		print "Loading...<br>";
		print "<meta http-equiv=\"refresh\" content=\"1;url=reservation_dashboard/$reservationID\">";
	}

	public function locatereservation() {
		$template = "locatereservation.tpl";
      	$this->load_smarty($null,$template);
	}

	public function is_rsv_valid($reservationID) {
		$sql = "SELECT `reservationID` FROM `reservations` WHERE `reservationID` = '$reservationID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
		}
		if ($found != "1") {
			print "<br><font color=red>The reservation <b>$reservationID</b> is invalid.</font><br>";
			print "</div>";
			$template = "footer.tpl";
			$this->load_smarty($nul,$template);
			die;
		}
	}

	public function reservation_lookup() {
		switch($_POST['how']) {
			case "guest":
				$sql = "
				SELECT
					CONCAT(`c`.`first`,' ',`c`.`last`) AS 'contact',
					`c`.`last`,
					`c`.`contactID`,
					`b`.`reservationID`,
					DATE_FORMAT(`r`.`date_created`,'%m/%d/%Y') AS 'booked_date'

				FROM
					`reserve`.`contacts` c, `lodge_res`.`beds` b, `lodge_res`.`reservations` r

				WHERE
					CONCAT_WS(' ',`c`.`first`,`c`.`last`) LIKE '%$_POST[guest]%'
					AND `c`.`contactID` = `b`.`contactID`
					AND `b`.`reservationID` = `r`.`reservationID`

				GROUP BY `r`.`reservationID`
				";
				$headline = "<h2>Reservation By Guest</h2>";
				$string = $_POST['guest'];
			break;

			case "company":
				$sql = "
				SELECT
					`r`.`company` AS 'contact',
					`rs`.`reservationID`,
					DATE_FORMAT(`rs`.`date_created`,'%m/%d/%Y') AS 'booked_date'

				FROM
					`reserve`.`resellers` r, `lodge_res`.`reservations` rs

				WHERE
					`r`.`company` LIKE '%$_POST[company]%'
					AND `r`.`resellerID` = `rs`.`resellerID`
				";
				$headline = "<h2>Reservation By Company</h2>";
				$string = $_POST['company'];

			break;
		}

		if ($sql != "") {
			$data['headline'] = $headline;
			$data['string'] = $string;
			$result = $this->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				$html .= "<tr><td>$row[contact]</td><td><a href=\"reservation_dashboard/$row[reservationID]/details\">$row[reservationID]</a></td><td>$row[booked_date]</td></tr>";
			}
			$data['html'] = $html;
			$template = "reservation_lookup.tpl";
			$this->load_smarty($data,$template);
		} else {
			$template = "error.tpl";
			$this->load_smarty($null,$template);
		}
	}

	public function reservation_dashboard() {
		$reservationID = $_REQUEST['reservationID'];
		$this->is_rsv_valid($reservationID);
		$data['reservationID'] = $reservationID;

		if ($_REQUEST['part'] == "") {
			$data['part'] = "details";
		} else {
			$data['part'] = $_GET['part'];
		}

		$sql = "SELECT `cancelled` FROM `reservations` WHERE `reservationID` = '$reservationID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$data['cancelled'] = $row['cancelled'];
		}


		switch ($data['part']) {
			case "details":
				$array = $this->reservation_details($reservationID);
		      	$data = array_merge($data,$array);
			break;

			case "guests":
            	$array = $this->reservation_guests($reservationID);
            	$data = array_merge($data,$array);
			break;

			case "dollars":
            	$array = $this->reservation_dollars($reservationID);
            	$data = array_merge($data,$array);
			break;

			case "notes":
				$array = $this->reservation_notes($reservationID);
				$data = array_merge($data,$array);
			break;

			case "cancel":
            	$array = $this->reservation_cancel($reservationID);
            	$data = array_merge($data,$array);
			break;
		}

		$template = "reservation_dashboard.tpl";
      	$this->load_smarty($data,$template);
	}

	/*
		Each tab will use a prefix tx where x is the number of the tab so
		data is not confused with another tab
	*/

	public function reservation_details($reservationID) {
		// Tab 1

		$sql = "
		SELECT
			`u`.`first` AS 't1_first',
			`u`.`last` AS 't1_last',
			`u`.`email` AS 't1_email',
			DATE_FORMAT(`r`.`date_created`, '%m/%d/%Y') AS 't1_booked_date',
			`a`.`reseller_agentID`,
			`a`.`first`,
			`a`.`last`,
			`a`.`email`,
			`s`.`resellerID`,
			`s`.`company`,
			`s`.`commission`,
			`c`.`contactID`,
			`c`.`first`,
			`c`.`last`,
			`c`.`email`


		FROM
			`reservations` r, `users` u

		LEFT JOIN `reserve`.`reseller_agents` a ON `r`.`reseller_agentID` = `a`.`reseller_agentID`
		LEFT JOIN `reserve`.`resellers` s ON `a`.`resellerID` = `s`.`resellerID`
		LEFT JOIN `reserve`.`contacts` c ON `r`.`contactID` = `c`.`contactID`

		WHERE
			`r`.`reservationID` = '$reservationID'
			AND `r`.`userID` = `u`.`id`
		";

		$result = $this->new_mysql($sql);
		while($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
			$data['begin_date'] = $this->get_reservation_dates($reservationID,'ASC',$null);
			$data['end_date'] 	= $this->get_reservation_dates($reservationID,'DESC',$null);
			$data['nights']		= $this->get_reservation_nights($reservationID);
		}



		return $data;
	}

	public function get_reservation_dates($reservationID,$direction,$format) {
		if ($format == "") {
			$date_format = "%m/%d/%Y";
		}
		if ($format == "reports") {
			$date_format = "%Y%m%d";
		}

		if (($direction == "DESC") && ($format == "")) {
			// add 1 day to result
			$d = "DATE_FORMAT(DATE_ADD(`inventory`.`date_code`,INTERVAL 1 DAY), '".$date_format."') AS 'date'";
		} else {
			$d = "DATE_FORMAT(`inventory`.`date_code`, '".$date_format."') AS 'date'";
		}
		$sql = "
		SELECT
			`inventory`.`date_code`,
			$d

		FROM
			`beds`,`inventory`

		WHERE
			`beds`.`reservationID` = '$reservationID'
			AND `beds`.`inventoryID` = `inventory`.`inventoryID`

		GROUP BY `beds`.`inventoryID`, `inventory`.`date_code`

		ORDER BY `inventory`.`date_code` $direction LIMIT 1
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$date = $row['date'];
		}
		return $date;
	}

	public function get_reservation_nights($reservationID) {
		$sql = "
		SELECT
			`inventory`.`date_code`,
			DATE_FORMAT(`inventory`.`date_code`, '%m/%d/%Y') AS 'date'

		FROM
			`beds`,`inventory`

		WHERE
			`beds`.`reservationID` = '$reservationID'
			AND `beds`.`inventoryID` = `inventory`.`inventoryID`

		GROUP BY `inventory`.`date_code`
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$counter++;
		}
		return $counter;
	}

	public function get_reservation_tents($reservationID) {
		$sql = "
		SELECT
			`i`.*

		FROM
			`beds` b, `inventory` i
		
		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`

		GROUP BY `i`.`roomID`
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$counter++;
		}
		return $counter;
	}

    public function reservation_guests($reservationID) {
		// Tab 2
		
		$sql = "
		SELECT
			`b`.`status` 										AS 't2_status',
			`r`.`description` 									AS 't2_description',
			`b`.`name` 											AS 't2_bedname',
			DATE_FORMAT(`i`.`date_code`, '%m/%d/%Y') 			AS 't2_date',
			`c`.`contactID`										AS 't2_contactID',
			`c`.`first`											AS 't2_first',
			`c`.`middle`										AS 't2_middle',
			`c`.`last`											AS 't2_last',
			`c`.`email`											AS 't2_email',
			`i`.`roomID`

		FROM
			`beds` b, `inventory` i, `locations` l, `rooms` r


		LEFT JOIN `reserve`.`contacts` c ON `b`.`contactID` = `c`.`contactID`

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`locationID` = `l`.`id`
			AND `i`.`roomID` = `r`.`id`

		GROUP BY `t2_description`, `t2_bedname`
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {

			if ($row['t2_contactID'] == "") {
				$contact = "<input type=\"button\" value=\"Assign Contact\" class=\"btn btn-primary\" onclick=\"document.location.href='assigncontact/$reservationID/$row[t2_bedname]/$row[roomID]'\">";
			} else {
				$contact = "<a href=\"javascript:void(0)\" onclick=\"document.location.href='editcontact/$row[t2_contactID]'\"><i class=\"fa fa-pencil-square-o\"></i></a> 
				$row[t2_first] $row[t2_middle] $row[t2_last]&nbsp;&nbsp;
				<a href=\"javascript:void(0)\" onclick=\"document.location.href='assigncontact/$reservationID/$row[t2_bedname]/$row[roomID]'\"><i class=\"fa fa-wrench\"></i></a>

				";
			}

			switch($row['t2_bedname']) {
				case "Child1":
				$bed_name = "Child 1";
				break;

				case "Child2":
				$bed_name = "Child 2";
				break;

				default:
				$bed_name = $row['t2_bedname'];
				break;
			}

			$move = "";
			if ($this_tent != $row['t2_description']) {
				$move = '<a href="move/'.$reservationID.'/'.$row['roomID'].'"><i class="fa fa-arrows" aria-hidden="true"></i></a> ';
				$this_tent = $row['t2_description'];
			}

			$html .= "
			<tr>
				<td>$move</td>
				<td>$row[t2_description]</td>
				<td>$bed_name</td>
				<td>$row[t2_status]</td>
				<td>$contact</td>
			</tr>
			";
		
		}

      $data['t2_html'] = $html;
      return $data;
   	}

   	public function reservation_dollars($reservationID) {
    	$arr[] = $this->dollars($reservationID);
    	foreach ($arr as $key) {
    		foreach ($key as $key2=>$value2) {
    			$data[$key2] = $value2;
    		}
    	}
    	$data['tents'] = $this->get_reservation_tents($reservationID);

    	$total = (($data['nightly_rate'] + $data['child1_rate'] + $data['child2_rate']) * $data['nights']) * $data['tents'];

     	$data['total'] = $total;

     	$payment_history = $this->get_payment_history($reservationID);
     	$data['payment_history'] = $payment_history;
     	$discount_history = $this->get_discount_history($reservationID);
     	$data['discount_history'] = $discount_history;
     	$data['line_items'] = $this->display_line_items_in_rsv($reservationID);
     	$data['refund_transfer'] = $this->listrefundtransfers($reservationID);

     	$arr2 = $this->get_balance_due($reservationID);


     	$data['commission'] = $arr2[0];
     	$data['balance_due'] = $arr2[1];
    	//$data['test'] = "ok 3";

    	/*
    	print "<pre>";
    	print_r($data);
    	print "</pre>";
		*/

    	// test
    	$this->get_balance_due($reservationID);

      	return $data;
   	}

   	public function reservation_notes($reservationID) {
      	$this->notes($reservationID,'new');

    	//return $data;

   	}

   	public function reservation_cancel($reservationID) {
    	$sql = "
    	SELECT
    		DATE_FORMAT(`r`.`cxl_date`, '%m/%d/%Y') AS 'cxl_date',
    		`u`.`first`,
    		`u`.`last`,
    		`u`.`email`,
    		`r`.`cancelled`

    	FROM
    		`reservations` r

    	LEFT JOIN `users` u ON `r`.`cxl_user` = `u`.`id`

    	WHERE
    		`r`.`reservationID` = '$reservationID'
    	";
    	
    	$result = $this->new_mysql($sql);
    	while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
    	}

    	// get a list of tents
    	$sql = "
		SELECT
			`r`.`description`,
			`r`.`id`,
			`b`.`reservationID`

		FROM
			`beds` b, `inventory` i, `rooms` r

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`roomID` = `r`.`id`

		GROUP BY `description`
    	";
    	$result = $this->new_mysql($sql);
    	while ($row = $result->fetch_assoc()) {
    		$html .= "<tr><td>$row[description]</td><td><input type=\"button\" value=\"Cancel This Tent\" onclick=\"document.location.href='canceltent/$row[id]/$reservationID'\" class=\"btn btn-warning\"></td></tr>";
    	}
    	$data['html'] = $html;
    	$data['tents'] = $this->get_reservation_tents($reservationID);

    	$sql = "
		SELECT
			`c`.`first`,
			`c`.`last`,
			`c`.`contactID`,
			`c`.`email`,
			`r`.`description`,
			DATE_FORMAT(`cb`.`cxl_date`, '%m/%d/%Y') AS 'cxl_date',
			`cb`.`cxl_reason`

		FROM
			`cancelled_beds` cb, `inventory` i, `rooms` r

		LEFT JOIN `reserve`.`contacts` c ON `cb`.`contactID` = `c`.`contactID` 

		WHERE
			`cb`.`reservationID` = '$reservationID'
			AND `cb`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`roomID` = `r`.`id`

		GROUP BY `description`

		";
    	$result = $this->new_mysql($sql);
    	while ($row = $result->fetch_assoc()) {
    		if (($row['first'] == "") && ($row['last'] == "")) {
    			$name = "Un-assigned Contact";
    		} else {
    			$name = "<a href=\"mailto:$row[email]\">$row[first] $row[last]</a>";
    		}
    		$history .= "<tr><td>$row[cxl_date]</td><td>$row[description]</td><td>$name</td></tr><tr><td colspan=\"3\">$row[cxl_reason]<hr></td></tr>";
    		$h1 = "1";
    	}
    	if ($h1 != "1") {
    		$history = "<tr><td colspan=3>No cancellation history found.</td></tr>";
    	}
    	$data['history'] = $history;
      	return $data;
   	}


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
	    /*
	    $html  = '
		<style type="text/css">
		caption { text-align:left; }
		th,td   { text-align:right; width:14%; padding-right:0.2em; }
		th      { color:gray;    border:1px solid silver;    }
		td      { color:dimgray; border:1px solid gainsboro; }
		td.nul  {                border:1px solid white;     }
		</style>
		*/

		$html = '
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
	    while ($day_counter < $first_day_number) {
	        $html .= '<td class="nul">&nbsp;</td>';
   	     	$day_counter++;
	    }

	    // THE DAYS OF THE MONTH
   	 	$mday = 1;
	    while ($mday <= $last_day_of_month) {
	        // THE DAYS OF THE WEEK
   	     	while ($day_counter < 7){
				$x = "";
				if ($mday < 10) {
					$x = "0";
				}
				$day = $the_year.$the_month.$x.$mday;
				$color = $this->quick_search($day);

				$start_date = str_replace("-","",$_POST['start_date']);
				$end_date = str_replace("-","",$_POST['end_date']);

				if ($color == "#E0F8E0") {
                	$html .= "
					<td bgcolor=$color><label>
					$mday<br>
					</label></td>";
				} else {
               		$html .= "<td bgcolor=$color><label>$mday<br></label></td>";
				}
            	$day_counter++;
         		$mday++;
   	      		if ($mday > $last_day_of_month) break 2;
        	}
        	$html .= '</tr>';
     		$html .= '<tr>';
   	  		$day_counter = 0;
    	}

    	// THE LAST ROW MAY HAVE DAYS THAT ARE NOT PART OF THIS MONTH
 		while ($day_counter < 7) {
   	     	$html .= '<td class="nul">&nbsp;</td>';
      	  	$day_counter++;
	    }
		$html .= '</tr>';
		$html .= '</table>';
	    return $html;
	}

	function cxl_reservation() {

		$tent = $_POST['tent'];
		$reservationID = $_POST['reservationID'];

		if ($reservationID == "") {
			$template = "error.tpl";
			$this->load_smarty($null,$template);
			$this->load_smarty($null,'footer.tpl');
			die;
		}

		switch($tent) {
			case "ALL":
				$sql = "
				SELECT
					`b`.`name`,
					`b`.`reservationID`,
					`b`.`contactID`,
					`b`.`type`,
					`b`.`inventoryID`,
					`b`.`bedID`

				FROM
					`beds` b

				WHERE
					`b`.`reservationID` = '$reservationID'
				";

				$today = date("Ymd");
				$result = $this->new_mysql($sql);
				while ($row = $result->fetch_assoc()) {
					$sql2 = "
					INSERT INTO `cancelled_beds` (`cxl_date`,`cxl_user`,`cxl_reason`,`bedID`,`inventoryID`,`name`,`reservationID`,`contactID`,`type`) VALUES
					('$today','$_SESSION[id]','$_POST[reason]','$row[bedID]','$row[inventoryID]','$row[name]','$row[reservationID]','$row[contactID]','$row[type]')
					";
					$result2 = $this->new_mysql($sql2);
					if ($result2 == "TRUE") {
						$sql2A = "UPDATE `beds` SET `status` = 'avail', `reservationID` = '', `contactID` = '' WHERE `bedID` = '$row[bedID]'";
						$result2A = $this->new_mysql($sql2A);
					} else {
						print "<br><font color=red>Error: bedID $row[bedID] failed to cancel.</font><br>";
					}
				}
				$sql3 = "UPDATE `reservations` SET `cxl_date` = '$today', `cxl_user` = '$_SESSION[id]',`cancelled` = 'Yes' WHERE `reservationID` = '$reservationID'";
				$result3 = $this->new_mysql($sql3);
				if ($result3 == "TRUE") {
					$template = "cancel.tpl";
					$data['msg'] = "<font color=red>Reservation $reservationID has been cancelled.</font>";
					$this->load_smarty($data,$template);
				}
			break;

			default:

				// TBD

			break;
		}
	}


	public function canceltent() {

		$cxl_date = date("Ymd");
		$cxl_reason = "User cancelled a tent";

		$sql = "
		SELECT
			`b`.`bedID`,
			`b`.`reservationID`,
			`b`.`contactID`,
			`b`.`inventoryID`,
			`b`.`name`,
			`b`.`type`

		FROM
			`beds` b, `inventory` i

		WHERE
			`b`.`reservationID` = '$_GET[reservationID]'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`roomID` = '$_GET[tent]'

		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$sql2 = "
			INSERT INTO `cancelled_beds` (`cxl_date`,`cxl_user`,`cxl_reason`,`bedID`,`inventoryID`,`name`,`reservationID`,`contactID`,`type`) VALUES
			('$cxl_date','$_SESSION[id]','$cxl_reason','$row[bedID]','$row[inventoryID]','$row[name]','$row[reservationID]','$row[contactID]','$row[type]')
			";
			$result2 = $this->new_mysql($sql2);
			if ($result2 == "TRUE") {
				$sql2A = "UPDATE `beds` SET `status` = 'avail', `reservationID` = '', `contactID` = '' WHERE `bedID` = '$row[bedID]'";
				$result2A = $this->new_mysql($sql2A);
			} else {
				$msg .= "<br><font color=red>Error: bedID $row[bedID] failed to cancel.</font><br>";
			}
		}
		$msg .= "<font color=green>The tent selected was cancelled on reservation $_GET[reservationID].</font>";
		$data['msg'] = $msg;
		$template = "cancel.tpl";
		$this->load_smarty($data,$template);

	}

	public function move() {
		/* $_GET[reservationID] , $_GET[tentID] */
		$this->movetent();
	}

	public function notes($reservationID,$type) {

		switch ($action) {
			case "new":
				$template = "newnote.tpl";
				$data['reservationID'] = $reservationID;
				$data['type'] = $type;
				$this->load_smarty($data,$template);

			break;

			case "list":


			break;

			default:
				$msg = "Sorry, but we could not detect the type of note to use.";
				$template = "error.tpl";
				$data['msg'] = $msg;
				$this->load_smarty($data,$template);
			break;
		}


	}
	

// end class
}