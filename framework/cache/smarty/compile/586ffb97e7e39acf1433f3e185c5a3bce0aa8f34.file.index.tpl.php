<?php /* Smarty version Smarty-3.1.18, created on 2014-04-12 01:03:12
         compiled from "framework\template\User22\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15205534874b06e6058-63776952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '586ffb97e7e39acf1433f3e185c5a3bce0aa8f34' => 
    array (
      0 => 'framework\\template\\User22\\index.tpl',
      1 => 1397257391,
      2 => 'file',
    ),
    '1818f891192b917456ea19a4392624a89dd709cb' => 
    array (
      0 => 'framework\\template\\system\\index.tpl',
      1 => 1397156975,
      2 => 'file',
    ),
    '11773299d59f4dc5ed154ffffc2b3f62cdb32763' => 
    array (
      0 => 'framework\\template\\system\\elements\\navigation_top.tpl',
      1 => 1397156975,
      2 => 'file',
    ),
    'c78d77f5dd327dae148ba4ba88853c102829421a' => 
    array (
      0 => 'framework\\template\\system\\elements\\navigation_bottom.tpl',
      1 => 1397156975,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15205534874b06e6058-63776952',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'metaCharset' => 0,
    'bootstrap_css' => 0,
    'jquery' => 0,
    'bootstrap_js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_534874b07328d1_82158764',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534874b07328d1_82158764')) {function content_534874b07328d1_82158764($_smarty_tpl) {?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['metaCharset']->value;?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testumgebung</title>
    <?php echo $_smarty_tpl->tpl_vars['bootstrap_css']->value;?>

</head>
<body>

    <?php /*  Call merged included template "framework/template/system/elements/navigation_top.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("framework/template/system/elements/navigation_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '15205534874b06e6058-63776952');
content_534874b07192d4_55703016($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "framework/template/system/elements/navigation_top.tpl" */?>


<div class="container">
    
        <div class="alert alert-info">
            <h1>Willkommen</h1>
        </div>
    
    
        <div class="alert alert-success">
            Das Template ist nur für User22!!


            der Nutzer heißt <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
 und hat Userlevel <?php echo $_smarty_tpl->tpl_vars['userlevel']->value;?>

        </div>
    
</div>



    <?php /*  Call merged included template "framework/template/system/elements/navigation_bottom.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("framework/template/system/elements/navigation_bottom.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '15205534874b06e6058-63776952');
content_534874b072cfc7_88692102($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "framework/template/system/elements/navigation_bottom.tpl" */?>



<?php echo $_smarty_tpl->tpl_vars['jquery']->value;?>

<?php echo $_smarty_tpl->tpl_vars['bootstrap_js']->value;?>

</body>
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-12 01:03:12
         compiled from "framework\template\system\elements\navigation_top.tpl" */ ?>
<?php if ($_valid && !is_callable('content_534874b07192d4_55703016')) {function content_534874b07192d4_55703016($_smarty_tpl) {?><div class="navbar navbar-inverse navbar-top" role="navigation">
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
<?php /* Smarty version Smarty-3.1.18, created on 2014-04-12 01:03:12
         compiled from "framework\template\system\elements\navigation_bottom.tpl" */ ?>
<?php if ($_valid && !is_callable('content_534874b072cfc7_88692102')) {function content_534874b072cfc7_88692102($_smarty_tpl) {?><div class="navbar navbar-inverse navbar-bottom" role="navigation">
    <div class="container ">
        <h5>FOOTER</h5>
    </div>
</div><?php }} ?>
