{extends file="framework/template/system/index.tpl"}
    {block name=content}
        <div class="alert alert-success">
            Custom-Template geladen mit dem Content: {$content}


            der Nutzer heißt {$username} und hat Userlevel {$userlevel}

            {$swipe}

            {$swipe_nav}


        </div>
    {/block}