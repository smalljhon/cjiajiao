<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
 include $this->CompilerInclude("header.htm");
 ?>
<div class="container">
	<div class="row post-list">
		<div class="col-sm-12 col">
				<?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?> 
				<div class="post-667 post mb-20">
					<a class="pull-left img-div" href="javascript:void">
						<!--  <img src="<?php echo $fields['litpic']; ?>" style="margin-top: 0px;">-->
						<img src="http://mao10.qiniudn.com/201605181602324467.jpg" style="margin-top: 0px;">
					</a>
					<div class="post-right">
						<h2 class="title">
							<a class="wto" href="">
								<?php echo $fields['uname']; ?>-<?php echo $fields['school']; ?>	
							</a>
						</h2>
						<div class="author mb-10">
							<a><?php echo $fields['sex']; ?></a>-<span><?php echo $fields['city']; ?></span>
							<div class="clearfix"></div>
						</div>
						<div class="entry mb-10">
						<?php echo emptyConvert($fields['description']); ?>
						</div>
						<ul class="list-inline mb-0">
							<li><i class="glyphicon glyphicon-tag"></i> &nbsp;&nbsp;<a><?php echo $fields['school']; ?>-<?php echo $fields['nianji'];  echo $fields['zhuanye']; ?></a></li><br/><br/>
							<li><i class="glyphicon glyphicon-list-alt"></i> &nbsp;&nbsp;获奖经历：
							<?php echo emptyConvert($fields['prize_good']); ?>
							</li>
							<br/><br/>
							<!-- <li><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;<a>工作经验：<?php echo $fields['work_experience']; ?></a></li> -->
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php
}
}?>
		</div>
	</div>
</div>

<?php include $this->CompilerInclude("footer.html");
 ?>
</body>
</html>