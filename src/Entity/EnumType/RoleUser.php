<?php
namespace App\Entity;
enum RoleUser: string
{
    case anonymous = "ANONYMOUS";
    case basic = "BASIC USER";
    case moderator = "MODERATOR";
    case administrator = "ADMINISTRATOR";
    case super = "SUPER ADMINISTRATOR";
}