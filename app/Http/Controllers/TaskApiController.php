<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFiltersRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Attachment;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param TaskFiltersRequest $request
     * @return JsonResponse
     */
    public function index(TaskFiltersRequest $request): JsonResponse
    {
        $tasks = Task::query()->with('notes.attachments')->withCount('notes');
        // Filters
        $status = $request->query('status'); // New, Incomplete, Complete
        $due_date = $request->query('due_date'); // Y-m-d
        $priority = $request->query('priority'); // High, Medium, Low
        $notes = $request->query('notes'); // 0 or 1
        if($status) {
            $tasks->where('status', $status);
        }
        if($due_date) {
            $tasks->where('end_date', $due_date);
        }
        if($priority) {
            $tasks->where('priority', $priority);
        }
        if($notes) {
            $tasks->has('notes');
        }

        // Order by
        $tasks->orderByRaw('FIELD(priority, "High", "Medium", "Low"), priority ASC');
        $tasks->orderByDesc('notes_count');
        return response()->json([
            'success' => true,
            'data' => $tasks->get()
        ]) ;
    }

    /**
     *
     * Storing hierarchical task data
     * Task
     * * * Notes
     * * * * * Attachments
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(TaskRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $task_id = Task::create([
                'subject' => $request->subject,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'priority' => $request->priority,
                'status' => $request->status,
            ])->id;
            foreach ($request->notes as $note) {
                $note['task_id'] = $task_id;
                $note_id = Note::create($note)->id;
                if(isset($note['attachment'])) {
                    foreach ($note['attachment'] as $note_attachment) {
                        $filename = "attachment_" . time() . '.' . $note_attachment->getClientOriginalExtension();
                        $note_attachment->storeAs('public/storage/' . env('ATTACHMENT_DIR_NAME', 'attachments'), $filename);
                        Attachment::create([
                            'note_id' => $note_id,
                            'name' => $filename
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => "Task created successfully"
            ]) ;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Failed to create task"
            ]) ;
        }
    }
}
