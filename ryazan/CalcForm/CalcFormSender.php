<?php 

require_once ('CalcFormConfig.php'); 


// ���� ������ ������ "��������� ���������"
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
    
    // ���� ���� �� ���� �� ������������ ����� �� ���������
    if ((empty ($_POST['okno'])) OR (empty ($_POST['shirina'])) OR (empty ($_POST['visota'])) OR (empty ($_POST['UserName'])) OR (empty ($_POST['telefone'])))
    {
        // ������� ��������� � ���, ��� �� ��� ���� ���������
        echo $warning;              
    }
    
    // ���� ��� ���� ���������
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
	   // ���� ��������� email-����� �� �������� �� �������
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {   
            // ������� ��������������� ��������� � ������������� ������
            echo $email_warning;
            exit();
        }
*/        
        $message = "������: $UserName\n�������: $telefone\n�����: $User_email\n������� ����: $okno\n������: $shirina\n������: $visota\n�������: $profil\n�����������: $steklopaket\n����������: $podokon\n������: $otkos\n�����: $otliv\n��������� �����: $moskit";
        
        // ���� ��������� ���� ���������� �������
        if (mail ($mymail,$topic,$message, "Content-type:text/plain;charset = windows-1251\r\n"))
        {   
            // �������������� �� �������� � ���������� ��������
            echo "<meta http-equiv='Refresh' content='5; url=$url'>";
            
            // ������� ��������� �� �������� �������� � ������������� ������
            echo $success;
            exit();                     
        }
        
        // ���� ��������� �� ���� ����������
        else
        {
            // ������� ��������� �� ������ � ������������� ������
            echo $fail;
            exit();
        }        
    }     
}

// ���� �� ������ ������ "��������� ���������"
else
{
    // ������� ��������������� ��������� � ������� ������� ������� � �����������
    echo $direct_access;    
}
?>