function enableGenerateButton() {
	var button = document.getElementById('generate');
	
	button.disabled = false;
	button.style.background='#121258';
	button.style.color='#ffffff';
	button.style.cursor='pointer';
	
	this.setFileName(true);
}

function disableGenerateButton() {
	var button = document.getElementById('generate');
	
	button.disabled = true;
	button.style.background='#c0c0c0';
	button.style.color='#808080';
	button.style.cursor='no-drop';

	this.setFileName(false);
}

function change() {
	if(document.getElementById('file').value == '')
		disableGenerateButton();
	else
		enableGenerateButton();
}

function setFileName(fileExists) {
	var input = document.getElementById('file');
	var name = 'Selecionar arquivo';
		
	if(fileExists == true) {
		name = input.files[0].name;
	}
	
	document.getElementById('file-label').innerHTML = name;
	document.getElementById('file-label').style.border='4px solid #000000';
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
