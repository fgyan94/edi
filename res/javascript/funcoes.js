function enableGenerateButton() {
	var button = document.getElementById('generate');
	
	button.disabled = false;
	button.style.background='#121258';
	button.style.color='#ffffff';
	button.style.cursor='pointer';
	
	setFileName(true);
}

function disableGenerateButton() {
	var button = document.getElementById('generate');
	
	button.disabled = true;
	button.style.background='#c0c0c0';
	button.style.color='#808080';
	button.style.cursor='no-drop';

	setFileName();
}

function change() {
	if(document.getElementById('file').value == '')
		disableGenerateButton();
	else
		enableGenerateButton();
}

function setFileName(fileExists = false) {
	var input = document.getElementById('file');
	var name = 'Drag your file here or click in this area';
	
	if(fileExists == true)
		name = input.files[0].name;
	
	document.getElementById('file-label').innerHTML = name;
}

function dragOver() {
	var drag = document.getElementById('file-label');
	var form = document.getElementById('form-file');
	
	drag.style.color='#8ccaff';
	form.style.border='4px dashed #8ccaff';
	
}

function dragLeave() {
	var drag = document.getElementById('file-label');
	var form = document.getElementById('form-file');
	
	drag.style.color='#121258';
	form.style.border='4px dashed #121258';
}


//function hoverButton() {
//	var button = document.getElementById('generate');
//	
//	if(button.disabled == false) {
//		button.style.background='#b0c4de';
//		button.style.color='#121258';
//		button.style.cursor='pointer';
//		button.style.borderBottom='4px solid #121258';
//	}
//}
