<?php

namespace App\Http\Controllers\Api\Personas;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Personas::get();

        return response()->json([
           "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->all() as $data) {
                $persona = new Personas();

                $persona->name = $data['name'];
                $persona->cc = $data['cc'];
                $persona->fecha_nacimiento = $data['fecha_nacimiento'];

                $persona->save();

            }

            DB::commit();

            return response()->json([
                "message" => "Las personas enviada han sido creadas con éxito"
            ], 200);

        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Personas $personas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function edit(Personas $personas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $persona = Personas::find($id);

            //if is null the person sending
            if(is_null($persona)){
                return response()->json([
                    "message" => "Esta persona no existe en la base de datos"
                ], 400);
            }

            $persona->name = $request->name;
            $persona->cc = $request->cc;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;

            $persona->save();

            DB::commit();

            return response()->json([
                "message" => "La persona a sido editada con éxito"
            ], 200);

        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $persona = Personas::find($id);

            //if is null the person sending
            if(is_null($persona)){
                return response()->json([
                    "message" => "Esta persona no existe en la base de datos"
                ], 400);
            }

            $persona->delete();

            DB::commit();

            return response()->json([
                "message" => "La persona a sido eliminada con éxito"
            ], 200);

        }catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);

        }
    }
}
