

Having issues with pictures which won't open in browser or getting 404 / 403? Try:
chmod($this->imagedir .$imgNewName.$ext, 0644);
        chmod($this->thumbdir.$name.$ext, 0644);