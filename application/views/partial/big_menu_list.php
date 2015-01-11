<?=$this->assets->thirdparty_inactivate()?>
<?=$this->assets->load('dataHref.js')?>
<div class="row main-menu">
	<?php foreach($menu as $k => $v): ?>
		<?php if(!@$v->only_top): ?>
		<div class="
				col-sm-3 
				main-menu-item 
				text-center
				<?=@$v->active?'':'disabled'?>
			" 
			data-href="<?=create_link($v->action)?>"
		>
			<span class="glyphicon glyphicon-<?=$v->glyphicon?>"></span>
			<h3><?=$v->label?></h3>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<script>
	$('.main-menu-item').dataHref();
</script>
