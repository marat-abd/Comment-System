<?php 



class Site
{
	
	public static function getPhoneListById($id)
	{
		$id = intval($id);
		if($id)
		{
			
			$db = Db::getConnection();
			
			$phoneList = array();
			$id = 'abc@abc.ru';
			$result = $db->query("SELECT phones.phone FROM phones JOIN emails ON emails.id=phones.id_email WHERE emails.email='". $id . "'");
			
			$i = 0;
			while($row = $result->fetch())
			{
				$phoneList[$i]['phone'] = $row['phone'];
				$i++;
			}
			//$result->setFetchMode(PDO::FETCH_ASSOC);
			
			//$phoneItem = $result->fetch();
			
			return $phoneList;
			
		}
	}		
	
	public static function addPhone($phone, $email)
	{
		
		$db = Db::getConnection();
		
		$sql = 'INSERT INTO emails (email) VALUES (:email)';
		
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		$sql = 'SELECT id FROM emails WHERE email = :email';
		
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		$row = $result->fetch();
		$id = $row['id'];
		echo $sql;
		
		$sql = 'INSERT INTO phones (id_email, phone) VALUES (:id, :phone)';
		
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		$result->bindParam(':phone', $phone, PDO::PARAM_STR);
		$result->execute();
		
		
	}

	public static function checkPhone($phone)
	{
		if(strlen($phone) == 11)
		{
			return true;
		}
		return false;
	}	
	
	public static function checkEmail($email)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		return false;
	}
	
	public static function checkEmailExists($email)
	{
		$db = Db::getConnection();
		
		$sql = 'SELECT COUNT(*) FROM emails WHERE email = :email';
		
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		if($result->fetchColumn())
		{
			return true;
		}
		return false;
	}
	
}

?>