<?php
namespace App\Entity;
enum StatePost: string
{//* Used for state post, state review and state comment
    case unpublished = "UNPUBLISHED";
    case published = "PUBLISHED";
    case traded = "TRADED";
    case deleted = "DELETED";
    case refused = "REFUSED";
}