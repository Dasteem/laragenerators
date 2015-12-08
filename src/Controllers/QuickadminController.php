<?php
namespace Dasteem\Laragenerators\Controllers;

use App\Http\Controllers\Controller;

class LarageneratorsController extends Controller
{
    /**
     * Show LaraGenerators dashboard page
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}