<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TaskExportController extends Controller
{
    public function export($projectId, $format)
    {
        $tasks = Task::where('project_id', $projectId)->get(['id', 'title', 'description', 'status', 'created_at']);

        if ($format === 'csv') {
            return $this->exportCsv($tasks);
        } elseif ($format === 'xlsx') {
            return $this->exportXlsx($tasks);
        }

        return redirect()->back()->with('error', 'Formato inválido.');
    }

    private function exportCsv($tasks)
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=tasks.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($tasks) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Title', 'Description', 'Status', 'Created At']);

            foreach ($tasks as $task) {
                fputcsv($file, [$task->id, $task->title, $task->description, $task->status, $task->created_at]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportXlsx($tasks)
    {
        return Excel::download(new class($tasks) implements \Maatwebsite\Excel\Concerns\FromCollection {
            protected $tasks;

            public function __construct($tasks)
            {
                $this->tasks = $tasks;
            }

            public function collection()
            {
                return $this->tasks;
            }
        }, 'tasks.xlsx');
    }
}
