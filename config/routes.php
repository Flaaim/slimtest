<?php

declare(strict_types=1);


use App\Http\Action\HomeAction;
use Slim\App;

return static function (App $app): void {
  $app->get('/', HomeAction::class);
};
