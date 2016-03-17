<?php
class contacts extends Core {

		public function contacts() {

			$template = "contacts.tpl";

			$data['country'] = $this->country_list($null);
			$data['list'] = $this->list_contacts();

      		$this->load_smarty($data,$template);

		}
}

?>