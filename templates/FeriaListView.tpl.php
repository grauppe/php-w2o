<?php
	$this->assign('title','W2O | Férias');
	$this->assign('nav','ferias');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/ferias.js").wait(function(){
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
	<i class="icon-th-list"></i> Férias
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="feriaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Professorid">Professor<% if (page.orderBy == 'Professorid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Datainicio">Data Inicial<% if (page.orderBy == 'Datainicio') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Datafim">Data Final<% if (page.orderBy == 'Datafim') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('professornome') || '') %></td>
				<td><%if (item.get('datainicio')) { %><%= _date(app.parseDate(item.get('datainicio'))).format('DD/MM/YYYY') %><% } else { %>NULL<% } %></td>
				<td><%if (item.get('datafim')) { %><%= _date(app.parseDate(item.get('datafim'))).format('DD/MM/YYYY') %><% } else { %>NULL<% } %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="feriaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="professoridInputContainer" class="control-group">
					<label class="control-label" for="professorid">Professor</label>
					<div class="controls inline-inputs">
						<select id="professorid" name="professorid"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="datainicioInputContainer" class="control-group">
					<label class="control-label" for="datainicio">Data Inicio</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="dd/mm/yyyy">
							<input id="datainicio" type="text" value="<%= _date(app.parseDate(item.get('datainicio'))).format('DD/MM/YYYY') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="datafimInputContainer" class="control-group">
					<label class="control-label" for="datafim">Data Fim</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="dd/mm/yyyy">
							<input id="datafim" type="text" value="<%= _date(app.parseDate(item.get('datafim'))).format('DD/MM/YYYY') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
                                <hr/><br/>
                                <div class="alert alert-info" role="alert">
                                        <p>Lembre-se de adicionar um Professor Substituto depois de programar as férias do Professor Principal.</p>
                                </div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteFeriaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteFeriaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Deletar Férias</button>
						<span id="confirmDeleteFeriaContainer" class="hide">
							<button id="cancelDeleteFeriaButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteFeriaButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="feriaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Férias
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="feriaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancelar</button>
			<button id="saveFeriaButton" class="btn btn-primary">Salvar</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="feriaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newFeriaButton" class="btn btn-primary">Add Férias</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
