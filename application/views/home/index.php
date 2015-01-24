<style>
    .form-control{
        height: 2.125em;
    }
    input[type=text]#email{
        font-size: 3em;
        font-weight: bold;
        text-align: center;
        padding: .75em 2.5em;
    }
    div.form_wrapper{
        position: relative;
    }
    span.enter_command{
        position: absolute;
        font-size: 6em;
        top: -12%;
        right: -1%;
    }
    @media (max-width: 982px){
        span.enter_command{
            font-size: 4.2em;
            top: -14%;
        }
        input[type=text]#email{
            font-size: 2em;
            padding: .25em 2.35em;
        }
    }
    @media (max-width: 768px){
        span.enter_command{
            font-size: 3em;
            top: -11%;
        }
        input[type=text]#email{
            font-size: 1.5em;
            padding: .15em 2.15em;
        }
    }
    div.main_content{
        padding-top: 5%;
    }
    div.main_title{
        font-size: 48px;
        font-weight: bold;
        margin: 3% 0;
        position: relative;
        right: 30px;
    }
    span.special-case{
        font-size: 64px;
        position: relative;
        top: 11px;
        right: -20px;
    }
    h1, span.enter_command{
        -webkit-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
    }
    h1.text-muted, h1.text-muted small, span.enter_command.text-muted{
        color: #eee;
    }
    span.text-left.help-block{
        text-align: center;
    }
    div.text_part{
        margin-bottom: 3%;
    }
</style>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="main_content">
            <div class="row text_part">
                <div class="col-sm-8 col-sm-offset-2">
                    <h1 class="text-center">
                        <small>Masukan</small> <em>email</em> <strong>Anda</strong> 
                        <small> 
                            untuk mendapatkan kabar terbaru dari 
                        </small>
                        <div class="main_title font_serif">
                            <span class="icon-aqsara-logo special-case"></span>qsara
                        </div>
                    </h1>
                </div>
            </div>
            <div class="form_wrapper">
                <?=twbs_form($email)?>
                <span 
                    class="icon-enter-key enter_command text-muted"
                    data-toggle="tooltip"
                    title="Tekan Enter"
                ></span>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#email').keyup(function(){
            if($(this).val() != ""){
                $("h1.text-center").addClass("text-muted");
                $("span.enter_command").removeClass("text-muted");
            }else{
                $("h1.text-center").removeClass("text-muted");
                $("span.enter_command").addClass("text-muted");
            }
        });
        $('#email').blur(function(){
            $(this).focus();
        });
    });
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>