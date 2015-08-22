<?php
/**
 * ExampleService class for demonstration purposes
 * 
 * @author Carsten Eckelmann, May 2014
 */
class SprintService extends DbService {
	
	/** 
	 * @return an array of all undeleted ExampleData records from the database
	 */
	function getAllData() {
		return $this->getObjects("Sprint",array("is_deleted" => 0));
	}
	
	/**
	 * @param integer $id
	 * @return an ExampleData object for this id
	 */
	function getDataForId($id) {
		return $this->getObject("Sprint",$id);
	}
	
	/**
	 * Generate a list of menu entries which will go into a drop down
	 * under the module name.
	 * 
	 * @param Web $w
	 * @param string $title (not in use)
	 * @param string $nav (not  in use)
	 * @return array of menu entries
	 */
	public function navigation(Web $w, $title = null, $nav = null) {
		$nav = array();
		if ($w->Auth->loggedIn()) {
			$w->menuLink("/sprints/index", "Sprints", $nav);
		}
		return $nav;
	}	
}
