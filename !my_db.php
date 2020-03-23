<?php
class Database
{
	public $pdo;
	function __construct() {
		$this->pdo = new PDO("mysql:host=localhost; dbname=test", "root", "");
	}
	
	// Выводим список всех записей.
	function getAll($table) {		
		$sql = "SELECT * FROM $table";
		$statement = $this->pdo->prepare($sql); 
		$statement->execute(); 
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	// Вывод одной записи.
	function getOne($table, $id) {		
		$statement = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
		$statement->bindParam(":id", $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	// Сохранение новой записи.
	function insert($table, $data) {	
		// Вытащим ключи массива и сформировать строку и метки.
		$keys = array_keys($data);
		$stringOfKeys = implode(',', $keys);
		$placeholders = ":".implode(', :', $keys);		
		$sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)"; // это просто строка
		$statement = $this->pdo->prepare($sql);
		$statement->execute($data); // выполнение кода, возвращает true || false		
	}
	
		
	// Обновление статьи.
	function update($table, $data, $id) {	
		$fields = ''; // поля таблицы
		foreach($data as $key => $value) {
			$fields .= $key . "=:" . $key . ","; 
		}
		$fields = rtrim($fields, ","); // удаляем запятую справа
		
		$sql = "UPDATE $table SET $fields WHERE id=:id";
		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(":id", $id); 
		$statement->execute($data); // Передадим массив. На выходе: true || false		
	}	
	
	// Удаление записи.
	function delete($table, $id) {		
		$sql = "DELETE FROM $table WHERE id=:id";
		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(":id", $id);
		$statement->execute();	
	}

}