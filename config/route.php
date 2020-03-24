<?php

return [
    // ['reg', 'controller', 'method']
    ['/^login$/',    'UserController', 'login'],
    ['/^logout$/',   'UserController', 'logout'],
    ['/^\/$/',       'FinanceController', 'index'],
    ['/^transfer$/', 'FinanceController', 'transfer'],
];