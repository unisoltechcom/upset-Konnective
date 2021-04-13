<?php
if (filter_has_var(INPUT_GET, 'affId')) {
    $_SESSION['affId'] = filter_input(INPUT_GET, 'affId');
}

if (filter_has_var(INPUT_GET, 'c1')) {
    $_SESSION['c1'] = filter_input(INPUT_GET, 'c1');
}

if (filter_has_var(INPUT_GET, 'c2')) {
    $_SESSION['c2'] = filter_input(INPUT_GET, 'c2');
}

if (filter_has_var(INPUT_GET, 'c3')) {
    $_SESSION['c3'] = filter_input(INPUT_GET, 'c3');
}

if (filter_has_var(INPUT_POST, 'email')) {
    $_SESSION['email'] = filter_input(INPUT_POST, 'email');
}

if (filter_has_var(INPUT_POST, 'var')) {
    $_SESSION['var'] = filter_input(INPUT_POST, 'var');
}

if (filter_has_var(INPUT_GET, 'orderId') && filter_input(INPUT_GET, 'orderId') <> '') {
    $_SESSION['orderId'] = filter_input(INPUT_GET, 'orderId');
}