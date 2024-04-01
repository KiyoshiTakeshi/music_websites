<?php 

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $values = [];
    $values['username'] = trim($_POST['username']);
    $values['password'] = $_POST['password']; 
    $query = "select * from users where username = :username and password = :password limit 1";
    $row = db_query_one($query,$values);

    if(!empty($row))
    {
        authenticate($row);
        if ($row['role'] == 'admin'){
            message("Login successful");
            redirect('admin');  				
        }
        else if ($row['role'] == 'user') {
            message("Login successful");
            redirect('home');
        }
    }
    else
    {
        if (empty($row)) {
            message("Wrong username or password");
        }    
    }
}

?>
<?php require page('includes/header');
?>

	<section class="content">
 
		<div class="login-holder">

		<?php if(message()):?>
			<div class="alert"><?=message('',true)?></div>
		<?php endif;?>

			<form method="post">
				<center><img src="assets/images/logo.jpg" style="width: 150px;border-radius: 50%;border: solid thin #ccc;"></center>
				<h2>Login</h2>
				<input value="<?=set_value('username')?>" class="my-1 form-control" type="text" name="username" placeholder="username">
				<input value="<?=set_value('password')?>" class="my-1 form-control" type="password" name="password" placeholder="Password">
				<button class="my-1 btn " style="background-color:#8b2917; color:aliceblue">Login</button>
			</form>
		</div>
	</section>

<?php require page('includes/footer')?>