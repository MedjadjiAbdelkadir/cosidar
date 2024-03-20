<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Ilot;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Controllers\Controller;

class PdfExportController extends Controller
{
    public function exportPDF(Request $request)
    {
        $Num_ilot = 5;
        //? Récupérez les données de l'ilot comme vous l'avez fait dans la méthode "show"
        $ilot = Ilot::with('proprietaire.tutelle', 'acteReference', 'batiments.locaux', 'proprietaire.statut', 'proprietaire.deciaffect', 'proprietaire.anx_text_creati')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
            ->where('dbo_ilot.Num_ilot', $Num_ilot)
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
            ->first();
        // dd($ilot->acteReference);
        if (!$ilot) {
            return redirect()->back()->with('error', __('Ilot not found.'));
        }

        $sup_SDHO_total = $ilot->batiments->sum('sup_SDHO');
        $sup_bati_cons_total = $ilot->batiments->sum('sup_bati_cons');
        $sup_assiette = $sup_SDHO_total + $sup_bati_cons_total;

        ///////////////////////
        $nonRenseigneCount = 0;
        $bureauxCount = 0;
        $sallesArchivesCount = 0;
        $locauxHabitationsCount = 0;
        $locauxCulturelsCount = 0;
        $enseignementCount = 0;
        $garagesCount = 0;
        $usagesDiversCount = 0;

        $nonRenseigneSurface = 0;
        $bureauxSurface = 0;
        $sallesArchivesSurface = 0;
        $locauxHabitationsSurface = 0;
        $locauxCulturelsSurface = 0;
        $enseignementSurface = 0;
        $garagesSurface = 0;
        $usagesDiversSurface = 0;

        $nonRenseignePieces = 0;
        $bureauxPieces = 0;
        $sallesArchivesPieces = 0;
        $locauxHabitationsPieces = 0;
        $locauxCulturelsPieces = 0;
        $enseignementPieces = 0;
        $garagesPieces = 0;
        $usagesDiversPieces = 0;

        foreach ($ilot->batiments as $batiment) {
            foreach ($batiment->locaux as $local) {
                switch ($local->Nature_Loc) {
                    case 1:
                        $nonRenseigneCount++;
                        $nonRenseigneSurface += $local->lot_surface;
                        $nonRenseignePieces += $local->nb_piece;
                        break;
                    case 2:
                        $bureauxCount++;
                        $bureauxSurface += $local->lot_surface;
                        $bureauxPieces += $local->nb_piece;
                        break;
                    case 3:
                        $sallesArchivesCount++;
                        $sallesArchivesSurface += $local->lot_surface;
                        $sallesArchivesPieces += $local->nb_piece;
                        break;
                    case 4:
                        $locauxHabitationsCount++;
                        $locauxHabitationsSurface += $local->lot_surface;
                        $locauxHabitationsPieces += $local->nb_piece;
                        break;
                    case 5:
                        $locauxCulturelsCount++;
                        $locauxCulturelsSurface += $local->lot_surface;
                        $locauxCulturelsPieces += $local->nb_piece;
                        break;
                    case 6:
                        $enseignementCount++;
                        $enseignementSurface += $local->lot_surface;
                        $enseignementPieces += $local->nb_piece;
                        break;
                    case 7:
                        $garagesCount++;
                        $garagesSurface += $local->lot_surface;
                        $garagesPieces += $local->nb_piece;
                        break;
                    case 8:
                        $usagesDiversCount++;
                        $usagesDiversSurface += $local->lot_surface;
                        $usagesDiversPieces += $local->nb_piece;
                        break;
                    default:
                        break;
                }
            }
        }

        $totalPieces = $nonRenseignePieces + $bureauxPieces + $sallesArchivesPieces + $locauxHabitationsPieces + $locauxCulturelsPieces + $enseignementPieces + $garagesPieces + $usagesDiversPieces;
        $totalSurface = $nonRenseigneSurface + $bureauxSurface + $sallesArchivesSurface + $locauxHabitationsSurface + $locauxCulturelsSurface + $enseignementSurface + $garagesSurface + $usagesDiversSurface;

        ////////////////////
        $options = [
            'outputType' => 'png', // Format de sortie (PNG dans cet exemple)
            'size' => 200, // Taille du code QR (personnalisez selon vos besoins)
        ];

        $outputPath = public_path('qr_code/' . $ilot->Num_ilot . '.png');

        // $renderer = new ImageRenderer(
        //     new RendererStyle(400),
        //     new ImagickImageBackEnd()
        // );
        // $writer = new Writer($renderer, $options);
        $outputPath = public_path('qr_code/' . $ilot->Num_ilot . '.png');

        // $writer->writeFile($ilot->Num_ilot, $outputPath);


        $data = [
            'ilot' => $ilot,
            'sup_SDHO_total' => $sup_SDHO_total,
            'sup_assiette' => $sup_assiette,
            'nonRenseigneCount' => $nonRenseigneCount,
            'bureauxCount' => $bureauxCount,
            'sallesArchivesCount' => $sallesArchivesCount,
            'locauxHabitationsCount' => $locauxHabitationsCount,
            'locauxCulturelsCount' => $locauxCulturelsCount,
            'enseignementCount' => $enseignementCount,
            'garagesCount' => $garagesCount,
            'usagesDiversCount' => $usagesDiversCount,
            'nonRenseigneSurface' => $nonRenseigneSurface,
            'bureauxSurface' => $bureauxSurface,
            'sallesArchivesSurface' => $sallesArchivesSurface,
            'locauxHabitationsSurface' => $locauxHabitationsSurface,
            'locauxCulturelsSurface' => $locauxCulturelsSurface,
            'enseignementSurface' => $enseignementSurface,
            'garagesSurface' => $garagesSurface,
            'usagesDiversSurface' => $usagesDiversSurface,
            'nonRenseignePieces' => $nonRenseignePieces,
            'bureauxPieces' => $bureauxPieces,
            'sallesArchivesPieces' => $sallesArchivesPieces,
            'locauxHabitationsPieces' => $locauxHabitationsPieces,
            'locauxCulturelsPieces' => $locauxCulturelsPieces,
            'enseignementPieces' => $enseignementPieces,
            'garagesPieces' => $garagesPieces,
            'usagesDiversPieces' => $usagesDiversPieces,
            'totalPieces' => $totalPieces,
            'totalSurface' => $totalSurface,
        ];
        // return view('dashboard.template.vue_genrale');
        $pdf = PDF::loadView('dashboard.template.vue_genrale', $data);

        $fileName =  time().'.'. 'pdf' ;
        $pdf->save(public_path() . '/' . $fileName);

        $pdf = public_path($fileName);
        return response()->download($pdf);
    }
}
