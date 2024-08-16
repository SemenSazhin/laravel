<!DOCTYPE html>
<html>
<head>
	<title>Form entry</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
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
            <form method="POST" action="{{route('login')}}">
                <p>Логин <input name="login"> @error('login')   <span style="color:red"> {{ $message }} @enderror </span>
                <p>Пароль <input type="text" name="password"> @error('password')   <span style="color:red"> {{ $message }} @enderror </span>
                    <p><button type="submit">Войти</button>
                {{ csrf_field() }}
            </form>
            <form method="POST" action="{{route('registration')}}">
            <p><button type="submit">Зарегистрироваться</button>
                {{ csrf_field() }}
            <p style="color:red;">{{$err}}</p>
            <p style="color:green;">{{$access}}</p>
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