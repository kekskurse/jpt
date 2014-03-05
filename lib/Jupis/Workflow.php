<?php
namespace Jupis;

class Workflow
{
	private $pdo = null;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
	}
	public function addWorkflowGroup($name, $aktiv)
	{
		$sql = 'INSERT INTO `workflow_gruppen`(`name`, `aktiv`) VALUES (?, ?)';
		$id = $this->pdo->insertID($sql, array($name, $aktiv));
		return $id;
	}
	public function listWorkflowGroups($aktiv = 1)
	{
		$sql = 'SELECT * FROM `workflow_gruppen`';
		$params = array();
		if($aktiv === 1 || $aktiv === 0)
		{
			$sql .= " WHERE `aktiv` = ?";
			$params[] = $aktiv;
		}
		$res = $this->pdo->query($sql, $params);
		return $res;
	}
	public function delWorkflowGroup($id)
	{
		$sql = 'DELETE FROM `workflow_gruppen` WHERE id =  ?';
		$this->pdo->insert($sql, array($id));
		return true;
	}
	public function updateWorkflowGrop($id, $name, $aktiv)
	{
		$sql = 'UPDATE `workflow_gruppen` SET `name`=?,`aktiv`=? WHERE `id`=?';
		$this->pdo->insert($sql, array($name, $aktiv, $id));
		return true;
	}
	public function getWorkflowGroup($id)
	{
		$sql = "SELECT * FROM `workflow_gruppen` WHERE id = ?";
		$res = $this->pdo->query($sql, array($id));
		return $res[0];
	}
}