<!DOCTYPE html>
<html>
<head>
	<title>Form reg</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<body>
	<div class="header">
		<div class="row grid middle between">
			<div class="logo">
				<img src="{{ asset('image/logo.png')}}">
			</div>
			<div class="title">
				Клуб любителей творчества «ОчУмелые ручки»
			</div>
		</div>
	</div>
	<div class="row row--nogutter">
		<div class="menu-burger">
			<div class="burger">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>	
	</div>
	<div class="row row--nogutter top-line">
		<div class="line"></div>
	</div>
	<div class="main">
		<div class="row">
			<div class="row--small">
				<form method="POST" action="{{route('reg')}}">
					<h2>Форма регистрации</h2>
					<div class="form-group">
						<label>ФИО</label>
						<input name="FIO" value="{{ old('FIO') }}" >@error('FIO')   <span style="color:red"> {{ $message }} @enderror </span>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email_user" value="{{ old('email_user') }}"  > @error('email_user')   <span style="color:red"> {{ $message }} @enderror </span>
					</div>
					<div class="form-group">
						<label>Пароль</label>
						<input type="text" name="password_user" value="{{ old('password') }}" > @error('password_user')   <span style="color:red"> {{ $message }} @enderror </span>
					</div>
					<div class="form-group">
						<label>Номер телефона</label>
						<input type="tel" name="telephone_user" value="{{ old('tel') }}" > @error('telephone_user')   <span style="color:red"> {{ $message }} @enderror </span>
					</div>
					<div class="form-group">
						<button class="btn">Зарегистрироваться</button>
						{{ csrf_field() }}
					</div>
				</form>
			</div>
		</div>	
	</div>
	<div class="row row--nogutter">
		<div class="line"></div>
	</div>
	<div class="footer">
		<div class="row">
			<div class="row--small grid between">
				<div class="address">Наш адрес: ВДНХ, 120в</div>
				<div class="tel">Тел: 89123456765</div>
				<div class="copy">(с) Copyright, 2017</div>
			</div>
		</div>
	</div>
</body>
</html>