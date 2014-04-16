<?php /* Smarty version Smarty-3.1.18, created on 2014-04-16 19:42:16
         compiled from "framework\template\checkliste\checklist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1850534ec0f842eaa8-62409005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea9eb79b91c164887aa8b7e5a95a634a33a587aa' => 
    array (
      0 => 'framework\\template\\checkliste\\checklist.tpl',
      1 => 1397667596,
      2 => 'file',
    ),
    '26e338a3eee349e2495b148be7fba9621aab0112' => 
    array (
      0 => 'framework\\template\\checkliste\\index.tpl',
      1 => 1397667596,
      2 => 'file',
    ),
    'b805fb195f166a1737abbb83856485ae38ffc155' => 
    array (
      0 => 'framework\\template\\checkliste\\elements\\navigation_top.tpl',
      1 => 1397667596,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1850534ec0f842eaa8-62409005',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_534ec0f8492ad1_89813674',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534ec0f8492ad1_89813674')) {function content_534ec0f8492ad1_89813674($_smarty_tpl) {?><!DOCTYPE html>
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

    <?php /*  Call merged included template "framework/template/checkliste/elements/navigation_top.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("framework/template/checkliste/elements/navigation_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '1850534ec0f842eaa8-62409005');
content_534ec0f8475b84_57775111($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "framework/template/checkliste/elements/navigation_top.tpl" */?>


<div class="container">
    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

    
    
</div>
<?php echo $_smarty_tpl->tpl_vars['jquery']->value;?>

<?php echo $_smarty_tpl->tpl_vars['bootstrap_js']->value;?>

<?php echo $_smarty_tpl->tpl_vars['swipe_js']->value;?>

</body>
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-16 19:42:16
         compiled from "framework\template\checkliste\elements\navigation_top.tpl" */ ?>
<?php if ($_valid && !is_callable('content_534ec0f8475b84_57775111')) {function content_534ec0f8475b84_57775111($_smarty_tpl) {?><div class="navbar navbar-default navbar-top" role="navigation">
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
