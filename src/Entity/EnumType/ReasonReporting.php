<?php
namespace App\Entity;
enum ReasonReporting: string
{
    case insult = "INSULT";
    case foreign = "FOREIGN LANGUAGE";
    case misspelling = "MISSPELLING";
}
