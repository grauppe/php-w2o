<?php
	$this->assign('title','W2O | Grades Horárias');
	$this->assign('nav','gradeshorarias');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/gradeshorarias.js").wait(function(){
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
	<i class="icon-th-list"></i> Grades Horárias
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="gradehorariaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Horario">Horário<% if (page.orderBy == 'Horario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Grademensal">Grade Mensal<% if (page.orderBy == 'Grademensal') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Diasemana">Dia Semana<% if (page.orderBy == 'Diasemana') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Materiaid">Materia<% if (page.orderBy == 'Materiaid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('horario') || '') %></td>
				<td><%= _.escape(item.get('grademensal') || '') %></td>
				<td><%= _.escape(item.get('diasemana') || '') %></td>
				<td><%= _.escape(item.get('materianome') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="gradehorariaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="horarioInputContainer" class="control-group">
					<label class="control-label" for="horario">Horário</label>
					<div class="controls inline-inputs">
						<select id="horario" name="horario">
							<option value=""></option>
							<option value="1"<% if (item.get('horario')=='1') { %> selected="selected"<% } %>>1</option>
							<option value="2"<% if (item.get('horario')=='2') { %> selected="selected"<% } %>>2</option>
							<option value="3"<% if (item.get('horario')=='3') { %> selected="selected"<% } %>>3</option>
							<option value="4"<% if (item.get('horario')=='4') { %> selected="selected"<% } %>>4</option>
						</select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="grademensalInputContainer" class="control-group">
					<label class="control-label" for="grademensal">Grade Mensal</label>
					<div class="controls inline-inputs">
						<select id="grademensal" name="grademensal">
							<option value=""></option>
                        	<option value="Todas"<% if (item.get('grademensal')=='Todas') { %> selected="selected"<% } %>>Todas</option>
							<option value="Penultima"<% if (item.get('grademensal')=='Penultima') { %> selected="selected"<% } %>>Penultima</option>
							<option value="Ultima"<% if (item.get('grademensal')=='Ultima') { %> selected="selected"<% } %>>Ultima</option>
						</select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="diasemanaInputContainer" class="control-group">
					<label class="control-label" for="diasemana">Dia da Semana</label>
					<div class="controls inline-inputs">
						<select id="diasemana" name="diasemana">
							<option value=""></option>
							<option value="Segunda"<% if (item.get('diasemana')=='Segunda') { %> selected="selected"<% } %>>Segunda</option>
							<option value="Terca"<% if (item.get('diasemana')=='Terca') { %> selected="selected"<% } %>>Terca</option>
							<option value="Quarta"<% if (item.get('diasemana')=='Quarta') { %> selected="selected"<% } %>>Quarta</option>
							<option value="Quinta"<% if (item.get('diasemana')=='Quinta') { %> selected="selected"<% } %>>Quinta</option>
							<option value="Sexta"<% if (item.get('diasemana')=='Sexta') { %> selected="selected"<% } %>>Sexta</option>
							<option value="Sabado"<% if (item.get('diasemana')=='Sabado') { %> selected="selected"<% } %>>Sabado</option>
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
		<form id="deleteGradehorariaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteGradehorariaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Deletar Grade Horária</button>
						<span id="confirmDeleteGradehorariaContainer" class="hide">
							<button id="cancelDeleteGradehorariaButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteGradehorariaButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="gradehorariaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Grade Horária
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="gradehorariaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancelar</button>
			<button id="saveGradehorariaButton" class="btn btn-primary">Salvar</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="gradehorariaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newGradehorariaButton" class="btn btn-primary">Add Grade Horária</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
