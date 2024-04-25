<?php
class DB
{
    private $db;

    public function __construct()
    {
        $dbinfo = require 'dbinfo.php';
        $this->db = new PDO('mysql:host=' . $dbinfo['host'] . ';dbname=' . $dbinfo['dbname'], $dbinfo['login'], $dbinfo['password']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }

        // Выполняем запрос
        $stmt->execute();
        // Возвращаем ответ
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}