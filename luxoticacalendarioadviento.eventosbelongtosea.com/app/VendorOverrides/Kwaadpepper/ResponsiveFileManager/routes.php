<?php
/**
 * RFM Routes registering
 * @author   Jeremy Munsch <kwaadpepper@users.noreply.github.com>
 * @license  MIT https://choosealicense.com/licenses/mit/
 * @version  GIT:
 * @link     https://github.com/Kwaadpepper/laravel-responsivefilemanager/blob/master/src/routes.php
 */
$FM_ROUTE_PREFIX = "/admin/filemanager/";
$FM_ROUTES = ['ajax_calls.php' => ['get', 'post'],
                'dialog.php' => ['get'],
                'execute.php' => ['post'],
                'force_download.php' => ['post'],
                'fview.php' => ['get'],
                'upload.php' => ['get', 'post'], ];

$FMPATH = base_path('vendor/kwaadpepper/laravel-responsivefilemanager/src/Http');
require_once $FMPATH.'/boot.php';

// Routes For Responsive API and Web (dialog.php)
Route::group(
    ['middleware' => ['web', 'auth', 'permission:admin.access.structure.activity|admin.access.structure.category']],
    function () use ($FM_ROUTE_PREFIX, $FM_ROUTES) {
        foreach ($FM_ROUTES as $file => $method) {
            Route::match(
                $method,
                $FM_ROUTE_PREFIX.$file,
                function () use ($file) {
                    $FMPATH = base_path('vendor/kwaadpepper/laravel-responsivefilemanager/src/Http');
                    if ($file == 'ajax_calls.php') {
                        include $file;
                    } else {
                        include $FMPATH . '/../Http/'.$file;
                    }

                    return ;
                }
            )->name('FM'.$file);
        }
    }
);
