<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Aspect;
use App\Models\Document;
use App\Models\Indicator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $uniqueDomains = Domain::distinct('domain_name')->count('domain_name');

        $uniqueAspects = Aspect::distinct('aspect_name')->count('aspect_name');

        $uniqueIndicators = Indicator::distinct('indicator_name')->count('indicator_name');

        $uniqueDocuments = Document::distinct('doc_name')->count('doc_name');

        // You can similarly fetch data for other values as needed from other models/tables.

        // Pass the data to the view
        return view('dashboard.index', compact('uniqueDomains', 'uniqueAspects','uniqueIndicators','uniqueDocuments'));
    }
}
