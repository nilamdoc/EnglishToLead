<div class="row">
<div class="col-40">
	<h1><a href="/outline/" class="link external">Outline</a></h1>
	<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
	<input type="hidden"  id="outline_description" name="outline_description" value="<?=$outline['outline_description']?>">
	<?php if(count($outline)>0){?>
	<input type="hidden" value="edit" id="post" name="post">
	<input type="hidden" value="<?=$outline['_id']?>" id="_id" name="_id">	
	<?php }else{?>
	<input type="hidden" value="add" id="post" name="post">
	<?php }?>
	<div class="list no-hairlines-md elevation-10 padding">
			<ul>
					<li class="item-content item-input">
							<div class="item-inner Rale ">
									<div class="item-title item-label sz1">Order</div>
									<div class="item-input-wrap sz1">
											<input type="text" placeholder="1" id="outline_order" name="outline_order" value="<?=$outline['outline_order']?>">
											<span class="input-clear-button"></span>
									</div>
							</div>
					</li>
					<li class="item-content item-input">
							<div class="item-inner Rale ">
									<div class="item-title item-label sz1">Name</div>
									<div class="item-input-wrap sz1">
											<input type="text" placeholder="Item Name" id="outline_name" name="outline_name"  value="<?=$outline['outline_name']?>">
											<span class="input-clear-button"></span>
									</div>
							</div>
					</li>
					<li class="item-content item-input">
							<div class="item-inner Rale ">
									<div class="item-title item-label sz1">Title</div>
									<div class="item-input-wrap sz1">
											<input type="text" placeholder="Title Name" id="outline_text" name="outline_text" value="<?=$outline['outline_text']?>">
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
						<select name="outline_refer" id="outline_refer" <?php if(count($outline)>0){?> disabled <?php }?>>
							<?php foreach($data as $d){?>
									<option value="<?=$d['_id']?>" <?php if($d['_id']==$outline['outline_refer_id']){echo " selected ";}?>><?php foreach($d['ancestors_names'] as $da){
											echo $da . " - ";
									} ?> <?=$d['outline_name']?></option>
							<?php }?>
						</select>
					</li>
					</ul>
					
					<div class="row">
						<div class="col"></div>
											<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised" onclick="return outlineDescription('.text-add-outline');"></div>
						<div class="col"></div>
					</div>
		</div>
	</form>
	</div>
	<div class="col-60 elevation-10 page-content padding">
	<div class="list simple-list "><small><h2>All Outlines</h2>
  <ul class="no-pasdding no-margin">
			<?php foreach($data as $d){?>
				<li  class="no-pasdding no-margin">
				<div class="item-title"> <?php echo count($d['ancestors_names']);?>
				<a href="/outline/index/<?=$d['_id']?>" class="link external">
				
				<?php foreach($d['ancestors_names'] as $da){
						echo $da . " &rarr; ";
				} ?>&nbsp;<strong><?=$d['outline_name']?></strong></a> 
				
			<?php if($d['outline_text']!=""){?>&trade;<?php }?>
			<?php if($d['outline_description']!=""){?>&hellip;<?php }?>
				</div>
				<!--<div class="item-after">
				<a href="/outline/delete/<?=$d['_id']?>" class="link external">
				<i class="icon f7-icons color-red">xmark</i>
				</a>
				</div> -->
				
				</li>
			<?php }?>
  </ul>
		</small>
</div>
	</div>
</div>