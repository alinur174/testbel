<?php


class SiteController
{

    private $db;

    protected $prefixList = [
        '49', '00', '86', '38', '04'
    ];

    public function __construct()
    {
    }


    public function actionIndex()
    {
        $res = PhoneBook::checkUnique('23');

        $phones = PhoneBook::getPhones();
        require_once(ROOT . '/views/index.php');
        return true;

    }


    public function actionCreateNumber()
    {

        $prefix = $_POST['prefix'];
        $number = $_POST['number'];
        $name = $_POST['name'];
        $deleted = 0;

        if (PhoneBook::checkUnique($number)) {
            $_SESSION['error'] = true;
            header('Location: /');
        }
        PhoneBook::createPhone($prefix, $number, $name, $deleted);
        session_destroy();
        header('Location: /');


    }

    public function actionDeleteNumber($id)
    {

        PhoneBook::deletePhone($id);

        header('Location: /');

    }


    public function actionUpdateNumber($id)
    {

        $name = $_POST['name'];
        $prefix = $_POST['prefix'];
        $number = $_POST['number'];
        if (PhoneBook::checkUnique($number)) {
            $_SESSION['error'] = true;
            header('Location: /');
        }

        PhoneBook::updatePhone($id, $name, $prefix, $number);
        session_destroy();

        header('Location: /');

    }


    public function actionSearchName()
    {
        $name = $_POST['name'];
        if (!empty($name)) {
            echo json_encode($result = PhoneBook::searchClient($name));
        }

    }

}