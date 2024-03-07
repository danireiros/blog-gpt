<?php

use App\Models\AuthorGeneral;

function getStep(AuthorGeneral $authorGeneral = null) {
    if(!$authorGeneral)
        return 1;
    
    if(!$authorGeneral->company && $authorGeneral->type == 'company')
        return 2.5;

    if(!$authorGeneral->person && $authorGeneral->type == 'person')
        return 2;

    if(!$authorGeneral->detail)
        return 3;

    return 4;
}