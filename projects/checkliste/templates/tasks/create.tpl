{extends "projects/checkliste/templates/index.tpl"}
{block name=scripts_top append}
    <link type="text/css" href="framework/components/ext/datepicker/css/datepicker.css" rel="stylesheet">
{/block}
{block name=content}
    <h3>Aufgabe anlegen</h3>
    <form action="{$page}?site=tasks_create" method="post">
        <input type="hidden" class="form-control" id="id" name="id">
        <input type="hidden" class="form-control" id="finish_status" name="finish_status" value="0">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="headline" class="form-control label-default">Überschrift:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="headline" name="headline" value="{$task['headline']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="task" class="form-control label-default">Aufgabe:</label>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control" id="task" name="task">{$task['task']}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="participants_min" class="form-control label-default">Personen:</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control" id="participants_min" name="participants_min">
                        <option{if $task['participants_min']==0} selected="selected"{/if} value="0">-</option>
                        <option{if $task['participants_min']==1} selected="selected"{/if}>1</option>
                        <option{if $task['participants_min']==2} selected="selected"{/if}>2</option>
                        <option{if $task['participants_min']==3} selected="selected"{/if}>3</option>
                        <option{if $task['participants_min']==4} selected="selected"{/if}>4</option>
                        <option{if $task['participants_min']==5} selected="selected"{/if}>5</option>
                        <option{if $task['participants_min']==6} selected="selected"{/if}>6</option>
                        <option{if $task['participants_min']==7} selected="selected"{/if}>7</option>
                        <option{if $task['participants_min']==8} selected="selected"{/if}>8</option>
                        <option{if $task['participants_min']==9} selected="selected"{/if}>9</option>
                        <option{if $task['participants_min']==10} selected="selected"{/if}>10</option>
                        <option{if $task['participants_min']==11} selected="selected"{/if}>11</option>
                        <option{if $task['participants_min']==12} selected="selected"{/if}>12</option>
                        <option{if $task['participants_min']==13} selected="selected"{/if}>13</option>
                        <option{if $task['participants_min']==14} selected="selected"{/if}>14</option>
                        <option{if $task['participants_min']==15} selected="selected"{/if}>15</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="place" class="form-control label-default">Ort:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="place" name="place" value="{$task['place']}">
                </div>
            </div>
        </div>
        {if $isadmin}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="suitable_groups" class="form-control label-default">Freigeben für:</label>
                </div>
                <div class="col-md-9">
                    <div class="form-control" style="height:auto !important;">
                        {foreach item=group from=$usergroups}
                            <div class="checkbox-inline">
                                <label>
                                        <input type="checkbox" name="suitable_groups[]" value="{$group['id']}"
                                        {foreach item=suitable_group from=$suitable_groups}
                                            {if $suitable_group==$group['id']} checked="checked"{/if}
                                        {/foreach}
                                        >{$group['name']}

                                </label>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
        {else}
        <input type="hidden" name="suitable_groups[]" value="{$user['group']}">
        {/if}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="deadline" class="form-control label-default">Deadline:</label>
                </div>
                <div class="col-md-9">
                    <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{$task['deadline']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="submit" class="btn btn-default form-control" value="speichern">
                </div>
            </div>
        </div>
    </form>
{/block}
{block name=scripts_bottom append}
    {if !$isMobile}
    <script type="text/javascript" src="framework/components/ext/datepicker/js/datepicker.js"></script>
        <script type="text/javascript">
            $('#deadline').datetimepicker({
                format:'d.m. H:i',
                inline:false,
                lang:'de'
            });
        </script>
    {/if}
{/block}