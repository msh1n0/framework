{extends "projects/checkliste/templates/index.tpl"}

{block name=content}
    {if is_array($map)}
        <a href="projects/checkliste/contents/images/maps/{$map['id']}" target="_blank">
            <img id="map" src="projects/checkliste/contents/images/maps/{$map['id']}">
        </a>
        {else}
        <a href="projects/checkliste/contents/images/maps/{$map}" target="_blank">
            <img id="map" src="projects/checkliste/contents/images/maps/{$map}">
        </a>
    {/if}
    <style>
        {literal}
        #map{
            max-width:100%;
        }
        {/literal}
    </style>
{/block}