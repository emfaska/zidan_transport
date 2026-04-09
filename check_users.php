<?php
$admin = App\Models\User::where('role', 'admin')->first();
$driver = App\Models\User::where('role', 'pengemudi')->first();

echo "Admin:\n";
if ($admin) {
    echo "ID: {$admin->id}\n";
    echo "Email: {$admin->email}\n";
    echo "Role: {$admin->role}\n";
    echo "Is Active: " . ($admin->is_active ? 'Yes' : 'No') . " (Raw: " . $admin->getRawOriginal('is_active') . ")\n";
} else {
    echo "Admin not found\n";
}

echo "\nDriver:\n";
if ($driver) {
    echo "ID: {$driver->id}\n";
    echo "Email: {$driver->email}\n";
    echo "Role: {$driver->role}\n";
    echo "Is Active: " . ($driver->is_active ? 'Yes' : 'No') . " (Raw: " . $driver->getRawOriginal('is_active') . ")\n";
} else {
    echo "Driver not found\n";
}
