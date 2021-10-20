<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-9 col-xs-7 col-sm-9 " style="padding-left:25px;">
					<h3>Ejercicio #1</h3>
				</div>
			</div>
		</div>
		<hr class="divider-title" style="margin-top: 10px;">
		<div class="row btn-toolbar" style="justify-content: space-between;padding:10px;">
			<div class="input-group">
				<input type="text" name="search" value="" placeholder="Búsqueda rápida" class="form-control border" />
				<a href="#" class="btn btn-light border input-group-text" role="button" ><i class="fa fa-search"></i></a>
			</div>
			<div class="btn-toolbar input-group">
				<div class="btn-group mr-2" role="group">
					<a href="<?php echo base_url(); ?>/form" class="btn btn-light border" role="button">Nuevo</a>
					<a href="<?php echo base_url(); ?>" class="btn btn-light border" role="button">Volver</a>
				</div>
			</div>
		</div>
		<div class="row">
			<table class="table">
				<tr class="tb-header">
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Calle</th>
					<th scope="col">Número</th>
					<th scope="col">Colonia</th>
					<th scope="col">Ciudad</th>
					<th scope="col">Eliminar</th>
				</tr>
				<?php if($contacts): ?>
					<?php foreach($contacts as $contact): ?>
						<tr scope="row">
							<td>
								<a href="<?php echo base_url(); ?>/edit/<?php echo $contact['id']; ?>" class="btn" role="button" ><i class="fa fa-pencil"></i></a>
							</td>
							<td>
								<?php echo $contact['name'] ?>
							</td>
							<td>
								<?php echo $contact['street_address'] ?>
							</td>
							<td>
								<?php echo $contact['number_address'] ?>
							</td>
							<td>
								<?php echo $contact['suburb_address'] ?>
							</td>
							<td>
								<?php echo $contact['city'] ?>
							</td>
							<td>
								<a href="#" onclick="confirmDelete(<?php echo $contact['id']; ?>);" class="btn btn-danger" role="button" ><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					
					<?php endforeach; ?>
				<?php else: ?>
					<tr scope="row">
						<td colspan="7">
							<label>No se encontraron resultados.<label>
						</td>
					</tr>
				<?php endif; ?>
			</table>
			
			<?php echo $pagination->links(); ?>
		</div>
	</div>
</body>
</html>
