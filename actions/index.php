<?php
/**
 * @hook example_add_row_action(array(<ExampleData> 'data', <String> 'actions')
 * @param Web $w
 */
function index_ALL(Web $w) {
	// adding data to the template context
	$w->ctx("message","Sprint List");
	
	// get the list of data objects
	$listdata = $w->Example->getAllData();
	
	// prepare table data
	$t[]=array("Title", "Data", "Actions"); // table header
	if (!empty($listdata)) {
		foreach ($listdata as $d) {
			$row = array();
			$row[] = $d->title;
			$row[] = $d->data;
			
			// prepare action buttons for each row
			$actions = array();
			if ($d->canEdit($w->Auth->user())) {
				$actions[] = Html::box("/sprints/edit/".$d->id, "Edit", true);
			}
			if ($d->canDelete($w->Auth->user())) {
				$actions[] = Html::b("/sprints/delete/".$d->id, "Delete", "Really delete?");
			}
						
			$row[] = implode(" ",$actions);
			$t[] = $row;
		}
	}
	
	// create the html table and put into template context
	$w->ctx("table",Html::table($t,"table","tablesorter",true));
}
