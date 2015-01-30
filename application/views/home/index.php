<style>
    div.screen-wrapper{
        display: inline-block;
        border: 15px solid rgba(204, 198, 198, 1);
        border-radius: 30px;
        padding: 10px 20px;
        padding-bottom: 0px;
        margin: 0;
        height: 162px;
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
        width: 50px;
        height: 50px;
        margin: 60px;
    }
    .contact_area .contact_content .contact_item i{
        font-size: 72px;
    }
    .contact_area .contact_content a.contact_item:hover i.fa{
        font-size: 108px;
    }

    i.fa{
        -webkit-transition: all .2s;
        transition: all .2s;
    }

    i.fa-facebook-official{
       color: #3B5998;
    }
    a:hover i.fa-facebook-official{
        color: #2F3E5F;
    }

    i.fa-envelope{
        color: #DA5043;
    }
    a:hover i.fa-envelope{
        color: #89241B;
    }

    i.fa-mobile-phone{
        color: #999;
    }
    a:hover i.fa-mobile-phone{
        color: #333;
    }

    div.popover-content{
        text-align: center;
    }

    @media (max-width: 992px){
        .contact_area .contact_content .contact_item{
            display: inline-block;
            width: 40px;
            height: 40px;
            margin: 50px;
        }
        .contact_area .contact_content a.contact_item:hover i.fa{
            font-size: 72px;
        }
        .contact_area .contact_content .contact_item i{
            font-size: 64px;
        }
    }
    @media (max-width: 768px){
        .contact_area .contact_content .contact_item{
            display: inline-block;
            width: 30px;
            height: 30px;
            margin: 30px;
        }
        .contact_area .contact_content a.contact_item:hover i.fa{
            font-size: 64px;
        }
        .contact_area .contact_content .contact_item i{
            font-size: 48px;
        }
    }
    @media (max-width: 480px){
        .contact_area .contact_content .contact_item{
            display: inline-block;
            width: 20px;
            height: 20px;
            margin: 20px;
        }
        .contact_area .contact_content a.contact_item:hover i.fa{
            font-size: 48px;
        }
        .contact_area .contact_content .contact_item i{
            font-size: 32px;
        }
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
</div>
<div class="contact_area">
    <div class="contact_content text-center">
        <a class="contact_item" href="https://www.facebook.com/juli.prabowo">
            <i class="fa fa-facebook-official"></i>
        </a>
        <a class="contact_item" href="https://twitter.com/dwjpr">
            <i class="fa fa-twitter"></i>
        </a>
        <a class="contact_item" href="http://id.linkedin.com/pub/dwi-prabowo/40/ba5/895">
            <i class="fa fa-linkedin-square"></i>
        </a>
        <a class="contact_item" href="mailto:dwi.juli.prabowo@gmail.com">
            <i class="fa fa-envelope text-danger"></i>
        </a>
        <a class="contact_item" href="tel:+6285640988820">
            <i class="fa fa-mobile-phone"></i>
        </a>
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
            if(hour > 3 && hour <= 10){
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

        $(".animated_image_place_wrapper").hover(function(){
            if(!speaking){
                speaking = true;
                speak();
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
            var time_padding = 500;
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