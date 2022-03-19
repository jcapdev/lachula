<?php





use PHPMailer\PHPMailer\PHPMailer;



if($_POST)

{



    require_once "PHPMailer/Exception.php";

    require_once "PHPMailer/PHPMailer.php";

    require_once "PHPMailer/SMTP.php";



    $mail = new PHPMailer();





    $your_email = "salvador.sanchez@vmasideas.com";  //Replace with recipient email address



    $to_Email   	= $your_email;



    //check if its an ajax request, exit if not

    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {



        //exit script outputting json data

        $output = json_encode(

        array(

            'type'=>'error',

            'text' => 'Request must come from Ajax'

        ));



        die($output);

    }



    //check $_POST vars are set, exit if any missing

    if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userMessage"]) || !isset($_POST["userSubject"]) || !isset($_POST["userPhone"]) || !isset($_POST["userCompany"]) || !isset($_POST["lang"]) )

    {

        $output = json_encode(array('type'=>'error', 'text' => 'Los campos estan vacíos!'));

        die($output);

    }



    //Sanitize input data using PHP filter_var().

    $user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);

    $user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);

    $user_Phone     =  filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);

    $user_Subject   =  filter_var($_POST["userSubject"], FILTER_SANITIZE_STRING);

    $user_Company   =  filter_var($_POST["userCompany"], FILTER_SANITIZE_STRING);

    $user_Message     = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);
    
    $lang     = filter_var($_POST["lang"], FILTER_SANITIZE_STRING);


    //additional php validation

    if(strlen($user_Name)<2) // If length is less than 2 it will throw an HTTP error.

    {
        if($lang=="es"){
        $output = json_encode(array('type'=>'error', 'text' => 'Nombre muy corto o esta vacio!'));

        die($output);    
        }
        else{
         $output = json_encode(array('type'=>'error', 'text' => 'Very short name or is empty!_'.$lang));

        die($output);   
        }

    }

    if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation

    {
        
        if($lang=="es"){
        $output = json_encode(array('type'=>'error', 'text' => 'Por favor ingrese un correo valido!'));

        die($output);   
        }
        else{
         $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));

        die($output);
        }

        

    }



    if(strlen($user_Message)<5) //check emtpy message

    {
        
        if($lang=="es"){
        $output = json_encode(array('type'=>'error', 'text' => 'Su mensaje es muy corto, favor de ingresar más comentarios.'));

        die($output); 
        }
        else{
         $output = json_encode(array('type'=>'error', 'text' => 'Your message is very short, please fill it with more comments.'));

        die($output);
        }

        

    }





       //Server settings

    $mail->isSMTP();                                            // Send using SMTP

    $mail->Host       = 'salsaslachula.com	';                    // Set the SMTP server to send through

    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

    $mail->Username   = 'no-reply@salsaslachula.com';//     'contact@hotelquintaeden.com';                // SMTP username

    $mail->Password   = 'riiXG4pwkEuk'; //    '##,FPy74a3VU';                     // SMTP password

    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted

    $mail->Port       = 465;                                    // TCP port to connect to



    //Recipients

     
     $mail->setFrom("no-reply@salsaslachula.com","La Chula WWW");
     $mail->addAddress($your_email, 'Salsas La Chula Poblana');     // Add a recipient



    // Content

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $user_Subject;

    $mail->Body  = "<h4 style='text-align: center;padding: 25px 15px;background-color: #0c6c9e;color: #FFFFFF;font-size:16px;width:90%;border-radius: 10px;'>Existe un nuevo mensaje de contacto en el sitio.</h4><br><br>";





    $mail->Body .= utf8_decode("<strong>Nombre: </strong>". $user_Name ."<br>");

    $mail->Body .= utf8_decode("<strong>Correo: </strong>". $user_Email ."<br>");

    $mail->Body .= utf8_decode("<strong>Teléfono: </strong>". $user_Phone ."<br>");

    $mail->Body .= utf8_decode("<strong>Empresa: </strong>". $user_Company ."<br>");

    $mail->Body .= utf8_decode("<strong>Mensaje: </strong>". $user_Message ."<br>");



    $mail->AltBody = utf8_decode('Existe un nuevo mensaje del sitio Salsas La Chula; nombre: '.$user_Name.'correo: '.$user_Email.'Teléfono: '.$user_Phone.'Empresa: '.$user_Company.'Mensaje: '.$user_Message);



    if(!$mail->send())

    {
        if($lang=="es"){
        $output = json_encode(array('type'=>'error', 'text' => 'No se puede enviar el correo! Por favor intente más tarde.'));

        die($output);
        }
        else{
         $output = json_encode(array('type'=>'error', 'text' => 'Unable to send mail! Please try again later.'));

        die($output);
        }

        

    }else{

        if($lang=="es"){
        $output = json_encode(array('type'=>'message', 'text' => 'Hola  '.$user_Name .' Gracias por tus comentarios.'));

        die($output);
        }
        else{
         $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_Name .' Thank you for your comments.'));

        die($output);
        }
        

    }
    


}

?>