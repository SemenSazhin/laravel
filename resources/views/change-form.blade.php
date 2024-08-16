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
			<form method="POST" action="{{route('change_content')}}">
									<h2>Форма редактирования мастер-класса</h2>
						<label>{{$mc->name_MC}}</label>
					<div class="form-group">
                    <input type="hidden" name="id_MC" value="{{$mc->id_MC}}">
						<label>Описание мастер-класса</label>
						<textarea name='description_MC' required><?php echo $mc->description_MC ?></textarea>
					</div>
					<div class="form-group">
						<label>Стоимость</label>
						<input type="number" min=0 name="cost_MC" value='{{$mc->cost_MC}}'>
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