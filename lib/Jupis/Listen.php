<?php
namespace Jupis;
class Listen
{
	private $pdo = NULL;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
	}
	public function createList($name)
	{
		$sql = "INSERT INTO `listen_listen`(`name`, `aktiv`) VALUES (?, 1)";
		$id = $this->pdo->insertID($sql, array($name));
		return $id;
	}
	public function addFeld($listID, $bezeichnung, $typ)
	{
		$possibleTypen("int", "string", "text");
		if(!in_array($typ, $possibleTypen))
		{
			trigger_error("Wrong Feld Typ");
		}
		$sql = "INSERT INTO `listen_felder`(`liste`, `typ`, `name`) VALUES (?, ?, ?)";
		$id = $this->pdo->insertID($sql, array($listID, $typ, $bezeichnung));
		return $id;
	}
	public function delFeld($feldID)
	{
		$sql = "DELETE FROM `listen_value` WHERE `feld` = ?";
		$this->pdo->insert($sql, array($feldID));
		$sql = "DELETE FROM `listen_felder` WHERE `id` = ?";
		$this->pdo->insert($sql, array($feldID));
	}
	public function addEntry($listID, $data)
	{
		$stuctur = $this->getListStructur($listID);
		$dataTMP = $data;
		$values = array();
		foreach($stuctur as $s)
		{
			if(!isset($dataTMP[$s["name"]]))
			{
				trigger_error("Value for Field ".$s." missing");
				return false;
			}
			$values[$s["id"]]=$dataTMP[$s["name"]];
			//Typ Überprüfung
			unset($dataTMP[$s["name"]]);
		}
		if(count($dataTMP)>0)
		{
			trigger_error("To Many Values");
			return false;
		}
		$entryID = $this->createEntrie($listID);
		foreach($values as $key => $value)
		{
			$this->addValue($entryID, $key, $value);
		}
		return $entryID;
	}
	public function delEntry($id)
	{
		$sql = "DELETE FROM `listen_value` WHERE `entry` = ?";
		$this->pdo->insert($sql, array($feldID));
		$sql = "DELETE FROM `listen_entries` WHERE `id` = ?";
		$this->pdo->insert($sql, array($feldID));
	}
	public function getListStructur($listID)
	{
		$sql = "SELECT `id`, `typ`, `name` FROM `listen_felder` WHERE liste = ?";
		$res = $this->pdo->query($sql, array($listID));
		return $res;
	}
	private function createEntrie($listID)
	{
		$sql = "INSERT INTO `listen_entries`(`liste`) VALUES (?)";
		$id = $this->pdo->insertID($sql, array($listID));
		return $id;
	}
	private function addValue($entryID, $fieldID, $value)
	{
		$sql = "INSERT INTO `listen_value`(`entry`, `feld`, `value`) VALUES (?, ?, ?)";
		$id = $this->pdo->insertID($sql, array($entryID, $fieldID, $value));
		return $id;
	}
}
?>