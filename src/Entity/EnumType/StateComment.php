<?php
namespace App\Entity;
enum StateComment: string
{
    case toValidate = "TO VALIDATE";
    case reported = "REPORTED";
    case archived = "ARCHIVED";

    //Enumérer les état des avis à rentrer
}