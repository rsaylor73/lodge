<?php

class test extends Core {

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
					// Adults
		         for ($i2 = 0; $i2 < $row['beds']; $i2++) {
						$sql4 = "INSERT INTO `beds` (`inventoryID`,`status`,`name`,`type`) VALUES ('$inventoryID','avail','$bed_map[$i2]','adult')";
						$result4 = $this->new_mysql($sql4);
		         }
					//Child
               for ($i2 = 0; $i2 < $row['children']; $i2++) {
                  $sql4 = "INSERT INTO `beds` (`inventoryID`,`status`,`name`,`type`) VALUES ('$inventoryID','avail','N/A','child')";
                  $result4 = $this->new_mysql($sql4);
               }

				}
			}
		}
		return "1";	

	}

	private function newreservation() {
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

	private function quick_search($day) {
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

		$sql = "
		SELECT 
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds'

		FROM 
			`inventory` i

		LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'


		WHERE 
			`i`.`locationID` = '$_POST[lodge]' 
			AND `i`.`date_code` BETWEEN '$day' AND '$day' 

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

	private function searchinventory() {

		$start_date = str_replace("-","",$_POST['start_date']);
		$end_date = str_replace("-","",$_POST['end_date']);

		$sql = "SELECT `name`,`min_night_stay` FROM `locations` WHERE `id` = '$_POST[lodge]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$data['name'] = $row['name'];
			$data['min_night_stay'] = $row['min_night_stay'];
		}

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

		HAVING 
			total_beds >= '$_POST[pax]'
		";

		$sql = "
		SELECT 
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds'

		FROM 
			`inventory` i

		LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'


		WHERE 
			`i`.`locationID` = '$_POST[lodge]' 
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date' 

		HAVING 
			total_adult_beds >= '$_POST[pax]' AND total_child_beds >= '$_POST[children]'
		";

		$result = $this->new_mysql($sql);

		if ($_SESSION['reservationID'] != "") {
			$data['reservationID'] = $_SESSION['reservationID'];
		}

		while ($row = $result->fetch_assoc()) {
			$found = "1";
			// build calendar to show # rooms available for each day
	      $this->load_smarty($data,'reservations_header.tpl');

			$months = $this->getMonthsInRange($_POST['start_date'],$_POST['end_date']);
			print "<form name=\"myform\" method=\"post\" action=\"viewtent\">
			<input type=\"hidden\" name=\"lodge\" value=\"$_POST[lodge]\">
			<input type=\"hidden\" name=\"pax\" value=\"$_POST[pax]\">
			<input type=\"hidden\" name=\"children\" value=\"$_POST[children]\">
			<input type=\"hidden\" name=\"nights\" value=\"$_POST[nights]\">
			
			";

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

			print "<div id=\"viewtent\" style=\"display:none\">
				<input type=\"submit\" value=\"Select Room\" class=\"btn btn-primary\">
			</div>";

			print "</form>";
			// ajax
			print '
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

	private function get_tent_data($day) {

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

	private function generate_reservationID() {
		$today = date("Ymd");
		$sql = "INSERT INTO `reservations` (`date_created`,`userID`,`active`) VALUES ('$today','$_SESSION[id]','Yes')";
		$result = $this->new_mysql($sql);
		$reservationID = $this->linkID->insert_id;
		return $reservationID;
	}

	private function togglebeds() {
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

	private function viewtent() {

      $template = "viewtent.tpl";
      $data = array();

		foreach ($_POST as $key=>$value) {
			$form_html .= "<input type=\"hidden\" name=\"$key\" value=\"$value\">\n";
		}

		$data['form_html'] = $form_html;

		foreach ($_POST as $key=>$value) {
			if (preg_match("/data/i",$key)) {
				$temp = explode("_",$key);
				$dates[] = $temp[1];
			}
		}
		asort($dates);
		foreach ($dates as $value) {
			if ($test == "1") {
				$counter++;
				$next = date("Ymd", strtotime($first ."+ $counter days"));
				if ($next != $value) {
					print "<br><h2>Error:</h2><font color=red>You must select consecutive days.</font><br>";
					die;
				}
			}
			if ($test != "1") {
				$first = $value;
				$test = "1";
			}
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

		GROUP BY `r`.`description`

		HAVING total_adult_beds >= '$adults' AND total_child_beds >= '$children'
		";

		$data['nights'] = $nights;
		$data['adults'] = $_POST['pax'];
		$data['children'] = $_POST['children'];
		$start_date = reset($dates);
		$data['start_date2'] = date("m/d/Y",strtotime($start_date));
		$end_date = end($dates);
		$data['end_date2'] = date("m/d/Y",strtotime($end_date));

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$total = $row['nightly_rate'] * $nights;
			$html .= "<tr><td>$row[description]</td><td>$$total</td><td>Click to select this tent <input type=\"radio\" value=\"$row[id]\" name=\"roomID\" data-toggle=\"toggle\" onchange=\"document.getElementById('booknow').style.display='inline'\"></td></tr>";
			$found = "1";
		}
		if ($found != "1") {
			$data['msg'] = "<br><font color=red>Sorry, there are no rooms available for the duration and number of guests you have selected.</font><br>";
		}

		$data['btn'] = "<div id=\"booknow\" style=\"display:none\"><input type=\"submit\" value=\"Book Reservation\" class=\"btn btn-success\"></div>";

		$data['html'] = $html;

		/*
		print "<pre>";
		print_r($dates);
		print "</pre>";
		*/

      $this->load_smarty($data,$template);


	}

	private function reservenow() {

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

			print "<br><font color=green>The reservation <b>$reservationID</b> has been booked. Please wait loading...<br>Click <a href=\"reservation_dashboard/$reservationID/details\">here</a> if the page does not load.<br></font>";
			print "<meta http-equiv=\"refresh\" content=\"3; url=reservation_dashboard/$reservationID/details\">";
			$ok = "1";
		}
		if ($ok != "1") {
			print "<br><font color=red>Sorry, but the dates you selected are no longer available.</font><br>";
		}

	}

	private function completereservation() {
		$sql = "UPDATE `reservations` SET `complete` = 'Yes' WHERE `reservationID` = '$_SESSION[reservationID]'";
		$result = $this->new_mysql($sql);
		$reservationID = $_SESSION['reservationID'];
		$_SESSION['reservationID'] = "";
		$_GET['reservationID'] = $reservationID;

		print "Loading...<br>";
		print "<meta http-equiv=\"refresh\" content=\"1;url=reservation_dashboard/$reservationID\">";

		//$this->reservation_dashboard();
	}

	private function locatereservation() {
		$template = "locatereservation.tpl";
      $this->load_smarty($null,$template);
	}

	private function reservation_dashboard() {
		$reservationID = $_REQUEST['reservationID'];
		$data['reservationID'] = $reservationID;

		if ($_REQUEST['part'] == "") {
			$data['part'] = "details";
		} else {
			$data['part'] = $_GET['part'];
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

	private function reservation_details($reservationID) {
		// Tab 1

		$sql = "
		SELECT
			`u`.`first` AS 't1_first',
			`u`.`last` AS 't1_last',
			`u`.`email` AS 't1_email',
			DATE_FORMAT(`r`.`date_created`, '%m/%d/%Y') AS 't1_booked_date'

		FROM
			`reservations` r, `users` u

		WHERE
			`r`.`reservationID` = '$reservationID'
			AND `r`.`userID` = `u`.`id`
		";

		$result = $this->new_mysql($sql);
		while($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}

		return $data;
	}

   private function reservation_guests($reservationID) {
		// Tab 2
		
		$sql = "
		SELECT
			`b`.`status` 										AS 't2_status',
			`r`.`description` 								AS 't2_description',
			`b`.`name` 											AS 't2_bedname',
			DATE_FORMAT(`i`.`date_code`, '%m/%d/%Y') 	AS 't2_date',
			`c`.`contactID`									AS 't2_contactID',
			`c`.`first`											AS 't2_first',
			`c`.`middle`										AS 't2_middle',
			`c`.`last`											AS 't2_last',
			`c`.`email`											AS 't2_email'

		FROM
			`beds` b, `inventory` i, `locations` l, `rooms` r


		LEFT JOIN `contacts` c ON `b`.`contactID` = `c`.`contactID`

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`locationID` = `l`.`id`
			AND `i`.`roomID` = `r`.`id`

		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {

			if ($row['t2_contactID'] == "") {
				$contact = "<input type=\"button\" value=\"Assign Contact\" class=\"btn btn-primary\">";
			} else {
				$contact = "$row[t2_first] $row[t2_middle] $row[t2_last]";
			}

			$html .= "
			<tr>
				<td>$row[t2_description]</td>
				<td>$row[t2_bedname]</td>
				<td>$row[t2_status]</td>
				<td>$row[t2_date]</td>
				<td>$contact</td>
			</tr>
			";
		
		}


      $data['t2_html'] = $html;
      return $data;
   }

   private function reservation_dollars($reservationID) {
      $data['test'] = "ok 3";
      return $data;
   }

   private function reservation_notes($reservationID) {
      $data['test'] = "ok 4";
      return $data;
   }

   private function reservation_cancel($reservationID) {
      $data['test'] = "ok 5";
      return $data;
   }

	public function country_list($id) {
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

/*
	private function contacts() {

		$template = "contacts.tpl";

		$data['country'] = $this->country_list($null);
		$data['list'] = $this->list_contacts();

      $this->load_smarty($data,$template);

	}
*/
	private function newcontact() {

		$state = "<option value=\"\">--Select--</option>";
		$state .= $this->get_states($null);

		$country = "<option value=\"\">--Select--</option>";
		$country .= $this->get_countries($null);

		$data['state'] = $state;
		$data['country'] = $country;
		$template = "newcontact.tpl";
      $this->load_smarty($data,$template);

	}

	private function savecontact() {
		$sql = "INSERT INTO `contacts` (`first`,`middle`,`last`,`title`,`pedigree`,`email`,`addr1`,`addr2`,`city`,`stateID`,`province`,`countryID`,`zip`,`dob`,`cell_phone`,`home_phone`,`work_phone`) VALUES
		('$_POST[first]','$_POST[middle]','$_POST[last]','$_POST[title]','$_POST[pedigree]','$_POST[email]','$_POST[addr1]','$_POST[addr2]','$_POST[city]','$_POST[state]','$_POST[province]','$_POST[country]',
		'$_POST[zip]','$_POST[dob]','$_POST[cell_phone]','$_POST[home_phone]','$_POST[work_phone]')
		";

		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$msg = "<font color=green>The contact was added.</font><br>";
			$data['msg'] = $msg;
			$template = "contacts.tpl";
	      $data['list'] = $this->list_contacts();
			$this->load_smarty($data,$template);
		} else {
			$this->error();

		}

	}

	private function searchcontacts() {

		$this->contacts();		

	}

	private function editcontact() {

		$sql = "
			SELECT
				`c`.`title`,
				`c`.`first`,
				`c`.`middle`,
				`c`.`last`,
				`c`.`address1`,
				`c`.`address2`,
				`c`.`city`,
				`c`.`state`,
				`c`.`province`,
				`c`.`zip`,
				`c`.`countryID`,
				`c`.`phone1_type`,
				`c`.`phone2_type`,
				`c`.`phone3_type`,
				`c`.`phone4_type`,
				`c`.`phone1`,
				`c`.`phone2`,
				`c`.`phone3`,
				`c`.`phone4`

			FROM
				`reserve`.`contacts` c

			WHERE
				`c`.`contactID` = '$_GET[contactID]'

		";

      $template = "editcontact.tpl";
      $this->load_smarty($data,$template);


	}

	private function list_contacts() {

		if ($_POST['first'] 		!= "") { $first = "AND `c`.`first` LIKE '%$_POST[first]%'";}
		if ($_POST['last'] 		!= "") { $last = "AND `c`.`last` LIKE '%$_POST[last]%'";}
		if ($_POST['phone'] 		!= "") { $phone = "AND (`c`.`phone1` LIKE '%$_POST[phone]%') OR (`c`.`phone2` LIKE '%$_POST[phone]%') OR (`c`.`phone3` LIKE '%$_POST[phone]%') OR (`c`.`phone4` LIKE '%$_POST[phone]%')";}
		if ($_POST['zip'] 		!= "") { $zip = "AND `c`.`zip` LIKE '%$_POST[zip]%'";}
		if ($_POST['email'] 		!= "") { $email = "AND `c`.`email` LIKE '%$_POST[email]%'";}
		if ($_POST['country'] 	!= "") { $country = "AND `c`.`countryID` = '$_POST[country]'";}
		if ($_POST['contactID'] != "") { $contactID = "AND `c`.`contactID` = '$_POST[contactID]'";}
		if ($_POST['city']		!= "") { $city = "AND `c`.`city` = '$_POST[city]'";}
		if ($_POST['address']	!= "") { $address = "AND `c`.`address1` LIKE '%$_POST[address]%'";}
		if ($_POST['province']	!= "") { $province = "AND `c`.`province` LIKE '%$_POST[province]%'";}

		$sql = "
		SELECT
			`c`.`contactID`,
         `c`.`first`,
         `c`.`middle`,
         `c`.`last`,
         `c`.`city`,
			`c`.`province`,
			`c`.`state`,
         `cn`.`country`


		FROM
			`reserve`.`contacts` c

      LEFT JOIN `countries` cn ON `c`.`countryID` = `cn`.`countryID`

		WHERE
         `c`.`contactID` > 0
			$first
			$last
			$phone
			$zip
			$email
			$country
			$contactID
			$city
			$address
			$province

      LIMIT 20
		";

      $result = $this->new_mysql($sql);
      while ($row = $result->fetch_assoc()) {
         $html .= "<tr><td><a href=\"javascript:void(0)\" onclick=\"document.location.href='editcontact/$row[contactID]'\"><i class=\"fa fa-pencil-square-o\"></i></a> $row[first] $row[middle] $row[last]</td><td>$row[city]</td><td>$row[state]$row[province]</td><td>$row[country]</td></tr>";
      }
      return $html;

	}


	public function list_contactsOLD() {

		if ($_SESSION['city'] != "") {
			$city = "AND `c`.`city` LIKE '%$_SESSION[city]%'";
		}

		if ($_SESSION['stateID'] != "") {
			$state = "AND `c`.`stateID` = '$_SESSION[stateID]'";
		}

		if ($_SESSION['province'] != "") {
			$province = "AND `c`.`province` LIKE '%$_SESSION[province]%'";
		}

		switch ($_SESSION['case']) {
			case "1":
				$name = "AND `first` LIKE '%$_SESSION[first]%'";
			break;

			case "2":
				$name = "AND CONCAT(`c`.`first`,' ',`c`.`last`) LIKE '%$_SESSION[first] $_SESSION[last]%'";
			break;

			case "3":
            $name = "AND CONCAT(`c`.`first`,' ',`c`.`middle`,' ',`c`.`last`) LIKE '%$_SESSION[first] $_SESSION[middle] $_SESSION[last]%'";
			break;
		}

		$sql = "
		SELECT
			`c`.`first`,
			`c`.`middle`,
			`c`.`last`,
			`c`.`city`,
			`s`.`state_abbr`,
			`c`.`province`,
			`cn`.`country`


		FROM
			`contacts` c

		LEFT JOIN `state` s ON `c`.`stateID` = `s`.`id`
		LEFT JOIN `countries` cn ON `c`.`countryID` = `cn`.`countryID`

		WHERE
			`c`.`contactID` > 0
			$name
			$city
			$state
			$province

		LIMIT 20
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td><i class=\"fa fa-pencil-square-o\"></i> $row[first] $row[middle] $row[last]</td><td>$row[city]</td><td>$row[state_abbr]$row[province]</td><td>$row[country]</td></tr>";
		}
		return $html;	

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

					$start_date = str_replace("-","",$_POST['start_date']);
					$end_date = str_replace("-","",$_POST['end_date']);

					if ($color == "#E0F8E0") {
                  $html .= "

							<td bgcolor=$color><label>
								$mday<br>
								<input type=\"checkbox\" name=\"data_$day\" value=\"checked\" onclick=\"document.getElementById('viewtent').style.display='inline'\">
				
								<!--<a href=\"viewtent/$_POST[lodge]/$_POST[pax]/$day/$start_date/$end_date\">$mday</a>-->


							
							</label></td>";
					} else {
	               $html .= "<td bgcolor=$color><label>$mday<br><input type=\"checkbox\" disabled></label></td>";
					}
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

	// gets a list of countries
	public function get_countries($id) {
      $sql = "SELECT * FROM `countries` ORDER BY `country` ASC";
      $result = $this->new_mysql($sql);
      while ($row = $result->fetch_assoc()) {
         if ($row['countryID'] == $id) {
            $country .= "<option selected value=\"$row[countryID]\">$row[country]</option>";
         } else {
            $country .= "<option value=\"$row[countryID]\">$row[country]</option>";
         }
      }
      return $country;


	}

	// get a list of states
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
		`auto_inventory` = '$_POST[auto_inventory]',`inventory_stop_date` = '$_POST[inventory_stop_date]'  WHERE `id` = '$_POST[id]'";
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
			$sql = "UPDATE `rooms` SET `description` = '$_POST[description]', `beds` = '$_POST[beds]', `children` = '$_POST[children]', `nightly_rate` = '$_POST[nightly_rate]' WHERE `id` = '$_POST[id]'";
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
		$sql = "INSERT INTO `rooms` (`locationID`,`description`,`beds`,`children`,`nightly_rate`) VALUES ('$_POST[id]','$_POST[description]','$_POST[beds]','$_POST[children]','$_POST[nightly_rate]')";
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
			$output .= "<tr><td>$row[description]</td><td>$row[beds]</td><td>$row[children]</td><td>$$row[nightly_rate]</td><td><input type=\"button\" class=\"btn btn-primary\" value=\"Edit\" onclick=\"document.location.href='editroom/$row[id]/$id'\"></td></tr>";
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