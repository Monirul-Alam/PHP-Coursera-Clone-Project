<?php

session_start();

//include_once '../function/Functionlist.php';
include_once '../connections.php';
//$udf_fun = new Functionlist();

/*$json_data = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if((isset($_POST['u_email']) && !empty(trim($_POST['u_email']))) && (isset($_POST['u_password']) && !empty(trim($_POST['u_password']))))
    {

        $email = $udf_fun->validation($_POST['u_email']);
        $password = $udf_fun->validation($_POST['u_password']);

        if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email) && preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,50}$/', $password))
        {

            $email_select['email'] = $email;
            $email_check = $udf_fun->record_exits("users",$email_select);

            if($email_check){

                $select_rec = $udf_fun->select_assoc("users",$email_select);
                $fetch_pass = $select_rec['password'];

                if(password_verify($password, $fetch_pass)){

                    $json_data['status'] = 200;
                    $json_data['msg'] = 'Successfully login';

                    $_SESSION['useremail'] = $select_rec['email'];
                    $_SESSION['usertoken'] = $select_rec['token'];

                    if(isset($_POST['s_cookie'])){
                        
                        setcookie('useremail', $email, time()+(365 * 24 * 60), "/");
                        setcookie('userpass', $password, time()+(365 * 24 * 60), "/");

                    }

                }
                else{
                    $json_data['status'] = 202;
                    $json_data['msg'] = 'Inavlid User Details Found';
                }

            }
            else {
                $json_data['status'] = 203;
                $json_data['msg'] = 'Inavlid User Details Found'; 
            }
        }
        else{

            $json_data['status'] = 204;
            $json_data['msg'] = 'Invalid Data Values';

        }
    }
    else{
        $json_data['status'] = 205;
        $json_data['msg'] = 'Invalid Data Values';
    }

}
else{

    $json_data['status'] = 404;
    $json_data['msg'] = 'Invalid Request Found';

}*/
    $success = false;
    $message = '';
    $type = 'undifined';

    $user_name = $_GET['uname'];
    $ps = $_GET['pass'];
    $password = passEncrypt($ps);

    if (!empty($user_name) && !empty($password)) 
    {

        $data = get("select * from users where user_name='$user_name' and password='$password'");
        $count = rows("select * from users where user_name='$user_name' and password='$password'");
        if($count == 0)
        {
            $message.= 'Invalid credential!';
        }
        else if($count==1)
        {
            $success = true;
            $message.= 'Login Successful';
            $_SESSION['username'] = $data['user_name'];
            if($data['type']=="user")
            {
                $_SESSION['type'] = $data['type'];
                $type = $data['type'];
                //header("Location: profile.php");exit();
            }
            else if($data['type']=="admin")
            {
                $_SESSION['type'] = $data['type'];
                $type = $data['type'];
                //header("Location: Admin/Dashboard.php");exit();
            }
            
        }
        else
        {
            $message.= 'Multiple data found!';
        }
    }
    else
    {
        $message.= 'Field cann\'t empty';
    }




$json_data = array('msg' => $message , 'success'=> $success , 'type' => $type);



echo json_encode($json_data);


?>