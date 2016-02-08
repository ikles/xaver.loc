<?php /* Smarty version 2.6.25-dev, created on 2016-02-05 16:55:42
         compiled from header.tpl */ ?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE><?php echo $this->_tpl_vars['title']; ?>
 / <?php echo $this->_tpl_vars['var1']; ?>
</TITLE>
<script>
    function get_alert(){//Вместо левой фигурной скобки используется ldelim в скобках а правой rdelim
        alert('test');
        }
    //get_alert();
 </script>   
     <?php echo '
     <script>
    function get_alert2(){
        alert(\''; ?>
<?php echo $this->_tpl_vars['title']; ?>
<?php echo '\');//если нужно использовать что-то в скобках, то закрываем его и снова открываем после
        }
    //get_alert2();
 </script>      
    '; ?>

    

</HEAD>
<BODY bgcolor="#ffffff">