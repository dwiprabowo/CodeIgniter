<style>
	.page-title{
		display: inline-block;
		border-bottom: 2px solid #333;
		padding-bottom: 10px;
		margin-bottom: 2%;
	}
	.main-menu{
		margin-top: 2%;
	}
	.main-menu > div.main-menu-item{
		cursor: pointer;
		border: 2px solid transparent;
		padding: 2%;
		-webkit-transition: border-bottom .3s ease;
		transition: border-color .2s ease;
	}
	.main-menu > div.main-menu-item:hover{
		border-color: #333;
	}
	.main-menu > div.main-menu-item.disabled{
		cursor: default;
		color: #777;
	}
	.main-menu > div.main-menu-item.disabled:hover{
		border-color: transparent;
	}
	.main-menu > div.main-menu-item > span {
		font-size: 72px;
	}
</style>

<div class="container space_top">
	<h1 class="text-center font_serif">
		<div class="page-title">
			General System Menu <?=@$menu_title?'- '.$menu_title:''?> 
		</div>
	</h1>
    <?=$this->load->view($view)?>
    <footer class="row">
        <div class="col-sm-12 text-center">
            &copy;&nbsp;2014-<?=date('Y')?>.
            <a href="<?=site_url()?>" class="application_title">
                <?=$application->name?>
            </a>
        </div>
    </footer>
</div>
