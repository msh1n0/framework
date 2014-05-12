{extends "templates/checkliste/index.tpl"}
{block name=content}
    {include 'templates/checkliste/_elements/tasksummary.tpl' overview=$overview headline=$headline mode=$mode}
{/block}