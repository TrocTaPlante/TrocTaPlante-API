<?php
namespace App\Entity;
enum SourceReporting: string
{
    case post = "POST";
    case message = "MESSAGE";
    case review = "REVIEW";
}