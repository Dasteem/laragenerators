## Quick Admin installation
1. Install the package via `composer require Dasteem/laragenerators`.
2. Add `Dasteem\Laragenerators\LarageneratorsServiceProvider::class,` to your `\config\app.php` providers.
3. Run `php artisan laragenerators:install` and fill the required information.
4. Register middleware `'role'       => \Dasteem\Laragenerators\Middleware\HasPermissions::class,` in your `App\Http\Kernel.php` at `$routeMiddleware`
5. Access LaraGenerators panel by visiting `http://yourdomain/admin`.