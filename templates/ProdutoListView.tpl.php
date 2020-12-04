<?php
	$this->assign('title','Despesnsa Esforço v2.0  | Produtos');
	$this->assign('nav','produtos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/produtos.js").wait(function(){
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
	<i class="icon-th-list"></i> Produtos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="produtoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataValidade">Data Validade<% if (page.orderBy == 'DataValidade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Categoria">Categoria<% if (page.orderBy == 'Categoria') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Prioridade">Prioridade<% if (page.orderBy == 'Prioridade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_QtdMinima">Qtd Minima<% if (page.orderBy == 'QtdMinima') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_QtdMaxima">Qtd Maxima<% if (page.orderBy == 'QtdMaxima') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %></td>
				<td><%if (item.get('dataValidade')) { %><%= _date(app.parseDate(item.get('dataValidade'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('categoria') || '') %></td>
				<td><%= _.escape(item.get('prioridade') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('qtdMinima') || '') %></td>
				<td><%= _.escape(item.get('qtdMaxima') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="produtoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeInputContainer" class="control-group">
					<label class="control-label" for="nome">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nome" placeholder="Nome" value="<%= _.escape(item.get('nome') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataValidadeInputContainer" class="control-group">
					<label class="control-label" for="dataValidade">Data Validade</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataValidade" type="text" value="<%= _date(app.parseDate(item.get('dataValidade'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
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
				<div id="qtdMinimaInputContainer" class="control-group">
					<label class="control-label" for="qtdMinima">Qtd Minima</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="qtdMinima" placeholder="Qtd Minima" value="<%= _.escape(item.get('qtdMinima') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="qtdMaximaInputContainer" class="control-group">
					<label class="control-label" for="qtdMaxima">Qtd Maxima</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="qtdMaxima" placeholder="Qtd Maxima" value="<%= _.escape(item.get('qtdMaxima') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteProdutoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteProdutoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Produto</button>
						<span id="confirmDeleteProdutoContainer" class="hide">
							<button id="cancelDeleteProdutoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteProdutoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="produtoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Produto
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="produtoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveProdutoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="produtoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newProdutoButton" class="btn btn-primary">Add Produto</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
