<?php
	$this->assign('title','Despesnsa Esforço v3.0  | EnderecoEntregas');
	$this->assign('nav','enderecoentregas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/enderecoentregas.js").wait(function(){
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
	<i class="icon-th-list"></i> EnderecoEntregas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="enderecoEntregaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Rua">Rua<% if (page.orderBy == 'Rua') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NroCasa">Nro Casa<% if (page.orderBy == 'NroCasa') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Bairro">Bairro<% if (page.orderBy == 'Bairro') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Cidade">Cidade<% if (page.orderBy == 'Cidade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Cep">Cep<% if (page.orderBy == 'Cep') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_HorarioPreferencial">Horario Preferencial<% if (page.orderBy == 'HorarioPreferencial') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('rua') || '') %></td>
				<td><%= _.escape(item.get('nroCasa') || '') %></td>
				<td><%= _.escape(item.get('bairro') || '') %></td>
				<td><%= _.escape(item.get('cidade') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('cep') || '') %></td>
				<td><%= _.escape(item.get('horarioPreferencial') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="enderecoEntregaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="ruaInputContainer" class="control-group">
					<label class="control-label" for="rua">Rua</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="rua" placeholder="Rua" value="<%= _.escape(item.get('rua') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nroCasaInputContainer" class="control-group">
					<label class="control-label" for="nroCasa">Nro Casa</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nroCasa" placeholder="Nro Casa" value="<%= _.escape(item.get('nroCasa') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="bairroInputContainer" class="control-group">
					<label class="control-label" for="bairro">Bairro</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bairro" placeholder="Bairro" value="<%= _.escape(item.get('bairro') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cidadeInputContainer" class="control-group">
					<label class="control-label" for="cidade">Cidade</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cidade" placeholder="Cidade" value="<%= _.escape(item.get('cidade') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cepInputContainer" class="control-group">
					<label class="control-label" for="cep">Cep</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cep" placeholder="Cep" value="<%= _.escape(item.get('cep') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="horarioPreferencialInputContainer" class="control-group">
					<label class="control-label" for="horarioPreferencial">Horario Preferencial</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="horarioPreferencial" placeholder="Horario Preferencial" value="<%= _.escape(item.get('horarioPreferencial') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteEnderecoEntregaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteEnderecoEntregaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete EnderecoEntrega</button>
						<span id="confirmDeleteEnderecoEntregaContainer" class="hide">
							<button id="cancelDeleteEnderecoEntregaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteEnderecoEntregaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="enderecoEntregaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit EnderecoEntrega
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="enderecoEntregaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveEnderecoEntregaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="enderecoEntregaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newEnderecoEntregaButton" class="btn btn-primary">Add EnderecoEntrega</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
