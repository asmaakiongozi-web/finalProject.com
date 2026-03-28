<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function professionalDashboard()
    {
        return view('professional.professionalDashboard');
    }
}
