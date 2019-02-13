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
	
	document.getElementById('filename').innerHTML = name;
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
