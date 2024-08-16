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
			<div class="row--small">
			<form method="POST" action="{{route('add_content')}}">
									<h2>Форма добавления мастер-класса</h2>
									@if (isset($message))
									<p>{{$message}}</p>
									@endif
					<div class="form-group">
						<label>Вид творчества</label>
						<select name='id_category'>
							@foreach ($categories as $category)
							<option value='{{$category->id_category}}'> {{$category->name_category}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Название</label>
						<input type="text" name="name_MC" required>
					</div>
					<div class="form-group">
						<label>Описание мастер-класса</label>
						<textarea name='description_MC' required></textarea>
					</div>
					<div class="form-group">
						<label>Дата</label>
						<input type="date" name="date_MC">
					</div>
					<div class="form-group">
						<label>Время</label>
						<select name='time_MC' required>
							<option value='9:00:00'> 9:00</option>
							<option value='11:00:00'> 11:00</option>
							<option value='13:00:00'> 13:00</option>
							<option value='15:00:00'> 15:00</option>
						</select>
					</div>
					<div class="form-group">
						<label>Количество человек в группе</label>
						<input type="number" min=0 name="count_people_MC">
					</div>
					<div class="form-group">
						<label>Стоимость</label>
						<input type="number" min=0 name="cost_MC">
					</div>
					<div class="form-group">
						<button class="btn" type='submit'>Отправить</button>
					</div>
					{{ csrf_field() }}
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