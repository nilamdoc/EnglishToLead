<div class="Roboto">
	<h1>Bonuses in <span class="Bebas"><?=$data[0]['course_name']?></span></h1>
	<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
	<div class="list no-hairlines-md elevation-10 padding">
		<input type="hidden" value="add" id="post" name="post">
		<input type="hidden" value="<?=$data[0]['_id']?>" id="course_id" name="course_id">
		<input type="hidden" value="" id="bonus_description" name="bonus_description">
  <ul>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Add a Bonus</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Bonus" id="bonus_name_add" name="bonus_name">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
				<li><span class="block"><small>Description</small></span>
				<div class="text-editor text-add-bonus text-editor-init" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"],["h1","h2","h3"],["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"],
  ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
						<div class="text-editor-content" contenteditable>
						</div>
				</div>
				</li>
				</ul>
				<div class="row">
					<div class="col"></div>
					<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised" onclick="return bonusDescription('.text-add-bonus');"></div>
					<div class="col"></div>
				</div>
	</div>
	</form>
	<hr>
	<h2>List of Bonuses in <span class="Bebas"><?=$data[0]['course_name']?></span></h2>
	<div class="list simple-list">
  <ul>
		<?php $i=1;foreach($data[1] as $d){?>
    <li><?=$i?>. <?=$d['bonus_name']?> 
					<span class="text-align-right row">
						<input type="hidden" value="<?=$d['bonus_description']?>" id="bonus_description_<?=$d['_id']?>" name="bonus_description_<?=$d['_id']?>" />
						
						<a href="#" class="button button-fill button-round button-small popup-open" data-popup=".popup-edit" onclick="bonusTitle('<?=$d['bonus_name']?>','<?=$d['_id']?>');">Edit</a>
						<span class="button button-fill button-round button-small color-red">
								<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
								<input type="hidden" value="delete" id="post" name="post">
								<input type="hidden" value="<?=$d['_id']?>" id="bonus_delete_id" name="week_delete_id">
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
						<input type="hidden" id="bonus_edit_id" name="bonus_edit_id">
						<input type="hidden" id="bonus_edit_description" name="bonus_edit_description">
						
						<div class="list no-hairlines-md">
							<ul>
									<li class="item-content item-input">
											<div class="item-inner">
													<div class="item-title item-label">Bonus Name</div>
													<div class="item-input-wrap">
															<input type="text" placeholder="Bonus Name" id="bonus_name" name="bonus_name" validate required>
															<span class="input-clear-button"></span>
													</div>
											</div>
									</li>
									<li>
											<div class="text-editor text-edit-bonus text-editor-init" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"],["h1","h2","h3"],["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"],
  ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
												<div class="text-editor-content" contenteditable></div>
											</div>
									</li>
								</ul>
							</div>
							<div class="row">
								<div class="col"></div>
								<div class="col"><input type="submit" value="Save" class="button button-fill button-outline button-raised button-round" onclick="return bonus_description('.text-edit-bonus');"> </div>
								<div class="col"></div>
							</div>
						
						</form>
    </div>
  </div>
	<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
</div>