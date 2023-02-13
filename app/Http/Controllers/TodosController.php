<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los elementos
     * store para guardar
     * update para actualizar
     * destroy para eliminar
     * edit para mostrar el formulario de edición
     */

    public function store(Request $request) {
        //función para insertar un nuevo elemento

        //el método validate me permite validar explicitamente los datos que estoy recibiendo
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos')->with('success','Tarea creada correctamente.');
    }

    public function index() {
        //función para mostrar todos los elementos
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }

    public function show($id) {
        //función para mostrar solo un elemento
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id) {
        //función para editar un elemento seleccionado
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea actualizada');
    }

    public function destroy($id) {
        //función para eliminiar un elemento
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('todos')->with('success', 'Tarea ha sido eliminada');
    }
}
