<?php
/**
 * 001. esc_estado_civil
 */
Schema::create ( 'esc_estado_civil', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->comment ( 'Indica el nombre de estado civil.' );
	// Indexes
} );

/**
 * 002.
 * esc_ubigeo
 */
Schema::create ( 'esc_ubigeo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->char ( 'cod_region', 2 )->comment ( 'Establece el codigo de Region.' );
	$table->char ( 'cod_prov', 2 )->comment ( 'Establece el codigo de Provincia.' );
	$table->char ( 'cod_dist', 2 )->comment ( 'Establece el codigo de Distrito.' );
	$table->string ( 'nombre', 45 )->comment ( 'Indica el nombre del lugar.' );
	// Indexes
} );

/**
 * 003.
 * esc_pais
 */
Schema::create ( 'esc_pais', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 45 )->comment ( 'Indica el nombre del Pais.' );
	$table->integer ( 'est_num' )->comment ( 'Señala el estandar numérico, segun ISO 3166.' );
	$table->char ( 'est_alfa_2', 2 )->comment ( 'Señala el estandar en 2 caracteres de cuerdo al ISO 3166' );
	$table->char ( 'est_alfa_3', 3 )->comment ( 'Señala el estandar en 3 caracteres de acuerdo al ISO 3166.' );
	// Indexes
} );

/**
 * 004.
 * esc_operador_celular
 */
Schema::create ( 'esc_operador_celular', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 20 )->comment ( 'Nombre del operador celular.' );
	// Indexes
} );

/**
 * 005.
 * esc_tipo_sangre
 */
Schema::create ( 'esc_tipo_sangre', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 3 )->comment ( 'Describe el tipo de sangre, segun tipos.' );
	// Indexes
} );

/**
 * 006.
 * esc_tipo_via
 */
Schema::create ( 'esc_tipo_via', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 40 )->comment ( 'Describe el tipo de via de residencia.' );
	// Indexes
} );

/**
 * 007.
 * esc_tipo_zona
 */
Schema::create ( 'esc_tipo_zona', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 30 )->nullable ()->comment ( 'Describe el tipo de zona de residencia.' );
	// Indexes
} );

/**
 * 008.
 * esc_servicio_militar
 */
Schema::create ( 'esc_servicio_militar', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 20 )->comment ( 'Nombre del servicio militar.' );
	// Indexes
} );

/**
 * 009.
 * esc_tipo_vivienda
 */
Schema::create ( 'esc_tipo_vivienda', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->comment ( 'Describe el tipo de vivienda.' );
	// Indexes
} );
/**
 * 010.
 * esc_persona
 */
