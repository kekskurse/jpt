<?php
namespace Jupis;

class LoKo
{
	private $pdo = NULL;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
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
		return $res;
	}
	public function rmLoKoPeople($name)
	{
		$sql = "DELETE FROM `lokomenschen` WHERE twitter = ?";
		$this->pdo->insert($sql, array($name));
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
			$this->nntp->post("pirates.youth.de.test", $subject, $text, "loko@junge-piraten.de", array()); //Return true or false
			$send[]="pirates.youth.de.test";
		}
		else
		{
			$list = $this->nntp->listGroups();
			foreach($list as $entry)
			{
				if($entry[0]=="pirates.youth.de.announce"||substr($entry[0],0,24)=="pirates.youth.de.region.")
				{
					$this->nntp->post($entry[0], $subject, $text, "loko@junge-piraten.de", array());
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
		}
		else
		{
			foreach($mails as $mail)
			{
				$this->mail->clearAddresses();
				$this->mail->addAddress($mail);
				$send[]=$mail;
				$this->mail->send();
			}
		}
		return $send;
	}
	public function createGroup($name, $mail, $more)
	{
		$sql = "INSERT INTO `lokogruppen`(`name`, `mail`, `more`, `aktiv`) VALUES (?, ?, ? , 1)";
		$id = $this->pdo->insertID($sql, array($name, $mail, $more));
	}
	public function updateGroup($id, $name, $mail, $more, $aktiv)
	{
		$sql = "UPDATE `lokogruppen` SET `name`=?,`mail`=?,`more`=?, `aktiv` = ? WHERE id = ?";
		$this->pdo->insert($sql, array($name, $mail, $more,$aktiv, $id));
	}
	public function delGroup($id)
	{
		$sql = "DELETE FROM `lokogruppen` WHERE id = ?";
		$this->pdo->insert($sql, array($id));
	}
	public function listGroups()
	{
		$sql = 'SELECT `id`, `name` AS `groupName`, `mail`, `more`, `aktiv`, `bundesland`, `typ`, `wiki`, CONCAT(`typ`, " ", `name`) AS `name` FROM `lokogruppen`';
		$res = $this->pdo->query($sql, array());
		return $res;
	}
	public function getGroups($id)
	{
		$sql = "SELECT `id`, `name`, `mail`, `more`, `aktiv` FROM `lokogruppen` WHERE id = ?";
		$res = $this->pdo->query($sql, array($id));
		return $res[0];
	}
	public function addPeople($name, $mail, $groupID, $more)
	{
		$sql = "INSERT INTO `lokopeople`(`name`, `mail`, `group`, `more`) VALUES (?, ?, ?, ?)";
		$res = $this->pdo->insertID($sql, array($name,$mail,$groupID,$more));
		return $res;
	}
	public function updatePeople($id, $name, $mail, $groupID, $more)
	{
		$sql = "UPDATE `lokopeople` SET `name`=?,`mail`=?,`group`=?,`more`=? WHERE id = ?";
		$this->pdo->insert($sql, array($name, $mail, $groupID, $more, $id));
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
		$sql = "DELETE FROM `lokopeople` WHERE id = ?";
		$this->pdo->insert($sql, array($id));
	}
}
?>