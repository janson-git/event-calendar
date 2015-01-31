<?php

class DB {
    /** @var \PDO */
    protected static $connection;

	static public function init() {
		$host = DB_HOST;
		$user = DB_USER;
		$pass = DB_PASS;
		$dbname = DB_NAME;

        self::$connection = new \PDO("mysql:dbname={$dbname};host={$host}", $user, $pass);
        self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$connection->query("SET NAMES 'utf8';");
	}

	static public function query($sql, $params = null) {
        if (is_null(self::$connection)) {
            self::init();
        }

        $statement = self::$connection->prepare($sql);

        $statement->execute($params);
        return $statement;
	}
}
