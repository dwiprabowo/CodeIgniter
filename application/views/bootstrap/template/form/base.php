<?=form_open(@$data->action, ['class' => 'form-horizontal', 'role' => 'form'])?>
    <?php foreach($data->fields as $field): ?>
        <div class="form-group <?=form_error($field->field)?'has-error':''?>">
            <div class="col-sm-3">
                <?=$field->label?>
            </div>
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
    <div>
        <input type="hidden" name="active_item" value="<?=$data->active_item?>">
    </div>
    <?php if(isset($data->submit)): ?>
        <div class="col-sm-12 text-center">
            <input type="submit" value="<?=$data->submit?>" class="btn btn-primary">
        </div>
    <?php endif; ?>
<?=form_close()?>

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