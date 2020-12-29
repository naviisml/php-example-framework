<?php

namespace Navel\Helpers;

class File
{
    public function find( $file )
    {
        //
        return $file;
    }

    public function delete( $file )
    {
        if( is_array( $files = $file ) ) {
            // Loop through array, execute $this->delete( $file )
        }

        if( !self::find( $file ) ) {
            // File doesnt exist
        }

        // Delete file
        return true;
    }
}
