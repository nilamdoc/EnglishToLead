<div class="Roboto ">
<h1>Questions</h1>

<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
<div class="list no-hairlines-md elevation-10 padding">

  <ul>
    <li class="item-content item-input">
      <div class="item-inner Rale ">
        <div class="item-title item-label sz1">Add a Question</div>
        <div class="item-input-wrap sz1">
          <input type="text" placeholder="Question" id="question_name" name="question_name">
          <span class="input-clear-button"></span>
        </div>
      </div>
    </li>
				<li class="item-content item-input">
				<div class="item-inner Rale ">
				<div class="item-title item-label sz1">Description</div>
					<textarea id="question_description" name="question_description" style="border:1px solid gray" class="padding"></textarea>
					</div>
				</li>
				<li>
				 <a class="item-link smart-select smart-select-init">
    <select name="questionType" id="questionType" onchange="showDivQuestion();">
     <?php foreach($data[2] as $d ){?>
						<option value="<?=$d['Name'];?>"><?=$d['Type'];?></option>
					<?php } ?>
    </select>
    <div class="item-content">
      <div class="item-inner">
        <div class="item-title">Question Type</div>
      </div>
    </div>
				</a>

				</li>
				<input type="hidden" value="add" id="post" name="post">
				<input type="hidden" value="<?=$data[0]['_id']?>" id="subject_id" name="subject_id">
				<div class="row">
					<div class="col"></div>
					<div class="col"><input type="submit" value="Save" class=" button button-outline button-round button-raised"></div>
					<div class="col"></div>
				</div>
				</ul>
</div>
</form>
<hr>

<h3>List of Questions for Subject: <span  class="sz2 Bebas"><?php print_r($data[0]['subject_name'])?></span></h3>
<div class="list media-list">
  <ul><hr>
			<?php $i=1;foreach($data[1] as $d){?>
    <li>
				<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
						<input type="hidden" value="edit" id="post" name="post">
						<input type="hidden" value="<?=$d['_id']?>" id="_id" name="_id">

						<span href="#" class="item-link item-content">
        <div class="item-inner">
          <div class="item-title-row">
            <div class="item-title Rale sz3"><?php print_r($data[0]['subject_name'])?></div>
            <div class="item-after">
												
												<input type="submit" value="Save" class="button text-align-right">
												</div>
          </div>
          <div class="item-subtitle"><?=$i?>. <input width="100%" type="text" placeholder="Question" id="question_name" name="question_name" value="<?=$d['question_name']?>" class="padding"> </div>
          <div class="item-text"><textarea id="question_description" name="question_description" style="border:1px solid gray" class="padding"><?=$d['question_description']?></textarea></div>
        </div>
      </span>
						</form>
							<div class="padding szhalf">
												<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
													<input type="hidden" value="delete" id="post" name="post">
													<input type="hidden" value="<?=$d['_id']?>" id="_id" name="_id">
													<input type="submit" value="X" class="button text-align-right color-red"> 
												</form>
							</div>
    </li><hr>
			<?php $i++;}?>
		</ul>
</div>
</div>