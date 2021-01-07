
<?php
echo $_POST['action'];
echo strcmp('delete','delete');
if(strcmp($_POST['action'],'insert') == 0) 
{
echo 'success';
}

 else
 {
 	echo 'failed';
 }?>
