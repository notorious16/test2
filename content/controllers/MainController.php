<?php class MainController extends BaseController
{
    public function actionIndex()
    {
        Framework::useModel('Task');
        self::$data = TaskModel::getTasks();
        self::renderView(0, ['data' => self::$data]);
    }
    public function actionExit()
    {
        session_unset();
        session_destroy();
        header('Location:/');
    }
}
