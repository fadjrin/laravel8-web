  

var loading;
var loadingSave;
var error;
var errorSave;
var grid;
var contentData;

function showLoading() {
	loading.show();
}

function hideLoading() {
	loading.hide();
}

function hideError(){
	error.hide();
}

function showError(){
	error.show();
}

function hideSave(){
	loadingSave.hide();
}

function showSave(){
	loadingSave.show();
}

function hideErrorSave(){
	errorSave.hide();
}

function showErrorSave(){
	errorSave.show();
}

$(document).ready(function(){
	loading = $('.loading-progress');
	loadingSave = $('.loading-save');
	error = $('.error-msg');
	errorSave = $('.error-save');
	hideLoading();
	hideSave();
	hideError();
	hideErrorSave();
	contentData = JSON.parse($('#contentData').val());
	var items = contentData;
    grid = GridStack.init({
    	float: true, 
    	resizable: {
		handles: 'e, se, s, sw, w'
		},
		acceptWidgets: '.newWidget'});
    grid.load(items);
    onReadEvent();
});



function onReadEvent() {

	$('body').on('click','#btnAddTemplate',function(){
		hideErrorSave();
		let value = $('#templateData').val();
		let path = $('#templateData').find(':selected').data('path');

		if (value != '') {
            $.ajax({
               url: getTemplate+'/'+path,
               type:'get',
               dataType:'json',
               beforeSend: function(){
		            showLoading();
               },
               success: function(data){
                   hideLoading();

                   if(data.status) {
                   	  grid.addWidget({x:0, y:0, w:6, h:3, content:data.data});
                   	}
               },
                error: function(jqXHR, exception) {
                  hideLoading();
                  showError();
                  var msgerror = '';
                  if (jqXHR.status === 0) {
                      msgerror = 'jaringan tidak terkoneksi.';
                  } else if (jqXHR.status == 404) {
                      msgerror = 'Halaman tidak ditemukan. [404]';
                  } else if (jqXHR.status == 500) {
                      msgerror = 'Internal Server Error [500].';
                  } else if (exception === 'parsererror') {
                      msgerror = 'Requested JSON parse gagal.';
                  } else if (exception === 'timeout') {
                      msgerror = 'RTO.';
                  } else if (exception === 'abort') {
                      msgerror = 'Gagal request ajax.';
                  } else {
                      msgerror = 'Error.\n' + jqXHR.responseText;
                  }
                  $('.list-inside').html(`<li>${msgerror}</li>`);  
                }
            });
		}

	});

	$('body').on('click','.cls-save', function(){
		hideErrorSave();
		serializedData = grid.save();

		if (serializedData.length > 0) {
            $.ajax({
               url: updateTemplate,
               data:{content:serializedData, page: 'dashboard'},
               type:'post',
               dataType:'json',
               beforeSend: function(){
		            showSave();
               },
               success: function(data){
                   hideSave();
                   console.log(data);

               },
                error: function(jqXHR, exception) {
                  hideSave();
                  showErrorSave();
                  var msgerror = '';
                  if (jqXHR.status === 0) {
                      msgerror = 'jaringan tidak terkoneksi.';
                  } else if (jqXHR.status == 404) {
                      msgerror = 'Halaman tidak ditemukan. [404]';
                  } else if (jqXHR.status == 500) {
                      msgerror = 'Internal Server Error [500].';
                  } else if (exception === 'parsererror') {
                      msgerror = 'Requested JSON parse gagal.';
                  } else if (exception === 'timeout') {
                      msgerror = 'RTO.';
                  } else if (exception === 'abort') {
                      msgerror = 'Gagal request ajax.';
                  } else {
                      msgerror = 'Error.\n' + jqXHR.responseText;
                  }
                  $('.llist-inside0-save').html(`<li>${msgerror}</li>`);  
                }
            });			
		}else {
			showErrorSave();
			$('.llist-inside0-save').html('<li>Please Add Card first</li>');  
		}
		console.log(JSON.stringify(serializedData, null, '  '));
	})
}
