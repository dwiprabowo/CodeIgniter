<style type="text/css">
	div.error_custom {
        border: 1px solid maroon;
        -webkit-box-shadow: 0 0 8px maroon;
        color: maroon;
        <?php if($full_page_error): ?>
            margin: 50px;
            padding: 50px;
            display: block;
        <?php else: ?>
    		margin: 10px 0px;
    		padding: 20px;
    		display: inline-block;
        <?php endif; ?>
	}
	div.error_custom > h1 {
		margin: 5px 0px;
	}
</style>
<div class="error_custom">
	<h1><?php echo $heading; ?></h1>
	<?php echo $message; ?>
</div>
