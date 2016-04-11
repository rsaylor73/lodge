<?php
include $GLOBAL['path']."/class/core.class.php";

class money extends Core {

	public function dollars($reservationID) {
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
			`i`.`roomID`,
			`rs`.`reservationID`,
			`rs`.`child1_age`,
			`rs`.`child2_age`

		FROM
			`beds` b, `inventory` i, `locations` l, `rooms` r


		LEFT JOIN `reserve`.`contacts` c ON `b`.`contactID` = `c`.`contactID`
		LEFT JOIN `reservations` rs ON `b`.`reservationID` = `rs`.`reservationID` AND `rs`.`reservationID` = '$reservationID'

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `i`.`locationID` = `l`.`id`
			AND `i`.`roomID` = `r`.`id`

		GROUP BY `t2_description`, `t2_bedname`
		";

		print "$sql";


	}
}