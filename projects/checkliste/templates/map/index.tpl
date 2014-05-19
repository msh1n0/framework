{extends "projects/checkliste/templates/index.tpl"}

{block name=content}
    {if is_array($map)}
        <img src="projects/checkliste/contents/images/maps/{$map['id']}">
        {else}
        <img src="projects/checkliste/contents/images/maps/{$map}">
    {/if}
{/block}