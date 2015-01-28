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

<script>
    $(function(){
        var message = [
            {content: "Halo!", time: 2000},
            {content: "Perkenalkan", time: 1000},
            {content: "Nama saya <strong>Juli</strong>", time: 3000},
            {content: "bekerja sebagai <strong>Web Programmer</strong>", time: 4000},
            {content: "memiliki pengalaman kerja", time: 1500},
            {content: "kurang lebih selama <strong>3 Tahun</strong>", time: 3000},
        ];
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
            speak();
        });

        function speak(){
            var time_padding = 0;
            for(var i = 0;i < message.length;i++){
                console.log(time_padding);
                updateContent(message[i].content, message[i].time, time_padding);
                time_padding += message[i].time;
                time_padding += 1500;
            }
        }

        function updateContent(message, time, time_start){
            setTimeout(function(){
                console.log('called: '+message);
                $("#popup_text").popover({
                    html: true,
                    content: message,
                });
                $("#popup_text").popover('show');
                setTimeout(function(){
                    $("#popup_text").popover('destroy');
                }, time+1000);
            }, time_start);
        }
    });
</script>