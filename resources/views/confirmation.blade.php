<!DOCTYPE html>
<html>
<head>
	<title>Form master class</title>
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
			<form method="POST" action="{{route('confirmation_content')}}">
					<h2>Форма подтверждения записи на мастер-класса</h2>
					<h3>{{$mc->name_MC}}</h3>
					<div class="form-group">
                    <input type="hidden" name="id_MC" value="{{$mc->id_MC}}">
                    <input type="hidden" name="id_user" value="{{$mc->id_user}}">
                    <p>Проверьте все данные</p>
                    <div class="form-group">
						<h4>Ваше ФИО</h4>
						<p><span>{{$user->FIO_user}}</span></p>
					</div>
                    <div class="form-group">
						<h4>Название мастер-класса</h4>
						<p>{{$mc->name_mc}}</p>
					</div>
                    <div class="form-group">
						<h4>Вид творчество</h4>
                        <p>{{$mc->name_category}}</p>
					</div>
					<div class="form-group">
						<h4>ФИО мастер</h4>
						<p>{{$mc->first_name_leader}} {{$mc->second_name_leader}} {{$mc->patronymic_leader}}</p>
					</div>
					<div class="form-group">
						<h4>Дата</h4>
						<p>{{date('d.m.Y', strtotime($mc->date_MC))}} </p>
					</div>
					<div class="form-group">
						<h4>Время</h4>
						<p>{{date('H:i', strtotime($mc->time_MC))}}</p>
					</div>
					<div class="form-group">
						<button class="btn" type='submit'>Подтвердить</button>
					</div>
					{{ csrf_field() }}
				</form>
                
					<div class="form-group">
						<button class="btn"><a href='http://127.0.0.1:8000/category'>Отмена</a></button>
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