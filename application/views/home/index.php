<style>
    input[type=text].email_subscribe{
        font-size: 3em;
        padding: .45em 2em;
        width: 100%;
        border: none;
        background-color: transparent;
        outline: none;
        font-weight: bold;
    }
    div.well.well-lg{
        position: relative;
    }
    span.enter_command{
        position: absolute;
        font-size: 6em;
        top: -2%;
        right: 1%;
    }
    @media (max-width: 982px){
        span.enter_command{
            font-size: 4.5em;
            top: -20%;
            right: 1%;
        }
        input[type=text].email_subscribe{
            font-size: 2em;
            padding: .25em 2.15em;
        }
    }
    @media (max-width: 768px){
        span.enter_command{
            font-size: 3em;
        }
        input[type=text].email_subscribe{
            font-size: 1.5em;
            padding: .15em 1em;
        }
    }
    div.main_content{
        padding-top: 5%;
    }
    div.main_title{
        font-size: 48px;
        font-weight: bold;
        margin: 3% 0;
    }
    span.special-case{
        font-size: 72px;
    }
    h1, span.enter_command{
        -webkit-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
    }
    h1.text-muted, h1.text-muted small, span.enter_command.text-muted{
        color: #eee;
    }
    .well-lg{
        padding: 2px;
    }
</style>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="main_content">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h1 class="text-center">
                        <small>Masukan</small> <em>email</em> <strong>Anda</strong> 
                        <small> 
                            untuk mendapatkan kabar terbaru dari 
                        </small>
                        <div class="main_title font_serif">
                            <span class="special-case">&#120016;</span>qsara
                        </div>
                    </h1>
                </div>
            </div>
            <div class="well well-lg">
                <?=form_open()?>
                <input 
                    type="text" 
                    class="email_subscribe text-center" 
                    spellcheck="false"
                    name="email"
                    autocomplete="off"
                    value="<?=set_value('email')?>" 
                    autofocus
                >
                <span 
                    class="enter_command text-muted" 
                    data-toggle="tooltip" 
                    title="Tekan tombol Enter"
                >
                    &#9166;
                </span>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

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
    moveCursorToEnd($(".email_subscribe")[0]);
    $(function(){
        $('.email_subscribe').keyup(function(){
            if($(this).val() != ""){
                $("h1.text-center").addClass("text-muted");
                $("span.enter_command").removeClass("text-muted");
            }else{
                $("h1.text-center").removeClass("text-muted");
                $("span.enter_command").addClass("text-muted");
            }
        });
        $('.email_subscribe').blur(function(){
            $(this).focus();
        });
    });
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>