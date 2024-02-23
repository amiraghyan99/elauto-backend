<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Color extends Model
{
    use HasFactory;

    public function colorTranslationsFromFrToEn = array(
        "Blanc"   => "White",
        "Noir"    => "Black",
        "Rouge"   => "Red",
        "Bleu"    => "Blue",
        "Vert"    => "Green",
        "Jaune"   => "Yellow",
        "Orange"  => "Orange",
        "Violet"  => "Violet/Purple",
        "Rose"    => "Pink",
        "Marron"  => "Brown",
        "Gris"    => "Gray",
        "Beige"   => "Beige"
    );
    
}
