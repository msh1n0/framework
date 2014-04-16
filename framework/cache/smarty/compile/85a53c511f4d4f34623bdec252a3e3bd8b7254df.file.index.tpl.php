<?php /* Smarty version Smarty-3.1.18, created on 2014-04-16 23:28:33
         compiled from "templates\checkliste\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26928534ef6015a6604-61604765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85a53c511f4d4f34623bdec252a3e3bd8b7254df' => 
    array (
      0 => 'templates\\checkliste\\index.tpl',
      1 => 1397667596,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26928534ef6015a6604-61604765',
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
  'unifunc' => 'content_534ef6016d3934_37463595',
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

    <?php echo $_smarty_tpl->getSubTemplate ("framework/template/checkliste/elements/navigation_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="container">
    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

    
    
</div>
<?php echo $_smarty_tpl->tpl_vars['jquery']->value;?>

<?php echo $_smarty_tpl->tpl_vars['bootstrap_js']->value;?>

<?php echo $_smarty_tpl->tpl_vars['swipe_js']->value;?>

</body>
</html><?php }} ?>
