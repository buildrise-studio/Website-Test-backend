<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Projet;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Temoignage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin user ────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@devagence.dz'],
            [
                'name'     => 'Administrateur',
                'password' => Hash::make('Admin@2024!'),
                'is_admin' => true,
            ]
        );

        // ─── Services ──────────────────────────────────────
        $services = [
            ['titre'=>'Site Web Vitrine',      'slug'=>'vitrine',     'description'=>'Une présence en ligne professionnelle.',          'icone'=>'Globe',       'couleur'=>'from-brand-500 to-brand-400',   'prix_depuis'=>'50 000 DA',  'delai'=>'2–3 semaines', 'ordre'=>1],
            ['titre'=>'Boutique E-commerce',   'slug'=>'ecommerce',   'description'=>'Vente en ligne sécurisée et performante.',        'icone'=>'ShoppingBag', 'couleur'=>'from-purple-600 to-purple-400', 'prix_depuis'=>'120 000 DA', 'delai'=>'4–6 semaines', 'ordre'=>2],
            ['titre'=>'Application Web',       'slug'=>'application', 'description'=>'Applications métiers sur mesure.',                'icone'=>'Code2',       'couleur'=>'from-teal-600 to-accent-500',   'prix_depuis'=>'200 000 DA', 'delai'=>'6–10 semaines','ordre'=>3],
            ['titre'=>'Système ERP / CRM',     'slug'=>'erp-crm',     'description'=>'Pilotez votre activité intelligemment.',          'icone'=>'BarChart3',   'couleur'=>'from-orange-600 to-amber-400',  'prix_depuis'=>'350 000 DA', 'delai'=>'8–14 semaines','ordre'=>4],
            ['titre'=>'Refonte & Maintenance', 'slug'=>'maintenance', 'description'=>'Modernisation et support technique continu.',     'icone'=>'Wrench',      'couleur'=>'from-rose-600 to-pink-400',     'prix_depuis'=>'30 000 DA',  'delai'=>'1–4 semaines', 'ordre'=>5],
        ];
        foreach ($services as $s) Service::firstOrCreate(['slug' => $s['slug']], array_merge($s, ['actif' => true]));

        // ─── Projets ───────────────────────────────────────
        $projets = [
            ['titre'=>'BatiHome Immobilier', 'description'=>'Plateforme immobilière avec filtres et carte interactive.', 'categorie'=>'Vitrine',   'technologies'=>['React','Laravel','MySQL'],      'emoji'=>'🏠', 'annee'=>2024, 'ordre'=>1],
            ['titre'=>'ShopDZ E-commerce',   'description'=>'Boutique multi-vendeurs avec paiement CIB et livraison.', 'categorie'=>'E-commerce', 'technologies'=>['Vue.js','Laravel','Stripe'],     'emoji'=>'🛒', 'annee'=>2024, 'ordre'=>2],
            ['titre'=>'EduPro LMS',          'description'=>'Plateforme e-learning avec quiz et certificats.',         'categorie'=>'App Web',    'technologies'=>['React','Node.js','MongoDB'],     'emoji'=>'📚', 'annee'=>2023, 'ordre'=>3],
            ['titre'=>'CRM ProGestion',      'description'=>'CRM complet : clients, devis, facturation, analytics.',   'categorie'=>'ERP/CRM',    'technologies'=>['React','Laravel','PostgreSQL'],  'emoji'=>'📊', 'annee'=>2024, 'ordre'=>4],
            ['titre'=>'RestaurantPro',       'description'=>'Site vitrine + menu interactif + réservation en ligne.',  'categorie'=>'Vitrine',    'technologies'=>['Next.js','TailwindCSS'],         'emoji'=>'🍽️','annee'=>2023, 'ordre'=>5],
            ['titre'=>'MediCare Clinique',   'description'=>'Gestion des rendez-vous et dossiers patients.',           'categorie'=>'App Web',    'technologies'=>['React','Laravel'],              'emoji'=>'🏥', 'annee'=>2024, 'ordre'=>6],
        ];
        foreach ($projets as $p) Projet::firstOrCreate(['titre' => $p['titre']], array_merge($p, ['actif' => true]));

        // ─── FAQs ──────────────────────────────────────────
        $faqs = [
            ['question'=>'Combien coûte un site web ?',           'reponse'=>'Les tarifs varient selon la complexité. Un site vitrine démarre à partir de 50 000 DA.', 'categorie'=>'Tarifs',    'ordre'=>1],
            ['question'=>'Quel est le délai de réalisation ?',    'reponse'=>'Entre 2 et 8 semaines selon le projet. Nous établissons un planning précis dès le démarrage.', 'categorie'=>'Délais',   'ordre'=>2],
            ['question'=>'Mon site sera-t-il responsive ?',       'reponse'=>'Oui, tous nos sites sont 100% responsive et optimisés pour mobile, tablette et desktop.', 'categorie'=>'Technique', 'ordre'=>3],
            ['question'=>'Proposez-vous la maintenance ?',        'reponse'=>'Oui. 3 mois de support offert, puis contrats mensuels disponibles.', 'categorie'=>'Support',  'ordre'=>4],
            ['question'=>'Puis-je modifier le contenu moi-même ?','reponse'=>'Oui, chaque site inclut un dashboard admin intuitif avec formation incluse.', 'categorie'=>'Support',  'ordre'=>5],
        ];
        foreach ($faqs as $f) Faq::firstOrCreate(['question' => $f['question']], array_merge($f, ['actif' => true]));

        // ─── Témoignages ───────────────────────────────────
        $temoignages = [
            ['nom'=>'Karim Benali',    'entreprise'=>'BatiHome SARL', 'message'=>'Équipe très professionnelle. Notre site est magnifique et nos ventes ont doublé !', 'note'=>5, 'valide'=>true],
            ['nom'=>'Sara Medjdoub',   'entreprise'=>'ShopDZ',        'message'=>'Réalisation rapide et parfaite. Exactement ce dont nous avions besoin.', 'note'=>5, 'valide'=>true],
            ['nom'=>'Mohamed Haddad',  'entreprise'=>'EduPro',        'message'=>'Support réactif et code de qualité. Je recommande vivement DevAgence !', 'note'=>5, 'valide'=>true],
        ];
        foreach ($temoignages as $t) Temoignage::firstOrCreate(['nom' => $t['nom']], $t);

        $this->command->info('✅ Seed terminé ! Admin : admin@devagence.dz / Admin@2024!');
    }
}