@include("header")
<div class="page-container">
				<form class="login-form col-5" action = "/login" method = "POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        @error('password')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
							Войти
                    </button>
					<div class="text-center p-t-12">
						<a class="password-restore-link" href="/restore">
							Забыли пароль?
						</a>
					</div>
					<div class="text-center p-b-136">
						<a class="txt2" href="/register">
							Регистрация
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
</div>
<script src="js/main.js"></script>
