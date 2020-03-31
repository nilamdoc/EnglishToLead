<?php 
?>
<div class="row Mont szhalf text-align-center no-padding no-margin">
	<div class="col" <?php if($this->_request->controller=="Courses"){echo "style='font-weight:bold;background-color:#ccc'";}?>><a class="link external" href="/Courses/">Courses</a></div>
	<div class="col" <?php if($this->_request->controller=="Bonuses"){echo "style='font-weight:bold;background-color:#ccc'";}?>>Bonuses</div>
	<div class="col" <?php if($this->_request->controller=="Weeks"){echo "style='font-weight:bold;background-color:#ccc'";}?>>Weeks</div>
	<div class="col" <?php if($this->_request->controller=="Sections"){echo "style='font-weight:bold;background-color:#ccc'";}?>>Sections</div>
	<div class="col" <?php if($this->_request->controller=="Subjects"){echo "style='font-weight:bold;background-color:#ccc'";}?>>Subjects</div>
	<div class="col" <?php if($this->_request->controller=="Topics"){echo "style='font-weight:bold;background-color:#ccc'";}?>>Topics</div>
	<div class="col" <?php if($this->_request->controller=="Questions"){echo "style='font-weight:bold;background-color:#ccc'";}?>>Questions</div>
	<div class="col" <?php if($this->_request->controller=="Attachments"){echo "style='font-weight:bold;background-color:#ccc'";}?>><a class="link external" href="/Attachments/">Attachments</a></div>
</div>
