<style>
    div.group_permission{

    }
    div.group_permission input[type=checkbox]{
        height: 40px;
        width: 40px;
    }
    div.group_permission .item{
        height: 80px;
    }
    div.group_permission .item .item_illustration{
        margin-left: 30px;
        margin-top: 10px;
        font-size: 24px;
    }
</style>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="form-group">
            <?=form_open()?>
                <?=form_dropdown(
                    "users[]"
                    , $users
                    , []
                    , '
                        class="form-control chosen" 
                        multiple id="city" 
                        data-placeholder="Choose User" 
                    '
                )?>
        </div>
        <div class="form-group group_permission">
            <div class="checkbox">
                <div class="row">
                    <?php foreach($menus as $k => $v): ?>
                        <?php if(!@$v->only_top): ?>
                            <div class="col-xs-3 item">
                                <label>
                                    <input type="checkbox" name="data_<?=$k?>">
                                    <div class="item_illustration">
                                        <span class="glyphicon glyphicon-<?=$v->glyphicon?>"></span>
                                        <?=$v->label?>
                                    </div>
                                </label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <input type="submit" value="Grant Permission" class="btn btn-warning btn-lg">
        </div>
        <?=form_close()?>
    </div>
</div>

<script>
    $(".chosen").chosen({
        no_results_text: "Oops, nothing found!",
    });
</script>