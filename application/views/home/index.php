<style>
    div.screen-wrapper{
        cursor: pointer;
        display: inline-block;
        border: 15px solid rgba(204, 198, 198, 1);
        border-radius: 30px;
        padding: 10px 20px;
        padding-bottom: 0px;
        margin: 0;
        height: 168px;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
    div.screen-wrapper:hover{
        border-color: rgba(104, 98, 98, 1);
        background: rgba(104, 98, 98, .1);
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
    div.popover-content{
        text-align: center;
    }
    .home-index-page-wrapper{
        position: relative;
        padding-top: 60px;
    }
    div#popover_container{
        position: absolute;
        width: 100%;
        height: 10px;
        top: 180px;
    }
    .contact_area{
        margin-top: 120px;
    }
    .contact_area a.contact_item{
        display: inline-block;
        position: relative;
        text-decoration: none;
        margin: 2px 16px;
        padding: 2px 10px;
    }
    .contact_area i.fa{
        position: absolute;
        -webkit-transition: font-size .2s;
        transition: font-size .2s;
        top: 40%;
        left: 50%;
        font-size: 40px;
        margin-left: -20px;
        margin-top: -20px;
    }

    i.fa.fa-facebook-official{
        color: #3B5998;
    }
    i.fa.fa-twitter{
        color: #5EA9DD;
    }
    i.fa.fa-linkedin-square{
        color: #0077B5;
    }
    i.fa.fa-envelope{
        color: #DD4B39;
    }
    i.fa.fa-phone{
        color: #009A56;
    }

    @media (min-width: 768px){
        .home-index-page-wrapper{
            padding-top: 20px;
        }
        div#popover_container{
            top: 150px;
        }
        .contact_area{
            margin-top: 90px;
        }
        .contact_area a.contact_item{
            margin: 2px 36px;
            padding: 2px 24px;
        }
    }
    @media (min-width: 992px){
        .home-index-page-wrapper{
            padding-top: 70px;
        }
        div#popover_container{
            top: 180px;
        }
        .contact_area{
            margin-top: 120px;
        }
        .contact_area a.contact_item{
            padding: 2px 36px;
        }
        .contact_area i.fa{
            font-size: 72px;
            margin-left: -36px;
            margin-top: -36px;
        }
    }
    @media (min-width: 1200px){
        .home-index-page-wrapper{
            padding-top: 90px;
        }
        div#popover_container{
            top: 200px;
        }
        .contact_area{
            margin-top: 160px;
        }
        .contact_area a.contact_item{
            margin: 2px 48px;
            padding: 2px 48px;
            -webkit-transition: font-size .2s;
            transition: font-size .2s;
        }
        .contact_area a.contact_item:hover i.fa{
            font-size: 96px;
        }
    }
</style>

<div class="row">
    <div class="col-sm-12 text-center">
        <div class="home-index-page-wrapper">
            <div class="screen-wrapper">
                <div class="animated_image_place_wrapper">
                    <img class="image-frames" src="<?=base_url('assets/img/face-animated/base.png')?>">
                    <img id="eyes" class="image-frames" src="<?=base_url('assets/img/face-animated/eyes-opened.png')?>">
                </div>
            </div>
            <div id="popover_container"></div>
        </div>
    </div>
    <div class="col-sm-12 text-center contact_area">
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
            <i class="fa fa-envelope"></i>
        </a>
        <a class="contact_item" href="tel:+6285640988820">
            <i class="fa fa-phone"></i>
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

        $(".screen-wrapper").click(function(){
            if(!speaking){
                speaking = true;
                speak();
            }
        });

        function speak(){
            var message = [
                {
                    content: "Halo! Selamat "+getDayGreetingCode(getHour())
                    , time: 1500
                },
                {
                    content: "Nama saya <strong>Dwi Juli Prabowo</strong>"
                    , time: 2000
                },
                {
                    content: "Selamat datang di halaman profil <i>online</i> saya"
                    , time: 3000
                },
                {
                    content: "Informasi untuk Anda,"
                        +" profil ini berhubungan dengan industry"
                        +" <strong>Teknologi Informasi</strong>"
                    , time: 7000
                },
                {
                    content: "Untuk mengetahui lebih detail mengenai saya,"
                        +" Anda bisa mengakses menu yang ada di "
                        +"<strong>kanan atas</strong>"
                    , time: 6000
                },
                {
                    content: "Untuk kontak langsung dengan saya,"
                        +" Anda bisa menghubungi akun sosial media,"
                        +" email atau nomor telepon genggam "
                        +"yang ada di <strong>bawah</strong>"
                    , time: 7000
                },
                {
                    content: "Terima kasih, semoga "
                        +getDayGreetingCode(getHour())
                        +" Anda menyenangkan"
                    , time: 4000
                },
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
                $("#popover_container").popover({
                    html: true,
                    placement: 'bottom',
                    content: message,
                });
                $("#popover_container").popover('show');
                setTimeout(function(){
                    $("#popover_container").popover('destroy');
                }, time+200);
            }, time_start);
        }
    });
</script>