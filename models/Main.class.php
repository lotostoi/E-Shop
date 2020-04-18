<?php

include "Mysql.class.php";


class DB

{   // добавляем запросы к БД;
    use QueryToMysqli;

    //db fields
    private $servName;
    private $userName;
    private $password;
    private $dbName;
    public $query;
    //  connect to DB
    public $link;


    private static $instance;  // Экземпляр объекта
    // Защищаем от создания через new Singleton
    private function __construct()
    { /* ... @return Singleton */
    }
    // Защищаем от создания через клонирование
    private function __clone()
    { /* ... @return Singleton */
    }
    // Защищаем от создания через unserialize
    private function __wakeup()
    { /* ... @return Singleton */
    }
    // Возвращает единственный экземпляр класса. @return Singleton
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setOptionsDB($servName, $userName, $password, $dbName)
    {
        $this->servName = $servName;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->connectDB();
    }

    private function connectDB()
    {
        $link =  mysqli_connect($this->servName, $this->userName, $this->password, $this->dbName);
        if ($link) {
            $this->link = $link;
        } else {
            $error = mysqli_error($this->link);
            echo "Ошибка соеденения -" . mysqli_connect_error();
        }
    }

    private function printError()
    {
        echo  "Error - " . mysqli_error($this->link);
        //  return;
    }



    // *******************The methods for working with database************//
    // *******************The methods for working with database************//
    // *******************The methods for working with database************//

    public  function getArr($nameTable)
    {
        $res = mysqli_query($this->link, "SELECT * FROM $nameTable")  ?: $this->printError();
        $i = 0;
        while ($content = mysqli_fetch_assoc($res)) {
            $arr[$i++] = $content;
        }
        return $arr;
    }

    public function getArrSortData($nameTable, $field)
    {
        $res = mysqli_query($this->link, $this->sort_max_min($nameTable, $field)) ?: $this->printError();
        $i = 0;
        while ($content = mysqli_fetch_assoc($res)) {
            $arr[$i++] = $content;
        }
        return $arr;
    }

    public function getArrPole($nameTable, $pole)
    {
        $res = mysqli_query($this->link,  $this->selectAll($nameTable)) ?: $this->printError();
        $i = 0;
        while ($content = mysqli_fetch_assoc($res)) {
            $arr[$i++] = $content["$pole"];
        }
        return $arr;
    }

    // finding $currentVal in the $field in $table and returning array 
    // with flag (true/false) and index at which there was a coincidence
    public function find_el_table($tableName, $field, $currentVal)
    {

        $arr = $this->getArr($tableName);

        foreach ($arr as $key => $val) {
            if ($val["$field"] == $currentVal) {
                $flag = true;
                $index = $key;
                $id_el = $val['id'];
                $row = $val;
            }
        };
        return ['flag' => $flag, 'index' => $index, "id" => $id_el, "el" => $row];
    }

    // ищет $currentVal в поле $field таблици $table и возвращет  
    // массив id строк, удовлетворяющих условию поиска
    public function getArrIdRows($tableName, $field, $currentVal)
    {
        $arr = $this->getArr($tableName);
        $i = 0;
        foreach ($arr as $key => $val) {
            if ($val["$field"] == $currentVal) {
                $newArr[$i++] = $arr["$key"]["id"];
            }
        }
        return $newArr;
    }

    // ищет $currentVal в поле $field таблици $table и возвращет массив 
    // массив  строк, удовлетворяющих условию поиска
    public function getArrRows($tableName, $field, $currentVal)
    {
        $arr = $this->getArr($tableName);
        $i = 0;
        foreach ($arr as $key => $val) {
            if ($val["$field"] == $currentVal) {
                $newArr[$i++] = $arr["$key"];
            }
        }
        return $newArr;
    }

    // вычисляет общую сумму корзины и количество товаров
    public function all_sum_cart($nameCartTable, $id_user)
    {
        $newArr = $this->getArrIdRows($nameCartTable, 'id_user', $id_user);
        foreach ($newArr as $key => $val) {
            $res = mysqli_query($this->link, $this->select_row_id($val, CART));
            $str = mysqli_fetch_assoc($res);
            $quant = $str['quantity'];
            $id = $str['id_product'];
            $res_pr = mysqli_fetch_assoc(mysqli_query($this->link,  $this->select_row_id($id, COTALOG)));
            $price_cart = $res_pr['price'];
            $allQuant += $quant;
            $allSum += $quant * $price_cart;
        }
        return ['sum' =>  $allSum, "quant" =>  $allQuant];
    }

    public function getJsonTable_newUser()
    {
        $arrTabel = $this->getArr($this->link, NEW_USER);
        return json_encode($arrTabel);
    }
}
