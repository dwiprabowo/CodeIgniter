<?php extract($data); ?>
<div class="radio">
  <label>
    <input
        type="radio"
        <?=@$name?"name='$name'":''?>
        value="1"
        <?=@$value?'checked':''?>
    >
        Yes
  </label>
  <label class="radio_bool_margin_left">
    <input
        type="radio"
        <?=@$name?"name='$name'":''?>
        value="0"
        <?=!@$value?'checked':''?>
    >
        No
  </label>
</div>
