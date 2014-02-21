<?php
namespace Jupis;
class Mensch
{
	private $changes = array();
	private $isAdmin = false;
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
	}
	public function setMitgliedsnummer($nummer)
	{
		if($this->mitgliedsnummer!=$nummer)
		{
			$this->changes[] = "mitgliedsnummer";
		}
		$this->mitgliedsnummer = $nummer;
		return true;
	}
	public function setMitgliedsart($art)
	{
		if(in_array($art, $this->get_enum_values("mitgliedsart")))
		{
			if($this->mitgliedsart!=$art)
			{
				$this->changes[] = "mitgliedsart";
			}
			$this->mitgliedsart = $art;
			return true;
		}
		return false;
	}
	public function setGender($gender)
	{
		if($this->gender!=$gender)
		{
			$this->changes[] = "gender";
		}
		$this->gernder = $gender;
	}
	public function setFirstname($name)
	{
		if($this->firstname!=$name)
		{
			$this->changes[] = "firstname";
		}
		$this->firstname = $name;
	}
	public function setLastname($name)
	{
		if($this->lastname!=$name)
		{
			$this->changes[] = "lastname";
		}
		$this->lastname = $name;
	}
	public function setBirthday($day)
	{
		if($this->birthday!=$day)
		{
			$this->changes[] = "birthday";
		}
		$this->birthday = $day;
	}
	public function setAdresszusatz($zusatz)
	{
		if($this->adresszusatz!=$zusatz)
		{
			$this->changes[] = "adresszusatz";
		}
		$this->adresszusatz = $zusatz;
	}
	public function setStreet($street)
	{
		if($this->street!=$street)
		{
			$this->changes[] = "street";
		}
		$this->street = $street;
	}
	public function setHousenumber($housenumber)
	{
		if($this->housenumber!=$housenumber)
		{
			$this->changes[] = "housenumber";
		}
		$this->housenumber = $housenumber;
	}
	public function setPC($pc)
	{
		if($this->pc!=$pc)
		{
			$this->changes[] = "pc";
		}
		$this->pc = $pc;
	}
	public function setCity($city)
	{
		if($this->city!=$city)
		{
			$this->changes[] = "city";
		}
		$this->city = $city;
	}
	public function setCountry($country)
	{
		if($this->country!=$country)
		{
			$this->changes[] = "country";
		}
		$this->country = $country;
	}
	public function setState($state)
	{
		if($this->mitgliedsart!=$art)
		{
			$this->changes[] = "mitgliedsart";
		}
		$this->state = $state;
	}
	public function setPhone($phone)
	{
		if($this->phone!=$phone)
		{
			$this->changes[] = "phone";
		}
		$this->phone = $phone;
	}
	public function setMobil($mobil)
	{
		if($this->mobil!=$mobil)
		{
			$this->changes[] = "mobil";
		}
		$this->mobil = $mobil;
	}
	public function setMail($mail)
	{
		if($this->mail!=$mail)
		{
			$this->changes[] = "mail";
		}
		$this->mail = $mail;
	}
	public function setPrivacyPolicy($privacyPolicy)
	{
		if($this->admin == false)
		{
			return false;
		}
		if($this->privacyPolicy!=$privacyPolicy)
		{
			$this->changes[] = "privacyPolicy";
		}
		$this->privacyPolicy=$privacyPolicy;
	}
	public function setKungPiratesMail($m)
	{
		if($this->jungPiratesMail!=$m)
		{
			$this->changes[] = "jungPiratesMail";
		}
		$this->jungPiratesMail=$m;
	}
	public function setClarification($clarification)
	{
		if($this->admin == false)
		{
			return false;
		}
		if($this->clarification!=$clarification)
		{
			$this->changes[] = "clarification";
		}
		$this->clarification = $clarification;
	}
	public function setNntpUser($nntp)
	{
		if($this->admin == false)
		{
			return false;
		}
		if($this->nntpUser!=$nntp)
		{
			$this->changes[] = "nntpUser";
		}
		$this->nntpUser = $nntpUser;
	}
	private function get_enum_values(  $field )
	{
	    $res = $this->pdo->query( "SHOW COLUMNS FROM menschen");
	    foreach($res as $r)
	    {
	    	if($r["Field"]=$field)
	    	{
	    		preg_match('/^enum\((.*)\)$/', $r["Type"], $matches);
	    		foreach( explode(',', $matches[1]) as $value )
			    {
			         $enum[] = trim( $value, "'" );
			    }
			    return $enum;
	    	}
	    }
	}
}
?>