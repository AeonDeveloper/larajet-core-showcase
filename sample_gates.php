// sample gate definition
Gate::define('manage-visitorinfo', function ($user) {
    return $user->hasPermission('manage-visitorinfo');
});


// or dynamicallu
foreach (Permission::all() as $permission) {
    Gate::define($permission->name, fn($user) => $user->hasPermission($permission->name));
}

