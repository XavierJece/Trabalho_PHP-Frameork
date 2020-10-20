<?php

namespace src;

use Tuupola\Middleware\JwtAuthentication;

function jwtAuth(): JwtAuthentication
{
    return new JwtAuthentication([
        'secret' => getenv('JWT_SECRET_KEY'),
        'attribute' => 'jwt',
        "error" => function ($response, $arguments) {
            $data["status"] = "error";
            $data["message"] = $arguments["message"];
            return $response
                ->withHeader("Content-Type", "application/json")
                ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        },
        "before" => function ($request, $arguments) {
            return $request->withAttribute("userId", $arguments['decoded']['sub']);
        }
    ]);
}
