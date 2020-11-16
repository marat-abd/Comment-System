<?php

include_once ROOT . '/models/Site.php';

class SiteController
{

    public function actionIndex()
    {
		
		
        require_once(ROOT . '/views/site/index.php');
        return true;
    }


	public function actionAdd()
    {
		
		$phone = '';
		$email = '';
		$result = false;
		
		if(isset($_POST['submit']))
		{
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			
			$errors = false;
			
			if(!Site::checkPhone($phone))
			{
				$errors[] = 'Телефон состоит из 11 символов';
			}
			
			if(!Site::checkEmail($email))
			{
				$errors[] = 'Неправильный формат';
			}
			
			if(Site::checkEmailExists($email))
			{
				$errors[] = 'E-mail already exists';
			}
			
			if($errors == false)
			{
				$result = Site::addPhone($phone, $email);
			}
		}
		
        require_once(ROOT . '/views/site/add.php');
        return true;
    }
	
	public function actionView()
    {
        require_once(ROOT . '/views/site/view.php');
        return true;
    }
	
	public function actionOut($number)
    {
		if($number)
		{
			$phoneList = Site::getPhoneListById($number);
			require_once ROOT. '/views/site/view.php';
		}
		//require_once(ROOT . '/views/site/view.php');
        return true;
    }
}
