{extends "templates/pathfinder/index.tpl"}
{block name=content}
    {if isset($error)}
        <div class="alert alert-danger">
            {$error}
        </div>
    {else}
        <style>{$map_css}</style>
        <div class="alert alert-info">
            <h1>Karte</h1>
            {$mapboard}
            {$mapboard_css}
        </div>
    {/if}
{/block}