<?php
function role_sprint_user_allowed($w, $path) {
	return startsWith($path, "sprints");
}

/*function role_example_view_allowed($w, $path) {
	$actions = "/example\/(index";
    $actions .= "|view";
    $actions .= ")/";
    return preg_match($actions, $path);
}*/
