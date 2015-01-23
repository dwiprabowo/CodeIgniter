<style>
    div.home-index-page-wrapper{
        margin-top: 10%;
    }
    img.my-photo{
        width: 128px;
        border-radius: 128px;
        border: 8px solid rgba(0, 0, 255, .2);
        padding: 8px;
    }
    div.button-wrapper{
        margin-top: 2%;
    }
</style>
<div class="text-center home-index-page-wrapper">
    <div class="animation-wrapper">
        <?=assets('dwi.png', ['class' => 'my-photo'])?>
    </div>
    <div class="button-wrapper">
        <button class="btn btn-primary btn-lg">
            Let me say something?
        </button>
    </div>
</div>