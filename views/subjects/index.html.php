<div class="Roboto">
	<h1>Subjects in <span class="Bebas"><span class="szhalf"><?=$data[0]['section_name']?></span> - <span class="szhalf"><?=$data[2]['week_name']?></span> - <span class="szhalf"><?=$data[3]['course_name']?></span></span></h1>
	<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
	<div class="list no-hairlines-md elevation-10 padding">
		<input type="hidden" value="add" id="post" name="post">
		<input type="hidden" value="<?=$data[0]['_id']?>" id="section_id" name="section_id">
		<input type="hidden" value="" id="subject_description" name="subject_description">
  <ul>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Add a Subject</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Subject" id="subject_name_add" name="subject_name">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
				<li><span class="block"><small>Description</small></span>
				<div class="text-editor text-add-subject text-editor-init" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"],["h1","h2","h3"],["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"],
  ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
						<div class="text-editor-content" contenteditable>
						</div>
				</div>
				</li>
				</ul>
				<div class="row">
					<div class="col"></div>
					<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised" onclick="return subjectDescription('.text-add-subject');"></div>
					<div class="col"></div>
				</div>
	</div>
	</form>
	<hr>
	<h2>List of Subjectss in <span class="Bebas"><?=$data[0]['section_name']?></span></h2>
	<div class="list simple-list">
  <ul>
		<?php $i=1;foreach($data[1] as $d){?>
    <li><?=$i?>. <?=$d['subject_name']?> 
					<span class="text-align-right row">
						<input type="hidden" value="<?=$d['subject_description']?>" id="subject_description_<?=$d['_id']?>" name="subject_description_<?=$d['_id']?>" />
						<a href="/questions/index/<?=$d['_id']?>" class="link external color-green button button-fill button-round button-small">Questions</u></a>
						<a href="#" class="button button-fill button-round button-small popup-open" data-popup=".popup-edit" onclick="subjectTitle('<?=$d['subject_name']?>','<?=$d['_id']?>');">Edit</a>
						<span class="button button-fill button-round button-small color-red">
								<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
								<input type="hidden" value="delete" id="post" name="post">
								<input type="hidden" value="<?=$d['_id']?>" id="subject_delete_id" name="subject_delete_id">
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
      <h1 class="no-margin no-padding Rale sz2" id="sectionTitle"></h1>
      <?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
						<input type="hidden" value="edit" id="post" name="post">
						<input type="hidden" id="subject_edit_id" name="subject_edit_id">
						<input type="hidden" id="subject_edit_description" name="subject_edit_description">
						
						<div class="list no-hairlines-md">
							<ul>
									<li class="item-content item-input">
											<div class="item-inner">
													<div class="item-title item-label">Subject Name</div>
													<div class="item-input-wrap">
															<input type="text" placeholder="Subject Name" id="subject_name" name="subject_name" validate required>
															<span class="input-clear-button"></span>
													</div>
											</div>
									</li>
									<li>
											<div class="text-editor text-edit-subject text-editor-init" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"],["h1","h2","h3"],["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"],
  ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
												<div class="text-editor-content" contenteditable></div>
											</div>
									</li>
								</ul>
							</div>
							<div class="row">
								<div class="col"></div>
								<div class="col"><input type="submit" value="Save" class="button button-fill button-outline button-raised button-round" onclick="return subject_description('.text-edit-subject');"> </div>
								<div class="col"></div>
							</div>
						
						</form>
    </div>
  </div>
	<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
</div>