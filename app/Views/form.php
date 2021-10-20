<div class="container col-md-8 offset-md-2 border contacts-form">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-9 col-xs-7 col-sm-9 " style="padding-left:25px;">
				<h3><?php echo isset($contact) ? "Editar Contacto" : "Nuevo Contacto"; ?></h3>
			</div>
		</div>
	</div>
	<hr class="divider-title" style="margin-top: 10px;">
    <?php 
    if(isset($contact)){
        $id                 = $contact[0]['id'];
        $name               = $contact[0]['name'];
        $street_address     = $contact[0]['street_address'];
        $number_address     = $contact[0]['number_address'];
        $suburb_address     = $contact[0]['suburb_address'];
        $zip_code           = $contact[0]['zip_code'];
        $city               = $contact[0]['city'];
        $state              = $contact[0]['state'];
        $phone              = $contact[0]['phone'];
        $email              = $contact[0]['email'];
        $latitude           = $contact[0]['latitude'];
        $longitude          = $contact[0]['longitude'];
    }else{
        $id                 = "";
        $name               = "";
        $street_address     = "";
        $number_address     = "";
        $suburb_address     = "";
        $zip_code           = "";
        $city               = "";
        $state              = "";
        $phone              = "";
        $email              = "";
        $latitude           = "";
        $longitude          = "";
    }

    echo form_open('/ContactBook/save',array('id'=>'form_save'));
    ?>
    <div class="form-group">
        <?php 
        echo form_label('*Nombre:','name');
        
        echo form_input(array('id'=>'name','name'=>'name','placeholder'=>'Nombre','class'=>'form-control', 'value'=>$name, 'required'=>'required'));
        
        echo form_label('*Domicilio:','street_address');
        
        echo form_input(array('id'=>'street_address','name'=>'street_address','placeholder'=>'Domicilio','class'=>'form-control', 'value'=>$street_address, 'required'=>'required'));
        
        echo form_label('*Número:','number_address');
        
        echo form_input(array('id'=>'number_address','name'=>'number_address','placeholder'=>'Número','class'=>'form-control', 'value'=>$number_address, 'required'=>'required'));
        
        echo form_label('*Colonia:','suburb_address');
        
        echo form_input(array('id'=>'suburb_address','name'=>'suburb_address','placeholder'=>'Colonia','class'=>'form-control', 'value'=>$suburb_address, 'required'=>'required'));
        
        echo form_label('Código Postal:','zip_code');
        
        echo form_input(array('id'=>'zip_code','name'=>'zip_code','placeholder'=>'Código Postal','class'=>'form-control', 'value'=>$zip_code));
        
        echo form_label('*Ciudad:','city');
        
        echo form_input(array('id'=>'city','name'=>'city','placeholder'=>'Ciudad','class'=>'form-control', 'value'=>$city, 'required'=>'required'));
        
        echo form_label('Estado:','state');
        
        echo form_input(array('id'=>'state','name'=>'state','placeholder'=>'Estado','class'=>'form-control', 'value'=>$state));
        
        echo form_label('*Teléfono:','phone');
        
        echo form_input(array('id'=>'phone','name'=>'phone','placeholder'=>'Teléfono','class'=>'form-control', 'value'=>$phone, 'required'=>'required', 'type'=>'tel', 'pattern'=>'[0-9]{10}'));
        
        echo form_label('*Correo electrónico:','email');
        
        echo form_input(array('id'=>'email','name'=>'email','placeholder'=>'Correo electrónico','class'=>'form-control', 'value'=>$email, 'required'=>'required', 'type'=>'email'));
        
        echo form_input(array('id'=>'load_gps','name'=>'load_gps', 'type'=>'button','value'=>'Cargar datos gps','class'=>'btn btn-success'));
        
        echo form_label('*Latitud:','latitude');
        
        echo form_input(array('id'=>'latitude','name'=>'latitude','placeholder'=>'Latitud','class'=>'form-control', 'value'=>$latitude, 'required'=>'required'));
        
        echo form_label('*Longitud:','longitude');
        
        echo form_input(array('id'=>'longitude','name'=>'longitude','placeholder'=>'Longitud','class'=>'form-control', 'value'=>$longitude, 'required'=>'required'));
        
		echo form_submit('save','Guardar','class="btn btn-primary" style="display:none;"');

        if(isset($contact)){
            echo form_hidden(array('id'=>$id));
        }

        echo form_close();
        ?>
		<hr class="divider-title" style="margin-top: 10px;">
		<div class="d-flex justify-content-end">
        <a href="<?php echo base_url(); ?>" class="btn btn-secondary me-4" role="button">Cancelar</a>
        <?php
        echo form_input(array('type'=>'button', 'value'=>'Guardar', 'class'=>'btn btn-primary', 'id'=>'btnsubmit'));
		?>
		</div>
    </div>
</div>
<script>
	$('#load_gps').click(function(){
        var myform 			= $(this).parents('form');
		var street_address  = myform.find('input[name="street_address"]');
        var number_address  = myform.find('input[name="number_address"]');
        var suburb_address  = myform.find('input[name="suburb_address"]');
        var zip_code        = myform.find('input[name="zip_code"]');
        var city            = myform.find('input[name="city"]');
        var state           = myform.find('input[name="state"]');

		if(!validateGps(street_address,number_address,suburb_address,zip_code,city,state)) return;
		
		var fulladdress = (street_address.val()+" "+number_address.val()+" "+suburb_address.val()+" "+zip_code.val()+" "+city.val()+" "+state.val()).trim();
        
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>/ContactBook/restservice",
			data: {'fulladdress':fulladdress}
		})
		.done(function( data ) {
			var response = JSON.parse(data);
			if(response.length){
				var lat = response[0]['lat'];
				var lon = response[0]['lon'];
				myform.find('input[name="latitude"]').val(lat);
        		myform.find('input[name="longitude"]').val(lon);
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Latitud y Longitud encontrada.',
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				Swal.fire({
					title: 'Error!',
					text: 'No se encontraron resultados de latitud y longitud.',
					icon: 'error',
					confirmButtonText: 'Aceptar'
				});
			}
		});
    });
	function showErrorMsg(text){
		Swal.fire({
			title: 'Error!',
			text: text,
			icon: 'error',
			confirmButtonText: 'Aceptar'
		});
	}
	function validateGps(street_address,number_address,suburb_address,zip_code,city,state){
		if(street_address.val() == ""){
			street_address.focus();
			showErrorMsg("Favor de llenar el campo de Domicilio para usar GPS");
			return false;
		}
		if(number_address.val() == ""){
			number_address.focus();
			showErrorMsg("Favor de llenar el campo de Número para usar GPS");
			return false;
		}
		if(suburb_address.val() == ""){
			suburb_address.focus();
			showErrorMsg("Favor de llenar el campo de Colonia para usar GPS");
			return false;
		}
		if(zip_code.val() == ""){
			zip_code.focus();
			showErrorMsg("Favor de llenar el campo de Código Postal para usar GPS");
			return false;
		}
		if(city.val() == ""){
			city.focus();
			showErrorMsg("Favor de llenar el campo de Ciudad para usar GPS");
			return false;
		}
		if(state.val() == ""){
			state.focus();
			showErrorMsg("Favor de llenar el campo de Estado para usar GPS");
			return false;
		}
		return true;
	}
</script>