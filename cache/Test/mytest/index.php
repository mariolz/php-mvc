<?php $test ='ssss'; ?><?php $myname ='hhh'; ?><?php $memners =array (
  0 => 1,
  1 => 2,
  2 => 3,
); ?><html>
<head><?php echo $test?></head>
<body>
<div><?php echo $myname?></div>
<?php foreach($memners as $k=>$v) {?>
<div><?php echo $v?></div>
<?php  }?>
</body>
</html>