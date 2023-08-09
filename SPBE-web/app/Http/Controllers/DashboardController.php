<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Aspect;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $score = Score::where('score_date', '2023')->first();
        $attributes = Indicator::where('score_id', $score->id)->paginate(10);
        foreach ($attributes as $attribute){
            $attribute->documents = $attribute->documents()->get();
            $attribute->scoreForm = $attribute->score()->first();
        }

        $aspects = Aspect::all();

        $uniqueDomains = Domain::distinct('domain_name')->count('domain_name');

        $uniqueAspects = Aspect::distinct('aspect_name')->count('aspect_name');

        $uniqueIndicators = Indicator::distinct('indicator_name')->count('indicator_name');

        $uniqueDocuments = Document::distinct('doc_name')->count('doc_name');

        //Scoring
        $score = Score::where('score_date', '2023')->first();

        $data = new Collection([
            'aspectOne' => $score->indicators()->where('aspect_id', 1)->sum('score') * 1.3,
            'aspectTwo' => $score->indicators()->where('aspect_id', 2)->sum('score') * 2.5,
            'aspectThree' => $score->indicators()->where('aspect_id', 3)->sum('score') * 2.5,
            'aspectFour' => $score->indicators()->where('aspect_id', 4)->sum('score') * 2.5,
            'aspectFive' => $score->indicators()->where('aspect_id', 5)->sum('score') * 1.5,
            'aspectSix' => $score->indicators()->where('aspect_id', 6)->sum('score') * 1.5,
            'aspectSeven' => $score->indicators()->where('aspect_id', 7)->sum('score') * 2.75,
            'aspectEight' => $score->indicators()->where('aspect_id', 8)->sum('score') * 3,
        ]);

        $data['domainOne'] = $data['aspectOne'];
        $data['domainTwo'] = $data['aspectTwo'] + $data['aspectThree'] + $data['aspectFour'];
        $data['domainThree'] = $data['aspectFive'] + $data['aspectSix'];
        $data['domainFour'] = $data['aspectSeven'] + $data['aspectEight'];

        $data['indexScore'] = 1/100 * ($data['domainOne'] + $data['domainTwo'] + $data['domainThree'] + $data['domainFour']);

        // Pass the data to the view
        return view('dashboard.index', compact(
            'uniqueDomains',
            'uniqueAspects',
            'uniqueIndicators',
            'uniqueDocuments',
            'score',
            'data',
            'attributes'
        ));
    }
}
