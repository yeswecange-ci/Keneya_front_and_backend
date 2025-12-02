<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumn;
use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\FooterSocial;
use App\Models\HomeAbout;
use App\Models\HomeKeyNumber;
use App\Models\HomeKeyNumberStat;
use App\Models\HomePartner;
use App\Models\HomePartnerItem;
use App\Models\HomeRecruitment;
use App\Models\HomeSlide;
use App\Models\HomeServicesSection;
use App\Models\HomeTargetAudienceSection;
use App\Models\HomeUniqueApproachSection;
use App\Models\HomeTeamSection;
use App\Models\HomeExpertSpaceSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHomeController extends Controller
{
    public function index()
    {
        $homeSlides      = HomeSlide::orderBy('home_slide_order')->get();
        $homeAbout       = HomeAbout::first();
        $homeKeyNumbers  = HomeKeyNumber::with('activeStats')->first();
        $homeRecruitment = HomeRecruitment::first();
        $homePartners    = HomePartner::with('allItems')->first();
        $footerSettings  = FooterSetting::first();
        $footerColumns   = FooterColumn::with('allLinks')->orderBy('column_order')->get();
        $footerLinks     = FooterLink::with('column')->orderBy('link_order')->get();
        $footerSocials   = FooterSocial::orderBy('social_order')->get();

        // Nouvelles sections
        $servicesSection = HomeServicesSection::first();
        $targetAudienceSection = HomeTargetAudienceSection::with('items')->first();
        $uniqueApproachSection = HomeUniqueApproachSection::with('items')->first();
        $teamSection = HomeTeamSection::first();
        $expertSpaceSection = HomeExpertSpaceSection::first();

        return view('admin.home.index', compact(
            'homeSlides',
            'homeAbout',
            'homeKeyNumbers',
            'homeRecruitment',
            'homePartners',
            'footerSettings',
            'footerColumns',
            'footerLinks',
            'footerSocials',
            'servicesSection',
            'targetAudienceSection',
            'uniqueApproachSection',
            'teamSection',
            'expertSpaceSection'
        ));
    }

    // GESTION DES SLIDES
    public function storeSlide(Request $request)
    {
        $request->validate([
            'home_slide_number'      => 'required|string|max:10',
            'home_slide_title'       => 'required|string|max:500',
            'home_slide_description' => 'required|string',
            'home_slide_image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_slide_order'       => 'required|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('home_slide_image')) {
            $imagePath = $request->file('home_slide_image')->store('slides', 'public');
        }

        HomeSlide::create([
            'home_slide_number'      => $request->home_slide_number,
            'home_slide_title'       => $request->home_slide_title,
            'home_slide_description' => $request->home_slide_description,
            'home_slide_image'       => $imagePath ? 'storage/' . $imagePath : null,
            'home_slide_order'       => $request->home_slide_order,
            'home_slide_active'      => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Slide ajoutée avec succès!');
    }

    public function updateSlide(Request $request, $id)
    {
        $slide = HomeSlide::findOrFail($id);

        $request->validate([
            'home_slide_number'      => 'required|string|max:10',
            'home_slide_title'       => 'required|string|max:500',
            'home_slide_description' => 'required|string',
            'home_slide_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_slide_order'       => 'required|integer',
        ]);

        $data = [
            'home_slide_number'      => $request->home_slide_number,
            'home_slide_title'       => $request->home_slide_title,
            'home_slide_description' => $request->home_slide_description,
            'home_slide_order'       => $request->home_slide_order,
        ];

        if ($request->hasFile('home_slide_image')) {
            // Supprimer l'ancienne image
            if ($slide->home_slide_image && Storage::disk('public')->exists(str_replace('storage/', '', $slide->home_slide_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $slide->home_slide_image));
            }

            $imagePath                = $request->file('home_slide_image')->store('slides', 'public');
            $data['home_slide_image'] = 'storage/' . $imagePath;
        }

        $slide->update($data);

        return redirect()->route('dashboard.accueil')->with('success', 'Slide modifiée avec succès!');
    }

    public function deleteSlide($id)
    {
        $slide = HomeSlide::findOrFail($id);

        // Supprimer l'image
        if ($slide->home_slide_image && Storage::disk('public')->exists(str_replace('storage/', '', $slide->home_slide_image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $slide->home_slide_image));
        }

        $slide->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Slide supprimée avec succès!');
    }

    public function toggleSlideStatus($id)
    {
        $slide = HomeSlide::findOrFail($id);
        $slide->update(['home_slide_active' => ! $slide->home_slide_active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut de la slide modifié avec succès!');
    }

    // GESTION DE LA SECTION À PROPOS
    public function updateAbout(Request $request)
    {
        $request->validate([
            'home_about_section_title' => 'required|string|max:255',
            'home_about_main_title'    => 'required|string|max:500',
            'home_about_description'   => 'required|string',
            'home_about_button_text'   => 'required|string|max:100',
            'home_about_button_link'   => 'required|string|max:500',
        ]);

        $homeAbout = HomeAbout::first();

        if ($homeAbout) {
            $homeAbout->update($request->all());
        } else {
            HomeAbout::create($request->all());
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Section À propos mise à jour avec succès!');
    }

    // GESTION DES CHIFFRES CLÉS
    public function updateKeyNumbers(Request $request)
    {
        $request->validate([
            'home_key_numbers_section_title' => 'required|string|max:255',
            'home_key_numbers_description'   => 'required|string',
            'home_key_numbers_button_text'   => 'required|string|max:100',
            'home_key_numbers_button_link'   => 'required|string|max:500',
            'home_key_numbers_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $homeKeyNumbers = HomeKeyNumber::first();
        $data           = $request->except('home_key_numbers_image');

        if ($request->hasFile('home_key_numbers_image')) {
            // Supprimer l'ancienne image
            if ($homeKeyNumbers && $homeKeyNumbers->home_key_numbers_image && Storage::disk('public')->exists(str_replace('storage/', '', $homeKeyNumbers->home_key_numbers_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $homeKeyNumbers->home_key_numbers_image));
            }

            $imagePath                      = $request->file('home_key_numbers_image')->store('key-numbers', 'public');
            $data['home_key_numbers_image'] = 'storage/' . $imagePath;
        }

        if ($homeKeyNumbers) {
            $homeKeyNumbers->update($data);
        } else {
            HomeKeyNumber::create($data);
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Chiffres clés mis à jour avec succès!');
    }

    // GESTION DES STATISTIQUES
    public function storeStat(Request $request)
    {
        $request->validate([
            'home_stat_number'      => 'required|string|max:50',
            'home_stat_description' => 'required|string|max:255',
            'home_stat_icon'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'home_stat_order'       => 'required|integer',
        ]);

        $iconPath = null;
        if ($request->hasFile('home_stat_icon')) {
            $iconPath = $request->file('home_stat_icon')->store('stats', 'public');
        }

        $homeKeyNumbers = HomeKeyNumber::first();
        if (! $homeKeyNumbers) {
            return redirect()->route('dashboard.accueil')->with('error', 'Veuillez d\'abord créer la section chiffres clés.');
        }

        HomeKeyNumberStat::create([
            'home_key_number_id'    => $homeKeyNumbers->id,
            'home_stat_number'      => $request->home_stat_number,
            'home_stat_description' => $request->home_stat_description,
            'home_stat_icon'        => $iconPath ? 'storage/' . $iconPath : null,
            'home_stat_order'       => $request->home_stat_order,
            'home_stat_active'      => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statistique ajoutée avec succès!');
    }

    public function updateStat(Request $request, $id)
    {
        $stat = HomeKeyNumberStat::findOrFail($id);

        $request->validate([
            'home_stat_number'      => 'required|string|max:50',
            'home_stat_description' => 'required|string|max:255',
            'home_stat_icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'home_stat_order'       => 'required|integer',
        ]);

        $data = [
            'home_stat_number'      => $request->home_stat_number,
            'home_stat_description' => $request->home_stat_description,
            'home_stat_order'       => $request->home_stat_order,
        ];

        if ($request->hasFile('home_stat_icon')) {
            // Supprimer l'ancienne icône
            if ($stat->home_stat_icon && Storage::disk('public')->exists(str_replace('storage/', '', $stat->home_stat_icon))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $stat->home_stat_icon));
            }

            $iconPath               = $request->file('home_stat_icon')->store('stats', 'public');
            $data['home_stat_icon'] = 'storage/' . $iconPath;
        }

        $stat->update($data);

        return redirect()->route('dashboard.accueil')->with('success', 'Statistique modifiée avec succès!');
    }

    public function deleteStat($id)
    {
        $stat = HomeKeyNumberStat::findOrFail($id);

        // Supprimer l'icône
        if ($stat->home_stat_icon && Storage::disk('public')->exists(str_replace('storage/', '', $stat->home_stat_icon))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $stat->home_stat_icon));
        }

        $stat->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Statistique supprimée avec succès!');
    }

    public function toggleStatStatus($id)
    {
        $stat = HomeKeyNumberStat::findOrFail($id);
        $stat->update(['home_stat_active' => ! $stat->home_stat_active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut de la statistique modifié avec succès!');
    }

    // GESTION DU RECRUTEMENT
    public function updateRecruitment(Request $request)
    {
        $request->validate([
            'home_recruitment_section_title' => 'required|string|max:255',
            'home_recruitment_description'   => 'required|string',
        ]);

        $homeRecruitment = HomeRecruitment::first();

        if ($homeRecruitment) {
            $homeRecruitment->update($request->all());
        } else {
            HomeRecruitment::create($request->all());
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Section recrutement mise à jour avec succès!');
    }

    // GESTION DES PARTENAIRES
    public function updatePartners(Request $request)
    {
        $request->validate([
            'home_partner_section_title' => 'required|string|max:255',
            'home_partner_description' => 'nullable|string',
        ]);

        $homePartners = HomePartner::firstOrNew(['id' => 1]);
        $homePartners->home_partner_section_title = $request->home_partner_section_title;
        $homePartners->home_partner_description = $request->home_partner_description;
        $homePartners->home_partner_active = true;
        $homePartners->save();

        return redirect()->route('dashboard.accueil')->with('success', 'Section partenaires mise à jour avec succès!');
    }

    public function storePartnerItem(Request $request)
    {
        $request->validate([
            'home_partner_item_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'home_partner_item_alt'   => 'nullable|string|max:255',
            'home_partner_item_order' => 'required|integer',
        ]);

        $homePartners = HomePartner::first();
        if (! $homePartners) {
            $homePartners = HomePartner::create([
                'home_partner_section_title' => 'ILS NOUS FONT CONFIANCE',
                'home_partner_active'        => true,
            ]);
        }

        $imagePath = null;
        if ($request->hasFile('home_partner_item_image')) {
            $imagePath = $request->file('home_partner_item_image')->store('partners', 'public');
        }

        HomePartnerItem::create([
            'home_partner_id'          => $homePartners->id,
            'home_partner_item_image'  => $imagePath ? 'storage/' . $imagePath : null,
            'home_partner_item_alt'    => $request->home_partner_item_alt,
            'home_partner_item_order'  => $request->home_partner_item_order,
            'home_partner_item_active' => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Partenaire ajouté avec succès!');
    }

    public function updatePartnerItem(Request $request, $id)
    {
        $partnerItem = HomePartnerItem::findOrFail($id);

        $request->validate([
            'home_partner_item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'home_partner_item_alt'   => 'nullable|string|max:255',
            'home_partner_item_order' => 'required|integer',
        ]);

        $data = [
            'home_partner_item_alt'   => $request->home_partner_item_alt,
            'home_partner_item_order' => $request->home_partner_item_order,
        ];

        if ($request->hasFile('home_partner_item_image')) {
            // Supprimer l'ancienne image
            if ($partnerItem->home_partner_item_image && Storage::disk('public')->exists(str_replace('storage/', '', $partnerItem->home_partner_item_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $partnerItem->home_partner_item_image));
            }

            $imagePath                       = $request->file('home_partner_item_image')->store('partners', 'public');
            $data['home_partner_item_image'] = 'storage/' . $imagePath;
        }

        $partnerItem->update($data);

        return redirect()->route('dashboard.accueil')->with('success', 'Partenaire modifié avec succès!');
    }

    public function deletePartnerItem($id)
    {
        $partnerItem = HomePartnerItem::findOrFail($id);

        // Supprimer l'image
        if ($partnerItem->home_partner_item_image && Storage::disk('public')->exists(str_replace('storage/', '', $partnerItem->home_partner_item_image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $partnerItem->home_partner_item_image));
        }

        $partnerItem->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Partenaire supprimé avec succès!');
    }

    public function togglePartnerItemStatus($id)
    {
        $partnerItem = HomePartnerItem::findOrFail($id);
        $partnerItem->update(['home_partner_item_active' => ! $partnerItem->home_partner_item_active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut du partenaire modifié avec succès!');
    }

    // GESTION DU FOOTER
    public function updateFooterSettings(Request $request)
    {
        $request->validate([
            'footer_logo1'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo2'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_copyright'  => 'required|string|max:255',
            'footer_legal_link' => 'required|string|max:500',
            'footer_legal_text' => 'required|string|max:255',
        ]);

        $footerSettings = FooterSetting::first();
        $data           = $request->except(['footer_logo1', 'footer_logo2']);

        if ($request->hasFile('footer_logo1')) {
            if ($footerSettings && $footerSettings->footer_logo1 && Storage::disk('public')->exists(str_replace('storage/', '', $footerSettings->footer_logo1))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $footerSettings->footer_logo1));
            }
            $logo1Path            = $request->file('footer_logo1')->store('footer', 'public');
            $data['footer_logo1'] = 'storage/' . $logo1Path;
        }

        if ($request->hasFile('footer_logo2')) {
            if ($footerSettings && $footerSettings->footer_logo2 && Storage::disk('public')->exists(str_replace('storage/', '', $footerSettings->footer_logo2))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $footerSettings->footer_logo2));
            }
            $logo2Path            = $request->file('footer_logo2')->store('footer', 'public');
            $data['footer_logo2'] = 'storage/' . $logo2Path;
        }

        if ($footerSettings) {
            $footerSettings->update($data);
        } else {
            FooterSetting::create($data);
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Paramètres du footer mis à jour avec succès!');
    }

    // Gestion des colonnes
    public function storeFooterColumn(Request $request)
    {
        $request->validate([
            'column_title' => 'required|string|max:255',
            'column_order' => 'required|integer',
        ]);

        FooterColumn::create([
            'column_title' => $request->column_title,
            'column_order' => $request->column_order,
            'is_active'    => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Colonne ajoutée avec succès!');
    }

    public function updateFooterColumn(Request $request, $id)
    {
        $column = FooterColumn::findOrFail($id);

        $request->validate([
            'column_title' => 'required|string|max:255',
            'column_order' => 'required|integer',
        ]);

        $column->update($request->all());

        return redirect()->route('dashboard.accueil')->with('success', 'Colonne modifiée avec succès!');
    }

    public function deleteFooterColumn($id)
    {
        $column = FooterColumn::findOrFail($id);
        $column->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Colonne supprimée avec succès!');
    }

    // Gestion des liens
    public function storeFooterLink(Request $request)
    {
        $request->validate([
            'footer_column_id' => 'required|exists:footer_columns,id',
            'link_text'        => 'required|string|max:255',
            'link_url'         => 'required|string|max:500',
            'link_order'       => 'required|integer',
        ]);

        FooterLink::create([
            'footer_column_id' => $request->footer_column_id,
            'link_text'        => $request->link_text,
            'link_url'         => $request->link_url,
            'link_order'       => $request->link_order,
            'is_active'        => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Lien ajouté avec succès!');
    }

    public function updateFooterLink(Request $request, $id)
    {
        $link = FooterLink::findOrFail($id);

        $request->validate([
            'link_text'  => 'required|string|max:255',
            'link_url'   => 'required|string|max:500',
            'link_order' => 'required|integer',
        ]);

        $link->update($request->all());

        return redirect()->route('dashboard.accueil')->with('success', 'Lien modifié avec succès!');
    }

    public function deleteFooterLink($id)
    {
        $link = FooterLink::findOrFail($id);
        $link->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Lien supprimé avec succès!');
    }

    // Gestion des réseaux sociaux
    public function storeFooterSocial(Request $request)
    {
        $request->validate([
            'social_platform' => 'required|string|max:255',
            'social_url'      => 'required|url|max:500',
            'social_icon'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'social_order'    => 'required|integer',
        ]);

        $iconPath = null;
        if ($request->hasFile('social_icon')) {
            $iconPath = $request->file('social_icon')->store('footer/socials', 'public');
        }

        FooterSocial::create([
            'social_platform' => $request->social_platform,
            'social_url'      => $request->social_url,
            'social_icon'     => $iconPath ? 'storage/' . $iconPath : null,
            'social_order'    => $request->social_order,
            'is_active'       => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Réseau social ajouté avec succès!');
    }

    public function updateFooterSocial(Request $request, $id)
    {
        $social = FooterSocial::findOrFail($id);

        $request->validate([
            'social_platform' => 'required|string|max:255',
            'social_url'      => 'required|url|max:500',
            'social_icon'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'social_order'    => 'required|integer',
        ]);

        $data = $request->except('social_icon');

        if ($request->hasFile('social_icon')) {
            if ($social->social_icon && Storage::disk('public')->exists(str_replace('storage/', '', $social->social_icon))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $social->social_icon));
            }
            $iconPath            = $request->file('social_icon')->store('footer/socials', 'public');
            $data['social_icon'] = 'storage/' . $iconPath;
        }

        $social->update($data);

        return redirect()->route('dashboard.accueil')->with('success', 'Réseau social modifié avec succès!');
    }

    public function deleteFooterSocial($id)
    {
        $social = FooterSocial::findOrFail($id);

        if ($social->social_icon && Storage::disk('public')->exists(str_replace('storage/', '', $social->social_icon))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $social->social_icon));
        }

        $social->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Réseau social supprimé avec succès!');
    }

    // Toggle methods pour activer/désactiver
    public function toggleColumnStatus($id)
    {
        $column = FooterColumn::findOrFail($id);
        $column->update(['is_active' => ! $column->is_active]);
        return redirect()->route('dashboard.accueil')->with('success', 'Statut de la colonne modifié!');
    }

    public function toggleLinkStatus($id)
    {
        $link = FooterLink::findOrFail($id);
        $link->update(['is_active' => ! $link->is_active]);
        return redirect()->route('dashboard.accueil')->with('success', 'Statut du lien modifié!');
    }

    public function toggleSocialStatus($id)
    {
        $social = FooterSocial::findOrFail($id);
        $social->update(['is_active' => ! $social->is_active]);
        return redirect()->route('dashboard.accueil')->with('success', 'Statut du réseau social modifié!');
    }
}
