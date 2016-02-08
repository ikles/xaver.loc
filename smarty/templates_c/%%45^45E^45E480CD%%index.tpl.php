<?php /* Smarty version 2.6.25-dev, created on 2016-02-05 17:57:28
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'index.tpl', 4, false),array('modifier', 'date_format', 'index.tpl', 26, false),array('function', 'html_options', 'index.tpl', 40, false),array('function', 'html_table', 'index.tpl', 43, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header_template']).".tpl", 'smarty_include_vars' => array('var1' => '2016')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php $this->assign('time', '555'); ?>Привет <?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'горь', 'ра') : smarty_modifier_replace($_tmp, 'горь', 'ра')); ?>
, как дела
<br>
<?php if ($this->_tpl_vars['name'] == 'Игорь'): ?>    Мое имя Игорь
    <?php else: ?>
        Мое имя не Игорь
        <?php endif; ?>

<br>Время <?php echo $this->_tpl_vars['time']; ?>

<br>
Server name: <?php echo $_SERVER['SERVER_NAME']; ?>
 <br>
<?php if (( isset ( $_GET['id'] ) )): ?>
Get: <?php echo $_GET['id']; ?>
 <?php else: ?>
not get
<?php endif; ?>
<br>
Name: <?php echo $this->_tpl_vars['names']['first']; ?>
, <?php echo $this->_tpl_vars['names'][1]; ?>
 <br>
Phone home: <?php echo $this->_tpl_vars['Contacts']['phone']['home']; ?>

<br>
<?php echo ((is_array($_tmp=$this->_tpl_vars['raz'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d") : smarty_modifier_date_format($_tmp, "%Y.%m.%d")); ?>
<br>
<ul>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myId'] => $this->_tpl_vars['i']):
?><li><a href="item.php?id=<?php echo $this->_tpl_vars['myId']; ?>
"><?php echo $this->_tpl_vars['i']['no']; ?>
: <?php echo $this->_tpl_vars['i']['label']; ?>
</a></li><?php endforeach; endif; unset($_from); ?>
</ul>
<br>
<?php 
//Вывод обычного php кода
//global $not_smarty;//обязательно объявить ее глобавльной
//echo $not_smarty;
 ?>
<br>
<?php echo smarty_function_html_options(array('name' => 'customer_id','options' => $this->_tpl_vars['cust_options'],'selected' => $this->_tpl_vars['customer_id']), $this);?>

<br>
<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data']), $this);?>

<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data'],'cols' => 4,'table_attr' => 'border="0"'), $this);?>

<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data'],'cols' => "first,second,third,fourth",'tr_attr' => $this->_tpl_vars['tr']), $this);?>


<br>
<br>
<br>
<br>
<br>
<br>






<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>











