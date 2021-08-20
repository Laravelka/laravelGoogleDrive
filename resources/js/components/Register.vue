<template>
	<div>
		<div v-if="isOpen" class="alert" :class="{'alert-danger': isError, 'alert-success': !isError}" role="alert">
			{{ message }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card">
			<div class="card-header">Регистрация</div>
			<div class="card-body">
				<form method="POST">
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">Имя и Фамилия</label>

						<div class="col-md-6">
							<input v-model="form.name" ref="name" type="text" class="form-control" :class="{'is-invalid': errors.name}" name="name" required autocomplete="name" autofocus>

							<span class="invalid-feedback" role="alert">
								<strong>{{ errors.name }}</strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="company" class="col-md-4 col-form-label text-md-right">Компания</label>

						<div class="col-md-6">
							<input v-model="form.company" ref="company" type="text" class="form-control" :class="{'is-invalid': errors.company}" name="company" required autocomplete="company" autofocus>

							<span class="invalid-feedback" role="alert">
								<strong>{{ errors.company }}</strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

						<div class="col-md-6">
							<input v-model="form.email" ref="email" type="email" class="form-control" :class="{'is-invalid': errors.email}" name="email" required autocomplete="email" autofocus>

							<span class="invalid-feedback" role="alert">
								<strong>{{ errors.email }}</strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

						<div class="col-md-6">
							<input v-model="form.password" ref="password" type="password" class="form-control" :class="{'is-invalid': errors.password}" name="password" required autocomplete="current-password">

							<span class="invalid-feedback" role="alert">
								<strong>{{ errors.password }}</strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Повторите пароль</label>

						<div class="col-md-6">
							<input v-model="form.password_confirmation" ref="password_confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-8 offset-md-4">
							<button v-if="isLoad" class="btn btn-primary" type="button" disabled>
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								Регистрация..
							</button>
							<button v-else type="submit" class="btn btn-primary" @click.prevent="clickReg">
								Регистрация
							</button>

							<a class="btn btn-link" href="/login">
								Уже есть аккаунт?
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
		name: 'Registers',
		data: () => ({
			form: {
				name: '',
				email: '',
				company: '',
				password: '',
				password_confirmation: '',
			},
			errors: {
				name: null,
				email: null,
				company: null,
				password: null,
				password_confirmation: null,
			},
			isOpen: false,
			isLoad: false,
			isError: false,
			message: '',
			
		}),
		methods: {
			clickReg() {
				this.isLoad = !this.isLoad;
				axios.post('auth/register', this.form).then((response) => {
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
					} else if (
						response.data &&
						response.data.messages
					) {
						this.isError = true;
						for(let key in response.data.messages) {
							const message = response.data.messages[key][0];

							this.errors[key] = message;
						}
						const filtered = _.omitBy(this.errors, _.isEmpty);
						this.$refs[Object.keys(filtered)[0]].focus();
					}

					setTimeout(() => {
						that.isOpen = false;
						that.errors = {
							name: null,
							email: null,
							company: null,
							password: null,
							password_confirmation: null,
						};
					}, 3500);
				});
			}
		}
	}
</script>