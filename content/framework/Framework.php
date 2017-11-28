<?php class Framework
{
    public static $dirName;
    public static $requestUri;
    private static $actionName;
    private static $controllerName;
    private static $controllerInstance;
    private static $config;
    private static $db;

    public static function start()
    {
        try {
            self::launching();
        } catch (exception $e) {
            self::$controllerInstance->actionError($e);
        }
    }

    public static function db()
    {
        return self::$db;
    }

    public static function useModel($modelName)
    {
        if(!empty($modelName))
        {
            $modelName .= 'Model';
            $pathToModel = Framework::$dirName.'/content/models/'.$modelName.'.php';
            if(file_exists($pathToModel)) require_once $pathToModel;
        }
    }

    private static function closeDbConnection()
    {
        if (isset(self::$db) and !empty(self::$db)) unset(self::$db);
    }

    private static function makeControllerInstance()
    {
        require_once self::$dirName . '/content/controllers/' . self::$controllerName . '.php';
        if (class_exists(self::$controllerName))
            self::$controllerInstance = new self::$controllerName;
        else
            throw new exception('ERROR ! ( Called class not found )');
    }

    private static function launching()
    {
        session_start();
        /*- Makes the default controller instance -*/
        require_once self::$dirName . '/content/controllers/MainController.php';
        self::$controllerInstance = new MainController; /* <-- DefaultController */
        /*- Connects the config file -*/
        if (file_exists(self::$dirName . '/content/framework/config.php'))
            self::$config = require_once 'config.php';
        else
            throw new exception('ERROR ! ( Config.php was not found - can not start DB connection. )');
        if (!isset(self::$config['db']['dbHost']) or !isset(self::$config['db']['dbName']) or
            !isset(self::$config['db']['dbUser']) or !isset(self::$config['db']['dbPassword']) or
            !isset(self::$config['db']['dbCharset'])
        )
            throw new exception('ERROR ! ( Not enough data in Config.php to make a DB connection )');
        /*- Close DB connection -*/
        self::closeDbConnection();
        /*- Opens DB connection -*/
        $dbHost = self::$config['db']['dbHost'];
        $dbName = self::$config['db']['dbName'];
        $dbCharset = self::$config['db']['dbCharset'];
        $dbUser = self::$config['db']['dbUser'];
        $dbPassword = self::$config['db']['dbPassword'];
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        self::$db = new PDO($dsn, $dbUser, $dbPassword, $opt);
        /*- Starts the pages routing -*/
        self::$requestUri = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty(self::$requestUri[1])) // if written controllerName :
        {
            self::$controllerName = ucfirst(strtolower(self::$requestUri[1])) . 'Controller';
            $path = self::$dirName . '/content/controllers/' . self::$controllerName . '.php';
            if (file_exists($path)) // if controller exists :
            {
                self::makeControllerInstance();
                if (!empty(self::$requestUri[2])) // if written actionName
                {
                    self::$actionName = 'action' . ucfirst(strtolower(self::$requestUri[2]));

                    if (method_exists(self::$controllerInstance, self::$actionName)) // if action exists :
                        self::$controllerInstance->runAction(self::$actionName);
                    else throw new exception('ERROR ! ( Call to undefined action )');
                } else self::$controllerInstance->runAction('actionIndex');
            } else throw new exception('Неправильный URL адрес :('); // - if controller not exists
        }
        else // homePage :
        {
            if (method_exists(self::$controllerInstance, 'actionIndex'))
                self::$controllerInstance->runAction('actionIndex');
            else
                throw new exception('ERROR ! ( Index action does not exist )');
        }
    }
}