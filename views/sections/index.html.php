<div class="Roboto">
	<h1>Sections in <span class="Bebas"><span class="szhalf"><?=$data[2]['course_name']?></span> - <span class="sz1"><?=$data[0]['week_name']?></span> </span></h1>
	<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
	<div class="list no-hairlines-md elevation-10 padding">
		<input type="hidden" value="add" id="post" name="post">
		<input type="hidden" value="<?=$data[0]['_id']?>" id="week_id" name="week_id">
		<input type="hidden" value="" id="section_description" name="section_description">
  <ul>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Add a Section</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Section" id="section_name_add" name="section_name">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
				<li><span class="block"><small>Description</small></span>
				<div class="text-editor text-editor-resizable text-add-section text-editor-init" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"],["h1","h2","h3"],["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"],
  ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
						<div class="text-editor-content" contenteditable>
						</div>
				</div>
				</li>
				</ul>
				<div class="row">
					<div class="col"></div>
					<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised" onclick="return sectionDescription('.text-add-section');"></div>
					<div class="col"></div>
				</div>
	</div>
	</form>
	<hr>
	<h2>List of Sections in <span class="Bebas"><?=$data[0]['week_name']?></span></h2>
	<div class="list simple-list">
  <ul>
		<?php $i=1;foreach($data[1] as $d){?>
    <li><?=$i?>. <?=$d['section_name']?> 
					<span class="text-align-right row">
						<input type="hidden" value="<?=$d['section_description']?>" id="section_description_<?=$d['_id']?>" name="section_description_<?=$d['_id']?>" />
						<a href="/subjects/index/<?=$d['_id']?>" class="link external color-green button button-fill button-round button-small">Subjects</u></a>
						<a href="#" class="button button-fill button-round button-small popup-open" data-popup=".popup-edit" onclick="sectionTitle('<?=$d['section_name']?>','<?=$d['_id']?>');">Edit</a>
						<span class="button button-fill button-round button-small color-red">
								<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
								<input type="hidden" value="delete" id="post" name="post">
								<input type="hidden" value="<?=$d['_id']?>" id="section_delete_id" name="section_delete_id">
								<input type="submit" value="Delete" class="button text-align-right color-red"> 
								</form>
						
						</span>
					</span>
				</li>
  <?php $i++;}?>
  </ul>
	</div>

		<div class="popup popup-edit">
    <div class="block page-content">
      <p class="Bebas sz1">Edit
						<span class="text-align-right"><a class="link popup-close " href="#"><i class="icon f7-icons color-red">xmark_square_fill</i></a></span>
						</p>
      <h1 class="no-margin no-padding Rale sz2" id="weekTitle"></h1>
      <?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
						<input type="hidden" value="edit" id="post" name="post">
						<input type="hidden" id="section_edit_id" name="section_edit_id">
						<input type="hidden" id="section_edit_description" name="section_edit_description">
						
						<div class="list no-hairlines-md">
							<ul>
									<li class="item-content item-input">
											<div class="item-inner">
													<div class="item-title item-label">Section Name</div>
													<div class="item-input-wrap">
															<input type="text" placeholder="Section Name" id="section_name" name="section_name" validate required>
															<span class="input-clear-button"></span>
													</div>
											</div>
									</li>
									<li>
											<div class="text-editor text-editor-resizable text-edit-section text-editor-init" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"],["h1","h2","h3"],["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"],
  ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
												<div class="text-editor-content" contenteditable></div>
											</div>
									</li>
								</ul>
							</div>
							<div class="row">
								<div class="col"></div>
								<div class="col"><input type="submit" value="Save" class="button button-fill button-outline button-raised button-round" onclick="return section_description('.text-edit-section');"> </div>
								<div class="col"></div>
							</div>
						
						</form>
    </div>
  </div>
	<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
</div>