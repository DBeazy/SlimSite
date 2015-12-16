<?php

use \Slim\Container;

/**
 * This is the Container class that allows us to be able to injecting dependencies.
 */
$di = new Container();

/**
 * Configuration array
 * @param $c Container instance
 * @return array $config Config options from ini file
 */
$di['config'] = function ($c) {
    $config = parse_ini_file(APP_PATH . 'app/config/config.ini', true);

    if (is_readable(APP_PATH . 'app/config/config-dev.ini')) {
        $debug_config = parse_ini_file(APP_PATH . 'app/config/config-dev.ini', true);
        $config = array_merge($config, $debug_config);
    }

    return $config;
};

/**
 * Database objects
 * @param $c Container instance
 * @return PDO $db_connection
 */
$di['db'] = function ($c) {

    // Get the Database config
    $dbConfig = $c['config']['database'];

    // Get new Mysql connection
    if ($dbConfig['dsn'] == 'mysql')
        $db_connection = new \PDO(
            $dbConfig['dsn'] . ':host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'] . ';charset=UTF8',
            $dbConfig['username'],
            $dbConfig['password']
        );

    // Get new SQLite connection
    elseif ($dbConfig['dsn'] == 'sqlite')
        $db_connection = new \PDO(
            $dbConfig['dsn'] . ':' . $dbConfig['host']
        );
    else
        throw new HTTPException('Database is not correctly configured.');

    // Set the Time Zone
    $db_connection->exec('SET time_zone = \'UTC\';');

    // Return database connection
    return $db_connection;

};
