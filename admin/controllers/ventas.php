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
Editor::inst( $db, 'ventas' )
    ->field(
        Field::inst( 'ventas.' ),
        Field::inst( 'users.last_name' ),
        Field::inst( 'users.phone' ),
        Field::inst( 'users.site' )        
            ->options( Options::inst()
                ->table( 'detalleventas' )
            )
            ->validator( Validate::dbValues() ),
        Field::inst( '*' )
    )
    ->innerJoin( 'where 1=1' )
    ->process($_POST)
    ->json();