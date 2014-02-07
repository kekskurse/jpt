<?php
namespace Jupis;

class LoKo
{
	private $pdo = NULL;
	private $log = NULL;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
		$this->log = new Log();
		$this->log->setPDO($pdo);
	}
	public function getLoKoPeople()
	{
		$sql = "SELECT `twitter` AS `name` FROM `lokomenschen`";
		$res = $this->pdo->query($sql, array());
		return $res;
	}
	public function addLoKoPeople($name)
	{
		$sql = "INSERT INTO `lokomenschen`(`twitter`) VALUES (?)";
		$res = $this->pdo->insertID($sql, array($name));
		$this->log->addLog("LoKoPeople", "create", NULL, $res, $name, NULL, $name);
		return $res;
	}
	public function rmLoKoPeople($name)
	{
		$sql = "DELETE FROM `lokomenschen` WHERE twitter = ?";
		$this->pdo->insert($sql, array($name));
		$this->log->addLog("LoKoPeople", "remove", NULL, NULL, $name, $name, NULL);
		return true;
	}
	public function setNNTPData($user, $pw)
	{
		$nntp = new \SSP\NNTP\NNTP();
		$nntp->connect("news.junge-piraten.de"); //Return true or false
		$login = $nntp->autentifizierung($user, $pw); //Return true or false
		$this->nntp = $nntp;
		return $login;
	}
	public function setSMTPData($user, $pw)
	{
		$this->mail = new \PHPMailer();

		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'mail.junge-piraten.de';  // Specify main and backup server
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = $user;                            // SMTP username
		$this->mail->Password = $pw;                           // SMTP password
		$this->mail->SMTPSecure = 'tls'; 
	}
	public function inviteNNTP($subject, $text, $test = true)
	{
		$send = array();
		if($test)
		{
			$res = $this->nntp->post("pirates.youth.de.test", $subject, $text, "loko@junge-piraten.de", array()); //Return true or false
			$send[]="pirates.youth.de.test";
			$this->log->addLog("LoKo", "nntp", NULL, NULL, "invite pirates.youth.de.test", NULL, $res);
		}
		else
		{
			$list = $this->nntp->listGroups();
			foreach($list as $entry)
			{
				if($entry[0]=="pirates.youth.de.announce"||$entry[0]=="pirates.youth.de.orga.loko"||substr($entry[0],0,24)=="pirates.youth.de.region.")
				{
					$res = $this->nntp->post($entry[0], $subject, $text, "loko@junge-piraten.de", array());
					$this->log->addLog("LoKo", "nntp", NULL, NULL, "invite $entry[0]", NULL, $res);
					$send[]=$entry[0];
				}
			}
			#var_dump($list);
		}
		return $send;
	}
	public function invitePeople($subject, $text, $mails, $test=true, $testTo = null)
	{
		$send = array();
		$text = mb_convert_encoding($text, "ISO-8859-1", "UTF-8");
		$this->mail->From = 'loko@junge-piraten.de';
		$this->mail->FromName = 'LoKo Derps';
		$this->mail->Subject = $subject;
		$this->mail->Body    = $text;
		$this->mail->isHTML(false);
		if($test)
		{
			#echo mb_detect_encoding($text);
			$this->mail->addAddress($testTo);  // Add a recipient
			$send[] = $testTo;
			$this->mail->send();
			$this->log->addLog("LoKo", "mail", NULL, NULL, "invite ".$testTo, NULL, NULL);
		}
		else
		{
			foreach($mails as $mail)
			{
				$this->mail->clearAddresses();
				$this->mail->addAddress($mail);
				$send[]=$mail;
				$this->mail->send();
				$this->log->addLog("LoKo", "mail", NULL, NULL, "invite ".$mail, NULL, NULL);
			}
		}
		return $send;
	}
	public function sendMail($subject, $text, $to, $peopleID=0, $test = true, $testTo)
	{
		if($peopleID!=0)
		{
			$detais = $this->getPeople($peopleID);
			$text = str_replace("%name%", $detais["name"], $text);
			$text = str_replace("%group%", $detais["groupName"], $text);
		}
		$text = mb_convert_encoding($text, "ISO-8859-1", "UTF-8");
		$this->mail->From = 'loko@junge-piraten.de';
		$this->mail->FromName = 'LoKo Derps';
		$this->mail->Subject = $subject;
		$this->mail->Body    = $text;
		$this->mail->isHTML(false);
		if($test)
		{
			#echo mb_detect_encoding($text);
			$this->mail->addAddress($testTo);  // Add a recipient
			$send[] = $testTo;
			$this->mail->send();
			return $testTo;
		}
		else
		{
			$this->mail->clearAddresses();
			$this->mail->addAddress($to);
			$send[]=$to;
			$this->mail->send();
		}
		$this->log->addLog("LoKo", "mail", NULL, NULL, "sendMail ", NULL, $this->log->var_dump($send));
		return $to;

	}
	public function createGroup($name, $mail, $more, $aktiv, $typ, $bundesland, $wiki)
	{
		#var_dump($wiki);exit();
		$sql = "INSERT INTO `lokogruppen`(`name`, `mail`, `more`, `aktiv`, `typ`, `bundesland`, `wiki`) VALUES (?, ?, ? , ?, ?, ?, ?)";
		$param = array($name, $mail, $more, $aktiv, $typ, $bundesland, $wiki);
		$id = $this->pdo->insertID($sql, $param);
		$this->log->addLog("LoKo Group", "create", NULL, $id, $name, NULL, $this->log->var_dump($param));
	}
	public function updateGroup($id, $name, $mail, $more, $aktiv, $typ, $bundesland, $wiki)
	{
		$oldValue = $this->getGroups($id);
		$sql = "UPDATE `lokogruppen` SET `name`=?,`mail`=?,`more`=?, `aktiv` = ?, `bundesland` = ?, `typ` = ?, `wiki`= ? WHERE id = ?";
		$this->pdo->insert($sql, array($name, $mail, $more,$aktiv,$bundesland, $typ, $wiki, $id));
		$this->log->addLog("LoKo Group", "edit", NULL, $id, $name, $this->log->var_dump($oldValue), $this->log->var_dump($param));
	}
	public function delGroup($id)
	{
		$oldValue = $this->getGroups($id);
		$sql = "DELETE FROM `lokogruppen` WHERE id = ?";
		$this->pdo->insert($sql, array($id));
		$this->log->addLog("LoKo Group", "edit", NULL, $id, $name, $this->log->var_dump($oldValue), NULL);
	}
	public function listGroups($aktiv = 1)
	{
		$sql = 'SELECT `id`, `name` AS `groupName`, `mail`, `more`, `aktiv`, `bundesland`, `typ`, `wiki`, CONCAT(`typ`, " ", `name`) AS `name` FROM `lokogruppen`';
		if($aktiv==1)
		{
			$sql .= 'WHERE `aktiv` = 1';
		}
		$res = $this->pdo->query($sql, array());
		return $res;
	}
	public function searchGroups($searchstring)
	{
		#$sql = 'SELECT `id`, `name` AS `groupName`, `mail`, `more`, `aktiv`, `bundesland`, `typ`, `wiki`, CONCAT(`typ`, " ", `name`) AS `name` FROM `lokogruppen` WHERE `name` LIKE "%?%"';
		#$res = $this->pdo->query($sql, array($searchstring));
		#var_dump($res);
		if($searchstring=="")
		{
			return $this->listGroups();
		}
		$res = $this->listGroups(0);
		$tmp = array();
		foreach($res as $r)
		{
			//NAME
			if(strpos(strtolower($r["name"]), strtolower($searchstring)))
			{
				$tmp[] = $r;
			}
			//Bundesland
			if(strtolower($r["bundesland"])==strtolower($searchstring))
			{
				$tmp[] = $r;
			}
		}
		return $tmp;
	}
	public function getGroups($id)
	{
		$sql = 'SELECT `id`, `name` AS `groupName`, `mail`, `more`, `aktiv`, `bundesland`, `typ`, `wiki`, CONCAT(`typ`, " ", `name`) AS `name` FROM `lokogruppen` WHERE id = ?';
		$res = $this->pdo->query($sql, array($id));
		return $res[0];
	}
	public function addPeople($name, $mail, $groupID, $more)
	{
		$sql = "INSERT INTO `lokopeople`(`name`, `mail`, `group`, `more`) VALUES (?, ?, ?, ?)";
		$param = array($name,$mail,$groupID,$more);
		$res = $this->pdo->insertID($sql, $param);
		$this->log->addLog("LoKo People", "create", NULL, $res, $name, NULL, $this->log->var_dump($param));
		return $res;
	}
	public function updatePeople($id, $name, $mail, $groupID, $more)
	{
		$oldValue = $this->getPeople($id);
		$sql = "UPDATE `lokopeople` SET `name`=?,`mail`=?,`group`=?,`more`=? WHERE id = ?";
		$param = array($name, $mail, $groupID, $more, $id);
		$this->pdo->insert($sql, $param);
		$this->log->addLog("LoKo People", "edit", NULL, $id, $name, $this->log->var_dump($oldValue), $this->log->var_dump($param));
	}
	public function listPeople()
	{
		$sql = "SELECT `lokopeople`.`id`, `lokopeople`.`name`, `lokopeople`.`mail`, `lokopeople`.`group`, `lokopeople`.`more`, `lokogruppen`.`name` as `groupName`  FROM `lokopeople`  LEFT JOIN `lokogruppen` ON `lokogruppen`.`id` = `lokopeople`.`group`";
		$res = $this->pdo->query($sql, array());
		return $res;
	}
	public function getPeople($id)
	{
		$sql = "SELECT `lokopeople`.`id`, `lokopeople`.`name`, `lokopeople`.`mail`, `lokopeople`.`group`, `lokopeople`.`more`, `lokogruppen`.`name` as `groupName`  FROM `lokopeople`  LEFT JOIN `lokogruppen` ON `lokogruppen`.`id` = `lokopeople`.`group` WHERE `lokopeople`.`id` = ?";
		$res = $this->pdo->query($sql, array($id));
		return $res[0];
	}
	public function delPeople($id)
	{
		$oldValue = $this->getPeople($id);
		$sql = "DELETE FROM `lokopeople` WHERE id = ?";
		$this->pdo->insert($sql, array($id));
		$this->log->addLog("LoKo People", "remove", NULL, $id, $oldValue["name"], $this->log->var_dump($oldValue), NULL);
	}
	public function searchPeople($searchstring)
	{
		#$sql = 'SELECT `id`, `name` AS `groupName`, `mail`, `more`, `aktiv`, `bundesland`, `typ`, `wiki`, CONCAT(`typ`, " ", `name`) AS `name` FROM `lokogruppen` WHERE `name` LIKE "%?%"';
		#$res = $this->pdo->query($sql, array($searchstring));
		#var_dump($res);
		if($searchstring=="")
		{
			return $this->listPeople();
		}
		$res = $this->listPeople();
		$tmp = array();
		foreach($res as $r)
		{
			//NAME
			if(strpos(strtolower($r["name"]), strtolower($searchstring))!==false)
			{
				$tmp[] = $r;
			}
			if($searchstring=="group:".$r["group"])
			{
				$tmp[] = $r;
			}
		}
		return $tmp;
	}
}
?>