Schema::create ( 'esc_persona', function (Blueprint $table) {
	$table->increments ( 'id' )->comment ( 'Identificador unico de persona dentro del Sistema' );
	$table->integer ( 'id_estado_civil' )->comment ( 'Estado civil segun Documento  Nacional de Identidad. (Ver estado_civil)' );
	$table->integer ( 'id_ubigeo_res' )->comment ( 'Ubigeo de residencia (Ver ubigeo)' );
	$table->integer ( 'id_ubigeo_nac' )->comment ( 'Ubigeo de Nacimiento. (Ver. ubigeo)' );
	$table->string ( 'apellido_paterno', 45 )->comment ( 'Apellido paterno de la persona' );
	$table->string ( 'apellido_materno', 45 )->comment ( 'Apellido materno de la persona' );
	$table->string ( 'nombres', 45 )->comment ( 'Nombres completos de la persona' );
	$table->char ( 'dni', 8 )->comment ( 'Numero del documento nacional de identidad' );
	$table->date ( 'fecha_nacimiento' )->comment ( 'Fecha de nacimiento de la persona' );
	$table->tinyInteger ( 'sexo' )->nullable ()->comment ( 'Genero de la persona
1 = Masculino, 2 = Femenino' );
	$table->integer ( 'id_pais_nacimiento' )->comment ( 'Identifica al pais en cual nació.' );
	$table->string ( 'telefono', 45 )->nullable ()->comment ( 'Telefono en formato:
(051) 321 123 - 12356
' );
	$table->integer ( 'id_operador_celular' )->comment ( 'Identifica al operador de celular.' );
	$table->char ( 'celular', 9 )->nullable ()->comment ( 'Numero de celular principal de la persona.' );
	$table->string ( 'email', 60 )->nullable ()->comment ( 'Direccion de correo elecronico principal de la persona' );
	$table->integer ( 'id_tipo_via' )->comment ( 'Identifica el tipo de via de residencia.' );
	$table->integer ( 'id_tipo_vivienda' )->comment ( 'Identifica el tipo de vivienda en donde reside.' );
	$table->integer ( 'id_tipo_zona' )->comment ( 'Identifica el tipo de zona de residencia.' );
	$table->string ( 'barrio', 20 )->nullable ()->comment ( 'Indica el barrio en el cual reside de acuerdo a zona.' );
	$table->string ( 'direccion', 60 )->comment ( 'Direccion de residencia de la persona' );
	$table->string ( 'web_personal', 60 )->nullable ()->comment ( 'Direccion url del sitio o blog de la persona' );
	$table->char ( 'ruc', 11 )->nullable ()->comment ( 'Indica el numero en el Registro Unico de Contribuyentes.' );
	$table->string ( 'essalud', 20 )->nullable ()->comment ( 'Indica el numero de essalud de la persona.' );
	$table->string ( 'nro_brevete', 12 )->nullable ()->comment ( 'Señala el numero de brevete o licencia de conducir.' );
	$table->tinyInteger ( 'tiene_servicio_militar' )->nullable ()->comment ( '1 = Si realizó el servicio militar,
2 = NO realizó el servicio militar.' );
	$table->integer ( 'tiempo_servicio_militar' )->nullable ()->comment ( 'Señala el tiempo de servicio militar en años.' );
	$table->integer ( 'id_servicio_militar' )->nullable ()->comment ( 'Identifica en que fuerza armada en la cual realizó su servicio militar.' );
	$table->string ( 'numero_libreta_militar', 15 )->nullable ()->comment ( 'Señala el numero de Libreta Militar otorgado por las fuerzas armadas.' );
	$table->string ( 'grado_militar', 45 )->nullable ()->comment ( 'Señala el grado militar.' );
	$table->tinyInteger ( 'es_conadis' )->nullable ()->comment ( 'Señala si la persona cuenta con CONADIS.' );
	$table->date ( 'fecha_conadis' )->nullable ()->comment ( 'Señala la fecha en la que se emitió la resolución del CONADIS.' );
	$table->integer ( 'id_tipo_sangre' )->comment ( 'Indica el tipo de sangre.' );
	// Indexes
	$table->unique ( 'dni' );
	$table->index ( 'id_estado_civil' );
	$table->index ( 'id_ubigeo_nac' );
	$table->index ( 'id_ubigeo_res' );
	$table->index ( 'id_pais_nacimiento' );
	$table->index ( 'id_operador_celular' );
	$table->index ( 'id_tipo_sangre' );
	$table->index ( 'id_tipo_via' );
	$table->index ( 'id_tipo_zona' );
	$table->index ( 'id_servicio_militar' );
	$table->index ( 'id_tipo_vivienda' );
	$table->unique ( 'ruc' );
	$table->unique ( 'essalud' );
	
	$table->foreign ( 'id_estado_civil', 'fk_persona_estado_civil_idx' )->references ( 'id' )->on ( 'esc_estado_civil' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_ubigeo_nac', 'fk_persona_ubigeo1_idx' )->references ( 'id' )->on ( 'esc_ubigeo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_ubigeo_res', 'fk_persona_ubigeo2_idx' )->references ( 'id' )->on ( 'esc_ubigeo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_pais_nacimiento', 'fk_persona_pais1_idx' )->references ( 'id' )->on ( 'esc_pais' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_operador_celular', 'fk_persona_operador_celular1_idx' )->references ( 'id' )->on ( 'esc_operador_celular' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_sangre', 'fk_persona_tipo_sangre1_idx' )->references ( 'id' )->on ( 'esc_tipo_sangre' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_via', 'fk_esc_persona_esc_tipo_via1_idx' )->references ( 'id' )->on ( 'esc_tipo_via' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_zona', 'fk_esc_persona_esc_tipo_zona1_idx' )->references ( 'id' )->on ( 'esc_tipo_zona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_servicio_militar', 'fk_esc_persona_esc_servicio_militar1_idx' )->references ( 'id' )->on ( 'esc_servicio_militar' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_vivienda', 'fk_esc_persona_esc_tipo_vivienda1_idx' )->references ( 'id' )->on ( 'esc_tipo_vivienda' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 011.
 * esc_empleado
 */
Schema::create ( 'esc_empleado', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica a la persona que ' );
	$table->string ( 'cod_rrhh', 45 )->nullable ()->comment ( 'Codigo interno de RRHH' );
	$table->string ( 'cod_remun', 45 )->nullable ()->comment ( 'Codigo usado por escalafon' );
	$table->string ( 'modalidad_ingreso', 45 )->nullable ()->comment ( 'Describe la modalidad por la cual ingreso a trabajar a la UNAP' );
	$table->string ( 'cod_20530', 45 )->nullable ()->comment ( 'Codigo de Regimen de pensiones' );
	$table->string ( 'nro_orden', 45 )->nullable ()->comment ( 'Clasificacion y ubicacion de archivadores fisicos' );
	$table->tinyInteger ( 'es_investigador' )->nullable ()->comment ( 'Define si el empleado es investigador
1 =  SI, 2 = NO' );
	$table->string ( 'observaciones', 45 )->nullable ();
	$table->tinyInteger ( 'es_activo' )->nullable ()->comment ( 'Indica si es un empleado activo.' );
	$table->tinyInteger ( 'es_actualizado' )->nullable ()->comment ( 'Actualizacion de datos
1 =  SI, 2 = NO' );
	// Indexes
	$table->index ( 'id_persona' );
	
	$table->foreign ( 'id_persona', 'fk_personal_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 012.
 * esc_tipo_documento
 */
Schema::create ( 'esc_tipo_documento', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->comment ( 'Especifica el nombre de documento.' );
	// Indexes
} );

/**
 * 013.
 * esc_meritos
 */
Schema::create ( 'esc_meritos', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cal se le registra el merito/demerito.' );
	$table->tinyInteger ( 'caso' )->comment ( 'Define la clasificacion
1 = Merito
2 = Demerito' );
	$table->integer ( 'id_tipo_documento' )->comment ( 'Identifica el tipo de documento por el cual se le reconoce merito/demerito.' );
	$table->string ( 'nro_documento', 60 )->comment ( 'Señala el numero de documento con el cual se le asigna merito/demerito.' );
	$table->string ( 'detalle', 45 )->nullable ()->comment ( 'Especifica el detalle del merito/demerito.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha de inicio desde que se impone el merito.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha en la que culmina la vigencia del merito/demerito.' );
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_tipo_documento' );
	
	$table->foreign ( 'id_empleado', 'fk_meritos_personal1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_documento', 'fk_meritos_tipo_documento1_idx' )->references ( 'id' )->on ( 'esc_tipo_documento' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 014.
 * esc_motivo_licencia
 */
Schema::create ( 'esc_motivo_licencia', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->char ( 'tipo', 2 )->comment ( 'Especifica la categoria de licencia.' );
	$table->char ( 'motivo', 2 )->comment ( 'Identificador del tipo de licencia.' );
	$table->string ( 'detalle', 100 )->nullable ()->comment ( 'Especifica el motivo de licencia.' );
	$table->tinyInteger ( 'prioridad' )->comment ( 'Establece la prioridad en la cual se encuentra el motivo de licencia.' );
	$table->string ( 'abreviacion', 40 );
	$table->tinyInteger ( 'es_visible' )->comment ( '1 = Visible en Informe Escalafonario,
2 = NO visible en informe escalafonario.' );
	// Indexes
} );

/**
 * 015.
 * esc_licencias
 */
Schema::create ( 'esc_licencias', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cual se le otorga la licencia.
' );
	$table->integer ( 'id_motivo' )->comment ( 'Identifica el motivo por el cual se le otorga la licencia.' );
	$table->string ( 'numero_res_rect', 45 )->nullable ()->comment ( 'Señala la Resolucion Rectoral con la cual se le otorga la licencia.' );
	$table->string ( 'lugar', 30 )->nullable ()->comment ( 'Indica el lugar a donde se fue durante su licencia.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha desde la cual es vigente la licencia.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha en la cual culmina la vigencia de la licencia.' );
	$table->string ( 'tiempo', 20 )->nullable ()->comment ( 'Señala el tiempo de licencia.' );
	$table->string ( 'remuneracion', 10 )->nullable ()->comment ( 'Señala la informacion de remuneracion.' );
	$table->string ( 'observaciones', 100 )->nullable ();
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_motivo' );
	
	$table->foreign ( 'id_empleado', 'fk_licencias_personal1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_motivo', 'fk_esc_licencias_esc_motivo_licencia1_idx' )->references ( 'id' )->on ( 'esc_motivo_licencia' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 016.
 * esc_zonificacion
 */
Schema::create ( 'esc_zonificacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->char ( 'campus', 2 )->comment ( 'Indica la ubicacion dentro del campus o fuera.' );
	$table->char ( 'zona', 2 )->comment ( 'Indica la zona dentro de campus.' );
	$table->char ( 'pabellon', 2 )->comment ( 'Indica el pabellon de zona.' );
	$table->integer ( 'piso' )->nullable ()->comment ( 'Indica el piso en el pabellon.' );
	$table->string ( 'oficina', 30 )->nullable ()->comment ( 'Indica la oficina en el piso.' );
	$table->string ( 'descripcion', 40 )->nullable ()->comment ( 'Indica el nombre del lugar en especifico.' );
	$table->tinyInteger ( 'tiene_biometrico' )->nullable ()->comment ( '1 = Tiene biometrico,
2 = NO tiene biometrico.' );
	$table->integer ( 'orden' )->nullable ()->comment ( 'Indica el orden en el cual debe de mostrarse en frontend.' );
	$table->string ( 'observaciones', 45 )->nullable ();
	// Indexes
} );

/**
 * 017.
 * esc_unidad
 */
Schema::create ( 'esc_unidad', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'cod_organo' )->nullable ()->comment ( 'Codigo de organo.' );
	$table->integer ( 'cod_oficina' )->nullable ()->comment ( 'Codigo de oficina.' );
	$table->integer ( 'cod_unidad' )->nullable ()->comment ( 'Codigo de unidad.' );
	$table->integer ( 'cod_area' )->nullable ()->comment ( 'Codigo de area.' );
	$table->string ( 'denominacion', 255 )->nullable ()->comment ( 'Indica el nombre de unidad.' );
	$table->string ( 'abreviacion', 45 )->nullable ();
	$table->integer ( 'id_jefatura' )->nullable ()->comment ( 'Identifica la quien es su mediato superior.' );
	$table->tinyInteger ( 'es_facultad' )->nullable ()->comment ( 'Define si es facultad
1 = Facultad
2 = Escuela
3 = Otros

' );
	$table->char ( 'cod_oti', 2 )->nullable ()->comment ( 'CODIGO OTI, 
SOLO Escuelas' );
	// Indexes
} );

/**
 * 018.
 * esc_quinquenio
 */
Schema::create ( 'esc_quinquenio', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->tinyInteger ( 'tipo' )->comment ( 'Clasificacion de quinquenio.
1 = Bonificacion, 
2 = Subsidio
' );
	$table->string ( 'descripcion', 60 )->comment ( 'Descripcion del tipo de abono para asignar.' );
	// Indexes
} );

/**
 * 019.
 * esc_bonificacion
 */
Schema::create ( 'esc_bonificacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cual se le asigna una bonificacion/subsidio.' );
	$table->integer ( 'id_quinquenio' )->comment ( 'Identifica el tipo de bonificacion/subsidio que se le asigna al empleado.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha desde la cual queda vigente el subsidio.' );
	$table->string ( 'numero_res_rect', 10 )->comment ( 'Numero de Resolucion Rectoral con la cual se le otorga la Bonificacion/Subsidio' );
	$table->string ( 'observaciones', 100 )->nullable ()->comment ( 'Observaciones a la asignacion.' );
	$table->string ( 'abono', 10 )->nullable ()->comment ( 'Abono de asignacion.' );
	$table->dateTime ( 'fecha' )->comment ( 'Fecha en la cual se registra la asignacion/subsidio.' );
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_quinquenio' );
	
	$table->foreign ( 'id_empleado', 'fk_bonificacion_personal1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_quinquenio', 'fk_bonificacion_quinquenio1_idx' )->references ( 'id' )->on ( 'esc_quinquenio' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 020.
 * esc_sistema_pension
 */
Schema::create ( 'esc_sistema_pension', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'sistema' )->comment ( 'Indica la clasificación de Sistema de Pensiones.' );
	$table->integer ( 'tipo' )->comment ( 'Indica el tipo dentro del sistema de pensiones.' );
	$table->string ( 'descripcion', 20 )->comment ( 'Describe el Sistema de Pensiones.' );
	// Indexes
} );

/**
 * 021.
 * esc_banco
 */
Schema::create ( 'esc_banco', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 30 )->comment ( 'Describe el nombre de banco.' );
	$table->string ( 'abreviacion', 10 )->nullable ();
	// Indexes
} );

/**
 * 022.
 * esc_pago_haberes
 */
Schema::create ( 'esc_pago_haberes', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cual corresponden sus datos acerca de sus pagos.' );
	$table->integer ( 'id_sistema_pension' )->comment ( 'Identifica al Sistema de Pension al cual esta afiliado la persona.' );
	$table->date ( 'fecha_afiliacion' )->nullable ()->comment ( 'Define la fecha desde la cual aporta al sistema de pensiones.
' );
	$table->string ( 'cuspp', 20 )->nullable ()->comment ( 'Es el Codigo Unico del Sistema Privado de Pensiones.
' );
	$table->integer ( 'id_banco' )->comment ( 'Identifica al banco por el cual se le hace el pago de sus haberes.' );
	$table->string ( 'numero_cuenta', 20 )->comment ( 'Señala el numero de cuenta interno del banco.' );
	$table->string ( 'cci', 20 )->comment ( 'Señala en Codigo de Cuenta Interbancario.' );
	$table->date ( 'fecha_actualizado' )->comment ( 'Señala la fecha en la que se actualizo la informacion de pago de haberes.' );
	$table->tinyInteger ( 'es_afiliado' )->default ( 2 )->comment ( 'Este campo debe de llenarse en cuanto se verifique los datos de afiliacion: 
1 = Esta afiliado
2 = NO esta afiliado' );
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_sistema_pension' );
	$table->index ( 'id_banco' );
	
	$table->foreign ( 'id_empleado', 'fk_pago_haberes_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_sistema_pension', 'fk_pago_haberes_sistema_pension1_idx' )->references ( 'id' )->on ( 'esc_sistema_pension' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_banco', 'fk_esc_pago_haberes_esc_banco1_idx' )->references ( 'id' )->on ( 'esc_banco' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 023.
 * esc_situacion_laboral
 */
Schema::create ( 'esc_situacion_laboral', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'grupo' )->comment ( 'Define el grupo de Situacion laboral' );
	$table->integer ( 'tipo' )->comment ( 'Identifica al tipo de situacion laboral dentro del grupo.
' );
	$table->string ( 'descripcion', 45 )->comment ( 'Indica el nombre de la situacion laboral.' );
	// Indexes
} );

/**
 * 024.
 * esc_regimen_docente
 */
Schema::create ( 'esc_regimen_docente', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->nullable ()->comment ( 'Indica el nombre del regimen laboral docente.' );
	$table->tinyInteger ( 'es_activo' )->nullable ()->comment ( '1 = Regimen Activo,
2 = Regimen NO Activo.' );
	// Indexes
} );

/**
 * 025.
 * esc_categoria_pago
 */
Schema::create ( 'esc_categoria_pago', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_regimen_docente' )->comment ( 'Identifica el regimen docente al cual pertenece la categoria de pago.' );
	$table->string ( 'descripcion', 20 )->comment ( 'Indica el nombre de la categoria de pago.' );
	$table->string ( 'abreviacion', 45 )->nullable ();
	// Indexes
	$table->index ( 'id_regimen_docente' );
	
	$table->foreign ( 'id_regimen_docente', 'fk_categoria_pago_regimen_docente1_idx' )->references ( 'id' )->on ( 'esc_regimen_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 026.
 * esc_dedicacion_pago
 */
Schema::create ( 'esc_dedicacion_pago', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_categoria_pago' )->comment ( 'Identifica la categoria de pago para DOCENTES.' );
	$table->string ( 'descripcion', 45 )->comment ( 'Describe la dedicacion de pago.' );
	$table->string ( 'abreviacion', 45 )->nullable ();
	// Indexes
	$table->index ( 'id_categoria_pago' );
	
	$table->foreign ( 'id_categoria_pago', 'fk_dedicacion_pago_categoria_pago1_idx' )->references ( 'id' )->on ( 'esc_categoria_pago' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 027.
 * esc_carrera_laboral_docente
 */
Schema::create ( 'esc_carrera_laboral_docente', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado que registra carrera laboral docente.
' );
	$table->integer ( 'id_unidad' )->comment ( 'Identifica la unidad a la cual pertenece durante el desempeño de cargo laboral docente.' );
	$table->integer ( 'id_zonificacion' )->comment ( 'Identifica la zona geografica donde trabaja el empleado.' );
	$table->integer ( 'id_situacion_laboral' )->comment ( 'Identifica la situacion laboral en la que se encuentra en el cargo laboral docente.' );
	$table->integer ( 'id_tipo_documento' )->comment ( 'Identifica el tipo de documento con el que se le asigna el cargo laboral docente.' );
	$table->string ( 'nro_documento_asignacion', 45 )->comment ( 'Indica el numero de documento con el cual se hace la asignacion de cargo.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Señala fecha desde que se desempeñara en el cargo laboral.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Señala la fecha en la que culmina sus labores en el cargo laboral docente.' );
	$table->integer ( 'tipo_documento_cese' )->comment ( 'Identifica el documento con el que se concluye con el cargo laboral docente.' );
	$table->string ( 'num_documento_cese', 45 )->nullable ()->comment ( 'Indica el numero de documento mediante el cual se termina la asignacion en el cargo laboral docente.' );
	$table->integer ( 'id_dedicacion_pago' )->comment ( 'Identifica la informacion de regimen, categoria y dedicacion en el cargo laboral.' );
	$table->integer ( 'horas' )->nullable ()->comment ( 'Indica la cantidad de horas de acuerdo a su dedicacion en el cargo.' );
	$table->tinyInteger ( 'es_activo' )->comment ( '1 = Activo
2 = Cargo laboral finalizado' );
	$table->string ( 'observaciones', 100 )->nullable ();
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_unidad' );
	$table->index ( 'id_zonificacion' );
	$table->index ( 'id_situacion_laboral' );
	$table->index ( 'id_tipo_documento' );
	$table->index ( 'tipo_documento_cese' );
	$table->index ( 'id_dedicacion_pago' );
	
	$table->foreign ( 'id_empleado', 'fk_docente_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_unidad', 'fk_docente_unidad1_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_zonificacion', 'fk_docente_zonificacion1_idx' )->references ( 'id' )->on ( 'esc_zonificacion' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_situacion_laboral', 'fk_docente_situacion_laboral1_idx' )->references ( 'id' )->on ( 'esc_situacion_laboral' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_documento', 'fk_docente_tipo_documento1_idx' )->references ( 'id' )->on ( 'esc_tipo_documento' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'tipo_documento_cese', 'fk_docente_tipo_documento2_idx' )->references ( 'id' )->on ( 'esc_tipo_documento' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_dedicacion_pago', 'fk_carrera_laboral_docente_dedicacion_pago1_idx' )->references ( 'id' )->on ( 'esc_dedicacion_pago' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 028.
 * esc_periodo
 */
Schema::create ( 'esc_periodo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha de inicio de periodo semestre academico.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha de finalizacion de periodo semestre acedemico' );
	$table->smallInteger ( 'anio' )->comment ( 'Año en el cual se desarrolla el periodo semestre academico.' );
	$table->string ( 'periodo_academico', 2 )->comment ( 'Identifica al periodo academico en el año.' );
	$table->dateTime ( 'fecha_registro' )->nullable ()->comment ( 'Fecha en la cual se registró el periodo acedmico.' );
	// Indexes
} );

/**
 * 029.
 * esc_carga_academica
 */
Schema::create ( 'esc_carga_academica', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_cargo_laboral_docente' )->comment ( 'Identifica el cargo laboral docente al cual se le asigna carga academica.' );
	$table->integer ( 'id_periodo' )->comment ( 'Identifica al periodo en el cual se le asigna la carga academica.' );
	$table->integer ( 'num_asig' )->nullable ()->comment ( 'Numero de asignaturas.' );
	$table->integer ( 'hrs_acad' )->nullable ()->comment ( 'Horas academicas
' );
	$table->integer ( 'hrs_tuto' )->nullable ()->comment ( 'Horas dedicadas a tutoria
' );
	$table->integer ( 'hrs_inv' )->nullable ()->comment ( 'Horas dedicadas a investigacion
' );
	$table->integer ( 'hrs_proy' )->nullable ()->comment ( 'Horas dedicadas a realizacion de proyectos
' );
	$table->integer ( 'hrs_adm' )->nullable ()->comment ( 'Horas administrativas' );
	$table->integer ( 'hrs_prep_clas' )->nullable ()->comment ( 'Horas dedicadas a preparacion de clases' );
	$table->integer ( 'hrs_total' )->nullable ()->comment ( 'Suma total de horas' );
	$table->string ( 'res_dec', 10 )->nullable ()->comment ( 'Resolucion de decanatura' );
	$table->string ( 'observaciones', 60 )->nullable ();
	// Indexes
	$table->index ( 'id_cargo_laboral_docente' );
	$table->index ( 'id_periodo' );
	
	$table->foreign ( 'id_cargo_laboral_docente', 'fk_carga_academica_cargo_docente1_idx' )->references ( 'id' )->on ( 'esc_carrera_laboral_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_periodo', 'fk_carga_academica_periodo1_idx' )->references ( 'id' )->on ( 'esc_periodo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 030.
 * esc_dina
 */
Schema::create ( 'esc_dina', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cual se le registra en el DINA.' );
	$table->string ( 'fuente', 60 )->nullable ()->comment ( 'Señala la fuente de la cual se extrajo la información.' );
	$table->string ( 'regina', 30 )->nullable ()->comment ( 'Codigo en REGINA.' );
	$table->string ( 'cod_investigador', 30 )->nullable ()->comment ( 'Indica la inscripción en REGINA.' );
	$table->char ( 'dni', 8 )->nullable ()->comment ( 'DNI' );
	$table->string ( 'fuente_web', 60 )->nullable ()->comment ( 'Señala la fuente web de donde se extrajo la información.
' );
	// Indexes
	$table->index ( 'id_empleado' );
	
	$table->foreign ( 'id_empleado', 'fk_dina_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 031.
 * esc_relacion_familiar
 */
Schema::create ( 'esc_relacion_familiar', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 30 )->nullable ();
	$table->string ( 'documento', 10 )->nullable ()->comment ( 'Describe el documento que acredita la relacion familiar.' );
	// Indexes
} );

/**
 * 032.
 * esc_familiar
 */
Schema::create ( 'esc_familiar', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica la persona que registra familiar.' );
	$table->integer ( 'id_relacion_familiar' )->comment ( 'Identifica la relacion familiar que tiene con la persona.' );
	$table->char ( 'dni', 8 )->nullable ()->comment ( 'Indica el Numero de Documento Nacional de Identidad de familiar.' );
	$table->string ( 'apellido_paterno', 45 )->comment ( 'Apellido paterno del familiar.' );
	$table->string ( 'apellido_materno', 45 )->comment ( 'Apellido materno del familiar. ' );
	$table->string ( 'nombres', 45 );
	$table->date ( 'fecha_nacimiento' )->nullable ()->comment ( 'Nombres de familiar.' );
	$table->tinyInteger ( 'es_beneficiario' )->comment ( 'Indica si es beneficiario de pension.
1 = Es beneficiario de pension.
2 = NO es beneficiario de pension.' );
	// Indexes
	$table->index ( 'id_persona' );
	$table->index ( 'id_relacion_familiar' );
	
	$table->foreign ( 'id_persona', 'fk_familiar_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_relacion_familiar', 'fk_familiar_relacion_familiar1_idx' )->references ( 'id' )->on ( 'esc_relacion_familiar' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 033.
 * esc_regimen_administrativo
 */
Schema::create ( 'esc_regimen_administrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 60 )->comment ( 'Indica el nombre del regimen administrativo.' );
	// Indexes
} );

/**
 * 034.
 * esc_modalidad_regimen
 */
Schema::create ( 'esc_modalidad_regimen', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_regimen_administrativo' )->comment ( 'Identifica al regimen administrativo al cual corresponde la modalidad de regimen.' );
	$table->string ( 'descripcion', 45 )->comment ( 'Indica el nombre de la modalidad regimen.' );
	// Indexes
	$table->index ( 'id_regimen_administrativo' );
	
	$table->foreign ( 'id_regimen_administrativo', 'fk_modalidad_regimen_regimen_administrativo1_idx' )->references ( 'id' )->on ( 'esc_regimen_administrativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 035.
 * esc_grupo_ocupacional
 */
Schema::create ( 'esc_grupo_ocupacional', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_modalidad_regimen' )->comment ( 'Identifica la modalidad de regimen al cual pertenece el grupo ocupacional.' );
	$table->string ( 'descripcion', 40 )->comment ( 'Indica el nombre del grupo ocupacional.' );
	// Indexes
	$table->index ( 'id_modalidad_regimen' );
	
	$table->foreign ( 'id_modalidad_regimen', 'fk_grupo_ocupacional_modalidad_regimen1_idx' )->references ( 'id' )->on ( 'esc_modalidad_regimen' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 036.
 * esc_nivel_remunerativo
 */
Schema::create ( 'esc_nivel_remunerativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_grupo_ocupacional' )->comment ( 'Identifica al grupo ocupacional al cual pertenece el nivel remunerativo.' );
	$table->string ( 'descripcion', 20 )->comment ( 'Indica el nombre del nivel remunerativo.' );
	$table->string ( 'abreviacion', 5 );
	// Indexes
	$table->index ( 'id_grupo_ocupacional' );
	
	$table->foreign ( 'id_grupo_ocupacional', 'fk_nivel_remunerativo_grupo_ocupacional1_idx' )->references ( 'id' )->on ( 'esc_grupo_ocupacional' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 037.
 * esc_nivel_remunerativo_especial
 */
Schema::create ( 'esc_nivel_remunerativo_especial', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_nivel_remunerativo' )->comment ( 'Identifica al nivel remunerativo al cual corresponde el nivel especial.' );
	$table->string ( 'descripcion', 40 )->comment ( 'Indica el nombre del nivel remunerativo especial.' );
	$table->string ( 'abreviacion', 10 )->nullable ();
	// Indexes
	$table->index ( 'id_nivel_remunerativo' );
	
	$table->foreign ( 'id_nivel_remunerativo', 'fk_nivel_remunerativo_especial_nivel_remunerativo1_idx' )->references ( 'id' )->on ( 'esc_nivel_remunerativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 038.
 * esc_carrera_laboral_administrativo
 */
Schema::create ( 'esc_carrera_laboral_administrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cual se le registra carrera laboral administrativa.' );
	$table->integer ( 'id_unidad' )->comment ( 'Identifica la unidad a la cual corresponde durante el cargo laboral.' );
	$table->integer ( 'id_zonificacion' )->comment ( 'Identifica la zona o lugar en donde durante su cargo desempañara funciones.' );
	$table->integer ( 'id_situacion_laboral' )->comment ( 'Identifica la situacion laboral en la cual se encuentra el cargo laboral asignado.' );
	$table->integer ( 'id_tipo_documento' )->comment ( 'Identifica el tipo de documento con el cual se asigna el cargo laboral.' );
	$table->string ( 'nro_documento_asignacion', 10 )->nullable ()->comment ( 'Señala el numero de documento con el cual se le asigna el cargo laboral.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha desde la cual inicia sus funciones en el cargo laboral.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha en la que finaliza sus funciones en su cargo laboral.' );
	$table->integer ( 'id_tipo_documento_cese' )->comment ( 'Identifica el tipo de documento con el cual se da por concluido las funciones en el cargo laboral.' );
	$table->string ( 'num_documento_cese', 10 )->nullable ()->comment ( 'Indica el numero de documento con el cual se da por finalizada las funciones en el cargo laboral.' );
	$table->string ( 'cargo_administrativo', 30 )->nullable ()->comment ( 'Describe el cargo laboral que desempeña.' );
	$table->integer ( 'id_nivel_remunerativo' )->comment ( 'Identifica el regimen administrativo, modalidad, grupo ocupacional y nivel remunerativo al cual se acoge en el cargo.' );
	$table->integer ( 'id_nivel_remunerativo_especial' )->nullable ()->comment ( 'Identifica el nivel remunerativo especial que refiere segun sea definido.' );
	$table->tinyInteger ( 'es_activo' )->nullable ()->comment ( '1 = Activo.
2 = Cargo laboral finalizado
' );
	$table->string ( 'observaciones', 100 )->nullable ();
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_unidad' );
	$table->index ( 'id_zonificacion' );
	$table->index ( 'id_situacion_laboral' );
	$table->index ( 'id_tipo_documento' );
	$table->index ( 'id_tipo_documento_cese' );
	$table->index ( 'id_nivel_remunerativo' );
	$table->index ( 'id_nivel_remunerativo_especial' );
	
	$table->foreign ( 'id_empleado', 'fk_administrativo_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_unidad', 'fk_administrativo_unidad1_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_zonificacion', 'fk_administrativo_zonificacion1_idx' )->references ( 'id' )->on ( 'esc_zonificacion' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_situacion_laboral', 'fk_administrativo_situacion_laboral1_idx' )->references ( 'id' )->on ( 'esc_situacion_laboral' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_documento', 'fk_administrativo_tipo_documento1_idx' )->references ( 'id' )->on ( 'esc_tipo_documento' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_documento_cese', 'fk_administrativo_tipo_documento2_idx' )->references ( 'id' )->on ( 'esc_tipo_documento' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_nivel_remunerativo', 'fk_carrera_laboral_administrativo_nivel_remunerativo1_idx' )->references ( 'id' )->on ( 'esc_nivel_remunerativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_nivel_remunerativo_especial', 'fk_carrera_laboral_administrativo_nivel_remunerativo_especi_idx' )->references ( 'id' )->on ( 'esc_nivel_remunerativo_especial' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 039.
 * esc_colegio_profesional
 */
Schema::create ( 'esc_colegio_profesional', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'siglas_colegiatura', 10 )->comment ( 'Registra las siglas del Colegio Profesional.' );
	$table->string ( 'nombre_colegio', 45 )->comment ( 'Indica el nombre del Colegio Profesional.' );
	// Indexes
} );

/**
 * 040.
 * esc_colegiatura
 */
Schema::create ( 'esc_colegiatura', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica a la persona que registra colegiatura.' );
	$table->integer ( 'id_colegio_profesional' )->comment ( 'Identifica al Colegio Profesional en donde esta inscrita la persona.' );
	$table->string ( 'numero_colegiatura', 10 )->comment ( 'Señala el numero de colegiatura.' );
	$table->date ( 'fecha_colegiatura' )->comment ( 'Fecha desde la cual se registra la incorporacion al colegio.' );
	// Indexes
	$table->index ( 'id_colegio_profesional' );
	$table->index ( 'id_persona' );
	
	$table->foreign ( 'id_colegio_profesional', 'fk_colegiatura_colegios_profesionales1_idx' )->references ( 'id' )->on ( 'esc_colegio_profesional' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_persona', 'fk_colegiatura_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 041.
 * esc_historial_habilidad
 */
Schema::create ( 'esc_historial_habilidad', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_colegiatura' )->comment ( 'Identifica la colegiatura a la cual se le registra periodo de habilidad.' );
	$table->date ( 'fecha_inicio' )->nullable ()->comment ( 'Fecha de inicio de habilidad.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha final de habilidad.' );
	$table->dateTime ( 'fecha_actualizado' )->nullable ()->comment ( 'Fecha en la cual se actualiza habilidad.' );
	// Indexes
	$table->index ( 'id_colegiatura' );
	
	$table->foreign ( 'id_colegiatura', 'fk_historial_habilidad_colegiatura1_idx' )->references ( 'id' )->on ( 'esc_colegiatura' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 042.
 * esc_nivel_estudio_ebr
 */
Schema::create ( 'esc_nivel_estudio_ebr', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->comment ( 'Describe el nivel de estudio de Educacion Basica Regular.' );
	// Indexes
} );

/**
 * 043.
 * esc_formacion_ebr
 */
Schema::create ( 'esc_formacion_ebr', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica a la persona que inscribe los estudios de EBR' );
	$table->integer ( 'id_nivel_estudio_ebr' )->comment ( 'Identifica el nivel de estudios que se inscribe' );
	$table->string ( 'nombre_ce', 45 )->comment ( 'Nombre del Centro Educativo' );
	$table->integer ( 'id_ubigeo_ce' )->comment ( 'Identifica la ubicacion del Centro Educativo' );
	$table->date ( 'inicio' )->comment ( 'Fecha de Inicio de estudios en el Centro Educativo' );
	$table->date ( 'termino' )->comment ( 'Fecha de fin de estudios en el Centro Educativo' );
	$table->string ( 'nro_certificado', 10 )->nullable ()->comment ( 'Numero de Certificado de estudios otorgado por el Centro Educativo' );
	$table->tinyInteger ( 'esConcluido' )->comment ( 'Solo EBR Secundaria Concluido. Refiere a la especialidad de formación técnica con la cual egresó.' );
	$table->string ( 'formacion_tecnica', 40 )->nullable ()->comment ( 'Solo EBR Secundaria. Refiere a la especialidad de formación técnica con la cual egresó.' );
	// Indexes
	$table->index ( 'id_ubigeo_ce' );
	$table->index ( 'id_persona' );
	$table->index ( 'id_nivel_estudio_ebr' );
	
	$table->foreign ( 'id_ubigeo_ce', 'fk_formacion_ebr_ubigeo1_idx' )->references ( 'id' )->on ( 'esc_ubigeo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_persona', 'fk_formacion_ebr_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_nivel_estudio_ebr', 'fk_formacion_ebr_nivel_estudio_ebr1_idx' )->references ( 'id' )->on ( 'esc_nivel_estudio_ebr' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 044.
 * esc_grado
 */
Schema::create ( 'esc_grado', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->comment ( 'Describe el grado que se puede registrar en el estudio' );
	// Indexes
} );

/**
 * 045.
 * esc_centro_estudio
 */
Schema::create ( 'esc_centro_estudio', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_pais' )->comment ( 'Identifica al pais en el cual se encuentra el centro de estudio.' );
	$table->tinyInteger ( 'tipo' )->comment ( '1 = Universitaria,
2 = NO Universitaria.
' );
	$table->string ( 'nombre', 100 )->comment ( 'Indica el nombre del centro de estudio.' );
	$table->string ( 'acronimo', 10 )->comment ( 'Indica el acronimo del centro de estudios.
' );
	// Indexes
	$table->index ( 'id_pais' );
	
	$table->foreign ( 'id_pais', 'fk_centro_estudio_pais1_idx' )->references ( 'id' )->on ( 'esc_pais' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 046.
 * esc_nivel_estudio
 */
Schema::create ( 'esc_nivel_estudio', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 30 )->comment ( 'Nombre del nivel de estudio.' );
	// Indexes
} );

/**
 * 047.
 * esc_entidad_registra_grado
 */
Schema::create ( 'esc_entidad_registra_grado', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_nivel_estudio' )->comment ( 'Nivel de estudio al cual le corresponde registrar el grado' );
	$table->string ( 'descripcion', 45 )->comment ( 'Nombre de la entidad que registra grado.' );
	// Indexes
	$table->index ( 'id_nivel_estudio' );
	
	$table->foreign ( 'id_nivel_estudio', 'fk_esc_entidad_registra_grado_esc_nivel_estudio1_idx' )->references ( 'id' )->on ( 'esc_nivel_estudio' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 048.
 * esc_carrera
 */
Schema::create ( 'esc_carrera', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_nivel_estudio' )->comment ( 'Identifica al nivel de estudio que corresponde la carrera profesional' );
	$table->string ( 'descripcion', 60 )->comment ( 'Nombre de la carrera.' );
	// Indexes
	$table->index ( 'id_nivel_estudio' );
	
	$table->foreign ( 'id_nivel_estudio', 'fk_carrera_nivel_estudio1_idx' )->references ( 'id' )->on ( 'esc_nivel_estudio' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 049.
 * esc_estado_estudio
 */
Schema::create ( 'esc_estado_estudio', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->nullable ()->comment ( 'Describe el estado en el cual se encuentra el estudio.' );
	// Indexes
} );

/**
 * 050.
 * esc_estudio
 */
Schema::create ( 'esc_estudio', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica la persona que registra estudio superior.' );
	$table->integer ( 'id_estado_estudio' )->comment ( 'Identifica a el estado en el cual se encuentra el estudio registrado.' );
	$table->integer ( 'id_grado' )->nullable ()->comment ( 'Identifica el grado obtenido. (Obligatorio para los casos que se puedan sustentar con el respectivo grado)' );
	$table->tinyInteger ( 'esLinea' )->comment ( 'Identifica si corresponde o no al area de trabajo.
1 = Corresponde a la linea de trabajo.
2 = NO corresponde a la linea de trabajo.
' );
	$table->integer ( 'id_pais_centro_estudio' )->comment ( 'Identifica al Pais en el cual se realizo el estudio. (En caso no sea Perú se debe de registrar datos en tabla esc_reconocimiento_grado)' );
	$table->integer ( 'id_centro_estudio' )->nullable ()->comment ( '(Solo para Peru). Identifica a la institucion en la cual desarrolló sus estudios.' );
	$table->integer ( 'id_carrera' )->comment ( 'Identifica la carrera profesional en la cual desarrollo sus estudios.' );
	$table->string ( 'detalle_especialidad', 100 )->nullable ()->comment ( 'Describe detalle de la especialidad obtenida en sus estudios.' );
	$table->string ( 'mencion', 60 )->nullable ()->comment ( 'Describe la mencion con la cual se gradua.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Señala la fecha en que inició el estudio.' );
	$table->date ( 'termino' )->nullable ()->comment ( 'Señala la fecha en que culminó el estudio.' );
	$table->date ( 'obtencion_grado' )->nullable ()->comment ( 'Fecha en la cual se le otorgo el grado prescrito.' );
	$table->string ( 'numero_registro', 30 )->nullable ()->comment ( 'Señala el numero de registro del grado.' );
	$table->integer ( 'id_entidad_registra_grado' )->nullable ()->comment ( 'Identifica a la entidad que registra el grado.' );
	$table->string ( 'numero_registro_entidad', 30 )->comment ( 'Señala el numero con en cual entidad que registra el grado' );
	$table->date ( 'fecha_registro_entidad' )->comment ( 'Señala la fecha en la cual la entidad emite el registro del grado.' );
	// Indexes
	$table->index ( 'id_grado' );
	$table->index ( 'id_centro_estudio' );
	$table->index ( 'id_entidad_registra_grado' );
	$table->index ( 'id_carrera' );
	$table->index ( 'id_persona' );
	$table->index ( 'id_pais_centro_estudio' );
	$table->index ( 'id_estado_estudio' );
	
	$table->foreign ( 'id_grado', 'fk_estudio_grado1_idx' )->references ( 'id' )->on ( 'esc_grado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_centro_estudio', 'fk_estudio_centro_estudio1_idx' )->references ( 'id' )->on ( 'esc_centro_estudio' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_entidad_registra_grado', 'fk_estudio_entidad_registra_grado1_idx' )->references ( 'id' )->on ( 'esc_entidad_registra_grado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_carrera', 'fk_estudio_especialidad1_idx' )->references ( 'id' )->on ( 'esc_carrera' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_persona', 'fk_estudio_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_pais_centro_estudio', 'fk_estudio_pais1_idx' )->references ( 'id' )->on ( 'esc_pais' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_estado_estudio', 'fk_estudio_estado_estudio1_idx' )->references ( 'id' )->on ( 'esc_estado_estudio' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 051.
 * esc_cargo
 */
Schema::create ( 'esc_cargo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->char ( 'oficina', 3 );
	$table->string ( 'descripcion', 60 );
	$table->char ( 'nuevo_codigo', 2 )->comment ( 'newcodigo de cargos administrativos' );
	$table->char ( 'codigo', 2 )->nullable ();
	// Indexes
} );

/**
 * 052.
 * esc_cargo_administrativo
 */
Schema::create ( 'esc_cargo_administrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'Identifica al empleado al cual se le asigna cargo de funcion administrativa.' );
	$table->integer ( 'id_cargo' )->comment ( 'Identifica al cargo que se le asigna al empleado.' );
	$table->string ( 'numero_res_rect', 10 )->nullable ()->comment ( 'Señala la resolución con la cual se le asigna el cargo.' );
	$table->date ( 'fecha_inicio' )->nullable ()->comment ( 'Fecha desde la que inicia a desempeñar el cargo administrativo.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha en a que culmina sus labores en el cargo administrativo.' );
	$table->text ( 'observaciones' )->nullable ();
	$table->tinyInteger ( 'es_activo' )->comment ( 'Indica si es un cargo activo.
1 = Activo,
2 = NO Activo.' );
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_cargo' );
	
	$table->foreign ( 'id_empleado', 'fk_cargo_administrativo_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_cargo', 'fk_cargo_administrativo_cargo1_idx' )->references ( 'id' )->on ( 'esc_cargo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 053.
 * esc_experiencia_laboral
 */
Schema::create ( 'esc_experiencia_laboral', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica la persona que registra experiencia laboral fuera de la UNAP.' );
	$table->string ( 'institucion', 100 )->comment ( 'Registra el nombre de la institucion en la cual laboró.
' );
	$table->string ( 'documento', 45 )->comment ( 'Registra el documento que acredita experiencia laboral.' );
	$table->string ( 'cargo', 45 )->comment ( 'Registra el cargo que ocupó en la institución donde laboró.' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha en la que empezó a laborar en la intitución.' );
	$table->date ( 'fecha_final' )->comment ( 'Fecha en la que culminó sus labores en la institución.' );
	$table->text ( 'funciones' )->nullable ()->comment ( 'Describe las funciones que realizó en la institución.' );
	// Indexes
	$table->index ( 'id_persona' );
	
	$table->foreign ( 'id_persona', 'fk_experiencia_laboral_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 054.
 * esc_tipo_capacitacion
 */
Schema::create ( 'esc_tipo_capacitacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'descripcion', 45 )->comment ( 'Indica el nombre del tipo de capacitacion.' );
	// Indexes
} );

/**
 * 055.
 * esc_capacitacion
 */
Schema::create ( 'esc_capacitacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' )->comment ( 'Identifica a la persona que registra capacitación.' );
	$table->integer ( 'id_tipo_capacitacion' )->comment ( 'Identifica el tipo de capacitacion que registra.' );
	$table->string ( 'institucion', 100 )->comment ( 'Señala la entidad en la cual se realizó la capacitación.' );
	$table->string ( 'descripcion', 100 )->comment ( 'Especifica el nombre de la capacitacion' );
	$table->date ( 'fecha_inicio' )->comment ( 'Fecha en la que inicio la capacitacion.' );
	$table->date ( 'fecha_final' )->nullable ()->comment ( 'Fecha en la que finalizo la capacitacion.' );
	$table->integer ( 'horas' )->comment ( 'Señala el numero de horas de capacitacion acumuladas.' );
	$table->string ( 'condicion', 30 )->comment ( 'Especifica que funcion cumplio en la capacitacion.
' );
	// Indexes
	$table->index ( 'id_tipo_capacitacion' );
	$table->index ( 'id_persona' );
	
	$table->foreign ( 'id_tipo_capacitacion', 'fk_capacitacion_tipo_capacitacion1_idx' )->references ( 'id' )->on ( 'esc_tipo_capacitacion' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_persona', 'fk_capacitacion_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 056.
 * esc_reconocimiento_grado
 */
Schema::create ( 'esc_reconocimiento_grado', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_estudio' )->comment ( 'Identifica al estudio extranjero que se hara reconocer.' );
	$table->integer ( 'id_entidad_registra_grado' )->comment ( 'Identifica a la entidad responsable que puede emitir el reconocimiento de grado.' );
	$table->string ( 'numero_resolucion', 45 )->comment ( 'Numero de Resolucion con la cual se le reconoce el grado.' );
	$table->string ( 'fecha_emision', 45 )->comment ( 'Fecha de emision de Resolucion que reconoce grado.' );
	$table->tinyInteger ( 'esRevalidado' )->comment ( 'Establece si el grado ha sido revalidado por una universidad peruana.' );
	// Indexes
	$table->index ( 'id_entidad_registra_grado' );
	$table->index ( 'id_estudio' );
	
	$table->foreign ( 'id_entidad_registra_grado', 'fk_reconocimiento_grado_entidad_registra_grado1_idx' )->references ( 'id' )->on ( 'esc_entidad_registra_grado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_estudio', 'fk_esc_reconocimiento_grado_esc_estudio1_idx' )->references ( 'id' )->on ( 'esc_estudio' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 057.
 * esc_datos_beneficiario
 */
Schema::create ( 'esc_datos_beneficiario', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_familiar' );
	$table->integer ( 'id_banco' )->comment ( 'Identifica al Banco que corresponde el numero de cuenta del beneficiario.' );
	$table->string ( 'numero_cuenta', 20 )->comment ( 'Numero de Cuenta en el Banco del beneficiario.' );
	$table->string ( 'telefono', 10 )->nullable ()->comment ( 'Indica el numero telefonico o celular.' );
	$table->string ( 'direccion', 60 )->nullable ()->comment ( 'Indica la direccion de residencia del beneficiario' );
	$table->string ( 'documento', 30 )->nullable ()->comment ( 'Indica el documento con el cual se hace beneficiario de la persona.' );
	$table->float ( 'monto' )->nullable ()->comment ( 'Indica el monto con el cual se beneficia.' );
	$table->integer ( 'porcentaje' )->nullable ()->comment ( 'Indica el porcentaje de beneficio.' );
	$table->string ( 'observacion', 100 )->nullable ();
	$table->string ( 'es_activo', 45 )->nullable ()->comment ( '1 = Es Activo
2 = NO es activo.' );
	// Indexes
	$table->index ( 'id_banco' );
	$table->index ( 'id_familiar' );
	
	$table->foreign ( 'id_banco', 'fk_esc_datos_beneficiario_esc_banco1_idx' )->references ( 'id' )->on ( 'esc_banco' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_familiar', 'fk_esc_datos_beneficiario_esc_familiar1_idx' )->references ( 'id' )->on ( 'esc_familiar' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 058.
 * esc_foto_persona
 */
Schema::create ( 'esc_foto_persona', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_persona' );
	$table->string ( 'archivo', 60 );
	$table->date ( 'fecha_actualizado' );
	// Indexes
	$table->index ( 'id_persona' );
	
	$table->foreign ( 'id_persona', 'fk_esc_foto_persona_esc_persona1_idx' )->references ( 'id' )->on ( 'esc_persona' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 059.
 * uca_sync_marcas
 */
Schema::create ( 'uca_sync_marcas', function (Blueprint $table) {
	$table->increments ( 'syncmarcas_cod' );
	$table->char ( 'person_cod', 11 );
	$table->tinyInteger ( 'syncmarcas_modverify' );
	$table->tinyInteger ( 'syncmarcas_entsal' );
	$table->tinyInteger ( 'syncmarcas_workcode' );
	$table->date ( 'syncmarcas_fecha' );
	$table->time ( 'syncmarcas_hora' );
	$table->char ( 'syncequipo_cod', 3 );
	$table->char ( 'fac_cod', 3 );
	$table->integer ( 'esc_cod' );
	$table->char ( 'syncmarcas_horana', 1 );
	$table->char ( 'syncmarcas_state', 1 );
	$table->char ( 'pabellon_cod', 3 );
	// Indexes
} );

/**
 * 060.
 * uca_grupo
 */
Schema::create ( 'uca_grupo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 8 );
	$table->string ( 'abreviacion', 2 );
	// Indexes
} );

/**
 * 061.
 * uca_semestre
 */
Schema::create ( 'uca_semestre', function (Blueprint $table) {
	$table->increments ( 'id' )->comment ( 'Identificador del semestre' );
	$table->string ( 'nombre', 15 )->comment ( 'Nombre del semestre academico' );
	$table->string ( 'abreviacion', 4 )->comment ( 'Abreviacion del semestre' );
	// Indexes
} );

/**
 * 062.
 * uca_curso
 */
Schema::create ( 'uca_curso', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'cod_curso_oti', 3 );
	$table->text ( 'nombre' );
	$table->integer ( 'cod_especialidad' );
	$table->integer ( 'id_unidad_ep' );
	$table->integer ( 'id_semestre' );
	// Indexes
	$table->index ( 'id_semestre' );
	$table->index ( 'id_unidad_ep' );
	
	$table->foreign ( 'id_semestre', 'con_semestre_idx' )->references ( 'id' )->on ( 'uca_semestre' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_unidad_ep', 'fk_cursos_unidad1_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 063.
 * uca_turno
 */
Schema::create ( 'uca_turno', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 100 );
	$table->text ( 'descripcion' )->nullable ();
	// Indexes
} );

/**
 * 064.
 * uca_horario_docente
 */
Schema::create ( 'uca_horario_docente', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->char ( 'pln_est', 2 );
	$table->integer ( 'id_cursos' );
	$table->integer ( 'id_grupo' );
	$table->string ( 'cod_dia', 1 );
	$table->string ( 'hrs_ini', 2 );
	$table->string ( 'hrs_fin', 2 );
	$table->char ( 'cant_horas', 1 )->nullable ()->comment ( 'Cantidad de horas por dia del curso' );
	$table->integer ( 'id_empleado' );
	$table->enum ( 'estado', [ 
			'0',
			'1' 
	] )->default ( '1' )->comment ( '0=inactivo
1=acivo' );
	$table->integer ( 'id_periodo' );
	$table->integer ( 'id_turno' );
	$table->char ( 'aula', 3 )->nullable ()->comment ( 'Numero  de aula donde dicta clases el docente' );
	$table->enum ( 'tipo_aula', [ 
			'0',
			'1' 
	] )->nullable ()->comment ( '0 = Salon de diactado de clases
1 = Laboratorio' );
	$table->dateTime ( 'fecha_registro' );
	// Indexes
	$table->index ( 'id_periodo' );
	$table->index ( 'id_grupo' );
	$table->index ( 'id_cursos' );
	$table->index ( 'id_turno' );
	$table->index ( 'id_empleado' );
	
	$table->foreign ( 'id_periodo', 'horario_semestre_idx' )->references ( 'id' )->on ( 'esc_periodo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_grupo', 'con_grupos_idx' )->references ( 'id' )->on ( 'uca_grupo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_cursos', 'con_curso_idx' )->references ( 'id' )->on ( 'uca_curso' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_turno', 'con_turno_horario_docente_idx' )->references ( 'id' )->on ( 'uca_turno' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_empleado', 'fk_horario_docente_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 065.
 * uca_estado_asistencia
 */
Schema::create ( 'uca_estado_asistencia', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 45 );
	$table->string ( 'anexo_17', 45 )->nullable ()->comment ( 'especificacion para la asistencia del anexo 17' );
	$table->text ( 'descripcion' )->nullable ();
	// Indexes
} );

/**
 * 066.
 * uca_asistencia_docente
 */
Schema::create ( 'uca_asistencia_docente', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'entrada_lugar_picar' );
	$table->integer ( 'salida_lugar_picar' );
	$table->integer ( 'id_semestre' )->comment ( 'Id del semestre academico' );
	$table->integer ( 'id_empleado' );
	$table->integer ( 'id_cambio_horario' );
	$table->dateTime ( 'hora_entrada' )->nullable ()->comment ( 'Hora de entrada del docente' );
	$table->dateTime ( 'hora_salida' )->nullable ()->comment ( 'Hora de entrada del docente' );
	$table->char ( 'id_estado_asistencia', 1 )->comment ( '0=falta
1=asistió
2=tarde
3=abandono' );
	$table->integer ( 'id_horario_docente' );
	$table->string ( 'ref_control_biometrico', 100 )->nullable ()->comment ( 'codigos de control biometrico ejm(cod1/cod2/cod3)' );
	$table->dateTime ( 'fecha' );
	// Indexes
	$table->index ( 'id_semestre' );
	$table->index ( 'id_horario_docente' );
	$table->index ( 'id_estado_asistencia' );
	$table->index ( 'entrada_lugar_picar' );
	$table->index ( 'salida_lugar_picar' );
	
	$table->foreign ( 'id_semestre', 'asistencia_semestre_idx' )->references ( 'id' )->on ( 'esc_periodo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_horario_docente', 'cambio_idx' )->references ( 'id' )->on ( 'uca_horario_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_estado_asistencia', 'con_estado_asistencia_idx' )->references ( 'id' )->on ( 'uca_estado_asistencia' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'entrada_lugar_picar', 'fk_asistencia_docente_unidad1_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'salida_lugar_picar', 'fk_asistencia_docente_unidad2_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 067.
 * uca_tipo_reprogramacion
 */
Schema::create ( 'uca_tipo_reprogramacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 100 )->nullable ();
	$table->text ( 'descripcion' )->nullable ();
	// Indexes
} );

/**
 * 068.
 * uca_reprogramacion
 */
Schema::create ( 'uca_reprogramacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'hora_ini', 2 )->nullable ();
	$table->string ( 'hora_fin', 2 )->nullable ();
	$table->integer ( 'tipo' );
	$table->char ( 'cod_dia', 1 )->nullable ();
	$table->integer ( 'id_asistencia' );
	$table->date ( 'fecha' );
	// Indexes
	$table->index ( 'tipo' );
	$table->index ( 'id_asistencia' );
	
	$table->foreign ( 'tipo', 'tipo_programacion_idx' )->references ( 'id' )->on ( 'uca_tipo_reprogramacion' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_asistencia', 'asistencia_programacion_idx' )->references ( 'id' )->on ( 'uca_asistencia_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 069.
 * uca_turno_adminitrativo
 */
Schema::create ( 'uca_turno_adminitrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre_turno', 150 )->nullable ()->comment ( 'nombre del turno (ejm: seguridad noche)' );
	$table->string ( 'dias', 7 )->nullable ()->comment ( 'dias que labora el personal (1=lunes, martes=2) ejm: 12345' );
	$table->string ( 'rotacion', 3 )->nullable ()->comment ( 'rotacion de turno (ejm: 15 dias)' );
	$table->text ( 'observacion' )->nullable ();
	// Indexes
} );

/**
 * 070.
 * uca_horario_administrativo
 */
Schema::create ( 'uca_horario_administrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' );
	$table->enum ( 'estado', [ 
			'0',
			'1' 
	] )->default ( '1' )->comment ( '0=inactivo
1=activo' );
	$table->integer ( 'id_turno_administrativo' );
	$table->dateTime ( 'fecha' );
	// Indexes
	$table->index ( 'id_empleado' );
	$table->index ( 'id_turno_administrativo' );
	
	$table->foreign ( 'id_empleado', 'fk_horario_administrativo_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_turno_administrativo', 'turno_admin_horario_adm_idx' )->references ( 'id' )->on ( 'uca_turno_adminitrativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );
/**
 * 071.
 * uca_asistencia_administrativo
 */
Schema::create ( 'uca_asistencia_administrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'cod_horario_administrativo' );
	$table->time ( 'hora_entrada' )->nullable ();
	$table->time ( 'hora_salida' )->nullable ();
	$table->char ( 'id_estado_asistencia', 1 )->comment ( '0=falta
1=asistió
2=tarde
3=abandono' );
	$table->integer ( 'id_unidad' )->comment ( 'Id de la unidad (lugares de trabajo)' );
	$table->dateTime ( 'fecha' )->nullable ();
	$table->integer ( 'entrada_lugar_picar' );
	$table->integer ( 'salida_lugar_picar' );
	// Indexes
	$table->index ( 'cod_horario_administrativo' );
	$table->index ( 'id_estado_asistencia' );
	$table->index ( 'entrada_lugar_picar' );
	$table->index ( 'salida_lugar_picar' );
	
	$table->foreign ( 'cod_horario_administrativo', 'con_horario_administrativo_idx' )->references ( 'id' )->on ( 'uca_horario_administrativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_estado_asistencia', 'con_estado_asistencia_idx' )->references ( 'id' )->on ( 'uca_estado_asistencia' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'entrada_lugar_picar', 'fk_asistencia_administrativo_unidad1_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'salida_lugar_picar', 'fk_asistencia_administrativo_unidad2_idx' )->references ( 'id' )->on ( 'esc_unidad' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 072.
 * uca_supervision
 */
Schema::create ( 'uca_supervision', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' )->comment ( 'codigo del empleado' );
	$table->integer ( 'id_asistencia_docente' );
	$table->char ( 'id_estado_asistencia', 1 );
	$table->enum ( 'estado', [ 
			'0',
			'1' 
	] )->comment ( '0=no imprimido
1=imprimido' );
	$table->string ( 'min_retraso', 3 )->nullable ()->comment ( 'minutos de retraso del docente' );
	$table->time ( 'hora_abandono' )->nullable ()->comment ( 'hora de abandono del docente' );
	$table->dateTime ( 'fecha_hora' )->comment ( 'fecha y hora de supervicion' );
	$table->string ( 'avance_academico', 3 )->nullable ()->comment ( 'porcentaje en avance académico' );
	$table->string ( 'unidad_didactica', 2 )->nullable ()->comment ( 'corresponde a la unidad didactica' );
	$table->text ( 'observacion' )->nullable ()->comment ( 'observacion del supervisor' );
	// Indexes
	$table->index ( 'id_asistencia_docente' );
	$table->index ( 'id_estado_asistencia' );
	
	$table->foreign ( 'id_asistencia_docente', 'con_asistencia_docente_idx' )->references ( 'id' )->on ( 'uca_asistencia_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_estado_asistencia', 'con_estado_asistencia_idx' )->references ( 'id' )->on ( 'uca_estado_asistencia' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 073.
 * uca_tipo_justificacion
 */
Schema::create ( 'uca_tipo_justificacion', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 100 );
	$table->text ( 'descripcion' )->nullable ();
	// Indexes
} );

/**
 * 074.
 * uca_proceso
 */
Schema::create ( 'uca_proceso', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 100 );
	$table->text ( 'descripcion' );
	// Indexes
} );

/**
 * 075.
 * uca_expediente
 */
Schema::create ( 'uca_expediente', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' );
	$table->string ( 'nro_expediente', 10 );
	$table->string ( 'folios', 2 )->nullable ();
	$table->text ( 'asunto' );
	$table->integer ( 'id_proceso' );
	$table->dateTime ( 'fecha_registro' );
	// Indexes
	$table->index ( 'id_proceso' );
	$table->index ( 'id_empleado' );
	
	$table->foreign ( 'id_proceso', 'expediente_procesos_idx' )->references ( 'id' )->on ( 'uca_proceso' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_empleado', 'fk_expediente_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 076.
 * uca_justificacion_docente
 */
Schema::create ( 'uca_justificacion_docente', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_asistencia_docente' );
	$table->integer ( 'id_expediente' )->comment ( 'id del expediente (estado del tramite)' );
	$table->enum ( 'estado_justificacion', [ 
			'0',
			'1',
			'2' 
	] )->default ( '2' )->comment ( '0=rechasado
1=aceptado
2=pendiente' );
	$table->integer ( 'id_empleado' );
	$table->integer ( 'id_tipo_justificacion' );
	$table->dateTime ( 'fecha' )->nullable ();
	// Indexes
	$table->index ( 'id_asistencia_docente' );
	$table->index ( 'id_tipo_justificacion' );
	$table->index ( 'id_empleado' );
	$table->index ( 'id_expediente' );
	
	$table->foreign ( 'id_asistencia_docente', 'asistencia_docente_justificacion_idx' )->references ( 'id' )->on ( 'uca_asistencia_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_tipo_justificacion', 'tpo_justificacion_justificacion_idx' )->references ( 'id' )->on ( 'uca_tipo_justificacion' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_empleado', 'fk_justificacion_docente_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_expediente', 'expediente_justificacion_docente_idx' )->references ( 'id' )->on ( 'uca_expediente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 077.
 * uca_justificacion_administrativo
 */
Schema::create ( 'uca_justificacion_administrativo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_asistencia_administrativo' );
	$table->string ( 'doc_justificacion', 150 )->nullable ();
	$table->enum ( 'estado_justificacion', [ 
			'0',
			'1',
			'2' 
	] )->default ( '2' )->comment ( '0=rechasado
1=aceptado
2=pendiente' );
	$table->integer ( 'id_responsable' );
	$table->integer ( 'id_tipo_justificacion' );
	$table->dateTime ( 'fecha' );
	$table->integer ( 'empleado_id_empleado' );
	// Indexes
	$table->index ( 'id_tipo_justificacion' );
	$table->index ( 'id_asistencia_administrativo' );
	$table->index ( 'empleado_id_empleado' );
	
	$table->foreign ( 'id_tipo_justificacion', 'tipo_justificacion_asistencia_administrativo_idx' )->references ( 'id' )->on ( 'uca_tipo_justificacion' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_asistencia_administrativo', 'tipo_justificacion_asistencia_administrativo_idx1' )->references ( 'id' )->on ( 'uca_asistencia_administrativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'empleado_id_empleado', 'fk_justificacion_administrativo_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 078.
 * uca_suspension
 */
Schema::create ( 'uca_suspension', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->dateTime ( 'inicio' )->comment ( 'inicio de la fecha y hora de suspencion' );
	$table->dateTime ( 'final' )->nullable ()->comment ( 'fecha y hora final de la suspencion' );
	$table->integer ( 'id_empleado_bloquea' );
	$table->text ( 'obsevacion' )->nullable ();
	$table->dateTime ( 'fecha_registro' )->comment ( 'fecha de registro' );
	// Indexes
	$table->index ( 'id_empleado_bloquea' );
	
	$table->foreign ( 'id_empleado_bloquea', 'fk_suspenciones_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 079.
 * uca_requisito
 */
Schema::create ( 'uca_requisito', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'nombre', 45 );
	$table->integer ( 'id_proceso' );
	// Indexes
	$table->index ( 'id_proceso' );
	
	$table->foreign ( 'id_proceso', 'requisitos_procesos_idx' )->references ( 'id' )->on ( 'uca_proceso' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 080.
 * uca_tramite
 */
Schema::create ( 'uca_tramite', function (Blueprint $table) {
	$table->increments ( 'id' )->nullable ();
	$table->integer ( 'usuario_inicio' );
	$table->integer ( 'usuario_final' );
	$table->tinyInteger ( 'estado' )->default ( '2' )->comment ( '0=rechasado
1=aceptado
2=pendiente
3=archivar
4=derivar' );
	$table->text ( 'observacion' )->nullable ()->comment ( 'observacion en el tramite' );
	$table->integer ( 'id_expediente' );
	$table->dateTime ( 'fecha' )->comment ( 'fecha de registro' );
	// Indexes
	$table->index ( 'id_expediente' );
	$table->index ( 'usuario_inicio' );
	$table->index ( 'usuario_final' );
	
	$table->foreign ( 'id_expediente', 'tramites_expediente_idx' )->references ( 'id' )->on ( 'uca_expediente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'usuario_inicio', 'fk_tramites_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'usuario_final', 'fk_tramites_empleado2_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 081.
 * uca_reporte_uca
 */
Schema::create ( 'uca_reporte_uca', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_empleado' );
	$table->text ( 'observaciones' )->comment ( 'observaciones en el reporte' );
	$table->string ( 'falta', 2 )->nullable ()->comment ( 'faltas del empleado' );
	$table->string ( 'asistencia', 2 )->nullable ()->comment ( 'Asistencias del empleado' );
	$table->string ( 'retencion_pago', 2 )->nullable ()->comment ( 'Retención de Pago' );
	$table->string ( 'reintegros', 2 )->nullable ()->comment ( 'Rintegros' );
	$table->string ( 'susp_sin_goce', 2 )->nullable ()->comment ( 'suspencion sin goce de remuneraciones' );
	$table->string ( 'licen_sin_goce', 2 )->nullable ()->comment ( 'Licencias sin goce de remuneraciones' );
	$table->string ( 'dias_pago', 2 )->comment ( 'Dias pagados del empleado' );
	$table->dateTime ( 'fecha' )->comment ( 'fecha que se genero el reporte' );
	// Indexes
	$table->index ( 'id_empleado' );
	
	$table->foreign ( 'id_empleado', 'fk_reporte_uca_empleado1_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 082.
 * uca_reporte_osea
 */
Schema::create ( 'uca_reporte_osea', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'codigo_docente' )->comment ( 'codigo del docente' );
	$table->integer ( 'id_asistencia_docente' )->comment ( 'id de la asitencia del docente' );
	$table->integer ( 'horario_docente' )->comment ( 'horario docente' );
	$table->dateTime ( 'fecha' )->nullable ();
	// Indexes
	$table->index ( 'codigo_docente' );
	$table->index ( 'id_asistencia_docente' );
	$table->index ( 'horario_docente' );
	
	$table->foreign ( 'codigo_docente', 'empleado_reporte_osea_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_asistencia_docente', 'asist_docente_reporte_osea_idx' )->references ( 'id' )->on ( 'uca_asistencia_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'horario_docente', 'horario_docente_report_osea_idx' )->references ( 'id' )->on ( 'uca_horario_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 083.
 * uca_temas_desarrollo
 */
Schema::create ( 'uca_temas_desarrollo', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_horario_docente' )->comment ( 'id del horario del docente' );
	$table->integer ( 'codigo_docente' )->comment ( 'codigo del docente' );
	$table->text ( 'tema' )->nullable ()->comment ( 'temas que desarrolla el docente' );
	$table->date ( 'fecha_desarrollo' )->nullable ()->comment ( 'fecha que se desarrolla el tema' );
	$table->dateTime ( 'fecha' );
	// Indexes
	$table->index ( 'id_horario_docente' );
	$table->index ( 'codigo_docente' );
	
	$table->foreign ( 'id_horario_docente', 'horario_docente_temas_desarrolllo_idx' )->references ( 'id' )->on ( 'uca_horario_docente' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'codigo_docente', 'empleado_temas_desarrollo_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 084.
 * uca_horarios
 */
Schema::create ( 'uca_horarios', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'hrs_ini', 2 )->comment ( 'hora de inicio del horario' );
	$table->string ( 'hrs_fin', 2 )->comment ( 'hora de final del horario' );
	// Indexes
} );

/**
 * 085.
 * uca_horarios_turno
 */
Schema::create ( 'uca_horarios_turno', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->integer ( 'id_horarios' );
	$table->integer ( 'id_turno' );
	// Indexes
	$table->index ( 'id_horarios' );
	$table->index ( 'id_turno' );
	
	$table->foreign ( 'id_horarios', 'horarios_turno_administrativo_idx' )->references ( 'id' )->on ( 'uca_horarios' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
	
	$table->foreign ( 'id_turno', 'turno_admin_horario_turno_idx' )->references ( 'id' )->on ( 'uca_turno_adminitrativo' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );
/**
 * 086.
 * uca_tolerancia
 */
Schema::create ( 'uca_tolerancia', function (Blueprint $table) {
	$table->increments ( 'id' );
	$table->string ( 'puntual_adm', 7 )->comment ( 'tolerancia cuando es puntual (ejm: -15|+5) en minutos a partir de la entrada' );
	$table->string ( 'tardanza_adm', 7 )->comment ( 'tolerancia cuando es tardanza (ejm: +15|+30) en minutos a partir de la entrada' );
	$table->string ( 'falta_adm', 7 )->comment ( 'para faltas (ejm: +31|-1) en minutos a partir de la entrada| en base a la salida' );
	$table->string ( 'abandono_adm', 7 )->comment ( 'para abandonos (ejm: -5|+60) en minutos a partir de la salida' );
	$table->string ( 'puntual_doc', 7 )->comment ( 'tolerancia cuando es puntual (ejm: -15|+5) en minutos a partir de la entrada' );
	$table->string ( 'tardanza_doc', 7 )->comment ( 'tolerancia cuando es tardanza (ejm: +15|+30) en minutos a partir de la entrada' );
	$table->string ( 'falta_doc', 7 )->comment ( 'para faltas (ejm: +31|-1) en minutos a partir de la entrada| en base a la salida' );
	$table->string ( 'abandono_doc', 7 )->comment ( 'para abandonos (ejm: -5|+60) en minutos a partir de la salida' );
	$table->integer ( 'id_empleado' )->comment ( 'Id del empleado que cambia las tolerancias' );
	// Indexes
	$table->index ( 'id_empleado' );
	
	$table->foreign ( 'id_empleado', 'empleado_tolerancias_idx' )->references ( 'id' )->on ( 'esc_empleado' )->onDelete ( 'no action' )->onUpdate ( 'no action' );
} );

/**
 * 087.
 * uca_sync_equipo
 */
Schema::create ( 'uca_sync_equipo', function (Blueprint $table) {
	$table->increments ( 'syncequipo_cod' );
	$table->string ( 'syncequipo_deno', 30 )->nullable ();
	$table->string ( 'syncequipo_mac', 32 )->nullable ();
	$table->string ( 'syncequipo_serie', 15 )->nullable ();
	$table->string ( 'syncequipo_ip', 20 )->nullable ();
	$table->integer ( 'syncequipo_machinenumber' )->nullable ();
	$table->string ( 'esc_cod', 2 )->nullable ();
	$table->string ( 'fac_cod', 3 )->nullable ();
	$table->string ( 'syncequipo_estado', 1 )->nullable ()->default ( 'A' );
	$table->string ( 'user_cod', 15 )->nullable ();
	$table->string ( 'pabellon_cod', 3 )->nullable ()->default ( '000' );
	// Indexes
} );
	

