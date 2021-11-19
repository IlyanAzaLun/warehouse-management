<div class="modal fade" id="modal-category">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add new category</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('configuration/menu/category-insert')?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="category_name" placeholder="Category name" required>
					</div>
					<div class="form-group">
						<?php foreach ($roles as $key => $role):?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="role[<?= $role['id'] ?>]" id="<?= $role['role_name'] ?>">
							<label class="form-check-label" for="<?= $role['role_name'] ?>"><?= $role['role_name'] ?></label>
						</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-menu">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add new menu</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('configuration/menu')?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input required type="text" class="form-control" name="menu" placeholder="Menu name">
					</div>

					<div class="form-group">
						<select name="category_id" id="category_id" class="form-control" required>
							<option value="">Select Category</option>
							<?php foreach ($categorys as $key => $category): ?>
								<option value="<?=$category['category_id']?>"><?=$category['category_name']?></option>
							<?php endforeach ?>
						</select>
					</div>

					<div class="form-group">
						<select name="parent_id" id="parent_id" class="form-control">
							<option value="">Select Parent</option>
							<?php foreach ($menus as $key => $menu): ?>
								<?php if (!$menu['parent_id'] AND !$menu['menu_controller']): ?>
									<option value="<?=$menu['menu_id']?>"><?=$menu['title']?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="menu_controller" placeholder="Controller menu">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="url" placeholder="Url menu">
					</div>

					<div class="form-group">
						<input required type="text" class="form-control" name="icon" placeholder="Menu icon">
					</div>

					<div class="form-group">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
							<label for="is_active" class="form-chek-label">is Active?</label>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>