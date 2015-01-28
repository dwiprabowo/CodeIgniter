<style>
    div.home-index-page-wrapper{
        margin-top: 10%;
    }
    div.screen-wrapper{
        display: inline-block;
        border: 1px solid black;
        padding: 0;
        margin: 0;
        height: 130px;
    }
    div.button-wrapper{
        margin-top: 2%;
    }
    div.animated_image_place_wrapper{
        display: inline-block;
        width: 128px;
        height: 128px;
        position: relative;
    }
    img.image-frames{
        width: 128px;
        height: 128px;
        position: absolute;
        top: 0;
        left: 0;
    }
    .contact_area{
        left: 0;
        width: 100%;
        position: fixed;
        bottom: 10%;
    }
    .contact_area .contact_content .contact_item{
        display: inline-block;
        margin: 5%;
    }
    .contact_area .contact_content .contact_item i{
        font-size: 32px;
    }
</style>
<div class="text-center home-index-page-wrapper">
    <div class="text-center">
        <div 
            id="popup_text" 
            class="screen-wrapper"
        >
            <div class="animated_image_place_wrapper">
                <img class="image-frames" src="<?=base_url('assets/img/face-animated/base.png')?>">
                <img id="eyes" class="image-frames" src="<?=base_url('assets/img/face-animated/eyes-opened.png')?>">
            </div>
        </div>
    </div>
    <div class="button-wrapper">
        <button 
            type="button" 
            id="speak_trigger"
            class="btn btn-lg btn-danger" 
            title="Popover title" 
            onclick="$('#trigger').popover('toggle')" 
        ><span class="glyphicon glyphicon-play"></span></button>
    </div>
</div>
<div class="contact_area">
    <div class="contact_content text-center">
        <div class="contact_item">
            <a href="https://www.facebook.com/juli.prabowo">
                <i class="fa fa-facebook-official"></i>
            </a>
        </div>
        <div class="contact_item">
            <a href="https://twitter.com/dwjpr">
                <i class="fa fa-twitter"></i>
            </a>
        </div>
        <div class="contact_item">
            <a href="id.linkedin.com/pub/dwi-prabowo/40/ba5/895">
                <i class="fa fa-linkedin-square"></i>
            </a>
        </div>
        <div class="contact_item">
            <a href="mailto:dwi.juli.prabowo@gmail.com">
                <i class="fa fa-envelope"></i>
            </a>
        </div>
        <div class="contact_item">
            <a href="tel:+6285640988820">
                <i class="fa fa-mobile-phone"></i>
            </a>
        </div>
    </div>
</div>

<script>
    var hour = 10;
    $(function(){
        function getHour(){
            var now = new Date();
            return now.getHours();
        }
        var speaking = false;

        function getDayGreetingCode(hour){
            var value = "";
            if(hour > 4 && hour <= 10){
                value = "pagi";
            }else if(hour > 11 && hour <= 14){
                value = "siang";
            }else if(hour > 14 && hour <= 18){
                value = "sore";
            }else{
                value = "malam";
            }
            return value;
        }
        var base_path = "<?=base_url()?>";
        var eyes = [
            'assets/img/face-animated/eyes-closed.png',
            'assets/img/face-animated/eyes-opened.png',
        ];
        setInterval(blink, 4000);
        function blink(){
            $("#eyes").attr('src', base_path+eyes[0]);
            setTimeout(function(){
                $("#eyes").attr('src', base_path+eyes[1]);
            }, (1000*Math.random()));
        }

        $("#speak_trigger").click(function(){
            if(!speaking){
                $("#speak_trigger").fadeOut('slow');
                speak();
                speaking = true;
            }
        });

        function speak(){
            var message = [
                {content: "Halo! Selamat "+getDayGreetingCode(getHour()), time: 1500},
                {content: "Nama saya <strong>Dwi Juli Prabowo</strong>", time: 2000},
                {content: "Selamat datang di halaman profil <i>online</i> saya", time: 3000},
                {content: "Untuk mengetahui lebih detail mengenai saya, Anda bisa mengakses menu yang ada di <strong>kanan atas</strong>", time: 6000},
                {content: "Untuk kontak langsung dengan saya, Anda bisa menghubungi akun sosial media, email atau nomor telepon genggam yang ada di <strong>bawah</strong>", time: 8000},
                {content: "Terima kasih, semoga "+getDayGreetingCode(getHour())+" Anda menyenangkan", time: 6000},
            ];
            var time_padding = 0;
            for(var i = 0;i < message.length;i++){
                updateContent(message[i].content, message[i].time, time_padding);
                time_padding += message[i].time;
                time_padding += 1200;
            }
            reshow_trigger(time_padding);
        }

        function reshow_trigger(time){
            setTimeout(function(){
                speaking = false;
                $("#speak_trigger").fadeIn('slow');
            }, time);
        }

        function updateContent(message, time, time_start){
            setTimeout(function(){
                var placement = 'bottom';
                if($(window).width() > 768){
                    placement = 'right';
                }
                $("#popup_text").popover({
                    html: true,
                    placement: placement,
                    content: message,
                });
                $("#popup_text").popover('show');
                setTimeout(function(){
                    $("#popup_text").popover('destroy');
                }, time+200);
            }, time_start);
        }
    });
</script>