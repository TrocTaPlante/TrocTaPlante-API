<?php
namespace App\Entity;
enum StatePlant: string
{
    case sprout = "SPROUT";
    case cutting = "CUTTING";
    case baby = "BABY PLANT";
    case adult = "ADULT PLANT";
}