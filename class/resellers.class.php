<?php
include $GLOBAL['path']."/class/contacts.class.php";

class resellers extends contacts {

	/*
	any function called from the loader class must be public
	any function called only in the reseller class can be private
	*/

	public function resellers() {
			$template = "resellers.tpl";
			$data['list'] = $this->list_resellers();
			$data['country'] = $this->country_list($null);
    		$this->load_smarty($data,$template);
	}

	private function list_resellers() {

		if ($_POST['first'] != "") {
			$first = "AND `r`.`first` LIKE '%$_POST[first]%'";
		}
		if ($_POST['last'] != "") {
			$last = "AND `r`.`last` LIKE '%$_POST[last]%'";
		}
		if ($_POST['phone'] != "") {
			$phone = "AND (`r`.`phone` LIKE '%$_POST[phone]') OR (`r`.`phone2` LIKE '%$_POST[phone]%')";
		}
		if ($_POST['zip'] != "") {
			$zip = "AND `r`.`zip` = '$_POST[zip]'";
		}
		if ($_POST['email'] != "") {
			$email = "AND `r`.`email` LIKE '%$_POST[email]%'";
		}
		if ($_POST['country'] != "") {
			$country = "AND `r`.`countryID` = '$_POST[country]'";
		}
		if ($_POST['resellerID'] != "") {
			$resellerID = "AND `r`.`resellerID` = '$_POST[resellerID]'";
		}
		if ($_POST['city'] != "") {
			$city = "AND `r`.`city` LIKE '%$_POST[city]%'";
		}
		if ($_POST['address'] != "") {
			$address = "AND `r`.`address` LIKE '%$_POST[address]%'";
		}
		if ($_POST['company'] != "") {
			$company = "AND `r`.`company` LIKE '%$_POST[company]%'";
		}

		if ($_POST['resellerID'] != "") {
			// direct match clear other criteria
			$first = ""; $last = ""; $phone = ""; $zip = ""; $email = ""; $country = ""; $city = ""; $address = ""; $company = "";
		}

		$sql = "
		SELECT
			`r`.`resellerID`,
			`r`.`company`,
			`r`.`first`,
			`r`.`last`,
			`r`.`city`,
			`c`.`country`

		FROM
			`reserve`.`resellers` r

		LEFT JOIN `reserve`.`countries` c ON `r`.`countryID` = `c`.`countryID`

		WHERE
			`r`.`status` = 'Active'
			$first
			$last
			$phone
			$zip
			$email
			$country
			$resellerID
			$city
			$address
			$company

		LIMIT 20
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>
				<a href=\"javascript:void(0)\" onclick=\"document.location.href='editreseller/$row[resellerID]'\"><i class=\"fa fa-pencil-square-o\"></i></a> 
				<a href=\"javascript:void(0)\" onclick=\"document.location.href='editagents/$row[resellerID]'\"><i class=\"fa fa-users\"></i></a> 

			$row[company]</td><td>$row[first] $row[last]</td><td>$row[city]</td><td>$row[country]</td></tr>";
		}
		return $html;

	}

	public function editreseller() {
		$sql = "
		SELECT
			`r`.*

		FROM
			`reserve`.`resellers` r

		WHERE
			`r`.`resellerID` = '$_GET[resellerID]'
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
			$data['country'] = $this->country_list($row['countryID']);
			$data['reseller_type'] = $this->reseller_types($row['reseller_typeID']);

		}
		$template = "editreseller.tpl";
		$data['list_states'] = $this->list_states();
   		$this->load_smarty($data,$template);
	}

	// private classes can only be executed in this class. This will not extend to the other classes - RBS
	private function reseller_types($id) {
		$sql = "SELECT `reseller_typeID`,`type` FROM `reserve`.`reseller_types` WHERE `status` = 'Active' ORDER BY `type` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($id == $row['reseller_typeID']) {
				$option .= "<option selected value=\"$row[reseller_typeID]\">$row[type]</option>";
			} else {
				$option .= "<option value=\"$row[reseller_typeID]\">$row[type]</option>";
			}
		}
		return $option;
	}

	public function updatereseller() {
		$sql = "

		UPDATE `reserve`.`resellers` r 

		SET 

		`r`.`company` = '$_POST[company]',
		`r`.`reseller_typeID` = '$_POST[reseller_type]',
		`r`.`status` = '$_POST[status]',
		`r`.`commission` = '$_POST[commission]',
		`r`.`first` = '$_POST[first]',
		`r`.`middle` = '$_POST[middle]',
		`r`.`last` = '$_POST[last]',
		`r`.`email` = '$_POST[email]',
		`r`.`address` = '$_POST[address]',
		`r`.`city` = '$_POST[city]',
		`r`.`state` = '$_POST[state]',
		`r`.`countryID` = '$_POST[country]',
		`r`.`zip` = '$_POST[zip]',
		`r`.`phone` = '$_POST[phone]',
		`r`.`phone2` = '$_POST[phone2]'

		WHERE `r`.`resellerID` = '$_POST[resellerID]'
		";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$template = "resellers.tpl";
			$data['list'] = $this->list_resellers();
			$data['country'] = $this->country_list($null);
			$data['msg'] = "<font color=green>The reseller was updated.</font><br>";
    		$this->load_smarty($data,$template);
		} else {
			$template = "error.tpl";
			$this->load_smarty($null,$template);
		}
	}

	public function editagents() {
		$sql = "SELECT `company` FROM `reserve`.`resellers` r WHERE `r`.`resellerID` = '$_GET[resellerID]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$data['company'] = $row['company'];
		}



		$template = "editagents.tpl";
		$data['agent_list'] = $this->list_agents($_GET['resellerID']);
		$this->load_smarty($data,$template);


	}

	private function list_agents($id) {
		$sql = "
		SELECT
			`a`.`status`,
			`a`.`first`,
			`a`.`last`,
			`a`.`reseller_agentID`

		FROM
			`reserve`.`reseller_agents` a

		WHERE
			`a`.`resellerID` = '$id'
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td><a href=\"javascript:void(0)\" onclick=\"document.location.href='editagent/$id/$row[reseller_agentID]'\"><i class=\"fa fa-pencil-square-o\"></i></a> $row[first] $row[last]</td><td>$row[status]</td></tr>";
		}
		return $html;
	}

	public function editagent() {

			$sql = "
			SELECT
				`a`.`status`,
				`a`.`first`,
				`a`.`middle`,
				`a`.`last`,
				`a`.`reseller_agentID`,
				`a`.`resellerID`,
				`r`.`company`,
				`a`.`address1`,
				`a`.`address2`,
				`a`.`city`,
				`a`.`state`,
				`a`.`zip`,
				`a`.`countryID`,
				`a`.`phone1_type`,
				`a`.`phone1`,
				`a`.`phone2_type`,
				`a`.`phone2`,
				`a`.`phone3_type`,
				`a`.`phone3`,
				`a`.`phone4_type`,
				`a`.`phone4`,
				`a`.`email`,
				`a`.`status`

			FROM
				`reserve`.`reseller_agents` a
			
			LEFT JOIN `reserve`.`resellers` r ON `a`.`resellerID` = `r`.`resellerID`

			WHERE
				`a`.`reseller_agentID` = '$_GET[agentID]'
			";

			$result = $this->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				foreach ($row as $key=>$value) {
					$data[$key] = $value;
				}
				$data['name'] = $row['first'] . " " . $row['last'];
				$data['country'] = $this->country_list($row['countryID']);
			}

			$template = "editagent.tpl";
    		$this->load_smarty($data,$template);
	}

	public function updateagent() {
		$sql = "UPDATE `reserve`.`reseller_agents` SET
		`status` = '$_POST[status]',
		`first` = '$_POST[first]',
		`middle` = '$_POST[middle]',
		`last` = '$_POST[last]',
		`address1` = '$_POST[address1]',
		`address2` = '$_POST[address2]',
		`city` = '$_POST[city]',
		`state` = '$_POST[state]',
		`zip` = '$_POST[zip]',
		`countryID` = '$_POST[countryID]',
		`phone1_type` = '$_POST[phone1_type]',
		`phone2_type` = '$_POST[phone2_type]',
		`phone3_type` = '$_POST[phone3_type]',
		`phone4_type` = '$_POST[phone4_type]',
		`phone1` = '$_POST[phone1]',
		`phone2` = '$_POST[phone2]',
		`phone3` = '$_POST[phone3]',
		`phone4` = '$_POST[phone4]',
		`email` = '$_POST[email]'
		WHERE `reseller_agentID` = '$_POST[reseller_agentID]'
		";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$sql2 = "SELECT `company` FROM `reserve`.`resellers` r WHERE `r`.`resellerID` = '$_POST[resellerID]'";
			$result2 = $this->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {
				$data['company'] = $row2['company'];
			}

			$template = "editagents.tpl";
			$data['msg'] = "<font color=green>The agent was updated.<br></font>";
			$data['agent_list'] = $this->list_agents($_POST['resellerID']);
			$this->load_smarty($data,$template);
		}
	}

	public function newagent() {
		$template = "newagent.tpl";
		$this->load_smarty($null,$template);
	}

	public function newreseller() {
		$template = "newreseller.tpl";
		$this->load_smarty($null,$template);
	}

	public function assignreseller() {
		$template = "assignreseller.tpl";
		$data['reservationID'] = $_GET['reservationID'];
		$this->load_smarty($data,$template);
	}

// end class	
}