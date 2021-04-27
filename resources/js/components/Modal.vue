	<div v-if="show">
		<transition name="modal">
			<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Загрузка файла</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true" @click="show = false">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Тут будет форма</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" @click="show = false">Закрыть</button>
								<button type="button" class="btn btn-primary">Сохранить</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</transition>
	</div>
