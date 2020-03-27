	<div class="row">
	<div class="col">
		<h2 class="Mont">Attachment </h2>
		<div class="block block-strong">
			<p>
						Video
				<label class="radio">
					<input type="radio" name="attachment-radio" value="Video" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"/>
				</label> 	
						Audio
				<label class="radio">
					<input type="radio" name="attachment-radio" value="Audio" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"/>
				</label> 	
						Image
				<label class="radio">
					<input type="radio" name="attachment-radio" value="Image" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"/>
				</label> 	
						PDF
				<label class="radio">
					<input type="radio" name="attachment-radio" value="PDF" onclick="selectAttachment(this.value);"/>
					<i class="icon-radio"/>
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
							<input type="text" placeholder="Zsj98IdodkP" name="videoName" id="videoName" required validate onblur="showVideo(this.value);">
								<span class="input-clear-button"/>
							</div>
						</div>
					</li>
				</ul>
				<div>
					<iframe width="400" height="300" src="//www.youtube.com/embed/" frameborder="0" allowfullscreen id="showVideo"/>
				</div>
			</div>
			<div id="AudioAttach" style="display:none" class="list">
				<h3>Audio</h3>
				<ul>
					<li class="item-content item-input">
						<div class="item-inner">
							<div class="item-title item-label">Audio MP3 (full path)</div>
							<div class="item-input-wrap">
								<input type="text" placeholder="/audio/course/week/section/subject/audio.mp3" name="audioName" id="audioName" required validate onblur="showAudio(this.value);">
									<span class="input-clear-button"/>
								</div>
							</div>
						</li>
					</ul>
					<div>
						<audio controls autoplay>
							<source src="horse.mp3" type="audio/mpeg" id="showAudio">
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
										<input type="text" placeholder="/img/course/week/section/subject/image.jpg" name="imageName" id="imageName" required validate onblur="showImage(this.value);">
											<span class="input-clear-button"/>
										</div>
									</div>
								</li>
							</ul>
							<div>
								<img src="" height="200" width="300" id="showImage">
								</div>
							</div>
							<div id="PDFAttach" style="display:none" class="list">
								<h3>PDF</h3>
								<ul>
									<li class="item-content item-input">
										<div class="item-inner">
											<div class="item-title item-label">PDF (full path)</div>
											<div class="item-input-wrap">
												<input type="text" placeholder="/pdf/course/week/section/subject/PDF.pdf" name="pdfName" id="pdfName" required validate onblur="showPDF(this.value);">
													<span class="input-clear-button"/>
												</div>
											</div>
										</li>
									</ul>
									<div>
										<embed src="" width="300" height="200" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" id="showPDF">
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
														<?php foreach($courses as $c){?>
														<option value="<?=$c['course_name']?>"><?=$c['course_name']?>
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
										</ul>
									</div>
								</div>
							</div>