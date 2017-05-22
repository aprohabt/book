<div style=" 
	position: absolute;
    right: 10px;
    top: 65px;">
<?php
if(isset($warning) && $warning!='' && $warning!=false){
?>
<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning! </strong><div><?=$warning?></div>
</div>
<?php 
}
if(isset($success)&& $success!='' && $success!=false){
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Success! </strong><div><?=$success?></div>
</div>
<?php 
}
if(isset($danger)&& $danger!='' && $danger!=false){
?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Danger! </strong><div><?=$danger?></div>
</div>
<?php 
}
if(isset($info)&& $info!='' && $info!=false){
?>
<div class="alert alert-info alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Notice : </strong><div><?=$info?></div>
</div>
<?php 
}
?>
</div>
