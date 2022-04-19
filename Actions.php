<?php
class Actions
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->database();
    }

    public function database()
    {
        return new PDO('sqlite:'.__DIR__.'/shop.db');
    }

    public function allItems()
    {
        $sth = $this->db->query('SELECT * FROM catalog');
        return $sth->fetchAll();
    }

    public function addToBasket()
    {
        $response = 'Что то пошло не так!';
        if (!empty($_POST)) {
            if (!empty($_SESSION)) {
                foreach ($_SESSION as $item) {
                    if ($item['id'] === $_POST['id']) {
                        echo 'Товар уже добавлен в корзину!!';
                        exit();
                    }
                }
            }
            $_SESSION['item_'.$_POST['id']] = [
                'id' => $_POST['id'],
                'count' => $_POST['countItem'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                ];
            $response = 'ТОвар добален в корзину!';
        }

        echo $response;
    }

    public function deleteItem($id)
    {
        $data = [];
        if($_SESSION) {
            foreach ($_SESSION as $key => $item) {
                if ($item['id'] !== $id) {
                    $data['item_'.$key] = $item;
                }
            }
        }
        $_SESSION = $data;
    }


}