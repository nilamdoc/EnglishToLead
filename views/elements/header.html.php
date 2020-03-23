<?php 
?>
				<div class="row Mont sz1 text-align-center">
				  <div class="col" <?php if($this->_request->controller=="Courses"){echo "style='font-weight:bold;background-color:#ddd'";}?>><a class="link external" href="/Courses/">Courses</a></div>
						<div class="col" <?php if($this->_request->controller=="Bonuses"){echo "style='font-weight:bold;background-color:#ddd'";}?>>Bonuses</div>
				  <div class="col" <?php if($this->_request->controller=="Weeks"){echo "style='font-weight:bold;background-color:#ddd'";}?>>Weeks</div>
				  <div class="col" <?php if($this->_request->controller=="Sections"){echo "style='font-weight:bold;background-color:#ddd'";}?>>Sections</div>
      <div class="col" <?php if($this->_request->controller=="Subjects"){echo "style='font-weight:bold;background-color:#ddd'";}?>>Subjects</div>
      <div class="col" <?php if($this->_request->controller=="Questions"){echo "style='font-weight:bold;background-color:#ddd'";}?>>Questions</div>
    </div>
