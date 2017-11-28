<?php class ExController extends BaseController
{
    public function actionIndex()
    {
        Framework::useModel('Task');
        self::renderView('createEx',['ex'=>1]);
    }
    
    public function actionParams(){
        Framework::useModel('Task');
        $data=TaskModel::redImg();
        if (!isset($data['error'])){
            header('Location:/');
//            self::renderView('params1',[
//            'name'     => $data['name'],
//            'mail'     => $data['email'],
//            'textarea' => $data['textarea'],
//            'imgUrl'   => $data['imgUrl']
//        ]);
        } else {
            self::renderView('params1', [
                    'error' => $data['error']
            ]);
        }

//
        // если хочу что-то передать во вьюшку
//        self::$data=
//        self::renderView('params',['data' =>self::$data]);
    }
}