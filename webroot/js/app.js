var $$ = Dom7;

var app = new Framework7({
		root: '#app',
  smartSelect: {
   pageTitle: 'Select Option',
   openIn: 'popup',
  },
  input: {
   scrollIntoViewOnFocus: true,
   scrollIntoViewCentered: true,
  },
		textEditor:{
			buttons: ['bold', 'italic'],
		},
  swiper: {
   initialSlide: 0,
   spaceBetween: 10,
   speed: 300,
   loop: false,
   preloadImages: true,
   zoom: {
    enabled: true,
    maxRatio: 3,
    minRatio: 1,
   },
   lazy: {
    enabled: true,
   },
  },
  photoBrowser: {
   type: 'popup',
  },
  touch: {
   materialRipple: false,
   tapHold: true,
   disableContextMenu: true,
   activeState: false,
   fastClicks: true,
  },
  pushState: false,
  toast: {
   closeTimeout: 3000,
   closeButton: true,
  },
  
  calendar: {
   url: 'calendar/',
   dateFormat: 'dd/mm/yyyy',
  },
  lazy: {
   threshold: 50,
   sequential: false,
  },
});

var mainView = app.views.create('.view-main');

function courseTitle(title,_id){
	$$("#courseTitle").html(title);
	$$("#course_name").val(title);
	$$("#course_edit_id").val(_id);
}

function weekTitle(title,_id){
	$$("#weekTitle").html(title);
	$$("#week_name").val(title);
	$$("#week_edit_id").val(_id);
	var week_description = $$("#week_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-week");
	textEditor.setValue(week_description);
}
function week_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#week_edit_description").val(textEditor.getValue());
}
function weekDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#week_description").val(textEditor.getValue());
}

function bonusTitle(title,_id){
	$$("#bonusTitle").html(title);
	$$("#bonus_name").val(title);
	$$("#bonus_edit_id").val(_id);
	var bonus_description = $$("#bonus_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-bonus");
	textEditor.setValue(bonus_description);
}

function bonusDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#bonus_description").val(textEditor.getValue());
}
function bonus_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#bonus_edit_description").val(textEditor.getValue());
}


function sectionTitle(title,_id){
	$$("#sectionTitle").html(title);
	$$("#section_name").val(title);
	$$("#section_edit_id").val(_id);
	var section_description = $$("#section_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-section");
	textEditor.setValue(section_description);
}
function sectionDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#section_description").val(textEditor.getValue());
}
function section_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#section_edit_description").val(textEditor.getValue());
}

function subjectTitle(title,_id){
	$$("#subjectTitle").html(title);
	$$("#subject_name").val(title);
	$$("#subject_edit_id").val(_id);
	var subject_description = $$("#subject_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-subject");
	textEditor.setValue(subject_description);
}
function subjectDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#subject_description").val(textEditor.getValue());
}
function subject_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#subject_edit_description").val(textEditor.getValue());
}

function showDivQuestion(){
	console.log("a");
	app.popup.close();
	var smartSelect = app.smartSelect.get('.smart-select');
	var questionType = smartSelect.getValue()
	console.log(questionType);
}

function  selectAttachment(value){
	
	$$("#AudioAttach").hide();
	$$("#VideoAttach").hide();
	$$("#ImageAttach").hide();
	$$("#PDFAttach").hide();
	switch(value) {
  case "Audio":
    // code block
				$$("#AudioAttach").show();
    break;
  case "Video":
    // code block
				$$("#VideoAttach").show();
    break;
  case "Image":
    // code block
				$$("#ImageAttach").show();
    break;
  case "PDF":
    // code block
				$$("#PDFAttach").show();
    break;
    default:
    // code block
	} 
	
}

function showAudio(value){
	$$("#showAudio").attr("src",value);
}
function showImage(value){
	$$("#showImage").attr("src",value);
}
function showVideo(value){
	$$("#showVideo").attr("src","//www.youtube.com/embed/"+value);
}
function showPDF(value){
	$$("#showPDF").attr("src",value);
}
// //www.youtube.com/embed/GlIzuTQGgzs
///////////////////////////////////////////////////////////////////
function changeTrueFalse(){
	var trueFalse = $$('input[name=trueFalse]:checked').val();
	console.log(trueFalse);
}

function getWeeks(_id){
	console.log(_id);
	
}

