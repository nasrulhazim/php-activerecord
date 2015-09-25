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

	public static function init($username, $password, $database, $host) {

		if(empty($username) || empty($database) || empty($host)) {
			throw new Exception("Please configure your database connection properly", 1);
		}

		$connections = array(
			'development' => 'mysql://'.$username.':'.$password.'@'.$host.'/'.$database,
		);

		self::$conn = ActiveRecord\Config::instance();
		self::$conn->set_model_directory(AR::$model_directories);
		self::$conn->set_connections($connections);
	}
}