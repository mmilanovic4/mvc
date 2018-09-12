<?php

return [
	// HomeController
	[
		'Pattern' => '|^/?$|',
		'Controller' => 'Home',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^login/?$|',
		'Controller' => 'Home',
		'Method' => 'login'
	],
	[
		'Pattern' => '|^logout/?$|',
		'Controller' => 'Home',
		'Method' => 'logout'
	],
	// TaskController
	[
		'Pattern' => '|^tasks/?$|',
		'Controller' => 'Task',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^tasks/create/?$|',
		'Controller' => 'Task',
		'Method' => 'create'
	],
	[
		'Pattern' => '|^tasks/update/([0-9]+)/?$|',
		'Controller' => 'Task',
		'Method' => 'update'
	],
	[
		'Pattern' => '|^tasks/delete/([0-9]+)/?$|',
		'Controller' => 'Task',
		'Method' => 'delete'
	],
	// Подразумевана рута
	[
		'Pattern' => '|^.*$|',
		'Controller' => 'Home',
		'Method' => 'index'
	]
];
