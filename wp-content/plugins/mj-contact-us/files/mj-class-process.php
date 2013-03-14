<?php class mjContactPRO{

	public static function SendMail(){

		if(isset($_POST['mj_submit']) && $_POST['mj_submit']=="active"){
			if(get_option('MJattachment')){
				self::SimpleMailWithAttachment();
			}else{
				self::SimpleMail();
			}
			
        }
	}
	
	protected function copytome(){
		if(isset($_REQUEST['copytome']) && $_REQUEST['copytome']=='1'){
			$name		=	strip_tags($_REQUEST['uname']);
			$email		=	$_REQUEST['email'];
			$subject	=	strip_tags($_REQUEST['subject']);
			$url		=	strip_tags($_REQUEST['url']);
			$comment	=	strip_tags($_REQUEST['comment']);
			$to			=	$email;
			$subject 	=	(empty($subject))? "Contact Us mail" : $subject;
			$message = "
			<html>
				<head>
					<title>Contact US Mail</title>
				</head>
				<body>
					<p>Hello user<br/></p>
					<p>Please find the details of contact us mail send by you to admin</p>
					<p>=============================================================</p>
					<table>
						<tr>
							<th>Name : </th>
							<td>{$name}</td>
						</tr>
						<tr>
							<th>Email : </th>
							<td>{$email}</td>
						</tr>
						<tr>
							<th>Subject : </th>
							<td>{$subject}</td>
						</tr>
						<tr>
							<th>Website : </th>
							<td>{$url}</td>
						</tr>
						<tr>
							<th>Comment : </th>
							<td>{$comment}</td>
						</tr>
					</table>
					<p>=============================================================</p>
					<p>Thanks & Regards</p>
				</body>
			</html>
			";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$to.'' . "\r\n" .
			'Reply-To: '.$to.'' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
			wp_mail($to,$subject,$message,$headers);
		
		}
	}
	public static function SimpleMail(){
		if($_REQUEST['captcha'] ==   MjFunctions::BaseDecode($_POST['CODEINCODE'])){
                self::copytome();
                $name		=	strip_tags($_REQUEST['uname']);
                $email		=	$_REQUEST['email'];
                $subject	=	strip_tags($_REQUEST['subject']);
                $url		=	strip_tags($_REQUEST['url']);
                $comment	=	strip_tags($_REQUEST['comment']);
                $to			=	(get_option('MJmailto')) ? get_option('MJmailto') : get_option('admin_email');
                $subject 	=	(empty($subject))? "Contact Us mail" : $subject;
                $message = "
                <html>
                    <head>
                        <title>Contact US Mail</title>
                    </head>
                    <body>
                        <p>Hello Admin<br/></p>
                        <p>Please find the details of contact us mail send by a new user</p>
                        <p>=============================================================</p>
                        <table>
                            <tr>
                                <th>Name : </th>
                                <td>{$name}</td>
                            </tr>
                            <tr>
                                <th>Email : </th>
                                <td>{$email}</td>
                            </tr>
                            <tr>
                                <th>Subject : </th>
                                <td>{$subject}</td>
                            </tr>
                            <tr>
                                <th>Website : </th>
                                <td>{$url}</td>
                            </tr>
                            <tr>
                                <th>Comment : </th>
                                <td>{$comment}</td>
                            </tr>
                        </table>
                        <p>=============================================================</p>
                        <p>Thanks & Regards</p>
                    </body>
                </html>
                ";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: '.$to.'' . "\r\n" .
                'Reply-To: '.$to.'' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

                wp_mail($to,$subject,$message,$headers);
                echo "<div class='updatedcss' id='message'> Mail Sent Successfully</div>";
		    }else{
                echo "<div class='error p-12' id='message'>Invalid Captcha</div>";
            }
	}
	
	public static function SimpleMailWithAttachment(){
		if($_REQUEST['captcha'] ==   MjFunctions::BaseDecode($_POST['CODEINCODE'])){
			if($_FILES['file']['name']!=""){
					self::copytome();
					$name		=	strip_tags($_REQUEST['uname']);
					$email		=	$_REQUEST['email'];
					$subject	=	strip_tags($_REQUEST['subject']);
					$url		=	strip_tags($_REQUEST['url']);
					$comment	=	strip_tags($_REQUEST['comment']);
					$to			=	(get_option('MJmailto')) ? get_option('MJmailto') : get_option('admin_email');
					$subject 	=	(empty($subject))? "Contact Us mail" : $subject;
					
				
					$message = "
					<html>
						<head>
							<title>Contact US Mail</title>
						</head>
						<body>
							<p>Hello Admin<br/></p>
							<p>Please find the details of contact us mail send by a new user</p>
							<p>=============================================================</p>
							<table>
								<tr>
									<th>Name : </th>
									<td>{$name}</td>
								</tr>
								<tr>
									<th>Email : </th>
									<td>{$email}</td>
								</tr>
								<tr>
									<th>Subject : </th>
									<td>{$subject}</td>
								</tr>
								<tr>
									<th>Website : </th>
									<td>{$url}</td>
								</tr>
								<tr>
									<th>Comment : </th>
									<td>{$comment}</td>
								</tr>
								
							</table>
							<p>=============================================================</p>
							<p>Thanks & Regards</p>
						</body>
					</html>
					";
						self::sendEmail("admin", $email, $to, $subject, $message, $_FILES['file']);
					echo "<div class='updatedcss' id='message'> Mail Sent Successfully</div>";
				}else{
					echo "<div class='error p-12' id='message'>Please Upload Files</div>";
				}
		    }else{
                echo "<div class='error p-12' id='message'>Invalid Captcha</div>";
            }
	}
	
	function sendEmail($name, $email, $to_mail, $subject, $msg, $attachment = "") {
			$sending = false;

			if (!empty($attachment['tmp_name']) && !empty($attachment['error'])) $attachment['tmp_name'] = "";

			if (!empty($name) && !empty($email) && !empty($to_mail) && !empty($subject) && !empty($msg)) {
				$from_name = $name;
				$from_mail = $email;
				$sending = true;
			}

			if ($sending) {
				$eol = "\n";

				$tosend['email'] = $to_mail;
				$tosend['subject'] = $subject;

				$tosend['message'] = "
					<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
					<html>
					<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
					<title>\".$subject.\"</title>
					</head>
					<body> 
					".$msg."<br />
					</body>
					</html>
					".$eol.$eol;

				$tosend['headers'] = "From: \"".$from_name."\" <".$from_mail.">".$eol;
				$tosend['headers'] .= "Return-path: <".$from_mail.">".$eol;
				$tosend['headers'] .= "MIME-Version: 1.0".$eol;
				if (!empty($attachment['tmp_name'])) {
					$file = $attachment['tmp_name'];
					$content = file_get_contents($file);
					$content = chunk_split(base64_encode($content));
					$uid = md5(uniqid(time()));
					$f_name = $attachment['name'];
					$tosend['headers'] .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$uid."\"".$eol.$eol;
					$tosend['headers'] .= "This is a multi-part message in MIME format.".$eol;
					$tosend['headers'] .= "--PHP-mixed-".$uid."".$eol;
					$tosend['headers'] .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-".$uid."\"".$eol.$eol;
					$tosend['headers'] .= "--PHP-alt-".$uid."".$eol;
					$tosend['headers'] .= "Content-type: text/html; charset=utf-8".$eol;
					$tosend['headers'] .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
					$tosend['headers'] .= $tosend['message']."".$eol.$eol;
					$tosend['headers'] .= "--PHP-alt-".$uid."--".$eol;
					$tosend['headers'] .= "--PHP-mixed-".$uid."".$eol;
					$tosend['headers'] .= "Content-Type: application/octet-stream; name=\"".$f_name."\"".$eol; // use diff. types here
					$tosend['headers'] .= "Content-Transfer-Encoding: base64".$eol;
					$tosend['headers'] .= "Content-Disposition: attachment; filename=\"".$f_name."\"".$eol.$eol;
					$tosend['headers'] .= $content."".$eol.$eol;
					$tosend['headers'] .= "--PHP-mixed-".$uid."--";
					$tosend['message'] = "";//-- The message is already in the headers.
				}

				if (mail($tosend['email'], $tosend['subject'], $tosend['message'] , $tosend['headers']))
					return true;
				else
					return false;
			}
    return false;
	}
	
	function AdminOptionProcess(){
		if(isset($_POST['MJact']) && $_POST['MJact']=="insert"){
			$MJmailto		=	(!empty($_POST['MJmailto'])) ? $_POST['MJmailto'] : get_option('admin_email');
			$MJcopytome		=	isset($_POST['MJcopytome'])? 1 :0; 
			$MJname			=	isset($_POST['MJname'])? 1 :0;
			$MJemail		=	isset($_POST['MJemail'])? 1 :0;
			$MJsubject		=	isset($_POST['MJsubject'])? 1 :0;
			$MJwebsite		=	isset($_POST['MJwebsite'])? 1 :0;
			$MJcomment		=	isset($_POST['MJcomment'])? 1 :0;
			$MJattachment	=	isset($_POST['MJattachment'])? 1 :0;
			if(is_email($MJmailto)){
				update_option('MJmailto',$MJmailto);
				update_option('MJcopytome',$MJcopytome);
				update_option('MJname',$MJname);
				update_option('MJemail',$MJemail);
				update_option('MJsubject',$MJsubject);
				update_option('MJwebsite',$MJwebsite);
				update_option('MJcomment',$MJcomment);
				update_option('MJattachment',$MJattachment);
				echo "<div class='updated p-12' id='message'><div class='p-12'>Success : Data saved Successfully</div></div>";
				
			}else{
				echo "<div class='error'><div class='p-12'>Error : Please enter valid email address</div></div>";
			}
		}
	}
	
	function AdminSwitch(){
		switch(ACTION){
			case 1:
				_e('action');
			break;
			
			default : 
				self::AdminOptionProcess();
				mjContactHTML::AdminOption();
			break;
		}
	}
	
}
?>