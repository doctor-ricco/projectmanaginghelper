<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProjectExportController extends Controller
{
    public function export($format)
    {
        $projects = Project::all(['id', 'name', 'description', 'created_at']);

        if ($format === 'csv') {
            return $this->exportCsv($projects);
        } elseif ($format === 'xlsx') {
            return $this->exportXlsx($projects);
        }

        return redirect()->back()->with('error', 'Formato inválido.');
    }

    private function exportCsv($projects)
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=projects.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($projects) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Description', 'Created At']);

            foreach ($projects as $project) {
                fputcsv($file, [$project->id, $project->name, $project->description, $project->created_at]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportXlsx($projects)
    {
        return Excel::download(new class($projects) implements \Maatwebsite\Excel\Concerns\FromCollection {
            protected $projects;

            public function __construct($projects)
            {
                $this->projects = $projects;
            }

            public function collection()
            {
                return $this->projects;
            }
        }, 'projects.xlsx');
    }
}
