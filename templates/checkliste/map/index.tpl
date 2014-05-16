{extends "templates/checkliste/index.tpl"}
{block name=content}
    <div class="alert alert-info text-center">
        {if is_array($map)}
            <img src="contents/checkliste/images/maps/{$map['id']}">
            {else}
            <img src="contents/checkliste/images/maps/{$map}">
        {/if}
    </div>
{/block}