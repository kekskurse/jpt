<?php
namespace Jupis;
class Log
{
	private $pdo;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
	}	
	public function addLog($class, $aktion, $feld, $entryID, $entryName, $oldValue, $newValue)
	{
		$sql = "INSERT INTO `log`(`class`, `user`, `aktion`, `feld`, `entryID`, `entryName`, `oldValue`, `newValue`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$this->pdo->insert($sql, array($class, $_SESSION["username"], $aktion, $feld, $entryID, $entryName, $oldValue, $newValue));
	}
	public function var_dump($a)
	{
		ob_start();
		var_dump($a);
		$result = ob_get_clean();
		return $result;
	}
}
?>