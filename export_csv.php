<?php
function array_csv_download( $array, $filename = "export.csv", $delimiter=";" )
{
    header( 'Content-Type: application/csv' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '";' );

    // clean output buffer
    ob_end_clean();
    
    $handle = fopen( 'php://output', 'w' );

    // use keys as column titles
    fputcsv( $handle, array_keys( $array['0'] ) , $delimiter );

    foreach ( $array as $value ) {
        fputcsv( $handle, $value , $delimiter );
    }

    fclose( $handle );

    // flush buffer
    ob_flush();
    
    // use exit to get rid of unexpected output afterward
    exit();
}

$list = array (
  array("Peter", "Griffin" ,"Oslo", "Norway"),
  array("Glenn", "Quagmire", "Oslo", "Norway")
);

array_csv_download( $list, $filename = "export.csv", $delimiter=";" );
?>