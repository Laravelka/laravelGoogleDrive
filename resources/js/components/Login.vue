<template>
	<div>
		<div v-if="isOpen" class="alert" :class="{'alert-danger': isError, 'alert-success': !isError}" role="alert">
			{{ message }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card">
			<div class="card-header">Авторизация</div>
			<div class="card-body">
				<form method="POST">
					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

						<div class="col-md-6">
							<input v-model="form.email" id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

						<div class="col-md-6">
							<input v-model="form.password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6 offset-md-4">
							<div class="form-check">
								<input v-model="form.remember" class="form-check-input" type="checkbox" name="remember" id="remember" checked>

								<label class="form-check-label" for="remember">
									Запомнить меня?
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-8 offset-md-4">
							<button v-if="isLoad" class="btn btn-primary" type="button" disabled>
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								Вход..
							</button>
							<button v-else type="submit" class="btn btn-primary" @click.prevent="clickAuth">
								Войти
							</button>

							<a class="btn btn-link" href="/password/reset">
								Забыли пароль?
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {
		name: 'Login',
		data: () => ({
			form: {
				email: '',
				password: '',
				remember: true
			},
			isOpen: false,
			isLoad: false,
			isError: false,
			message: '',
			
		}),
		methods: {
			clickAuth() {
				this.isLoad = !this.isLoad;
				axios.post('auth/login', this.form).then((response) => {
					const { data } = response;

					this.isError = false;
					this.isOpen = true;
					
					this.isLoad = !this.isLoad;
					this.message = data.message;

					localStorage.setItem('user', JSON.stringify(data.user));
					localStorage.setItem('token', data.token);
				}).catch((error) => {
					const { response } = error;

					let that = this;
					this.isLoad = !this.isLoad;

					if (
						response.data &&
						response.data.message
					) {
						this.isOpen = true;
						this.isError = true;
						this.message = response.data.message;
					} else {
						this.isOpen = true;
						this.isError = true;
						this.message = 'Неизвестная ошибка.'
					}

					setTimeout(() => {
						that.isOpen = false;
					}, 3500);
				});
			}
		}
	}
</script>