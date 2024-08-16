<!DOCTYPE html>
<html>
<head>
	<title>Cabinet</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
</head>
<body class="dp">
	<div class="header">
		<div class="row grid middle between">
			<div class="logo">
				<img src="{{ asset('image/logo.png')}}">
			</div>
			<div class="title">
				Клуб любителей творчества «ОчУмелые ручки»
			</div>
			<div class="auth">
			@if (isset($id_user))
				
				<a href="/cabinet">Личный кабинет</a>
				<a href="/exit">Выход</a>
				@else
				<a href="/enter">Вход</a>
				@endif
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
	<div class="main">
		<div class="row">
			<div class="hover"></div>
			<div class="title"></div>
			<div class="row--small grid between">
				<div class="content driver-page">
					<div class="driver-page-photo">
					@if (isset($leader))<img src="{{ asset('image')}}/{{ $leader->foto_leader }}">@endif
					</div>	
					<div class="driver-page-name">
					@if (isset($leader))
					<h3>{{$leader->first_name_leader}} {{$leader->second_name_leader}} {{$leader->patronymic_leader}}</h3>
					@else <h5>{{$user->FIO_user}}</h5>
					@endif
				</div>
					<div class="driver-page-text">
						<div class='my'>
						<div class="driver-page-my">Мои мастер-классы</div>
						<table class="driver-page-table">
							<tbody>
								@foreach($masterclass as $mc)
								<tr>
									<td>{{date('d.m.Y', strtotime($mc->date_MC))}} {{date('H:i', strtotime($mc->time_MC))}}</td>
									<td>
										<p>{{$mc->name_MC}}</p>
										@if (isset($leader))
										<p>Участники:</p>
										@foreach($part as $parts)
										@if ($parts->id_MC==$mc->id_MC)
										<p>
											 {{$parts->FIO_user}}<br>
										 	email: {{$parts->email_user}} <br>
										 	tel: {{$parts->telephone_user}}
										</p>
										@endif
										@endforeach
										@endif
									
									</td>
									@if (isset($leader))
									<td><a href="/change/{{$mc->id_MC}}">Редактировать мастер-класс</a></td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
</div>
					<div class="driver-page-btn-wrapper">
					@if (isset($leader))
						<div class="driver-page-btn btn">
						<a href="/add">Добавить мастер-класс</a>
						</div>
		@endif
					</div>
				</div>
				<ul class="menu">
				@foreach($categories as $category)
					<li><a href="/category/{{$category->id_category}}">{{$category->name_category}}</a></li>
					@endforeach
				</ul>
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