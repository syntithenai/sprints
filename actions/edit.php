<?php
/**
 * Display an edit form for either creating a new
 * record for ExampleData or edit an existing form.
 * 
 * Url:
 * 
 * /example/edit/{id}
 * 
 * @param Web $w
 */
function edit_GET(Web $w) {
	// parse the url into parameters
	$p = $w->pathMatch("id");
	
	// create either a new or existing object
	if (isset($p['id'])) {
		$data = $w->Sprint->getDataForId($p['id']);
	} else {
		$data = new Sprint($w);
	}
	
	// create the edit form
	$f = Html::form(array(
			array("Edit Sprint","section"),
			array("Title","text","title", $data->title),
			array("Data","text","data",$data->data),
			array("Check","checkbox","data",'1'),
	),$w->localUrl("/sprints/edit/".$p['id']),"POST"," Save ");
	
	// circumvent the template and print straight into the layout
	$w->out($f);
}

/**
 * Receive post data from ExampleData edit form.
 * 
 * Url:
 * 
 * /example/edit/{id}
 * 
 * @param Web $w
 */
function edit_POST(Web $w) {
	$p = $w->pathMatch("id");
	if (isset($p['id'])) {
		$data = $w->Sprint->getDataForId($p['id']);
	} else {
		$data = new Sprint($w);
	}
	
	$data->fill($_POST);
	// fill in validation step!
	
	$data->insertOrUpdate();
	
	// go back to the list view
	$w->msg("Sprint updated","sprints/index");
}
