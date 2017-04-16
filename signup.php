<?php
require "db.php";

$data = $_POST;
if(isset($data['do_signup']))
{
//здесь регистрируем
	$errors = array();
	if(trim($data['login']) == '')
	{
		//сделать вставку в спан как в перовм уроке
		$errors[] = 'Введите логин!';
	}

	if(trim($data['email']) == '')
	{
		//сделать вставку в спан как в перовм уроке
		$errors[] = 'Введите email!';
	}

	if($data['password'] == '')
	{
		//сделать вставку в спан как в перовм уроке
		$errors[] = 'Введите password';
	}

	if($data['password_2'] != $data['password'])
	{
		//сделать вставку в спан как в перовм уроке
		$errors[] = 'повторный пароль введен не верно';
	}

	if(R::count('users',"login = ?", array($data['login'])) > 0 )
	{
		//сделать вставку в спан как в перовм уроке
		$errors[] = 'пользователь с таким Логином существует';
	}

	if(R::count('users',"email = ?", array($data['email'])) > 0 )
	{
		//сделать вставку в спан как в перовм уроке
		$errors[] = 'пользователь с таким email уже существует';
	}

	if( empty($errors))
	{
		//все хорошо регитсрируем
		//оставить массив, пригодиться для проверки ошибок и будет доступ к кнопке зарегать
		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);//$data['password'];
		R::store($user);
		echo '<div style="color: green;">Вы успешно зарегистрированны!</div><hr>';
	}else
	{
		echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}

}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<form action="/signup.php" method="POST">
	
	<p>
		<p><strong>Ваш логин</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data['login']; ?>">
	</p>

	<p>
		<p><strong>Ваш Email</strong>:</p>
		<input type="email" name="email" value="<?php echo @$data['email']; ?>">
	</p>

	<p>
		<p><strong>Ваш пароль</strong>:</p>
		<input type="password" name="password" value="<?php echo @$data['password']; ?>">
	</p>

	<p>
		<p><strong>Введите Ваш пароль еще раз</strong>:</p>
		<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
	</p>

	<p>
		<button type="submit" name="do_signup">Зарегистрироваться</button>
	</p>


</form>