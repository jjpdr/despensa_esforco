<?php
	$this->assign('title','Despesnsa Esforço v3.0  | CompraAutomaticas');
	$this->assign('nav','compraautomaticas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/compraautomaticas.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> CompraAutomaticas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="compraAutomaticaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NomeSupermercado">Nome Supermercado<% if (page.orderBy == 'NomeSupermercado') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Categoria">Categoria<% if (page.orderBy == 'Categoria') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Prioridade">Prioridade<% if (page.orderBy == 'Prioridade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_ValorMaximo">Valor Maximo<% if (page.orderBy == 'ValorMaximo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_MetodoPagamento">Metodo Pagamento<% if (page.orderBy == 'MetodoPagamento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_EnderecoEntrega">Endereco Entrega<% if (page.orderBy == 'EnderecoEntrega') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('nomeSupermercado') || '') %></td>
				<td><%= _.escape(item.get('categoria') || '') %></td>
				<td><%= _.escape(item.get('prioridade') || '') %></td>
				<td><%= _.escape(item.get('valorMaximo') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('metodoPagamento') || '') %></td>
				<td><%= _.escape(item.get('enderecoEntrega') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="compraAutomaticaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeSupermercadoInputContainer" class="control-group">
					<label class="control-label" for="nomeSupermercado">Nome Supermercado</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nomeSupermercado" placeholder="Nome Supermercado" value="<%= _.escape(item.get('nomeSupermercado') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="categoriaInputContainer" class="control-group">
					<label class="control-label" for="categoria">Categoria</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="categoria" placeholder="Categoria" value="<%= _.escape(item.get('categoria') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="prioridadeInputContainer" class="control-group">
					<label class="control-label" for="prioridade">Prioridade</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="prioridade" placeholder="Prioridade" value="<%= _.escape(item.get('prioridade') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="valorMaximoInputContainer" class="control-group">
					<label class="control-label" for="valorMaximo">Valor Maximo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="valorMaximo" placeholder="Valor Maximo" value="<%= _.escape(item.get('valorMaximo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="metodoPagamentoInputContainer" class="control-group">
					<label class="control-label" for="metodoPagamento">Metodo Pagamento</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="metodoPagamento" placeholder="Metodo Pagamento" value="<%= _.escape(item.get('metodoPagamento') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="enderecoEntregaInputContainer" class="control-group">
					<label class="control-label" for="enderecoEntrega">Endereco Entrega</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="enderecoEntrega" placeholder="Endereco Entrega" value="<%= _.escape(item.get('enderecoEntrega') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteCompraAutomaticaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteCompraAutomaticaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete CompraAutomatica</button>
						<span id="confirmDeleteCompraAutomaticaContainer" class="hide">
							<button id="cancelDeleteCompraAutomaticaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteCompraAutomaticaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="compraAutomaticaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit CompraAutomatica
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="compraAutomaticaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveCompraAutomaticaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="compraAutomaticaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newCompraAutomaticaButton" class="btn btn-primary">Add CompraAutomatica</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
