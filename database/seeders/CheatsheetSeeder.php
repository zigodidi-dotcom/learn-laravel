<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CodeExample;
use App\Models\Feature;
use App\Models\Tag;
use App\Models\Term;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheatsheetSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        CodeExample::truncate();
        DB::table('feature_tag')->truncate();
        DB::table('feature_term')->truncate();
        Feature::truncate();
        Tag::truncate();
        Term::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->seedTags();
        $this->seedCategories();
        $this->seedTerms();
        $this->seedFeatures();
        $this->seedCodeExamples();
    }

    /* ═══════════════════════════════════════════════════ TAGS */
    private function seedTags(): void
    {
        $tags = [
            ['name' => 'Nouveauté 11.x',    'slug' => 'new-in-11',      'color' => '#10b981'],
            ['name' => 'Nouveauté 10.x',    'slug' => 'new-in-10',      'color' => '#3b82f6'],
            ['name' => 'Bonne pratique',     'slug' => 'best-practice',  'color' => '#f59e0b'],
            ['name' => 'Performance',        'slug' => 'performance',    'color' => '#ef4444'],
            ['name' => 'Sécurité',           'slug' => 'security',       'color' => '#dc2626'],
            ['name' => 'Asynchrone',         'slug' => 'async',          'color' => '#06b6d4'],
            ['name' => 'Artisan CLI',        'slug' => 'artisan',        'color' => '#84cc16'],
            ['name' => 'Eloquent ORM',       'slug' => 'eloquent',       'color' => '#8b5cf6'],
            ['name' => 'Blade',              'slug' => 'blade',          'color' => '#f97316'],
            ['name' => 'Testing',            'slug' => 'testing',        'color' => '#a78bfa'],
            ['name' => 'Helper',             'slug' => 'helper',         'color' => '#14b8a6'],
            ['name' => 'Facade',             'slug' => 'facade',         'color' => '#e879f9'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }

    /* ═══════════════════════════════════════════════════ CATEGORIES */
    private function seedCategories(): void
    {
        $categories = [
            ['name' => 'Routing',           'slug' => 'routing',        'icon' => '🗺️',  'color' => '#6366f1', 'description' => 'Définition des routes HTTP, groupes, nommage, middlewares sur les routes.'],
            ['name' => 'Blade Templates',   'slug' => 'blade',          'icon' => '🌿',  'color' => '#34d399', 'description' => 'Moteur de templates Blade : directives, composants, layouts, slots.'],
            ['name' => 'Eloquent ORM',      'slug' => 'eloquent',       'icon' => '🗄️',  'color' => '#0ea5e9', 'description' => 'ORM ActiveRecord : modèles, relations, scopes, observers, mutateurs.'],
            ['name' => 'Migrations',        'slug' => 'migrations',     'icon' => '🔀',  'color' => '#f97316', 'description' => 'Gestion versionée du schéma de base de données avec Schema Builder.'],
            ['name' => 'Authentification',  'slug' => 'auth',           'icon' => '🔒',  'color' => '#dc2626', 'description' => 'Auth, Gates, Policies, Sanctum, Passport, Breeze, Jetstream.'],
            ['name' => 'Middleware',        'slug' => 'middleware',     'icon' => '🔗',  'color' => '#8b5cf6', 'description' => 'Filtres HTTP, middleware de route, groupes, terminable middleware.'],
            ['name' => 'Request & Response','slug' => 'http',           'icon' => '🌐',  'color' => '#f59e0b', 'description' => 'Requêtes HTTP, validation, réponses JSON, redirections, téléchargements.'],
            ['name' => 'Validation',        'slug' => 'validation',     'icon' => '✅',  'color' => '#10b981', 'description' => 'Règles de validation, Form Requests, messages personnalisés, règles custom.'],
            ['name' => 'Service Container', 'slug' => 'container',      'icon' => '🔧',  'color' => '#14b8a6', 'description' => 'IoC Container, binding, singleton, contextual binding, Service Providers.'],
            ['name' => 'Facades',           'slug' => 'facades',        'icon' => '🏛️',  'color' => '#a78bfa', 'description' => 'Façades statiques, real-time facades, liste des facades built-in.'],
            ['name' => 'Collections',       'slug' => 'collections',    'icon' => '📦',  'color' => '#fb923c', 'description' => 'API Collections fluente : map, filter, reduce, groupBy, pluck, lazy collections.'],
            ['name' => 'Cache',             'slug' => 'cache',          'icon' => '⚡',  'color' => '#fbbf24', 'description' => 'Drivers de cache (Redis, Memcached, File), tags, remember, atomic locks.'],
            ['name' => 'Queues & Jobs',     'slug' => 'queues',         'icon' => '📨',  'color' => '#3b82f6', 'description' => 'Jobs, Workers, Horizon, Batching, Chains, Rate Limiting, Failed Jobs.'],
            ['name' => 'Events & Listeners','slug' => 'events',         'icon' => '📡',  'color' => '#e879f9', 'description' => 'Events, Listeners, Observers, auto-discovery, broadcast.'],
            ['name' => 'Notifications',     'slug' => 'notifications',  'icon' => '🔔',  'color' => '#06b6d4', 'description' => 'Canaux : mail, SMS, database, broadcast, Slack, notifications on-demand.'],
            ['name' => 'Mail',              'slug' => 'mail',           'icon' => '✉️',  'color' => '#67e8f9', 'description' => 'Mailables, Markdown mail, attachments, mailer drivers, testing.'],
            ['name' => 'Storage & Files',   'slug' => 'storage',        'icon' => '💾',  'color' => '#94a3b8', 'description' => 'Flysystem, disks, streams, signed URLs, file uploads, S3.'],
            ['name' => 'Artisan Console',   'slug' => 'artisan',        'icon' => '💻',  'color' => '#84cc16', 'description' => 'Commandes Artisan, arguments, options, output, Tinker, scheduling.'],
            ['name' => 'Testing',           'slug' => 'testing',        'icon' => '🧪',  'color' => '#f472b6', 'description' => 'PHPUnit, Pest, HTTP tests, Dusk, mocks, fakes, database testing.'],
            ['name' => 'Helpers & Strings', 'slug' => 'helpers',        'icon' => '🛠️',  'color' => '#a3e635', 'description' => 'Helpers globaux, Str, Arr, Number, fluent strings, macros.'],
            ['name' => 'Configuration',     'slug' => 'configuration',  'icon' => '⚙️',  'color' => '#818cf8', 'description' => 'Fichiers de config, env(), config(), caching de config, environnements.'],
            ['name' => 'Scheduling',        'slug' => 'scheduling',     'icon' => '⏰',  'color' => '#fb7185', 'description' => 'Task Scheduler, cron expressions, fréquences, output, hooks.'],
            ['name' => 'HTTP Client',       'slug' => 'http-client',    'icon' => '🔌',  'color' => '#2dd4bf', 'description' => 'Client HTTP basé sur Guzzle : requests, async, retries, fake, macros.'],
            ['name' => 'Livewire & Volt',   'slug' => 'livewire',       'icon' => '⚡',  'color' => '#6366f1', 'description' => 'Composants Livewire full-stack, Volt (single-file), propriétés, actions, events.'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }

    /* ═══════════════════════════════════════════════════ TERMS */
    private function seedTerms(): void
    {
        $terms = [
            ['name' => 'Service Container', 'slug' => 'service-container',
             'definition' => 'Noyau du framework Laravel gérant les dépendances et l\'injection. Résout automatiquement les interfaces en implémentations via les bindings. Accessible via app() ou via l\'injection de type dans les contrôleurs.'],
            ['name' => 'Service Provider', 'slug' => 'service-provider',
             'definition' => 'Classe de bootstrap enregistrant des services dans le container. boot() est appelé après tous les enregistrements. register() lie les services. AppServiceProvider est le point d\'extension principal.'],
            ['name' => 'Facade', 'slug' => 'facade',
             'definition' => 'Proxy statique vers une implémentation résolue depuis le container. Ex: Cache::get() appelle getCache() sur le FacadeRoot. Real-time facades permettent de créer des facades à la volée.'],
            ['name' => 'Eloquent', 'slug' => 'eloquent',
             'definition' => 'ORM ActiveRecord de Laravel. Chaque modèle représente une table. Les relations (hasMany, belongsTo…) retournent des query builders. Lazy loading vs eager loading contrôlent les N+1.'],
            ['name' => 'Middleware', 'slug' => 'middleware-term',
             'definition' => 'Couche HTTP interceptant les requêtes avant le contrôleur ou les réponses après. Pile de middlewares avec priorités. Terminable middlewares s\'exécutent après l\'envoi de la réponse.'],
            ['name' => 'Job', 'slug' => 'job',
             'definition' => 'Classe encapsulant une tâche à exécuter de façon asynchrone via une queue. Dispatch avec dispatch() ou via Bus facade. ShouldQueue déclenche l\'exécution différée.'],
            ['name' => 'Event', 'slug' => 'event',
             'definition' => 'Objet signalant qu\'une action s\'est produite dans l\'application. Dispatché via event() ou Event::dispatch(). Les listeners et observers réagissent sans coupler les modules.'],
            ['name' => 'Policy', 'slug' => 'policy',
             'definition' => 'Classe centralisant la logique d\'autorisation pour un modèle Eloquent. Méthodes view, create, update, delete, restore. Enregistrée dans AuthServiceProvider ou auto-découverte.'],
            ['name' => 'Gate', 'slug' => 'gate',
             'definition' => 'Mécanisme d\'autorisation simple sans modèle associé. Gate::define() crée une règle. Gate::allows()/denies() les évalue. @can en Blade. Complémentaire aux Policies.'],
            ['name' => 'Blade Component', 'slug' => 'blade-component',
             'definition' => 'Composant réutilisable Blade avec classe PHP associée. Slots nommés pour la composition. Props passées comme attributs HTML. Anonymous components sans classe via resources/views/components/.'],
            ['name' => 'Eager Loading', 'slug' => 'eager-loading',
             'definition' => 'Chargement anticipé des relations Eloquent en une seule requête via with(). Évite le problème N+1 : sans eager loading, N modèles + N relations = N+1 requêtes SQL.'],
            ['name' => 'Scope', 'slug' => 'scope',
             'definition' => 'Méthode sur un modèle Eloquent encapsulant des conditions de requête réutilisables. Local scope : scopeActive() → ->active(). Global scope : appliqué automatiquement à toutes les requêtes du modèle.'],
            ['name' => 'Observer', 'slug' => 'observer',
             'definition' => 'Classe regroupant les listeners aux événements du cycle de vie d\'un modèle Eloquent : creating, created, updating, updated, saving, saved, deleting, deleted, restoring, restored, forceDeleted.'],
            ['name' => 'Accessor/Mutator', 'slug' => 'accessor-mutator',
             'definition' => 'Méthodes Eloquent transformant les valeurs lors de la lecture (accessor) ou de l\'écriture (mutator). Depuis Laravel 9 : méthodes get/set avec cast Attribute. Ex: getFullNameAttribute() ou via #[Attribute].'],
            ['name' => 'Form Request', 'slug' => 'form-request',
             'definition' => 'Classe dédiée à la validation et à l\'autorisation d\'une requête HTTP. rules() retourne les règles, authorize() contrôle l\'accès. Résolu automatiquement par le container dans les contrôleurs.'],
            ['name' => 'Tinker', 'slug' => 'tinker',
             'definition' => 'REPL (Read-Eval-Print Loop) interactif pour Laravel basé sur PsySH. Accès direct aux modèles, facades et helpers en ligne de commande. Incontournable pour tester rapidement du code.'],
            ['name' => 'Sanctum', 'slug' => 'sanctum',
             'definition' => 'Package d\'authentification léger pour SPAs, mobile apps et APIs simples. Token API personnels, authentification de session pour SPAs same-domain. Alternative légère à Passport (OAuth2).'],
            ['name' => 'Pipeline', 'slug' => 'pipeline',
             'definition' => 'Pattern de traitement en chaîne. Pipeline::send($data)->through([$stage1, $stage2])->thenReturn(). Chaque stage reçoit le payload et le passe à la suite. Utilisé en interne pour les middlewares.'],
            ['name' => 'Macro', 'slug' => 'macro',
             'definition' => 'Extension d\'une classe existante sans héritage. Macroable permet d\'ajouter des méthodes à Collection, Str, Request, Response, etc. via MyClass::macro(\'name\', fn() => ...).'],
            ['name' => 'Vite', 'slug' => 'vite',
             'definition' => 'Outil de build front-end intégré dans Laravel depuis la v9 (remplace Mix). HMR ultra-rapide en développement, bundling optimisé en production. Plugin laravel/vite-plugin gère la configuration automatiquement.'],
        ];

        foreach ($terms as $term) {
            Term::create($term);
        }
    }

    /* ═══════════════════════════════════════════════════ FEATURES */
    private function seedFeatures(): void
    {
        $tagMap = Tag::pluck('id', 'slug');
        $catMap = Category::pluck('id', 'slug');

        $features = $this->getAllFeatures();

        foreach ($features as $data) {
            $catId = $catMap[$data['category']] ?? null;
            if (!$catId) continue;

            $feature = Feature::create([
                'category_id'   => $catId,
                'name'          => $data['name'],
                'slug'          => $data['slug'],
                'description'   => $data['description'],
                'since_version' => $data['since'] ?? null,
                'difficulty'    => $data['difficulty'],
                'type'          => $data['type'],
            ]);

            $tagIds = collect($data['tags'] ?? [])
                ->map(fn($s) => $tagMap[$s] ?? null)
                ->filter()
                ->values()
                ->toArray();

            if ($tagIds) $feature->tags()->attach($tagIds);
        }
    }

    private function getAllFeatures(): array
    {
        return [
            // ─── ROUTING ──────────────────────────────────────────────────────
            ['name' => 'Routes basiques (get/post/put/delete)', 'slug' => 'basic-routes', 'category' => 'routing', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'Route::get(), post(), put(), patch(), delete(), options(). Route::any() accepte toutes méthodes. Route::match([\'get\',\'post\'], ...) pour plusieurs méthodes. Paramètres via {id}, optionnels via {id?}.'],
            ['name' => 'Groupes de routes', 'slug' => 'route-groups', 'category' => 'routing', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'Route::group() partage prefix, middleware, namespace, name. Route::prefix(\'/api\')->middleware(\'auth\')->group(...). Groupes imbriquables. name() préfixe les noms de routes enfants.'],
            ['name' => 'Route Model Binding', 'slug' => 'route-model-binding', 'category' => 'routing', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice', 'eloquent'],
             'description' => 'Laravel résout automatiquement un modèle depuis l\'ID de route. Implicite: {user} → User::findOrFail($id). Explicite: Route::bind(). Personnaliser la colonne: getRouteKeyName() ou {user:email}.'],
            ['name' => 'Routes nommées', 'slug' => 'named-routes', 'category' => 'routing', 'difficulty' => 'beginner', 'type' => 'concept',
             'description' => '->name(\'profile\') nomme une route. route(\'profile\', [\'id\' => 1]) génère l\'URL. Protège contre les changements d\'URL (seul le nom est référencé). currentRouteName() vérifie la route active.'],
            ['name' => 'Resource Routes', 'slug' => 'resource-routes', 'category' => 'routing', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'Route::resource(\'photos\', PhotoController::class) génère 7 routes (index, create, store, show, edit, update, destroy). apiResource() supprime create et edit. only/except filtrent les actions.'],
            ['name' => 'Route Fallback', 'slug' => 'route-fallback', 'category' => 'routing', 'difficulty' => 'intermediate', 'type' => 'concept',
             'description' => 'Route::fallback() gère toutes les URLs non matchées (404 personnalisé). Doit être la dernière route déclarée. Idéal pour les SPAs qui gèrent leur propre routing côté client.'],
            ['name' => 'Signed URLs', 'slug' => 'signed-urls', 'category' => 'routing', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['security'],
             'description' => 'URL::signedRoute() génère une URL avec signature HMAC. URL::temporarySignedRoute() ajoute une expiration. hasValidSignature() vérifie. Middleware signed protège les routes. Utile pour unsubscribe links.'],
            ['name' => 'Rate Limiting sur les routes', 'slug' => 'route-rate-limiting', 'category' => 'routing', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['security', 'new-in-11'],
             'description' => 'RateLimiter::for(\'api\', fn($req) => Limit::perMinute(60)->by($req->user()?->id)). Middleware throttle:api. Limites différentes par utilisateur. Headers X-RateLimit-* dans la réponse.'],

            // ─── BLADE ────────────────────────────────────────────────────────
            ['name' => 'Directives Blade essentielles', 'slug' => 'blade-directives', 'category' => 'blade', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['blade'],
             'description' => '@if/@elseif/@else/@endif, @unless, @isset, @empty, @auth/@guest, @foreach/@for/@while, @forelse/@empty, @switch/@case, @break, @continue, @php, @verbatim.'],
            ['name' => 'Layouts Blade', 'slug' => 'blade-layouts', 'category' => 'blade', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['blade', 'best-practice'],
             'description' => 'Deux approches : @extends/@section/@yield (héritage classique) ou composants x-layout avec $slot (moderne). @parent() inclut le contenu parent d\'une section. @stack/@push pour les scripts/CSS.'],
            ['name' => 'Composants Blade (x-)', 'slug' => 'blade-components', 'category' => 'blade', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['blade', 'best-practice', 'new-in-10'],
             'description' => '<x-alert type="error" :message="$msg"> avec classe App\\View\\Components\\Alert. Props via $type, slots nommés @slot/@slot. Anonymous components dans views/components/ sans classe. Composants dynamiques avec <x-dynamic-component>.'],
            ['name' => 'Directives @once, @env, @production', 'slug' => 'blade-once-env', 'category' => 'blade', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['blade'],
             'description' => '@once n\'affiche un bloc qu\'une seule fois même si le template est inclus plusieurs fois. @env(\'production\') affiche uniquement en production. @production raccourci. @unless/@endunless inverse @if.'],
            ['name' => 'Blade Strings & Service Injection', 'slug' => 'blade-service-inject', 'category' => 'blade', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['blade'],
             'description' => '@inject(\'metrics\', \'App\\Services\\MetricsService\') injecte un service dans le template. Blade::render() rend une chaîne Blade. Blade::directive() crée des directives custom. Blade::if() crée des directives conditionnelles.'],

            // ─── ELOQUENT ─────────────────────────────────────────────────────
            ['name' => 'Modèle Eloquent & conventions', 'slug' => 'eloquent-model', 'category' => 'eloquent', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['eloquent', 'best-practice'],
             'description' => 'Hérite de Model. Table = snake_case pluriel du nom (User → users). $fillable vs $guarded. $timestamps (created_at/updated_at). $primaryKey, $keyType, $incrementing. Méthodes : find(), all(), where(), first(), firstOrFail().'],
            ['name' => 'Relations Eloquent', 'slug' => 'eloquent-relations', 'category' => 'eloquent', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['eloquent', 'best-practice'],
             'description' => 'hasOne, hasMany, belongsTo, belongsToMany, hasManyThrough, hasOneThrough, morphOne, morphMany, morphTo, morphToMany. withCount(), withSum(), withAvg() pour les agrégats. through() pour les jointures.'],
            ['name' => 'Scopes (Local & Global)', 'slug' => 'eloquent-scopes', 'category' => 'eloquent', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['eloquent'],
             'description' => 'Local scope : scopeActive(Builder $q) → User::active()->get(). Global scope : implémente Scope::apply(), appliqué à toutes requêtes. withoutGlobalScope() pour le désactiver. SoftDeletes est un global scope.'],
            ['name' => 'Mutators & Accessors (Cast)', 'slug' => 'eloquent-casts', 'category' => 'eloquent', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['eloquent', 'new-in-10'],
             'description' => '$casts: [\'options\' => \'array\', \'price\' => \'decimal:2\', \'status\' => StatusEnum::class]. Accessor: protected function name(): Attribute { return Attribute::make(get: fn($v) => strtoupper($v)); }. Custom casts via AsCollection.'],
            ['name' => 'Observers', 'slug' => 'eloquent-observers', 'category' => 'eloquent', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['eloquent'],
             'description' => 'Classe avec méthodes creating, created, updating, updated, saving, saved, deleting, deleted, restoring, restored. User::observe(UserObserver::class). Auto-discovery via #[ObservedBy] sur le modèle depuis Laravel 10.'],
            ['name' => 'Eager Loading & N+1', 'slug' => 'eager-loading', 'category' => 'eloquent', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['eloquent', 'performance'],
             'description' => 'with(\'comments\', \'author\') charge les relations en 2 requêtes total. withCount(\'comments\'). load() sur une collection déjà chargée. Model::preventLazyLoading(true) en dev lance une exception si N+1 détecté.'],
            ['name' => 'Soft Deletes', 'slug' => 'soft-deletes', 'category' => 'eloquent', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['eloquent'],
             'description' => 'use SoftDeletes ajoute deleted_at. delete() → soft delete. forceDelete() → suppression définitive. withTrashed() inclut les supprimés. onlyTrashed() ne les retourne qu\'eux. restore() récupère.'],
            ['name' => 'Factories & Fake Data', 'slug' => 'eloquent-factories', 'category' => 'eloquent', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['testing', 'eloquent'],
             'description' => 'php artisan make:factory. HasFactory sur le modèle. definition() avec Faker. User::factory()->count(50)->create(). States : factory()->suspended()->create(). recycle() pour réutiliser des modèles. for() pour les relations.'],
            ['name' => 'Chunking & Lazy Collections', 'slug' => 'eloquent-chunking', 'category' => 'eloquent', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['eloquent', 'performance'],
             'description' => 'chunk(200, fn($users) => ...) traite par lots. chunkById() plus performant (pas de OFFSET). cursor() retourne un LazyCollection (générateur). lazy() charge par lots en itérant. Évite de charger des milliers de modèles en mémoire.'],

            // ─── MIGRATIONS ───────────────────────────────────────────────────
            ['name' => 'Schema Builder', 'slug' => 'schema-builder', 'category' => 'migrations', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'Schema::create(), table(), drop(), dropIfExists(), rename(), hasTable(), hasColumn(). Blueprint : string, text, integer, bigInteger, boolean, date, timestamp, json, uuid, ulid, foreignId, morphs.'],
            ['name' => 'Colonnes & Modificateurs', 'slug' => 'column-modifiers', 'category' => 'migrations', 'difficulty' => 'beginner', 'type' => 'concept',
             'description' => 'nullable(), default(), unsigned(), unique(), index(), primary(), comment(), after(), first(), change(). $table->timestamps() = created_at + updated_at. $table->softDeletes(). $table->rememberToken(). morphs() = {name}_id + {name}_type.'],
            ['name' => 'Foreign Keys', 'slug' => 'foreign-keys', 'category' => 'migrations', 'difficulty' => 'beginner', 'type' => 'concept',
             'description' => 'foreignId(\'user_id\')->constrained()->cascadeOnDelete(). Raccourci moderne vs $table->foreign(\'user_id\')->references(\'id\')->on(\'users\'). constrained(\'custom_table\') pour une table non-standard.'],
            ['name' => 'Squashing migrations', 'slug' => 'migration-squash', 'category' => 'migrations', 'difficulty' => 'intermediate', 'type' => 'artisan',
             'description' => 'php artisan schema:dump compresse toutes les migrations en un seul fichier SQL dans database/schema/. Accélère les tests (un seul import SQL). --prune supprime les anciennes migrations. Nécessite MySQL/PostgreSQL/SQLite.'],

            // ─── AUTH ─────────────────────────────────────────────────────────
            ['name' => 'Gates & Policies', 'slug' => 'gates-policies', 'category' => 'auth', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['security', 'best-practice'],
             'description' => 'Gate::define(\'edit-post\', fn(User $u, Post $p) => $u->id === $p->user_id). Policy auto-découverte par convention (Post → PostPolicy). can() sur le modèle User. @can/cannot en Blade. authorize() dans les contrôleurs.'],
            ['name' => 'Sanctum (API tokens)', 'slug' => 'sanctum', 'category' => 'auth', 'difficulty' => 'intermediate', 'type' => 'component', 'tags' => ['security', 'best-practice'],
             'description' => 'HasApiTokens sur le modèle User. createToken(\'nom\')->plainTextToken. Middleware auth:sanctum. Abilities sur les tokens. Token expiration. SPA authentication via cookies. Revocation : user()->tokens()->delete().'],
            ['name' => 'Laravel Breeze', 'slug' => 'breeze', 'category' => 'auth', 'difficulty' => 'beginner', 'type' => 'component', 'tags' => ['new-in-10'],
             'description' => 'Scaffold d\'authentification minimaliste. Stacks disponibles : Blade, Vue (Inertia), React (Inertia), API. php artisan breeze:install blade. Fournit login, register, forgot-password, email verification.'],

            // ─── MIDDLEWARE ───────────────────────────────────────────────────
            ['name' => 'Créer un Middleware', 'slug' => 'create-middleware', 'category' => 'middleware', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'php artisan make:middleware EnsureTokenIsValid. handle(Request $request, Closure $next). Retourner $next($request) continue. Middleware "after" traite $response après. Enregistrement dans bootstrap/app.php (Laravel 11+) ou Kernel.php.'],
            ['name' => 'Middleware de groupe', 'slug' => 'middleware-groups', 'category' => 'middleware', 'difficulty' => 'intermediate', 'type' => 'concept',
             'description' => 'web (sessions, CSRF, cookies) et api (throttle, bindings) sont les groupes built-in. Route::middleware([\'auth\', \'verified\'])->group(...). Alias dans bootstrap/app.php avec withMiddleware()->alias().'],
            ['name' => 'Terminable Middleware', 'slug' => 'terminable-middleware', 'category' => 'middleware', 'difficulty' => 'advanced', 'type' => 'concept',
             'description' => 'Implémente terminate(Request $request, Response $response). Exécuté après l\'envoi de la réponse au client (FPM). Idéal pour le logging ou analytics sans impacter le temps de réponse perçu.'],

            // ─── HTTP ─────────────────────────────────────────────────────────
            ['name' => 'Objet Request', 'slug' => 'request-object', 'category' => 'http', 'difficulty' => 'beginner', 'type' => 'concept',
             'description' => '$request->input(), get(), post(), query(), all(), only(), except(), has(), filled(), missing(). $request->file(), ip(), url(), path(), method(), isMethod(), expectsJson(), wantsJson(). Route params via $request->route(\'id\').'],
            ['name' => 'Réponses HTTP', 'slug' => 'http-responses', 'category' => 'http', 'difficulty' => 'beginner', 'type' => 'concept',
             'description' => 'return response()->json($data, 201). response()->download($path). response()->streamDownload(fn() => ...). redirect()->route(\'home\'). back()->withInput()->withErrors(). response()->view(\'...\')->header(\'Cache-Control\', \'no-cache\').'],
            ['name' => 'File Upload', 'slug' => 'file-upload', 'category' => 'http', 'difficulty' => 'intermediate', 'type' => 'concept',
             'description' => '$request->hasFile(\'photo\') && $request->file(\'photo\')->isValid(). store(\'avatars\') sur le disk par défaut. storeAs(\'avatars\', \'filename.jpg\', \'s3\'). getClientOriginalName(), getMimeType(), getSize(), extension().'],
            ['name' => '#[MapQueryString] / Resource collection', 'slug' => 'api-resources', 'category' => 'http', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['best-practice', 'new-in-11'],
             'description' => 'php artisan make:resource UserResource. toArray() transforme un modèle. UserResource::collection($users) pour les listes. additional() ajoute des métadonnées. ConditionallyLoadsAttributes::when() charge conditionnellement.'],

            // ─── VALIDATION ───────────────────────────────────────────────────
            ['name' => 'Règles de validation built-in', 'slug' => 'validation-rules', 'category' => 'validation', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'required, nullable, string, integer, numeric, boolean, array, email, url, ip, uuid, date, before/after, min/max, between, in, not_in, exists, unique, confirmed, image, mimes, size, dimensions.'],
            ['name' => 'Form Request', 'slug' => 'form-request', 'category' => 'validation', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'php artisan make:request StorePostRequest. authorize() → Gate ou true. rules() → tableau. messages() personnalise les messages. attributes() renomme les champs. after() hooks post-validation. prepareForValidation() transforme avant.'],
            ['name' => 'Règles custom (Rule objects)', 'slug' => 'custom-rules', 'category' => 'validation', 'difficulty' => 'advanced', 'type' => 'concept',
             'description' => 'php artisan make:rule Uppercase. validate() reçoit ($attribute, $value, $fail). Invokable rules depuis Laravel 9. Rule::when() pour les règles conditionnelles. Implicit rules via ImplicitRule (valide même si champ absent).'],
            ['name' => 'Validation de tableaux', 'slug' => 'array-validation', 'category' => 'validation', 'difficulty' => 'intermediate', 'type' => 'concept',
             'description' => '\'photos.*.title\' => \'required|string\'. \'tags\' => \'array|min:1\'. Rule::forEach() pour des règles dynamiques par item. Validator::make()->validate() hors Form Request. validated() retourne uniquement les champs validés.'],

            // ─── SERVICE CONTAINER ────────────────────────────────────────────
            ['name' => 'Binding & Singleton', 'slug' => 'container-binding', 'category' => 'container', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'app()->bind(Interface::class, Implementation::class). singleton() → une seule instance. instance() → objet déjà créé. scoped() → singleton par requête. make() résout. when()->needs()->give() pour le binding contextuel.'],
            ['name' => 'Service Providers', 'slug' => 'service-providers', 'category' => 'container', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'register() : bindings uniquement. boot() : logique après enregistrement (routes, views, gates). DeferrableProvider : chargement lazy. Auto-discovery dans composer.json extra.laravel.providers. AppServiceProvider en point d\'entrée principal.'],
            ['name' => 'Contextual Binding', 'slug' => 'contextual-binding', 'category' => 'container', 'difficulty' => 'advanced', 'type' => 'concept',
             'description' => 'app()->when(PhotoController::class)->needs(Filesystem::class)->give(fn() => Storage::disk(\'s3\')). Injecter différentes implémentations selon la classe consommatrice. Tagged binding : bind/tag/tagged pour injecter une collection de services.'],

            // ─── FACADES ──────────────────────────────────────────────────────
            ['name' => 'Facades built-in principales', 'slug' => 'built-in-facades', 'category' => 'facades', 'difficulty' => 'beginner', 'type' => 'facade', 'tags' => ['facade'],
             'description' => 'Auth, Cache, Config, Cookie, Crypt, DB, Event, File, Gate, Hash, Http, Log, Mail, Queue, Redirect, Request, Response, Route, Schema, Session, Storage, Str, URL, Validator, View.'],
            ['name' => 'Real-time Facades', 'slug' => 'realtime-facades', 'category' => 'facades', 'difficulty' => 'advanced', 'type' => 'facade', 'tags' => ['facade'],
             'description' => 'use Facades\\App\\Services\\PaymentService crée une facade à la volée sans classe dédiée. Préfixe Facades\\ + namespace complet. Utile pour le testing (peut être mockée). Pas d\'enregistrement dans un ServiceProvider nécessaire.'],

            // ─── COLLECTIONS ──────────────────────────────────────────────────
            ['name' => 'Méthodes Collection essentielles', 'slug' => 'collection-methods', 'category' => 'collections', 'difficulty' => 'beginner', 'type' => 'helper', 'tags' => ['helper', 'best-practice'],
             'description' => 'map(), filter(), reject(), reduce(), each(), tap(), first(), last(), pluck(), keys(), values(), unique(), flatten(), groupBy(), sortBy(), sortByDesc(), take(), skip(), chunk(), zip(), combine(), diff(), intersect().'],
            ['name' => 'Lazy Collections', 'slug' => 'lazy-collections', 'category' => 'collections', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['performance'],
             'description' => 'LazyCollection::make(fn() => yield ...) ou collect()->lazy(). Traitement en flux sans tout charger en mémoire. takeWhile(), skipWhile(). Compatible avec les générateurs PHP. Utile pour les imports CSV massifs.'],
            ['name' => 'Collection Macros', 'slug' => 'collection-macros', 'category' => 'collections', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['helper'],
             'description' => 'Collection::macro(\'toUpper\', fn() => $this->map(fn($v) => strtoupper($v))). Enregistrer dans un ServiceProvider. Package spatie/laravel-collection-macros fournit des macros prêtes. Str::macro() et autres classes macroable.'],

            // ─── CACHE ────────────────────────────────────────────────────────
            ['name' => 'Cache Drivers & Config', 'slug' => 'cache-drivers', 'category' => 'cache', 'difficulty' => 'beginner', 'type' => 'configuration', 'tags' => ['performance'],
             'description' => 'Drivers : file, database, redis, memcached, array (test), dynamodb, octane. CACHE_STORE dans .env. Plusieurs stores via Cache::store(\'redis\'). TTL en secondes ou Carbon. Prefix évite les collisions multi-apps.'],
            ['name' => 'Cache::remember & atomic locks', 'slug' => 'cache-remember', 'category' => 'cache', 'difficulty' => 'intermediate', 'type' => 'facade', 'tags' => ['performance', 'facade'],
             'description' => 'Cache::remember(\'key\', ttl, fn() => ...) : retourne ou calcule+stocke. rememberForever(). Cache::lock(\'key\', 10)->block(5, fn() => ...) : verrou atomique (Redis). Évite les race conditions dans les environnements multi-serveurs.'],
            ['name' => 'Cache Tags', 'slug' => 'cache-tags', 'category' => 'cache', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['performance'],
             'description' => 'Cache::tags([\'users\', \'posts\'])->put(\'key\', $value). tags([\'posts\'])->flush() invalide tous les items taggés "posts". Nécessite Redis ou Memcached (pas disponible avec file/database drivers).'],

            // ─── QUEUES ───────────────────────────────────────────────────────
            ['name' => 'Jobs & Dispatch', 'slug' => 'jobs-dispatch', 'category' => 'queues', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['async', 'best-practice'],
             'description' => 'php artisan make:job ProcessPodcast. ShouldQueue. handle() contient la logique. dispatch(new ProcessPodcast($episode)). dispatchIf(), dispatchUnless(). onQueue(\'high\'), delay(now()->addMinutes(10)). Sync en test via Queue::fake().'],
            ['name' => 'Job Batching', 'slug' => 'job-batching', 'category' => 'queues', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['async', 'new-in-10'],
             'description' => 'Bus::batch([new Job1, new Job2])->then(fn($b) => ...)->catch(fn($b,$e) => ...)->finally(fn() => ...)->dispatch(). ShouldQueue+Batchable sur les jobs. $this->batch()->cancel(). Progression en temps réel.'],
            ['name' => 'Queue Chaining', 'slug' => 'queue-chaining', 'category' => 'queues', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['async'],
             'description' => 'Bus::chain([new Step1, new Step2])->catch(fn($e) => ...)->dispatch(). L\'annulation ou l\'échec d\'un job stoppe la chaîne. catchCallbacks sur chaque job. Retry delay entre les jobs de la chaîne.'],
            ['name' => 'Laravel Horizon', 'slug' => 'horizon', 'category' => 'queues', 'difficulty' => 'advanced', 'type' => 'component', 'tags' => ['async', 'performance'],
             'description' => 'Dashboard pour les queues Redis. Auto-balancing workers, monitoring, retry, métriques (throughput, temps). Configuration déclarative des supervisors. Tags sur les jobs pour le suivi. php artisan horizon pour démarrer.'],

            // ─── EVENTS ───────────────────────────────────────────────────────
            ['name' => 'Events & Listeners', 'slug' => 'events-listeners', 'category' => 'events', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'php artisan make:event OrderShipped. php artisan make:listener SendShipmentNotification. Auto-discovery : écouter dans EventServiceProvider ou #[ListensTo] attribute. event(new OrderShipped($order)). Event::dispatch().'],
            ['name' => 'Observers de modèle', 'slug' => 'model-observers', 'category' => 'events', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['eloquent'],
             'description' => 'php artisan make:observer UserObserver --model=User. #[ObservedBy(UserObserver::class)] sur le modèle (Laravel 10+). Méthodes : creating, created, updating, updated, saving, saved, deleting, deleted, forceDeleted. withoutEvents() désactive les observers.'],
            ['name' => 'Broadcast Events', 'slug' => 'broadcast-events', 'category' => 'events', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['async', 'new-in-11'],
             'description' => 'ShouldBroadcast sur l\'event. broadcastOn() retourne un Channel. Drivers : Pusher, Ably, Laravel Reverb (auto-hébergé). broadcastAs() nomme l\'event côté JS. Echo.channel(\'orders\').listen(\'.OrderShipped\', callback).'],

            // ─── NOTIFICATIONS ────────────────────────────────────────────────
            ['name' => 'Notifications multi-canaux', 'slug' => 'notifications', 'category' => 'notifications', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['best-practice'],
             'description' => 'php artisan make:notification InvoicePaid. via() retourne [\'mail\', \'database\', \'slack\']. toMail(), toDatabase(), toSlack(). $user->notify(new InvoicePaid($invoice)). Notification::send($users, ...). On-demand : Notification::route(\'mail\', \'...@...\').'],
            ['name' => 'Notifications en base (database)', 'slug' => 'database-notifications', 'category' => 'notifications', 'difficulty' => 'intermediate', 'type' => 'concept',
             'description' => 'Créer table avec php artisan notifications:table. toDatabase() retourne un tableau. $user->notifications (relation HasMany). unreadNotifications, readNotifications. markAsRead(), markAllAsRead(). Polling ou broadcast pour le temps réel.'],

            // ─── MAIL ─────────────────────────────────────────────────────────
            ['name' => 'Mailables', 'slug' => 'mailables', 'category' => 'mail', 'difficulty' => 'beginner', 'type' => 'component', 'tags' => ['best-practice'],
             'description' => 'php artisan make:mail OrderShipped. envelope() → subject/from. content() → view ou markdown. attachments() → fichiers. Mail::to($user)->send(new OrderShipped($order)). Mail::queue() pour l\'async. Mail::fake() pour les tests.'],
            ['name' => 'Markdown Mailables', 'slug' => 'markdown-mail', 'category' => 'mail', 'difficulty' => 'beginner', 'type' => 'component',
             'description' => 'php artisan make:mail --markdown=emails.orders.shipped. Composants Blade : @component(\'mail::message\'), @slot(\'header\'), @component(\'mail::button\', [\'url\' => \'\']), @component(\'mail::table\'). php artisan vendor:publish --tag=laravel-mail pour customiser.'],

            // ─── STORAGE ──────────────────────────────────────────────────────
            ['name' => 'Flysystem & Disks', 'slug' => 'flysystem-disks', 'category' => 'storage', 'difficulty' => 'beginner', 'type' => 'facade', 'tags' => ['facade'],
             'description' => 'Storage::disk(\'s3\')->put(\'path\', $content). get(), exists(), delete(), url(), temporaryUrl($path, now()->addMinutes(5)). Disks : local, public, s3, sftp, ftp. config/filesystems.php. Symlink via php artisan storage:link.'],
            ['name' => 'Signed Storage URLs', 'slug' => 'signed-storage-urls', 'category' => 'storage', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['security'],
             'description' => 'Storage::disk(\'s3\')->temporaryUrl($path, now()->addHours(1)). URL privée avec expiration pour les fichiers protégés. Évite d\'exposer les credentials S3 côté client. Combine avec Route::signed() pour les uploads directs.'],

            // ─── ARTISAN ──────────────────────────────────────────────────────
            ['name' => 'Commandes Artisan custom', 'slug' => 'custom-artisan', 'category' => 'artisan', 'difficulty' => 'beginner', 'type' => 'artisan', 'tags' => ['artisan', 'best-practice'],
             'description' => 'php artisan make:command SendEmails. $signature = \'emails:send {user} {--queue}\'. handle(). this->argument(), option(). $this->info(), warn(), error(), table(), progressBar(). Artisan::call() depuis le code. WithoutOverlapping pour les tâches uniques.'],
            ['name' => 'Artisan Tinker', 'slug' => 'artisan-tinker', 'category' => 'artisan', 'difficulty' => 'beginner', 'type' => 'artisan', 'tags' => ['artisan', 'best-practice'],
             'description' => 'REPL PsySH intégré. php artisan tinker. Accès direct aux modèles, facades, helpers. Tinker auto-imports les classes dans App\\. Tinker::startUsing() pour personnaliser. Variables persistées entre les lignes. Indispensable pour le debug.'],
            ['name' => 'Commandes Artisan essentielles', 'slug' => 'artisan-commands', 'category' => 'artisan', 'difficulty' => 'beginner', 'type' => 'artisan', 'tags' => ['artisan'],
             'description' => 'make:model -mfsc (migration+factory+seeder+controller). route:list --path=api. config:cache / clear. optimize / optimize:clear. db:seed. migrate:fresh --seed. key:generate. queue:work --timeout=90. schedule:run.'],

            // ─── TESTING ──────────────────────────────────────────────────────
            ['name' => 'Tests HTTP (Feature Tests)', 'slug' => 'http-tests', 'category' => 'testing', 'difficulty' => 'beginner', 'type' => 'concept', 'tags' => ['testing', 'best-practice'],
             'description' => 'extends TestCase. $this->get(\'/api/users\')->assertStatus(200)->assertJsonCount(5). post(), put(), delete(). actingAs($user). withHeaders(). assertJson(), assertJsonFragment(), assertJsonPath(). assertRedirect(), assertSessionHas().'],
            ['name' => 'Fakes & Mocks', 'slug' => 'fakes-mocks', 'category' => 'testing', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['testing'],
             'description' => 'Mail::fake(), Queue::fake(), Event::fake(), Notification::fake(), Storage::fake(), Http::fake(). assertSent(), assertQueued(), assertDispatched(). $this->mock(Service::class)->expects(). Mockery intégré. Partialité via partialMock().'],
            ['name' => 'Database Testing', 'slug' => 'database-testing', 'category' => 'testing', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['testing', 'best-practice'],
             'description' => 'RefreshDatabase (recrée), DatabaseTransactions (rollback), LazilyRefreshDatabase. assertDatabaseHas(), assertDatabaseMissing(), assertDatabaseCount(). Seeders en test via seed() ou $this->seed(MySeeder::class). Factories dans les tests.'],
            ['name' => 'Pest PHP', 'slug' => 'pest', 'category' => 'testing', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['testing', 'new-in-11'],
             'description' => 'Test runner alternatif installé par défaut dans Laravel 11. Syntaxe fluente : it(\'can login\', fn() => ...)->group(\'auth\'). expect($value)->toBe(5)->toBeString(). Higher-order tests. Architecture testing. Parallel testing. type().'],

            // ─── HELPERS ──────────────────────────────────────────────────────
            ['name' => 'Str:: helpers', 'slug' => 'str-helpers', 'category' => 'helpers', 'difficulty' => 'beginner', 'type' => 'helper', 'tags' => ['helper'],
             'description' => 'Str::slug(), camel(), studly(), snake(), plural(), singular(), limit(), uuid(), ulid(), random(), contains(), startsWith(), endsWith(), wordCount(), headline(), mask(), padLeft(), squish(), wrap(). str() helper fluent.'],
            ['name' => 'Arr:: helpers', 'slug' => 'arr-helpers', 'category' => 'helpers', 'difficulty' => 'beginner', 'type' => 'helper', 'tags' => ['helper'],
             'description' => 'Arr::get($arr, \'key.nested\', $default). set(), has(), forget(), only(), except(), pluck(), first(), last(), flatten(), wrap(), collapse(), crossJoin(), sortRecursive(). data_get() et data_set() globaux. Dot notation pour les tableaux imbriqués.'],
            ['name' => 'Number:: helpers', 'slug' => 'number-helpers', 'category' => 'helpers', 'difficulty' => 'beginner', 'type' => 'helper', 'tags' => ['helper', 'new-in-10'],
             'description' => 'Number::format(1234567.89, 2). currency(42.99, \'EUR\', \'fr\'). percentage(0.75). fileSize(1024 * 1024). ordinal(1) → "1st". abbreviate(1200) → "1.2K". clamp(), between(). Depuis Laravel 10.'],
            ['name' => 'Fluent Strings (str()->...)', 'slug' => 'fluent-strings', 'category' => 'helpers', 'difficulty' => 'beginner', 'type' => 'helper', 'tags' => ['helper', 'best-practice'],
             'description' => 'str(\'Hello World\')->slug()->upper()->limit(5)->value(). Méthodes chaînables sur un objet Stringable. Tous les Str:: disponibles + append(), prepend(), when(), unless(). Castable en string automatiquement.'],

            // ─── CONFIGURATION ────────────────────────────────────────────────
            ['name' => 'Variables d\'environnement (.env)', 'slug' => 'env-vars', 'category' => 'configuration', 'difficulty' => 'beginner', 'type' => 'configuration', 'tags' => ['security', 'best-practice'],
             'description' => 'env(\'VAR\', \'default\') lit les variables. Jamais dans le code production : toujours via config(). .env.example documenté et commité. APP_ENV, APP_DEBUG, APP_KEY. php artisan env:encrypt / env:decrypt pour les secrets.'],
            ['name' => 'Config caching', 'slug' => 'config-caching', 'category' => 'configuration', 'difficulty' => 'beginner', 'type' => 'artisan', 'tags' => ['performance', 'artisan'],
             'description' => 'php artisan config:cache fusionne tous les fichiers config en un fichier bootstrap/cache/config.php. php artisan config:clear. En production : obligatoire. Avec config:cache, env() direct dans le code ne fonctionne plus (doit passer par config()).'],

            // ─── SCHEDULING ───────────────────────────────────────────────────
            ['name' => 'Task Scheduling', 'slug' => 'task-scheduling', 'category' => 'scheduling', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['async', 'best-practice'],
             'description' => 'Schedule dans routes/console.php (Laravel 11) ou Kernel::schedule(). hourly(), daily(), weekly(), cron(\'0 * * * *\'). weekdays(), between(\'8:00\',\'17:00\'). withoutOverlapping(). onOneServer() pour les multi-serveurs. runInBackground(). emailOutputTo().'],
            ['name' => 'Scheduling — Hooks & Conditions', 'slug' => 'schedule-hooks', 'category' => 'scheduling', 'difficulty' => 'advanced', 'type' => 'concept',
             'description' => 'when(fn() => ...) / skip(fn() => ...) conditionnent l\'exécution. before() / after() / onSuccess() / onFailure() pour les callbacks. pingBefore() / pingAfter() pour le monitoring (ex: Uptime Kuma, Dead Man\'s Snitch).'],

            // ─── HTTP CLIENT ──────────────────────────────────────────────────
            ['name' => 'Http::get/post/put', 'slug' => 'http-client-basic', 'category' => 'http-client', 'difficulty' => 'beginner', 'type' => 'facade', 'tags' => ['facade', 'best-practice'],
             'description' => 'Http::get(\'https://...\', [\'page\' => 1])->json(). Http::post(url, $data)->throw()->json(). withHeaders(), withToken(), withBasicAuth(). accept(\'application/json\'). timeout(30). retry(3, 100). throw() lève une exception sur 4xx/5xx.'],
            ['name' => 'Http Fake & Testing', 'slug' => 'http-fake', 'category' => 'http-client', 'difficulty' => 'intermediate', 'type' => 'concept', 'tags' => ['testing'],
             'description' => 'Http::fake([\'github.com/*\' => Http::response([\'login\' => \'test\'], 200)]). Http::fake() intercepte toutes les requêtes (throw si non matchée). assertSent(), assertNotSent(), assertSentCount(). Sequences avec Http::sequence().'],
            ['name' => 'Http Client asynchrone', 'slug' => 'http-async', 'category' => 'http-client', 'difficulty' => 'advanced', 'type' => 'concept', 'tags' => ['async', 'performance'],
             'description' => 'Http::pool(fn($pool) => [$pool->get(url1), $pool->get(url2)]). Requêtes en parallèle via Guzzle promises. responses[0]->json(). Http::async()->get(url)->wait(). Http::withOptions([\'stream\' => true]) pour le streaming.'],

            // ─── LIVEWIRE ─────────────────────────────────────────────────────
            ['name' => 'Composants Livewire', 'slug' => 'livewire-components', 'category' => 'livewire', 'difficulty' => 'intermediate', 'type' => 'component', 'tags' => ['new-in-11', 'best-practice'],
             'description' => 'php artisan make:livewire Counter. Propriétés publiques = réactives. Actions : méthodes appelées depuis Blade. wire:model (two-way), wire:click, wire:submit, wire:loading. #[Validate] sur les propriétés. mount() = constructeur.'],
            ['name' => 'Livewire Volt (Single-File)', 'slug' => 'livewire-volt', 'category' => 'livewire', 'difficulty' => 'intermediate', 'type' => 'component', 'tags' => ['new-in-11'],
             'description' => 'Composant PHP+Blade en un seul fichier .blade.php avec <?php ... ?>. state() pour les propriétés, computed() pour les calculées, action() pour les méthodes. Pas de classe séparée. @volt dans le template. Inspiré de Vue SFC.'],
        ];
    }

    /* ═══════════════════════════════════════════════════ CODE EXAMPLES */
    private function seedCodeExamples(): void
    {
        $featureMap = Feature::pluck('id', 'slug');

        $examples = $this->getAllExamples();

        foreach ($examples as $ex) {
            $featureId = $featureMap[$ex['feature']] ?? null;
            if (!$featureId) continue;

            CodeExample::create([
                'feature_id'  => $featureId,
                'title'       => $ex['title'],
                'code'        => $ex['code'],
                'language'    => $ex['language'],
                'description' => $ex['description'] ?? null,
            ]);
        }
    }

    private function getAllExamples(): array
    {
        return [
            // ROUTING
            ['feature' => 'basic-routes', 'title' => 'Routes GET/POST avec paramètres', 'language' => 'php',
             'description' => 'Syntaxe de base des routes Laravel avec paramètres obligatoires et optionnels.',
             'code' => <<<'CODE'
// Routes basiques
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Paramètre optionnel avec valeur par défaut
Route::get('/posts/{category?}', function (string $category = 'all') {
    return "Category: $category";
});

// Closure inline (prototypage rapide)
Route::get('/hello/{name}', fn(string $name) => "Hello, $name!");
CODE],
            ['feature' => 'route-model-binding', 'title' => 'Route Model Binding implicite et explicite', 'language' => 'php',
             'description' => 'Résolution automatique d\'un modèle Eloquent depuis le paramètre de route.',
             'code' => <<<'CODE'
// Implicite — {post} → Post::findOrFail($post)
Route::get('/posts/{post}', function (Post $post) {
    return $post;
});

// Par colonne différente de id
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// Personnaliser dans le modèle
class Post extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
CODE],
            ['feature' => 'resource-routes', 'title' => 'Resource Routes & API Resource', 'language' => 'php',
             'description' => '7 routes RESTful en une ligne, filtrables avec only() et except().',
             'code' => <<<'CODE'
// 7 routes : index, create, store, show, edit, update, destroy
Route::resource('photos', PhotoController::class);

// API : exclut create et edit (pas de vues de formulaire)
Route::apiResource('photos', PhotoController::class);

// Filtrer les actions
Route::resource('photos', PhotoController::class)
    ->only(['index', 'show'])
    ->names(['index' => 'photos.all']);

// Nesting
Route::resource('photos.comments', PhotoCommentController::class)
    ->scoped(['comment' => 'uuid']);
CODE],
            ['feature' => 'signed-urls', 'title' => 'URLs signées (unsubscribe, download...)', 'language' => 'php',
             'description' => 'Générer des URLs inviolables avec expiration optionnelle.',
             'code' => <<<'CODE'
// URL signée sans expiration
$url = URL::signedRoute('unsubscribe', ['user' => $user->id]);

// URL temporaire (expire dans 30 minutes)
$url = URL::temporarySignedRoute('invoice.download', now()->addMinutes(30), [
    'invoice' => $invoice->id,
]);

// Protection de la route
Route::get('/unsubscribe/{user}', function (Request $request, User $user) {
    abort_unless($request->hasValidSignature(), 403);
    // traitement...
})->middleware('signed');
CODE],
            // BLADE
            ['feature' => 'blade-components', 'title' => 'Composant Blade avec props et slots', 'language' => 'blade',
             'description' => 'Composant réutilisable avec classe PHP, props typées et slots nommés.',
             'code' => <<<'CODE'
{{-- resources/views/components/alert.blade.php --}}
@props(['type' => 'info', 'dismissible' => false])

<div {{ $attributes->merge(['class' => "alert alert-$type"]) }}>
    @if($dismissible)
        <button type="button" class="close">×</button>
    @endif

    <strong>{{ $title ?? '' }}</strong>
    {{ $slot }}
</div>

{{-- Classe PHP : app/View/Components/Alert.php --}}
class Alert extends Component
{
    public function __construct(
        public string $type = 'info',
        public bool $dismissible = false,
    ) {}

    public function render(): View
    {
        return view('components.alert');
    }
}

{{-- Utilisation --}}
<x-alert type="danger" :dismissible="true">
    <x-slot:title>Erreur critique</x-slot:title>
    Une erreur est survenue lors du traitement.
</x-alert>
CODE],
            ['feature' => 'blade-layouts', 'title' => 'Layout Blade moderne (component)', 'language' => 'blade',
             'description' => 'Layout basé sur les composants — approche recommandée depuis Laravel 8.',
             'code' => <<<'CODE'
{{-- resources/views/components/layout.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{ $title ?? 'Mon App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    <nav>@include('partials.nav')</nav>
    <main>{{ $slot }}</main>
    <footer>@include('partials.footer')</footer>
    @stack('scripts')
</body>
</html>

{{-- Page qui l'utilise --}}
<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <h1>Bienvenue</h1>
    <p>Contenu de la page…</p>

    @push('scripts')
        <script src="/js/dashboard.js"></script>
    @endpush
</x-layout>
CODE],
            // ELOQUENT
            ['feature' => 'eloquent-relations', 'title' => 'Relations Eloquent — tous les types', 'language' => 'php',
             'description' => 'Vue d\'ensemble des relations Eloquent avec exemples concis.',
             'code' => <<<'CODE'
class User extends Model
{
    // Un utilisateur a un profil
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    // Un utilisateur a plusieurs articles
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Beaucoup d'utilisateurs → beaucoup de rôles
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
                    ->withPivot('expires_at')
                    ->withTimestamps();
    }

    // Commentaires via les articles (sans passer par Post)
    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    // Relation polymorphique
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
CODE],
            ['feature' => 'eloquent-scopes', 'title' => 'Local Scopes & Global Scopes', 'language' => 'php',
             'description' => 'Encapsuler des conditions de requête réutilisables dans le modèle.',
             'code' => <<<'CODE'
class Post extends Model
{
    // Local scope → Post::published()->recent()->get()
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeRecent(Builder $query, int $days = 30): Builder
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Scope avec paramètre
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}

// Global scope (s'applique à TOUTES les requêtes du modèle)
class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('active', true);
    }
}

// Sur le modèle
protected static function booted(): void
{
    static::addGlobalScope(new ActiveScope);
}

// Désactiver ponctuellement
Post::withoutGlobalScope(ActiveScope::class)->get();
CODE],
            ['feature' => 'eager-loading', 'title' => 'Eager Loading — éviter le N+1', 'language' => 'php',
             'description' => 'Charger les relations en avance pour réduire le nombre de requêtes SQL.',
             'code' => <<<'CODE'
// ❌ Problème N+1 : 1 requête posts + N requêtes author
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->author->name; // nouvelle requête à chaque itération
}

// ✅ Eager loading : 2 requêtes au total
$posts = Post::with(['author', 'comments.author'])->get();

// Eager loading avec contraintes
$posts = Post::with(['comments' => function ($query) {
    $query->where('approved', true)->latest();
}])->get();

// withCount, withSum, withAvg
$posts = Post::withCount('comments')
             ->withSum('votes', 'value')
             ->get();

// Prévenir le lazy loading en développement
Model::preventLazyLoading(! app()->isProduction());
CODE],
            ['feature' => 'eloquent-casts', 'title' => 'Casts, Accessors & Mutators modernes', 'language' => 'php',
             'description' => 'Transformer les données en lecture/écriture avec la syntaxe Laravel 10+.',
             'code' => <<<'CODE'
class User extends Model
{
    protected $casts = [
        'email_verified_at' => 'datetime',
        'options'           => 'array',
        'price'             => 'decimal:2',
        'is_admin'          => 'boolean',
        'status'            => UserStatus::class, // Enum PHP 8.1
        'metadata'          => AsCollection::class,
        'password'          => 'hashed',           // auto-hash Laravel 10+
    ];

    // Accessor moderne (Laravel 9+)
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "$this->first_name $this->last_name",
            set: fn($value) => ['first_name' => explode(' ', $value)[0],
                                'last_name'  => explode(' ', $value)[1] ?? ''],
        );
    }

    // Avec cache de l'accessor
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->profile?->avatar_url ?? asset('default-avatar.png'),
        )->shouldCache();
    }
}
CODE],
            // VALIDATION
            ['feature' => 'form-request', 'title' => 'Form Request complet', 'language' => 'php',
             'description' => 'Validation et autorisation encapsulées dans une classe dédiée.',
             'code' => <<<'CODE'
class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Post::class);
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string', 'min:100'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'tags'        => ['array', 'max:5'],
            'tags.*'      => ['string', Rule::in(Tag::pluck('slug'))],
            'image'       => ['nullable', 'image', 'max:2048', 'dimensions:min_width=300'],
            'published_at'=> ['nullable', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Le titre est obligatoire.',
            'content.min'      => 'Le contenu doit faire au moins :min caractères.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['slug' => Str::slug($this->title)]);
    }
}

// Dans le contrôleur
public function store(StorePostRequest $request): RedirectResponse
{
    $post = Post::create($request->validated());
    return redirect()->route('posts.show', $post);
}
CODE],
            // SERVICE CONTAINER
            ['feature' => 'container-binding', 'title' => 'Bindings dans AppServiceProvider', 'language' => 'php',
             'description' => 'Enregistrer des services et leurs dépendances dans le container IoC.',
             'code' => <<<'CODE'
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Lier une interface à une implémentation
        $this->app->bind(
            PaymentGatewayInterface::class,
            StripePaymentGateway::class
        );

        // Singleton (une seule instance pour toute la requête)
        $this->app->singleton(MetricsService::class, function ($app) {
            return new MetricsService(
                config('services.metrics.key'),
                $app->make(CacheInterface::class),
            );
        });

        // Binding contextuel
        $this->app->when(CheckoutController::class)
                  ->needs(PaymentGatewayInterface::class)
                  ->give(StripePaymentGateway::class);

        $this->app->when(AdminController::class)
                  ->needs(PaymentGatewayInterface::class)
                  ->give(ManualPaymentGateway::class);
    }
}
CODE],
            // COLLECTIONS
            ['feature' => 'collection-methods', 'title' => 'Pipeline de collection fluent', 'language' => 'php',
             'description' => 'Chaîner les méthodes de collection pour des transformations lisibles.',
             'code' => <<<'CODE'
$result = collect($orders)
    ->filter(fn($order) => $order['status'] === 'completed')
    ->map(fn($order) => [
        ...$order,
        'revenue' => $order['price'] * $order['quantity'],
    ])
    ->groupBy('customer_id')
    ->map(fn($group) => [
        'total'      => $group->sum('revenue'),
        'count'      => $group->count(),
        'average'    => $group->avg('revenue'),
        'best_order' => $group->sortByDesc('revenue')->first(),
    ])
    ->sortByDesc('total')
    ->take(10)
    ->values();

// Lazy collection pour les gros fichiers CSV
LazyCollection::make(function () {
    $handle = fopen('big-file.csv', 'r');
    while (($line = fgetcsv($handle)) !== false) {
        yield $line;
    }
})->skip(1)->chunk(200)->each(function ($chunk) {
    DB::table('imports')->insert($chunk->toArray());
});
CODE],
            // QUEUES
            ['feature' => 'jobs-dispatch', 'title' => 'Job complet avec retry et timeout', 'language' => 'php',
             'description' => 'Structure d\'un Job avec gestion d\'erreur, retry et unicité.',
             'code' => <<<'CODE'
class ProcessVideoUpload implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 300;   // 5 minutes
    public int $backoff = 60;    // attente entre les tentatives
    public int $uniqueFor = 3600; // ShouldBeUnique : unicité 1h

    public function __construct(
        public readonly Video $video,
    ) {}

    public function handle(VideoProcessor $processor): void
    {
        $processor->transcode($this->video);
        $this->video->update(['status' => 'ready']);
    }

    public function failed(Throwable $exception): void
    {
        $this->video->update(['status' => 'failed']);
        Mail::to($this->video->user)->send(new VideoProcessingFailed($this->video));
    }

    public function uniqueId(): string
    {
        return (string) $this->video->id;
    }
}

