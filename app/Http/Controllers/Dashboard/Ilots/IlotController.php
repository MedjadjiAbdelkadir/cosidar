<?php

namespace App\Http\Controllers\Dashboard\Ilots;

<<<<<<< HEAD
=======
use App\Http\Controllers\Controller;
use App\Models\Batiment;
use App\Models\Ilot;
use App\Models\Local;
use App\Models\Pays;
use App\Models\ReferenceActe;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
>>>>>>> mohamed

use App\Models\Ilot;
use App\Models\Pays;
use App\Models\Local;
use BaconQrCode\Writer;
use App\Models\Batiment;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Storage;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class IlotController extends Controller
{
    public function index()
    {
        $ilots = DB::table('dbo_ilot')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom')
            ->paginate(PAGINATE_COUNT);

        $jsonPath = public_path('country.json');
        $jsonData = File::get($jsonPath);
        $pays = json_decode($jsonData, true);

        return view('dashboard.Ilots.index', compact('ilots'));
    }

    public function create()
    {
        // if (!Auth::check()) {
        //     abort(403, 'Accès non autorisé'); // Rejette l'accès si l'utilisateur n'est pas authentifié
        // }
        $pays = Pays::all();
        $Proprietaire = Proprietaire::orderBy('id', 'DESC')->get();

        $jsonPath = public_path('algeria_cities.json');
        $jsonData = File::get($jsonPath);
        $cities = json_decode($jsonData, true);

        $wilayaNames = array_unique(array_column($cities, 'wilaya_name_ascii'));
        $dayraNames = array_unique(array_column($cities, 'daira_name_ascii'));
        // Créez un tableau associatif avec les mêmes valeurs que clés
        $wilayaNames = array_combine($wilayaNames, $wilayaNames);
        $dayraNames = array_combine($dayraNames, $dayraNames);

        return view('dashboard.Ilots.create', compact('pays','Proprietaire'));
    }

    public function store(Request $request)
    {
        $userRole = auth()->user()->role;
        //? $userRole = auth()->user()->role;
        $validationValue = ($userRole == 'utilisateur') ? 0 : 1;

        //? Récupérez le plus grand Num_ilot existant et ajoutez 1
        $maxNumIlot = Ilot::max('Num_ilot');
        $newNumIlot = $maxNumIlot + 1;
        $validatedData = $request->validate([
            'proprietaire_id' => '',
            'N_ilot' => '',
            'Denom_Ilot' => '',
            'Nature' => '',
            'Utlisation' => '',
            'Rue_fr' => '',
            'Localite' => '',
            'Ville' => '',
            'Pays' => '',
            'il_surf_cadastree' => '',
            'Num_Rue' => '',
            'mantVV' => '',
            'Int_VV' => '',
            //'mantant_VV' => '',
            'Int_VL' => '',
            //'mantant_VL' => '',
            'Age' => '',
            'Num_Entretien' => '',
            'intit_Entretien' => '',
        // 'Origine_Acte' => '',
            'type_enquete' => '',
            'Observation_enqueteur' => '',
            'date_Enquete' => '',
            'Num_enqui' => '',
            'mantVL' => '',
            'image' => 'file|image|mimes:jpeg,png,pdf|max:50000',
            'cord_X'=> '',
            'cord_y'=> '',
            //'created_by'=>'',
        ]);

        $input = $validatedData['il_surf_cadastree'];

        //? Convertissez la valeur en float avec deux chiffres après la virgule
        $il_surf_cadastree = number_format(floatval($input), 2, '.', '');

        // Créez un nouveau modèle Ilot avec le nouveau Num_ilot
        $ilot = new Ilot([
            'Num_ilot' => $newNumIlot,
            'proprietaire_id' => $validatedData['proprietaire_id'],
            'N_ilot' => $validatedData['N_ilot'],
            'proprietaire_id' => $validatedData['proprietaire_id'],
            'Denom_Ilot' => $validatedData['Denom_Ilot'],
            'Nature' => $validatedData['Nature'],
            'Utlisation' => $validatedData['Utlisation'],
            'Rue_fr' => $validatedData['Rue_fr'],
            'Localite' => $validatedData['Localite'],
            'Ville' => $validatedData['Ville'],
            'Pays' => $validatedData['Pays'],
            'il_surf_cadastree' => $il_surf_cadastree,
            'Num_Rue' => $validatedData['Num_Rue'],
            'mantVV' => $validatedData['mantVV'],
            'Int_VV' => $validatedData['Int_VV'],
            //'mantant_VV' => $validatedData['mantant_VV'],
            'Int_VL' => $validatedData['Int_VL'],
            //'mantant_VL' => $validatedData['mantant_VL'],
            'Age' => $validatedData['Age'],
            'intit_Entretien' => $validatedData['intit_Entretien'],
            //'Origine_Acte' => $validatedData['Origine_Acte'],
            'type_enquete' => $validatedData['type_enquete'],
            'Observation_enqueteur' => $validatedData['Observation_enqueteur'],
            'date_sais' => now(),
            'date_Enquete' => $validatedData['date_Enquete'],
            'Num_enqui' => $validatedData['Num_enqui'],
            'mantVL' => $validatedData['mantVL'],
            'validation' => $validationValue,
            'cord_X'=> $validatedData['cord_X'],
            'cord_y'=> $validatedData['cord_y'],
            'created_by'=>auth()->user()->id,
        ]);

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                //? Générez un nom de fichier unique pour éviter les conflits
                $fileName = time() . '_' . $file->getClientOriginalName();

                //? Déplacez le fichier vers le répertoire de stockage (par exemple, public/images)
                $file->move('public/images', $fileName);

                //? Ajoutez le chemin du fichier à notre tableau
                $imagePaths[] = 'public/images/' . $fileName;
            }
            //? Concaténez les chemins avec le caractère '|' et enregistrez-les dans la base de données
            $ilot->image = implode('|', $imagePaths);
        }

        //? Enregistrez le modèle dans la base de données
        $ilot->save();


        $idIlotAjoute = $ilot->id;

        $request->validate([
            'date_pub'=> '',
            'Volume'=> '',
            'case'=> '',
            'nature_acte'=> '',
            'Num_Nat_Acte'=> '',
            'Construction_Acte'=> '',
            'Origine_Acte'=> '',
        ]);
        if($request->input('nature_acte') == 'Loi'){
            $Num_Nat_Acte=1;
        }
        if($request->input('nature_acte') == 'Décret'){
            $Num_Nat_Acte=2;
        }
        if($request->input('nature_acte') == 'Arrêté'){
            $Num_Nat_Acte=3;
        }
        if($request->input('nature_acte') == 'Acte'){
            $Num_Nat_Acte=4;
        }
        if($request->input('nature_acte') == 'Convention bilatérale'){
            $Num_Nat_Acte=5;
        }
        if($request->input('nature_acte') == 'Non renseigner'){
            $Num_Nat_Acte=6;
        }

        ReferenceActe::create([
            'Num_ilot' => $idIlotAjoute,
            'date_pub'=> $request->input('date_pub'),
            'volume1'=> $request->input('Volume'),
            'case11'=> $request->input('case'),
            'nature_acte'=> $request->input('nature_acte'),
            'Num_Nat_Acte'   => $Num_Nat_Acte,
            'Construction_Acte'=> $request->input('Construction_Acte'),
            'Origine_Acte' => $request->input('Origine_Acte'),
        ]);
        $ilots = Ilot::orderBy('id', 'DESC')->first();
        return view('dashboard.batiment.create',compact('ilots'))->with('success', 'Ilot ajouté avec succès ! (ID : $idIlotAjoute)');
        // return redirect()->route('dashboard.batiments.create')->with('success', "Ilot ajouté avec succès ! (ID : $idIlotAjoute)");
        // Redirigez vers l'index avec un message de succès
        //return redirect()->route('ilots.index')->with('success', 'Ilot ajouté avec succès !');
    }

    public function show($Num_ilot)
    {
        $ilot = Ilot::with('proprietaire', 'acteReference', 'batiments.locaux')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->where('dbo_ilot.Num_ilot', $Num_ilot)
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom')
            ->first();


        $nombreBatiments = Batiment::where('Num_ilot', $Num_ilot)->count();
        $nombreLocaux = Local::where('Num_ilot', $Num_ilot)->count();



        // return view('dashboard.ilots.show', compact('ilot', 'nombreBatiments', 'nombreLocaux'));
    }

    public function edit($ilot_Num)
    {
        if (!Auth::check()) {
            abort(403, 'Accès non autorisé'); // Rejette l'accès si l'utilisateur n'est pas authentifié
        }

        $ilot = DB::table('dbo_ilot')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->where('dbo_ilot.Num_ilot', $ilot_Num)
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom')
            ->first();

        $jsonPath = public_path('country.json');
        $jsonData = File::get($jsonPath);

        $pays = json_decode($jsonData, true);

        $jsonPath = public_path('algeria_cities.json');
        $jsonData = File::get($jsonPath);
        $cities = json_decode($jsonData, true);

        $wilayaNames = array_unique(array_column($cities, 'wilaya_name_ascii'));
        $dayraNames = array_unique(array_column($cities, 'daira_name_ascii'));

        return view('ilots.edit', compact('ilot', 'wilayaNames', 'dayraNames','pays'));
    }

    public function updated(Request $request, $Num_ilot)
    {

        $userRole = auth()->user()->role;
        $validationValue = ($userRole == 'utilisateur') ? 0 : 1;

        // Validez les données du formulaire
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:50000', // Exemple : accepte les images JPEG, PNG, JPG, GIF de taille maximale 2 Mo
        ]);

        // Récupérez l'îlot à mettre à jour
        $ilot = DB::table('dbo_ilot')
            ->where('Num_ilot', $Num_ilot)
            ->first();

        if (!$ilot) {
            return redirect()->route('dashboard.ilots.index')->with('error', 'L\'îlot n\'existe pas.');
        }

        // Mettez à jour les données de l'îlot avec les nouvelles valeurs
        $ilotData = [
            'N_ilot' => $request->input('N_ilot'),
            'proprietaire_id' => $request->input('proprietaire_id'),
            'Denom_Ilot' => $request->input('Denom_Ilot'),
            'Nature' => $request->input('Nature'),
            'Utlisation' => $request->input('Utlisation'),
            'Rue_fr' => $request->input('Rue_fr'),
            'Localite' => $request->input('Localite'),
            'Ville' => $request->input('Ville'),
            'Pays' => $request->input('Pays'),
            'il_surf_cadastree' => $request->input('il_surf_cadastree'),
            'Num_Rue' => $request->input('Num_Rue'),
            'mantVV' => $request->input('mantVV'),
            'Int_VV' => $request->input('Int_VV'),
            'mantant_VV' => $request->input('mantant_VV'),
            'Int_VL' => $request->input('Int_VL'),
            'mantant_VL' => $request->input('mantant_VL'),
            'Age' => $request->input('Age'),
            'intit_Entretien' => $request->input('intit_Entretien'),
            'Origine_Acte' => $request->input('Origine_Acte'),
            'type_enquete' => $request->input('type_enquete'),
            'Observation_enqueteur' => $request->input('Observation_enqueteur'),
            'date_Enquete' => $request->input('date_Enquete'),
            'Num_enqui' => $request->input('Num_enqui'),
            'validation' => $validationValue,
            'cord_X'=>  $request->input('cord_X'),
            'cord_y'=>  $request->input('cord_y'),
        ];

        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imagePath) {
                // Supprimer l'image du stockage, vous devrez adapter cette logique en fonction de votre configuration de stockage
                Storage::delete($imagePath);

                // Échapper les apostrophes dans le chemin de l'image
                $escapedImagePath = addslashes($imagePath);

                // Supprimer le chemin de l'image de la base de données
                Ilot::where('Num_ilot', $Num_ilot)
                    ->where('image', 'LIKE', "%$escapedImagePath%")
                    ->update([
                        'image' => DB::raw("REPLACE(image, '$escapedImagePath', '')"),
                    ]);

                // Deuxième mise à jour pour gérer les cas spécifiques avec les caractères '|'
                $ilot = Ilot::where('Num_ilot', $Num_ilot)->first();

                if ($ilot && strpos($ilot->image, '|') === 0) {
                    // S'il commence par '|', supprimez le premier '|'
                    $ilot->update(['image' => substr($ilot->image, 1)]);
                }

                if ($ilot && strrpos($ilot->image, '|') === (strlen($ilot->image) - 1)) {
                    // S'il se termine par '|', supprimez le dernier '|'
                    $ilot->update(['image' => substr($ilot->image, 0, -1)]);
                }

                // Supprimer les caractères '||' s'ils sont présents
                $ilot->update(['image' => str_replace('||', '|', $ilot->image)]);
            }
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $file)
            {
                // Générez un nom de fichier unique pour éviter les conflits
                $fileName = time() . '_' . $file->getClientOriginalName();
                // Déplacez le fichier vers le répertoire de stockage (par exemple, public/images)
                $file->move('public/images', $fileName);
                // Ajoutez le chemin du fichier à notre tableau
                $imagePaths[] = 'public/images/' . $fileName;
            }
            // Récupérez les anciennes images pour les conserver
            $anciennesImages = [];
            if ($ilot->image) {
                $anciennesImages = explode('|', $ilot->image);
            }

            // Combinez les anciennes et nouvelles images
            $toutesLesImages = array_merge(
                array_diff($anciennesImages, $request->input('delete_images', [])),
                $imagePaths
            );

            // Concaténez les chemins avec le caractère '|' et enregistrez-les dans la base de données
            $ilotData['image'] = implode('|', $toutesLesImages);
        }



            // Utilisez la méthode DB::table()->update() pour mettre à jour les données
        $x =   DB::table('dbo_ilot')
                ->where('Num_ilot', $Num_ilot)
                ->update($ilotData);

        // Redirigez l'utilisateur avec un message de succès
        return redirect()->route('dashboard.ilots.index')->with('success', 'L\'îlot a été mis à jour avec succès.');
    }

    public function destroy(Request $request)
    {
        $Num_ilot = $request->id;
        // Supprimez l'ilot en fonction de son Num_ilot
        Ilot::where('Num_ilot', $Num_ilot)->delete();

        // Redirigez vers la page d'index avec un message de succès
        return redirect()->route('dashboard.ilots.index')->with('success', 'Ilot supprimé avec succès.');
    }
    public function deleted(Request $request)
    {
        $Num_ilot = $request->id;
        // Supprimez l'ilot en fonction de son Num_ilot
        Ilot::where('Num_ilot', $Num_ilot)->delete();

        // Redirigez vers la page d'index avec un message de succès
        return redirect()->route('dashboard.ilots.index')->with('success', 'Ilot supprimé avec succès.');
    }

    public function getChildreenOfIlot($Num_ilot){
        $ilot = Ilot::with('proprietaire.tutelle', 'acteReference', 'batiments.locaux', 'proprietaire.statut', 'proprietaire.deciaffect', 'proprietaire.anx_text_creati')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
            ->where('dbo_ilot.Num_ilot', $Num_ilot)
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
            ->first();

            $batiments = Batiment::where('Num_ilot', $Num_ilot)->get();

             //$locaux = Local::where('Num_ilot', $Num_ilot)->get();
            $locaux = Local::join('dbo_batiment', 'dbo_locaux.Num_Bat', '=', 'dbo_batiment.Num_Bat')
            ->where('dbo_locaux.Num_ilot', $Num_ilot)
            ->select('dbo_locaux.*', 'dbo_batiment.bat_no as bat_no_batiment')
            ->get();

            $actes =   DB::table('dbo_reference_acte')->where('Num_ilot', $Num_ilot)->get();

            $proprietaires =  DB::table('dbo_personne')
                ->join('dbo_anx_statut', 'dbo_personne.Statut', '=', 'dbo_anx_statut.bi_natjur')
                ->join('dbo_anx_tutelle', 'dbo_personne.Tutelle', '=', 'dbo_anx_tutelle.bi_natjur')
                ->join('dbo_deciaffect', 'dbo_personne.Decision_affectation', '=', 'dbo_deciaffect.Deci_Af')
                ->join('dbo_anx_text_creati', 'dbo_personne.txt_creation', '=', 'dbo_anx_text_creati.bi_natjur')
                ->where('Num_ilot', $Num_ilot)
                ->select('dbo_personne.*', 'dbo_anx_statut.intitule as anx_statut_intitule', 'dbo_deciaffect.intitule_fr as deciaffect_intitule' , 'dbo_anx_tutelle.intitule as tutelle_intitule' , 'dbo_anx_text_creati.intitule as text_creati_intitule')
                ->get();

            return view('ilots.getChildreenOfIlot', compact('ilot','batiments','locaux','actes','proprietaires'));

    }

    public function details()
    {
        // dd("details");
        $jsonPath = public_path('country.json');
        $jsonData = File::get($jsonPath);
        $pays_flags = json_decode($jsonData, true);

        //? effectuer une jointure entre la table dbo_ilot et deux autres tables (dbo_anx_evaluation_locative et dbo_anx_evaluation_venale),  la jointure avec l'une de ces tables soit facultative.
        $ilots = DB::table('dbo_ilot')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->leftJoin('dbo_anx_evaluation_locative', 'dbo_ilot.Int_VL', '=', 'dbo_anx_evaluation_locative.num_Lv')
            ->leftJoin('dbo_anx_evaluation_venale', 'dbo_ilot.Int_VV', '=', 'dbo_anx_evaluation_venale.num_VV')
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_evaluation_locative.intitule as intitule_vl', 'dbo_anx_evaluation_venale.intitule as intitule_vv')
            ->paginate(PAGINATE_COUNT);

        //? Groupez les ilots par pays et comptez-les
        $ilotsGroupedByPays = $ilots->groupBy('Pays')->map(function ($group) {
            return $group->count();
        });

        
        return view('dashboard.ilots.details', compact('ilots','pays_flags', 'ilotsGroupedByPays'));
    }


    public function getIlotsByPays($pays)
    {
        // dd("yes ...") ;

        $proprietaires = Proprietaire::with('ilot')->where('paye_name',$pays)
                       ->paginate(PAGINATE_COUNT);

        // dd($proprietaires->ili);             
        // dd($proprietaire);
        // $ilots = Ilot::where('Pays', $pays)->get();
        return view('dashboard.ilots.ilots_by_pays', compact('proprietaires'));
    }

    public function getIlotsByPproprietaire($proprietaire_id){
        $ilots = Ilot::where('proprietaire_id' , $proprietaire_id)->paginate(PAGINATE_COUNT);
        return view('dashboard.ilots.ilots_by_proprietaires', compact('ilots'));

    }

    public function vueGenerale($Num_ilot)
    {
        //? Récupérez les données de l'ilot comme vous l'avez fait dans la méthode "show"
        $ilot = Ilot::with('proprietaire.tutelle', 'acteReference', 'batiments.locaux', 'proprietaire.statut', 'proprietaire.deciaffect', 'proprietaire.anx_text_creati')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
            ->where('dbo_ilot.Num_ilot', $Num_ilot)
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
            ->first();

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

        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer, $options);
        $outputPath = public_path('qr_code/' . $ilot->Num_ilot . '.png');

        $writer->writeFile($ilot->Num_ilot, $outputPath);

        return view('dashboard.template.vue_genrale', compact(
            'ilot', 'sup_SDHO_total', 'sup_assiette',
            'nonRenseigneCount', 'bureauxCount', 'sallesArchivesCount', 'locauxHabitationsCount',
            'locauxCulturelsCount', 'enseignementCount', 'garagesCount', 'usagesDiversCount',
            'nonRenseigneSurface', 'bureauxSurface', 'sallesArchivesSurface', 'locauxHabitationsSurface',
            'locauxCulturelsSurface', 'enseignementSurface', 'garagesSurface', 'usagesDiversSurface',
            'nonRenseignePieces', 'bureauxPieces', 'sallesArchivesPieces', 'locauxHabitationsPieces',
            'locauxCulturelsPieces', 'enseignementPieces', 'garagesPieces', 'usagesDiversPieces',
            'totalPieces', 'totalSurface'
        ));
    }

    public function get_full_detail_ilot($Num_ilot)
    {
        //? Récupérez les données de l'ilot comme vous l'avez fait dans la méthode "show"
        // $ilot = Ilot::with('proprietaire.tutelle', 'acteReference', 'batiments.locaux', 'proprietaire.statut', 'proprietaire.deciaffect', 'proprietaire.anx_text_creati')
        //     ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
        //     ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
        //     ->where('dbo_ilot.Num_ilot', $Num_ilot)
        //     ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
        //     ->first();

        // $ilot = Ilot::with('proprietaire.tutelle', 'acteReference', 'batiments.locaux', 'proprietaire.statut', 'proprietaire.deciaffect', 'proprietaire.anx_text_creati')
        // ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
        // ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
        // ->where('dbo_ilot.Num_ilot', $Num_ilot)
        // ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
        // ->first();

        // $ilot = Ilot::with('proprietaire.tutelle', 'acteReference', 'batiments.locaux', 'proprietaire.statut', 'proprietaire.deciaffect', 'proprietaire.anx_text_creati')
        // ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
        // ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
        // ->where('dbo_ilot.Num_ilot', $Num_ilot)
        // ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
        // ->first();

        $ilot = Ilot::with('proprietaire','anx_nature_imm','anx_entretien','acteReference', 'batiments.locaux')
        ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
        ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
        ->where('dbo_ilot.Num_ilot', $Num_ilot)
        ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
        ->first();
        // $ilot = Ilot::find($Num_ilot);
        // return response()->json($ilot);

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

        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );

        $writer = new Writer($renderer, $options);
        $outputPath = public_path('qr_code/' . $ilot->Num_ilot . '.png');

        $writer->writeFile($ilot->Num_ilot, $outputPath);

        $data = [
            'ilot' => $ilot,
            //'pays' => $pays,
            /*'sup_SDHO_total' => $sup_SDHO_total,
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
            'totalSurface' => $totalSurface*/
        ];

        return response()->json($data);
    }

    public function activity_users()
    {
        $activityUsers = DB::table('dbo_ilot')
            ->join('users', 'dbo_ilot.created_by', '=', 'users.id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.role as user_role', DB::raw('COUNT(dbo_ilot.id) as activity_count'))
            ->groupBy('users.id', 'users.name', 'users.role')
            ->paginate(PAGINATE_COUNT);

        return view('dashboard.Bilan.index', ['activityUsers' => $activityUsers]);
    }

    public function filterActivityByDate(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $activityUsers = DB::table('dbo_ilot')
            ->join('users', 'dbo_ilot.created_by', '=', 'users.id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.role as user_role', DB::raw('COUNT(dbo_ilot.id) as activity_count'))
            ->whereBetween('dbo_ilot.date_sais', [$startDate, $endDate])
            ->groupBy('users.id', 'users.name', 'users.role')
            ->get();

        return response()->json($activityUsers);
    }

    public function getIliotsByIdUser($id_user)
    {
        $ilots = Ilot::join('users', 'dbo_ilot.created_by', '=', 'users.id')
            ->where('users.id', $id_user)
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->select('dbo_ilot.*',  'users.name as created_by_user', 'dbo_anx_nature_imm.intitule as nature_nom') // Sélectionnez les colonnes de dbo_ilot que vous voulez
            ->get();

        return view('ilots.getIliotsByIdUser')->with('ilots', $ilots);
    }

    public function delete($Num_ilot)
    {
        //? Récupérez l'ilot à supprimer en fonction de son Num_ilot
        $ilot = Ilot::where('Num_ilot', $Num_ilot)->first();
        //? Vérifiez si l'ilot existe
        if (!$ilot) {
            return redirect()->back()->with('error', 'Ilot introuvable.');
        }
        //? Affichez la vue de confirmation de suppression
        return view('ilots.confirm-delete', compact('ilot'));
    }

    public function geoloc($ilot_Num)
    {
        $ilot = DB::table('dbo_ilot')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->where('dbo_ilot.Num_ilot', $ilot_Num)
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom')
            ->first();
        return view('ilots.geoloc', compact('ilot'));
    }

    public function updateValidation($ilot_Num)
    {
        $newValidation = request('validation');

        // Mettez à jour le champ 'validation' directement dans la base de données
        DB::table('dbo_ilot')
            ->where('Num_ilot', $ilot_Num)
            ->update(['validation' => $newValidation]);

        // Retournez une réponse JSON si nécessaire
        return response()->json(['message' => 'Validation mise à jour avec succès']);
    }
}
