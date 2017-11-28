<?php class CarController extends BaseController
{
    public function actionIndex()
    {
      echo 'I am CarController';
    }

    public function actionBMW()
    {
        Framework::useModel('Car');
//        echo '123';
        self::renderView('lol',['s'=> 123123]);
    }
}