// Dispatch avec options
ProcessVideoUpload::dispatch($video)
    ->onQueue('video-processing')
    ->delay(now()->addSeconds(30));
CODE],
            // HTTP CLIENT
            ['feature' => 'http-client-basic', 'title' => 'Http Client — retry, headers, fake', 'language' => 'php',
             'description' => 'Requêtes HTTP robustes avec retry automatique et test simplifié.',
             'code' => <<<'CODE'
// GET avec paramètres
$response = Http::get('https://api.github.com/repos/laravel/laravel', [
    'per_page' => 10,
]);
$data = $response->json();

// POST avec auth et retry
$response = Http::withToken($this->apiKey)
    ->withHeaders(['X-Custom' => 'value'])
    ->retry(3, 100, fn($e, $req) => $e instanceof ConnectionException)
    ->timeout(10)
    ->post('https://api.example.com/orders', [
        'product_id' => 42,
        'quantity'   => 1,
    ]);

$response->throw(); // exception si 4xx/5xx
$orderId = $response->json('data.order_id');

// Macro réutilisable (dans AppServiceProvider::boot())
Http::macro('github', fn() => Http::withToken(config('services.github.token'))
    ->baseUrl('https://api.github.com/')
    ->accept('application/vnd.github.v3+json'));

// Test — aucun appel réseau réel
Http::fake(['api.example.com/*' => Http::response(['id' => 1], 201)]);
CODE],
            // ARTISAN
            ['feature' => 'custom-artisan', 'title' => 'Commande Artisan complète', 'language' => 'php',
             'description' => 'Commande avec argument, option, table et barre de progression.',
             'code' => <<<'CODE'
#[AsCommand(name: 'app:sync-products')]
class SyncProductsCommand extends Command
{
    protected $signature = 'app:sync-products
                            {source : Fichier CSV source}
                            {--dry-run : Simuler sans sauvegarder}
                            {--batch=100 : Taille des lots}';

    protected $description = 'Synchronise les produits depuis un fichier CSV';

    public function handle(ProductSyncer $syncer): int
    {
        $file    = $this->argument('source');
        $dryRun  = $this->option('dry-run');
        $batch   = (int) $this->option('batch');

        $this->info("Synchronisation depuis : $file");
        if ($dryRun) $this->warn('Mode dry-run — aucune modification ne sera effectuée.');

        $rows = $syncer->parse($file);
        $bar  = $this->output->createProgressBar(count($rows));

        $synced = 0;
        foreach (array_chunk($rows, $batch) as $chunk) {
            if (!$dryRun) $syncer->sync($chunk);
            $bar->advance(count($chunk));
            $synced += count($chunk);
        }

        $bar->finish();
        $this->newLine();
        $this->table(['Métrique', 'Valeur'], [
            ['Produits traités', $synced],
            ['Mode', $dryRun ? 'dry-run' : 'live'],
        ]);

        return Command::SUCCESS;
    }
}
CODE],
            // TESTING
            ['feature' => 'http-tests', 'title' => 'Feature Test HTTP complet (Pest)', 'language' => 'php',
             'description' => 'Test d\'une API REST avec authentification, assertions JSON et base de données.',
             'code' => <<<'CODE'
uses(RefreshDatabase::class);

it('allows authenticated users to create a post', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this->actingAs($user)
        ->postJson('/api/posts', [
            'title'       => 'Mon premier article',
            'content'     => str_repeat('contenu ', 20),
            'category_id' => $category->id,
        ]);

    $response
        ->assertCreated()                           // 201
        ->assertJsonPath('data.title', 'Mon premier article')
        ->assertJsonStructure(['data' => ['id', 'title', 'slug', 'author']]);

    $this->assertDatabaseHas('posts', [
        'title'   => 'Mon premier article',
        'user_id' => $user->id,
    ]);
});

