<style>
    div.edit_object{
        position: absolute;
        top: 7px;
        right: 7px;
    }
</style>
<div class="well well-lg position_relative">
    <?php foreach($model->get_fields() as $k => $v): ?>
        <div class="row">
            <label class="col-xs-3">
                <?=$v->field?>
            </label>
            <div class="col-xs-9">
                <?=$object->{$v->field}?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="edit_object">
        <a href="<?=site_url($this->router->class.'/edit/'.$object->id)?>">
            <span class="glyphicon glyphicon-edit"></span>
        </a>
    </div>
</div>
