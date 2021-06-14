@include("header")
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="registerForm" class="login100-form validate-form" action = "/register" method = "POST">
					@csrf
					<span class="login100-form-title">
						Регистрация
					</span>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="login" placeholder="Имя для входа">
						@error('login')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
					</div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="password" name="password" placeholder="Пароль">
                        @error("password")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="password" name="passwordConfirm" placeholder="Повтор пароля">
                        @error("passwordConfirm")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name" placeholder="Имя">
						<p class="nameError"></p>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="family" placeholder="Фамилия">
						@error('family')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
					</div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="email" placeholder="Электронная почта">
                        @error("email")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="phone" placeholder="Телефон">
						@error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
					</div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="date" name="birth" placeholder="Дата рождения">
                        @error('date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
					<div class="wrap-input100 validate-input">
						<textarea class="input100" name="information" placeholder="Дополнительная информация"></textarea>
					</div>
					<div class="container-login100-form-btn pbt-5">
						<button type="submit" class="login100-form-btn">
							Зарегистрироваться
						</button>
					</div>
				</form>
			</div>
		</div>
</div>
<script type="text/javascript" src="/js/main.js"></script>
