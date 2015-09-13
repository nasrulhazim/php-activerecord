<?php

class AR {
	static $conn;
	static $model_directories;

	public static function add_model_directories($list) {
		if(!is_array($list)) {
			return false;
		}

		if(!is_array(self::$model_directories)) {
			self::$model_directories = array();
		}

		foreach ($list as $key => $value) {
			if(!in_array($value, self::$model_directories)) {
				self::$model_directories[] = $value;
			}
		}

		return true;
	}
}

function ar_init() {
	$connections = array(
		'development' => 'mysql://'.DB_USER.':'.DB_PASSWORD.'@'.DB_HOST.'/'.DB_NAME,
	);

	AR::$conn = ActiveRecord\Config::instance();
	AR::$conn->set_model_directory(AR::$model_directories);
	AR::$conn->set_connections($connections);
}
