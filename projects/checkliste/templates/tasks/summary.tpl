{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    {include 'projects/checkliste/templates/_elements/tasksummary.tpl' overview=$overview headline=$headline mode=$mode}
{/block}