<div class="Roboto">
	<h1>Courses</h1>
	<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
	<div class="list no-hairlines-md elevation-10 padding">
  <ul>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Add a Course</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Course" id="course_name_add" name="course_name">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
				</ul>
				<input type="hidden" value="add" id="post" name="post">
				<div class="row">
					<div class="col"></div>
					<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised"></div>
					<div class="col"></div>
				</div>
	</div>
	</form>
	<hr>
	<h3>List of Courses</h3>
	<div class="list simple-list">
  <ul>
		<?php $i=1;foreach($data as $d){?>
    <li><?=$i?>. <?=$d['course_name']?> 
					<span class="text-align-right row">
						<a href="/Bonuses/index/<?=$d['_id']?>" class="link external color-green button button-fill button-round button-small">Bonuses</u></a>
						<a href="/Weeks/index/<?=$d['_id']?>" class="link external color-black button button-fill button-round button-small">Weeks</u></a>
						<a href="#" class="button button-fill button-round button-small popup-open" data-popup=".popup-edit" onclick="courseTitle('<?=$d['course_name']?>','<?=$d['_id']?>');">Edit</a>
						<span class="button button-fill button-round button-small color-red">
								<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
								<input type="hidden" value="delete" id="post" name="post">
								<input type="hidden" value="<?=$d['_id']?>" id="course_delete_id" name="course_delete_id">
								<input type="submit" value="Delete" class="button text-align-right color-red"> 
								</form>
						</span>
					</span>
				</li>
  <?php $i++;}?>
  </ul>
	</div>
		<div class="popup popup-edit">
    <div class="block">
      <p class="Bebas sz1">Edit
						<span class="text-align-right"><a class="link popup-close " href="#"><i class="icon f7-icons color-red">xmark_square_fill</i></a></span>
						</p>
      <h1 class="no-margin no-padding Rale sz2" id="courseTitle"></h1>
      <?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
						<input type="hidden" value="edit" id="post" name="post">
						<input type="hidden" id="course_edit_id" name="course_edit_id">
						
						<div class="list no-hairlines-md">
							<ul>
									<li class="item-content item-input">
											<div class="item-inner">
													<div class="item-title item-label">Course Name</div>
													<div class="item-input-wrap">
															<input type="text" placeholder="Course Name" id="course_name" name="course_name" validate required>
															<span class="input-clear-button"></span>
													</div>
											</div>
									</li>
								</ul>
							</div>
							<div class="row">
								<div class="col"></div>
								<div class="col"><input type="submit" value="Save" class="button button-fill button-outline button-raised button-round"> </div>
								<div class="col"></div>
						</div>
						</form>
    </div>
  </div>
</div>