<?php
// app/Providers/CustomUserProvider.php
namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider as UserProviderContract;

class CustomUserProvider extends EloquentUserProvider implements UserProviderContract
{
    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials($user, array $credentials)
    {
        // Hash the provided password using SHA-1
        $providedPassword = strtoupper(sha1($credentials['password']));
        // Compare the provided password
        return $providedPassword === strtoupper($user->getAuthPassword());
    }
}
