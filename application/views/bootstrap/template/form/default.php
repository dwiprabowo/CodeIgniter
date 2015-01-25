<div class="panel panel-default">
    <?php if(@$data->title): ?>
        <div class="panel-heading">
            <strong><?=$data->title?></strong>
        </div>
    <?php endif; ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <?php $this->load->view('bootstrap/template/form/simple') ?>
            </div>
        </div>
    </div>
</div>