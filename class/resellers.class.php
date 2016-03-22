<?php
include $GLOBAL['path']."/class/contacts.class.php";

class resellers extends contacts {

	public function resellers {
			$template = "resellers.tpl";
			$data['list'] = $this->list_resellers();
			$data['country'] = $this->country_list($null);
    		$this->load_smarty($data,$template);
	}

	public function list_resellers() {

	
	}
}