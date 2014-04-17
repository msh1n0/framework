<?php /* Smarty version Smarty-3.1.18, created on 2014-04-17 21:56:00
         compiled from "templates\checkliste\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26928534ef6015a6604-61604765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85a53c511f4d4f34623bdec252a3e3bd8b7254df' => 
    array (
      0 => 'templates\\checkliste\\index.tpl',
      1 => 1397683805,
      2 => 'file',
    ),
    'e49ff70a9981b11cad3e0e2f873e8c63e566a6e6' => 
    array (
      0 => 'templates\\checkliste\\elements\\navigation_top.tpl',
      1 => 1397667596,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26928534ef6015a6604-61604765',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_534ef6016d3934_37463595',
  'variables' => 
  array (
    'metaCharset' => 0,
    'bootstrap_css' => 0,
    'swipe_css' => 0,
    'error' => 0,
    'message' => 0,
    'jquery' => 0,
    'bootstrap_js' => 0,
    'swipe_js' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534ef6016d3934_37463595')) {function content_534ef6016d3934_37463595($_smarty_tpl) {?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['metaCharset']->value;?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkliste</title>
    <?php echo $_smarty_tpl->tpl_vars['bootstrap_css']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['swipe_css']->value;?>

</head>
<body>

    <?php /*  Call merged included template "templates/checkliste/elements/navigation_top.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("templates/checkliste/elements/navigation_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '26928534ef6015a6604-61604765');
content_535031d11a7fd8_78421826($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "templates/checkliste/elements/navigation_top.tpl" */?>


<div class="container">
    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

    
    
</div>
<?php echo $_smarty_tpl->tpl_vars['jquery']->value;?>

<?php echo $_smarty_tpl->tpl_vars['bootstrap_js']->value;?>

<?php echo $_smarty_tpl->tpl_vars['swipe_js']->value;?>

</body>
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-17 21:56:01
         compiled from "templates\checkliste\elements\navigation_top.tpl" */ ?>
<?php if ($_valid && !is_callable('content_535031d11a7fd8_78421826')) {function content_535031d11a7fd8_78421826($_smarty_tpl) {?><div class="navbar navbar-default navbar-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if ($_smarty_tpl->tpl_vars['isLoggedIn']->value) {?>
                <a class="navbar-brand" href="index.php?site=statistics">Startseite</a>
            <?php } else { ?>
                <a class="navbar-brand" href="index.php?site=login">Einloggen</a>
            <?php }?>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if ($_smarty_tpl->tpl_vars['isLoggedIn']->value) {?>
                    <li><a href="index.php?site=statistics">Übersicht</a></li>
                    <li><a href="index.php?site=checklist">Meine Checkliste</a></li>
                    <li><a data-toggle="dropdown" href="#">Aufgaben</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="index.php?site=checklist">Hilfe benötigt</a></li>
                            <li><a href="index.php?site=checklist">Alle Aufgaben</a></li>
                        </ul>
                    </li>
                    <li><a href="">Hallenplan</a></li>
                    <li><a data-toggle="dropdown" href="#">Mein Status</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="index.php">beschäftigt</a></li>
                            <li><a href="index.php">suche Aufgabe</a></li>
                            <li><a href="index.php">Pause</a></li>
                            <li><a href="index.php">ABMELDEN</a></li>
                        </ul>
                    </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['isAdmin']->value) {?>
                    <li><a data-toggle="dropdown" href="#">Benutzeradministration</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="index.php?site=useradmin_summary">Benutzer verwalten</a></li>
                            <li><a href="index.php?site=useradmin_usergroups">Benutzergruppen verwalten</a></li>
                        </ul>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div><?php }} ?>
