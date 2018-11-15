<?php
$args = explode("=", rtrim($_SERVER['QUERY_STRING']));
$method = array_shift($args);
switch ($_SESSION['roll_id']) {
    case 1:
        switch ($method) {
            case 'view':
                include_once "user/view_ticket.php";
                break;
            case 'settings':
                include_once "user/settings.php";
                break;
            case 'password':
                include_once "user/password.php";
                break;
            case 'logout':
                include_once "user/logout.php";
                break;
            case 'delete':
                include_once "user/delete_ticket.php";
                break;
            case 'all_tickets':
                include_once "admin/all_tickets.php";
                break;
            case 'units':
            case 'unit_response':
            case 'edit_response':
                include_once "admin/units.php";
                break;
            case 'users':
            case 'block_response':
            case 'unblock_response':
            case 'sremove':
            case 'eremove':
            case 'adminuser':
                include_once "admin/users.php";
                break;
            case 'block':
            case 'unblock':
                include_once "admin/users_block.php";
                break;
            case 'remove':
                include "admin/remove.php";
                break;
            case 'remove_unit':
                include_once "admin/remove_unit.php";
                break;
            case 'edit_unit':
                include_once "admin/edit.php";
                break;
            case 'unblock_message':
            case 'block_message':
            case 'open':
            case 'close':
                include_once "support/message_operators.php";
                break;
            case 'message':
                $db->redirectMethod($db->internalUrl("")."/panel.php?all_tickets");
                break;
            default:
                include_once "admin/tickets.php";
        }
        break;
    case 2:
        switch ($method) {
            case 'view':
                include_once "user/view_ticket.php";
                break;
            case 'settings':
                include_once "user/settings.php";
                break;
            case 'password':
                include_once "user/password.php";
                break;
            case 'logout':
                include_once "user/logout.php";
                break;
            case 'users':
            case 'block_response':
            case 'unblock_response':
            case 'sremove':
            case 'eremove':
            case 'adminuser':
                include_once "admin/users.php";
                break;
            case 'block':
            case 'unblock':
                include_once "admin/users_block.php";
                break;
            case 'remove':
                include "admin/remove.php";
                break;
            case 'delete':
                include_once "user/delete_ticket.php";
                break;
            case 'unblock_message':
            case 'block_message':
            case 'open':
            case 'close':
                include_once "support/message_operators.php";
                break;
            default:
                include_once "support/all_tickets.php";
        }
        break;
    default:
        switch ($method) {
            case 'add_ticket':
                include_once "user/add_ticket.php";
                break;
            case 'view':
                include_once "user/view_ticket.php";
                break;
            case 'settings':
                include_once "user/settings.php";
                break;
            case 'password':
                include_once "user/password.php";
                break;
            case 'logout':
                include_once "user/logout.php";
                break;
            case 'delete':
                include_once "user/delete_ticket.php";
                break;
            case 'open':
            case 'close':
                include_once "support/message_operators.php";
                break;
            default:
                include_once "user/all_tickets.php";
        }
}