it('rejects unauthenticated requests', function () {
    $this->postJson('/api/posts', [])->assertUnauthorized();
});

it('validates required fields', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->postJson('/api/posts', [])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['title', 'content', 'category_id']);
});
CODE],
            // LIVEWIRE
            ['feature' => 'livewire-components', 'title' => 'Composant Livewire — Search en temps réel', 'language' => 'php',
             'description' => 'Composant Livewire avec recherche réactive et pagination.',
             'code' => <<<'CODE'
class ProductSearch extends Component
{
    #[Url]
    public string $search = '';

    public string $sortBy = 'name';

    #[Validate('required|in:name,price,created_at')]
    public string $sortDir = 'asc';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
    }

    public function render(): View
    {
        return view('livewire.product-search', [
            'products' => Product::query()
                ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(15),
        ]);
    }
}
CODE],
            ['feature' => 'livewire-volt', 'title' => 'Volt — Composant Single-File', 'language' => 'blade',
             'description' => 'Composant Livewire entier en un seul fichier Blade avec Volt.',
             'code' => <<<'CODE'
<?php
use function Livewire\Volt\{state, computed, action, mount};

state(['search' => '', 'page' => 1]);

$results = computed(function () {
    return Product::query()
        ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
        ->paginate(10, page: $this->page);
});

$nextPage = action(fn() => $this->page++);
$prevPage = action(fn() => $this->page = max(1, $this->page - 1));
?>

<div>
    <input wire:model.live.debounce.300ms="search"
           type="text"
           placeholder="Rechercher un produit…"
           class="input">

    <ul>
        @foreach ($this->results as $product)
            <li>{{ $product->name }} — {{ Number::currency($product->price) }}</li>
        @endforeach
    </ul>

    <div class="pagination">
        <button wire:click="prevPage" @disabled($page <= 1)>← Précédent</button>
        <span>Page {{ $page }}</span>
        <button wire:click="nextPage" @disabled(!$this->results->hasMorePages())>Suivant →</button>
    </div>
</div>
CODE],
            // SCHEDULING
            ['feature' => 'task-scheduling', 'title' => 'Task Scheduling — routes/console.php (Laravel 11)', 'language' => 'php',
             'description' => 'Planification de tâches dans le nouveau fichier routes/console.php de Laravel 11.',
             'code' => <<<'CODE'
// routes/console.php (Laravel 11+)
use Illuminate\Support\Facades\Schedule;

Schedule::command('emails:send --force')
    ->daily()
    ->at('08:00')
    ->weekdays()
    ->withoutOverlapping()
    ->onOneServer()
    ->onSuccess(fn() => Log::info('Emails envoyés'))
    ->onFailure(fn() => Alert::notify('Échec envoi emails'));

Schedule::command('db:backup')
    ->cron('0 2 * * *')
    ->timezone('Europe/Paris')
    ->runInBackground()
    ->pingAfter(config('services.healthcheck.url'));

Schedule::call(fn() => Report::generate())
    ->weekly()
    ->mondays()
    ->between('9:00', '17:00')
    ->when(fn() => app()->isProduction());

Schedule::job(new GenerateSitemapJob)
    ->daily()
    ->skip(fn() => Sitemap::isUpToDate());
CODE],
        ];
    }
}
