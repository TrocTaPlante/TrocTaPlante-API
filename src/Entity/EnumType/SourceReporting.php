<?php
namespace App\Entity;
enum SourceReporting: string
{
    case post = "POST";
    case comment = "COMMENT";
    case review = "REVIEW";
}