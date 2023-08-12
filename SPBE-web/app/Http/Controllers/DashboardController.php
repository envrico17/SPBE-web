<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Aspect;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Score;
use App\Models\ScoreIndicator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $option = FacadesRequest::query('option');

        $scores = Score::all();
        $aspects = Aspect::all();

        $uniqueDomains = Domain::count('domain_name');

        $uniqueAspects = Aspect::count('aspect_name');

        $uniqueIndicators = Indicator::count('indicator_name');

        if (! $user->hasRole('admin')){
            $uniqueDocuments = Document::where('opd_id',$user->opd_id)->count();
        } else {
            $uniqueDocuments = Document::count();
        }

        if (is_null($option)) {
            return view('dashboard.index', compact(
                'uniqueDomains',
                'uniqueAspects',
                'uniqueIndicators',
                'uniqueDocuments',
                'scores'
            ));
        }

        try {
            $score_form = Score::where('id', $option)->first();
            $score_indicators = ScoreIndicator::where('score_id', $option)
                                    ->orderBy('indicator_id','asc')
                                    ->paginate(10);

            $data = new Collection();

            foreach ($aspects as $aspect) {
                $aspect->aspect_score = $aspect->score_indicators->where('score_id', $option)->sum('score');

                // Modify aspect_score based on criteria
                switch ($aspect->id) {
                    case 1:
                        $aspect->aspect_score *= 1.5;
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $aspect->aspect_score *= 2.5;
                        break;
                    case 5:
                    case 6:
                        $aspect->aspect_score *= 1.5;
                        break;
                    case 7:
                        $aspect->aspect_score *= 2.75;
                        break;
                    case 8:
                        $aspect->aspect_score *= 3;
                        break;
                    default:
                        // Handle other cases if needed
                        break;
                }

                $data->put($aspect->id, $aspect->aspect_score);
            }

            if (!$score_form) {
                throw new ModelNotFoundException();
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'Filtered data not found.');
        }

        $data['domainOne'] = $data['1'];
        $data['domainTwo'] = $data['2'] + $data['3'] + $data['4'];
        $data['domainThree'] = $data['5'] + $data['6'];
        $data['domainFour'] = $data['7'] + $data['8'];

        $data['indexScore'] = 1 / 100 * ($data['domainOne'] + $data['domainTwo'] + $data['domainThree'] + $data['domainFour']);

        $value = $data['indexScore'];

        if ($value >= 4.2 && $value <= 5) {
            $data['spbeStatus'] = "Memuaskan";
        } elseif ($value >= 3.5 && $value < 4.2) {
            $data['spbeStatus'] = "Sangat Baik";
        } elseif ($value >= 2.6 && $value < 3.5) {
            $data['spbeStatus'] = "Baik";
        } elseif ($value >= 1.8 && $value < 2.6) {
            $data['spbeStatus'] = "Cukup";
        } elseif ($value < 1.8) {
            $data['spbeStatus'] = "Kurang";
        }

        // Include the selected option in the pagination links
        $score_indicators->appends(['option' => $option]);

        // Pass the data to the view
        return view('dashboard.index', compact(
            'uniqueDomains',
            'uniqueAspects',
            'uniqueIndicators',
            'uniqueDocuments',
            'scores',
            'score_form',
            'score_indicators',
            'data',
        ));
    }
}
