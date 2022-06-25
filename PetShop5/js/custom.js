//modal excluir
$(document).ready(function(){ //ele sempre vai executar esta função quando a página vou acionada
	$('a[data-confirm]').click(function(ev){ ///e quando clicar no botão deletar 
		var href = $(this).attr('href'); //aqui armazena o id que o botão está enviando
		if(!$('#confirm-delete').length){//aqui verifico se o botão foi acionado  em seguida o campo onde vai aparecer a janela modal
			$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
		}
		$('#dataComfirmOK').attr('href', href);
        $('#confirm-delete').modal({show: true}); //aqui indico que vou estar utilizando a janela modal confirm-delete
		return false;
		
	});
});