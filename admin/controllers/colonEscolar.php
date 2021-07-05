<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;


$db->sql("set names utf8") ;
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'productos' )
	->fields(
		Field::inst( 'nombre' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
			) ),
			Field::inst( 'precio' )
			->validator( Validate::numeric() )
			->setFormatter( Format::ifEmpty(null) ),
			Field::inst( 'idTipo' )
			->validator( Validate::numeric() )
			->setFormatter( Format::ifEmpty(null) ),
			
					Field::inst( 'existencia' )
			->validator( Validate::numeric() )
			->setFormatter( Format::ifEmpty(null) ),
		
			Field::inst( 'Description' )
			->validator( Validate::notEmpty() )
			->setFormatter( Format::ifEmpty(null) ),

			Field::inst( 'fecha' )
            ->validator( Validate::dateFormat(
                'm-d-Y g:i:s A',
                ValidateOptions::inst()
                    ->allowEmpty( false )
            ) )
            ->getFormatter( Format::datetime(
                'Y-m-d H:i:s',
                'm-d-Y g:i:s A'
            ) )
            ->setFormatter( Format::datetime(
                'm-d-Y g:i:s A',
                'Y-m-d H:i:s'
            ) ),
			
			
	)
    ->where('idTipo',2)
	->process( $_POST )
	->json();
