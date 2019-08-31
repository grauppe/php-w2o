<?php
	$this->assign('title','W2O | Professores');
	$this->assign('nav','professores');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/professores.js").wait(function(){
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
	<i class="icon-th-list"></i> Professores
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="professorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Tipo">Tipo<% if (page.orderBy == 'Tipo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Materiaid">Matéria<% if (page.orderBy == 'Materiaid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %><% if (item.get('datainicio')) { %> &nbsp; <span class="badge badge-danger"> Férias em: <%= _date(app.parseDate(item.get('datainicio'))).format('DD/MM/YYYY') %></span><% } %></td>
				<td><%= _.escape(item.get('tipo') || '') %></td>
				<td><%= _.escape(item.get('materianome') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="professorModelTemplate">
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
				<div id="tipoInputContainer" class="control-group">
					<label class="control-label" for="tipo">Tipo</label>
					<div class="controls inline-inputs">
						<select id="tipo" name="tipo">
							<option value=""></option>
							<option value="Principal"<% if (item.get('tipo')=='Principal') { %> selected="selected"<% } %>>Principal</option>
							<option value="Substituto"<% if (item.get('tipo')=='Substituto') { %> selected="selected"<% } %>>Substituto</option>
						</select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="materiaidInputContainer" class="control-group">
					<label class="control-label" for="materiaid">Matéria</label>
					<div class="controls inline-inputs">
						<select id="materiaid" name="materiaid"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteProfessorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteProfessorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Deletar Professor</button>
						<% if (item.get('datainicio')) { %><button id="feriasButton" class="btn btn-mini " onclick="window.location.replace('./ferias');"><i class="icon-th-list icon-white"></i> Conferir Férias</button><% } %>
						<span id="confirmDeleteProfessorContainer" class="hide">
							<button id="cancelDeleteProfessorButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteProfessorButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="professorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Professor
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="professorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancelar</button>
			<button id="saveProfessorButton" class="btn btn-primary">Salvar</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="professorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newProfessorButton" class="btn btn-primary">Add Professor</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
