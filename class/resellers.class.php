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