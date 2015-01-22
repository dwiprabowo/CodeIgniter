<style>
    div.edit_object{
        position: absolute;
        top: 7px;
        right: 7px;
    }
    div.an_object > .col-xs-3{
        border-right: 1px solid rgba(0, 0, 0, .4);
    }
    div.an_object > .col-xs-9, div.an_object > .col-xs-3{
        border-bottom: 1px solid rgba(0, 0, 0, .4);
    }
</style>
<div class="well well-lg position_relative">
    <?php foreach(get_data_fields($object) as $k => $v): ?>
        <div class="row an_object">
            <label class="col-xs-3">
                <?=$v?>
            </label>
            <div class="col-xs-9">
                <?=$object->{$v}?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="edit_object">
        <a href="<?=site_url($this->router->class.'/edit/'.$object->id)?>">
            <span class="glyphicon glyphicon-edit"></span>
        </a>
    </div>
</div>
