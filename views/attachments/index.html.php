	<div class="row">
	<div class="col">
		<h2 class="Mont">Attachment </h2>
		<div class="block block-strong">
			<p>
						Video
				<label class="radio">
					<input type="radio" name="attachment-radio" value="Video" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"></i>
				</label> 	
						Audio
				<label class="radio">
					<input type="radio" name="attachment-radio" value="Audio" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"></i>
				</label> 	
						Image
				<label class="radio">
					<input type="radio" name="attachment-radio" value="Image" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"></i>
				</label> 	
						PDF
				<label class="radio">
					<input type="radio" name="attachment-radio" value="PDF" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"></i>
				</label> 	
			</p>			
		</div>
		<div id="VideoAttach" style="display:none" class="list">
			<h3>Video</h3>
			<ul>
				<li class="item-content item-input">
					<div class="item-inner">
						<div class="item-title item-label">YouTube video (Only Name)</div>
						<div class="item-input-wrap">
							<input type="text" placeholder="Zsj98IdodkP" name="videoName" id="videoName" required validate onblur="showVideo(this.value);"/>
							<span class="input-clear-button"/>
						</div>
					</div>
				</li>
			</ul>
			<div>
				<iframe width="400" height="300" src="//www.youtube.com/embed/6Sok3yLzkqo" frameborder="0" allowfullscreen id="showVideo">
				</iframe>
			</div>
		</div>
		<div id="AudioAttach" style="display:none" class="list">
			<h3>Audio</h3>
			<ul>
				<li class="item-content item-input">
					<div class="item-inner">
						<div class="item-title item-label">Audio MP3 (full path)</div>
						<div class="item-input-wrap">
							<input type="text" placeholder="/audio/course/week/section/subject/audio.mp3" name="audioName" id="audioName" required validate onblur="showAudio(this.value);"/>
							<span class="input-clear-button"/>
						</div>
					</div>
				</li>
			</ul>
			<div>
				<audio controls autoplay>
					<source src="horse.mp3" type="audio/mpeg" id="showAudio" />
													Your browser does not support the audio element.
				</audio>
			</div>
		</div>
		<div id="ImageAttach" style="display:none" class="list">
			<h3>Image</h3>
			<ul>
				<li class="item-content item-input">
					<div class="item-inner">
						<div class="item-title item-label">Image JPG/PNG (full path)</div>
						<div class="item-input-wrap">
							<input type="text" placeholder="/img/course/week/section/subject/image.jpg" name="imageName" id="imageName" required validate onblur="showImage(this.value);" />
							<span class="input-clear-button"/>
						</div>
					</div>
				</li>
			</ul>
			<div>
				<img src="" height="200" width="300" id="showImage" />
			</div>
		</div>
		<div id="PDFAttach" style="display:none" class="list">
			<h3>PDF</h3>
			<ul>
				<li class="item-content item-input">
					<div class="item-inner">
						<div class="item-title item-label">PDF (full path)</div>
						<div class="item-input-wrap">
							<input type="text" placeholder="/pdf/course/week/section/subject/PDF.pdf" name="pdfName" id="pdfName" required validate onblur="showPDF(this.value);" />
							<span class="input-clear-button"/>
						</div>
					</div>
				</li>
			</ul>
			<div>
				<embed src="" width="300" height="200" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" id="showPDF" />
			</div>
		</div>
	</div>
	<div class="col">
		<h2 class="Mont">Attach with </h2>
		<div class="list">
			<ul>
				<li>
					<a class="item-link smart-select smart-select-init">
						<select name="courseName" id="courseName" onchange="getWeeks(this.value);">
							<option value="">-- Select --</option>
							<?php foreach($courses as $c){?>
							<option value="<?=$c['_id']?>"><?=$c['course_name']?>
							</option>
							<?php }?>
						</select>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">Course</div>
							</div>
						</div>
					</a>
				</li>
				<li>
					<a class="item-link smart-select smart-select-init">
						<select name="weekName" id="weekName" onchange="getSections(this.value);">
						</select>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">Week</div>
							</div>
						</div>
					</a>
				</li>				
				<li>
					<a class="item-link smart-select smart-select-init">
						<select name="sectionName" id="sectionName" onchange="getSubjects(this.value);">
						</select>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">Sections</div>
							</div>
						</div>
					</a>
				</li>
				<li>
					<a class="item-link smart-select smart-select-init">
						<select name="subjectName" id="subjectName" >
						</select>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">Subjects</div>
							</div>
						</div>
					</a>
				</li>
				</ul>
		</div>
	</div>
	<a href="#" class="button button-fill button-round" onclick="saveAttachment();">Save</a>
</div>
<hr>
<?php foreach($attachments as $a){?>
<div class="row flex-direction-row-reverse">
	<div class="col"><?=$a['attach']?></div>
	<div class="col"><?=$a['attachment']?></div>
	<div class="col"><?=$a['course_name']?></div>
	<div class="col"><?=$a['week_name']?></div>
	<div class="col"><?=$a['section_name']?></div>
	<div class="col"><?=$a['subject_name']?></div>
	<div class="col">
		<a href="#" class="button button-fill button-round button-small popup-open" data-popup=".popup-edit" onclick="attachmentTitle('<?=$a['_id']?>');">Edit</a>
 						<span class="button button-fill button-round button-small color-red">
								<?=$this->form->create('',array('url'=>'#', 'enctype'=>"multipart/form-data")); ?>
								<input type="hidden" value="delete" id="post" name="post">
								<input type="hidden" value="<?=$a['_id']?>" id="attach_delete_id" name="attach_delete_id">
								<input type="submit" value="Delete" class="button text-align-right color-red"> 
								</form>
						</span>
						</div>
</div>
<?php }?>