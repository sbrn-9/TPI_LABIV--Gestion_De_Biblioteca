<?php

namespace App\Http\Controllers;

use App\InformeHelper;
use App\Models\Libro;
use App\Models\Libros_Prestados;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function negocio()
    {
        $dataAgosto = Prestamo::where('fecha_prestamo', '>=', '2024-08-01')
                            ->where('fecha_prestamo', '<=', '2024-09-01')->count();
        $dataSeptiembre = Prestamo::where('fecha_prestamo', '>=', '2024-09-01')
                            ->where('fecha_prestamo', '<=', '2024-10-01')->count();
        $dataOctubre = Prestamo::where('fecha_prestamo', '>=', '2024-10-01')
                            ->where('fecha_prestamo', '<=', '2024-11-01')->count();
        $dataNoviembre = Prestamo::where('fecha_prestamo', '>=', '2024-11-01')
                            ->where('fecha_prestamo', '<=', '2024-12-01')->count();
        $labels = ['Agosto', 'Septiembre', 'Octubre', 'Noviembre'];

        $data = [ $dataAgosto, $dataSeptiembre, $dataOctubre,  $dataNoviembre];
        $topCategorias = InformeHelper::getTopCategorias();
        $topUsers = InformeHelper::getTopUsers();
        $topLibros = InformeHelper::getTopLibros();

        return view('informes.negocio',['labels' => $labels, 'data' =>  $data,
        'catNames' => $topCategorias['names'],
        'topCats' => $topCategorias['values'],
        'userNames' => $topUsers['names'],
        'userValues' => $topUsers['values'],
        'topLibros' => $topLibros]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function control()
    {
        $libros = DB::table('libros')->orderBy('cantidad', 'desc')->get();
        $categorias = InformeHelper::getCategoriasConMasExistencias();
        $bestLibro = InformeHelper::getBestLibro();
        $largestLibro = InformeHelper::getLargestLibro();
        $oldestLibro = InformeHelper::getOldestLibro();
        return view('informes.control', ['libros' => $libros,
        'catNames' => $categorias['names'],
        'existencias' => $categorias['values'],
        'bestLibro' => $bestLibro,
        'largestLibro' => $largestLibro,
        'oldestLibro' => $oldestLibro]);
    }



// InformeController.php

public function reporteAdmin() {

    $admins = User::where('role', 0)->get(); // Suponiendo que role 0 es administrador
    $adminReports = [];

    foreach ($admins as $admin) {
        $adminReports[] = [
            'admin' => $admin,
            'weekly_cancelations' => InformeHelper::getAdminWeeklyCancelations($admin->id)
        ];
    }

    $monthlyAverages = InformeHelper::getMonthlyAverages();

    return view('informes.reporte', compact('adminReports', 'monthlyAverages'));
}



}
