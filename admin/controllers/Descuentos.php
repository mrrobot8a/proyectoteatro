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
Editor::inst( $db, 'descuentos' )
	->fields(
		Field::inst( 'idDescuento' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
			) ),
		Field::inst( 'nombreDescuento' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
			) ),
			Field::inst( 'valorDescuento' )
			->validator( Validate::numeric() )
			->setFormatter( Format::ifEmpty(null) ),
				
		
			Field::inst( 'DescriptionDescuento' )
			->validator( Validate::notEmpty() )
			->setFormatter( Format::ifEmpty(null) ),

			Field::inst( 'fecha' )
            ->validator( Validate::dateFormat( 'Y-m-d' ) )
            ->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
            ->setFormatter( Format::dateFormatToSql('Y-m-d' ) ),
			
			
			
	)
    
	->process( $_POST )
	->json();
