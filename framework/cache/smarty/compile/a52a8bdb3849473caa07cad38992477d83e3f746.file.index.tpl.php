<?php /* Smarty version Smarty-3.1.18, created on 2014-04-14 21:45:45
         compiled from "framework\template\custom\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120155346ee1cb71f44-23264575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a52a8bdb3849473caa07cad38992477d83e3f746' => 
    array (
      0 => 'framework\\template\\custom\\index.tpl',
      1 => 1397504511,
      2 => 'file',
    ),
    '11773299d59f4dc5ed154ffffc2b3f62cdb32763' => 
    array (
      0 => 'framework\\template\\system\\elements\\navigation_top.tpl',
      1 => 1397504511,
      2 => 'file',
    ),
    'adb3949bc23f46458229e7c987493310e5c0b513' => 
    array (
      0 => 'framework\\template\\system\\elements\\mapboard.tpl',
      1 => 1397504745,
      2 => 'file',
    ),
    'c78d77f5dd327dae148ba4ba88853c102829421a' => 
    array (
      0 => 'framework\\template\\system\\elements\\navigation_bottom.tpl',
      1 => 1397504511,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120155346ee1cb71f44-23264575',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5346ee1cbcb2a6_59633118',
  'variables' => 
  array (
    'metaCharset' => 0,
    'bootstrap_css' => 0,
    'swipe_css' => 0,
    'jquery' => 0,
    'bootstrap_js' => 0,
    'swipe_js' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5346ee1cbcb2a6_59633118')) {function content_5346ee1cbcb2a6_59633118($_smarty_tpl) {?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['metaCharset']->value;?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Testumgebung</title>
    <?php echo $_smarty_tpl->tpl_vars['bootstrap_css']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['swipe_css']->value;?>

</head>
<body>

    <?php /*  Call merged included template "framework/template/system/elements/navigation_top.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("framework/template/system/elements/navigation_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '120155346ee1cb71f44-23264575');
content_534c3ae998ffa3_85449467($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "framework/template/system/elements/navigation_top.tpl" */?>


<div class="container">
    
        <?php /*  Call merged included template "framework/template/system/elements/mapboard.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("framework/template/system/elements/mapboard.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '120155346ee1cb71f44-23264575');
content_534c3ae9995a60_00364002($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "framework/template/system/elements/mapboard.tpl" */?>
    
</div>



    <?php /*  Call merged included template "framework/template/system/elements/navigation_bottom.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("framework/template/system/elements/navigation_bottom.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '120155346ee1cb71f44-23264575');
content_534c3ae999d691_54321890($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "framework/template/system/elements/navigation_bottom.tpl" */?>



<?php echo $_smarty_tpl->tpl_vars['jquery']->value;?>

<?php echo $_smarty_tpl->tpl_vars['bootstrap_js']->value;?>

<?php echo $_smarty_tpl->tpl_vars['swipe_js']->value;?>

</body>
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-14 21:45:45
         compiled from "framework\template\system\elements\navigation_top.tpl" */ ?>
<?php if ($_valid && !is_callable('content_534c3ae998ffa3_85449467')) {function content_534c3ae998ffa3_85449467($_smarty_tpl) {?><div class="navbar navbar-default navbar-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Startseite</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="">Seite1</a></li>
                <li><a data-toggle="dropdown" href="#">Mehrere Seiten</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="index.php">Seite 2</a></li>
                        <li><a href="index.php">Seite 3</a></li>
                        <li><a href="index.php">Seite 4</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-14 21:45:45
         compiled from "framework\template\system\elements\mapboard.tpl" */ ?>
<?php if ($_valid && !is_callable('content_534c3ae9995a60_00364002')) {function content_534c3ae9995a60_00364002($_smarty_tpl) {?>    <?php echo $_smarty_tpl->tpl_vars['mapboard_css']->value;?>

<div class="alert alert-success">
    <?php echo $_smarty_tpl->tpl_vars['mapboard']->value;?>

</div><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-14 21:45:45
         compiled from "framework\template\system\elements\navigation_bottom.tpl" */ ?>
<?php if ($_valid && !is_callable('content_534c3ae999d691_54321890')) {function content_534c3ae999d691_54321890($_smarty_tpl) {?><div class="navbar navbar-default navbar-bottom" role="navigation">
    <div class="container ">
        <h5>FOOTER</h5>
    </div>
</div><?php }} ?>
