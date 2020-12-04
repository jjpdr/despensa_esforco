<?php
	$this->assign('title','Despesnsa Esforço v2.0  | MetodoPagamentos');
	$this->assign('nav','metodopagamentos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/metodopagamentos.js").wait(function(){
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
	<i class="icon-th-list"></i> MetodoPagamentos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="metodoPagamentoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NomeTitular">Nome Titular<% if (page.orderBy == 'NomeTitular') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NumeroCartao">Numero Cartao<% if (page.orderBy == 'NumeroCartao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataValidadeCartao">Data Validade Cartao<% if (page.orderBy == 'DataValidadeCartao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CodigoSeguranca">Codigo Seguranca<% if (page.orderBy == 'CodigoSeguranca') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_CpfTitular">Cpf Titular<% if (page.orderBy == 'CpfTitular') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('nomeTitular') || '') %></td>
				<td><%= _.escape(item.get('numeroCartao') || '') %></td>
				<td><%if (item.get('dataValidadeCartao')) { %><%= _date(app.parseDate(item.get('dataValidadeCartao'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('codigoSeguranca') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('cpfTitular') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="metodoPagamentoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeTitularInputContainer" class="control-group">
					<label class="control-label" for="nomeTitular">Nome Titular</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nomeTitular" placeholder="Nome Titular" value="<%= _.escape(item.get('nomeTitular') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="numeroCartaoInputContainer" class="control-group">
					<label class="control-label" for="numeroCartao">Numero Cartao</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="numeroCartao" placeholder="Numero Cartao" value="<%= _.escape(item.get('numeroCartao') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataValidadeCartaoInputContainer" class="control-group">
					<label class="control-label" for="dataValidadeCartao">Data Validade Cartao</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataValidadeCartao" type="text" value="<%= _date(app.parseDate(item.get('dataValidadeCartao'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="codigoSegurancaInputContainer" class="control-group">
					<label class="control-label" for="codigoSeguranca">Codigo Seguranca</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="codigoSeguranca" placeholder="Codigo Seguranca" value="<%= _.escape(item.get('codigoSeguranca') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cpfTitularInputContainer" class="control-group">
					<label class="control-label" for="cpfTitular">Cpf Titular</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cpfTitular" placeholder="Cpf Titular" value="<%= _.escape(item.get('cpfTitular') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteMetodoPagamentoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteMetodoPagamentoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete MetodoPagamento</button>
						<span id="confirmDeleteMetodoPagamentoContainer" class="hide">
							<button id="cancelDeleteMetodoPagamentoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteMetodoPagamentoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="metodoPagamentoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit MetodoPagamento
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="metodoPagamentoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveMetodoPagamentoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="metodoPagamentoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newMetodoPagamentoButton" class="btn btn-primary">Add MetodoPagamento</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
