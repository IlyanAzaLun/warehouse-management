<?php if (!$information): ?>
<div class="info-box mb-3">
	<div class="info-box-content">
		<b class="info-box-text text-center">Data empty</b>
	</div>
</div>
<?php endif ?>
<?php foreach ($information as $key => $info): ?>
<div class="info-box mb-3 bg-warning">
	<span class="info-box-icon"><i class="fas fa-tag"></i></span>

	<div class="info-box-content">
		<span class="info-box-text"><?=$info['category_name']?></span>
	</div>
	<!-- /.info-box-content -->
</div>
<?php endforeach ?>