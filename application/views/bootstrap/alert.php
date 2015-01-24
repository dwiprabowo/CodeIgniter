<?php if(@$alerts): ?>
    <div id="aqsara_alert_wrapper">
        <?php foreach($alerts as $alert): ?>
            <div>
                <div
                    class="
                        alert
                        alert-<?=$alert['label']?>
                        alert-dismissible
                        fade
                        aqsara_alert
                    "
                    role="alert"
                >
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                    <?=$alert['message']?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        $(function(){
            var start = 0;
            var show_time = 7;
            var range = 2;
            $('.aqsara_alert').each(function(){
                var self = this;
                start = start + range;
                setTimeout(function(){
                    $(self).addClass('in');
                }, start*1000);
                setTimeout(function(){
                    slideUp(self);
                }, (show_time+start)*1000);
            });
        });
        function slideUp(el){
            $(el).removeClass('in');
            setTimeout(function(){
                $(el).slideUp();
            }, 100);
        }
    </script>
<?php endif; ?>
