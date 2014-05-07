{extends "templates/checkliste/index.tpl"}
{block name=scripts_top append}
    <link type="text/css" href="framework/components/ext/datepicker/css/datepicker.css" rel="stylesheet">
{/block}
{block name=content}
<div class="alert alert-info">
    <h1>Aufgabe anlegen</h1>
    <form action="{$page}?site=tasks_edit" method="post">
        <input type="hidden" class="form-control" id="id" name="id" value="{$task['id']}">
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
                    <label for="place" class="form-control label-default">Ort:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="place" name="place" value="{$task['place']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="suitable_groups" class="form-control label-default">Freigeben für:</label>
                </div>
                <div class="col-md-9">
                    <div class="form-control">
                        {$suitable_groups}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="deadline" class="form-control label-default">Deadline:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="deadline" name="deadline" value="{$task['deadline']}">
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
</div>
{/block}
{block name=scripts_bottom append}
    <script type="text/javascript" src="framework/components/ext/datepicker/js/datepicker.js"></script>
    <script type="text/javascript">
        $('#deadline').datetimepicker({
            format:'d.m. H:i',
            inline:true,
            lang:'de'
        });
    </script>
{/block}