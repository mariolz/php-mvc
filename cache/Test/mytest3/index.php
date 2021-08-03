<?php $test ='mytest3Action'; ?><?php $myname ='hello'; ?><?php $memners =array (
  'a' => 1,
  'b' => '2',
  'c' => 3,
); ?><html>
<head><?php echo $test?></head>
<body>
<div><?php echo $myname?></div>
<?php foreach($memners as $k=>$v) {?>
<div><?php echo $v?></div>
<?php  }?>
</body>
</html>