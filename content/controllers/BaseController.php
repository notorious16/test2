<?php class BaseController
{
    public static $data = null;

    public static function renderView($template, $params = [])
    {
        if (empty($template)) $template = 'homepage';
        if (is_array($params)) extract($params); // wtf?
        ob_implicit_flush(0); // wtf?
        $template = Framework::$dirName . '/content/views/' . $template . '.php';
        require_once $template;
    }

    public function actionIndex()
    {
        header('Location:/');
    }

    public function actionError($e)
    {
        if (!empty($e))
            self::$data['msg'] = $e->getMessage();
        else
            self::$data['msg'] = 'Неизвестная ошибка!';
        self::renderView(0, ['name' => 'Ошибка!', 'msg' => self::$data['msg']]);
    }

    public function runAction($action)
    {
        $this->$action();
    }
}