<?php
namespace App\Enums;

enum Role:string {
    case ScrumMaster = 'scrum_master';
    case ProductOwner = 'product_owner';
    case Developer = 'developer';
    case Admin = 'admin';
}
