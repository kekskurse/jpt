<?php
namespace Jupis;

class Zeitung
{
	private $pdo = NULL;
	private $log = NULL;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
		$this->log = new Log();
		$this->log->setPDO($pdo);
	}
	public function listePeople()
	{
		$sql = "SELECT `id`, `name`, `mail`, `topics`, `more` FROM `zeitung_people`";
		$res = $this->pdo->query($sql, array());
		return $res;
	}
	public function searchPeople($q)
	{
		$list  = $this->listePeople();
		if($q=="")
		{
			return $list;
		}
		$tmp = array();
		foreach($list as $entry)
		{
			if(strpos(strtolower($entry["name"]), strtolower($q))!==false)
			{
				$tmp[] = $entry;
			}
			elseif(strpos(strtolower($entry["topics"]), strtolower($q))!==false)
			{
				$tmp[] = $entry;
			}
		}
		return $tmp;
	}
	public function getPeople($id)
	{
		$sql = "SELECT `id`, `name`, `mail`, `topics`, `more` FROM `zeitung_people` WHERE id = ?";
		$res = $this->pdo->query($sql, array($id));
		return $res[0];
	}
	public function listAllTopics()
	{
		$people = $this->listePeople();
		$tmp = array();
		foreach($people as $entry)
		{
			$topics = explode(",", $entry["topics"]);
			foreach($topics as $t)
			{
				if(!in_array($t, $tmp))
				{
					$tmp[] = $t;
				}
			}
		}
		return $tmp;
	}
	public function searchTopic($q)
	{
		$list = $this->listAllTopics();
		#var_dump($list);
		$tmp = array();
		foreach($list as $e)
		{
			if(strpos(strtolower($e), strtolower($q))!==false)
			{
				$tmp[] = $e;
			}
		}
		return $tmp;
	}
	public function addPeople($name, $mail, $topics, $more)
	{
		$sql = "INSERT INTO `zeitung_people`(`name`, `mail`, `topics`, `more`) VALUES (?, ?, ?, ?)";
		$param = array($name,$mail,$topics,$more);
		$res = $this->pdo->insertID($sql, $param);
		$this->log->addLog("Zeitung People", "create", NULL, $res, $name, NULL, $this->log->var_dump($param));
		return $res;
	}
	public function updatePeople($id, $name, $mail, $topics, $more)
	{
		$oldValue = $this->getPeople($id);
		$sql = "UPDATE `zeitung_people` SET `name`=?,`mail`=?,`topics`=?,`more`=? WHERE id = ?";
		$param = array($name, $mail, $topics, $more, $id);
		$this->pdo->insert($sql, $param);
		$this->log->addLog("Zeitung People", "edit", NULL, $id, $name, $this->log->var_dump($oldValue), $this->log->var_dump($param));
	}
		public function delPeople($id)
	{
		$oldValue = $this->getPeople($id);
		$sql = "DELETE FROM `zeitung_people` WHERE id = ?";
		$this->pdo->insert($sql, array($id));
		$this->log->addLog("Zeitung People", "remove", NULL, $id, $oldValue["name"], $this->log->var_dump($oldValue), NULL);
	}
}