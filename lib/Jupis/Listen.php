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
	public function listLists($aktiv = 1)
	{

		$sql = "SELECT `id`, `name`, `aktiv` FROM `listen_listen`";
		if($aktiv==1)
		{
			$sql.="WHERE `aktiv` = 1";
		}
		$res = $this->pdo->query($sql, array());
		return $res;
	}
	public function searchList($searchword)
	{
		if($searchword=="")
		{
			return $this->listLists();
		}
		$listen = $this->listLists(0);
		$tmp = array();
		foreach($listen as $liste)
		{
			if(strpos(strtolower($liste["name"]), strtolower($searchword))!==false)
			{
				$tmp[]=$liste;
			}
		}
		return $tmp;
	}
	public function addFeld($listID, $bezeichnung, $typ)
	{
		$possibleTypen = array("int", "string", "text");
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
				trigger_error("Value for Field ".$s["name"]." missing");
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
	public function listEntries($id, $returnArray = false)
	{
		$sql = "SELECT `id` FROM `listen_entries` WHERE `liste` = ?";
		$res = $this->pdo->query($sql, array($id));
		$structur = $this->getListStructur($id);
		$data = array();
		foreach($res as $r)
		{
			$sql = "SELECT `listen_value`.`id`, `listen_felder`.`name`, `value` FROM `listen_value` LEFT JOIN `listen_felder` ON `listen_felder`.`id` = `feld` WHERE `entry` = ?";
			$res2 = $this->pdo->query($sql, array($r["id"]));
			$tmp = array();
			foreach($res2 as $r2)
			{
				if($returnArray)
				{
					$tmp[]=$r2["value"];
				}
				else
				{
					$tmp[$r2["name"]]=$r2["value"];
				}
			}
			$data[]=$tmp;
		}
		return $data;

	}
	public function searchEntries($id, $q)
	{
		$allData = $this->listEntries($id, true);
		if($q=="")
		{
			return $allData;
		}
		$tmp = array();
		foreach($allData as $data)
		{
			foreach($data as $value)
			{
				if(strpos(strtolower($value), strtolower($q))!==false)
				{
					$tmp[]=$data;
				}
			}
		}
		return $tmp;
	}
}
?>