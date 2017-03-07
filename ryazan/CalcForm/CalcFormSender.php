<?php 

require_once ('CalcFormConfig.php'); 


// если нажата кнопка "отправить сообщение"
if (isset ($_POST['CalcFormSender']))
{
    
	$UserName = $_POST['UserName'];
	$telefone = $_POST['telefone'];
	$User_email = $_POST['User_email'];
	$okno = $_POST['okno'];
    $shirina = $_POST['shirina'];
    $visota = $_POST['visota'];
    $profil = $_POST['profil'];
	$steklopaket = $_POST['steklopaket'];
	$podokon = $_POST['podokon'];
	$otkos = $_POST['otkos'];
	$otliv=$_POST['otliv'];
	$moskit = $_POST['moskit'];
    
    // если хотя бы одно из обязательных полей не заполнено
    if ((empty ($_POST['okno'])) OR (empty ($_POST['shirina'])) OR (empty ($_POST['visota'])) OR (empty ($_POST['UserName'])) OR (empty ($_POST['telefone'])))
    {
        // выводим сообщение о том, что не все поля заполнены
        echo $warning;              
    }
    
    // если все поля заполнены
    else
    {   
	
	$UserName = stripslashes (htmlspecialchars($UserName));
	
	$telefone = stripslashes (htmlspecialchars($telefone));
	$User_email = stripslashes (htmlspecialchars($User_email));
	
        $okno = stripslashes (htmlspecialchars($okno));
        $shirina = stripslashes (htmlspecialchars($shirina));
        $visota = stripslashes (htmlspecialchars($visota));
		$profil = stripslashes (htmlspecialchars($profil));
		$steklopaket = stripslashes (htmlspecialchars($steklopaket));
		$podokon = stripslashes (htmlspecialchars($podokon));
		$otkos = stripslashes (htmlspecialchars($otkos));
		$moskit = stripslashes (htmlspecialchars($moskit));
		
		$UserName = iconv("utf-8", "windows-1251", $UserName);
        
/*       
	   // если введенный email-адрес не подходит по формату
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {   
            // выводим предупреждающее сообщение и останавливаем скрипт
            echo $email_warning;
            exit();
        }
*/        
        $message = "Клиент: $UserName\nТелефон: $telefone\nПочта: $User_email\nВыбрано окно: $okno\nШирина: $shirina\nВысота: $visota\nПрофиль: $profil\nСтеклопакет: $steklopaket\nПодоконник: $podokon\nОткосы: $otkos\nОтлив: $otliv\nМоскитная сетка: $moskit";
        
        // если сообщение было отправлено успешно
        if (mail ($mymail,$topic,$message, "Content-type:text/plain;charset = windows-1251\r\n"))
        {   
            // перенаправляем на задааную в настройках страницу
            echo "<meta http-equiv='Refresh' content='5; url=$url'>";
            
            // Выводим сообщение об успешной отправке и останавливаем скрипт
            echo $success;
            exit();                     
        }
        
        // если сообщение не было отправлено
        else
        {
            // выводим сообщение об ошибке и останавливаем скрипт
            echo $fail;
            exit();
        }        
    }     
}

// если не нажата кнопка "отправить сообщение"
else
{
    // выводим предупреждающее сообщение о попытке прямого доступа к обработчику
    echo $direct_access;    
}
?>