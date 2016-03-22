<?php
include $GLOBAL['path']."/class/reservations.class.php";

class contacts extends reservations {

		public function contacts() {
			$template = "contacts.tpl";
			$data['country'] = $this->country_list($null);
			$data['list'] = $this->list_contacts();
    		$this->load_smarty($data,$template);
		}

	public function list_contacts() {

		if ($_POST['first'] 		!= "") { $first = "AND `c`.`first` LIKE '%$_POST[first]%'";}
		if ($_POST['last'] 		!= "") { $last = "AND `c`.`last` LIKE '%$_POST[last]%'";}
		if ($_POST['phone'] 		!= "") { $phone = "AND (`c`.`phone1` LIKE '%$_POST[phone]%') OR (`c`.`phone2` LIKE '%$_POST[phone]%') 
			OR (`c`.`phone3` LIKE '%$_POST[phone]%') OR (`c`.`phone4` LIKE '%$_POST[phone]%')";}
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

	public function editcontact() {

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
				`c`.`email`,
				`c`.`date_of_birth`,
				`c`.`countryID`,
				`c`.`phone1_type`,
				`c`.`phone2_type`,
				`c`.`phone3_type`,
				`c`.`phone4_type`,
				`c`.`phone1`,
				`c`.`phone2`,
				`c`.`phone3`,
				`c`.`phone4`,
				`c`.`contactID`

			FROM
				`reserve`.`contacts` c

			WHERE
				`c`.`contactID` = '$_GET[contactID]'

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
			$data['list_country'] = $this->country_list($row['countryID']);
		}
		$data['list_states'] = $this->list_states();
      	$template = "editcontact.tpl";
      	$this->load_smarty($data,$template);
	}

	public function updatecontact() {
		$sql = "UPDATE `reserve`.`contacts` c SET

		`title` = '$_POST[title]', `first` = '$_POST[first]', `middle` = '$_POST[middle]', `last` = '$_POST[list]', `email` = '$_POST[email]', `address1` = '$_POST[address1]', `address2` = '$_POST[address2]',
		`city` = '$_POST[city]', `state` = '$_POST[state]', `province` = '$_POST[province]', `countryID` = '$_POST[country]', `zip` = '$_POST[zip]', `date_of_birth` = '$_POST[dob]',
		`phone1_type` = '$_POST[phone1_type]', `phone2_type` = '$_POST[phone2_type]', `phone3_type` = '$_POST[phone3_type]', `phone4_type` = '$_POST[phone4_type]',
		`phone1` = '$_POST[phone1]', `phone2` = '$_POST[phone2]', `phone3` = '$_POST[phone3]', `phone4` = '$_POST[phone4]'

		WHERE `c`.`contactID` = '$_POST[contactID]'";

		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$msg = "<font color=green>The contact was updated.</font><br>";
			$data['msg'] = $msg;
			$template = "contacts.tpl";
	      	$data['list'] = $this->list_contacts();
			$this->load_smarty($data,$template);
		} else {
			$this->error();
		}
	}

	public function searchcontacts() {
		$this->contacts();		
	}

	public function newcontact() {

		$state = "<option value=\"\">--Select--</option>";
		$state .= $this->get_states($null);

		$country = "<option value=\"\">--Select--</option>";
		$country .= $this->get_countries($null);

		$data['state'] = $state;
		$data['country'] = $country;
		$template = "newcontact.tpl";
     	$this->load_smarty($data,$template);
	}

	public function savecontact() {
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

	public function list_states() {
		$sql = "SELECT `state_abbr` FROM `state` ORDER BY `state_abbr` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$states .= "<option>$row[state_abbr]</option>";
		}
		return $states;
	}


// end class
}