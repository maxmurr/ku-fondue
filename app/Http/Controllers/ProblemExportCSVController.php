<?php

namespace App\Http\Controllers;

use App\Exports\ProblemExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProblemExportCSVController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportExcelCSV($slug)
    {
        return Excel::download(new ProblemExport, 'problems-' . time() . '.' .$slug );
    }
}
