<?php

namespace App;

use App\Models\User;

class OAuthUserWrapper
{
    public function __invoke()
    {
        $resourceOwner = request()->attributes->get(config('oauth2login.resource_owner_attribute'))->toArray();

        if (strpos($resourceOwner['name'], ' ') === false) {
            $resourceOwner['first_name'] = $resourceOwner['name'];
            $resourceOwner['last_name'] = null;

        } else {
            [$resourceOwner['first_name'], $resourceOwner['last_name']] = explode(' ', $resourceOwner['name'], 2);
        }

        $user = User::where('email', $resourceOwner['email'])
            ->firstOr( function() use($resourceOwner) {

                return new User(['email' => $resourceOwner['email']]);
            })
            ->fill([
                'first_name' => $resourceOwner['first_name'],
                'last_name' => $resourceOwner['last_name'],
            ])
            ->forceFill([
                'gender' => $resourceOwner['sex'],
                'photo' => $resourceOwner['picture'],
            ]);

        if ($user->isDirty($user->getFillable()) && $user->exists) {
            $user->fresh()->update($user->only($user->getFillable()));
        }

        return $user;
    }
}
