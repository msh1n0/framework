{extends file="framework/template/system/index.tpl"}
    {block name=content}
        Herzlich Willkommen {$user} {if isset($satz)} und {$satz} {/if}
    {/block}