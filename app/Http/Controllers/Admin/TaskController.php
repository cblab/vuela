<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{

    public function manageTasks()
    {
        return view('admin.manage-tasks');
    }

    /**
     * Display a listing of tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Task::latest()->paginate(5);
        $response = [
            'pagination' => [
                'total'        => $items->total(),
                'per_page'     => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page'    => $items->lastPage(),
                'from'         => $items->firstItem(),
                'to'           => $items->lastItem()
            ],

            'data' => $items
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'completed'   => 'required',
        ]);

        $create = Task::create($request->all());
        return response()->json($create);
    }

    /**
     * Update task in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'completed'   => 'required',
        ]);

        $edit = Task::find($id)->update($request->all());
        return response()->json($edit);
    }

    /**
     * search task in elastic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required'
        ]);
        $tasks    = Task::search($request->get('query'))->where('completed','0')->get();
        return response()->json($tasks);
    }

    /**
     * Remove item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return response()->json(['done']);
    }
}