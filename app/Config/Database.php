<?php

namespace App\Config;

use \PDO;

class Database
{
	protected static $instance = null;

	protected function __construct() {}

	protected static function getDB()
	{
		$config = self::getDbConfig();

		if (!self::$instance)
		{
			self::$instance = new PDO(
				"{$config->database}:host={$config->host};dbname={$config->DBname}",
				$config->user,
				$config->password
			);
			self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
		}
		return self::$instance;
	}

	protected static function getDbConfig()
	{
		return json_decode(__DIR__ .file_get_contents("../config.json"));
	}
}
