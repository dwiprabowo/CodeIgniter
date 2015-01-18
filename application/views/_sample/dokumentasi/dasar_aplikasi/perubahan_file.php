<?php
    function print_diff($item){
?>
        <div class="a_diff">
            <div class="a_diff_content">
                <pre class="bg-danger"><?=$item[0]?></pre>
                <pre class="bg-success"><?=$item[1]?></pre>
            </div>
            <div class="a_diff_toggle">
                <strong>...</strong>
            </div>
            <div class="a_diff_content">
                <br>
            </div>
        </div>
<?php
    }

    $items = [
        "application/config/autoload.php" => [
            "diff" => [
                [
<<<EOD
-\$autoload['libraries'] = array();
EOD
,
<<<EOD
+\$autoload['libraries'] = array('assets');
EOD
                ],
                [
<<<EOD
-\$autoload['drivers'] = array();
EOD
,
<<<EOD
+\$autoload['drivers'] = array('session');
EOD
                ],
                [
<<<EOD
-\$autoload['helper'] = array();
EOD
,
<<<EOD
+\$autoload['helper'] = array('base', 'url', 'html');
EOD
                ],
                [
<<<EOD
-\$autoload['config'] = array();
EOD
,
<<<EOD
+\$autoload['config'] = array('base');
EOD
                ],
            ],
            "msg" =>
<<<EOD
Perubahan dilakukan untuk menambah daftar autoload dari codeigniter file.
beberapa autoload sudah tersedia dari framework codeigniter dan yang lainnya
tambahan dari aplikasi ini.
EOD
,
        ],
        "application/config/config.php" => [],
        "application/config/constants.php" => [],
        "application/config/hooks.php" => [],
        "application/config/routes.php" => [],
        "composer.json" => [],
    ];
?>

<style>
    .part strong{
        cursor: pointer;
    }
    pre{
        border-radius: 0;
        margin-bottom: 0;
    }
    .a_diff .a_diff_toggle{
        cursor: pointer;
        border-bottom: 1px solid #333;
        margin-bottom: 7px;
    }
</style>
<h1 class="title"><small>Perubahan file</small></h1>
<?php foreach($items as $k => $v): ?>
    <div class="part">
        <strong><?=$k?></strong>
        <div class="fold">
            <?php if(isset($v['diff'])): ?>
                <?php foreach($v['diff'] as $_k => $_v): ?>
                    <?=print_diff($_v)?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if(isset($v['msg'])): ?>
                <div class="well">
                    <?=$v['msg']?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(function(){
        $(".fold").hide();
        $(".a_diff_content").hide();
        $(".part > strong").click(function(){
            $(this).closest(".part").find(".fold").slideToggle('slow');
        });
        $(".a_diff > .a_diff_toggle").click(function(){
            $(this).closest(".a_diff").find(".a_diff_content").slideToggle('slow');
        })
    });
</script>
