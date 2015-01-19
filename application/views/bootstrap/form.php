<div class="panel panel-default">
    <?php if(@$data->title): ?>
        <div class="panel-heading">
            <strong><?=$data->title?></strong>
        </div>
    <?php endif; ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <?=form_open(@$data->action, ['class' => 'form-horizontal', 'role' => 'form'])?>
                    <?php foreach($data->fields as $field): ?>
                        <div class="form-group <?=form_error($field->field)?'has-error':''?>">
                            <label class="col-sm-3 control-label" for="<?=$field->field?>">
                                <?=$field->label?>
                            </label>
                            <div class="col-sm-9">
                                <?=$field->input_element?>
                                <?php if(@$field->error): ?>
                                    <span id="<?=$field->field.'_error'?>" class="text-left help-block">
                                        <small><?=@form_error($field->field)?></small>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-sm-12 text-center">
                        <input type="submit" value="<?=$data->submit?>" class="btn btn-primary">
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<?php if(@$data->autofocus_id): ?>
    <script>
        function moveCursorToEnd(el) {
            if (typeof el.selectionStart == "number") {
                el.selectionStart = el.selectionEnd = el.value.length;
            } else if (typeof el.createTextRange != "undefined") {
                el.focus();
                var range = el.createTextRange();
                range.collapse(false);
                range.select();
            }
        }

        var autofocus_element = document.getElementById('<?=$data->autofocus_id?>');
        moveCursorToEnd(document.getElementById('<?=$data->autofocus_id?>'));
    </script>
<?php endif; ?>
