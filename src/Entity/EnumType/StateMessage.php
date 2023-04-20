<?php
namespace App\Entity;
enum StateMessage: string
{
    case toValidate = "TO VALIDATE";
    case reported = "REPORTED";
    case archived = "ARCHIVED";

    //Enumérer les état des avis à rentrer
}