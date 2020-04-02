<h1>Outline</h1>
<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
<input type="hidden" value="" id="outline_description" name="outline_description">
<div class="list no-hairlines-md elevation-10 padding">
  <ul>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Order</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="1" id="outline_order" name="outline_order">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
		
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Name</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Item Name" id="outline_name" name="outline_name">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Title</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Title Name" id="outline_text" name="outline_text">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>				
				<li><span class="block"><small>Description</small></span>
				<div class="text-editor text-add-outline text-editor-init text-editor-resizable" data-placeholder="Enter text..." data-buttons='[["bold", "italic", "underline", "strikeThrough"], ["h1","h2","h3"], ["alignLeft","alignRight","alignCenter","alignJustify"], ["subscript", "superscript"], ["indent", "outdent"], ["orderedList", "unorderedList"]]'>
						<div class="text-editor-content" contenteditable></div>
				</div>
				</li>
				<h3>Under</h3>
				<li>
					<select name="outline_refer" id="outline_refer">
						<?php foreach($data as $d){?>
								<option value="<?=$d['_id']?>"><?php foreach($d['ancestors_names'] as $da){
										echo $da . " - ";
								} ?> <?=$d['outline_name']?></option>
						
						<?php }?>
					</select>
				</li>
				</ul>
				<input type="hidden" value="add" id="post" name="post">
				<div class="row">
					<div class="col"></div>
										<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised" onclick="return outlineDescription('.text-add-outline');"></div>
					<div class="col"></div>
				</div>
	</div>
	
</form>
