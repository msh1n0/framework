<?php /* Smarty version Smarty-3.1.18, created on 2014-04-16 21:57:46
         compiled from "framework\template\danbooru\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4019534ee0ba0aa314-39006099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d218cf3cc3be14384c68e19c60e093ae73e8ee2' => 
    array (
      0 => 'framework\\template\\danbooru\\index.tpl',
      1 => 1397678261,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4019534ee0ba0aa314-39006099',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'metaCharset' => 0,
    'bootstrap_css' => 0,
    'swipe_css' => 0,
    'content' => 0,
    'jquery' => 0,
    'bootstrap_js' => 0,
    'swipe_js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_534ee0ba2fc975_33035125',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534ee0ba2fc975_33035125')) {function content_534ee0ba2fc975_33035125($_smarty_tpl) {?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['metaCharset']->value;?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Danbooru</title>
    <?php echo $_smarty_tpl->tpl_vars['bootstrap_css']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['swipe_css']->value;?>

</head>
<body>
<div class="container">
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

</div>
<?php echo $_smarty_tpl->tpl_vars['jquery']->value;?>

<?php echo $_smarty_tpl->tpl_vars['bootstrap_js']->value;?>

<?php echo $_smarty_tpl->tpl_vars['swipe_js']->value;?>

</body>
</html><?php }} ?>
