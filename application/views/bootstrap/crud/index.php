<?php
    $no = 1;
?>

<div style="overflow: auto;">
    <?php if($objects): ?>
        <table class="table table-bordered table-hover">
            <tr>
                <th>No</th>
                <?php foreach($model->get_fields() as $k => $v): ?>
                    <th><?=$v->field?></th>
                <?php endforeach; ?>
                <th>Action</th>
            </tr>
                <?php foreach($objects as $k => $v): ?>
                    <tr>
                        <td><?=$no?></td>
                        <?php foreach($v as $_k => $_v): ?>
                            <td><?=$_v?></td>
                        <?php endforeach; ?>
                        <td>
                            <a href="<?=site_url($this->router->class.'/view/'.$v->id)?>">
                                <span class="glyphicon glyphicon-check"></span>
                            </a>
                            <a href="<?=site_url($this->router->class.'/edit/'.$v->id)?>">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="<?=site_url($this->router->class.'/delete/'.$v->id)?>">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr>
                    <?php
                        $no++;
                    ?>
                <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="well well-lg">
            <p class="lead text-center">
                Data tidak ditemukan :(
            </p>
        </div>
    <?php endif; ?>
</div>
<div style="margin: 20px 0;">
    <a href="<?=site_url($this->router->class.'/add')?>">
        <span class="glyphicon glyphicon-plus"></span>
        Add New <?=ucfirst($key)?>
    </a>
</div>
