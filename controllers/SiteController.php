<?php


class SiteController
{

    private $db;

    public function __construct()
    {
    }


    public function actionIndex()
    {

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

        PhoneBook::createPhone($prefix, $number, $name, $deleted);

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
        PhoneBook::updatePhone($id, $name, $prefix, $number);

        header('Location: /');

    }


}