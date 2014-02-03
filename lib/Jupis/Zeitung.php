<?php
namespace Jupis;

class Zeitung
{
	private $pdo = NULL;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
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
		$res = $this->pdo->insertID($sql, array($name,$mail,$topics,$more));
		return $res;
	}
	public function updatePeople($id, $name, $mail, $topics, $more)
	{
		$sql = "UPDATE `zeitung_people` SET `name`=?,`mail`=?,`topics`=?,`more`=? WHERE id = ?";
		$this->pdo->insert($sql, array($name, $mail, $topics, $more, $id));
	}
		public function delPeople($id)
	{
		$sql = "DELETE FROM `zeitung_people` WHERE id = ?";
		$this->pdo->insert($sql, array($id));
	}
}