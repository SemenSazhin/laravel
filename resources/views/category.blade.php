<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
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
			<div class="title">@if (isset($content)){{$content->name_category}}
				@else Выберите категорию
				@if (isset($message))
				<p>{{$message}}</p>
				@endif
				@endif</div>
				
			<div class="row--small grid between">
				<div class="content">
				@if (isset($content))
					<img src="{{ asset('image')}}/{{ $content->foto_category }}">
					<p>{{$content->description1}}</p>
					<p>{{$content->description2}}</p>
					<p>{{$content->description3}}</p>
					<p>{{$content->description4}}</p>
					@endif
				</div>
				<ul class="menu">
					@foreach($categories as $category)
					<li><a href="/category/{{$category->id_category}}">{{$category->name_category}}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="row shedule">
			@if (isset($content))
				<div class="row--small">
					<h2>Расписание</h2>
					<div class="drivers">
						@foreach ($masterclass as $mc)
						<div class="driver grid">
							<div class="driver-left grid">
								<div class="driver-photo">
									
					<img src="{{ asset('image')}}/{{ $mc->foto_leader }}">
								</div>
								<div class="driver-text">
									<div class="driver-name">{{$mc->first_name_leader}} {{$mc->second_name_leader}} {{$mc->patronymic_leader}}</div>
									<div class="driver-name">{{$mc->name_MC}} </div>
									<div class="driver-desc">{{$mc->description_MC}}
									</div>
								</div>
							</div>
							<div class="driver-right">
							@if ($admin==0)
								<button class="driver-btn"><a href='/confirmation/{{$mc->id_MC}}'>записаться</a></button>
							@endif
								<div class="driver-time">{{date('d.m.Y', strtotime($mc->date_MC))}} {{date('H:i', strtotime($mc->time_MC))}}</div>
							</div>	
						</div>
						@endforeach

					</div>
				</div>
			</div>

			@endif
		</div>	
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