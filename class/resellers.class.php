<?php
include $GLOBAL['path']."/class/contacts.class.php";

class resellers extends contacts {

	public function resellers() {
			$template = "resellers.tpl";
			$data['list'] = $this->list_resellers();
			$data['country'] = $this->country_list($null);
    		$this->load_smarty($data,$template);
	}

	public function list_resellers() {

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
				<a href=\"javascript:void(0)\" onclick=\"document.location.href='editagents/$row[resellerID]'\"><a class=\"fa fa-users\"></i></a> 

			$row[company]</td><td>$row[first] $row[last]</td><td>$row[city]</td><td>$row[country]</td></tr>";
		}
		return $html;

	}
}