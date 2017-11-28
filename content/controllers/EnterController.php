<?php class EnterController extends BaseController
{
    public function actionIndex()
    {
        Framework::useModel('Enter');
        self::renderView('enter',['enter'=>2]);
    }
    public function actionTestreg()
    {
        Framework::useModel('Testreg');
        self::$data['auth'] = TestregModel::testAdm();
        self::$data['auth'] = self::$data['auth'][0];
        if(!empty(self::$data['auth'])){
//            echo 'VICTORY';
            $_SESSION['admin'] = self::$data['auth']['login'];
            header('Location:/');
        }else {
            echo 'Not right login or password';
        }
//        self::renderView(0, ['data' => self::$data]);
    }
}